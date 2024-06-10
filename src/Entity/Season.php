<?php

declare(strict_types=1);

namespace Entity;

use Database\MyPdo;

class Season
{
    private int $id;
    private int $tvShowId;
    private string $name;
    private int $seasonNumber;
    private int $posterId;

    public function getId(): int
    {
        return $this->id;
    }
    public function getTvShowId(): int
    {
        return $this->tvShowId;
    }
    public function getName(): string
    {
        return $this->name;
    }
    public function getSeasonNumber(): int
    {
        return $this->seasonNumber;
    }
    public function getPosterId(): int
    {
        return $this->posterId;
    }

    public static function findById(int $id): Season
    {
        $stmtSeason = MyPDO::getInstance()->prepare(
            <<<'SQL'
    SELECT id, tvShowId, name, seasonNumber, posterId
    FROM season 
    WHERE id = :seasonId
SQL
        );

        $stmtSeason->execute([':posterId' => $id]);

        if (($season = $stmtSeason->fetchObject(Season::class)) === false) {
            throw new Exception\EntityNotFoundException();
        }
        return $season;
    }
}
