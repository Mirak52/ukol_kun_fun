<?php


namespace App\Entity;


class ChessSquere
{
    /** @var array|string  */
    private $x;

    /** @var int */
    private $y;

    public function __construct(string|array $x, int $y)
    {
        $this->x = $x;
        $this->y = $y;
    }
    //twig template
    public function getX(): string|array
    {
        return $this->x;
    }

    public function getY(): int
    {
        return $this->y;
    }
}