<?php
try {
    //создание SOAP-клиента
    // ini_set('default_socket_timeout', 10000);
    $client = new SoapClient (
        'http://projectphp.loc/demo/soap/stock.wsdl'
    ) ;
    // var_dump (get_class_methods($client));
    // var_dump($client->__getFunctions()) ;

    //посылаем SOAP-запрос с получением результата
    $result = $client->getStock ("30");
    echo "текущий запас на складе: " . $result;
} catch (SoapFault $exception) {
    echo $exception->getMessage();
    // echo $exception->getLine();
    // echo $exception->getFile();
    // var_dump (get_class_methods($exception));
}
