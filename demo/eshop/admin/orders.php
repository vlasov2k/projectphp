<?php
require "../inc/lib.inc.php";
require "../inc/config.inc.php";

$orders = getOrders();
// var_dump($orders);

?>
<!DOCTYPE html>
<html>
<head>
    <title>поступившие заказы</title>
    <meta charset="utf-8">
</head>
<body>
<a href = "index.php">admin</a>
<a href = "add2cat.php">add2cat</a>
<a href = "orders.php">orders</a>
<?php

if (!$orders) {
    echo "заказов нет";
    exit;
} else {
    foreach ($orders as $order) {
        // $date = $order["date"];
        $date = date("d-m-Y H:m", $order["date"]);
?>
<h2><p>заказ номер: <?= $order["orderid"]?></p></h2>
<p>заказчик: <?= $order["name"]?></p>
<p>email: <?= $order["email"]?></p>
<p>телефон: <?= $order["phone"]?></p>
<p>адрес доставки: <?= $order["address"]?></p>
<p>дата размещения заказа: <?= $date?></p>

<p>купленные товары:</p>

<table border="1" cellpadding="5" cellspacing="0" width="100%">
    <tr>
        <th>№ п/п</th>
        <th>название</th>
        <th>автор</th>
        <th>год издания</th>
        <th>цена</th>
        <th>количество</th>
    </tr>
    <?php

$i = 0;
$sum = 0;

foreach ($order['goods'] as $goods) {
    ?>
        <tr>
            <td><?= ++$i?></td>
            <td><?= $goods['title']?></td>
            <td><?= $goods['author']?></td>
            <td><?= $goods['pubyear']?></td>
            <td><?= $goods['price']?></td>
            <td><?= $goods['quantity']?></td>
        </tr>
    <?php
    $sum += $goods['price'] * $goods['quantity'];
}
?>
</table>
<p>сумма: <?= $sum?><br></p>
<?php
     }// конец фурыча
}
?>
</body>
</html>