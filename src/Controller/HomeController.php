<?php

namespace App\Controller;

use App\Entity\Discipline;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    const INDEX_TEMPLATE = 'home/index.html.twig';

    public function indexAction()
    {
        $disciplines = $this->getDoctrine()->getRepository(Discipline::class)->findBy([], ['sortWeight' => 'ASC']);
        $data = [
            'disciplines' => $disciplines
        ];
        return $this->render(self::INDEX_TEMPLATE, $data);
    }
}
