<?php
//создание изображения
// $i = imageCreate (500, 300);
$i = imageCreateTrueColor (500,300);

//подготовка к работе
imageAntiAlias ($i, true);

$red = imageColorAllocate ($i, 255, 0,0);
$white = imageColorAllocate ($i, 0xFFF, 0xFFF,0xFFF);
$black = imageColorAllocate ($i, 0, 0, 0);
$green = imageColorAllocate ($i, 0, 255, 0);
$blue = imageColorAllocate ($i, 0, 0, 255);
$grey = imageColorAllocate ($i, 192, 192, 192);

imageFill ($i, 0, 0, $grey);

//рисуем примитивы 
imageSetPixel ($i, 10, 10, $black);
// imageLine ($i, 20, 20, 80, 280, $red);
// imageRectangle ($i, 20, 20, 80, 280, $blue);
// $points = array (0, 0, 100, 200, 300, 200);
// imagePolygon ($i, $points, 3, $green);
// imageEllipse ($i, 200, 150, 300, 200, $red);
imageArc ($i, 200, 150, 300, 200, 0, 40, $black);
// imageFilledArc ($i, 200,150,300, 200, 0, 40, $red, IMG_ARC_PIE); //IMG_ARC_CHORD; IMG_ARC_EDGED | IMG_ARC_NOFILL

//рисуем текст
imageString ($i, 5, 150, 200, 'PHP5', $black);
imageChar ($i, 3, 20, 20, 'PHP5', $blue);
imageCharUp ($i, 3, 20, 20, 'PHP5', $blue);
imageTtfText ($i, 30, 10, 300, 150, $green, 'Arial', 'PHP5');

//отдаем изображение
// header ("Content-Type: image/gif");
//сохранит, если вторым параметром передать имя файла
imageGif ($i);
header ("Content-Type: image/png");
//imagePng ($i);
//header ("Content-Type: image/jpg");
//imageJpg;
