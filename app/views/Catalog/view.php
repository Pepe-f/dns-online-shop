<?php
/** @var $this \dns\View */
/** @var $subcategory array */
/** @var $category array */
/** @var $products array */
/** @var $brands array */
/** @var $maxPrice int */
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
                        <a href="catalog-list/<?= $category[
                        	"slug"
                        ] ?>" itemprop="item"><?= $category["name"] ?></a>
                    </li>
                    <li>
                        <a href="catalog/<?= $subcategory[
                        	"slug"
                        ] ?>"><?= $subcategory["name"] ?></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>
<section class="catalog" data-subcategory-id="<?= $subcategory["id"] ?>">
    <div class="container">
    <div class="row">
        <div class="col-12">
        <h1 class="catalog__title"><?= $subcategory["name"] ?></h1>
        </div>
        <div class="col-12 catalog__body">
        <div class="row">
            <div class="col-12">
            <button class="catalog-filters__button" type="button">
                <svg class="ico ico-mono-settings">
                <use xlink:href="assets/img/sprite-mono.svg#ico-mono-settings"></use>
                </svg>
                <span>Показать фильтры</span>
            </button>
            </div>
            <div class="col-lg-3 col-md-4 catalog-filters">
            <div class="catalog-filters__body">
                <div class="row">
                <div class="col-12 catalog-filters__head">
                    <div class="row justify-content-between">
                    <h2 class="catalog-filters__title">Фильтры</h2>
                    <button class="catalog-filters__reset" type="button">Сбросить</button>
                    </div>
                </div>
                <div class="col-12 catalog-filters__item">
	                <div class="row">
		                <div class="col-12">
			                <h3 class="catalog-filters__subtitle">Бренды</h3>
		                </div>
		                <div class="col-12">
			                <div class="catalog-filters__choice">
				                <?php foreach ($brands as $brand) { ?>
					                <div class="catalog-filters__filter">
						                <input class="catalog-filters__checkbox checkbox" type="checkbox" name="c_<?= $brand[
                      	"id"
                      ] ?>" data-brand-id="<?= $brand["id"] ?>">
						                <label class="catalog-filters__label" for="c_<?= $brand[
                      	"id"
                      ] ?>"><?= $brand["name"] ?></label>
					                </div>
				                <?php } ?>
			                </div>
		                </div>
	                </div>
                </div>
                <div class="col-12 catalog-filters__item">
	                <div class="row">
		                <div class="col-12">
			                <h3 class="catalog-filters__subtitle">Цена</h3>
		                </div>
		                <div class="col-12">
			                <div class="catalog-filters__choice">
				                <div class="catalog-filters__price-filter">
					                <input class="catalog-filters__price catalog-filters__price--min" type="number" name="min"
					                       value="0" min="0" max="<?= $maxPrice ?>">
					                <span>от</span>
				                </div>
				                <div class="catalog-filters__price-filter">
					                <input class="catalog-filters__price catalog-filters__price--max" type="number" name="max"
					                       value="<?= $maxPrice ?>" min="0" max="<?= $maxPrice ?>">
					                <span>до</span>
				                </div>
				                <div class="slider-range"></div>
			                </div>
		                </div>
	                </div>
                </div>
                </div>
                <button class="catalog-filters__apply button-fill button-fill--red" type="button">Применить</button>
            </div>
            </div>
            <div class="col-lg-9 col-md-8 col-12 catalog-body">
            <div class="catalog-body__wrapper">
                <div class="row">
                <?php if (!empty($products)) { ?>
                    <?php $this->getPart(
                    	"parts/products_loop",
                    	compact("products")
                    ); ?>
                <?php } ?>
                </div>
            </div>
            </div>
        </div>
        </div>
        <div class="col-12 catalog-description">
            <p class="catalog-description__text"><?= $subcategory[
            	"content"
            ] ?></p>
        </div>
    </div>
    </div>
</section>