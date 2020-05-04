<?php
echo "home sweet some<br>";
?>
<?php
session_start();
// сессионные переменные
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $_SESSION['username'] = ($_POST['username']);
        $_SESSION['userageage'] = ($_POST['userageage']);
        var_dump ($_SESSION);
        var_dump ($_SESSION['username']);
        var_dump ($_SESSION['userageage']);
        $sname = session_name();
        $sid = session_id();
        var_dump ($sname);
        var_dump ($sid);
    }

?>
<!-- форма -->
    <form action="<?= $_SERVER["REQUEST_URI"]?>" method="POST">
        <p>name:   <input type="text"  name="username"></p>
        <p>age:   <input type="number" name="userageage"/></p>
        <p><input type="submit" /></p>
    </form>
