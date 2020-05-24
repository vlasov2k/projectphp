<?php
$name = strip_tags ($_POST["name"]);
$age = $_POST["age"] * 1;
var_dump ($GLOBALS);
?>
<!DOCTYPE html>
<html>
<head>
<title>Передача данных методом POST через сокет</title>
</head>
<body>
<h1>Передача данных методом POST через сокет</h1>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($name and $age) {
        echo "hello, $name<br>you are $age<br>";
    } else {
        echo "<h3>нет данных<h3><br>";
    }
}
?>
</body>
</html>
