<?php

ini_set ("display_errors", 1);

const RSS_URL = "http://projectphp.loc/demo/enews/rss.xml";

const XML_FILE_NAME = "news.xml";
//Time To Leave
const RSS_TTL = 3600;

function download ($url, $filename)
{
    $file = file_get_contents ($url);
    if ($file) {
        file_put_contents ($filename, $file);
    }
}
if (!is_file (XML_FILE_NAME)) {
    download (RSS_URL, XML_FILE_NAME);
}
// echo date("d-m-Y H:i:s",filemtime (XML_FILE_NAME)) . " время модификации<br>";
// echo date("d-m-Y H:i:s",filemtime (XML_FILE_NAME)+ RSS_TTL) . " время следующей модификации<br>";
// echo date("d-m-Y H:i:s",time());
?>

<!DOCTYPE html>
<html>
<head>
    <title>новостная лента</title>
    <meta charset="utf-8" />
</head>
<body>
    <h1>последние новости</h1>
    <?php
    $xml = simplexml_load_file (XML_FILE_NAME);
    foreach ($xml->channel->item as $item) {
        echo <<<ITEM
            <h3>{$item->title}</h3>
            <p>
                {$item->description}<br>
                {$item->category}<br>
                {$item->pubdate}<br>
            </p>
            <p align="right">
                <a href="{$item->link}">читать дальше</a>
            </p>
        ITEM;
    }
    //если текущее время больше чем текущее + RSS_TTL
    //проверка не закончилось ли время
    if (time() > filemtime (XML_FILE_NAME) + RSS_TTL) {
        download (RSS_URL, XML_FILE_NAME);
    }
    ?>
</body>
</html>