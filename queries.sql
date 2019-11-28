-- добавляет категории товаров
INSERT INTO categories (name, symbol_code)
VALUES ('Доски и лыжи','boards'),
('Крепления', 'Attachment'),
('Ботинки', 'boots'),
('Одежда', 'clothing'),
('Инструменты', 'tools'),
('Разное', 'other');

-- добавляет участников аукциона(пользователей)
INSERT INTO users (registration_date, email, name, password, contacts)
VALUES ('2019-09-16', 'ivanovvasil@gmail.com', 'Иванов Василий', 'vasilek236171', '79055211709'),
('2019-10-29', 'sidorovivan@gmail.com', 'Сидоров Иван', 'uluwatu007', '79260951644');

-- добавляет лоты
INSERT INTO lots (create_date, name, description, image, start_price, finish_date, step, user_id, winner_id, category_id)
VALUES (NOW(), '2014 Rossignol District Snowboard', '', 'img/lot-1.jpg', 10999, '2019-12-15', 100, 1, 1, 1),
(NOW(), 'DC Ply Mens 2016/2017 Snowboard', '', 'img/lot-2.jpg', 159999, '2019-12-16', 500, 1, 1, 1),
(NOW(), 'Крепления Union Contact Pro 2015 года размер L/XL', '', 'img/lot-3.jpg', 8000, '2019-12-17', 50, 1, 1, 2),
(NOW(), 'Ботинки для сноуборда DC Mutiny Charocal', '', 'img/lot-4.jpg', 10999, '2019-12-18', 200, 1, 1, 3),
(NOW(), 'Куртка для сноуборда DC Mutiny Charocal', '', 'img/lot-5.jpg', 7500, '2019-12-19', 500, 1, 1, 4),
(NOW(), 'Маска Oakley Canopy', '', 'img/lot-6.jpg', 5400, '2019-12-20', 300, 1, 1, 6);

--добавляет ставки
INSERT INTO rates (rate_date, price, user_id, lot_id)
VALUES ('2019-09-30', 10000, 1, 1),
('2019-10-11', 500, 2, 6);

--получение всех категорий
SELECT * FROM categories;

--получить открытые лоты с данными
SELECT name, start_price, image, start_price + step AS current_price, category_id FROM lots WHERE finishing_date > NOW();

--получить лот по его id. А также получить название категории, к которой принадлежит лот
SELECT *, categories.name FROM lots JOIN categories ON lots.category_id = categories.id WHERE lots.id = 1;

--обновить название лота по его идентификатору
UPDATE lots SET name = 'Крепления Union Contact Pro 2019 года размер S' WHERE id = 3;

--получить список ставок для лота по его идентификатору с сортировкой по дате
SELECT l.name, c.create_date FROM lots LEFT JOIN rates r ON r.lot_id = l.id  WHERE l.id = 1 ORDER BY c.create_date DESC;
