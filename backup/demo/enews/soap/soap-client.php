<?php
try {
    //создание SOAP-клиента
    // ini_set('default_socket_timeout', 10000);
    $client = new SoapClient (
        'http://projectphp.loc/demo/enews/soap/news.wsdl'
    ) ;
    var_dump (get_class_methods($client));
    var_dump($client->__getFunctions()) ;

    $result = $client->getNewsById(5);
    $result2 = $client->getNewsCount();
    $result3 = $client->getNewsCountByCat(2);

    // echo $result;
} catch (SoapFault $exception) {
    echo $exception;
    // echo $exception->getLine();
    // echo $exception->getFile();
    // var_dump (get_class_methods($exception));
}
var_dump (unserialize(base64_decode ($result)));
var_dump ($result2);
var_dump ($result3);
?>