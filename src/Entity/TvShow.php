<?php

declare(strict_types=1);

namespace Entity;

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

}
