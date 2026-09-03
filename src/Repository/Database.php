<?php

namespace App\Repository;
final class Database
{
   
    private static ?Database $connection = null;
    private ?\PDO $pdo = null;
    private string $host;
    private string $dbName;
    private string $username;
    private string $password;
    private int $port;

    private function __construct()
    {
        $this->host =  $_ENV['DB_HOST'] ;
        $this->dbName =  $_ENV['DB_NAME'] ;
        $this->username =  $_ENV['DB_USER'];
        $this->password =  $_ENV['DB_PASSWORD'];
        $this->port =  $_ENV['DB_PORT'];
    }

     public static function getInstance(): Database
    {
        if (self::$connection === null) {
            self::$connection = new Database();
        }
        
        return self::$connection;
    }

    public  function getConnexion(): \PDO
    {
        if ($this->pdo === null) {
            try {
               $this->pdo = new \PDO(
                    "pgsql:host={$this->host};port={$this->port};dbname={$this->dbName}",
                    $this->username,
                    $this->password,
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
  
    public static function closeConnection(): void
    {
        self::$connection = null;
    }

   
}