<?php
// фильтруем данные, полученные из input формы параметров таблицы умножения
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $cols = abs ( (int) $_POST['cols'] );
        $rows = abs ( (int) $_POST['rows'] );
        $color = trim ( strip_tags ( $_POST['color'] ) );
    }
// инициируем параметры для функции, разворачивающей таблицу умножения
    $cols = ($cols) ? $cols: 10;
    $rows = ($rows) ? $rows: 10;
    $color = ($color) ? $color: gray;

    // include"test.php";
    // echo $test;
?>
<!-- форма параметров таблицы умножения -->
    <form action="<?= $_SERVER["REQUEST_URI"]?>" method="POST">
        <p>cols:   <input type="number" min = "1" name="cols" placeholder="10"></p>
        <p>rows:   <input type="number" min = "1" name="rows" placeholder="10"/></p>
        <p>color: <input type="color" name="color" value="#bbbbbb"/></p>
        <p><input type="submit" /></p>
    </form>
<!-- таблицы умножения -->
    <div class = "math_table" style = 'content-align:center;';>   
            <?php
                math_table ( $cols, $rows, $color );
            ?>    
    </div>