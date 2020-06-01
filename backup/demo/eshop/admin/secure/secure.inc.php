<?php
const FILE_NAME = ".htpasswd";
//функция генерирующая хеш пароля
function getHash ($password) 
{
    $hash = password_hash($password, PASSWORD_BCRYPT);
    return $hash;
}

//функция, проверяющая пароль
function checkHash ($password, $hash)
{
    return password_verify ($password, $hash);
}

//функция, создающая новую запись в файле пользователей
function saveUser ($login, $hash)
{
    $str = "$login:$hash\n";
    if (file_put_contents (FILE_NAME, $str, FILE_APPEND))
        return true;
    else
        return false;
}

//функция, проверяющая наличие пользователя в списке
function userExists ($login)
{
    if (!is_file(FILE_NAME))
        return false;
    $users = file (FILE_NAME);
    foreach ($users as $user) {
        if (strpos ($user, $login.';') !== false)
            return trim($user);
    }
    return false;//??
}

//функция завершающая сеанс пользователя
function logOut ()
{
    session_destroy();
    header ("Location: secure/login.php");
    exit;
}