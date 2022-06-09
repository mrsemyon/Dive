<?php

function changeEmail($pdo, $id, $email)
{
    $sql = "UPDATE users SET
        email = :email
        WHERE id = :id";
    $statement = $pdo->prepare($sql);
    $statement->execute(
        [
            'id' => $id,
            'email' => $email,
        ]
    );
}
