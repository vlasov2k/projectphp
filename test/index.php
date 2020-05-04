<?php
session_start();
$sid = session_id();
echo "<a href='index.php'>home<br></a>";

echo "welcome<br>";


if($_POST['start'] == 'yes') {
    echo "<a href='index.php?id=q1'>q1</a>";
}


if($_SERVER['REQUEST_METHOD'] == 'GET' ){
    $id = strtolower($_GET['id']);
    if (empty($id)){
        $id = "start";
    }
    contentRendering($id);
}

if($_POST['q1']) {
    $_SESSION['q1']  = $_POST['q1'];
    echo "<a href='index.php?id=q2'>next<br></a>";
}

if($_POST['q2']) {
    $_SESSION['q2']  = $_POST['q2'];
    echo "<a href='index.php?id=q3'>next<br></a>";
}

if($_POST['q3']) {
    $_SESSION['q3']  = $_POST['q3'];
    echo "<a href='index.php?id=result'>result<br></a>";
}

function contentRendering($id){

    include "$id.php";

}

