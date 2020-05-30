<?php

//zip.php
$zip = new ZipArchive ();
$filename = 'test.zip';

if ($zip->open ($filename, ZIPARCHIVE::CREATE) !== true ) {
    exit ('cannot open $filename\n<br>');
}

//создаем в архиве файл и записываем в него строку
$str = "#1 test string added as testfilephp1.txt.\n";
$zip->addFromString ("test-file-php-1.txt", $str);

$str = "#2 test string added as testfilephp2.txt.\n";
$zip->addFromString ("test-file-php-1.txt", $str);

//копируем в архив существующий файл "test.txt" и переименовываем 
//его в "test-from-file.txt
$zip->addFile ("test.txt", "test-from-file.txt");

$zip->close ();

echo file_get_contents ($filename);
