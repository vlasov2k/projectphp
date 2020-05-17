<?php

require "inc/lib.inc.php";
require "inc/config.inc.php";

//принимаем и фильтруем id удаляемой позиции
$id = clearInt($_GET["id"]);
if ($id) {
    deleteItemFromBasket($id);
    header ("location: basket.php");
    exit;
}
