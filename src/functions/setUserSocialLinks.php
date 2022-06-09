<?php

function setUserSocialLinks($pdo, $id, $data)
{
    $sql = "UPDATE users SET
        vk = :vk,
        telegram = :telegram,
        instagram = :instagram
        WHERE id = :id";
    $statement = $pdo->prepare($sql);
    $statement->execute(
        [
            'id' => $id,
            'vk' => $data['vk'],
            'telegram' => $data['telegram'],
            'instagram' => $data['instagram'],
        ]
    );
}
