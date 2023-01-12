<?php
/** @var $this dns\View */
?>
<section class="breadcrumb">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<ul>
					<li> <a href="<?= PATH ?>" itemprop="item">Главная</a>
					</li>
					<li> <a href="#">Корзина</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
</section>
<section class="cart">
	<div class="container">
		<div class="row">
			<?php if (empty($_SESSION["cart"])) { ?>
				<div class="col-12">
					<h1 class="cart__title">Ваша корзина пуста</h1>
				</div>
			<?php } else { ?>
				<div class="col-12">
					<h1 class="cart__title">Ваша корзина</h1>
				</div>
				<div class="col-lg-8 col-12 cart-products">
					<div class="cart-products__body">
						<div class="row">
							<?php foreach ($_SESSION["cart"] as $id => $item) { ?>
								<div class="col-12 cart-products__item">
									<div class="row cart-products__wrapper">
										<div class="cart-products__image">
											<img src="<?= $item["img"] ?>" alt="<?= $item["name"] ?>">
										</div>
										<div class="cart-products__description">
											<a class="cart-products__name" href="product/<?= $item["slug"] ?>"><?= $item["name"] ?></a>
											<span class="cart-products__vendor">Артикул: <?= $item["article"] ?></span>
											<?php if ($item["qty"] > 1) { ?>
												<strong class="cart-products__cost"><?= $item["price"] ?> ₽ x <?= $item["qty"] ?> шт</strong>
											<?php } else { ?>
												<strong class="cart-products__cost"><?= $item["price"] ?> ₽</strong>
											<?php } ?>
										</div>
										<div class="cart-products__actions">
											<strong class="cart-products__price"><?= $item["price"] ?> ₽</strong>
											<div class="cart-products__count counter">
												<button class="counter-button counter-button--minus"></button>
												<span><?= $item["qty"] ?></span>
												<button class="counter-button counter-button--plus"></button>
											</div>
										</div>
										<a href="cart/delete?id=<?= $id ?>" class="cart-products__button" data-product="<?= $id ?>">
											<span>Удалить</span>
											<svg class="ico ico-mono-cancel">
												<use xlink:href="<?= PATH ?>/assets/img/sprite-mono.svg#ico-mono-cancel"></use>
											</svg>
										</a>
									</div>
								</div>
							<?php } ?>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-12 cart-details">
					<div class="cart-details__body">
						<div class="cart-details__item"> <span class="cart-details__key">Всего товаров </span>
							<div class="cart-details__dash"></div><strong class="cart-details__value"><?= $_SESSION[
       	"cart.qty"
       ] ?> шт</strong>
						</div>
						<div class="cart-details__item cart-details__item--result"><span class="cart-details__key">Итого </span>
							<div class="cart-details__dash"></div>
							<strong class="cart-details__value"><?= $_SESSION["cart.sum"] ?> ₽</strong>
						</div>
						<div class="cart-details__actions row justify-content-between align-items-center">
							<a href="/" class="cart-details__button cart-details__button--back">Вернуться к покупкам </a>
							<?php if (isset($_SESSION["user"])) { ?>
								<a href="<?= PATH ?>/cart/ordering" class="cart-details__button button-fill button-fill--red cart-details__button--checkout">Оформить заказ </a>
							<?php } else { ?>
								<a href="#" data-bs-toggle="modal" data-bs-target="#authorization" class="cart-details__button button-fill button-fill--red cart-details__button--checkout">Оформить заказ</a>
							<?php } ?>
						</div>
					</div>
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
				</div>
			</div>
		</div>
	</section>
<?php } ?>
