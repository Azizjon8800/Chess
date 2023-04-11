<?php
namespace chess\database;
use PDO;
use PDOException;

class DB 
{
    private $pdo;

    public function __construct()
    {
        $dbOption = (require __DIR__ . '/../setting/setting.php')['db'];

        try {
            $this->pdo = new PDO(
                'mysql:host=' . $dbOption['host'] . ';dbname=' . $dbOption['dbname'],
                $dbOption['user'], $dbOption['password']
            );
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->exec('SET NAMES UTF8');
        }
        catch (PDOException $e) {
            die('Failed to connect with: ' . $e->getMessage());
        }
    }   

    public function query(string $sql, array $params = []): ?array
    {
        $sth = $this->pdo->prepare($sql);
        $result = $sth->execute($params);

        if (false === $result) {
            return null;
        }
        return $sth->fetchAll();
    }
}