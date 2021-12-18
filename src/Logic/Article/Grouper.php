<?php

namespace App\Logic\Article;

use App\Entity\Discipline;

class Grouper
{
    public function groupByDisciplineId(array $articles, array $disciplines): array
    {
        $indexed_disciplines = [];
        foreach ($disciplines as $discipline) {
            $indexed_disciplines[$discipline->getId()] = $discipline;
        }

        $callback = function (Discipline $discipline) {
            return [
                'id' => $discipline->getId(),
                'name' => $discipline->getName(),
                'sort_weight' => $discipline->getSortWeight(),
                'articles' => [],
                'url_slug' => $discipline->getUrlSlug()
            ];
        };

        $grouped = array_map($callback, $indexed_disciplines);

        foreach ($articles as $article) {
            $grouped[$article["discipline_id"]]["articles"][] = $article;
        }

        foreach ($grouped as $key => $discipline) {
            if (empty($discipline['articles'])) {
                unset($grouped[$key]);
            }
        }

        return $grouped;
    }
}
