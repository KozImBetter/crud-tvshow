<?php

namespace Entity\Collection;

use Database\MyPdo;
use Entity\Season;
use PDO;


class SeasonCollection
{
    public static function findByTvShowId(int $tvShowId): array
    {
        $season = MyPDO::getInstance()->prepare(
            <<<'SQL'
            SELECT id, name, tvShowId, seasonNumber, posterId
            FROM season
            WHERE tvShowId = :tvShowId
            ORDER BY name
            SQL
        );

        $season->execute([':tvShowId' => $tvShowId]);

        return $season->fetchAll(PDO::FETCH_CLASS, Season::class);
    }
}