<?php

//соединение с базой данных
$link = mysqli_connect('localhost', 'master', '3569', 'projectphp');

//отслеживаем ошибки при соединении
if (!$link) {
    echo "ошибка: "
        . mysqli_errno($link)
        . ":"
        . mysqli_error($link);
}