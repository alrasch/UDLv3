<?php

namespace App\Controller;

use App\Entity\Discipline;
use App\Logic\Article\Grouper;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;
use Twig\Loader\LoaderInterface;

class ArticleController extends AbstractController {
    private LoaderInterface $loader;
    private Grouper $grouper;

    public function __construct(Environment $twig, Grouper $grouper) {
        $this->loader = $twig->getLoader();
        $this->grouper = $grouper;
    }

    public function indexAction($discipline_slug, $topic): Response
    {
        $template_path = "@article/{$discipline_slug}/{$topic}.html.twig";

        if ($this->loader->exists($template_path)) {
            return $this->render($template_path, ['load_mathjax' => true]);
        } else {
            return $this->forward('App\Controller\HomeController::indexAction');
        }
    }

    public function listAction(): Response
    {
        $json = file_get_contents(__DIR__ . "/../../articles/articles.json");
        $articles = json_decode($json, true);

        /** @var Discipline[] $disciplines */
        $disciplines = $this->getDoctrine()->getRepository(Discipline::class)->findBy([], ['sortWeight' => 'ASC']);
        $grouped = $this->grouper->groupByDisciplineId($articles, $disciplines);
        $data = [
            'disciplines' => $grouped
        ];
        return $this->render('article/list.html.twig', $data);
    }
}
