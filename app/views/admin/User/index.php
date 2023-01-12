<!-- Default box -->
<div class="card">

	<div class="card-body">
		
		<?php if (!empty($users)) { ?>
			<table class="table table-bordered">
				<thead>
				<tr>
					<th>ID</th>
					<th>Email</th>
					<th>Телефон</th>
					<th>Имя</th>
					<th>Роль</th>
					<th width="50"><i class="fas fa-eye"></i></th>
				</tr>
				</thead>
				<tbody>
				<?php foreach ($users as $user) { ?>
					<tr>
						<td><?= $user['id'] ?></td>
						<td><?= $user['email'] ?></td>
						<td><?= $user['phone'] ?></td>
						<td><?= $user['name'] ?></td>
						<td><?= $user['role'] == 'user' ? 'Пользователь'
								: 'Администратор' ?></td>
						<td>
							<a class="btn btn-info btn-sm"
							   href="<?= ADMIN ?>/user/view?id=<?= $user['id'] ?>">
								<i class="fas fa-eye"></i>
							</a>
						</td>
					</tr>
				<?php } ?>
				</tbody>
			</table>

			<div class="row">
				<div class="col-md-12">
					<p><?= count($users) ?> пользователь(я/ей) из: <?= $total; ?></p>
					<?php if ($pagination->countPages > 1) { ?>
						<?= $pagination; ?>
					<?php } ?>
				</div>
			</div>
		
		<?php } else { ?>
			<p>Пользователей не найдено...</p>
		<?php } ?>

	</div>
</div>
<!-- /.card -->
