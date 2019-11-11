<?php
/**
 * Рассчет стоимости
 * @param $price - изначальная цена
 * @return $price - итоговая цена
 */
function format_price($price) {
    $price_content = '<b class="rub">р</b>';
    $price = ceil($price);
    $price = number_format($price, null, null, ' ');

    return $price . ' ' . $price_content;
};

/**
 * Рассчет оставшегося времени до истечения лота
 * @param $date- дата истечения лота
 * @return $remaining_time - информация об оставшемся времени
 */
function get_time($date) {
    $exp_date = strtotime($date);
    $current_time = time();
    $interval = $exp_date - time();

    if ($interval <= 0) {
        return false;
    }
    else {
        $remainig_hours = floor($interval / 3600);
        $remainig_minutes = floor(($interval % 3600) / 60);
        $hours= str_pad($remainig_hours, 2, "0", STR_PAD_LEFT);
        $minutes = str_pad($remainig_minutes, 2, "0", STR_PAD_LEFT);
        $remaining_time = $hours . ':' . $minutes;
        return $remaining_time;
    }
}
