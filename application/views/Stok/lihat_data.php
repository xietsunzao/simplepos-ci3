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

	.btn-group,
	.btn-group-vertical {
		position: relative;
		display: initial;
		vertical-align: middle;
	}
</style>
<?php if ($this->session->flashdata('message')) { ?>
<div class="col-lg-12 alerts">
	<div class="alert alert-dismissible alert-warning">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<h4> <i class="icon fa fa-ban"></i>Warning</h4>
		<p><?php echo $this->session->flashdata('message'); ?></p>
	</div>
</div>
<?php } else { } ?>
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-info">
				<div class='box-header  with-border'>
					<h3 class='box-title'>Stok Barang</h3>
					<div class="pull-right">
						<?php
						echo anchor('stok/post', 'Tambah Data', array('class' => 'btn btn-success'));
						?>
					</div>
				</div>
				<div class="box-body">
					<table id="myTable" class="table table-bordered table-striped table-hover">
						<thead>
							<tr>
								<th>No</th>
								<th>Nama barang</th>
								<th>Kategori barang</th>
								<th>Harga Barang</th>
								<th>Stok Barang</th>
								<th>Kapasitas</th>
								<th>Tanggal</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$no = 0;
							foreach ($stok as $s) { ?>
							<tr>
								<td><?php echo ++$no ?> </td>
								<td><?php echo $s->nama_barang; ?></td>
								<td><?php echo $s->nama_kategori; ?></td>
								<td>Rp.<?php echo number_format($s->harga); ?></td>
								<td>
									<?php echo $s->stok_barang; ?>
								</td>
								<td>
									<?php echo $s->stok_barang; ?>
								</td>
								<td><?php echo $s->tanggal_stok; ?></td>
								<td><?php
										echo anchor(site_url('stok/edit/' . $s->id_stok), '<i class="fa fa-pencil-square-o fa-lg"></i>&nbsp;&nbsp;Edit', array('title' => 'edit', 'class' => 'btn btn-sm btn-warning'));
										echo '&nbsp';
										echo anchor(site_url('stok/hapus/' . $s->id_stok), '<i class="fa fa-trash fa-lg"></i>&nbsp;&nbsp;Hapus', 'title="delete" class="btn btn-sm btn-danger "');
										?>
								</td>
							</tr>
							<?php }	?>
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
		$('#myTable').DataTable({
			dom: 'Blfrtip',
			"columnDefs": [{
				targets: 5,
				render: $.fn.dataTable.render.percentBar('round', '#fff', '#FF9CAB', '#FF0033', '#FF9CAB', 0, 'solid')
			}],
			buttons: [{
					extend: 'csvHtml5',
					exportOptions: {
						columns: [0, 1, 2, 3, 4, 6],
					},
				},
				{
					extend: 'excelHtml5',
					title: 'Data Stok Barang',
					exportOptions: {
						columns: [0, 1, 2, 3, 4, 6],
					},
				},
				{
					extend: 'copyHtml5',
					title: 'Data Stok Barang',
					exportOptions: {
						columns: [0, 1, 2, 3, 4, 6],
					},
				},
				{
					extend: 'pdfHtml5',
					oriented: 'portrait',
					pageSize: 'legal',
					title: 'Data Stok Barang',
					download: 'open',
					exportOptions: {
						columns: [0, 1, 2, 3, 4, 6],
					},
					customize: function(doc) {
						doc.content[1].table.widths = Array(doc.content[1].table.body[0].length + 1).join('*').split('');
						doc.styles.tableBodyEven.alignment = 'center';
						doc.styles.tableBodyOdd.alignment = 'center';
					},
				},
				{
					extend: 'print',
					oriented: 'portrait',
					pageSize: 'A4',
					title: 'Data Stok Barang',
					exportOptions: {
						columns: [0, 1, 2, 3, 4, 6],
					},
				},
			],
		});
	});
</script>