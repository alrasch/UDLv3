<?php

namespace App\Controller;

use App\Entity\Discipline;
use App\Logic\Discipline\Mapper;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends AbstractController
{
    const INDEX_TEMPLATE = 'home/index.html.twig';
    private Mapper $mapper;
    private EntityManagerInterface $em;

    public function __construct(Mapper $mapper, EntityManagerInterface $em)
    {
        $this->mapper = $mapper;
        $this->em = $em;
    }

    public function indexAction(): Response
    {
        $disciplines = $this->em->getRepository(Discipline::class)->findBy([], ['sortWeight' => 'ASC']);

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
