<?php
namespace chess;
use chess\figures\Figure;

include_once 'chess/ChessBoard.php';
include_once 'chess/figures/figures.php';

class Slon extends Figure
{
    private array $_lst = [];

    public function getAllowCells(string $column, int $row):array
    {
        $movementShifts = [
            [
                ['column' => -1, 'row' => 1],
                ['column' => -2, 'row' => 2],
                ['column' => -3, 'row' => 3],
                ['column' => -4, 'row' => 4],
                ['column' => -5, 'row' => 5],
                ['column' => -6, 'row' => 6],
                ['column' => -7, 'row' => 7],
            ],
            [
                ['column' => 1, 'row' => 1],
                ['column' => 2, 'row' => 2],
                ['column' => 3, 'row' => 3],
                ['column' => 4, 'row' => 4],
                ['column' => 5, 'row' => 5],
                ['column' => 6, 'row' => 6],
                ['column' => 7, 'row' => 7],
            ],
            [
                ['column' => -1, 'row' => -1],
                ['column' => -2, 'row' => -2],
                ['column' => -3, 'row' => -3],
                ['column' => -4, 'row' => -4],
                ['column' => -5, 'row' => -5],
                ['column' => -6, 'row' => -6],
                ['column' => -7, 'row' => -7],
            ],
            [
                ['column' => 1, 'row' => -1],
                ['column' => 2, 'row' => -2],
                ['column' => 3, 'row' => -3],
                ['column' => 4, 'row' => -4],
                ['column' => 5, 'row' => -5],
                ['column' => 6, 'row' => -6],
                ['column' => 7, 'row' => -7],
            ]
        ];
        foreach($movementShifts as $movementShift)
        {
            foreach ($movementShift as $move) 
            {
                $cell = (new ChessBoard)->isCellExist($row, $column, $move['row'], $move['column']);
                if ($cell) {
                    $this->_lst[] = $cell;
                }
                else{
                    break;
                }
            }
        }
        return $this->_lst;        
    }
}