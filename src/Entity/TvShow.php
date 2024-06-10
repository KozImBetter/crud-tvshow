<?php

declare(strict_types=1);

namespace Entity;

use Database\MyPdo;

class TvShow
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
    public static function findById(int $id): TvShow
    {
        $stmtTvShow = MyPDO::getInstance()->prepare(
            <<<'SQL'
    SELECT id, name
    FROM tvshow 
    WHERE id = :tvshowId
SQL
        );

        $stmtTvShow->execute([':posterId' => $id]);

        if (($season = $stmtTvShow->fetchObject(TvShow::class)) === false) {
            throw new Exception\EntityNotFoundException();
        }
        return $season;
    }
}
