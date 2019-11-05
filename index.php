<?php
require_once('helpers.php');

$is_auth = rand(0, 1);
$user_name = 'Наталья';

//data.php
$categories = ['Доски и лыжи', 'Крепления', 'Ботинки', 'Одежда', 'Инструменты', 'Разное'];

$products = [
    [
        'name' => '2014 Rossignol District Snowboard',
        'category' => 'Доски и лыжи',
        'price' => 10999,
        'url' => 'img/lot-1.jpg',
    ],
    [
        'name' => 'DC Ply Mens 2016/2017 Snowboard',
        'category' => 'Доски и лыжи',
        'price' => 159999,
        'url' => 'img/lot-2.jpg',
    ],
    [
        'name' => 'Крепления Union Contact Pro 2015 года размер L/XL',
        'category' => 'Крепления',
        'price' => 8000,
        'url' => 'img/lot-3.jpg',
    ],
    [
        'name' => 'Ботинки для сноуборда DC Mutiny Charocal',
        'category' => 'Ботинки',
        'price' => 10999,
        'url' => 'img/lot-4.jpg',
    ],
    [
        'name' => 'Куртка для сноуборда DC Mutiny Charocal',
        'category' => 'Одежда',
        'price' => 7500,
        'url' => 'img/lot-5.jpg',
    ],
    [
        'name' => 'Маска Oakley Canopy',
        'category' => 'Разное',
        'price' => 5400,
        'url' => 'img/lot-6.jpg',
    ],
];
//functions.php
function edit_price($price) {
    $price_content = '<b class="rub">р</b>';
    $price = ceil($price);
    if ($price >= 1000) {
      $price = number_format($price, null, null, ' ');
    }
    return $price . ' ' . $price_content;
};

function esc($str) {
    $text = htmlspecialchars($str);
    return $text;
}

$page_content = include_template('main.php', ['products' => $product, 'categories' => $category]);

$layout_content = include_template('layout.php', [
	'content' => $page_content,
    'categories' => $category,
    'products' => $product,
	'user_name' => $user_name,
    'title' => 'Yeti Cave - Главная страница',
    'is_auth' => $is_auth,
]);

print($layout_content);
?>
