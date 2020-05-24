<?php
use DbException;
require "INewsDB.class.php";

class NewsDB implements INewsDB
{

    const DB_HOST = "localhost";
    const DB_LOGIN = "master";
    const DB_PASSWORD = '3569';
    const DB_NAME = 'enews';

    const ERR_PROPERTY = "wrong property name";

    const RSS_NAME = "rss.xml";
    const RSS_TITLE = "новостная лента";
    const RSS_LINK = "http://projectphp/enews/news.php";

    private $_db;

    // SQLite3
    // const DB_NAME = "../news.db";

    function __construct()
    {
        //     $this->_db = new SQLite3(self::DB_NAME);
        $this->_db = new mysqli(
            self::DB_HOST, 
            self::DB_LOGIN, 
            self::DB_PASSWORD, 
        );
        if ($this->_db->connect_error){
            $error = "{$this->_db->connect_errno}: {$this->_db->connect_error}";
            exit ($error);
        }

        try {
            //создаем базу данных
            $query = "CREATE DATABASE IF NOT EXISTS enews";

            if (!$this->_db->query ($query)){
                throw new DbException("error CREATE DATABASE IF NOT EXISTS enews");
            }
            $this->_db->select_db(self::DB_NAME);
    

            //создаем таблицу msgs
            $query = "CREATE TABLE IF NOT EXISTS msgs (
                    id INT PRIMARY KEY AUTO_INCREMENT,
                    title TEXT,
                    category INT,
                    description TEXT,
                    sourse TEXT,
                    datetime INTEGER)";
            if (!$this->_db->query ($query)){
                throw new DbException("error CREATE TABLE IF NOT EXISTS msgs");
            }
            //создаем таблицу categories
            $query = "CREATE TABLE IF NOT EXISTS category (
                id INTEGER,
                name TEXT
            )";
            if (!$this->_db->query ($query)){
                throw new DbException("error CREATE TABLE IF NOT EXISTS category");
            }

            $query = "SELECT * FROM category";
            $result = $this->_db->query ($query);
            if (!$result->num_rows) {
                $query = "INSERT INTO category (id, name)
                    VALUES (1, 'политика'),
                    (2, 'культура'),
                    (3, 'спорт')";
                if (!$this->_db->query ($query)){
                    throw new DbException("error INSERT INTO category");
                }
            }
       } catch (DbException $error) {
            exit ($error->getMessage());
       }
    }

    function __destruct()
    {
        // unset ($this->_db);
        $this->_db->close();
    }
    function __get ($name)
    {
        if ($name == "db") {
            return $this->_db;
        }
        throw new Exception (self::ERR_PROPERTY);
    }
    function __set ($name, $value)
    {
        throw new Exception (self::ERR_PROPERTY);
    }
    function saveNews ($title, $category, $description, $sourse)
    {
        $datetime = time ();
        $sql = "INSERT INTO msgs (
                title, 
                category, 
                description, 
                sourse,
                datetime) 
            VALUES (
                '$title', 
                $category, 
                '$description', 
                '$sourse',
                $datetime)";
        $result =  $this->_db->query($sql);
        if (!$result) {
            return false;
        }
        $this->createRss ();
        return true;
    }
    function db2arr ($data)
    {
        $arr = [];
        while ($row = $data->fetch_assoc()) {
            $arr[] = $row;
        }
        return $arr;
    }
    function getNews ()
    {
        $query = "SELECT  msgs.id as id,
            title, 
            category.name as category, 
            description, 
            sourse,
            datetime 
        FROM msgs
        JOIN category
        WHERE category.id = msgs.category
        ORDER BY id DESC";
        $msgs = $this->_db->query($query);
        return $this->db2arr($msgs);
    }
    function deleteNews ($id)
    {
        $query = "DELETE FROM msgs WHERE id = $id";
        return $this->_db->query ($query);
    }

    function escape ($data)
    {
        return $this->_db->real_escape_string(trim(strip_tags($data)));
    }

    private function createRss ()
    {
        $dom = new DOMDocument ();

        //для правильного форматирования документа
        $dom->formatOutput = true;
        $dom->preserveWhiteSpace = false;

        $rss = $dom->createElement ("rss");
        $version = $dom->createAttribute ("version");
        $version->value = "2.0";
        $rss->appendChild ($version);
        $dom->appendChild ($rss);

        $channel = $dom->createElement ("channel");       
        $title = $dom->createElement ("title", self::RSS_TITLE);
        $link = $dom->createElement ("link", self::RSS_LINK);
        $channel->appendChild ($title);
        $channel->appendChild ($link);
        $rss->appendChild ($channel);
        
        $lenta = $this->getNews ();
        if (!$lenta) return false;
        foreach ($lenta as $news) {
            $item = $dom->createElement ("item");
            $title = $dom->createElement ("title", $news['title']);
            $category = $dom->createElement ("category", $news['category']);
            $description = $dom->createElement ("description");
            $cdata = $dom->createCDATASection ($news['description']);
            $description->appendChild ($cdata);
            $linkText = self::RSS_LINK . '?id=' . $news['id'];
            $link = $dom->createElement ("link", $linkText);

            $date = date ('r', $news['datetime']);
            $pubdate = $dom->createElement ("pubdate", $date);
            $item->appendChild ($title);
            $item->appendChild ($link);
            $item->appendChild ($description);
            $item->appendChild ($pubdate);
            $item->appendChild ($category);
            $channel->appendChild ($item);
        }
        $dom->save (self::RSS_NAME);
    }
}

// $news = new NewsDB();
// var_dump ($news->db->warning_count);
// var_dump (get_class_methods ('mysqli'));
// var_dump (get_class_vars ('mysqli'));