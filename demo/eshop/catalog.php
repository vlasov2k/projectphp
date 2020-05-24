<?php
include "inc/lib.inc.php";
include "inc/config.inc.php";
$goods = selectAllItems();
// if ($goods === false) {echo "ERROR"; exit;}
// if (!count($goods)) {echo "EMPTY";}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Каталог товаров</title>
</head>
<body>

<p>Товаров в <a href="basket.php">корзине</a>: <?= $count?>
</p>

<!--каталог товаров-->
<table border="1" cellpadding="5" cellspacing="0" width="100%">
    <tr>
        <th>название</th>
        <th>автор</th>
        <th>год выпуска</th>
        <th>цена</th>
        <th>в корзину</th>
    </tr>

<?php
// echo showCatalog();

foreach ($goods as $item) {
    ?>
        <tr>
            <td><?= $item['title']?></td>
            <td><?= $item['author']?></td>
            <td><?= $item['pubyear']?></td>
            <td><?= $item['price']?></td>
            <td><a href="add2basket.php?id=<?= $item['id']?>">в корзину</a></td>
        </tr>
    <?php
}

?>

</table>

</body>
</html>