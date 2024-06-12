<?php

declare(strict_types=1);

namespace Entity\Collection;

use Database\MyPdo;
use Entity\TvShow;
use PDO;

class TvShowCollection
{
    /** Méthode retournant un tableau contenant tous les shows tv
     * triés par ordre alphabétique.
     * @return TvShow[]
     */
    public static function findAll(): array
    {
        $tvShow = MyPDO::getInstance()->prepare(
            <<<'SQL'
SELECT id, name, originalName, homepage, overview, posterId
FROM tvshow
ORDER BY name
SQL
        );

        $tvShow->execute();

        return $tvShow->fetchAll(PDO::FETCH_CLASS, TvShow::class);
    }

    /** Méthode retournant un tableau contenant tous les shows tv
     * d'un genre triés par ordre alphabétique.
     * @return array
     */
    public static function findByGenreId(int $genreId): array
    {
        $tvShow = MyPdo::getInstance()->prepare(
            <<<'SQL'
SELECT genreId, tvShowId
FROM tvshow_genre
WHERE genreid = :id
SQL
        );
        $tvShow->execute([':id' => $genreId]);
        return $tvShow->fetchAll();
    }
}
