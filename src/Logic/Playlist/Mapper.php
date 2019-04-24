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
            return [
                'id' => $playlist->getId(),
                'url_slug' => $playlist->getUrlSlug(),
                'name' => $playlist->getName()
            ];
        };

        return array_map($map, $playlists);
    }
}
