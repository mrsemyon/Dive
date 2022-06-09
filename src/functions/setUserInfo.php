<?php

function setUserInfo($pdo, $id, $data)
{
    $sql = "UPDATE users SET
        name = :name,
        phone = :phone,
        address = :address,
        position = :position
        WHERE id = :id";
    $statement = $pdo->prepare($sql);
    $statement->execute(
        [
            'id' => $id,
            'name' => $data['name'],
            'phone' => $data['phone'],
            'address' => $data['address'],
            'position' => $data['position'],
        ]
    );
}
