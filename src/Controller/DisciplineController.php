<?php

namespace App\Controller;

use App\Logic\Discipline\Mapper as DisciplineMapper;
use App\Logic\Playlist\Mapper as PlaylistMapper;
use App\Entity\Discipline;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DisciplineController extends AbstractController
{
    const DISCIPLINE_TEMPLATE = 'discipline/index.html.twig';

    private $discipline_mapper;

    private $playlist_mapper;

    public function __construct(DisciplineMapper $discipline_mapper, PlaylistMapper $playlist_mapper)
    {
        $this->discipline_mapper = $discipline_mapper;
        $this->playlist_mapper = $playlist_mapper;
    }

    public function indexAction($slug)
    {
        $discipline_criteria = ['urlSlug' => $slug];
        /** @var Discipline $discipline */
        $discipline = $this->getDoctrine()->getRepository(Discipline::class)->findOneBy($discipline_criteria);

        if ($discipline == null || empty($discipline)) {
            return $this->redirectToRoute('home');
        }

        $playlists = $discipline->getPlaylists()->getValues();

        $discipline = $this->discipline_mapper->mapOne($discipline);
        $playlists = $this->playlist_mapper->mapPlaylists($playlists);

        $playlist_count = count($playlists);
        $playlists = array_chunk($playlists, ceil($playlist_count / 3));

        $data = [
            'discipline' => $discipline,
            'playlists' => $playlists,
            'count' => $playlist_count,
        ];

        return $this->render(self::DISCIPLINE_TEMPLATE, $data);
    }
}
