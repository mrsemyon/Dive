<?php
require $_SERVER['DOCUMENT_ROOT'] . '/src/core.php';

if (isAuthorized()) {
    FlashMessage::set('success', 'You are already registered');
    redirect('/public/users.php');
    exit;
}

$condition['email'] = $_POST['email'];


if (!empty($db->read('users', $condition))) {
    FlashMessage::set('danger', 'This email address is already taken by another user.');
    redirect('/public/registration.php');
    exit;
}

$db->create('users', $_POST);

$_SESSION['email'] = $_POST['email'];
$_SESSION['role'] = $_POST['role'];

FlashMessage::set('success', 'Registration successfull.');
redirect('/public/users.php');
exit;
