<?php
session_start();
if (!isset ($_SESSION['admin'])) {
    header ("location: /eshop/admin/secure/login.php?ref=". $_SERVER['REQUEST_URI']);
    exit;
}