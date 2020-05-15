<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Twig\Environment;
use Twig\Loader\LoaderInterface;

class ArticleController extends AbstractController {
    private LoaderInterface $loader;

    public function __construct(Environment $twig) {
        $this->loader = $twig->getLoader();
    }

    public function indexAction($topic) {
        $template_path = "@article/{$topic}.html.twig";

        if ($this->loader->exists($template_path)) {
            return $this->render($template_path);
        } else {
            return $this->forward('App\Controller\HomeController::indexAction');
        }
    }
}
