<?php

class SuperUser extends User
{
    static public $superUserCount = 0;

    function showInfo()
    {
        parent::showInfo();
        echo "&nbsp;type: $this->type<br>\n<br>\n";
    }

    function __construct($name, $login, $password, $type)
    {
        //оставляем из родительского класса три значения и дописываем четвертое
        parent::__construct ($name, $login, $password);
        $this->type = $type;
        
        ++self::$superUserCount;
        --parent::$userCount;
    }

    function __clone ()
    {
        ++self::$superUserCount;
    }

}
