<?php
require $_SERVER['DOCUMENT_ROOT'] . '/src/core.php';

$condition['id'] = $_POST['id'];
$user = $db->read('users', $condition);

if (! isUserHasRightToChange($user['email'])) {
    FlashMessage::set('danger', 'You don\'t have enought rights');
    redirect('/public/users.php');
    exit;
}

$db->update('users', $_POST);

FlashMessage::set('success', 'The information has been successfully updated');
redirect('/public/users.php');
exit;
