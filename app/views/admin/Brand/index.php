<!-- Default box -->
<div class="card">
	
	<div class="card-header">
		<a href="<?= ADMIN ?>/brand/add" class="btn btn-default btn-flat"><i class="fas fa-plus"></i> Добавить производителя</a>
	</div>
	
	<div class="card-body">
		
		<?php if (!empty($brands)) { ?>
			<div class="table-responsive">
				<table class="table table-bordered">
					<thead>
					<tr>
						<th>ID</th>
						<th>Наименование</th>
						<td width="50"><i class="fas fa-pencil-alt"></i></td>
						<td width="50"><i class="far fa-trash-alt"></i></td>
					</tr>
					</thead>
					<tbody>
					<?php foreach ($brands as $brand) { ?>
						<tr>
							<td><?= $brand['id'] ?></td>
							<td>
								<?= $brand['name'] ?>
							</td>
							<td width="50">
								<a class="btn btn-info btn-sm"
								   href="<?= ADMIN ?>/brand/edit?id=<?= $brand['id'] ?>"><i
										class="fas fa-pencil-alt"></i></a>
							</td>
							<td width="50">
								<a class="btn btn-danger btn-sm delete"
								   href="<?= ADMIN ?>/brand/delete?id=<?= $brand['id'] ?>">
									<i class="far fa-trash-alt"></i>
								</a>
							</td>
						</tr>
					<?php } ?>
					</tbody>
				</table>
			</div>
		<?php } else { ?>
			<p>Бренды не найдены...</p>
		<?php } ?>
	
	</div>
</div>
<!-- /.card -->
