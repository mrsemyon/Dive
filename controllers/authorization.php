<?php
require $_SERVER['DOCUMENT_ROOT'] . '/src/core.php';

if (isAuthorized()) {
    setFlashMessage('success', 'You are already authorizeded');
    redirect('/public/users.php');
    exit;
}

$pdo = createPDO();
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
redirect('/public/authorization.php');
exit;
