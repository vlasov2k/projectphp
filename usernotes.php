<?php
echo "home sweet some<br>";
?>
<?php
//соединеняемся с базой данных и отслеживаем ошибки при соединении
const DB_HOST = 'localhost';
const DB_LOGIN = 'master';
const DB_PASSWORD = '3569';
const DB_NAME = 'projectphp';

$link = mysqli_connect(DB_HOST, DB_LOGIN, DB_PASSWORD, DB_NAME) or exit (mysqli_connect_error());

    // mysqli_query ($link, "CREATE TABLE IF NOT EXISTS usernotes (
    //     id int not null auto_increment primary key,
    //     username varchar (50) not null default '',
    //     usernote text,
    //     created_at timestamp default now() 
    // )") ;

//сохраняем запись в БД
//проверяем метод запроса
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //получаем данные в переменные
    $username = clearStr($_POST['username']);
    $usernote = clearStr($_POST['usernote']);
    
    //фильтруем полученные данные
    $username = mysqli_real_escape_string ($link,$username);
    $usernote = mysqli_real_escape_string ($link,$usernote);

    //формируем запрос из полученных данных
        // mysqli_query ($link, $query);
    $query = "INSERT INTO usernotes (username, usernote) VALUES (?, ?)";
    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, "ss", $username, $usernote);
    //исполняем запрос
    mysqli_stmt_execute ($stmt);
    mysqli_stmt_close ($stmt);

    //перезапрашиваем страницу методом GET
    header("Location: " . $_SERVER["REQUEST_URI"]);
    exit;
        //если не будет работать - подключаем буферизацию
        //ob_start();
}

//удаляем запись из БД
$usernote_id = null;
//проверяем пришел ли запрос на удаление записи
if (isset ($_GET['del']))
    //инициируем id записи на нудаление
    $usernote_id = abs((int)$_GET['del']);
    //проверяем, инициирован ли id 
    if($usernote_id){
        //формируем запрос к БД
        $query = "DELETE FROM usernotes WHERE id={$usernote_id}";
        mysqli_query ($link, $query);
        //перезапрашиваем страницу, с которой пришел запрос
        header("Location: " . $_SERVER["HTTP_REFERER"]);
        exit;
    }

?>

<!-- форма  -->
    <form action="<?= $_SERVER["REQUEST_URI"]?>" method="POST">
        <p>username:   <input type="text"  name="username" placeholder="username"></p>
        <p>usernote:   <textarea type="text" name="usernote" rows="7" cols="50"></textarea></p>
        <p><input type="submit" /></p>
    </form>

<?php
//выводим записи из базы данных

//формируем запрос к БД
$query = "SELECT id, username, usernote, created_at
     FROM usernotes 
     order by created_at desc";
//получаем таблицу
$usernotes = mysqli_query ($link, $query);

//устанавливаем количество записей на странице
$rows_per_page = 2;
//устанавливаем количество ссылок
$page_links = 5;

if (!isset($_GET['page'])) {
    $_GET['page'] = 1;
}

$page_id = $_GET['page'];

//подсчитываем кол-во строк
$rows_coutn = mysqli_num_rows($usernotes);
// echo "rows_coutn: " . $rows_coutn . "<br>";

//подсчитываем кол-во страниц
$page_count = ceil($rows_coutn/$rows_per_page);
// echo "page_count: " . $page_count . "<br>";

// or (!is_int($page_id)
if($page_id > $page_count or $page_id < 1) {
    $page_id = 1;
}

echo "<h3>page_id: " . $page_id . "</h3><br>";

$offset = --$page_id * $rows_per_page;
// echo "offset: " . $offset . "<br>";

$query = "SELECT id, username, usernote, created_at
    FROM usernotes 
    order by created_at desc
    LIMIT $rows_per_page OFFSET $offset
    ";

$usernotes = mysqli_query($link,$query);

(string)$result = "";

//распаковываем таблицу построчно
while ($usernote = mysqli_fetch_array ($usernotes, MYSQLI_ASSOC)) {
    //фильтр 
    $note = nl2br($usernote['usernote']);

    $result .=<<<NOTE
    {$usernote['id']}
    <p margin='15em'>$usernote[username] написал:<br>
        $note<br>
        $usernote[created_at]
    </p>
    <p align="right" border='1px'>
        <a href="$_SERVER[REQUEST_URI]&del={$usernote['id']}">
        удалить</a>
    </p>
    <hr>
    NOTE;
}
echo $result;

//links

if ($page_id >= 1) {
    //<<
    echo '<a href="index.php?id=usernotes&page=1"><<</a> &nbsp; ';
    echo "<a href='index.php?id=usernotes&page=$page_id'> <</a> &nbsp; ";
}
$current_page_id = $page_id+1;
$start = $current_page_id-$page_count;
$end = $current_page_id+$page_count;

for ($link_id = 1; $link_id <= $page_count; $link_id++) {

    // Выводим ссылки только в том случае, если их номер больше или равен
    // начальному значению, и меньше или равен конечному значению
    if ($link_id>=$start && $link_id<=$end) {

        // Ссылка на текущую страницу выделяется жирным
        if ($link_id==($page_id+1)) {
            echo '<a href="index.php?id=usernotes&page=' . $link_id . '"><strong style="color: #df0000">' . $link_id . '</strong></a> &nbsp; ';
    } else {
            // Ссылки на остальные страницы
            echo '<a href="index.php?id=usernotes&page=' . $link_id . '">' . $link_id . '</a> &nbsp; ';
        }
    }
}

if ($link_id>$page_id && ($page_id+2)<$link_id) {

    // Чтобы попасть на следующую страницу нужно увеличить $pages на 2
    echo '<a href="index.php?id=usernotes&page=' . ($page_id+2) .'"> ></a> &nbsp; ';

    // Так как у нас $link_id = количество страниц + 1, то теперь 
    // уменьшаем его на единицу и получаем ссылку на последнюю страницу
    echo '<a href="index.php?id=usernotes&page=' . ($link_id-1) . 
    '">>></a> &nbsp; ';
}
