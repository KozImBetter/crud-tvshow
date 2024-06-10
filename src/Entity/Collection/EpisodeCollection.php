<?php

declare(strict_types=1);

namespace Entity\Collection;

use Database\MyPdo;
use Entity\Episode;
use PDO;

class EpisodeCollection
{
    /**
     * @param int $seasonId
     * @return Episode[]
     */
    public static function findBySeasonId(int $seasonId): array
    {
        $episodes = MyPDO::getInstance()->prepare(
            <<<'SQL'
            SELECT id, seasonId, name, overview, episodeNumber
            FROM episode
            WHERE seasonId = :seasonId
            ORDER BY episodeNumber
SQL
        );
        $episodes->execute([':seasonId' => $seasonId]);

        return $episodes->fetchAll(PDO::FETCH_CLASS, Episode::class);
    }
}
