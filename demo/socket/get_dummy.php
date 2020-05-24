<?php
    header ("Content-Type: text/html; charset=utf-8");
    //сокетное соединение

    // создаем сокет
    $socket = fsockopen ("projectphp.loc", 80, 
        $sock_errno, $sock_errmsg, 30);
    if (!$socket) {
        echo $sock_errmsg;
        exit;
    }

    // создаем POST-строку
    $str_query = "name=jon&age=29";

    //посылаем HTTP-запрос
    $out = "POST /demo/socket/dummy.php HTTP/1.1\r\n";
    $out .= "Host: projectphp.loc\r\n";
    $out .= "Content-Type: /application/x-www-form-urlencoded\r\n";
    $out .= "Content-length:" . strlen($str_query) . " \r\n\r\n";
    $out .= $str_query ;

    fwrite ($socket, $out);

    var_dump($_SERVER['HTTP_CONTENT_LENGTH']);

    //получаем и выводим ответ
    while (!feof ($socket)) {
        echo fgets ($socket);
    }

    //закрытие содединения
    fclose ($socket);
?>