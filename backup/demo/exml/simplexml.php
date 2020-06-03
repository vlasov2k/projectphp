<?php
header ("Content-Type: text/html; charset=utf-8");
//загружаем документ и преобразуем его в объект
$sxml = simplexml_load_file ("catalog.xml");

function sxml2html ($sxml) {
    foreach ($sxml->book as $book) {
        $result .= "<tr>";
        $result .=  "<td>{$book->author}</td>";
        $result .=  "<td>{$book->title}</td>";
        $result .=  "<td>{$book->pubyeat}</td>";
        $result .=  "<td>{$book->price}</td>";

        $result .= "</tr>";
    }
    return $result;
}
$result = sxml2html ($sxml);
?>
<html>
<head>
    <title>Каталог</title>
</head>
<body>
    <h1>Каталог книг</h1>
    <table border="1" width="100%">
        <tr>
            <th>автор</th>
            <th>название</th>
            <th>год издания</th>
            <th>цена, руб</th>
        </tr>
        <?php
        // парсинг
        echo $result;
        ?>
    </table>
</body>
</html>