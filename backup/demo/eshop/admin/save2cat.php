<?php
include "../inc/lib.inc.php";
include "../inc/config.inc.php";

#обработка полученных данных из веб формы
// получить и отфильтровать данные из веб формы

$title = clearStr($_POST['title']);
$author = clearStr($_POST['author']);
$pubyear = clearInt($_POST['pubyear']);
$price = clearInt($_POST['price']);

// вызвать функцию addItemToCatalog для сохранения товара в базе данных
if(!addItemToCatalog ($title, $author, $pubyear, $price, $link)) {
    echo 'ошибка при добавлении товара в каталог';
} else {
    header ("location: index.php");
    exit;
}