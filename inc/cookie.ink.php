<?php
//Проверяем, заполнена ли форма input name
if($_POST['name']){
    //фильтруем данные из формы input name 
    $name = trim ( strip_tags ( $_POST['name'] ) );
    setcookie('name', $name, 0x7fffffff);
    //после получения данных из формы перезагружаем страницу методом GET
    header("Location: " . $_SERVER["PHP_SELF"]);
    exit;
}
$name = ($_COOKIE['name'])? $_COOKIE['name'] : 'guest';

// счетчик посещений
$visitCounter = 0;
if(isset($_COOKIE['visitCounter'])){
    $visitCounter = $_COOKIE['visitCounter'];
}
$visitCounter++;

// время последнего визита
$lastVisit = "";
if(isset($_COOKIE['lastVisit'])){
    $lastVisit = date("d-m-Y H:i:s", $_COOKIE['lastVisit']);
}
//условие, чтобы куки устанавливались раз в день
//0x7fffffff - максимальное число в 32хбитной системе
if(date('d-m-Y', $_COOKIE['lastVisit']) != date ('d-m-Y')){
    setcookie('visitCounter', $visitCounter, 0x7fffffff);
    setcookie('lastVisit', time(), 0x7fffffff);
}

// var_dump(getdate($_COOKIE['lastVisit']));
var_dump ($_SERVER["PHP_SELF"]);
// var_dump ($_COOKIE);