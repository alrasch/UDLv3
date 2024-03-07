<?php

namespace App\Logic\Discipline;

use App\Entity\Discipline;

class Mapper
{
    public function mapDisciplines(array $disciplines): array
    {
        $map = function (Discipline $discipline) {
            return $this->mapHome($discipline);
        };

        return array_map($map, $disciplines);
    }

    public function mapHome(Discipline $discipline): array
    {
        return [
            'name' => $discipline->getName(),
            'url_slug' => $discipline->getUrlSlug(),
            'playlists' => $discipline->getPlaylists()
        ];
    }

    public function mapOne(Discipline $discipline): array
    {
        return [
            'playlists' => $discipline->getPlaylists(),
            'name' => $discipline->getName(),
            'url_slug' => $discipline->getUrlSlug(),
            'description' => $discipline->getShortDescription()
        ];
    }
}
