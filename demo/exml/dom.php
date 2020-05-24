<?php
header ("Content-Type: text/html; charset=utf-8");
//создание объекта, экземпляра класса DomDocument
$dom = new DOMDocument();

//загрузка документа
$dom->load ("catalog.xml");

//получение корневого элемента
$root = $dom->documentElement;

function printXml ($root) {
    foreach ($root->childNodes as $book) {
        if ($book->nodeType == 1) {
            $result .= "<tr>";
            foreach ($book->childNodes as $item) {
                if ($item->nodeType ==1) {
                    $result .= "<td>{$item->textContent}</td>";
                }
            }
            $result .= "<tr>";
        }
    }
    return $result;
}

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
        echo printXml ($root);
        ?>
    </table>
</body>
</html>       

<?php
// echo $root->textContent;
// var_dump(get_class_methods($root));
// var_dump(get_object_vars($root));
