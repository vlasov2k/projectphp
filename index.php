<?php
//подключаем cookie
include_once "inc/cookie.ink.php";
//подключаем функции
include_once "functions.php";


//инициализируем заголовки страницы
headerInit($id);
?>
<!DOCTYPE html> 
<html lang="ru"> 
<head> 
        <title><?php echo $title?></title> 
        <meta charset="utf-8"/> 
        <link rel="stylesheet" href="css/style.css"> 
</head>
<body>
<!--  навигационное меню -->
    <div class="nav_bar">
        <ul style='display:flex;justify-content: space-around;'>
            <?php
                expand_bar( $nav_bar, $isVertical );
            ?>
        </ul>
    </div>
<!-- приветствие  -->
    <div class="greeting">
        <?php
            greeting ($welcome, $name);
        ?>
    </div>
<!-- заголовок -->
    <div class="header">
        <header>
            <h1><?php echo $header?></h1>
            <blockquote>
                <?php
                    if ($visitCounter == 1){
                        echo "thanks for visit";
                    } else {
                        echo "u r $visitCounter times here<br>";
                        echo "last visit: $lastVisit";
                    }
                ?>
            </blockquote>
        </header>
    </div>
<!-- форма input name-->
    <div class="input_name">
        <?php
            if(!$_COOKIE['name']){
                $page = $_SERVER['REQUEST_URI'];
                echo "
                <form action='$page' method='post'>
                    <p>input name
                        <input type='text'name='name'>
                        <p>
                            <input type='submit'>
                        </p>
                    </p>
                </form>
                ";
            }
        ?>
    </div>
<!-- контент -->
    <?php    
        contentRendering($id);
    ?>   
<!-- нижняя часть страницы -->
   <footer style='text-align:center;'>
        <?= $year ?>  
    </footer> 
</body>
</html>

