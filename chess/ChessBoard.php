<?php
namespace chess;
use chess\contrDB\ContrDB;

include_once 'chess/contrDB/contrDB.php';

include_once 'chess/figures/king.php';
include_once 'chess/figures/horse.php';
include_once 'chess/figures/ladye.php';
include_once 'chess/figures/peshka.php';
include_once 'chess/figures/slon.php';
include_once 'chess/figures/queen.php';

class ChessBoard 
{

    private array $_columnsList = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H'];
    private array $_rowList = [8, 7, 6, 5, 4, 3, 2, 1];
    private King $_king;
    private Queen $_queen;
    private Ladye $_ladyeLeft;
    private Ladye $_ladyeRight;
    private Horse $_horseLeft;
    private Horse $_horseRight;
    private Slon $_slonLeft;
    private Slon $_slonRight;
    private Peshka $_peshkaA;
    private Peshka $_peshkaB;
    private Peshka $_peshkaC;
    private Peshka $_peshkaD;
    private Peshka $_peshkaE;
    private Peshka $_peshkaF;
    private Peshka $_peshkaG;
    private Peshka $_peshkaH;
     
    public function __construct()
    {
        $this->_king = new King('king');
        $this->_queen = new Queen('queen');
        $this->_slonLeft = new Slon('slonLeft');
        $this->_slonRight = new Slon('slonRight');
        $this->_horseLeft = new Horse('horseLeft');
        $this->_horseRight = new Horse('horseRight');
        $this->_ladyeLeft = new Ladye('ladyeLeft');
        $this->_ladyeRight = new Ladye('ladyeRight');
        $this->_peshkaA = new Peshka('PeshkaA');
        $this->_peshkaB = new Peshka('PeshkaB');
        $this->_peshkaC = new Peshka('PeshkaC');
        $this->_peshkaD = new Peshka('PeshkaD');
        $this->_peshkaE = new Peshka('PeshkaE');
        $this->_peshkaF = new Peshka('PeshkaF');
        $this->_peshkaG = new Peshka('PeshkaG');
        $this->_peshkaH = new Peshka('PeshkaH');
    }

    public function getKing(): King {
        return $this->_king;
    }

    public function getQueen(): Queen {
        return $this->_queen;
    }

    public function getSlonLeft(): Slon {
        return $this->_slonLeft; 
    }

    public function getSlonRight(): Slon {
        return $this->_slonRight;
    }

    public function getHorseLeft(): Horse {
        return $this->_horseLeft;
    }

    public function getHorseRight(): Horse {
        return $this->_horseRight;
    }

    public function getLadyeLeft(): Ladye {
        return $this->_ladyeLeft;
    }

    public function getLadyeRight(): Ladye {
        return $this->_ladyeRight;
    }

    public function getPeshkaA(): Peshka {
        return $this->_peshkaA;
    }

    public function getPeshkaB(): Peshka {
        return $this->_peshkaB;
    }

    public function getPeshkaC(): Peshka {
        return $this->_peshkaC;
    }

    public function getPeshkaD(): Peshka {
        return $this->_peshkaD;
    }

    public function getPeshkaE(): Peshka {
        return $this->_peshkaE;
    }

    public function getPeshkaF(): Peshka {
        return $this->_peshkaF;
    }

    public function getPeshkaG(): Peshka {
        return $this->_peshkaG;
    }

    public function getPeshkaH(): Peshka {
        return $this->_peshkaH;
    }

    public function getColumnsList(): array 
    {
        return $this->_columnsList;
    }

    public function getRowList(): array
    {
        return $this->_rowList;
    }

    public function ShiftFigure(string $column, int $row, $figure): void
    {
        $movementList = $figure->getAllowCells($figure->getCoordinate()[0], $figure->getCoordinate()[1]);
        if($movementList){
            foreach($movementList as $move){
                if($move['column'] == $column && $move['row'] == $row){
                    $figure->setCoordinate($column, $row);
                    break;
                }
            }
        }
    }

    public function getFigures() 
    {
        $figures = ContrDB::getAllDate('chessmoves');
        return $figures;
    }

    public function isCellExist($currentRow, $currentCol, $shiftRow, $shiftCol):?array
    {
        $currentRowIndex = 0;
        $currentColIndex = 0;

        foreach($this->getRowList() as $index => $row)
        {
            if($currentRow == $row)
            {
                $currentRowIndex = $index;
                break;
            }
        }

        foreach($this->getColumnsList() as $index => $column)
        {
            if($currentCol == $column)
            {
                $currentColIndex = $index;
                break;
            }
        }

        $shiftRowIndex = $currentRowIndex + $shiftRow;
        $shiftColIndex = $currentColIndex + $shiftCol;

        if($shiftRowIndex < count($this->getRowList()) && $shiftRowIndex > -1)
        {
            if($shiftColIndex < count($this->getColumnsList()) && $shiftColIndex > -1)
            {
                $column = $this->getColumnsList()[$shiftColIndex];
                $row = $this->getRowList()[$shiftRowIndex];
                foreach ($this->getFigures() as $figure) {
                    if ($column == $figure['col_fig'] && $row == $figure['row_fig']) {
                        return null;
                    }
                }
                return [
                    'column' => $column,
                    'row' => $row
                ];
            }
        }
        return null;
    }
}



?>