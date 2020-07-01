<?php

namespace App\Controller;

use App\Logic\Video\Mapper as VideoMapper;
use App\Logic\Playlist\Mapper as PlaylistMapper;
use App\Entity\Video;
use App\Logic\Video\Resolver;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class VideoController extends AbstractController
{
    /** @var VideoMapper $video_mapper */
    private $video_mapper;

    /** @var PlaylistMapper $playlist_mapper */
    private $playlist_mapper;

    /** @var Resolver $resolver */
    private $resolver;

    public function __construct(VideoMapper $video_mapper, PlaylistMapper $playlist_mapper, Resolver $resolver)
    {
        $this->video_mapper = $video_mapper;
        $this->playlist_mapper = $playlist_mapper;
        $this->resolver = $resolver;
    }

    public function indexAction($discipline_slug, $playlist_slug, $video_slug)
    {
        $video_criteria = ['urlSlug' => $video_slug];
        /** @var Video $video */
        $video = $this->getDoctrine()->getRepository(Video::class)->findOneBy($video_criteria);

        if ($video === null || empty($video)) {
            throw new NotFoundHttpException();
        }

        $true_discipline_slug = $video->getPlaylist()->getDiscipline()->getUrlSlug();
        $true_playlist_slug = $video->getPlaylist()->getUrlSlug();

        $parameters = [
            'discipline_slug' => $true_discipline_slug,
            'playlist_slug' => $true_playlist_slug,
            'video_slug' => $video->getUrlSlug()
        ];

        if ($discipline_slug !== $true_discipline_slug) {
            return $this->redirectToRoute('video', $parameters);
        }

        if ($playlist_slug !== $true_playlist_slug) {
            return $this->redirectToRoute('video', $parameters);
        }

        $previous_video = $this->resolver->getPreviousVideo($video->getPlaylistId(), $video->getSortWeight());
        $next_video = $this->resolver->getNextVideo($video->getPlaylistId(), $video->getSortWeight());
        $playlist = $this->playlist_mapper->mapOne($video->getPlaylist());

        parse_str(parse_url($video->getYoutubeUrl(), PHP_URL_QUERY), $youtube_video_url);
        $video = $this->video_mapper->mapOne($video);

        $data = [
            'video' => $video,
            'playlist' => $playlist,
            'youtube_video_url' => $youtube_video_url['v'],
            'previous_video' => $previous_video,
            'next_video' => $next_video,
            'discipline_slug' => $discipline_slug
        ];

        return $this->render('video/index.html.twig', $data);
    }
}
