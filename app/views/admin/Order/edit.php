<!-- Default box -->
<div class="card">
	
	<div class="card-body">
		<div class="table-responsive">
			<table class="table text-start table-bordered">
				<thead>
				<tr>
					<th scope="col">Наименование</th>
					<th scope="col">Цена</th>
					<th scope="col">Кол-во</th>
					<th scope="col">Сумма</th>
				</tr>
				</thead>
				<tbody>
				<?php foreach ($cart as $item) { ?>
					<tr>
						<td><a href="product/<?= $item['slug'] ?>"><?= $item['name'] ?></a></td>
						<td><?= $item['price'] ?> ₽</td>
						<td><?= $item['qty'] ?></td>
						<td><?= $item['sum'] ?> ₽</td>
					</tr>
				<?php } ?>
				</tbody>
			</table>
		</div>
		
		<div class="box">
			<h3 class="box-title">Детали заказа</h3>
			<div class="box-content">
				<div class="table-responsive">
					<table class="table text-start table-striped">
						<tr>
							<td>Номера заказа</td>
							<td><?= $order['id'] ?></td>
						</tr>
						<tr>
							<td>Статус</td>
							<td><?= $order['status'] ? 'Завершен' : 'Новый' ?></td>
						</tr>
						<tr>
							<td>Создан</td>
							<td><?= $order['created_at'] ?></td>
						</tr>
						<tr>
							<td>Обновлен</td>
							<td><?= $order['updated_at'] ?></td>
						</tr>
						<tr>
							<td>Итоговая сумма</td>
							<td><?= $order['total'] ?> ₽</td>
						</tr>
						<tr>
							<td>Адрес</td>
							<td>г. <?= $order['city'] ?>, <?= $order['address'] ?></td>
						</tr>
						<tr>
							<td>Примечание</td>
							<td><?= $order['note'] ?></td>
						</tr>
						<tr>
							<td>Комментарий</td>
							<td><?= $order['comment'] ?></td>
						</tr>
					</table>
				</div>
			</div>
		
		</div>
		
		<?php if (!$order['status']) { ?>
			<a href="<?= ADMIN ?>/order/edit?id=<?= $order['id'] ?>&status=1" class="btn btn-success btn-flat">Изменить статус на Завершен</a>
		<?php } else { ?>
			<a href="<?= ADMIN ?>/order/edit?id=<?= $order['id'] ?>&status=0" class="btn btn-danger btn-flat">Изменить статус на Новый</a>
		<?php } ?>
	
	</div>
</div>
<!-- /.card -->
