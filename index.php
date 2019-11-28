<?php
require_once('helpers.php');
require_once('unit.php');
require_once('data.php');
require_once('functions.php');
require_once('bd.php');

//запрос на получение новых лотов
$sql = 'SELECT lots.id AS lot_id, lots.name AS lot_name, create_date, finish_date, start_price, image, start_price + step AS current_price, categories.name AS category_name
        FROM lots categories ON lots.category_id = categories.id
        ORDER BY lots.create_date DESC';

$id = intval($_GET['id']);
$result = mysqli_query($db_con, $sql);

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
$sql = "SELECT name FROM categories";
$result = mysqli_query($db_conf, $sql);

if (!$result) {
    $error = mysqli_error($db_con);
    print("Ошибка: Невозможно подключиться к MySQL " . $error);
} else {
    $categories = mysqli_fetch_all($result, MYSQLI_ASSOC);
}

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
