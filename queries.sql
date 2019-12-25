-- добавляет категории товаров
INSERT INTO categories (name, symbol_code)
VALUES ('Доски и лыжи','boards'),
('Крепления', 'attachment'),
('Ботинки', 'boots'),
('Одежда', 'clothing'),
('Инструменты', 'tools'),
('Разное', 'other');

-- добавляет участников аукциона(пользователей)
INSERT INTO users (registration_date, email, name, password, contacts)
VALUES ('2019-09-16', 'ivanovvasil@gmail.com', 'Иванов Василий', 'vasilek236171', '79055211709'),
('2019-08-23', 'petrov123@gmail.com', 'Петров Николай', 'nikolya67843', '79054561894'),
('2019-03-16', 'sokolov@gmail.com', 'Соколов Виталий', 'sokolov987456', '79267890423'),
('2019-02-16', 'viktorov@gmail.com', 'Викторов Савелий', 'viktorov238765', '79267563412'),
('2019-05-16', 'smirnovvasil@gmail.com', 'Смирнов Василий', 'smirnov986171', '79165497865'),
('2019-09-29', 'sidorovivan@gmail.com', 'Сидоров Иван', 'uluwatu007', '79260951644');

-- добавляет лоты
INSERT INTO lots (create_date, name, description, image, start_price, finish_date, step, user_id, winner_id, category_id)
VALUES (NOW(), '2014 Rossignol District Snowboard', 'Легкий и маневренный сноуборд.', 'img/lot-1.jpg', 10999, '2019-12-15', 100, 1, 1, 1),
(NOW(), 'DC Ply Mens 2016/2017 Snowboard', 'Cделает из любого спортсмена чемпиона.', 'img/lot-2.jpg', 159999, '2019-12-16', 500, 1, 1, 1),
(NOW(), 'Крепления Union Contact Pro 2015 года размер L/XL', 'Крепления размера L/XL по выгодной цене.', 'img/lot-3.jpg', 8000, '2019-12-17', 50, 1, 1, 2),
(NOW(), 'Ботинки для сноуборда DC Mutiny Charocal', 'Обувь, проверенная временем.', 'img/lot-4.jpg', 10999, '2019-12-18', 200, 1, 1, 3),
(NOW(), 'Куртка для сноуборда DC Mutiny Charocal', 'Покупай одежду от Munity Charocal.', 'img/lot-5.jpg', 7500, '2019-12-19', 500, 1, 1, 4),
(NOW(), 'Маска Oakley Canopy', 'Не страшны любые капризы погоды.', 'img/lot-6.jpg', 5400, '2019-12-20', 300, 1, 1, 6);

-- добавляет ставки
INSERT INTO rates (rate_date, price, user_id, lot_id)
VALUES ('2019-12-30', 10000, 1, 1),
('2019-12-28', 8000, 2, 2),
('2019-12-27', 7500, 3, 3),
('2019-12-29', 12000, 4, 4),
('2019-12-31', 11000, 5, 5),
('2019-12-26', 9500, 2, 6);

-- получение всех категорий
SELECT * FROM categories;

-- получить открытые лоты с данными
SELECT name, start_price, image, start_price + step AS current_price, category_id FROM lots WHERE finishing_date > NOW();

-- получить лот по его id. А также получить название категории, к которой принадлежит лот
SELECT *, categories.name FROM lots JOIN categories ON lots.category_id = categories.id WHERE lots.id = 1;

-- обновить название лота по его идентификатору
UPDATE lots SET name = 'Крепления Union Contact Pro 2019 года размер S' WHERE id = 3;

-- получить список ставок для лота по его идентификатору с сортировкой по дате
SELECT l.name, c.create_date FROM lots LEFT JOIN rates r ON r.lot_id = l.id  WHERE l.id = 1 ORDER BY c.create_date DESC;
