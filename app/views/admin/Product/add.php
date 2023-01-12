<!-- Default box -->
<div class="card">

	<div class="card-body">

		<form action="" method="post">

			<div class="form-group">
				<label class="required" for="parent_id">Категория</label>
				<?php new \app\widgets\menu\Menu([
					'cache' => 0,
					'cacheKey' => 'admin_menu_select',
					'class' => 'form-control',
					'container' => 'select',
					'attrs' => [
						'name' => 'parent_id',
						'id' => 'parent_id',
						'required' => 'required',
					],
					'tpl' => APP . '/widgets/menu/admin_select_tpl.php',
				]); ?>
			</div>
			
			<div class="form-group">
				<label class="required" for="brand_id">Бренд</label>
				<select class="form-control" name="brand_id" id="brand_id">
					<?php foreach ($brands as $brand) { ?>
						<option value="<?= $brand['id'] ?>"><?= $brand['name'] ?></option>
					<?php } ?>
				</select>
			</div>

			<div class="form-group">
				<label class="required" for="article">Артикул</label>
				<input type="text" name="article" class="form-control" id="article"
				       placeholder="Артикул товара"
				       value="<?= h(get_field_value('article')) ?>">
			</div>

			<div class="row">
				<div class="col-sm-6">
					<div class="form-group">
						<label class="required" for="price">Цена</label>
						<input type="text" name="price" class="form-control" id="price"
						       placeholder="Цена"
						       value="<?= get_field_value('price') ?: 0 ?>">
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group">
						<label class="required" for="qty">На складе</label>
						<input type="text" name="qty" class="form-control" id="qty"
						       placeholder="На складе"
						       value="<?= get_field_value('qty') ?: 0 ?>">
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="col-md-12">
					<div class="card card-outline card-success">
						<div class="card-header">
							<h3 class="card-title">Основное фото</h3>
						</div>
						<div class="card-body">
							<button class="btn btn-success" id="add-base-img"
							        onclick="popupBaseImage(); return false;">Загрузить
							</button>
							<div id="base-img-output" class="upload-images base-image"></div>
						</div>
						<!-- /.card-body -->
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-12">
					<div class="card card-outline card-success">
						<div class="card-header">
							<h3 class="card-title">Галерея (включая основное)</h3>
						</div>
						<div class="card-body">
							<button class="btn btn-success" id="add-gallery-img"
							        onclick="popupGalleryImage(); return false;">Загрузить
							</button>
							<div id="gallery-img-output"
							     class="upload-images gallery-image"></div>
						</div>
						<!-- /.card-body -->
					</div>
				</div>
			</div>


			<div class="card card-info card-outline card-tabs">
				<div class="card-body">
					<div class="tab-content">
						<div class="tab-pane fade active show">

							<div class="form-group">
								<label class="required" for="name">Наименование</label>
								<input type="text" name="product[name]" class="form-control"
								       id="name" placeholder="Наименование товара"
								       value="<?= get_field_array_value('product', 'name') ?>">
							</div>

							<div class="form-group">
								<label for="description">Мета-описание</label>
								<input type="text" name="product[description]"
								       class="form-control" id="description"
								       placeholder="Мета-описание"
								       value="<?= get_field_array_value(
									       'product', 'description'
								       ) ?>">
							</div>

							<div class="form-group">
								<label for="keywords">Ключевые слова</label>
								<input type="text" name="product[keywords]" class="form-control"
								       id="keywords" placeholder="Ключевые слова"
								       value="<?= get_field_array_value(
									       'product', 'keywords'
								       ) ?>">
							</div>

							<div class="form-group">
								<label for="content">Описание товара</label>
								<textarea name="product[content]" class="form-control editor"
								          id="content" rows="3"
								          placeholder="Описание товара"><?= get_field_array_value(
										'product', 'content'
									) ?></textarea>
							</div>

						</div>
					</div>
				</div>
				<!-- /.card -->
			</div>

			<button type="submit" class="btn btn-primary">Сохранить</button>

		</form>
		
		<?php
		if (isset($_SESSION['form_data'])) {
			unset($_SESSION['form_data']);
		}
		?>

	</div>

</div>
<!-- /.card -->
<script>
	function popupBaseImage() {
		CKFinder.popup({
			chooseFiles: true,
			onInit: function(finder) {
				finder.on('files:choose', function(evt) {
					var file = evt.data.files.first();
					const baseImgOutput = document.getElementById('base-img-output');
					baseImgOutput.innerHTML = '<div class="product-img-upload"><img src="' + file.getUrl() + '"><input type="hidden" name="img" value="' + file.getUrl() + '"><button class="del-img btn btn-app bg-danger"><i class="far fa-trash-alt"></i></button></div>';
				});
				finder.on('file:choose:resizedImage', function(evt) {
					const baseImgOutput = document.getElementById('base-img-output');
					baseImgOutput.innerHTML = '<div class="product-img-upload"><img src="' + evt.data.resizedUrl + '"><input type="hidden" name="img" value="' + evt.data.resizedUrl + '"><button class="del-img btn btn-app bg-danger"><i class="far fa-trash-alt"></i></button></div>';
				});
			}
		});
	}
</script>

<script>
	function popupGalleryImage() {
		CKFinder.popup({
			chooseFiles: true,
			onInit: function(finder) {
				finder.on('files:choose', function(evt) {
					var file = evt.data.files.first();
					const galleryImgOutput = document.getElementById('gallery-img-output');
					
					if (galleryImgOutput.innerHTML) {
						galleryImgOutput.innerHTML += '<div class="product-img-upload"><img src="' + file.getUrl() + '"><input type="hidden" name="gallery[]" value="' + file.getUrl() + '"><button class="del-img btn btn-app bg-danger"><i class="far fa-trash-alt"></i></button></div>';
					} else {
						galleryImgOutput.innerHTML = '<div class="product-img-upload"><img src="' + file.getUrl() + '"><input type="hidden" name="gallery[]" value="' + file.getUrl() + '"><button class="del-img btn btn-app bg-danger"><i class="far fa-trash-alt"></i></button></div>';
					}
					
				});
				finder.on('file:choose:resizedImage', function(evt) {
					const baseImgOutput = document.getElementById('base-img-output');
					
					if (galleryImgOutput.innerHTML) {
						galleryImgOutput.innerHTML += '<div class="product-img-upload"><img src="' + file.getUrl() + '"><input type="hidden" name="gallery[]" value="' + file.getUrl() + '"><button class="del-img btn btn-app bg-danger"><i class="far fa-trash-alt"></i></button></div>';
					} else {
						galleryImgOutput.innerHTML = '<div class="product-img-upload"><img src="' + file.getUrl() + '"><input type="hidden" name="gallery[]" value="' + file.getUrl() + '"><button class="del-img btn btn-app bg-danger"><i class="far fa-trash-alt"></i></button></div>';
					}
					
				});
			}
		});
	}
</script>

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