<?php
require $_SERVER['DOCUMENT_ROOT'] . '/src/core.php';

if (isAuthorized()) {
    FlashMessage::set('success', 'You are already authorizeded');
    redirect('/public/users.php');
    exit;
}

$condition['email'] = $_POST['email'];
$data = $db->read('users', $condition);

if (!empty($data)) {
    if (checkPassword($_POST['password'], $data['password'])) {
        FlashMessage::set('success', 'Authorization was successful.');
        $_SESSION['email'] = $data['email'];
        $_SESSION['role'] = $data['role'];
        redirect('/public/users.php');
        exit;
    }
}

FlashMessage::set('danger', 'Incorrect login or password.');
redirect('/public/authorization.php');
exit;
