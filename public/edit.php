<?php
require $_SERVER['DOCUMENT_ROOT'] . '/app/core.php';

$user = getUserById($pdo, $_GET['id']);

if (($_SESSION['role'] != 'admin') && ($_SESSION['email'] != $user['email'])) {
    setFlashMessage('danger', 'У Вас недостаточно прав.');
    redirect('/public/users.php');
    exit;
}

$title = 'Редактировать пользователя';

require $_SERVER['DOCUMENT_ROOT'] . '/public/templates/header.php';
?>
<div class="subheader">
    <h1 class="subheader-title">
        <i class='subheader-icon fal fa-plus-circle'></i> Редактировать
    </h1>
</div>
<form action="/controllers/edit.php?id=<?= $user['id'] ?>" method="POST">
    <div class="row">
        <div class="col-xl-6">
            <div id="panel-1" class="panel">
                <div class="panel-container">
                    <div class="panel-hdr">
                        <h2>Общая информация</h2>
                    </div>
                    <div class="panel-content">
                        <!-- username -->
                        <div class="form-group">
                            <label class="form-label" for="simpleinput">Имя</label>
                            <input name="name" type="text" id="simpleinput" class="form-control" value="<?= $user['name'] ?>">
                        </div>

                        <!-- title -->
                        <div class="form-group">
                            <label class="form-label" for="simpleinput">Место работы</label>
                            <input name="position" type="text" id="simpleinput" class="form-control" value="<?= $user['position'] ?>">
                        </div>

                        <!-- tel -->
                        <div class="form-group">
                            <label class="form-label" for="simpleinput">Номер телефона</label>
                            <input name="phone" type="text" id="simpleinput" class="form-control" value="<?= $user['phone'] ?>">
                        </div>

                        <!-- address -->
                        <div class="form-group">
                            <label class="form-label" for="simpleinput">Адрес</label>
                            <input name="address" type="text" id="simpleinput" class="form-control" value="<?= $user['address'] ?>">
                        </div>
                        <div class="col-md-12 mt-3 d-flex flex-row-reverse">
                            <button class="btn btn-warning">Редактировать</button>
                        </div>
                    </div>
                </div>
            </div>
            <<<<<<< HEAD </div>
        </div>
</form>
</main>

<script src="js/vendors.bundle.js"></script>
<script src="js/app.bundle.js"></script>
<script>
    $(document).ready(function() {

        $('input[type=radio][name=contactview]').change(function() {
            if (this.value == 'grid') {
                $('#js-contacts .card').removeClassPrefix('mb-').addClass('mb-g');
                $('#js-contacts .col-xl-12').removeClassPrefix('col-xl-').addClass('col-xl-4');
                $('#js-contacts .js-expand-btn').addClass('d-none');
                $('#js-contacts .card-body + .card-body').addClass('show');

            } else if (this.value == 'table') {
                $('#js-contacts .card').removeClassPrefix('mb-').addClass('mb-1');
                $('#js-contacts .col-xl-4').removeClassPrefix('col-xl-').addClass('col-xl-12');
                $('#js-contacts .js-expand-btn').removeClass('d-none');
                $('#js-contacts .card-body + .card-body').removeClass('show');
            }

        });

        //initialize filter
        initApp.listFilter($('#js-contacts'), $('#js-filter-contacts'));
    });
</script>
</body>

=======
</form>
</main>

<script src="js/vendors.bundle.js"></script>
<script src="js/app.bundle.js"></script>
<script>
    $(document).ready(function() {

        $('input[type=radio][name=contactview]').change(function() {
            if (this.value == 'grid') {
                $('#js-contacts .card').removeClassPrefix('mb-').addClass('mb-g');
                $('#js-contacts .col-xl-12').removeClassPrefix('col-xl-').addClass('col-xl-4');
                $('#js-contacts .js-expand-btn').addClass('d-none');
                $('#js-contacts .card-body + .card-body').addClass('show');

            } else if (this.value == 'table') {
                $('#js-contacts .card').removeClassPrefix('mb-').addClass('mb-1');
                $('#js-contacts .col-xl-4').removeClassPrefix('col-xl-').addClass('col-xl-12');
                $('#js-contacts .js-expand-btn').removeClass('d-none');
                $('#js-contacts .card-body + .card-body').removeClass('show');
            }

        });

        //initialize filter
        initApp.listFilter($('#js-contacts'), $('#js-filter-contacts'));
    });
</script>
</body>
>>>>>>> c2be84ebaa74e4d6f95877c5543f852746a95c53

</html>