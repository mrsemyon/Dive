<?php

session_start();

require $_SERVER['DOCUMENT_ROOT'] . '/src/functions.php';
require $_SERVER['DOCUMENT_ROOT'] . '/src/classes.php';
require $_SERVER['DOCUMENT_ROOT'] . '/src/config.php';

$db = new QueryBuilder(DBConnector::make($config['db']));
