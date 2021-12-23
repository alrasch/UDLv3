<?php

namespace App\Controller;

use App\Logic\Common\FormattedMathResolver;
use App\Logic\Discipline\Mapper as DisciplineMapper;
use App\Logic\Playlist\Mapper as PlaylistMapper;
use App\Entity\Discipline;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DisciplineController extends AbstractController
{
    const DISCIPLINE_TEMPLATE = 'discipline/index.html.twig';

    private DisciplineMapper $discipline_mapper;
    private PlaylistMapper $playlist_mapper;
    private FormattedMathResolver $math_resolver;

    public function __construct(
        DisciplineMapper $discipline_mapper,
        PlaylistMapper $playlist_mapper,
        FormattedMathResolver $math_resolver)
    {
        $this->discipline_mapper = $discipline_mapper;
        $this->playlist_mapper = $playlist_mapper;
        $this->math_resolver = $math_resolver;
    }

    public function indexAction($slug): Response
    {
        $discipline_criteria = ['urlSlug' => $slug];
        /** @var Discipline $discipline */
        $discipline = $this->getDoctrine()->getRepository(Discipline::class)->findOneBy($discipline_criteria);

        if (empty($discipline)) {
            throw new NotFoundHttpException();
        }

        $playlists = $discipline->getPlaylists()->getValues();

        $mapped_discipline = $this->discipline_mapper->mapOne($discipline);
        $playlists = $this->playlist_mapper->mapPlaylists($playlists);

        $playlist_count = count($playlists);
        $playlists = array_chunk($playlists, ceil($playlist_count / 3));

        $data = [
            'discipline' => $mapped_discipline,
            'playlists' => $playlists,
            'count' => $playlist_count,
            'load_mathjax' => $this->math_resolver->hasFormattedMath($discipline)
        ];

        return $this->render(self::DISCIPLINE_TEMPLATE, $data);
    }
}
