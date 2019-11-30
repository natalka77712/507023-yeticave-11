<?php
require_once('helpers.php');
require_once('config.php');
require_once('functions.php');
require_once('db.php');

//запрос на список категорий
$is_auth = rand(0, 1);
$sql = 'SELECT name, symbol_code FROM categories';
$result = mysqli_query($db_con, $sql);

//проверка наличия значения в массиве
if (!isset($_GET['id'])) {
    header($_SERVER['SERVER_PROTOCOL']." 404 Not Found");
    $page_content = renderTemplate("templates/error.php", []);
} else {
    $lot_id = intval($_GET['id']);
}
//Проверка существования параметра запроса с id лота.
//Выполнение SQL на чтение записи из таблицы с лотами, где id лота равен полученному из параметра запроса.
$lot_sql = 'SELECT lots.id, create_date, lots.name AS lot_name, description, image, start_price + step AS current_price, finish_date, step, user_id, winner_id,
        categories.name AS category_id FROM lots
        JOIN categories ON lots.category_id = categories.id
        WHERE lots.id = $lot_id';

$lot_result = mysqli_query($db_con, $lot_sql);

if (!$$lot_result) {
    $error = mysqli_error($db_con);
    print("Ошибка: Невозможно подключиться к MySQL " . $error);
} else {
    $lot = mysqli_fetch_assoc($lot_result);
}

$rates__sql = 'SELECT rates.id, rate_date, price, user_id, lot_id, users.name AS user_name, start_price + step AS current_price
        FROM rates
        JOIN users ON rates.user_id = users.id
        JOIN lots ON rates.lot_id = lots.id
        WHERE rates.lot_id = $lot_id';

$rates__result = mysqli_query($db_con, $rates__sql);

if (!$rates__result) {
    $error = mysqli_error($db_con);
    print('Ошибка: ' . $error);
} else {
    $rates = mysqli_fetch_all($rates__result, MYSQLI_ASSOC);
}

$page_content = include_template('lot.php', ['lot' => $lot, 'rates' => $rates, 'is_auth' => $is_auth]);

$layout_content = include_template('layout.php', [
    'page_content' => $page_content,
    'categories' => $categories,
    'title' => 'Страница лота',
    'user_name' => $user_name,
    'is_auth' => $is_auth,
]);

print($layout_content);
