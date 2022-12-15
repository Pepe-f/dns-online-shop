<section class="ordering-success">
	<div class="container">
		<div class="ordering-success__body">
			<h1 class="ordering-success__number">Заказ №<?= $_SESSION["last"] ?></h1>
			<p class="ordering-success__thanks">Спасибо за заказ! Ваш заказ №<?= $_SESSION[
   	"last"
   ] ?> принят.</p>
			<p class="ordering-success__text">О ходе выполнения заказа Вы будете информированы по электронной почте.
				<br>Ожидайте доставку заказа в указанное время.
				<br>
				<br>По всем вопросам, связанным с оформлением и получением заказа, звоните по телефону <a
					href="tel:88005553535">8 800 555 35 35</a>
			</p>
		</div>
	</div>
</section>
<?php unset($_SESSION["last"]); ?>
