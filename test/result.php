<?php
$q1 = $_SESSION['q1'];
$q2 = $_SESSION['q2'];
$q3 = $_SESSION['q3'];
echo $q1;
echo $q2;
echo $q3;

if($q1== 4){
    $q1 = 10;
} else {
    $q1 = 0;
}

if($q2== 9){
    $q2 = 10;
} else {
    $q2 = 0;
}

if($q3 == 25){
    $q3 = 10;
} else {
    $q3 = 0;
}

$r = $q1 + $q2 + $q3;

echo "<br>result: " . $r . "<br>";