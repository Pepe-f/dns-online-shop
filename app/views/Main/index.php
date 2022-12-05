<?php

use dns\View;
/** @var $this View */
?>
<?php if (!empty($slides)) { ?>
<section class="banner col-12">
	<div class="container">
		<div class="row">
			<div class="swiper col-12 banner-slider">
				<div class="swiper-wrapper">
					<?php foreach ($slides as $slide) { ?>
						<div class="swiper-slide banner-slider__slide">
							<div class="banner-slider__ellipse--small"></div>
							<div class="banner-slider__ellipse--medium"></div>
							<div class="banner-slider__ellipse--big"></div>
							<div class="col-6 banner-slider__item">
								<div class="row">
									<div class="col-12">
										<h1 class="banner-slider__title col-12"><?= $slide->title ?></h1>
									</div>
									<div class="col-12">
										<p class="banner-slider__text col-12"><?= $slide->text ?></p>
									</div>
									<div class="col-12">
											<a class="banner-slider__button button-fill button-fill--red" href="<?= PATH ?>"> <span>Смотреть</span></a>
									</div>
								</div>
							</div>
								<div class="banner-slider__images">
									<img class="banner-slider__img banner-slider__img--near" src="<?= PATH .
         	$slide->img ?>" alt="<?= $slide->title ?>">
									<!-- <img class="banner-slider__img banner-slider__img--near" src="" alt="Banner image 2"> -->
								</div>
						</div>
					<?php } ?>
				</div>
				<div class="swiper-pagination"></div>
				<button class="banner__button banner__button--prev">
					<svg class="ico ico-mono-arrow-prev">
						<use xlink:href="<?= PATH ?>/assets/img/sprite-mono.svg#ico-mono-arrow-prev"></use>
					</svg>
				</button>
				<button class="banner__button banner__button--next">
					<svg class="ico ico-mono-arrow-next">
						<use xlink:href="<?= PATH ?>/assets/img/sprite-mono.svg#ico-mono-arrow-next"></use>
					</svg>
				</button>
			</div>
		</div>
</section>
<?php } ?>
<section class="recomendation col-12">
	<div class="container">
		<div class="row">
			<h1 class="recomendation__title col-12">Рекомендуем вам</h1>
			<div class="recomendation__wrapper col-12">
				<div class="row justify-content-between">
					<p>Карточка товара</p>
				</div>
			</div><a class="recomendation__button" href="/catalog-list.php"><span>Смотреть весь каталог</span>
				<svg class="ico ico-mono-arrow-right">
					<use xlink:href="assets/img/sprite-mono.svg#ico-mono-arrow-right"></use>
				</svg></a>
		</div>
	</div>
</section>
<section class="catalog-list col-12">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<h2 class="section__title catalog-list__title">Часто просматриваемые категории</h2>
			</div>
			<div class="catalog-list__wrapper col-12">
				<div class="row justify-content-between">
						<a class="catalog-list__item col-lg-4 col-sm-6 col-12" href="catalog.php">
							<div class="catalog-list__body">
								<h2 class="catalog-list__name">Подкатегория</h2>
							</div>
						</a>
				</div>
			</div>
		</div>
</section>
<section class="about col-12">
	<div class="container">
		<div class="row">
			<div class="about-shop col-12">
				<div class="row">
					<div class="about-shop__text col-md-4 col-12">
						<div class="row">
							<div class="col-12">
								<h1 class="about-shop__title about__title">Интернет-магазин DNS</h1>
							</div>
							<div class="col-12">
								<p class="about-shop__body">Добро пожаловать на официальный сайт DNS! В нашем магазине представлен наиболее широкий выбор бытовой и цифровой техники. Наши клиенты – в центре всего, что мы делаем.</p>
							</div>
						</div>
					</div>
					<div class="about-shop__benefits col-md-8 col-12">
						<div class="row about-shop__row justify-content-between">
							<div class="about-shop__advantage col-12 col-sm-6 col-md-4">
								<div class="about-shop__item"><span class="about-shop__line"></span><strong class="about-shop__point">Более 10 000 торговых предложений в интернет-магазине</strong></div>
							</div>
							<div class="about-shop__advantage col-12 col-sm-6 col-md-4">
								<div class="about-shop__item"><span class="about-shop__line"></span><strong class="about-shop__point">Оплаты любыми способами</strong></div>
							</div>
							<div class="about-shop__advantage col-12 col-sm-6 col-md-4">
								<div class="about-shop__item"><span class="about-shop__line"></span><strong class="about-shop__point">Гарантия официальных поставок</strong></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>