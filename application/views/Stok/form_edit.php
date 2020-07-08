<style>
	.select2-container .select2-selection--single {
		box-sizing: border-box;
		cursor: pointer;
		display: block;
		height: 35px;
		user-select: none;
		-webkit-user-select: none;
	}
</style>
<section class="content">
	<div class="row">
		<div class="col-md-7 col-md-7 col-md-push-3 ">
			<!-- quick email widget -->
			<div class="box box-info">
				<div class='box-header  with-border'>
					<h3 class='box-title'>Edit Data Stok Barang</h3>
				</div>
				<div class="box-body">
					<?php
					echo form_open('stok/edit', ['class' => 'form-horizontal', 'role' => "form", 'id' => "myForm", 'data-toggle' => "validator"]);
					?>
					<input type="hidden" name="id" value="<?php echo $stok['id_stok'] ?>">
					<div class="form-group" style="width:600px;padding-left:50px">
						<label for="stok" class="control-label">Nama Barang</label>
						<div class="input-group">
							<select class="form-control select22" name="barang">
								<?php
								foreach ($barang as $b) {
									if ($stok['id_barang'] == $b->id_barang) {
										echo "<option value=' $b->id_barang' selected='selected'>$b->nama_barang</option>";
									} else {
										echo "<option value=' $b->id_barang'>$b->nama_barang</option>";
									}
								}
								?>
							</select>
							<span class="input-group-addon">
								<span class="fa fa-cubes"></span>
							</span>
						</div>
						<div class="help-block with-errors"></div>
					</div>
					<div class="form-group" style="width:600px;padding-left:50px">
						<label for="" class="control-label">Jumlah Stok Barang</label>
						<div class="input-group">
							<input type="text" class="form-control" name="stok" id="stok" data-error="Total stok harus diisi" placeholder="Total Stok" value="<?php echo $stok['stok_barang'] ?>" required />
							<span class="input-group-addon">
								<span class="fa fa-cubes"></span>
							</span>
						</div>
						<div class="help-block with-errors"></div>
					</div>
					<button type="submit" class="btn btn-info" name="submit"> simpan </button>
					<a href="<?php echo base_url() ?>stok" class="btn btn-default ">Cancel</a>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>