<?php
const DB_HOST = "localhost";
const DB_LOGIN = "master";
const DB_PASSWORD = '3569';
const DB_NAME = 'eshop';

const ORDERS_LOG = 'orders.log';

$basket = [];
$count = 0;

$link = mysqli_connect (
    DB_HOST, 
    DB_LOGIN, 
    DB_PASSWORD, 
    DB_NAME) or exit (mysqli_connect_error()
) ;

basketInit();