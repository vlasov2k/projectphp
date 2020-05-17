<?php
require "inc/lib.inc.php";
require "inc/config.inc.php";

$clientName = clearStr ($_POST['clientName']);
$clientEmail = clearStr ($_POST['clientEmail']);
$clientPhone = clearInt ($_POST['clientPhone']);
$clientAdress = clearStr ($_POST['clientAdress']);
$oid = $basket['orderid'];
$dt = time();
$order = "$clientName|$clientEmail|$clientPhone|$clientAdress|$oid|$dt\n";

file_put_contents ("admin/".ORDERS_LOG, $order, FILE_APPEND);
saveOrder ($dt);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>сохранение данных заказа</title>
</head>
<body>
    <p>ваш заказ принят</p>
    <p><a href="catalog.php">вернуться в каталог товаров</a></p>
</body>
</html>