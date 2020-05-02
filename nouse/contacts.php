<?php
//переключатель навигационного меню
$isVertical = false;
include_once "functions/nav_bar.php";	
?>

<form action="action.php" method="post">
 <p>Ваше имя: <input type="text" name="name" /></p>
 <p>Ваш возраст: <input type="text" name="age" /></p>
 <p><input type="submit" /></p>
</form>
Здравствуйте, <?php echo htmlspecialchars($_POST['name']); ?>.
Вам <?php echo (int)$_POST['age']; ?> лет.

