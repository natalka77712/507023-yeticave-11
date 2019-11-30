<?php

$is_auth = rand(0, 1);
$user_name = 'Наталья';
date_default_timezone_set('Europe/Moscow');

//устанавливаем и проверяем соединение с базой данных
$db_con = mysqli_connect($db['host'], $db['user'], $db['password'], $db['database']);

if (!$db_con) {
    $error = mysqli_connect_error();
    print("Ошибка: Невозможно подключиться к MySQL " . $error);
} else {
    mysqli_set_charset($db_con, "utf8");
}
