<?php
class StockService
{
    //описание функции Web-сервиса
    function getStock ($id) 
    {
        $stock = array (
            "1" => 100,
            "2" => 200,
            "3" => 300,
            "4" => 400,
            "5" => 500
        ) ;
        if (isset ($stock[$id])) {
            return $stock[$id];
        } else {
            throw new SoapFault ("Server", "несуществующий id товара");
        }
    } 
}

    //отключение кэширования WSDL-документа
    ini_set ("soap.wsdl_cache_enabled", 0);
    //создание SOAP-сервера
    $server = new SoapServer (
        "http://projectphp.loc/demo/soap/stock.wsdl"
    ) ;
    //добавляем функцию к серверу
    // $server->addFunction ("getStock");

    //если ООП - просто добавляем класс
    $server->setClass ("StockService");

    //запуск сервера
    $server->handle ();
?>