<?php
require $_SERVER['DOCUMENT_ROOT'] . '/src/core.php';

$pdo = createPDO();
$user = getUserById($pdo, $_GET['id']);

if (! isUserHasRightToChange($user['email'])) {
    setFlashMessage('danger', 'You don\'t have enought rights');
    redirect('/public/users.php');
    exit;
}

if (empty($_POST['password']) && ($user['email'] == $_POST['email'])) {
    setFlashMessage('danger', 'Information hasn\'t been updated');
    redirect('/public/users.php');
    exit;
}

if (! empty($_POST['email'])) {
    if ($_POST['email'] != $user['email']) {
        if (!empty(getUserByEmail($pdo, $_POST['email']))) {
            setFlashMessage('danger', 'This email address is already taken by another user.');
            redirect('/public/security.php?id=' . $user['id']);
            exit;
        }
        changeEmail($pdo, $user['id'], $_POST['email']);
        if (($_SESSION['role'] != 'admin') || ($_SESSION['role'] == 'admin' && $user['role'] == 'admin')) {
            $_SESSION['email'] = $_POST['email'];
        }
    }
}

if (! empty($_POST['password'])) {
    changePassword($pdo, $user['id'], $_POST['password']);
}

setFlashMessage('success', 'The information has been successfully updated');
redirect('/public/users.php');
exit;
