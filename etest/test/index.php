<?php
session_start();
if(!isset($_SESSION['test']) and !isset($_POST['q'])) {
    //инициализируем переменные, если запуск теста первый
    $q = 0; // номер текущего вопроса
    $title = 'пройдите тест';
} else {
    //создаем сессионную переменную test, содержащую массив ответов
    if (($_POST['q']) != '1')
        $_SESSION['test'][] = $_POST['answer'];
    $q = $_POST['q'];
    $title = $_POST['q'];
}

?>
<!--верхняя часть страницы-->

<?= $title?>

<!--область основного контента-->

<?php
// в зависимости от номера вопроса,
// подключаем соответствующий файл с вопросами

switch($q) {
    case 0:
        include 'start.php';
    break;
    case 1:
        include 'q1.php';
    break;
    case 2:
        include 'q2.php';
    break;
    case 3:
        include 'q3.php';
    break;
    default:
        include 'result.php';
}
?>




















































<?php
// session_start();
// $sid = session_id();
// echo "<a href='index.php'>home<br></a>";

// echo "welcome<br>";


// if($_POST['start'] == 'yes') {
//     echo "<a href='index.php?id=q1'>q1</a>";
// }


// if($_SERVER['REQUEST_METHOD'] == 'GET' ){
//     $id = strtolower($_GET['id']);
//     if (empty($id)){
//         $id = "start";
//     }
//     contentRendering($id);
// }

// if($_POST['q1']) {
//     $_SESSION['q1']  = $_POST['q1'];
//     echo "<a href='index.php?id=q2'>next<br></a>";
// }

// if($_POST['q2']) {
//     $_SESSION['q2']  = $_POST['q2'];
//     echo "<a href='index.php?id=q3'>next<br></a>";
// }

// if($_POST['q3']) {
//     $_SESSION['q3']  = $_POST['q3'];
//     echo "<a href='index.php?id=result'>result<br></a>";
// }

// function contentRendering($id){

//     include "$id.php";

// }
?>
