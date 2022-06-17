<?php
require $_SERVER['DOCUMENT_ROOT'] . '/src/core.php';

if (! isAdmin()) {
    setFlashMessage('danger', 'You don\'t have enought rights');
    redirect('/public/users.php');
    exit;
}

$condition['email'] = $_POST['email'];

if (! empty($db->read('users', $condition))) {
    setFlashMessage('danger', 'This email address is already taken by another user.');
    redirect('/public/create.php');
    exit;
}
$data = $_POST;
$data['photo'] = (! empty($_FILES['photo']['name']))
	? prepareUserPhoto($_FILES['photo'])
	: 'no_photo.jpg';

$db->create('users', $data);

setFlashMessage('success', 'User added successfully.');
redirect('/public/users.php');
exit;
