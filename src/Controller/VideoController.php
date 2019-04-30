<?php

namespace App\Controller;

use App\Logic\Video\Mapper as VideoMapper;
use App\Entity\Video;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class VideoController extends AbstractController
{
    /** @var VideoMapper $video_mapper */
    private $video_mapper;

    public function __construct(VideoMapper $video_mapper)
    {
        $this->video_mapper = $video_mapper;
    }

    public function indexAction($discipline_slug, $playlist_slug, $video_slug)
    {
        $video_criteria = ['urlSlug' => $video_slug];
        /** @var Video $video */
        $video = $this->getDoctrine()->getRepository(Video::class)->findOneBy($video_criteria);
        parse_str(parse_url($video->getYoutubeUrl(), PHP_URL_QUERY), $youtube_video_url);
        $video = $this->video_mapper->mapOne($video);

        $data = [
            'video' => $video,
            'youtube_video_url' => $youtube_video_url['v']
        ];

        return $this->render('video/index.html.twig', $data);
    }
}