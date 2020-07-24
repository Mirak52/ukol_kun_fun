<?php
namespace App\model;


use App\Entity\ChessPosition;
use ContainerBPNXIp6\getVarDumper_Command_ServerDumpService;
use Symfony\Component\Form\FormError;

class PathModel
{
    const STRING_TO_NUM = ["a"=> 1,
        "b"=> 2,
        "c"=> 3,
        "d"=> 4,
        "e"=> 5,
        "f"=> 6,
        "g"=> 7,
        "h"=> 8,
        ],
        POSSIBLE_MOVEMENT = [[2,1],[2,-1],[-2,1],[-2,-1],[1,2],[-1,2],[1,-2],[-1,-2]];

    public function checkDataInput(ChessPosition $chessPositon): bool
    {
        if( !(0 < $chessPositon->getStartY() && $chessPositon->getStartY() < 8) || !(0 < $chessPositon->getEndY() && $chessPositon->getEndY() < 8 )){
            return false;
        }

        foreach ((array)$chessPositon as $positon){
            if(strlen($positon) !== 1){
                return false;
            }
        }
        if($this->isValid(strtoupper($chessPositon->getStartX())) || $this->isValid(strtoupper($chessPositon->getEndX()))){
            return false;
        }

        return true;
    }

    public function solveFastestPath(ChessPosition $chessPosition):array
    {
        $chessPosition->setStartX(self::STRING_TO_NUM[strtolower($chessPosition->getStartX())]);
        $chessPosition->setEndX(self::STRING_TO_NUM[strtolower($chessPosition->getEndX())]);
        $chessPosition->setStartY((int) $chessPosition->getStartY());
        $chessPosition->setEndY((int) $chessPosition->getEndY());


        $possiblePaths = $this->getPossiblePaths($chessPosition->getStartX(), $chessPosition->getStartY());
        $shortestPath = $this->getShortestPath($chessPosition);
    }


    function isValid($str) {
        return preg_match('/[^A-H]/', $str);
    }

    private function getPossiblePaths(int $start_x,int $start_y):array
    {

        $possiblePath = [];
        foreach (self::POSSIBLE_MOVEMENT as $possibleMovement){
            $x = $start_x + $possibleMovement[0];
            $y = $start_y + $possibleMovement[1];
            if( 0 < $x && $x < 9 ){
                if( 0 < $y && $y < 9 ){;
                    $possiblePath[] = $x.$y;
                }
            }
        }

        return $possiblePath;
    }

    private function getShortestPath(ChessPosition $chessPosition)
    {
        $possiblePaths = $this->getPossiblePaths($chessPosition->getStartX(), $chessPosition->getStartY());
        $havePath = true;
        $i = 0;
        $visited = [];
        while($havePath){
            foreach ($possiblePaths as $path){
                $visited[$i][] = $path;

            }

            $i++;

            dd($visited);
        }

    }
}
