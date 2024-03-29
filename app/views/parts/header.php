<?php

use dns\View;

/** @var $this View */
?>
<!doctype html>
<html lang="ru">
<head>
	<base href="<?= PATH ?>">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
	<meta name="viewport"
	      content="width=device-width, initial-scale=1, user-scalable=no">
	<meta name="format-detection" content="telephone=no">
	<meta name="author" content="Nikita Kopylov">
	<meta name="theme-color" content="#fff">
	<link rel="icon" href="<?= PATH ?>/assets/img/favicon.ico">
	<link rel="stylesheet" href="<?= PATH ?>/assets/css/jquery-ui.min.css">
	<link rel="stylesheet"
	      href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css">
	<link rel="stylesheet"
	      href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css">
	<link rel="stylesheet" media="all" href="<?= PATH ?>/assets/css/app.css">
	<link rel="stylesheet" media="all" href="<?= PATH ?>/assets/css/style.css">
	<?= $this->getMeta() ?>
</head>
<body>
<header class="header col-12">
	<div class="header-top col-12">
		<div class="container">
			<nav class="header-top__nav row">
				<div class="col-lg-6 col-md-6 header-top__menu">
					<?php new \app\widgets\page\Page([
						"cache" => 60,
						"class" => "header-top__list row"
					]); ?>
				</div>
				<div class="col-lg-2 col-md-3 header-top__mail"><a
						class="header-top__mail-link" href="mailto:dns@shop.ru">
						<svg class="ico ico-mono-mail">
							<use xlink:href="assets/img/sprite-mono.svg#ico-mono-mail"></use>
						</svg>
						<span>dns@shop.ru</span></a></div>
				<div class="col-lg-2 col-md-3 header-top__phone"><a
						class="header-top__phone-link" href="tel:88007707999">
						<svg class="ico ico-mono-phone">
							<use xlink:href="assets/img/sprite-mono.svg#ico-mono-phone"></use>
						</svg>
						<span>8 800 77 07 999</span></a></div>
				<div class="col-lg-2 col-md-6 col-12 header-top__login">
					<?php if (isset($_SESSION["user"])) { ?>
						<a href="user/cabinet" class="header-top__login-link">
							<svg class="ico ico-mono-user">
								<use
									xlink:href="assets/img/sprite-mono.svg#ico-mono-user"></use>
							</svg>
							<span>Личный кабинет</span>
						</a>
					<?php } else { ?>
						<button class="header-top__login-link" type="button"
						        data-bs-toggle="modal" data-bs-target="#authorization">
							<svg class="ico ico-mono-user">
								<use
									xlink:href="assets/img/sprite-mono.svg#ico-mono-user"></use>
							</svg>
							<span>Вход/Регистрация</span>
						</button>
					<?php } ?>
				</div>
			</nav>
		</div>
	</div>
	<div class="header-body col-12">
		<div class="container">
			<div class="row align-items-center">
				<div class="header-logo logo col-lg-2 col-2"><a
						class="header-logo__link col-12" href="<?= PATH ?>"><span>dns</span></a>
				</div>
				<div class="header-search col-lg-7 col-7">
					<form class="header-search__form search col-12" action="#">
						<input id="search" class="header-search__input" type="text"
						       placeholder="Например: Poco X3 Pro">
						<button
							class="header-search__button button-fill button-fill--primary"
							type="submit"><span>Найти в каталоге</span>
							<svg class="ico ico-mono-search">
								<use
									xlink:href="assets/img/sprite-mono.svg#ico-mono-search"></use>
							</svg>
						</button>
					</form>
					<div id="search_box-result"></div>
				</div>
				<div class="header-actions col-lg-3 col-3">
					<div class="row justify-content-between"><a
							class="header-actions__item" href="#">
							<div class="row justify-content-between">
								<div class="header-actions__text col-8"><span
										class="header-actions__name">Избранное</span><strong
										class="header-actions__count">2 товара</strong></div>
								<div class="header-actions__image col-4">
									<svg class="ico ico-mono-heart">
										<use
											xlink:href="assets/img/sprite-mono.svg#ico-mono-heart"></use>
									</svg>
									<span>2</span>
								</div>
							</div>
						</a><a class="header-actions__item header__cart"
					         href="<?= PATH ?>/cart">
							<div class="row justify-content-between">
								<div class="header-actions__text col-8"><span
										class="header-actions__name">Корзина</span>
									<?php if (isset($_SESSION["cart.sum"])) { ?>
										<strong
											class="header-actions__count cart-price"><?= $_SESSION["cart.sum"] ?>
											руб</strong>
									<?php } else { ?>
										<strong class="header-actions__count cart-price">0
											руб</strong>
									<?php } ?>
								</div>
								<div
									class="header-actions__image header-actions__cart-image col-4">
									<svg class="ico ico-mono-cart">
										<use
											xlink:href="assets/img/sprite-mono.svg#ico-mono-cart"></use>
									</svg>
									<?php if (isset($_SESSION["cart.qty"])) { ?>
										<span class="cart-count"><?= $_SESSION["cart.qty"] ?></span>
									<?php } else { ?>
										<span class="cart-count">0</span>
									<?php } ?>
								</div>
							</div>
						</a></div>
				</div>
			</div>
		</div>
	</div>
	<div class="header-bottom col-12">
		<div class="container">
			<nav class="header-bottom__nav col-lg-6 col-12">
				<ul class="header-bottom__list row">
					<li class="header-bottom__item header-bottom__item--button">
						<button
							class="header-bottom__catalog button-fill button-fill--primary"
							type="button">Каталог товаров<span
								class="header-bottom__catalog-icon"><i></i><i></i><i></i></span>
						</button>
					</li>
				</ul>
				<div class="header-bottom__catalog-body col-lg-6">
					<?php new \app\widgets\menu\Menu([
						"class" => "header-bottom__catalog-list row",
						"cache" => 60
					]); ?>
				</div>
			</nav>
		</div>
	</div>
</header>