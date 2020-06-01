<?php
echo $q;
$result = 0; // переменная для суммы ответов
if (isset($_SESSION['test'])) {
    //зачитываем ответы из ini файла в массив
    $answers = parse_ini_file("answers.ini");
    //проходим по ответам и смотрим, есть ли среди них правильные
    foreach($_SESSION['test'] as $value) {
        //сверяем ответы 
        if(array_key_exists($value, $answers))
        //суммируем правильные ответы
        $result += (int) $answers[$value];
    }
    //очищаем данные сессии
    session_destroy();
}
?>

<p>Ваш результат: <?= $result?> из 30</p>

<?php
// настроить ответы в $_SESSION['test']

// $answers = parse_ini_file("./demo/test/answers.ini");
// var_dump ($answers);

// $questions = [
//     "a2",
//     "b3",
//     "c3"
// ];
// $result = 0;
// foreach ($questions as $key){
//     if (array_key_exists($key, $answers)) {
//         echo "answer is $key<br>";
//         $result += $answers[$key];
//         echo $result . "<br>";
//     }

// }
// echo "result is $result"; 
?>
























<?php
// $q1 = $_SESSION['q1'];
// $q2 = $_SESSION['q2'];
// $q3 = $_SESSION['q3'];
// echo $q1;
// echo $q2;
// echo $q3;

// if($q1== 4){
//     $q1 = 10;
// } else {
//     $q1 = 0;
// }

// if($q2== 9){
//     $q2 = 10;
// } else {
//     $q2 = 0;
// }

// if($q3 == 25){
//     $q3 = 10;
// } else {
//     $q3 = 0;
// }

// $r = $q1 + $q2 + $q3;

// echo "<br>result: " . $r . "<br>";