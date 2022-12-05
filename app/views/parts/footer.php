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
									<ul class="footer-body__list-col-1 col-sm-6 col-12">
										<li class="footer-body__item"><a class="footer-body__link" href="#">О нас</a></li>
										<li class="footer-body__item"><a class="footer-body__link" href="#">Контакты</a></li>
										<li class="footer-body__item"><a class="footer-body__link" href="#">Доставка и оплата</a></li>
										<li class="footer-body__item"><a class="footer-body__link" href="#">Возврат товаров</a></li>
									</ul>
									<ul class="footer-body__list-col-2 col-sm-6 col-12">
										<li class="footer-body__item"><a class="footer-body__link" href="#">Вопросы и ответы</a></li>
										<li class="footer-body__item"><a class="footer-body__link" href="#">Новинки</a></li>
										<li class="footer-body__item"><a class="footer-body__link" href="#">Рекомендации</a></li>
										<li class="footer-body__item"><a class="footer-body__link" href="#">Документы</a></li>
									</ul>
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
								<div class="col-12"><a class="footer-body__contact" href="tel:89990009988">
										<svg class="ico ico-mono-footer-phone">
											<use xlink:href="assets/img/sprite-mono.svg#ico-mono-footer-phone"></use>
										</svg><span>8 800 77 07 999</span></a></div>
								<div class="col-12"> <a class="footer-body__contact" href="mailto:dns@shop.ru">
										<svg class="ico ico-mono-footer-mail">
											<use xlink:href="assets/img/sprite-mono.svg#ico-mono-footer-mail"></use>
										</svg><span>dns@shop.ru</span></a></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="footer-policy col-12">
				<div class="row">
					<div class="col-12"> <span>2022 © Все права защищены.</span></div>
					<div class="col-12"> <span>Вся информация, размещенная на сайте, носит информационный характер и не является публичной офертой.</span></div>
				</div>
			</div>
		</div>
	</div>
</footer>
<div class="modal modal-confirm fade" id="location-confirm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				<button class="modal-close modal-confirm__close btn-close" type="button" data-bs-dismiss="modal">
					<svg class="ico ico-mono-close">
						<use xlink:href="assets/img/sprite-mono.svg#ico-mono-close"></use>
					</svg>
				</button>
				<div class="row">
					<div class="col-12">
						<p class="modal-confirm__text">Ваш город <span>Москва</span>?</p>
					</div>
					<div class="col-12">
						<button class="modal-confirm__button modal-confirm__button--normal button-fill--red" type="button" data-bs-dismiss="modal">Да, все верно</button>
						<button class="modal-confirm__button modal-confirm__button--change" type="button" data-bs-toggle="modal" data-bs-target="#location-change">
							Нет, изменить город</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal modal-change fade" id="location-change" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				<button class="modal-close modal-change__close btn-close" type="button" data-bs-dismiss="modal">
					<svg class="ico ico-mono-close">
						<use xlink:href="assets/img/sprite-mono.svg#ico-mono-close"></use>
					</svg>
				</button>
				<div class="row">
					<form class="modal-change__form col-12" action="#">
						<div class="row">
							<div class="col-12">
								<h3 class="modal-change__request">Введите название вашего города</h3>
							</div>
							<div class="col-12">
								<input class="modal-change__input" type="text" name="location">
							</div>
							<div class="col-12">
								<p class="modal-change__description">Если вашего города нет в списке, введите название ближайшего, более крупного города</p>
							</div>
						</div>
					</form>
					<div class="col-12">
						<div class="modal-change__options row">
							<button class="modal-change__variant">Москва</button>
							<button class="modal-change__variant">Магнитогорск</button>
							<button class="modal-change__variant">Мурманск</button>
							<button class="modal-change__variant">Михайлово</button>
							<button class="modal-change__variant">Можайск</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal modal-authorization fade" id="authorization" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				<button class="modal-close modal-authorization__close btn-close" type="button" data-bs-dismiss="modal">
					<svg class="ico ico-mono-close">
						<use xlink:href="assets/img/sprite-mono.svg#ico-mono-close"></use>
					</svg>
				</button>
				<div class="row">
					<div class="col-12">
						<h1 class="modal-authorization__title">Авторизация </h1>
					</div>
					<form class="modal-authorization__form col-12" action="#" method="POST">
						<div class="row">
							<input class="modal-authorization__input col-12" type="email" name="auth_mail" placeholder="Email*">
							<input class="modal-authorization__input col-12" type="password" name="auth_password" placeholder="Пароль*">
						</div>
						<button class="modal-authorization__button button-fill button-fill--red" type="submit">Авторизоваться</button>
						<div class="modal-authorization__help row justify-content-between align-items-center"><a data-bs-toggle="modal" data-bs-target="#registration" class="modal-authorization__link" href="#">У меня еще нет аккаунта</a></div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal modal-registration fade" id="registration" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				<button class="modal-close modal-authorization__close btn-close" type="button" data-bs-dismiss="modal">
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
							<input class="modal-registration__input col-12" type="text" name="reg_name" placeholder="ФИО*">
							<input class="modal-registration__input col-12" type="email" name="reg_mail" placeholder="Email*">
							<input class="modal-registration__input col-12 phone" type="tel" name="reg_phone" placeholder="Телефон*">
							<input class="modal-registration__input col-12" type="password" name="reg_password" placeholder="Пароль*">
						</div>
						<button class="modal-registration__button button-fill button-fill--red" type="submit">Регистрация</button>
						<div class="modal-registration__help row justify-content-between align-items-center"><a data-bs-toggle="modal" data-bs-target="#authorization" class="modal-registration__link" href="#">У меня есть аккаунт</a></div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="<?= PATH ?>/assets/js/vendor.js"></script>
<script src="<?= PATH ?>/assets/js/jquery-ui.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
<script src="<?= PATH ?>/assets/js/app.js"></script>
</body>
</html>