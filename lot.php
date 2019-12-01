<?php
require_once('helpers.php');
require_once('config.php');
require_once('db-functions.php');
require_once('functions.php');
require_once('db.php');

$is_auth = rand(0, 1);

//вызываем список категорий
$categories = get_new_categories($db_con);

//вызываем функцию по проверке id лота
$lot = get_new_lot_id($db_con);

//вызываем функцию по созданию новой ставки
$rates = get_new_rates($db_con);

$page_content = include_template('lot.php', ['categories' => $categories,'lot' => $lot, 'rates' => $rates, 'is_auth' => $is_auth]);

$layout_content = include_template('layout.php', [
    'page_content' => $page_content,
    'categories' => $categories,
    'lots' => $lot,
    'rates' => $rates,
    'title' => 'Страница лота',
    'user_name' => $name,
    'is_auth' => $is_auth,
]);

print($layout_content);

$page_content = include_template('main.php', ['categories' => $categories, 'lots' => $lots]);
