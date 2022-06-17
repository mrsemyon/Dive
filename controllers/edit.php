<?php
require $_SERVER['DOCUMENT_ROOT'] . '/src/core.php';

$condition['id'] = $_POST['id'];
$user = $db->read('users', $condition);

if (! isUserHasRightToChange($user['email'])) {
    setFlashMessage('danger', 'You don\'t have enought rights');
    redirect('/users/');
    exit;
}

$data = $_POST;

foreach ($data as $key => $value) {
    if ($value == '') {
        $data[$key] = $user[$key];
    }
}

$db->update('users', $data);

setFlashMessage('success', 'The information has been successfully updated');
redirect('/public/users.php');
exit;
