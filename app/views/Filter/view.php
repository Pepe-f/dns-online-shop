<div class="catalog-body__wrapper">
    <div class="row">
        <?php $products = $vars; ?>
        <?php if (!empty($products)) { ?>
            <?php foreach ($products as $product) { ?>
                <div class="card col-sm-3 col-12">
                    <div class="card__item col-12">
                        <button class="card-favorite__button favorite-button" type="button">
                            <svg class="ico ico-mono-favorite">
                                <use xlink:href="<?= PATH ?>/assets/img/sprite-mono.svg#ico-mono-favorite"></use>
                            </svg>
                        </button>
                        <a class="card__image col-12" href="product/<?= $product["slug"] ?>">
                            <img src="<?= $product["img"] ?>" alt="<?= $product["name"] ?>">
                        </a>
                        <a class="card__name col-12" href="product/<?= $product["slug"] ?>">
                            <span><?= $product["name"] ?></span>
                        </a>
                        <div class="card-price col-12">
                            <div class="row align-items-center justify-content-between">
                                <strong class="card-price__number"><?= $product["price"] ?> ₽</strong>
                                <a href="cart/add?id=<?= $product[
                                	"id"
                                ] ?>" class="card-price__button button-fill button-fill--red button-cart <?php if (
	isset($_SESSION["cart"][$product["id"]]) &&
	$_SESSION["cart.qty"] !== 0
) {
	echo "active";
} else {
	echo "";
} ?>" type="button" data-product="<?= $product["id"] ?>"><span>В корзину</span>
                                    <svg class="ico ico-mono-cart">
                                        <use xlink:href="<?= PATH ?>/assets/img/sprite-mono.svg#ico-mono-cart"></use>
                                    </svg>
                                    <span class="button-cart__number"><?php if (
                                    	isset($_SESSION["cart.qty"]) &&
                                    	$_SESSION["cart.qty"] !== 0
                                    ) {
                                    	echo $_SESSION["cart.qty"];
                                    } else {
                                    	echo "0";
                                    } ?></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        <?php } ?>
    </div>
</div>