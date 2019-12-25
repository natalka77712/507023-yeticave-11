<?php
require_once('helpers.php');
require_once('config.php');
require_once('db_functions.php');
require_once('functions.php');
require_once('db.php');

//вызываем список категорий
$categories = get_categories($db_con);

$lot_id = isset($_GET['id']) ? intval($_GET['id']) : "HTTP/1.0 404 Not Found";

//вызываем функцию по проверке id лота
$lot = get_new_lot_id($db_con, $lot_id);

//вызываем функцию по созданию новой ставки
$rates = get_new_rates($db_con, $lot_id);

if (isset($lot))
{
    $page_content = include_template('lot.php', ['categories' => $categories,'lot' => $lot, 'rates' => $rates, 'is_auth' => $is_auth]);

    $layout_content = include_template('layout.php', [
        'page_content' => $page_content,
        'categories' => $categories,
        'lots' => $lot,
        'rates' => $rates,
        'title' => $lot['lot_name'],
        'user_name' => $name,
        'is_auth' => $is_auth,
    ]);

    print($layout_content);

    $page_content = include_template('main.php', ['categories' => $categories, 'lots' => $lots]);
}
else {
    header("HTTP/1.0 404 Not Found");
}
