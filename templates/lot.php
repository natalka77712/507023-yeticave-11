<nav class="nav">
    <ul class="nav__list container">
        <?php foreach ($categories as $categories) : ?>
            <li class="nav__item">
                <a href="pages/all-lots.html"><?= $categories['name']; ?></a>
            </li>
        <?php endforeach; ?>
    </ul>
</nav>
<section class="lot-item container">
    <h2><?=$lot['lot_name']; ?></h2>
    <div class="lot-item__content">
        <div class="lot-item__left">
          <div class="lot-item__image">
            <img src="../<?=$lot['image']; ?>" width="730" height="548" alt=<?=$lot['lot_name']; ?>>
          </div>
          <p class="lot-item__category">Категория: <span><?= $lot['category_id']; ?></span></p>
          <p class="lot-item__description"><?= $lot['description'] ?></p>
        </div>
        <div class="lot-item__right">
        <div class="lot-item__state">
            <?php $range = get_time($lot['finish_date']);?>
            <div class="lot-item__timer timer <?php if($range[0] == '00') print "timer--finishing"; ?>">
              <?php print $range[0] . ":" . $range[1]; ?>
            </div>
            <div class="lot-item__cost-state">
              <div class="lot-item__rate">
                <span class="lot-item__amount">Текущая цена</span>
                <span class="lot-item__cost"><?=add_currency_to_price(format_price($lot['current_price']), 'rub', 'р'); ?></span>
              </div>
              <div class="lot-item__min-cost">
                Мин. ставка <span><?=add_currency_to_price(format_price($lot['step']), 'rub', 'р'); ?></span>
              </div>
            </div>
            <?php if ($is_auth): ?>
            <form class="lot-item__form" action="https://echo.htmlacademy.ru" method="post" autocomplete="off">
              <p class="lot-item__form-item form__item form__item--invalid">
                <label for="cost">Ваша ставка</label>
                <input id="cost" type="text" name="cost" placeholder="<?=($lot['step']); ?>">
                <span class="form__error">Введите наименование лота</span>
              </p>
              <button type="submit" class="button">Сделать ставку</button>
            </form>
            <?php endif;?>
          </div>
          <div class="history">
            <h3>История ставок(<span>6</span>)</h3>
            <table class="history__list">
            <?php foreach ($rates as $rate): ?>
              <tr class="history__item">
                <td class="history__name"><?= $rates['user']; ?></td>
                <td class="history__price"><?=add_currency_to_price(format_price(htmlspecialchars($rates['current_price'])), 'rub', 'р'); ?></td>
                <td class="history__time"><?=$rates['rate_date']; ?></td>
              </tr>
              <?php endforeach; ?>
            </table>
          </div>
        </div>
      </div>
    </section>
  </main>

</div>
