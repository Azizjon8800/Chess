<?php
namespace chess\contrDB;
use chess\database\DB;

include_once 'chess/database/db.php';

abstract class ContrDB {
    public static function getAllDate($table)
    {
        $db = new DB();
        $sql = 'SELECT * FROM ' . $table . ';';
        return $db->query($sql, []);
    }
    public static function getByName($figureName, $table)
    {
        $db = new DB();
        $sql = 'SELECT * FROM ' . $table . ' WHERE FigureName=:FigureName;';
        $results = $db->query($sql, [':FigureName' => $figureName]);
        return $results[0];
        
    }

    public static function updateCoordinate($col_fig, $row_fig, $name, $table)
    {
        $db = new DB();
        $sql = 'UPDATE ' . $table . ' SET col_fig=:col_fig, row_fig=:row_fig WHERE FigureName=:name;';
        $db->query(
            $sql,
            [
                ':col_fig' => $col_fig,
                ':row_fig' => $row_fig,
                ':name' => $name
            ]
        );
        return true;
    }

    public static function insertData($figureName, $col_fig, $row_fig, $shape, $table)
    {
        $db = new DB();
        $sql = 'INSERT INTO ' . $table . ' SET
        FigureName=:figureName, col_fig=:col_fig, row_fig=:row_fig, shape=:shape';

        $db->query(
            $sql,
            [
                ':figureName' => $figureName,
                ':col_fig' => $col_fig,
                ':row_fig' => $row_fig,     
                ':shape' => $shape
            ]
        );
        return true;
    }

    public static function deleteData($id, $table) 
    {
        $db = new DB();
        $sql = 'DELETE FROM ' . $table . ' WHERE id=:id';
        $db->query($sql, [':id' => $id]);
        return true;
    }
}