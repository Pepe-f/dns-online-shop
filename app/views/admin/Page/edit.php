<!-- Default box -->
<div class="card">

	<div class="card-body">

		<form action="" method="post">
			<div class="card card-info card-outline card-tabs">
				<div class="card-body">
					<div class="tab-content">
						<div class="tab-pane fade active show">

							<div class="form-group">
								<label class="required" for="title">Наименование
									страницы</label>
								<input type="text" name="page[title]"
								       class="form-control" id="title"
								       placeholder="Наименование страницы"
								       value="<?= h($page['title']) ?>">
							</div>

							<div class="form-group">
								<label for="description">Мета-описание</label>
								<input type="text" name="page[description]"
								       class="form-control" id="description"
								       placeholder="Мета-описание"
								       value="<?= h($page['description']) ?>">
							</div>

							<div class="form-group">
								<label for="keywords">Ключевые слова</label>
								<input type="text" name="page[keywords]"
								       class="form-control" id="keywords"
								       placeholder="Ключевые слова"
								       value="<?= h($page['keywords']) ?>">
							</div>

							<div class="form-group">
								<label for="content">Контент страницы</label>
								<textarea name="page[content]"
								          class="form-control editor" id="content" rows="3"
								          placeholder="Контент страницы"><?= h(
										$page['content']
									) ?></textarea>
							</div>

						</div>
					</div>
				</div>
				<!-- /.card -->
			</div>

			<button type="submit" class="btn btn-primary">Сохранить</button>

		</form>

	</div>

</div>
<!-- /.card -->

<script>
	window.editors = {};
	document.querySelectorAll('.editor').forEach((node, index) => {
		ClassicEditor
			.create(node, {
				ckfinder: {
					uploadUrl: '<?= PATH ?>/adminlte/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json'
				},
				toolbar: ['ckfinder', '|', 'heading', '|', 'bold', 'italic', '|', 'undo', 'redo', '|', 'link', 'bulletedList', 'numberedList', 'insertTable', 'blockQuote'],
				image: {
					toolbar: ['imageTextAlternative', '|', 'imageStyle:alignLeft', 'imageStyle:alignCenter', 'imageStyle:alignRight'],
					styles: [
						'alignLeft',
						'alignCenter',
						'alignRight'
					]
				}
			})
			.then(newEditor => {
				window.editors[index] = newEditor;
			})
			.catch(error => {
				console.error(error);
			});
	});
</script>