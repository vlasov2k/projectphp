<?php
session_start();
header ("HTTP/1.0 Unauthorized");
require "secure.inc.php";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $login = trim (strip_tags($_POST['login']));
    $pw = trim (strip_tags($_POST['pw']));
    $ref = trim (strip_tags($_POST['ref']));
    if (!$ref) $ref = '/eshop/admin';
    if ($login and $pw) {
        if ($result = userExists ($login)) {
            list ($_, $hash) = explode (':', $result);
            if (checkHash ($pw, $hash)) {
                $_SESSION['admin'] = true;
                header ("location: $ref");
                exit;
            } else {
                $title = "неправильное имя пользователя или пароль";
            }   
        } else {
            $title = "неправильное имя пользователя или пароль";
        }
    } else {
        $title = "заполните все поля формы";
    }
}