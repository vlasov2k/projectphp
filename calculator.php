
<?php

// инициируем калькулятор
if($_SERVER['REQUEST_METHOD'] == 'POST'){   
    $x =  clearInt( $_POST['x'] );
    $y =  clearInt( $_POST['y'] );
    $operator =  clearStr ( $_POST['operator'] ) ;

    $result = "$x $operator $y = ";

    switch ( $operator ) {
        case '+':
            $result .= $x + $y;
        break;
        case '-':
            $result .= $x - $y;
        break;
        case '*':
            $result .= $x * $y;
        break;
        case '/':
            if ( $y == 0 ) {
                $result  = "на ноль не делим";
            } else {
                $result .= $x / $y;
            }            
        break;
        default: $result = "not an operator";
    }
}
?>

<!--форма калькулятор-->
<form action="<?= $_SERVER['REQUEST_URI']?>" method="POST" name="calculator">
    <p>number 1:   
        <input 
            type="number"  
            name="x"
            value='<?=$x?>'>
    </p>
    <p>operator:   
        <input 
            type="text"  
            name="operator"
            required 
            pattern="+-*/"
            placeholder="+-*/"
            value='<?=$operator?>'>
    </p>
    <!-- <p>operator:   
        <select form = "calculator">
            <option value="+">+
            </option>
            <option value="-">-
            </option>
            <option value="*">*
            </option>
            <option value="/">/
            </option>
        </select>
    </p> -->
    <p>number 2:   
        <input 
            type="number"  
            name="y"
            value='<?=$y?>' />
    </p>
    <p>result:   
        <input 
            type="text"  
            name="result" 
            readonly
            value='<?=$result?>'>
    </p>
    <p>   
        <input 
            type="reset">
    </p>

    <p><input type="submit" /></p>
</form>