<!-- Default box -->
<div class="card">
	<div class="card-body">
		<form action="" method="post">
			<div class="form-group">
				<label class="required" for="parent_id">Родительская категория</label>
				<?php new \app\widgets\menu\Menu([
					"cache" => 0,
					"cacheKey" => "admin_menu_select",
					"class" => "form-control",
					"container" => "select",
					"attrs" => [
						"name" => "parent_id",
						"id" => "parent_id",
						"required" => "required"
					],
					"prepend" => '<option value="0">Самостоятельная категория</option>',
					"tpl" => APP . "/widgets/menu/admin_select_tpl.php"
				]); ?>
			</div>

			<div class="card card-info card-outline card-tabs">
				<div class="card-body">
					<div class="tab-content">
						<div class="tab-pane fade active show">

							<div class="form-group">
								<label class="required" for="name">Наименование</label>
								<input type="text" name="category[name]" class="form-control"
								       id="title" placeholder="Наименование категории"
								       value="<?= get_field_array_value(
									       "category",
									       "name"
								       ) ?>">
							</div>

							<div class="form-group">
								<label for="description">Мета-описание</label>
								<input type="text" name="category[description]"
								       class="form-control" id="description"
								       placeholder="Мета-описание"
								       value="<?= get_field_array_value(
									       "category",
									       "description"
								       ) ?>">
							</div>

							<div class="form-group">
								<label for="keywords">Ключевые слова</label>
								<input type="text"
								       name="category[keywords]"
								       class="form-control" id="keywords"
								       placeholder="Ключевые слова"
								       value="<?= get_field_array_value(
									       "category",
									       "keywords"
								       ) ?>">
							</div>

							<div class="form-group">
								<label for="content">Описание категории</label>
								<textarea
									name="category[content]"
									class="form-control editor" id="content" rows="3"
									placeholder="Описание категории"><?= get_field_array_value(
										"category",
										"content"
									) ?></textarea>
							</div>

						</div>
					</div>
				</div>
				<!-- /.card -->
			</div>

			<button type="submit" class="btn btn-primary">Сохранить</button>

		</form>
		
		<?php if (isset($_SESSION["form_data"])) {
			unset($_SESSION["form_data"]);
		} ?>

	</div>

</div>
<!-- /.card -->

<script>
	// https://question-it.com/questions/3558262/kak-ja-mogu-sozdat-neskolko-redaktorov-s-imenem-klassa
	// https://ckeditor.com/docs/ckfinder/demo/ckfinder3/samples/ckeditor.html
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
