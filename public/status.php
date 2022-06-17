<?php
require $_SERVER['DOCUMENT_ROOT'] . '/src/core.php';

$condition['id'] = $_GET['id'];
$user = $db->read('users', $condition);

if (! isUserHasRightToChange($user['email'])) {
    setFlashMessage('danger', 'You don\'t have enought rights');
    redirect('/public/users.php');
    exit;
}

$statuses = [
    "success" => "Онлайн",
    "warning" => "Отошёл",
    "danger" => "Не беспокоить",
    "unknown" => "Не установлен",
];

$title = "Set status";

require $_SERVER['DOCUMENT_ROOT'] . '/templates/header.php';
?>
        <div class="subheader">
            <h1 class="subheader-title">
                <i class='subheader-icon fal fa-sun'></i><?=$title?>
            </h1>
        </div>
        <form action="/controllers/status.php" method="POST">
            <div class="row">
                <div class="col-xl-6">
                    <div id="panel-1" class="panel">
                        <div class="panel-container">
                            <div class="panel-hdr">
                                <h2>Установка текущего статуса</h2>
                            </div>
                            <div class="panel-content">
                                <input hidden type="text" name="id" class="form-control" value="<?=$user['id']?>">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label" for="example-select">Выберите статус</label>
                                            <select name="status" class="form-control" id="example-select">
                                                <?php foreach ($statuses as $key => $value) { ?>
                                                    <option <?=($user['status'] == $key) ? 'selected' : ''?> value="<?=$key?>"><?=$value?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-3 d-flex flex-row-reverse">
                                        <button class="btn btn-warning">Set Status</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
<?php
require $_SERVER['DOCUMENT_ROOT'] . '/templates/footer.php';
