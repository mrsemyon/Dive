<?php

require $_SERVER['DOCUMENT_ROOT'] . '/src/core.php';

$pdo = createPDO();
$user = getUserById($pdo, $_GET['id']);

if (($_SESSION['role'] != 'admin') && ($_SESSION['email'] != $user['email'])) {
    setFlashMessage('danger', 'You don\'t have enought rights');
    redirect('/public/users.php');
    exit;
}

deleteUser($pdo, $_GET['id']);

if ($user['photo'] != 'no_photo.jpg') {
    unlink($_SERVER['DOCUMENT_ROOT'] . '/upload/' . $user['photo']);
}

if ($user['email'] == $_SESSION['email']) {
    session_destroy();
    redirect('/public/authorization.php');
    exit;
}
setFlashMessage('success', 'User deleted successfully');
redirect('/public/users.php');
exit;
