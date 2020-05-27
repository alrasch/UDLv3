<?php

namespace App\Logic\Article;

use App\Entity\Article;
use App\Entity\Discipline;

class Grouper
{
    /**
     * @param Article[] $articles
     */
    private function getUniqueDisciplineIds(array $articles)
    {
        $unique_discipline_ids = [];

        foreach ($articles as $article) {
            if (!in_array($article->getDisciplineId(), $unique_discipline_ids)) {
                $unique_discipline_ids[] = $article->getDisciplineId();
            }
        }

        return $unique_discipline_ids;
    }

    /**
     * @param Article[] $articles
     * @param Discipline[] $disciplines
     */
    public function groupByDisciplineId(array $articles, array $disciplines)
    {
        $indexed_disciplines = [];
        foreach ($disciplines as $discipline) {
            $indexed_disciplines[$discipline->getId()] = $discipline;
        }

        $callback = function (Discipline $discipline) {
            return [
                'id' => $discipline->getId(),
                'name' => $discipline->getName(),
                'articles' => $discipline->getArticles()->getValues(),
            ];
        };

        $grouped = array_map($callback, $indexed_disciplines);

        foreach ($grouped as $key => $discipline) {
            if (empty($discipline['articles'])) {
                unset($grouped[$key]);
            }
        }

        dump($grouped);

        return $grouped;
    }
}
