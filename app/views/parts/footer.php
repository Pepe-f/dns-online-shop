<?php

use dns\View;

/** @var $this View */
?>
<footer class="footer col-12">
	<div class="container">
		<div class="row">
			<div class="footer__body col-12">
				<div class="row">
					<div class="footer-body__info col-lg-9 col-12">
						<div class="row">
							<div class="footer-body__buyer col-lg-6 col-12">
								<h2 class="footer-body__subtitle col-12">Покупателям</h2>
								<div class="row">
									<?php new \app\widgets\page\Page([
										"cache" => 60,
										"class" => "footer-body__list col-sm-6 col-12",
										"prepend" => "<li><a href='" . PATH . "'>Главная</a></li>"
									]); ?>
								</div>
							</div>
						</div>
					</div>
					<div class="footer-body__contacts col-lg-3 col-12">
						<div class="footer-body__contacts-wrapper col-12">
							<div class="row">
								<div class="col-12">
									<h2 class="footer-body__subtitle">Наши контакты</h2>
								</div>
								<div class="col-12"><a class="footer-body__contact"
								                       href="tel:89990009988">
										<svg class="ico ico-mono-footer-phone">
											<use
												xlink:href="assets/img/sprite-mono.svg#ico-mono-footer-phone"></use>
										</svg>
										<span>8 800 77 07 999</span></a></div>
								<div class="col-12"><a class="footer-body__contact"
								                       href="mailto:dns@shop.ru">
										<svg class="ico ico-mono-footer-mail">
											<use
												xlink:href="assets/img/sprite-mono.svg#ico-mono-footer-mail"></use>
										</svg>
										<span>dns@shop.ru</span></a></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="footer-policy col-12">
				<div class="row">
					<div class="col-12"><span>2022 © Все права защищены.</span></div>
					<div class="col-12"><span>Вся информация, размещенная на сайте, носит информационный характер и не является публичной офертой.</span>
					</div>
				</div>
			</div>
		</div>
	</div>
</footer>
<?php if (!isset($_SESSION["user"])) { ?>
	<div class="modal modal-authorization fade" id="authorization" tabindex="-1"
	     aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-body">
					<button class="modal-close modal-authorization__close btn-close"
					        type="button" data-bs-dismiss="modal">
						<svg class="ico ico-mono-close">
							<use xlink:href="assets/img/sprite-mono.svg#ico-mono-close"></use>
						</svg>
					</button>
					<div class="row">
						<div class="col-12">
							<h1 class="modal-authorization__title">Авторизация </h1>
						</div>
						<form class="modal-authorization__form col-12" action="#">
							<div class="row">
								<input class="modal-authorization__input col-12" type="email"
								       name="email" placeholder="Email*">
								<input class="modal-authorization__input col-12" type="password"
								       name="password" placeholder="Пароль*">
							</div>
							<button
								class="modal-authorization__button button-fill button-fill--red"
								type="submit">Авторизоваться
							</button>
							<div
								class="modal-authorization__help row justify-content-between align-items-center">
								<a data-bs-toggle="modal" data-bs-target="#registration"
								   class="modal-authorization__link" href="#">У меня еще нет
									аккаунта</a></div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="modal modal-registration fade" id="registration" tabindex="-1"
	     aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-body">
					<button class="modal-close modal-authorization__close btn-close"
					        type="button" data-bs-dismiss="modal">
						<svg class="ico ico-mono-close">
							<use xlink:href="assets/img/sprite-mono.svg#ico-mono-close"></use>
						</svg>
					</button>
					<div class="row">
						<div class="col-12">
							<h1 class="modal-registration__title">Регистрация</h1>
						</div>
						<form class="modal-registration__form col-12" action="#">
							<div class="row">
								<input class="modal-registration__input col-12" type="text"
								       name="name" placeholder="ФИО*">
								<input class="modal-registration__input col-12" type="email"
								       name="email" placeholder="Email*">
								<input class="modal-registration__input col-12 phone" type="tel"
								       name="phone" placeholder="Телефон*">
								<input class="modal-registration__input col-12" type="password"
								       name="password" placeholder="Пароль*">
							</div>
							<button
								class="modal-registration__button button-fill button-fill--red"
								type="submit">Регистрация
							</button>
							<div
								class="modal-registration__help row justify-content-between align-items-center">
								<a data-bs-toggle="modal" data-bs-target="#authorization"
								   class="modal-registration__link" href="#">У меня есть
									аккаунт</a></div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php } ?>
<script src="<?= PATH ?>/assets/js/vendor.js"></script>
<script src="<?= PATH ?>/assets/js/jquery-ui.min.js"></script>
<script
	src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>
<script
	src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
<script src="<?= PATH ?>/assets/js/app.js"></script>
</body>
</html>