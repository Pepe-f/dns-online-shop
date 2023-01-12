<?php
/** @var $orders array */
/** @var $order_products array */
?>
<section class="breadcrumb">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<ul>
					<li>
						<a href="<?= PATH ?>" itemprop="item">Главная</a>
					</li>
					<li>
						<a href="<?= PATH ?>/user/cabinet" itemprop="item">Личный кабинет</a>
					</li>
					<li>
						<a href="#">История заказов</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
</section>
<section class="history">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<?php if (!empty($orders)) { ?>
					<h1 class="history__title">История заказов</h1>
				<?php } else { ?>
					<h1 class="history__title">Вы еще не совершали заказы</h1>
				<?php } ?>
			</div>
			<?php  ?>
			<?php if (!empty($orders)) { ?>
			<div class="col-12 history-accordion">
				<?php foreach ($orders as $order) { ?>
					<div class="history-accordion__item">
						<div class="history-accordion__head">
							<strong class="history-accordion__number">Заказ №<?= $order["id"] ?></strong>
							<div class="history-accordion__dash"> </div>
							<strong class="history-accordion__date"><?= $order["created_at"] ?></strong>
							<button class="history-accordion__button active" type="button">
								<svg class="ico ico-mono-arrow-down">
									<use xlink:href="<?= PATH ?>/assets/img/sprite-mono.svg#ico-mono-arrow-down"></use>
								</svg>
							</button>
						</div>
						<div class="history-accordion__body">
							<div class="row">
								<div class="col-lg-7 col-12 history-accordion__details">
									<div class="history-accordion__customer">
										<div class="history-accordion__info">
											<span class="history-accordion__key">Статус заказа</span>
											<div class="history-accordion__dash"> </div>
											<?php if ($order["status"] == 0) { ?>
												<strong class="history-accordion__value">Новый</strong>
											<?php } else { ?>
												<strong class="history-accordion__value">Доставлен</strong>
											<?php } ?>
										</div>
									</div>
									<div class="history-accordion__customer">
										<h2 class="history-accordion__subtitle">Получатель</h2>
										<span class="history-accordion__name"><?= $_SESSION["user"]["name"] ?></span>
										<span class="history-accordion__name"><?= $_SESSION["user"]["email"] ?></span>
										<span class="history-accordion__name"><?= $_SESSION["user"]["phone"] ?></span>
									</div>
									<div class="history-accordion__customer">
										<h2 class="history-accordion__subtitle">Адрес</h2>
										<span class="history-accordion__name">г. <?= $order["city"] ?>, <?= $order["address"] ?></span>
									</div>
									<div class="history-accordion__customer">
										<h2 class="history-accordion__subtitle">Способ доставки и оплаты</h2>
										<div class="history-accordion__info">
											<span class="history-accordion__key"><?= $order["delivery"] ?></span>
											<div class="history-accordion__dash"> </div>
											<strong class="history-accordion__value"><?= $order["price"] ?> руб.</strong>
										</div>
										<span class="history-accordion__name"><?= $order["payment"] ?></span>
										<div class="history-accordion__info">
											<span class="history-accordion__key history-accordion__key--total">ИТОГО</span>
											<div class="history-accordion__dash"> </div>
											<strong class="history-accordion__value"><?= $order["total"] ?> руб.</strong>
										</div>
									</div>
								</div>
								<div class="col-lg-5 history-accordion-cart">
									<?php foreach ($order_products as $product) { ?>
										<?php if ($product["order_id"] === $order["id"]) { ?>
										<div class="history-accordion-cart__item">
											<div class="history-accordion-cart__image">
												<img src="<?= $product["img"] ?>" alt="<?= $product["name"] ?>">
											</div>
											<div class="history-accordion-cart__text">
												<strong class="history-accordion-cart__name"><?= $product["name"] ?></strong>
												<span class="history-accordion-cart__vendor">Артикул: <?= $product["article"] ?></span>
												<?php if ($product["qty"] > 1) { ?>
													<strong class="history-accordion-cart__price"><?= $product["price"] ?> ₽ х <?= $product["qty"] ?> шт</strong>
												<?php } else { ?>
													<strong class="history-accordion-cart__price"><?= $product["price"] ?> ₽</strong>
												<?php } ?>
											</div>
										</div>
									<?php } ?>
									<?php } ?>
								</div>
							</div>
						</div>
					</div>
				<?php } ?>
			</div>
			<?php } ?>
		</div>
	</div>
</section>
<?php if (!empty($products)) { ?>
	<section class="recomendation col-12">
		<div class="container">
			<div class="row">
				<h1 class="recomendation__title col-12">Рекомендуем вам</h1>
				<div class="recomendation__wrapper col-12">
					<div class="row justify-content-between">
						<?php $this->getPart("parts/products_loop", compact("products")); ?>
					</div>
				</div><a class="recomendation__button" href="<?= PATH ?>/catalog-list"><span>Смотреть весь каталог</span>
					<svg class="ico ico-mono-arrow-right">
						<use xlink:href="assets/img/sprite-mono.svg#ico-mono-arrow-right"></use>
					</svg></a>
			</div>
		</div>
	</section>
<?php } ?>
