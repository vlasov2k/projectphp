<?php

// функция перехвата ошибок
function myError ( $errno, $errmsg, $errfile, $errline ) {
    // echo "$errno, $errmsg, $errfile, $errline<br>";
    if ( $errno == E_USER_ERROR ) {
        echo "sorry ...";
        $str = date ( "d-m-Y H:i:s" ) . " - $errmsg in \n\t$errfile:$errline";
        error_log ( "$str\n", 3, "logs/error.log" );
    }

    //логгируем пользовательские ошибки
//     switch ( $errno ) {
//         case E_USER_ERROR:
//         case E_USER_WARNING:
//         case E_USER_NOTICE:
//             error_log ( "$errmsg\n", 3, "error.log") ;
//     }
}

// установка перехватчика ошибок 
// set_error_handler ( "myError" );

//отлавливаем ошибки (генерируем)
// if ( $error ) {
//     trigger_error ( "something wrong", E_USER_ERROR ); "" = $errmsg, E_USER_ERROR = $errno
// }
