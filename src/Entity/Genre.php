<?php

namespace Entity;

use Database\MyPdo;
use PDO;

class Genre
{
    private int $id;
    private string $name;

    public static function findById(int $genreId) : array {
        $genre = MyPDO::getInstance()->prepare(
            <<<'SQL'
            SELECT id, name
            FROM genre
            WHERE id = :genreId
            ORDER BY name
            SQL
        );

        $genre->execute([':genreId' => $genreId]);

        return $genre->fetchAll(PDO::FETCH_CLASS, genre::class);
    }
}