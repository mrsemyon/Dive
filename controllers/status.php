<?php
require $_SERVER['DOCUMENT_ROOT'] . '/src/core.php';

$user = $db->read('users', $_POST['id']);

if (! isUserHasRightToChange($user['email'])) {
    setFlashMessage('danger', 'You don\'t have enought rights');
    redirect('/public/users.php');
    exit;
}

$db->update('users', $_POST);

setFlashMessage('success', 'The information has been successfully updated');
redirect('/public/users.php');
exit;
