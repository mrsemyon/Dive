<?php
require $_SERVER['DOCUMENT_ROOT'] . '/src/core.php';

$condition['id'] = $_GET['id'];
$user = $db->read('users', $condition);

if (! isUserHasRightToChange($user['email'])) {
    FlashMessage::set('danger', 'You don\'t have enought rights');
    redirect('/public/users.php');
    exit;
}

$db->delete('users', $_GET['id']);

if ($user['photo'] != 'no_photo.jpg') {
    unlink($_SERVER['DOCUMENT_ROOT'] . '/upload/' . $user['photo']);
}

if ($user['email'] == $_SESSION['email']) {
    session_destroy();
    redirect('/public/authorization.php');
    exit;
}
FlashMessage::set('success', 'User deleted successfully');
redirect('/public/users.php');
exit;
