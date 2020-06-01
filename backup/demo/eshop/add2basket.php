<?php
require "inc/lib.inc.php";
require "inc/config.inc.php";

$id = clearInt($_GET["id"]);
if ($id) {
    add2Basket($id);
    header ("location: catalog.php");
    exit;
}