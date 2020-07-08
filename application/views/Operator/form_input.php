<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/app/css/style.css">
<?php if ($this->session->flashdata('message')) { ?>
<div class="col-lg-12 alerts">
	<div class="alert alert-dismissible alert-danger">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<h4> <i class="icon fa fa-ban"></i> Error</h4>
		<p><?php echo $this->session->flashdata('message'); ?></p>
	</div>
</div>
<?php } else { } ?>

<section class="content">
	<div class="row">
		<div class='col-xs-12'>
			<div class='box box-primary'>
				<div class='box-header  with-border'>
					<h3 class='box-title'>Tambah Data Operator</h3>
				</div>
				<div class="box-body">
					<?php echo form_open_multipart('operator/post', array('role' => "form", 'id' => "myForm", 'data-toggle' => "validator")); ?>
					<div class="form-group">
						<label for="operator" class="control-label">Nama Operator</label>
						<div class="input-group">
							<input type="text" class="form-control" name="operator" id="operator" data-error="Nama Operator harus diisi" placeholder="Nama Operator" value="" required />
							<span class="input-group-addon">
								<span class="fa fa-user"></span>
							</span>
						</div>
						<div class="help-block with-errors"></div>
					</div>
					<div class="form-group">
						<label for="username" class="control-label">Nama Username</label>
						<div class="input-group">
							<input type="text" class="form-control" name="username" id="username" data-error="Nama Username harus diisi" placeholder="Nama Username" value="" required />
							<span class="input-group-addon">
								<span class="fa fa-id-badge"></span>
							</span>
						</div>
						<div class="help-block with-errors"></div>
					</div>
					<div class="form-group">
						<label for="password" class="control-label">Password</label>
						<div class="input-group">
							<input type="password" class="form-control" name="password" id="password" data-error="Password harus diisi" placeholder="Password" value="" required />
							<span class="input-group-addon">
								<span class="fa fa-key"></span>
							</span>
						</div>
						<div class="help-block with-errors"></div>
					</div>
					<div class="form-group">
						<label for="akses" class="control-label">akses</label>
						<div class="input-group">
							<select class="form-control" name="akses">
								<?php
								foreach ($akses as $a) {
									echo "<option value=' $a->id_akses'>$a->nama_akses</option>";
								}
								?>
							</select>
							<span class="input-group-addon">
								<span class="fa fa-user-circle"></span>
							</span>
						</div>
					</div>
					<div class="form-group">
						<label for="foto" class="control-label">Foto</label>
						<div class="input-group">
							<input type="file" name="foto" class="form-control">
							<span class="input-group-addon">
								<span class="fa fa-photo"></span>
							</span>
						</div>
						<div class="help-block with-errors"></div>
					</div>
					<div class="box-footer">
						<button type="submit" name="submit" class="btn btn-primary ">Simpan</button>
						<a href="<?php echo base_url() ?>operator" class="btn btn-default ">Cancel</a>
					</div>
					</form>
				</div><!-- /.box-body -->
			</div><!-- /.box -->
		</div>
	</div>
</section>

