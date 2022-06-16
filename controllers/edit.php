<?php
require $_SERVER['DOCUMENT_ROOT'] . '/src/core.php';

$pdo = createPDO();
$user = $db->getOne('users', $_POST['id']);

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

setUserInfo($pdo, $_POST['id'], $data);

setFlashMessage('success', 'The information has been successfully updated');
redirect('/public/users.php');
exit;
