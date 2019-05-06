<?php

namespace App\Logic\Discipline;

use App\Entity\Discipline;

class Mapper
{
    /**
     * @param array|Discipline[] $disciplines
     */
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
