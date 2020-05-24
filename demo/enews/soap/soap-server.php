<?php
require "../NewsDB.class.php";

class NewsService extends NewsDB
{
    //метод возвращает новость по ее id
    function getNewsById ($id)
    {
        try {

            $sql = "SELECT 
                    msgs.id as id, 
                    title, 
                    category.name as category, 
                    description,
                    sourse,
                    datetime
                FROM msgs
                JOIN category
                WHERE 
                    category.id = msgs.category and msgs.id=$id";
            
            $result = $this->db->query($sql);
            if (!is_object ($result)) {
                throw new DbException ($this->db->error);
            }
            return base64_encode (serialize ($this->db2arr ($result)));
        } catch (DbException $error) {
            throw new SoapFault ('getNewsById', $error->getMessage());
        }
    }

    //считает количество всех новостей
    function getNewsCount ()
    {
        try {
            $sql = "SELECT id COUNT FROM msgs";
            $result = $this->db->query($sql);
            if (!is_object ($result)) {
                throw new DbException ($this->db->error);
            }
            return $result->num_rows;
        } catch (DbException $error) {
            throw new SoapFault ('getNewsCount', $error->getMessage());
        }
    }

    //считает количество всех новостей в категории
    function getNewsCountByCat ($cat_id)
    {
        try {
            $sql = "SELECT id COUNT FROM msgs WHERE category=$cat_id";
            $result = $this->db->query($sql);
            if (!is_object ($result)) {
                throw new DbException ($this->db->error);
            }
            return $result->num_rows;
        } catch (DbException $error) {
            throw new SoapFault ('getNewsCount', $error->getMessage());
        }
    }
}
//отключение кэширования WSDL-документа
ini_set ("soap.wsdl_cache_enabled", 0);
//создание SOAP-сервера
$server = new SoapServer (
    "http://projectphp.loc/demo/enews/soap/news.wsdl"
) ;
$server->setClass ("NewsService");

//запуск сервера
$server->handle ();