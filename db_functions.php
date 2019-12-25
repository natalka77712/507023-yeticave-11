<?php

//запрос на получение новых лотов
function get_new_lots($db_con) {
    $lots_sql = 'SELECT lots.id AS lot_id, lots.name AS lot_name, lots.description as lot_description, create_date, finish_date, start_price, image, start_price + step AS current_price,
        categories.name AS category_name FROM lots
        JOIN categories ON lots.category_id = categories.id
        ORDER BY lots.create_date DESC';

    $lots_result = mysqli_query($db_con, $lots_sql);

//успешное выполнение запроса
    if (!$lots_result) {
        $error = mysqli_error($db_con);
        print("Ошибка: Невозможно подключиться к MySQL " . $error);
    } else {
    //формируем двухмерный массив
        return mysqli_fetch_all($lots_result, MYSQLI_ASSOC);
    }
}

//запрос на получение категорий
function get_categories($db_con) {
    $categories_sql = 'SELECT name, symbol_code FROM categories';

    $categories_result = mysqli_query($db_con, $categories_sql);

//успешное выполнение запроса
    if (!$categories_result) {
        $error = mysqli_error($db_con);
        print("Ошибка: Невозможно подключиться к MySQL " . $error);
    } else {
    //формируем двухмерный массив
        return mysqli_fetch_all($categories_result, MYSQLI_ASSOC);
    }
}

//Проверка существования параметра запроса с id лота.
//Выполнение SQL на чтение записи из таблицы с лотами, где id лота равен полученному из параметра запроса.
function get_new_lot_id($db_con, $lot_id) {
    $lot_sql = 'SELECT lots.id, create_date, lots.name AS lot_name, lots.description as lot_description, image, start_price + step AS current_price, finish_date, step, winner_id,
        categories.name AS category_id FROM lots
        JOIN categories ON lots.category_id = categories.id
        WHERE lots.id = '.$lot_id;

    $lot_result = mysqli_query($db_con, $lot_sql);

    //успешное выполнение запроса
    if (!$lot_result) {
        $error = mysqli_error($db_con);
        print("Ошибка: Невозможно подключиться к MySQL " . $error);
    } else {
        return mysqli_fetch_assoc($lot_result);
    }
}

function get_new_rates($db_con, $lot_id) {
    $rates_sql = 'SELECT rates.id, rates.rate_date as rate_date, rates.price as price, lot_id, users.name AS user, lots.start_price + lots.step AS current_price
        FROM rates
        JOIN users ON users.id = rates.user_id
        JOIN lots ON rates.lot_id = lots.id
        WHERE rates.lot_id = '.$lot_id;

    $rates_result = mysqli_query($db_con, $rates_sql);

    //успешное выполнение запроса
    if (!$rates_result) {
        $error = mysqli_error($db_con);
        print("Ошибка: Невозможно подключиться к MySQL " . $error);
    } else {
        return mysqli_fetch_assoc($rates_result);
    }

    if (!$rates_result['id']) {
        header("HTTP/1.0 404 Not Found");
        exit;
    }
}
