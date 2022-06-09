<?php

require $_SERVER['DOCUMENT_ROOT'] . '/src/core.php';

$pdo = createPDO();
$password = $_POST['password'];

$data = getUserByEmail($pdo, $_POST['email']);

if (!empty($data)) {
    if (checkPassword($_POST['password'], $data['password'])) {
        setFlashMessage('success', 'Authorization was successful.');
        $_SESSION['email'] = $data['email'];
        $_SESSION['role'] = $data['role'];
        redirect('/public/users.php');
        exit;
    }
}

setFlashMessage('danger', 'Incorrect login or password.');
redirect("/public/authorization.php");
exit;
