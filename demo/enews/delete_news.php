<?php
$id = abs((int)$_GET['del']);
if ($id){
    if (!$news->deleteNews($id)) {
        $errMsg = "ошибка при удалении новости";
    } else {
        header ("location: " . $_SERVER['HTTP_REFERER']);
    }
}
