<?php
//получаем данные в переменные
$title = $news->escape($_POST['title']);
$category = abs((int)$_POST['category']);
$description = $news->escape($_POST['description']);
$sourse = $news->escape($_POST['sourse']);

if (empty($title) or empty($description)) {
    $errMsg = "заполните поля формы";
} else {
    if (!$news->saveNews ($title, $category, $description, $sourse)) {
        $errMsg = "произошла ошибка при добавлении новости";
    } else {
        header("Location: news.php");
        exit;
            //если не будет работать - подключаем буферизацию
        //ob_start();

    }
}

// //формируем запрос из полученных данных
// // mysqli_query ($link, $query);
// $query = "INSERT INTO msgs (title, category, sourse ) VALUES (?, ?, ?)";
// $stmt = $news->db->prepare($query);
// $stmt->bind_param($stmt, "sss", $title, $category, $sourse);
// //исполняем запрос
// $stmt->execute ();
// $stmt->close ();

// $query = "INSERT INTO msgs (title, category, sourse ) VALUES (?, ?, ?)";
// $stmt = $news->db->prepare($query);
// var_dump ($stmt);
// var_dump (get_class_methods ($stmt));
// var_dump (get_class_vars ('mysqli'));
?>