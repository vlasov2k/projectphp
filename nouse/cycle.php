<?php
//вызов функции разворота строки вертикально
vertical_string ( "HELLO" );

//функция, разворачивающая строку вертикально
function vertical_string ( $str ){
	$str_num = strlen($str);
	$i = 0;
	while( $i < $str_num ) {
		echo $str{$i++}."\n";	
	}
}
