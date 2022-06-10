<?php
require $_SERVER['DOCUMENT_ROOT'] . '/src/core.php';

$pdo = createPDO();
$user = getUserById($pdo, $_GET['id']);

if (($_SESSION['role'] != 'admin') && ($_SESSION['email'] != $user['email'])) {
    setFlashMessage('danger', 'You don\'t have enought rights');
    redirect('/public/users.php');
    exit;
}

$title = "Edit credentials";

require $_SERVER['DOCUMENT_ROOT'] . '/templates/header.php';
?>
        <?php if(isset($_SESSION['danger'])):?>
                <div class="alert alert-danger text-dark" role="alert">
                    <?php
                        displayFlashMessage('danger');
                    ?>
                </div>
        <?php endif; ?>
        <?php if(isset($_SESSION['success'])):?>
                <div class="alert alert-success text-dark" role="alert">
                    <?php
                        displayFlashMessage('success');
                    ?>
                </div>
        <?php endif; ?>
        <div class="subheader">
            <h1 class="subheader-title">
                <i class='subheader-icon fal fa-lock'></i> Безопасность
            </h1>
        </div>
        <form action="/controllers/security.php?id=<?=$user['id']?>" method="POST">
            <div class="row">
                <div class="col-xl-6">
                    <div id="panel-1" class="panel">
                        <div class="panel-container">
                            <div class="panel-hdr">
                                <h2>Обновление эл. адреса и пароля</h2>
                            </div>
                            <div class="panel-content">
                                <div class="form-group">
                                    <label class="form-label" for="simpleinput">Email</label>
                                    <input name="email" type="text" id="simpleinput" class="form-control" value="<?=$user['email']?>">
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="simpleinput">Пароль</label>
                                    <input name="password" type="password" id="simpleinput" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="simpleinput">Подтверждение пароля</label>
                                    <input type="password" id="simpleinput" class="form-control">
                                </div>
                                <div class="col-md-12 mt-3 d-flex flex-row-reverse">
                                    <button class="btn btn-warning">Изменить</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
<?php
require $_SERVER['DOCUMENT_ROOT'] . '/templates/footer.php';
