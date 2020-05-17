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
        <p>usernote:   <textarea type="text" name="usernote" rows="15" cols="50"></textarea></p>
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
//подсчитываем кол-во строк
$num_rows = mysqli_num_rows($usernotes);
//распаковываем таблицу построчно
while ($usernote = mysqli_fetch_array ($usernotes, MYSQLI_ASSOC)) {
    //вставляем <br> перед \r\n, \n\r, \n, \r
    $note = nl2br($usernote['usernote']);
    echo <<<NOTE
    <p margin='15em'>$usernote[username] написал:<br>
        $note<br>
        $usernote[created_at]
    </p>
    <p align="right" border='1px'>
        <a href="$_SERVER[REQUEST_URI]&del={$usernote['id']}">
        удалить</a>
    </p>
    NOTE;
}

    // mysqli_query ($link, "CREATE TABLE IF NOT EXISTS usernotes (
    //     id int not null auto_increment primary key,
    //     username varchar (50) not null default '',
    //     usernote text,
    //     created_at timestamp default now() 
    // )") ;