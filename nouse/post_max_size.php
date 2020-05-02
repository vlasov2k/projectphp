<?php
//получаем значение post_max_size
$size = ini_get("post_max_size");

//считываем формат хранения размера
$letter = $size{strlen($size)-1};

//преобразуем тип данных в int
$size = (int)$size;

//вычисляем значение в байтах
switch(strtoupper($letter)): 
	case 'G': $size *= 1024; // то же что и $size = $size * 1024
	case 'M': $size *= 1024;
	case 'K': $size *= 1024;
endswitch;

//выводим значение post_max_size в байтах
echo "Post max size is {$size} bites";
