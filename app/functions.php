<?php

function makePDOConnection(array $config): PDO
{
    return new PDO(
        "mysql:host={$config['db']['host']};dbname={$config['db']['name']};charset={$config['db']['charset']}",
        $config['db']['user'],
        $config['db']['password'],
        $config['db']['opt']
    );
}

function getUserByEmail(PDO $pdo, string $email): array
{
    $sql = 'SELECT * FROM `users` WHERE `email` = :email';
    $statement = $pdo->prepare($sql);
    $statement->execute(['email' => $email]);
    return $statement->fetchAll();
}

function addUser(PDO $pdo, string $email, string $password, string $role): void
{
    $sql = 'INSERT INTO `users` (`email`, `password`, `role`) VALUES (:email, :password, :role)';
    $statement = $pdo->prepare($sql);
    $statement->execute([
        'email' => $email,
        'password' => $password,
        'role' => $role
    ]);
}

function setFlashMessage($key, $message)
{
    $_SESSION[$key] = $message;
}

function displayFlashMessage($key)
{
    echo $_SESSION[$key];
    unset($_SESSION[$key]);
}
