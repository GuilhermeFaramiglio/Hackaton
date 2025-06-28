<?php
// config.php

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'hackamena');

$link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if (!$link) {
    die("Erro na conexão: " . mysqli_connect_error());
}

mysqli_set_charset($link, "utf8");
?>