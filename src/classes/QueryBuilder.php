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

    public function create($table, $data)
    {
        $keys = implode(', ', array_keys($data));
        $tags = ':' . implode(', :', array_keys($data));
        $sql = "INSERT INTO $table ($keys) VALUES ($tags)";
        $statement = $this->pdo->prepare($sql);
        $statement->execute($data);
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

    public function update($table, $data)
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
