<?php
(object) $msgs = $news->getNews ();

// var_dump($msgs);

foreach($msgs as $msg) {
    $date = date("d-m-Y H:i:s",$msg['datetime']);
    $description = nl2br($msg['description']);
    $result .=  <<<NEWS
    <div style="border :1px;">
        <p>категория: $msg[category]
            <h3 align="center">$msg[title]</h3>
            $description<br><br>
            источник: $msg[sourse]<br>
            дата публикации: $date
        </p>
        <p align="right">
            <a href="news.php?del={$msg['id']}">
            удалить</a>
        </p>
    </div>
    <hr>
    NEWS;
}
echo $result;
?>
