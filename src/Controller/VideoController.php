<?php

namespace App\Controller;

use App\Logic\Common\FormattedMathResolver;
use App\Logic\Video\Mapper as VideoMapper;
use App\Logic\Playlist\Mapper as PlaylistMapper;
use App\Entity\Video;
use App\Logic\Video\Resolver;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityNotFoundException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class VideoController extends AbstractController
{
    private VideoMapper $video_mapper;
    private PlaylistMapper $playlist_mapper;
    private Resolver $resolver;
    private FormattedMathResolver $math_resolver;
    private EntityManagerInterface $em;

    public function __construct(
        VideoMapper $video_mapper,
        PlaylistMapper $playlist_mapper,
        Resolver $resolver,
        FormattedMathResolver $math_resolver,
        EntityManagerInterface $em
    ) {
        $this->video_mapper = $video_mapper;
        $this->playlist_mapper = $playlist_mapper;
        $this->resolver = $resolver;
        $this->math_resolver = $math_resolver;
        $this->em = $em;
    }

    public function indexAction($discipline_slug, $playlist_slug, $video_slug)
    {
        $video_criteria = ['urlSlug' => $video_slug];
        /** @var Video $video */
        $video = $this->em->getRepository(Video::class)->findOneBy($video_criteria);

        if (empty($video)) {
            throw new NotFoundHttpException();
        }

        try {
            $true_discipline_slug = $video->getPlaylist()->getDiscipline()->getUrlSlug();
            $true_playlist_slug = $video->getPlaylist()->getUrlSlug();
        } catch (EntityNotFoundException $e) {
            throw new NotFoundHttpException();
        }

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
        $mapped_video = $this->video_mapper->mapOne($video);


        $data = [
            'video' => $mapped_video,
            'playlist' => $playlist,
            'youtube_video_url' => $youtube_video_url['v'],
            'previous_video' => $previous_video,
            'next_video' => $next_video,
            'discipline_slug' => $discipline_slug,
            'load_mathjax' => $this->math_resolver->hasFormattedMath($video),
        ];

        return $this->render('video/index.html.twig', $data);
    }
}
