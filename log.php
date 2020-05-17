<?php
if (is_file (PATH_LOG)):

    $file = file (PATH_LOG);

    echo "<ol>";
    foreach ($file as $line) {
        // explode - разбиваем строку в массив
        // list - инициируем ключи массива
        list ($date, $ref, $page) =  explode ("|", $line);
        $date = date ("d-m-Y H:i:s", $date);
        
        // echo "<li>";
        echo "$date, from $ref to $page<br>";
        // echo "</li>";
    }
    echo "</ol>";

    // $log = fopen (PATH_LOG, "r");
    // $date = date("d-m-Y H:i:s", fread ($log, 10));
    
    // $date = date("d-m-Y H:i:s", (int)$lines[0]);
    // echo $date;
    // echo ftell(PATH_LOG);

    // $date = date ("d-m-Y H:i:s", fread(PATH_LOG, 10));

endif;