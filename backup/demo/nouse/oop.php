<?php
echo "skynet interface\n<br><hr>";

function __autoload ($classname)
{
    include "classes/$classname.class.php";
}

//свойства - переменные экземпляров класса
//константа - константа класса, не принадлежит объекту

$user1 = new User ("jon", "skinetAdmin", "1234");

$superUser = new SuperUser ("terminator", "robot", "1234", "700");

echo "users: " . User::$userCount . "<br>\n";

echo "superusers: " . SuperUser::$superUserCount . "<br>\n";