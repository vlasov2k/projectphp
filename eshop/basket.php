<?php
require "inc/lib.inc.php";
require "inc/config.inc.php";
// $items = myBasket();
// var_dump ($basket);

?>

<DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>корзина пользователя</title>
</head>
<body>

    <h1>ваша корзина</h1>

    <?php
    $goods = myBasket();
    if (!$count) {
        echo "корзина пуста, вернитесь в <a href='catalog.php'>каталог</a>";
        exit;
    } else {
        echo "вернуться в <a href='catalog.php'>каталог</a>";   
    }
    ?>
<table border="1" cellpadding="5" cellspacing="0" width="100%">
    <tr>
        <th>№ п/п</th>
        <th>название</th>
        <th>автор</th>
        <th>год издания</th>
        <th>цена</th>
        <th>количество</th>
        <th>удалить</th>
    </tr>
<?php
$i = 0;
$sum = 0;

foreach ($goods as $item) {
    ?>
        <tr>
            <td><?= ++$i?></td>
            <td><?= $item['title']?></td>
            <td><?= $item['author']?></td>
            <td><?= $item['pubyear']?></td>
            <td><?= $item['price']?></td>
            <td><?= $item['quantity']?></td>
            <td><a href="delete_from_basket.php?id=<?= $item['id']?>">удалить</a></td>
        </tr>
    <?php
    $sum += $item['price'] * $item['quantity'];
}
?>

</table>
<p>товаров в корзине на сумму: <?= $sum?> руб</p>

<div align='center'>
    <input 
        type='button' 
        value="оформить заказ" 
        onclick="location.href='orderform.php'"/>
</div>

</body>
</html>