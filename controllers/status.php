<?php
require $_SERVER['DOCUMENT_ROOT'] . '/src/core.php';

$pdo = createPDO();
$user = getUserById($pdo, $_POST['id']);

if (($_SESSION['role'] != 'admin') && ($_SESSION['email'] != $user['email'])) {
    setFlashMessage('danger', 'You don\'t have enought rights');
    redirect('/public/users.php');
    exit;
}

setUserStatus($pdo, $user['id'], $_POST['status']);

setFlashMessage('success', 'The information has been successfully updated');
redirect('/public/users.php');
exit;
