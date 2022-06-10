<?php
require $_SERVER['DOCUMENT_ROOT'] . '/src/core.php';

$pdo = createPDO();
$user = getUserById($pdo, $_GET['id']);

if (($_SESSION['role'] != 'admin') && ($_SESSION['email'] != $user['email'])) {
    setFlashMessage('danger', 'You don\'t have enought rights');
    redirect('/public/users.php');
    exit;
}

$title = "Edit photo";

require $_SERVER['DOCUMENT_ROOT'] . '/templates/header.php';
?>
        <div class="subheader">
            <h1 class="subheader-title">
                <i class='subheader-icon fal fa-image'></i><?=$title?>
            </h1>
        </div>
        <form action="/controllers/media.php" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-xl-6">
                    <div id="panel-1" class="panel">
                        <div class="panel-container">
                            <div class="panel-hdr">
                                <h2>Текущий аватар</h2>
                            </div>
                            <div class="panel-content">
                                <div class="form-group">
                                    <img src="/upload/<?=$user['photo']?>" alt="" class="img-responsive" width="200">
                                </div>
                                <input hidden type="text" name="id" class="form-control" value="<?=$user['id']?>">
                                <div class="form-group">
                                    <label class="form-label" for="example-fileinput">Выберите аватар</label>
                                    <input name="photo" type="file" id="example-fileinput" class="form-control-file">
                                </div>

                                <div class="col-md-12 mt-3 d-flex flex-row-reverse">
                                    <button class="btn btn-warning">Загрузить</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
<?php
require $_SERVER['DOCUMENT_ROOT'] . '/templates/footer.php';
