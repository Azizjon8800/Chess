<?php
namespace chess\figures;
use chess\contrDB\ContrDB;

include_once 'chess/contrDB/contrDB.php';


abstract class Figure 
{
    private string $_name;

    public function __construct($_name) 
    {
        $this->_name = $_name;
    }
    
    public function getCoordinate():array
    {
        $coordinates = ContrDB::getByName($this->_name, 'chessmoves');
        return [$coordinates['col_fig'], $coordinates['row_fig']];
    }

    public function setCoordinate(string $column, int $row):void
    {
        ContrDB::updateCoordinate($column, $row, $this->_name, 'chessmoves');
    }

    abstract public function getAllowCells(string $column, int $row): array; 
}

?>