<?php
/* interface INewsDB
    содержит основные тетоды для работы с новостной лентой
*/
interface INewsDB
{
    //добавление новой записи в новостную ленту
    // @param string $title - заголовок новости
    // @param string $category - категория новости
    // @param string $description - текст новости
    // @param string $sourse - источник новости
    // @return boolean - результат успех/ошибка

    function saveNews ($title, $category, $description, $sourse);

    // выборка всех записей из новостной ленты
    // @return array - результат выборки в виде массива

    function getNews ();

    //удаление записи из новостной ленты
    // @param integer $id - идентификатор удаляемой записи
    // @return boolean - результат успех/ошибка

    function deleteNews ($id);
}
