<?php

namespace App\Controller;

use App\Entity\Playlist;
use App\Logic\Discipline\Mapper as DisciplineMapper;
use App\Logic\Playlist\Mapper as PlaylistMapper;
use App\Logic\Video\Mapper as VideoMapper;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PlaylistController extends AbstractController
{
    const PLAYLIST_TEMPLATE = 'playlist/index.html.twig';

    /** @var DisciplineMapper $discipline_mapper */
    private $discipline_mapper;

    /** @var PlaylistMapper $playlist_mapper */
    private $playlist_mapper;

    /** @var VideoMapper $video_mapper */
    private $video_mapper;

    public function __construct(
        DisciplineMapper $discipline_mapper,
        PlaylistMapper $playlist_mapper,
        VideoMapper $video_mapper
    ) {
        $this->discipline_mapper = $discipline_mapper;
        $this->playlist_mapper = $playlist_mapper;
        $this->video_mapper = $video_mapper;
    }

    public function indexAction($discipline_slug, $playlist_slug)
    {
        $playlist_criteria = ['urlSlug' => $playlist_slug];

        /** @var Playlist $playlist */
        $playlist = $this->getDoctrine()->getRepository(Playlist::class)->findOneBy($playlist_criteria);

        if ($playlist == null || empty($playlist)) {
            throw new NotFoundHttpException();
        }

        $discipline = $playlist->getDiscipline();
        $discipline = $this->discipline_mapper->mapOne($discipline);
        $videos = $playlist->getVideos()->getValues();

        $playlist = $this->playlist_mapper->mapOneWithRelations($playlist);
        $videos = $this->video_mapper->mapVideos($videos);

        $video_count = count($videos);
        $videos = array_chunk($videos, ceil($video_count / 3));

        $data = [
            'discipline' => $discipline,
            'playlist' => $playlist,
            'videos' => $videos,
            'count' => $video_count
        ];

        return $this->render(self::PLAYLIST_TEMPLATE, $data);
    }
}
