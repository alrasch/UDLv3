<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AboutController extends AbstractController
{
    public function aboutAction() {
        return $this->render('about/about.html.twig');
    }

    public function faqAction() {
        //TODO
    }
}
