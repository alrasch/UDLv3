<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Discipline;
use App\Logic\Article\Grouper;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Twig\Environment;
use Twig\Loader\LoaderInterface;

class ArticleController extends AbstractController {
    private LoaderInterface $loader;
    private Grouper $grouper;

    public function __construct(Environment $twig, Grouper $grouper) {
        $this->loader = $twig->getLoader();
        $this->grouper = $grouper;
    }

    public function indexAction($discipline_slug, $topic) {
        $template_path = "@article/{$discipline_slug}/{$topic}.html.twig";

        if ($this->loader->exists($template_path)) {
            return $this->render($template_path);
        } else {
            return $this->forward('App\Controller\HomeController::indexAction');
        }
    }

    public function listAction() {
        /** @var Article[] $articles */
        $articles = $this->getDoctrine()->getRepository(Article::class)->findAll();
        $disciplines = $this->getDoctrine()->getRepository(Discipline::class)->findAll();

        if ($articles === null || empty($articles)) {
            return $this->redirectToRoute('home');
        }

        $grouped = $this->grouper->groupByDisciplineId($articles, $disciplines);

        $data = [
            'disciplines' => $grouped
        ];

        return $this->render('article/list.html.twig', $data);
    }
}
