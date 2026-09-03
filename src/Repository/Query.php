<?php

declare(strict_types=1);

namespace App\Repository;


abstract class Query
{
    private \PDO $pdo;

    protected function  __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    protected function query(string $sql, bool $single = true): mixed
    {
        $query = $this->pdo->query($sql);

        return $single ? $query->fetch(\PDO::FETCH_OBJ) : $query->fetchAll(\PDO::FETCH_OBJ);
    }

    protected function prepare(string $sql, array $datas): \PDOStatement
    {
        $statement = $this->pdo->prepare($sql);

        $statement->execute($datas);

        return $statement;
    }

    protected function executeQuery(string $sql, array $datas, bool $single = true): mixed
    {
        $statement = $this->prepare($sql, $datas);

        return $single ? $statement->fetch(\PDO::FETCH_OBJ) : $statement->fetchAll(\PDO::FETCH_OBJ);
    }

    protected function executeUpdate(string $sql, array $datas): int
    {
        $statement = $this->prepare($sql, $datas);

        return $statement->rowCount();
    }

    protected function getAllData(string $tableName): array
    {
        $sql = "SELECT * FROM $tableName";

        return $this->query($sql, false);
    }

    protected function getById(string $tableName,int $id): mixed
    {
        $sql = "SELECT * FROM $tableName WHERE id= :id";

        return $this->executeQuery($sql,['id'=>$id]);
    }
}
