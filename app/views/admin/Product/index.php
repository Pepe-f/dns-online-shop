<!-- Default box -->
<div class="card">
	
	<div class="card-header">
		<a href="<?= ADMIN ?>/product/add" class="btn btn-default btn-flat"><i class="fas fa-plus"></i> Добавить товар</a>
	</div>
	
	<div class="card-body">
		
		<?php if (!empty($products)) { ?>
			<div class="table-responsive">
				<table class="table table-bordered">
					<thead>
					<tr>
						<th>ID</th>
						<th>Наименование</th>
						<th>Артикул</th>
						<th>Главное фото</th>
						<th>Цена</th>
						<th>На складе</th>
						<td width="50"><i class="fas fa-pencil-alt"></i></td>
						<td width="50"><i class="far fa-trash-alt"></i></td>
					</tr>
					</thead>
					<tbody>
					<?php foreach ($products as $product) { ?>
						<tr>
							<td><?= $product['id'] ?></td>
							<td>
								<?= $product['name'] ?>
							</td>
							<td>
								<?= $product['article'] ?>
							</td>
							<td>
								<img src="<?= $product['img'] ?>" alt="" height="40">
							</td>
							<td>
								<?= $product['price'] ?>
							</td>
							<td>
								<?= $product['qty'] ?>
							</td>
							<td width="50">
								<a class="btn btn-info btn-sm"
								   href="<?= ADMIN ?>/product/edit?id=<?= $product['id'] ?>"><i
										class="fas fa-pencil-alt"></i></a>
							</td>
							<td width="50">
								<a class="btn btn-danger btn-sm delete"
								   href="<?= ADMIN ?>/product/delete?id=<?= $product['id'] ?>">
									<i class="far fa-trash-alt"></i>
								</a>
							</td>
						</tr>
					<?php } ?>
					</tbody>
				</table>
			</div>
			
			<div class="row">
				<div class="col-md-12">
					<p><?= count($products) ?> товар(ов) из: <?= $total; ?></p>
					<?php if ($pagination->countPages > 1) { ?>
						<?= $pagination; ?>
					<?php } ?>
				</div>
			</div>
		
		<?php } else { ?>
			<p>Товаров не найдено...</p>
		<?php } ?>
	
	</div>
</div>
<!-- /.card -->
