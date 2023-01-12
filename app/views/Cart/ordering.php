<?php
/**@var $deliveryMethods array*/
/**@var $paymentMethods array*/
/**@var $products array*/
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
						<a href="<?= PATH ?>/cart" itemprop="item">Корзина</a>
					</li>
					<li>
						<a href="#">Оформление заказа</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
</section>
<section class="ordering">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<h1 class="ordering__title">Оформление заказа</h1>
			</div>
			<div class="col-lg-8 ordering__body">
				<form class="ordering-form js-validate-form" action="#">
					<div class="row">
						<div class="col-12 ordering-form__item">
							<h2 class="ordering-form__subtitle">Информация о покупателе</h2>
							<div class="ordering-form__wrapper">
								<input class="ordering-form__input" type="text"
								       name="fullname" value="<?= $_SESSION["user"]["name"] ?>" placeholder="ФИО получателя*" required readonly>
								<input class="ordering-form__input phone" type="tel"
								       name="phone" value="<?= $_SESSION["user"]["phone"] ?>" placeholder="Контактный телефон*" required readonly>
								<input class="ordering-form__input" type="email"
								       name="email" value="<?= $_SESSION["user"]["email"] ?>" placeholder="E-mail*" required readonly>
								<input class="ordering-form__input" type="text"
								       name="city" value="<?= $_SESSION["user"]["location"] ?>" placeholder="Город*" required readonly>
								<input class="ordering-form__input" type="text" name="address" placeholder="Улица, дом, строение, квартира" required>
								<input class="ordering-form__input" type="text" name="note" placeholder="Примечания (подъезд, этаж, домофон)">
								<textarea class="ordering-form__textarea" name="comment" placeholder="Комментарий к заказу"></textarea>
							</div>
						</div>
						<div class="col-12 ordering-form__item">
							<h2 class="ordering-form__subtitle">Способы доставки</h2>
							<div class="ordering-form__wrapper">
								<?php foreach ($deliveryMethods as $method) { ?>
									<div class="ordering-form__choice">
										<input class="ordering-form__radio radio" type="radio" name="delivery_method" value="<?= $method["id"] ?>" required>
										<label class="ordering-form__radio-label">
											<strong><?= $method["name"] ?></strong>
											<span><?php if ($method["price"] === 0) { ?>
													Бесплатно
												<?php } else { ?>
													<?= $method["price"] ?> ₽
												<?php } ?>
                        <br>Срок доставки
                        <br><?= $method["delivery_time"] ?>
                      </span>
										</label>
									</div>
								<?php } ?>
							</div>
						</div>
						<div class="col-12 ordering-form__item">
							<h2 class="ordering-form__subtitle">Способы оплаты</h2>
							<div class="ordering-form__wrapper">
								<?php foreach ($paymentMethods as $method) { ?>
									<div class="ordering-form__choice">
										<input class="ordering-form__radio radio" type="radio" name="payment_method" value="<?= $method["id"] ?>" required>
										<label class="ordering-form__radio-label">
											<strong><?= $method["name"] ?></strong>
										</label>
									</div>
								<?php } ?>
							</div>
						</div>
						<div class="col-12 ordering-form__item">
							<p class="ordering-form__condition">* Все поля обязательны для заполнения</p>
							<div class="ordering-form__agreement">
								<input class="ordering-form__checkbox checkbox" type="checkbox" name="personal" required>
								<label class="ordering-form__checkbox-label" for="personal">
									<p>Нажимая кнопку «Оформить заказ», я даю свое согласие на обработку моих персональных данных, в
										соответствии с Федеральным законом от 27.07.2006 года №152-ФЗ «О персональных данных», на
										условиях и для целей, определенных в Согласии на обработку персональных данных</p>
								</label>
							</div>
						</div>
						<button class="ordering-form__button button-fill button-fill--red" type="submit">Оформить заказ</button>
					</div>
				</form>
			</div>
			<div class="col-lg-4 col-12 cart-details">
				<div class="cart-details__body">
					<h2 class="cart-details__subtitle">Ваша корзина</h2>
					<?php foreach ($products as $product) { ?>
						<div class="cart-details__product" data-product-id="<?= $product["id"] ?>">
							<div class="cart-details__image">
								<img src="<?= $product["img"] ?>" alt="<?= $product["name"] ?>">
							</div>
							<div class="cart-details__text">
								<strong class="cart-details__name"><?= $product["name"] ?></strong>
								<?php if ($product["qty"] === 1) { ?>
									<strong class="cart-details__price"><?= $product["price"] ?> ₽</strong>
								<?php } else { ?>
									<strong class="cart-details__price"><?= $product["price"] ?> ₽ х <?= $product["qty"] ?> шт</strong>
								<?php } ?>
							</div>
						</div>
					<?php } ?>
					<div class="cart-details__item">
						<span class="cart-details__key">Всего товаров </span>
						<div class="cart-details__dash"></div>
						<strong class="cart-details__value"><?= $_SESSION["cart.qty"] ?> шт</strong>
					</div>
					<div class="cart-details__item cart-details__item--result">
						<span class="cart-details__key">Итого </span>
						<div class="cart-details__dash"></div>
						<strong class="cart-details__value"><?= $_SESSION["cart.sum"] ?> ₽</strong>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>