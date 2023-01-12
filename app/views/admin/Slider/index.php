<!-- Default box -->
<div class="card">
	
	<div class="card-header">
		<a href="<?= ADMIN ?>/slider/add" class="btn btn-default btn-flat"><i class="fas fa-plus"></i> Добавить слайд</a>
	</div>
	
	<div class="card-body">
		
		<?php if (!empty($slides)) { ?>
			<div class="table-responsive">
				<table class="table table-bordered">
					<thead>
					<tr>
						<th>ID</th>
						<th>Заголовок</th>
						<th>Картинка</th>
						<td width="50"><i class="fas fa-pencil-alt"></i></td>
						<td width="50"><i class="far fa-trash-alt"></i></td>
					</tr>
					</thead>
					<tbody>
					<?php foreach ($slides as $slide) { ?>
						<tr>
							<td><?= $slide["id"] ?></td>
							<td>
								<?= $slide["title"] ?>
							</td>
							<td>
								<img src="<?= $slide["img"] ?>" alt="" height="40">
							</td>
							<td width="50">
								<a class="btn btn-info btn-sm"
								   href="<?= ADMIN ?>/slider/edit?id=<?= $slide["id"] ?>"><i
										class="fas fa-pencil-alt"></i></a>
							</td>
							<td width="50">
								<a class="btn btn-danger btn-sm delete"
								   href="<?= ADMIN ?>/slider/delete?id=<?= $slide["id"] ?>">
									<i class="far fa-trash-alt"></i>
								</a>
							</td>
						</tr>
					<?php } ?>
					</tbody>
				</table>
			</div>
			
		
		<?php } else { ?>
			<p>Слайдов не найдено...</p>
		<?php } ?>
	
	</div>
</div>
<!-- /.card -->
