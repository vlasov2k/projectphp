<?php
// include 'vendor/autoload.php';
//подключаем cookie
include_once "inc/cookie.inc.php";
//подключаем функции
include_once "functions/functions.php";
//подключаем логгирование
const PATH_LOG = "./logs/path.log";
include "inc/logging.php";

//че тут непонятного, чтоб не лезть в реестр тут прописал
ini_set ('display_errors', '1');


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
                echo $page;
                echo "
                <form action='$page' method='post'>
                    <p>input name
                        <input type='text'name='name'>
                    </p>
                    <p>
                        <input type='submit'>
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
<div align='center'>
   <footer style='bottom:2em;display:flex;'>
        <p stile='justify-content:center;'><?= $year?></p>  
    </footer> 
</div>
</body>
</html>

