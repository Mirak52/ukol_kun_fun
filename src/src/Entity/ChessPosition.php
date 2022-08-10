<?php

namespace App\Entity;

class ChessPosition
{
    /** @var string */
    private $start_x;

    /** @var int */
    private $start_y;

    /** @var string */
    private $end_x;

    /** @var int */
    private $end_y;

    public function getStartX(): string
    {
        return $this->start_x;
    }

    public function setStartX(string $start_x): void
    {
        $this->start_x = $start_x;
    }

    public function getStartY(): int
    {
        return $this->start_y;
    }

    public function setStartY(int $start_y): void
    {
        $this->start_y = $start_y;
    }

    public function getEndX(): string
    {
        return $this->end_x;
    }

    public function setEndX(string $end_x): void
    {
        $this->end_x = $end_x;
    }

    public function getEndY(): int
    {
        return $this->end_y;
    }

    public function setEndY(int $end_y): void
    {
        $this->end_y = $end_y;
    }
}
