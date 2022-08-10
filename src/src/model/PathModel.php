<?php

namespace App\model;

use App\Entity\ChessPosition;
use App\Entity\ChessSquere;

class PathModel
{
    private const STRING_TO_NUM = [
        "a" => 1,
        "b" => 2,
        "c" => 3,
        "d" => 4,
        "e" => 5,
        "f" => 6,
        "g" => 7,
        "h" => 8,
    ];
    private const NUM_TO_STRING = [
        1 => "a",
        2 => "b",
        3 => "c",
        4 => "d",
        5 => "e",
        6 => "f",
        7 => "g",
        8 => "h",
    ];
    private const POSSIBLE_MOVEMENT = [
        [2, 1], [2, -1], [-2, 1], [-2, -1], [1, 2], [-1, 2], [1, -2], [-1, -2] //jump like horse
    ];

    public function checkDataInput(ChessPosition $chessPositon): bool
    {
        if (!(0 < $chessPositon->getStartY() && $chessPositon->getStartY() <= 8) || !(0 < $chessPositon->getEndY() && $chessPositon->getEndY() <= 8)) {
            return false;
        }

        foreach ((array)$chessPositon as $positon) {
            if (strlen($positon) !== 1) {
                return false;
            }
        }
        if ($this->isValid(strtoupper($chessPositon->getStartX())) || $this->isValid(strtoupper($chessPositon->getEndX()))) {
            return false;
        }
        return true;
    }

    function isValid($str)
    {
        return preg_match('/[^A-H]/', $str);
    }

    public function getFastestPath(ChessPosition $chessPosition): array
    {
        $path = $this->findFastestPath($chessPosition);
        $path[3] = ltrim($path[3], ",");
        $explodedPaths = explode(",", $path[3]);
        $objectPathArray = [];

        $objectPathArray[1][] = new ChessSquere($chessPosition->getStartX(), $chessPosition->getStartY());
        foreach ($explodedPaths as $explodedPath) {
            $objectPathArray[0][] = new ChessSquere(PathModel::NUM_TO_STRING[$explodedPath[0]], $explodedPath[1]);
            $objectPathArray[1][] = new ChessSquere([$explodedPath[0]], $explodedPath[1]);
        }
        return $objectPathArray;
    }

    private function findFastestPath(ChessPosition $chessPosition): array
    {
        $chessPosition->setStartX(self::STRING_TO_NUM[strtolower($chessPosition->getStartX())]);
        $chessPosition->setEndX(self::STRING_TO_NUM[strtolower($chessPosition->getEndX())]);
        $chessPosition->setStartY($chessPosition->getStartY());
        $chessPosition->setEndY($chessPosition->getEndY());

        $queue[] = [$chessPosition->getStartX(), $chessPosition->getStartY(), 0, null];
        $visited[$chessPosition->getStartX() . $chessPosition->getStartY()] = 0;
        while (count($queue) > 0) {
            $coord = $queue[array_key_first($queue)];
            unset($queue[array_key_first($queue)]);
            if ($coord[0] == $chessPosition->getEndX() && $coord[1] == $chessPosition->getEndY()) {
                break;
            }
            $possiblePaths = $this->getPossiblePaths($coord[0], $coord[1]);
            foreach ($possiblePaths as $path) {
                if (!isset($visited[$path[0] . $path[1]])) {
                    $visited[$path[0] . $path[1]] = $coord[2] + 1;
                    $queue[] = [$path[0], $path[1], $coord[2] + 1, $coord[3] . "," . $path[0] . $path[1]];
                }
            }
        }
        return $coord;
    }

    private function getPossiblePaths(int $start_x, int $start_y): array
    {
        $possiblePath = [];
        foreach (self::POSSIBLE_MOVEMENT as $possibleMovement) {
            $x = $start_x + $possibleMovement[0];
            $y = $start_y + $possibleMovement[1];
            if (0 < $x && $x < 9) {
                if (0 < $y && $y < 9) {
                    $possiblePath[] = $x . $y;
                }
            }
        }
        return $possiblePath;
    }
}
