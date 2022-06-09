<?php

function addUser($pdo, $data)
{
    $sql = "INSERT INTO users (email, password, role)
        VALUES (:email, :password, :role)";
    $statement = $pdo->prepare($sql);
    $statement->execute(
        [
            'email' => $data['email'],
            'password' => password_hash($data['password'], PASSWORD_DEFAULT),
            'role' => $data['role'],
        ]
    );
    return $pdo->lastInsertId();
}
