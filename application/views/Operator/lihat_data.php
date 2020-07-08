<style type="text/css">
	table,
	th,
	tr,
	td {
		text-align: center;
	}

	.swal2-popup {
		font-family: inherit;
		font-size: 1.2rem;
	}
</style>
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-info">
				<div class="box-header with-border">
					<h3 class="box-title"> Operator</h3>
					<div class="pull-right">
						<?php
						echo anchor('operator/post', 'Tambah Data', array('class' => 'btn btn-success'));
						?>
					</div>
				</div>
				<div class="box-body">
					<table id="myTable" class="table table-bordered table-striped table-hover">
						<thead>
							<tr>
								<th>No</th>
								<th>Nama Operator</th>
								<th>Username </th>
								<th>Akses</th>
								<th>Foto</th>
								<th>Operasi</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$no = 0;
							foreach ($record as $operator) { ?>
							<tr>
								<td><?php echo ++$no; ?></td>
								<td><?php echo $operator->nama_operator ?></td>
								<td><?php echo $operator->username ?></td>
								<td><?php echo $operator->nama_akses ?></td>
								<td>
									<a href="<?php echo (site_url('uploads/operator/' . $operator->foto)); ?>" class="image-link">
										<img src="<?php echo (site_url('uploads/operator/' . $operator->foto)); ?>" alt="" style="width:30px;height:30px">
									</a>
								</td>
								<td>
									<?php
										echo anchor(site_url('operator/edit/' . $operator->id_operator), '<i class="fa fa-pencil-square-o fa-lg"></i>&nbsp;&nbsp;Edit', array('title' => 'edit', 'class' => 'btn btn-sm btn-warning'));
										echo '&nbsp';
										echo anchor(site_url('operator/hapus/' . $operator->id_operator), '<i class="fa fa-trash fa-lg"></i>&nbsp;&nbsp;Hapus', 'title="delete" class="btn btn-sm btn-danger "');
										?>
								</td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</section>
<script src="<?php echo base_url() ?>assets/app/js/alert.js"></script>
<script>
	$(document).ready(function() {

		var table = $('#myTable').dataTable({
			"fnDrawCallback": function() {
				$('.image-link').magnificPopup({
					type: 'image',
					closeOnContentClick: true,
					closeBtnInside: false,
					fixedContentPos: true,

					image: {
						verticalFit: true
					},
					zoom: {
						enabled: true,
						duration: 300 // don't foget to change the duration also in CSS
					},

				});
			}
		});
	});
</script>