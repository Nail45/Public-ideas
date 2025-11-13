<?php

ini_set('display_errors', 'off');

session_start();

$url = $_SERVER['REQUEST_URI'];

if (preg_match('#^(/(?:\?page=\d+)?)$#', $url)) {
    include './controllers/main.php';
    include "./views/main.php";
}

if (preg_match('#^/(account)/(\d+)$#', $url, $match)) {
    $id = $match[2];
    include './controllers/personal-account.php';
    include './views/personal-account.php';
}

if (preg_match('#^/(edit)/(\d+)$#', $url, $match)) {
    $id = $match[2];
    include './controllers/edit.php';
    include './views/edit.php';
}

if (preg_match('#^/login$#', $url)) {
    include './controllers/login.php';
    include './views/login.php';
}

if (preg_match('#^/register$#', $url)) {
    include './controllers/register.php';
    include './views/register.php';
}

if (preg_match('#^/logout$#', $url)) {
    include "./controllers/logout.php";
}

if (preg_match('#^/empty$#', $url)) {
    include './views/empty.php';
}
