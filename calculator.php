
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

$x = $x ?? '';
$operator = $operator ?? '';
$y = $y ?? '';
$result = $result ?? '';

/*форма калькулятор*/
$calculator=<<<CALCULATOR
    <form action="{$_SERVER['REQUEST_URI']}" method="POST" name="calculator" align='center'>
        <p>number 1:   
            <input 
                type="number"  
                name="x"
                size="1"
                value='$x'>
        </p>
        <p>operator:   
            <select name="operator" value='$operator'>
                <option value="+">+
                </option>
                <option value="-">-
                </option>
                <option value="*">*
                </option>
                <option value="/">/
                </option>
            </select>
        </p>
        <p>number 2:   
            <input 
                type="number"  
                name="y"
                value='$y'/>
        </p>
        <p>result:   
            <input 
                type="text"  
                name="result" 
                readonly
                value='$result'>
        </p>
        <p>   
            <input 
                type="reset">
        </p>
        <p><input type="submit" /></p>
    </form>
CALCULATOR;

echo $calculator;