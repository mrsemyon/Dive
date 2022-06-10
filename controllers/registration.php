<?php
require $_SERVER['DOCUMENT_ROOT'] . '/src/core.php';

$pdo = createPDO();

if (!empty(getUserByEmail($pdo, $_POST['email']))) {
    setFlashMessage('danger', 'This email address is already taken by another user.');
    redirect('/public/registration.php');
    exit;
}

addUser($pdo, $_POST);

$_SESSION['email'] = $_POST['email'];
$_SESSION['role'] = $_POST['role'];

setFlashMessage('success', 'Registration successfull.');
redirect('/public/users.php');
exit;
