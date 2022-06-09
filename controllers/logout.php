<?php

include $_SERVER['DOCUMENT_ROOT'] . '/src/core.php';

session_destroy();

redirect("/public/authorization.php");
