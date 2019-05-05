<?php

namespace App\Logic\Video;

use App\Entity\Video;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\NativeQuery;
use Doctrine\ORM\Query\ResultSetMappingBuilder;

class Resolver
{
    /** @var EntityManager */
    protected $entity_manager;

    public function __construct(EntityManagerInterface $entity_manager)
    {
        $this->entity_manager = $entity_manager;
    }

    public function getPreviousVideo(int $playlist_id, int $sort_weight): ?Video
    {
        $base_query =
            'SELECT * FROM video v WHERE sort_weight < %s AND v.playlist_id = %s ORDER BY v.sort_weight DESC LIMIT 1';

        $previous_video = $this->runQuery($base_query, [$sort_weight, $playlist_id]);
        return $previous_video;
    }

    public function getNextVideo(int $playlist_id, int $sort_weight): ?Video
    {
        $base_query =
            'SELECT * FROM video v WHERE sort_weight > %s AND v.playlist_id = %s ORDER BY v.sort_weight ASC LIMIT 1';

        $next_video = $this->runQuery($base_query, [$sort_weight, $playlist_id]);
        return $next_video;

    }

    private function runQuery(string $base_query, array $parameters): ?Video
    {
        $rsm = new ResultSetMappingBuilder($this->entity_manager);
        $rsm->addRootEntityFromClassMetadata(Video::class, 'v');

        /** @var NativeQuery $query_builder */
        $query = vsprintf($base_query, $parameters);

        $query_builder = $this->entity_manager
            ->createNativeQuery($query, $rsm);

        $result = $query_builder->execute();

        return empty($result) ? null : $result[0];
    }
}
