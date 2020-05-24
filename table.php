<?php
// фильтруем данные, полученные из input формы параметров таблицы умножения
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $cols = abs ( (int) $_POST['cols'] );
    $rows = abs ( (int) $_POST['rows'] );
    $color = trim ( strip_tags ( $_POST['color'] ) );
    var_dump($GLOBALS) ;
}
// инициируем параметры для функции, разворачивающей таблицу умножения
$cols = $cols ?? 10;
$rows = $rows?? 10;
$color = $color ?? 'gray';

// include "functions/functions.php";
// echo $test;
// xdebug_get_code_coverage();
// var_dump($_SERVER);
?>
<!-- форма параметров таблицы умножения -->
<?php
$table=<<<TABLE
    <form action="{$_SERVER["REQUEST_URI"]}" method="POST" align='center'>
        <p>cols:   <input type="number" min = "1" name="cols" placeholder="10"></p>
        <p>rows:   <input type="number" min = "1" name="rows" placeholder="10"/></p>
        <p>color: <input type="color" name="color" value="#bbbbbb"/></p>
        <p><input type="submit" /></p>
    </form>
TABLE;
echo $table;

?>
<!-- таблицы умножения -->
<div class = "math_table" align='center';>   
    <?php
        math_table ( $cols, $rows, $color );
    ?>    
</div>
