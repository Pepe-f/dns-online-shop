<!-- Default box -->
<div class="card">
	<div class="card-body">
		<form action="" method="post">
			
			<div class="card card-info card-outline card-tabs">
				<div class="card-body">
					<div class="tab-content">
						<div class="tab-pane fade active show">
							
							<div class="form-group">
								<label class="required" for="name">Наименование</label>
								<input type="text" name="brand[name]" class="form-control"
								       id="name" placeholder="Наименование категории"
								       value="<?= h($brand['name']) ?>">
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
