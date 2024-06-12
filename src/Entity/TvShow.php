<?php

declare(strict_types=1);

namespace Entity;

use Database\MyPdo;

use PDO;

use function React\Promise\all;

class TvShow
{
    private ?int $id;
    private string $name;
    private string $originalName;
    private string $homepage;
    private string $overview;
    private int $posterId;
    public function getId(): ?int
    {
        return $this->id;
    }
    private function setId(?int $id): TvShow
    {
        $this->id = $id;
        return $this;
    }
    public function getName(): string
    {
        return $this->name;
    }
    public function setName(string $name): TvShow
    {
        $this->name = $name;
        return $this;
    }
    public function getOriginalName(): string
    {
        return $this->originalName;
    }
    public function setOriginalName(string $originalName): TvShow
    {
        $this->originalName = $originalName;
        return $this;
    }
    public function getHomepage(): string
    {
        return $this->homepage;
    }
    public function setHomepage(string $homepage): TvShow
    {
        $this->homepage = $homepage;
        return $this;
    }
    public function getOverview(): string
    {
        return $this->overview;
    }
    public function setOverview(string $overview): TvShow
    {
        $this->overview = $overview;
        return $this;
    }
    public function getPosterId(): int
    {
        return $this->posterId;
    }
    public function setPosterId(int $posterId): TvShow
    {
        $this->posterId = $posterId;
        return $this;
    }

    public static function findById(int $id): TvShow
    {
        $stmtTvShow = MyPDO::getInstance()->prepare(
            <<<'SQL'
    SELECT id, name, originalName, homepage, overview, posterId
    FROM tvshow 
    WHERE id = :tvshowId
SQL
        );

        $stmtTvShow->execute([':tvshowId' => $id]);

        if (($season = $stmtTvShow->fetchObject(TvShow::class)) === false) {
            throw new Exception\EntityNotFoundException();
        }
        return $season;
    }

    public function delete(): TvShow
    {
        $deleteTvShow = MyPdo::getInstance()->prepare(
            <<<SQL
DELETE FROM tvshow
WHERE id = :tvShowId
SQL
        );
        $deleteTvShow->execute([':tvShowId' => $this->getId()]);
        $this->setId(null);
        return $this;
    }

    public function update(): TvShow
    {
        $saveTvShow = MyPdo::getInstance()->prepare(
            <<<SQL
UPDATE tvshow
SET id = :id,
    name = :name,
    originalName = :originalName,
    homepage = :homepage,
    overview = :overview,
    posterId = :posterId
WHERE id = :id
SQL
        );
        $saveTvShow->execute([':id' => $this->getId(), ':name' => $this->getName(), ':originalName' => $this->getOriginalName(),
            ':homepage' => $this->getHomepage(), ':overview' => $this->getOverview(), ':posterId' => $this->getPosterId()]);
        return $this;
    }

    public static function create(string $name, string $originalName, string $homepage, string $overview, int $posterId, ?int $id): TvShow
    {
        $tvShow = new TvShow();
        $tvShow->setName($name);
        $tvShow->setOriginalName($originalName);
        $tvShow->setHomepage($homepage);
        $tvShow->setOverview($overview);
        $tvShow->setPosterId($posterId);
        if (isset($id)) {
            $tvShow->setId($id);
        }
        return $tvShow;
    }

    protected function insert(): TvShow
    {
        $insertTvShow = MyPdo::getInstance()->prepare(
            <<<SQL
INSERT INTO tvshow
VALUES (:id,:name,:originalName,:homepage,:overview,:posterId)
SQL
        );
        $insertTvShow->execute([':id' => $this->getId(), ':name' => $this->getName(), ':originalName' => $this->getOriginalName(),
            ':homepage' => $this->getHomepage(), ':overview' => $this->getOverview(), ':posterId' => $this->getPosterId()]);
        $this->setId(intval((MyPdo::getInstance()->lastInsertId())));
        return $this;
    }

    public function save(): TvShow
    {
        if ($this->getId() === null) {
            $this->insert();
        } else {
            $this->update();
        }

        return $this;
    }

}
