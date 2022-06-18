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

    public function create(string $table, array $data): void
    {
        $keys = implode(', ', array_keys($data));
        $tags = ':' . implode(', :', array_keys($data));
        $sql = "INSERT INTO $table ($keys) VALUES ($tags)";
        $statement = $this->pdo->prepare($sql);
        $statement->execute($data);
    }

    public function read(string $table, array $condition = NULL)
    {
        if ($condition) {
            $key = array_key_first($condition);
            $sql = "SELECT * FROM $table WHERE $key = :$key";
            $statement = $this->pdo->prepare($sql);
            $statement->execute($condition);
            return $statement->fetch();
        } else {
            $sql = "SELECT * FROM $table";
            $statement = $this->pdo->query($sql);
            return $statement->fetchAll();
        }
    }

    public function update(string $table, array $data): void
    {
        $keys = array_keys($data);
        $sql = "UPDATE $table SET ";
        foreach ($keys as $key) {
            if ($key != 'id') {
                $sql .= $key .  '=:' . $key . ', ';
            }
        }
        $sql = rtrim($sql, ', ') . ' WHERE id=:id';
        $statement = $this->pdo->prepare($sql);
        $statement->execute($data);
    }

    public function delete(string $table, int $id): void
    {
        $sql = "DELETE FROM $table WHERE id = :id";
        $statement = $this->pdo->prepare($sql);
        $statement->execute(['id' => $id]);
    }
}
