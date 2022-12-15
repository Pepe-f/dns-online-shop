<?php

use dns\View;
/** @var $this View */
?>
<!--<section class="breadcrumb">-->
<!--    <div class="container">-->
<!--        <div class="row">-->
<!--            <div class="col-12">-->
<!--                <ul>-->
<!--                    <li>-->
<!--                        <a href="/" itemprop="item">Главная</a>-->
<!--                    </li>-->
<!--                    <li>-->
<!--                        <a href="#">--><?//= $product["name"] ?><!--</a>-->
<!--                    </li>-->
<!--                </ul>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</section>-->
<section class="breadcrumb">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <ul>
                    <?= $breadcrumbs ?>
                </ul>
            </div>
        </div>
    </div>
</section>
<section class="product">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-12 product-images">
                <div class="row">
                    <div class="swiper product-images__slider">
                        <div class="swiper-wrapper">
                            <?php if (!empty($gallery)) { ?>
                                <?php $index = 0; ?>
                                <?php foreach ($gallery as $item) { ?>
                                    <div class="swiper-slide product-images__slide <?php if (
                                    	$index === 0
                                    ) {
                                    	echo "product-images__slide--active";
                                    } ?>">
                                        <div class="product-images__slide-wrapper">
                                            <img src="<?= $item[
                                            	"img"
                                            ] ?>" alt="<?= $product["name"] ?>">
                                        </div>
                                    </div>
                                    <?php $index += 1; ?>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </div>
                    <button class="product-images__slider-button">
                        <svg class="ico ico-mono-arrow-down">
                            <use xlink:href="<?= PATH ?>/assets/img/sprite-mono.svg#ico-mono-arrow-down"></use>
                        </svg>
                    </button>
                    <div class="swiper product-images__preview">
                        <button class="product-images__favorite favorite-button">
                            <svg class="ico ico-mono-favorite">
                                <use xlink:href="<?= PATH ?>/assets/img/sprite-mono.svg#ico-mono-favorite"></use>
                            </svg>
                        </button>
                        <div class="swiper-wrapper">
                        <?php if (!empty($gallery)) { ?>
                            <?php foreach ($gallery as $item) { ?>
                                <div class="swiper-slide product-images__preview-slide">
                                    <a data-fancybox="gallery" data-src="<?= $item[
                                    	"img"
                                    ] ?>" href="<?= $item["img"] ?>">
                                        <div class="product-images__wrapper">
                                            <img src="<?= $item[
                                            	"img"
                                            ] ?>" alt="1">
                                        </div>
                                    </a>
                                </div>
                            <?php } ?>
                        <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-12 product-characteristics">
                <div class="row">
                    <div class="col-12">
                        <span class="product-characteristics__vendor">Артикул: <?= $product[
                        	"article"
                        ] ?></span>
                    </div>
		                <div class="col-12">
			                  <?php if ($product["qty"] > 0) { ?>
                        <span class="product-characteristics__vendor">В наличии: <?= $product[
                        	"qty"
                        ] ?> шт</span>
			                  <?php } else { ?>
				                  <span class="product-characteristics__vendor">Нет в наличии</span>
		                  <?php } ?>
		                </div>
                    <div class="col-12">
                        <h2 class="product-characteristics__name"><?= $product[
                        	"name"
                        ] ?></h2>
                    </div>
                    <div class="col-12">
                        <div class="row align-items-center product-characteristics__actions">
                            <strong class="product-characteristics__price"><?= $product[
                            	"price"
                            ] ?> ₽</strong>
                            <button class="button-fill button-fill--red product-characteristics__button button-cart" data-product="<?= $product[
                            	"id"
                            ] ?>">
                                <span>В корзину</span>
                                <svg class="ico ico-mono-cart">
                                    <use xlink:href="<?= PATH ?>/assets/img/sprite-mono.svg#ico-mono-cart"></use>
                                </svg>
                                <span class="button-cart__number">1</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="product-description">
        <div class="container">
            <div class="product-description__body">
                <div class="row">
                    <div class="col-12">
                        <h2 class="product-description__title">Описание</h2>
                    </div>
                    <div class="col-12">
                        <p class="product-description__text"><?= $product[
                        	"content"
                        ] ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>