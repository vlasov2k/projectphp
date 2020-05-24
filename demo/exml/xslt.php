<?php
//загрузка исходного XML-документа
$xml = new DOMDocument ();
$xml->load ("catalog.xml");

//загрузка таблицы стилей XSL
$xsl = new DOMDocument ();
$xsl->load ("catalog.xsl");

//создание XSLT процессора
$processor = new XSLTProcessor ();

//загрузка XSL в процессор
$processor->importStylesheet ($xsl);
//выполнение преобразования
echo $processor->transformToXml ($xml);