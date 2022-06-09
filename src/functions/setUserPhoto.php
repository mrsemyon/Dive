<?php

function setUserPhoto($pdo, $id, $photo)
{
    $sql = "UPDATE users SET
        photo = :photo
        WHERE id = :id";
    $statement = $pdo->prepare($sql);
    $statement->execute(
        [
            'id' => $id,
            'photo' => $photo,
        ]
    );
}
