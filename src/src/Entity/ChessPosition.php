<?php

namespace App\Entity;

use App\Repository\ChessPositionRepository;
use Doctrine\ORM\Mapping as ORM;

class ChessPosition
{

    private $start_x;

    private $start_y;

    private $end_x;

    private $end_y;

    /**
     * @return mixed
     */
    public function getStartX()
    {
        return $this->start_x;
    }

    /**
     * @param mixed $start_x
     */
    public function setStartX($start_x): void
    {
        $this->start_x = $start_x;
    }

    /**
     * @return mixed
     */
    public function getStartY()
    {
        return $this->start_y;
    }

    /**
     * @param mixed $start_y
     */
    public function setStartY($start_y): void
    {
        $this->start_y = $start_y;
    }

    /**
     * @return mixed
     */
    public function getEndX()
    {
        return $this->end_x;
    }

    /**
     * @param mixed $end_x
     */
    public function setEndX($end_x): void
    {
        $this->end_x = $end_x;
    }

    /**
     * @return mixed
     */
    public function getEndY()
    {
        return $this->end_y;
    }

    /**
     * @param mixed $end_y
     */
    public function setEndY($end_y): void
    {
        $this->end_y = $end_y;
    }

}
