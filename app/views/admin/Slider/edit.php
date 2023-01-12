<!-- Default box -->
<div class="card">

	<div class="card-body">

		<form action="" method="post">
			
            <div class="card card-info card-outline card-tabs">
				<div class="card-body">
					<div class="tab-content">
						<div class="tab-pane fade active show">

							<div class="form-group">
								<label class="required" for="title">Заголовок</label>
								<input type="text" name="title" class="form-control"
								       id="title" placeholder="Заголовок"
								       value="<?= $slide["title"] ?>">
							</div>

							<div class="form-group">
								<label for="text">Текст</label>
								<textarea name="text" class="form-control editor"
								          id="text" rows="3"
								          placeholder="Текст"><?= $slide["text"] ?></textarea>
							</div>
						</div>
					</div>
				</div>
				<!-- /.card -->
			</div>
			
			<div class="row">
				<div class="col-md-12">
					<div class="card card-outline card-success">
						<div class="card-header">
							<h3 class="card-title">Фото</h3>
						</div>
						<div class="card-body">
							<button class="btn btn-success" id="add-base-img"
							        onclick="popupBaseImage(); return false;">Загрузить
							</button>
							<div id="base-img-output" class="upload-images base-image">
								<div class="product-img-upload">
									<img src="<?= $slide["img"] ?>">
									<input type="hidden" name="img"
									       value="<?= $slide["img"] ?>">
									<?php if ($slide["img"] != NO_IMAGE) { ?>
										<button class="del-img btn btn-app bg-danger">
											<i class="far fa-trash-alt"></i>
										</button>
									<?php } ?>
								</div>
							</div>
						</div>
						<!-- /.card-body -->
					</div>
				</div>
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