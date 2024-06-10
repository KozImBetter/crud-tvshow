<?php

declare(strict_types=1);

namespace Entity\Collection;

use Database\MyPdo;
use Entity\TvShow;
use PDO;

class TvShowCollection
{
    /** Méthode retournant un tableau contenant tous les artistes
     * triés par ordre alphabétique.
     * @return TvShow[]
     */
    public static function findAll(): array
    {
        $artiste = MyPDO::getInstance()->prepare(
            <<<'SQL'
SELECT id, name
FROM tvshow
ORDER BY name
SQL
        );

        $artiste->execute();

        return $artiste->fetchAll(PDO::FETCH_CLASS, TvShow::class);
    }
}
