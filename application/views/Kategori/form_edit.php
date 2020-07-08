<style type="text/css">
	table,
	th,
	tr,
	td {
		text-align: center;
	}
</style>

<section class="content">
	<div class="row">
		<div class='col-xs-12'>
			<div class="box box-info">
				<div class="box-header with-border">
					<h3 class="box-title"> Tambah Data Kategori</h3>
				</div>
				<div class="box-body">
					<?php
					echo form_open('kategori/post', array('role' => "form", 'id' => "myForm", 'data-toggle' => "validator"));
					?>
					<div class="form-group">
						<label for="kategori" class="control-label">Nama Kategori</label>
						<div class="input-group">
							<input type="text" class="form-control" name="kategori" id="kategori" data-error="Nama Kategori harus diisi" placeholder="Nama Kategori" value="<?php echo $record['nama_kategori']; ?>" required />
							<span class="input-group-addon">
								<span class="fa fa-cube"></span>
							</span>
						</div>
						<div class="help-block with-errors"></div>
					</div>
					<button type="submit" class="btn btn-info" name="submit"> simpan </button>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>