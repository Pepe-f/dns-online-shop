<section class="breadcrumb">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<ul>
					<li> <a href="<?= PATH ?>" itemprop="item">Главная</a>
					</li>
					<li> <a href="#">Личный кабинет</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
</section>
<section class="profile">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<h1 class="profile__title">Личный кабинет</h1>
			</div>
			<div class="col-12 profile-data">
				<div class="row">
					<div class="col-12">
						<h2 class="profile-data__subtitle">Кабинет</h2>
					</div>
					<div class="col-12 profile-data__links">
						<a href="user/history" class="profile-data__links-item">История заказов</a>
						<a href="user/logout" class="profile-data__links-item">Выйти из личного кабинета</a>
					</div>
					<div class="col-12">
						<h2 class="profile-data__subtitle">Ваши данные </h2>
					</div>
					<form class="profile-data__form profile-data__form-data">
						<div class="profile-data__wrapper">
							<div class="profile-data__input-wrapper">
								<input class="profile-data__input" type="text" name="name"
								       placeholder="ФИО*" value="<?= $_SESSION["user"]["name"] ?>" required>
							</div>
							<div class="profile-data__input-wrapper">
								<input class="profile-data__input phone" type="tel" name="phone"
								       placeholder="Номер телефона*" value="<?= $_SESSION["user"]["phone"] ?>" required>
							</div>
							<div class="profile-data__input-wrapper">
								<input class="profile-data__input" type="email" name="email"
								       placeholder="E-mail*" value="<?= $_SESSION["user"]["email"] ?>" required>
							</div>
							<div class="profile-data__input-wrapper">
								<input class="profile-data__input" type="text" name="location"
								       placeholder="Город*" value="<?= $_SESSION["user"]["location"] ?>" required>
							</div>
						</div>
						<button class="profile-data__button button-fill button-fill--primary" type="submit">Сохранить данные </button>
					</form>
					<form class="profile-data__form profile-data__form-pass" action="#">
						<div class="profile-data__wrapper">
							<div class="profile-data__input-wrapper">
								<input class="profile-data__input" type="password" name="password" placeholder="Новый пароль" required>
							</div>
							<div class="profile-data__input-wrapper">
								<input class="profile-data__input" type="password" name="password_2" placeholder="Повтор нового пароля" required>
							</div>
						</div>
						<button class="profile-data__button button-fill button-fill--primary" type="submit">Изменить пароль</button>
					</form>
					<div class="response">
						<div></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>