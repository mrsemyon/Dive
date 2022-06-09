<?php

function changePassword($pdo, $id, $password)
{
    $sql = "UPDATE users SET
        password = :password
        WHERE id = :id";
    $statement = $pdo->prepare($sql);
    $statement->execute(
        [
            'id' => $id,
            'password' => password_hash($password, PASSWORD_DEFAULT),
        ]
    );
}
