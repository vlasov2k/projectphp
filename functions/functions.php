<?php
//функции фильтрации данных
    function clearInt ( $data ) {
        return (int) $data;
    }
    function clearStr ( $data ) {
        return trim ( strip_tags ( $data ) );
    }

// инициализация заголовков страницы
    // $title = "about jon connor";
    // $header = "home";

    $id = strtolower(clearStr($_GET['id']));
    if (empty($id))
        $id = "home";
// функция, инициализирующая заголовки страницы
    function headerInit ($id)
    {
        $GLOBALS['title'] = $GLOBALS['header'] = $id;
        
        // switch ($id) {
        //     case 'article':
        //         $GLOBALS['title'] = 'article';
        //         $GLOBALS['header'] = 'article';
        //     break;
        //     case 'table':
        //         $GLOBALS['title'] = 'table';
        //         $GLOBALS['header'] = 'table';
        //     break;
        //     case 'phpinfo':
        //         $GLOBALS['title'] = 'phpinfo';
        //         $GLOBALS['header'] = 'phpinfo';
        //     break;
        //     case 'calculator':
        //         $GLOBALS['title'] = 'calculator';
        //         $GLOBALS['header'] = 'calculator';
        //     break;
        // }
    }

// инициируем переменную $welcome
    $hour = (int)strftime('%H');
    $welcome = "good day";
    if ( $hour < 12 && $hour >= 7) {
        $welcome =  "good morning";
    } elseif ( $hour >= 17) {
        $welcome = "good evening";
    } elseif ( $hour <7 ) {
        $welcome = "goodnight";
    }

// установка локали и выбор значения даты
	setlocale(LC_ALL, "ru-RU");
	$minute = strftime('%M');
	$hour = (int)strftime('%H');
	$day = strftime('%d');
	$mon = strftime('%B');
	$mon = iconv("windows-1251","UTF-8", $mon);
	$year = strftime('%Y');
    $date = "$day $mon $year<br>$hour:$minute<br>";

// функция приветствия с выводом имени и времени суток
    function greeting ( $w="hello", $n ) 
    {
        echo "<div 
            style='
                display: flex;
                justify-content: end;
                display:-webkit-flex;
                justify-content:flex-end;
                margin-right:5em;
                '>$w, $n ";
        echo "<br>today is $GLOBALS[date]</div>"; 
    }

// инициализация навигационной панели

//TODO Посмотреть пример роутинга
    $allowedRoutes = [
        'forum' => [
            'controller' => ForumController::class,
            'sub_resources' => [
                '/' => 'index',
                '/edit' => 'change' // где доп.слаг соответствует какому то методу контроллера
            ]
        ],
        'home' => [
            'controller' => HomeController::class,
            'sub_resources' => [
                '/' => 'index',
                '/out' => 'out',
                '/changePassword' => 'editPassword'
            ]
        ],
    ];

    $url = '/forum/page1.html';

    $urlAsArray = explode('/', $url);
    $firstSlag = current(reset($urlAsArray));

    if ($allowedRoutes[$firstSlag]) {
        return (new $allowedRoutes[$firstSlag])->;
    } else {
        throw new \Exception('Resource doesn\'t exist');
    }



    $nav_bar = [ 
        ["href" => "index.php?id=home", "link" => "home" ],
        ["href" => "index.php?id=article", "link" => "article"],
        ["href" => "index.php?id=table", "link" => "math table"],
        ["href" => "index.php?id=oop", "link" => "oop"],
        ["href" => "index.php?id=calculator", "link" => "calculator"],
        ["href" => "index.php?id=usernotes", "link" => "usernotes"],
        ["href" => "index.php?id=log", "link" => "log"],
        ["href" => "index.php?id=info", "link" => "phpinfo"]
    ];

// функция динамического отображения навигационной панели
    $isVertical = "";
    function expand_bar ( $arr,  $vertical = false ) 
    {
        //  ставим значение по умолчанию, если в $vertical пришло не булево  
        // if ( !is_bool ( $vertical ) ) {
        //     $vertical = true;
        // }

        if(!is_array($arr)) {
            return false;
        }
        
        $style = "";

        if ( !$vertical ) {	
            $style = " 
                style=' display:inline;margin-right:15px'";
        }	

        foreach( $arr as $value ) {
            echo "
                <li$style>
                <a href='{$value['href']}'>{$value['link']}</a>
                </li> ";
            }	
        return true;
    }

// функция динамической отрисовки контента
    function contentRendering($id)
    {
        include "$id.php";

        // switch ($id) {
        //  case '':
        //      include 'home.php';
        //  break;
        //  case 'article':
        //      include 'article.php';
        //  break;
        //  case 'table':
        //      include 'table.php';
        //  break;
        //  case 'phpinfo':
        //      include 'info.php';
        //  break;
        //  case 'calculator':
        //      include 'calculator.php';
        //  break;
        //  }
     }


//функция отрисовки динамической таблицы умножения
    function math_table ( $cols, $rows, $color ) {
        //x = tr, y = td
        echo "<table border = '1'>";
        for ( $x = 1; $x <= $rows; $x++ ) {
            echo "<tr>";	
            for ( $y = 1; $y <= $cols; $y++ ) {
                if ( $x == 1 or $y == 1 ) {
                    echo "<th style='background: $color'>" . $x * $y . "</th>";	
                } else {
                    echo "<td>" . $x * $y . "</td>";
                }				
            }	
            echo "</tr>";
        }
        echo "</table>";
    }
