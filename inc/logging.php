<?php
$dt = time();

// $page = $_SERVER['REQUEST_URI'];
// $page = $_SERVER["QUERY_STRING"];
$page = $_GET["id"] ?? "index";

$ref = $_SERVER["HTTP_REFERER"];
// $ref = pathinfo ($ref, PATHINFO_BASENAME);
$ref = parse_url ($ref, PHP_URL_QUERY);
//обрезаем повторяющиеся значения
// $ref = strpbrk ($ref, "=");
$ref = substr ($ref, 3);

$path = "$dt|$ref|$page\n";

file_put_contents (PATH_LOG, $path, FILE_APPEND);










// $log = $_SERVER['REQUEST_URI'];
// $timestamp = date("d-m-Y H-i-s", time());
// var_dump($timestamp) ;
// file_put_contents ("./logs/visit.log", "$timestamp - $log\n", FILE_APPEND);
// $visitLog = file ("./logs/visit.log");
// var_dump($visitLog);