<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class AboutController extends AbstractController
{
    public function aboutAction(): Response
    {
        return $this->render('about/about.html.twig');
    }

    public function faqAction() {
        return $this->render('about/faq.html.twig');
    }

    public function contactAction() {
        return $this->render('about/contact.html.twig');
    }

    public function donateAction() {
        return $this->render('about/donate.html.twig');
    }
}
