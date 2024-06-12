<?php

namespace Entity;

use Database\MyPdo;
use PDO;

class Genre
{
    private int $id;
    private string $name;
    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }
    public static function findById(int $genreId): Genre
    {
        $stmtGenre = MyPDO::getInstance()->prepare(
            <<<'SQL'
            SELECT id, name
            FROM genre
            WHERE id = :genreId
            SQL
        );

        $stmtGenre->execute([':genreId' => $genreId]);

        if (($genre = $stmtGenre->fetchObject(Genre::class)) === false) {
            throw new Exception\EntityNotFoundException();
        }
        return $genre;
    }
}
