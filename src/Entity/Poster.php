<?php

namespace Entity;

use Database\MyPdo;

class Poster
{
    private int $id;
    private string $jpeg;

    public function getId(): int
    {
        return $this->id;
    }

    public function getJpeg(): string
    {
        return $this->jpeg;
    }
    public static function findById(int $id): Poster
    {
        $stmtPoster = MyPDO::getInstance()->prepare(
            <<<'SQL'
    SELECT id, name
    FROM artist 
    WHERE id = :posterId
SQL
        );

        $stmtPoster->execute([':posterId' => $id]);

        if (($poster = $stmtPoster->fetchObject(Poster::class)) === false) {
            throw new Exception\EntityNotFoundException();
        }
        return $poster;
    }
}