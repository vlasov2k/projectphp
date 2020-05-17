<?php
// include "config.inc.php";

//функция фильтрации строк
function clearStr ($data) 
{
    global $link;
    $data = trim(strip_tags($data));
    return mysqli_real_escape_string ($link, $data);
}

//функция фильтрации чисел
function clearInt ($data) 
{
    return abs((int)$data); 
}


//сохраняем корзину в куки
function saveBasket () 
{
    global $basket;
    $basket = base64_encode (serialize ($basket));
    setcookie ('basket', $basket, 0x7fffffff);
}

//проверяем есть ли куки
function basketInit () 
{
    global $basket, $count;
    if (!isset($_COOKIE['basket'])) {
        $basket = ['orderid' => uniqid()];
        saveBasket();
    } else {
        $basket = unserialize (base64_decode ($_COOKIE['basket']));
        $count = count ($basket) -1;
    }
}

//
function add2Basket ($id) 
{
    global $basket;
    $basket[$id] = 1;
    saveBasket();
}

//функция, отправляющая запрос на добавление записи в catalog
function addItemToCatalog ($title, $author, $pubyear, $price, $link) 
{
    $sql = "INSERT INTO catalog (title, author, pubyear, price) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param ($stmt, "ssii", $title, $author, $pubyear, $price);
    mysqli_stmt_execute ($stmt);
    mysqli_stmt_close ($stmt);
    return true;
}

//функция, возвращающая корзину
function myBasket ()
{
    global $link, $basket;
    // $orderid = $basket['orderid'];
    $goods = array_keys ($basket);
    array_shift ($goods);
    if (!$goods) return false;
    $ids = implode (",", $goods);
    $sql = "SELECT id, author, title, pubyear, price
        FROM catalog WHERE id IN ($ids)";
    if (!$result = mysqli_query($link, $sql))
        return false;
    $items = result2Array($result);
    // foreach ($items as $item) {
    //     $item['orderid'] = $orderid;
    // }
    mysqli_free_result ($result);
    return $items;
}

function result2Array ($data)
{
    global $basket;
    $arr = [];
    while ($row = mysqli_fetch_assoc ($data)) {
        $row['quantity'] = $basket[$row['id']];
        $arr[] = $row;
    }
    return $arr;
}

//функция удаляющая позицию из корзины
function deleteItemFromBasket($id) 
{
    global $basket;
    unset($basket[$id]);
    saveBasket ();
}

//функция удаляющая корзину
function removeBasket ()
{
    setcookie ('basket', 'removed', time()-3600);
}

//распаковываем каталог в html
// function showCatalog () {
//     global $link;
//     $html_catalog = '';
//     $query = "SELECT id, author, title, pubyear, price
//         FROM catalog";
//     $catalog = mysqli_query ($link, $query);

//     while ($lot = mysqli_fetch_array ($catalog, MYSQLI_ASSOC)) {
//         $html_catalog .= <<<NOTE
//         <p>автор: $lot[author]<br>
//             книга: $lot[title]<br>
//             год выпуска: $lot[pubyear]<br>
//             цена: $lot[price]
//         </p>
//         NOTE;
//     }
//     return $html_catalog;
// }


//функция выборки товара из каталога
function selectAllItems() 
{
    global $link;
    $sql = 'SELECT id, title, author, pubyear, price
        FROM catalog';
    if (!$result = mysqli_query ($link, $sql))
        return false;
    $items = mysqli_fetch_all ($result, MYSQLI_ASSOC);
    mysqli_free_result ($result);
    return $items;
}

//
function saveOrder ($datetime)
{
    global $link, $basket;
    $goods = myBasket();
    $stmt = mysqli_stmt_init($link);
    $sql = "INSERT INTO orders (
            title,
            author,
            pubyear,
            price,
            quantity,
            orderid,
            datetime)
        VALUES (?,?,?,?,?,?,?)";
    if (!mysqli_stmt_prepare ($stmt, $sql))
        return false;
    foreach ($goods as $item) {
        mysqli_stmt_bind_param ($stmt, "ssiiisi",
            $item['title'],
            $item['author'],
            $item['pubyear'],
            $item['price'],
            $item['quantity'],
            $basket['orderid'],
            $datetime);            
        mysqli_stmt_execute($stmt);
    }
    mysqli_stmt_close($stmt);
    removeBasket();
    return true;
}

function getOrders ()
{
    global $link;
    if (!is_file(ORDERS_LOG)) {
        return false;
    }
    //получаем в виде массива персональные данные
    $orders = file (ORDERS_LOG);
    //массив который будет возвращен функцией
    $allOrders = [];
    foreach ($orders as $order) {
        list ($name, $email, $phone, $adress, $orderid, $date) = explode ("|", $order);
        //промежуточный массив для хранения информации о заказе
        $orderinfo = [];
        //сохранение информации о пользователе
        $orderinfo['name'] = $name;
        $orderinfo['email'] = $email;
        $orderinfo['phone'] = $phone;
        $orderinfo['address'] = $adress;
        $orderinfo['orderid'] = $orderid;
        $orderinfo['date'] = $date;
        //sql запрос на выборку из таблицы orders всех товаров для конкретного покупателя
        $sql = "SELECT title, author, pubyear, price, quantity
            FROM orders
            WHERE orderid = '$orderid' AND datetime = $date";
        //получение результата выборки
        if (!$result = mysqli_query($link, $sql)) return false;
        $items = mysqli_fetch_all ($result, MYSQLI_ASSOC);
        mysqli_free_result($result);
        //сохранение результата в промежуточном массиве
        $orderinfo["goods"] = $items;
        //добавление промежуточного массива в возвращаемый массив
        $allOrders[] = $orderinfo;
    }
    return $allOrders;
}