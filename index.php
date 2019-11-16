<?php
require_once('helpers.php');
require_once('data.php');
require_once('functions.php');

//устанавливаем и проверяем соединение с базой данных
$db_con = mysqli_connect($db['host'], $db['user'], $db['password'], $db['database']);

if (!$db_con) {
    $error = mysqli_connect_error();
    print("Ошибка: Невозможно подключиться к MySQL " . $error);
} else {
    mysqli_set_charset($db_con, "utf8");
//запрос на получение новых лотов
    $sql = "SELECT name, start_price, image, start_price + step AS current_price, category_id FROM lots
            WHERE finishing_date > NOW()
            SELECT l.*, c.name FROM lots 1
            LEFT JOIN categories c ON 1.category_id = c.id
            WHERE l.id = $id
            ORDER BY lots.create_date DESC";

    $id = intval($_GET['id']);
    $result = mysqli_query($db_con, $sql);
}
//успешное выполнение запроса
if (!$result) {
    $error = mysqli_error($db_con);
    print("Ошибка: Невозможно подключиться к MySQL " . $error);
} else {
    //формируем двухмерный массив
    $goods = mysqli_fetch_all($result, MYSQLI_ASSOC);
    // передаем в шаблон результат выполнения
    $page_content = include_template("index.php", ['goods' => $goods]);
}
//запрос на список категорий
$sql = "SELECT `name` FROM `categories`;";
$result = mysqli_query($db_conf, $sql);

if (!$result) {
    $error = mysqli_error($db_con);
    print("Ошибка: Невозможно подключиться к MySQL " . $error);
} else {
    $categories = mysqli_fetch_all($result, MYSQLI_ASSOC);
}

$is_auth = rand(0, 1);
$user_name = 'Наталья';
date_default_timezone_set('Europe/Moscow');

$page_content = include_template('main.php', ['products' => $products, 'categories' => $categories]);

$layout_content = include_template('layout.php', [
	'page_content' => $page_content,
    'categories' => $categories,
    'products' => $products,
	'user_name' => $user_name,
    'title' => 'Yeti Cave - Главная страница',
    'is_auth' => $is_auth,
]);

print($layout_content);
