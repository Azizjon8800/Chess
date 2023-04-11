<?php
namespace chess;
use chess\figures\Figure;

include_once 'chess/ChessBoard.php';
include_once 'chess/figures/figures.php';

class Peshka extends Figure
{
    private array $_lst = [];

    public function getAllowCells(string $column, int $row):array
    {
        $movementShifts = [
            ['column' => 0, 'row' => -1]
        ];
        foreach($movementShifts as $movementShift)
        {
            $cell = (new ChessBoard)->isCellExist($row, $column, $movementShift['row'], $movementShift['column']);
            if($cell)
            {
                $this->_lst[] = $cell;
            }
        }
        return $this->_lst;
    }
}