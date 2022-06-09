<?php

include $_SERVER['DOCUMENT_ROOT'] . '/src/core.php';

if ($_SESSION['role'] != 'admin') {
    setFlashMessage('danger', 'You don\'t have enought rights');
    redirect('/public/users.php');
    exit;
}

$pdo = createPDO();

if (! empty(getUserByEmail($pdo, $_POST['email']))) {
    setFlashMessage('danger', 'This email address is already taken by another user.');
    redirect("/public/create.php");
    exit;
}

$photo = (! empty($_FILES['photo']['name']))
	? prepareUserPhoto($_FILES['photo'])
	: 'no_photo.jpg';

$id = addUser($pdo, $_POST);

setUserInfo( $pdo, $id, $_POST);

setUserSocialLinks($pdo, $id, $_POST);

setUserStatus($pdo, $id, $_POST['status']);

setUserPhoto($pdo, $id, $photo);

setFlashMessage('success', 'User added successfully.');
redirect("/public/users.php");
exit;
