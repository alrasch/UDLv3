<?php

namespace App\Controller;

use App\Entity\Discipline;
use App\Logic\Discipline\Mapper;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    const INDEX_TEMPLATE = 'home/index.html.twig';

    /** @var Mapper */
    private $mapper;

    public function __construct(Mapper $mapper)
    {
        $this->mapper = $mapper;
    }

    public function indexAction()
    {
        $disciplines = $this->getDoctrine()->getRepository(Discipline::class)->findBy([], ['sortWeight' => 'ASC']);

        $items = $this->mapper->mapDisciplines($disciplines);
        $count = count($items);

        $items = array_chunk($items, ceil($count / 3));

        $data = [
            'disciplines' => $items,
            'count' => $count,
        ];
        return $this->render(self::INDEX_TEMPLATE, $data);
    }
}
