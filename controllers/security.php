<?php
require $_SERVER['DOCUMENT_ROOT'] . '/src/core.php';

$condition['id'] = $_POST['id'];
$user = $db->read('users', $condition);
unset($condition);

if (!isUserHasRightToChange($user['email'])) {
    setFlashMessage('danger', 'You don\'t have enought rights');
    redirect('/public/users.php');
    exit;
}

if (empty($_POST['password']) && ($user['email'] == $_POST['email'])) {
    setFlashMessage('danger', 'Information hasn\'t been updated');
    redirect('/public/users.php');
    exit;
}

if (!empty($_POST['email'])) {
    if ($_POST['email'] != $user['email']) {
        $condition['email'] = $_POST['email'];
        if (!empty($db->read('users', $condition))) {
            setFlashMessage('danger', 'This email address is already taken by another user.');
            redirect('/public/security.php?id=' . $user['id']);
            exit;
        }
        $data['id'] = $user['id'];
        $data['email'] = $_POST['email'];
        $db->update('users', $data);
        if (($_SESSION['role'] != 'admin') || ($_SESSION['role'] == 'admin' && $user['role'] == 'admin')) {
            $_SESSION['email'] = $_POST['email'];
        }
    }
}

if (!empty($_POST['password'])) {
    $data['id'] = $user['id'];
    $data['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $db->update('users', $data);
}

setFlashMessage('success', 'The information has been successfully updated');
redirect('/public/users.php');
exit;
