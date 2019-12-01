<?php
require_once('helpers.php');
require_once('config.php');
require_once('db-functions.php');
require_once('functions.php');
require_once('db.php');

$is_auth = rand(0, 1);
$id = isset($_GET['id']) ? intval($_GET['id']) : "";

//вызываем функцию по получению новых лотов
$lots = get_new_lots($db_con);

//запрос на список категорий
$categories = get_new_categories($db_con);

// передаем в шаблон результат выполнения
$page_content = include_template('main.php', ['categories' => $categories, 'lots' => $lots]);

$layout_content = include_template('layout.php', [
	'page_content' => $page_content,
    'categories' => $categories,
    'products' => $lots,
	'user_name' => $user_name,
    'title' => 'Yeti Cave - Главная страница',
    'is_auth' => $is_auth,
]);

print($layout_content);
