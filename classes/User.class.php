<?php

class User 
{
    public $name;
    public $login;
    public $password;

    public static $userCount = 0;

    function showInfo () 
    {
        $this->info = "&nbsp;user name: $this->name,<br>\n
            &nbsp;user login: $this->login,<br>\n
            &nbsp;user password: $this->password.<br>\n<br>\n"; 
        echo $this->info;
    }

    function __construct ($name, $login, $password)
    {
        $this->login = $login;
        $this->password = $password;
        $this->name = $name;
        ++self::$userCount;
        echo "$name created.<br>\n";
    }

    function __clone ()
    {
        ++self::$userCount;
    }

    function __destruct()
    {
        echo "$this->name destructed.<br>\n";
        --self::$userCount;
    }
}
