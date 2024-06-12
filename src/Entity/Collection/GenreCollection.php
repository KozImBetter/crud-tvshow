<?php

declare(strict_types=1);

namespace Entity\Collection;

use Database\MyPdo;
use Entity\Genre;
use PDO;

class GenreCollection
{
    /** Méthode retournant un tableau contenant tous les genres
     * triés par ordre alphabétique.
     * @return Genre[]
     */
    public static function findAll(): array
    {
        $genre = MyPDO::getInstance()->prepare(
            <<<'SQL'
SELECT id, name
FROM genre
ORDER BY name
SQL
        );

        $genre->execute();

        return $genre->fetchAll(PDO::FETCH_CLASS, Genre::class);
    }
}
