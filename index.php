<?php 
namespace chess;
use chess\contrDB\ContrDB;

include_once 'chess/contrDB/contrDB.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chess</title>
    <style>
        .cell {
            width: 50px;
            height: 50px;
            border: 1px solid black;
            text-align: center;
            font-size: 35px;
        }

        .cell.active {
            background-color:  dimgray;
        }

        .black {
            background-color: black;
            color: white;
        }

        .move-allow {
            background-color: lightgray;
        }
    </style>
</head>
<body> 
    <form method="post">
        <p>Выберите фигуру
        <select name="figureName" size="1">
            <option value="king">Король</option>
            <option value="queen">Королева</option>
            <option value="slonLeft">Слон(Слева)</option>
            <option value="slonRight">Слон(Справа)</option>
            <option value="horseLeft">Конь(Слева)</option>
            <option value="horseRight">Конь(Справа)</option>
            <option value="ladyeLeft">Ладье(Слева)</option>
            <option value="ladyeRight">Ладье(Справа)</option>
            <option value="peshkaA">Пешка(A)</option>
            <option value="peshkaB">Пешка(B)</option>
            <option value="peshkaC">Пешка(C)</option>
            <option value="peshkaD">Пешка(D)</option>
            <option value="peshkaE">Пешка(E)</option>
            <option value="peshkaF">Пешка(F)</option>
            <option value="peshkaG">Пешка(G)</option>
            <option value="peshkaH">Пешка(H)</option>
        </select></p>
        <p>Введите ход: <input type="text" name="move"></p>
        <p><input type="submit" value="Отправить"></p>
    </form>
    <?php
    $table = 'chessmoves';
    $checkExist = ContrDB::getAllDate($table);
    if (count($checkExist) == 0) {
        ContrDB::insertData('king', 'D', 1, '&#9812;', $table);
        ContrDB::insertData('queen', 'E', 1, '&#9813;', $table);
        ContrDB::insertData('slonLeft', 'C', 1, '&#9815;', $table);
        ContrDB::insertData('slonRight', 'F', 1, '&#9815;', $table);
        ContrDB::insertData('horseLeft', 'B', 1, '&#9816;', $table);
        ContrDB::insertData('horseRight', 'G', 1, '&#9816;', $table);
        ContrDB::insertData('ladyeLeft', 'A', 1, '&#9814;', $table);
        ContrDB::insertData('ladyeRight', 'H', 1, '&#9814;', $table);
        
        ContrDB::insertData('PeshkaA', 'A', 2, '&#9817;', $table);
        ContrDB::insertData('PeshkaB', 'B', 2, '&#9817;', $table);
        ContrDB::insertData('PeshkaC', 'C', 2, '&#9817;', $table);
        ContrDB::insertData('PeshkaD', 'D', 2, '&#9817;', $table);
        ContrDB::insertData('PeshkaE', 'E', 2, '&#9817;', $table);
        ContrDB::insertData('PeshkaF', 'F', 2, '&#9817;', $table);
        ContrDB::insertData('PeshkaG', 'G', 2, '&#9817;', $table);
        ContrDB::insertData('PeshkaH', 'H', 2, '&#9817;', $table);
        
    }

    include_once 'chess/ChessBoard.php';
    $chessboard = new ChessBoard();
    
    

    if (empty($_POST['move']) && isset($_POST['figureName'])) {
        $figureName = $_POST['figureName'];
        switch ($figureName):
            case 'king';
                $fig = ['column' => $chessboard->getKing()->getCoordinate()[0], 'row' => $chessboard->getKing()->getCoordinate()[1]];
                $allowedCells = $chessboard->getKing()->getAllowCells($chessboard->getKing()->getCoordinate()[0], $chessboard->getKing()->getCoordinate()[1]);
                break;
            case 'queen';
                $fig = ['column' => $chessboard->getQueen()->getCoordinate()[0], 'row' => $chessboard->getQueen()->getCoordinate()[1]];
                $allowedCells = $chessboard->getQueen()->getAllowCells($chessboard->getQueen()->getCoordinate()[0], $chessboard->getQueen()->getCoordinate()[1]);
                break;
            case 'slonLeft';
                $fig = ['column' => $chessboard->getSlonLeft()->getCoordinate()[0], 'row' => $chessboard->getSlonLeft()->getCoordinate()[1]];
                $allowedCells = $chessboard->getSlonLeft()->getAllowCells($chessboard->getSlonLeft()->getCoordinate()[0], $chessboard->getSlonLeft()->getCoordinate()[1]);
                break;
            case 'slonRight';
                $fig = ['column' => $chessboard->getSlonRight()->getCoordinate()[0], 'row' => $chessboard->getSlonRight()->getCoordinate()[1]];
                $allowedCells = $chessboard->getSlonRight()->getAllowCells($chessboard->getSlonRight()->getCoordinate()[0], $chessboard->getSlonRight()->getCoordinate()[1]);
                break;
            case 'horseLeft';
                $fig = ['column' => $chessboard->getHorseLeft()->getCoordinate()[0], 'row' => $chessboard->getHorseLeft()->getCoordinate()[1]];
                $allowedCells = $chessboard->getHorseLeft()->getAllowCells($chessboard->getHorseLeft()->getCoordinate()[0], $chessboard->getHorseLeft()->getCoordinate()[1]);
                break;
            case 'horseRight';
                $fig = ['column' => $chessboard->getHorseRight()->getCoordinate()[0], 'row' => $chessboard->getHorseRight()->getCoordinate()[1]];
                $allowedCells = $chessboard->getHorseRight()->getAllowCells($chessboard->getHorseRight()->getCoordinate()[0], $chessboard->getHorseRight()->getCoordinate()[1]);
                break;
            case 'ladyeLeft';
                $fig = ['column' => $chessboard->getLadyeLeft()->getCoordinate()[0], 'row' => $chessboard->getLadyeLeft()->getCoordinate()[1]];
                $allowedCells = $chessboard->getLadyeLeft()->getAllowCells($chessboard->getLadyeLeft()->getCoordinate()[0], $chessboard->getLadyeLeft()->getCoordinate()[1]);
                break;
            case 'ladyeRight';
                $fig = ['column' => $chessboard->getLadyeRight()->getCoordinate()[0], 'row' => $chessboard->getLadyeRight()->getCoordinate()[1]];
                $allowedCells = $chessboard->getLadyeRight()->getAllowCells($chessboard->getLadyeRight()->getCoordinate()[0], $chessboard->getLadyeRight()->getCoordinate()[1]);
                break;
            case 'peshkaA';
                $fig = ['column' => $chessboard->getPeshkaA()->getCoordinate()[0], 'row' => $chessboard->getPeshkaA()->getCoordinate()[1]];
                $allowedCells = $chessboard->getPeshkaA()->getAllowCells($chessboard->getPeshkaA()->getCoordinate()[0], $chessboard->getPeshkaA()->getCoordinate()[1]);
                break;
            case 'peshkaB';
                $fig = ['column' => $chessboard->getPeshkaB()->getCoordinate()[0], 'row' => $chessboard->getPeshkaB()->getCoordinate()[1]];
                $allowedCells = $chessboard->getPeshkaB()->getAllowCells($chessboard->getPeshkaB()->getCoordinate()[0], $chessboard->getPeshkaB()->getCoordinate()[1]);
                break;
            case 'peshkaC';
                $fig = ['column' => $chessboard->getPeshkaC()->getCoordinate()[0], 'row' => $chessboard->getPeshkaC()->getCoordinate()[1]];
                $allowedCells = $chessboard->getPeshkaC()->getAllowCells($chessboard->getPeshkaC()->getCoordinate()[0], $chessboard->getPeshkaC()->getCoordinate()[1]);
                break;
            case 'peshkaD';
                $fig = ['column' => $chessboard->getPeshkaD()->getCoordinate()[0], 'row' => $chessboard->getPeshkaD()->getCoordinate()[1]];
                $allowedCells = $chessboard->getPeshkaD()->getAllowCells($chessboard->getPeshkaD()->getCoordinate()[0], $chessboard->getPeshkaD()->getCoordinate()[1]);
                break;
            case 'peshkaE';
                $fig = ['column' => $chessboard->getPeshkaE()->getCoordinate()[0], 'row' => $chessboard->getPeshkaE()->getCoordinate()[1]];
                $allowedCells = $chessboard->getPeshkaE()->getAllowCells($chessboard->getPeshkaE()->getCoordinate()[0], $chessboard->getPeshkaE()->getCoordinate()[1]);
                break;
            case 'peshkaF';
                $fig = ['column' => $chessboard->getPeshkaF()->getCoordinate()[0], 'row' => $chessboard->getPeshkaF()->getCoordinate()[1]];
                $allowedCells = $chessboard->getPeshkaF()->getAllowCells($chessboard->getPeshkaF()->getCoordinate()[0], $chessboard->getPeshkaF()->getCoordinate()[1]);
                break;
            case 'peshkaG';
                $fig = ['column' => $chessboard->getPeshkaG()->getCoordinate()[0], 'row' => $chessboard->getPeshkaG()->getCoordinate()[1]];
                $allowedCells = $chessboard->getPeshkaG()->getAllowCells($chessboard->getPeshkaG()->getCoordinate()[0], $chessboard->getPeshkaG()->getCoordinate()[1]);
                break;
            case 'peshkaH';
                $fig = ['column' => $chessboard->getPeshkaH()->getCoordinate()[0], 'row' => $chessboard->getPeshkaH()->getCoordinate()[1]];
                $allowedCells = $chessboard->getPeshkaH()->getAllowCells($chessboard->getPeshkaH()->getCoordinate()[0], $chessboard->getPeshkaH()->getCoordinate()[1]);
                break;
        endswitch;
    }
    elseif (isset($_POST['figureName'])) {
        $figureName = $_POST['figureName'];
        $move = $_POST['move'];
        $column = strtoupper($move[0]);
        $row = intval($move[1]);

        switch ($figureName):
            case 'king':
                $chessboard->ShiftFigure($column, $row, $chessboard->getKing());
                break;
            case 'queen':
                $chessboard->ShiftFigure($column, $row, $chessboard->getQueen());
                break;
            case 'slonLeft':
                $chessboard->ShiftFigure($column, $row, $chessboard->getSlonLeft());
                break;
            case 'slonRight':
                $chessboard->ShiftFigure($column, $row, $chessboard->getSlonRight());
                break;
            case 'horseLeft':
                $chessboard->ShiftFigure($column, $row, $chessboard->getHorseLeft());
                break;
            case 'horseRight':
                $chessboard->ShiftFigure($column, $row, $chessboard->getHorseRight());
                break;
            case 'ladyeLeft':
                $chessboard->ShiftFigure($column, $row, $chessboard->getLadyeLeft());
                break;
            case 'ladyeRight':
                $chessboard->ShiftFigure($column, $row, $chessboard->getLadyeRight());
                break;
            case 'peshkaA':
                $chessboard->ShiftFigure($column, $row, $chessboard->getPeshkaA());
                break;
            case 'peshkaB':
                $chessboard->ShiftFigure($column, $row, $chessboard->getPeshkaB());
                break;
            case 'peshkaC':
                $chessboard->ShiftFigure($column, $row, $chessboard->getPeshkaC());
                break;
            case 'peshkaD':
                $chessboard->ShiftFigure($column, $row, $chessboard->getPeshkaD());
                break;
            case 'peshkaE':
                $chessboard->ShiftFigure($column, $row, $chessboard->getPeshkaE());
                break;
            case 'peshkaF':
                $chessboard->ShiftFigure($column, $row, $chessboard->getPeshkaF());
                break;
            case 'peshkaG':
                $chessboard->ShiftFigure($column, $row, $chessboard->getPeshkaG());
                break;
            case 'peshkaH':
                $chessboard->ShiftFigure($column, $row, $chessboard->getPeshkaH());
                break;
        endswitch;
    }
    ?> 
    <table>
        <thead>
            <tr>
                <th></th>
                <?php foreach($chessboard->getColumnsList() as $column): ?>
                <th><?php echo $column ?></th>
                <?php endforeach ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach($chessboard->getRowList() as $row): ?>
            <tr>
                <td>
                    <b><?php echo $row ?></b>
                </td>
                <?php foreach($chessboard->getColumnsList() as $key => $column): ?>
                <?php 
                    $cellColumns = [];
                    if (isset($fig) && isset($allowedCells)) {
                        foreach($allowedCells as $allowedCell) {
                            if ($column == $allowedCell['column'] && $row == $allowedCell['row']) {
                                array_push($cellColumns, 'move-allow');
                            }
                        }
                        if ($column == $fig['column'] && $row == $fig['row']) {
                            array_push($cellColumns, 'active');
                        }
                    }
                    if (($key + $row) % 2 == 1){
                        array_push($cellColumns, 'black');
                    }
                ?>  
                <td class="cell <?= implode(' ', $cellColumns); ?>">
                    <?php foreach($chessboard->getFigures() as $figure) {
                        if ($row == $figure['row_fig'] && $column == $figure['col_fig']) {
                            echo $figure['shape'];
                        }
                    }
                    ?>
                </td>
                <?php endforeach ?>
            </tr>
            <?php endforeach ?>
        </tbody>
    </table>
    
</body>
</html>