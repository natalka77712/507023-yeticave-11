<?php
require_once('helpers.php');
require_once('config.php');
require_once('functions.php');
require_once('db.php');

//запрос на получение новых лотов
$lots_sql = 'SELECT lots.id AS lot_id, lots.name AS lot_name, create_date, finish_date, start_price, image, start_price + step AS current_price,
            categories.name AS category_name FROM lots
            JOIN categories ON lots.category_id = categories.id
            ORDER BY lots.create_date DESC';

$id = intval($_GET['id']);
$lots_result = mysqli_query($db_con, $lots_sql);

//успешное выполнение запроса
if (!$lots_result) {
    $error = mysqli_error($db_con);
    print("Ошибка: Невозможно подключиться к MySQL " . $error);
} else {
    //формируем двухмерный массив
    $lots = mysqli_fetch_all($lots_result, MYSQLI_ASSOC);
}
//запрос на список категорий
$categories_sql = 'SELECT name, symbol_code FROM categories';
$categories_result = mysqli_query($db_con, $sql);

if (!$categories_result) {
    $error = mysqli_error($db_con);
    print("Ошибка: Невозможно подключиться к MySQL " . $error);
} else {
    $categories = mysqli_fetch_all($categories_result, MYSQLI_ASSOC);
}
// передаем в шаблон результат выполнения
$page_content = include_template('main.php', ['categories' => $categories, 'lots' => $lots]);

$layout_content = include_template('layout.php', [
	'page_content' => $page_content,
    'categories' => $categories,
    'products' => $products,
	'user_name' => $user_name,
    'title' => 'Yeti Cave - Главная страница',
    'is_auth' => $is_auth,
]);

print($layout_content);
