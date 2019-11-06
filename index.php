<?php
require_once('helpers.php');
require_once('data.php');
require_once('functions.php');

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
