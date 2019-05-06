<?php

namespace App\Logic\Playlist;

use App\Entity\Playlist;
use Doctrine\Common\Collections\ArrayCollection;

class Mapper
{
    /**
     * @param ArrayCollection|Playlist[] $playlists
     */
    public function mapPlaylists($playlists): array
    {
        $map = function (Playlist $playlist) {
            return $this->mapOne($playlist);
        };

        return array_map($map, $playlists);
    }

    public function mapOne(Playlist $playlist): array
    {
        return [
            'id' => $playlist->getId(),
            'url_slug' => $playlist->getUrlSlug(),
            'name' => $playlist->getName(),
        ];
    }

    public function mapOneWithRelations(Playlist $playlist): array
    {
        return [
            'id' => $playlist->getId(),
            'url_slug' => $playlist->getUrlSlug(),
            'name' => $playlist->getName(),
            'discipline' => $playlist->getDiscipline(),
            'videos' => $playlist->getVideos(),
            'description' => $playlist->getShortDescription(),
        ];
    }
}
