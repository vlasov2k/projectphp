<?php

#контекст потока

    //формирование необходимых данных
    $options = [
        "http" => [
            "method" => "GET",
            "header" => "User-Agent: PHPBot\r\n" . 
                "Cookie: user=jon\r\n"
        ]
    ] ;

    //создание контекста потока
    $context = stream_context_create ($options);

    //запрос с использованием созданного контекста
    echo file_get_contents ("http://mysite.local/xml-rpc/server.php", false, $context);

    //получение ответа при использовании fopen ()
    $f = fopen ("http://mysite.local/xml-rpc/server.php", "r", false, $context);
    echo stream_get_contents ($f);

    //получение заголовков ответа
    print_r (stream_get_meta_data ($f));
