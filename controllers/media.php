<?php
require $_SERVER['DOCUMENT_ROOT'] . '/src/core.php';

$pdo = createPDO();
$user = $db->read('users', $_POST['id']);

if (! isUserHasRightToChange($user['email'])) {
    setFlashMessage('danger', 'You don\'t have enought rights');
    redirect('/public/users.php');
    exit;
}
if ($user['photo'] != 'no_photo.jpg') {
    unlink($_SERVER['DOCUMENT_ROOT'] . '/upload/' . $user['photo']);
}

$photo = (! empty($_FILES['photo']['name']))
	? prepareUserPhoto($_FILES['photo'])
	: 'no_photo.jpg';

setUserPhoto($pdo, $user['id'], $photo);

setFlashMessage('success', 'The photo has been successfully updated');
redirect('/public/users.php');
exit;
