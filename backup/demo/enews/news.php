<?php
// use DbException;
// use NewsDB;

function __autoload ($classname)
{
    include "$classname.class.php";
}
$news = new NewsDB;
$errMsg = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require "save_news.inc.php";
}

if (isset ($_GET['del'])) {
    require "delete_news.php";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Новостная лента</title>
    <meta charset="utf-8"/>
</head>
<body>
<h1>Последние новости</h1>
<?php
echo $errMsg;
?>
<!-- форма  -->
<form action="<?= $_SERVER["PHP_SELF"]?>" method="POST">
    выберите категорию: <br>
    <select name="category">
        <!-- <option value="1">политика</option>
        <option value="2">культура</option>
        <option value="3">спорт</option> -->
        <?php
        foreach ($news as $value => $name) {
            echo "<option value='$value'>$name</option>";
        }
        ?>
    </select><br>
    <p>Заголовок новости: <br><textarea name="title" cols="50" ></textarea></p>
    <p>текст новости:   <br><textarea name="description" cols="50" rows="15"></textarea></p>
    <p>источник:   <br><textarea name="sourse"></textarea></p>
    <p><input type="submit" value="добавить" /></p>
</form>
<div>
<?php
include "get_news.php";
?>
</div>
</body>
</html>