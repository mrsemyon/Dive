<?php

class ConnectionDB
{
    public static function make($config)
    {
        return new PDO(
            "mysql:host={$config['host']};dbname={$config['name']};charset={$config['charset']}",
            $config['user'],
            $config['password'],
            $config['opt']
        );
    }
}

class QueryBuilder
{
    protected $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function read(string $table, int $id = NULL): array
    {
        if ($id) {
            $sql = "SELECT * FROM $table WHERE id = :id";
            $statement = $this->pdo->prepare($sql);
            $statement->execute(['id' => $id]);
            return $statement->fetch();
        } else {
            $sql = "SELECT * FROM $table";
            $statement = $this->pdo->query($sql);
            return $statement->fetchAll();
        }
    }

    public function delete(string $table, int $id): void
    {
        $sql = "DELETE FROM $table WHERE id = :id";
        $statement = $this->pdo->prepare($sql);
        $statement->execute(['id' => $id]);
    }
}
