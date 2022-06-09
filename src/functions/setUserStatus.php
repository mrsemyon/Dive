<?php

function setUserStatus($pdo, $id, $status)
{
    $sql = "UPDATE users SET
        status = :status
        WHERE id = :id";
    $statement = $pdo->prepare($sql);
    $statement->execute(
        [
            'id' => $id,
            'status' => $status,
        ]
    );
}
