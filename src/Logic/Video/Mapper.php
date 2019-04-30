<?php

namespace App\Logic\Video;

use App\Entity\Video;
use Doctrine\Common\Collections\ArrayCollection;

class Mapper
{
    /** @param ArrayCollection|Video[] $videos */
    public function mapVideos($videos): array
    {
        $map = function (Video $video) {
            return [
                'id' => $video->getId(),
                'url_slug' => $video->getUrlSlug(),
                'name' => $video->getName()
            ];
        };

        return array_map($map, $videos);
    }

    public function mapOne(Video $video): array
    {
        return [
            'id' => $video->getId(),
            'url_slug' => $video->getUrlSlug(),
            'name' => $video->getName(),
            'description' => $video->getDescription(),
            'youtube_url' => $video->getYoutubeUrl()
        ];
    }
}
