<?php

namespace Entity;

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

}