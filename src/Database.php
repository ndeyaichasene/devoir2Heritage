<?php

namespace App;

use Dotenv\Dotenv;

class Database
{
    private static ?Database $instance = null;
    private ?\PDO $pdo = null;

    private function __construct() {
        $dotenv = Dotenv::createImmutable(dirname(__DIR__));
        $dotenv->load();
    }

    private function __clone() {}

    public function __wakeup()
    {
        throw new \Exception("Cannot unserialize singleton");
    }

    public static function getInstance(): Database
    {
        if (self::$instance === null) {
            self::$instance = new Database();
        }

        return self::$instance;
    }

    private function getConnexion(): \PDO
    {
        if ($this->pdo === null) {
            try {
               $this->pdo = new \PDO(
                    "pgsql:host=" . $_ENV['DB_HOST'] . ";port=" . $_ENV['DB_PORT'] . ";dbname=" . $_ENV['DB_NAME'],
                    $_ENV['DB_USER'],
                    $_ENV['DB_PASSWORD'],
                    [
                        \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
                        \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
                    ]
                );
            } catch (\Throwable $th) {
                throw new \Exception(
                    "Erreur de connexion : " . $th->getMessage()
                );
            }
        }

        return $this->pdo;
    }

    public function query(string $sql, bool $single = true): mixed
    {
        $query = $this->getConnexion()->query($sql);

        return $single ? $query->fetch(\PDO::FETCH_OBJ) : $query->fetchAll(\PDO::FETCH_OBJ);
    }

   private function prepare(string $sql, array $datas): \PDOStatement
{
    $statement = $this->getConnexion()->prepare($sql);

    foreach ($datas as $key => $value) {
        if (is_bool($value)) {
            $statement->bindValue(':' . $key, $value, \PDO::PARAM_BOOL);
        } elseif (is_int($value)) {
            $statement->bindValue(':' . $key, $value, \PDO::PARAM_INT);
        } elseif (is_null($value)) {
            $statement->bindValue(':' . $key, $value, \PDO::PARAM_NULL);
        } else {
            $statement->bindValue(':' . $key, $value, \PDO::PARAM_STR);
        }
    }

    $statement->execute();

    return $statement;
}

    public function executeQuery(string $sql,array $datas,bool $single = true): mixed {
        $statement = $this->prepare($sql, $datas);

        return $single ? $statement->fetch(\PDO::FETCH_OBJ) : $statement->fetchAll(\PDO::FETCH_OBJ);
    }

    public function executeUpdate(string $sql, array $datas): int
    {
        $statement = $this->prepare($sql, $datas);

        return $statement->rowCount();
    }

    public function getAllData(string $tableName): array
    {
        $sql = "SELECT * FROM $tableName";

        return $this->query($sql, false);
    }
}