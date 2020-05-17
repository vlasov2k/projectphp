<?php
header ("Content-Type: text/html; charset=utf-8");
//создание парсера
$sax = xml_parser_create ("utf-8");

//функция обработчик начальных тегов
function onStart ($parser, $tag, $attributes) 
{
    if ($tag != 'CATALOG' && $tag != "BOOK") {
        echo "<td>";
    }
    if ($tag == "BOOK") {
        echo "<tr>";
    }
}

//функция обработчик закрывающих тегов
function onEnd ($parser, $tag) 
{
    if ($tag != 'CATALOG' && $tag != "BOOK") {
        echo "</td>";
    }
    if ($tag == "BOOK") {
        echo "</tr>";
    }
}

//функция обработчик текстового содержимого
function onText ($parser, $text) 
{
    echo "$text";
}

//назначение обработчиков начальных и конечных тегов
xml_set_element_handler ($sax, "onStart", "onEnd");

//назначение обработчика текстового содержимого
xml_set_character_data_handler ($sax, "onText");

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
        xml_parse ($sax, file_get_contents ("catalog.xml"));
        ?>
    </table>
</body>
</html>