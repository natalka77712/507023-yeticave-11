<section class="promo">
    <h2 class="promo__title">Нужен стафф для катки?</h2>
    <p class="promo__text">На нашем интернет-аукционе ты найдёшь самое эксклюзивное сноубордическое и горнолыжное снаряжение.</p>
    <ul class="promo__list">
        <?php foreach ($categories as $categories): ?>
            <li class="promo__item promo__item--<?= $categories['symbol_code']; ?>">
                <a class="promo__link" href="pages/all-lots.html"><?= $categories['name']; ?></a>
            </li>
        <?php endforeach; ?>
    </ul>
</section>
<section class="lots">
    <div class="lots__header">
        <h2>Открытые лоты</h2>
    </div>
    <ul class="lots__list">
        <?php foreach ($lots as $lots): ?>
            <li class="lots__item lot">
                <div class="lot__image">
                <img src="<?= htmlspecialchars($lots['image']); ?>" width="350" height="260" alt="<?= htmlspecialchars($lots['lot_name']); ?>">
                </div>
                <div class="lot__info">
                    <span class="lot__category"><?= htmlspecialchars($lots['category_name']); ?></span>
                    <h3 class="lot__title"><a class="text-link" href="lot.php?id=<?= $lots['lot_id']; ?>"><?= htmlspecialchars($lots['lot_name']); ?></a></h3>
                    <div class="lot__state">
                        <div class="lot__rate">
                            <span class="lot__amount">Стартовая цена</span>
                            <span class="lot__cost"><?=add_currency_to_price(htmlspecialchars($lots['start_price']), 'rub', 'р'); ?></span>
                        </div>
                        <div class="lot__timer timer <?php if (get_time($lots['finish_date']) < 1): ?> timer--finishing <?php endif ?>">
                            <?= get_time($lots['finish_date']); ?>
                        </div>
                    </div>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
</section>
