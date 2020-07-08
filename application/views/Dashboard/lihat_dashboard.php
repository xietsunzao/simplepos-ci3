<style>
	#chartdiv {
		width: 100%;
		height: 300px;
	}

	#chartdiv2 {
		width: 100%;
		height: 250px;
	}

	#chartdiv3 {
		width: 100%;
		height: 250px;
	}

	.widget-user .widget-user-image>img {
		width: 90px;
		height: auto;
		border: none;
	}
</style>
<section class="content">
	<?php if ($this->session->userdata('akses') == 1) : ?>
	<div class="row">
		<?php foreach ($box as $info_box) : ?>
		<div class="col-lg-3 col-xs-6">
			<div class="small-box bg-<?= $info_box->box ?>">
				<div class="inner">
					<h3 class="count"><?= $info_box->total; ?></h3>
					<p><?= $info_box->title; ?></p>
				</div>
				<div class="icon">
					<i class="fa fa-<?= $info_box->icon ?>"></i>
				</div>
				<a href="<?= base_url() . strtolower($info_box->link); ?>" class="small-box-footer">
					More info
					<i class="fa fa-arrow-circle-right"></i>
				</a>
			</div>
		</div>
		<?php endforeach; ?>
	</div>
	<div class="row">
		<div class="col-md-6">
			<div class="box box-default">
				<div class="box-header with-border">
					<h3 class="box-title">Total Barang Berdasarkan Kategori</h3>
					<div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
					</div>
				</div>
				<div class="box-body">
					<div id="chartdiv2"></div>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="box box-default">
				<div class="box-header with-border">
					<h3 class="box-title">Top 5 Barang Terjual Bulan Ini</h3>
					<div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
					</div>
				</div>
				<div class="box-body">
					<div id="chartdiv3"></div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="box box-default">
				<div class="box-header with-border">
					<h3 class="box-title">Grafik Total Stok Barang</h3>
					<div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
					</div>
				</div>
				<div class="box-body">
					<div id="chartdiv"></div>
				</div>
			</div>
		</div>
	</div>
	<?php else : ?>
	<div class="row">
		<div class="col-md-12">
			<div class="box box-widget widget-user">
				<div class="widget-user-header bg-green-active">
					<p style="text-align: center;">
						<span style="font-family: georgia, palatino; font-size: 15pt;">Selamat datang di BilBilWest</span>
					</p>
					<h3 class="widget-user-username"></h3>
					<h5 class="widget-user-desc"></h5>
				</div>
				<div class="widget-user-image">
					<img class="img-circle" src="<?php echo base_url(); ?>assets/dist/img/bilbil.png">
				</div>
				<div class="box-footer">
					<div class="row">
						<div class="col-sm-4 border-right">
							<div class="description-block">
							</div>
						</div>
						<div class="col-sm-4 border-right">
							<div class="description-block">
								<h5 class="description-header">Kantor: Kp. Saneke No.49 RT.03 RW.10,Kec.Kutawaringin, Kab.Bandung</h5>
								<span class="description-text">No.Telp:081809412834, 081321486655</span>
							</div>
							<center>
								<i>Sistem Stok dan Penjualan Barang</i><br>
							</center>
						</div>
						<div class="col-sm-3">
							<div class="description-block">
								<h5 class="description-header"></h5>
								<span class="description-text"></span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php endif; ?>
</section>
<!-- Styles -->


<!-- Resources -->
<script src="<?php echo base_url() ?>assets/plugins/amchart4/core.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/amchart4/charts.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/amchart4/themes/dataviz.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/amchart4/themes/material.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/amchart4/themes/animated.js"></script>

<!-- Chart code -->
<script>
	am4core.ready(function() {
		let url = '<?= base_url() ?>';
		// Themes begin
		am4core.useTheme(am4themes_dataviz);
		am4core.useTheme(am4themes_animated);
		am4core.options.minPolylineStep = 5;
		am4core.options.queue = true;
		am4core.options.onlyShowOnViewport = true;

		// Themes end

		// Create chart instance
		var chart = am4core.create("chartdiv", am4charts.XYChart);

		// Add data
		chart.data = [

			<?php foreach ($graph as $row) : ?> {
				"barang": "<?php echo $row->nama_barang; ?>",
				"total": <?php echo $row->total; ?>
			},
			<?php endforeach; ?>
		];

		// Create axes

		var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
		categoryAxis.dataFields.category = "barang";
		categoryAxis.renderer.grid.template.location = 0;
		categoryAxis.renderer.minGridDistance = 30;

		categoryAxis.renderer.labels.template.adapter.add("dy", function(dy, target) {
			if (target.dataItem && target.dataItem.index & 2 == 2) {
				return dy + 25;
			}
			return dy;
		});

		var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
		// Create series
		var series = chart.series.push(new am4charts.ColumnSeries());
		series.dataFields.valueY = "total";
		series.dataFields.categoryX = "barang";
		series.name = "total";
		series.columns.template.tooltipText = "{categoryX}: [bold]{valueY}[/]";
		series.columns.template.fillOpacity = .8;
		series.minBulletDistance = 20;

		var columnTemplate = series.columns.template;
		columnTemplate.strokeWidth = 2;
		columnTemplate.strokeOpacity = 1;



		// Create chart instance
		var chart = am4core.create("chartdiv2", am4charts.PieChart);

		// Add data
		chart.data = [
			<?php foreach ($kategori as $row) : ?> {
				"barang": "<?php echo $row->nama_barang ?>",
				"total": <?php echo $row->total ?>,
				"color": getRandomColor(),
			},
			<?php endforeach; ?>
		];
		// Add and configure Series
		var pieSeries = chart.series.push(new am4charts.PieSeries());
		pieSeries.dataFields.value = "total";
		pieSeries.dataFields.category = "barang";
		pieSeries.hiddenState.properties.endAngle = -90;
		pieSeries.ticks.template.disabled = true;
		pieSeries.alignLabels = false;
		pieSeries.labels.template.text = "{value.percent.formatNumber('#.0')}%";
		pieSeries.labels.template.radius = am4core.percent(-40);
		pieSeries.labels.template.fill = am4core.color("white");
		pieSeries.labels.template.relativeRotation = 90;
		chart.responsive.useDefault = false
		chart.responsive.enabled = true;

		chart.color = [
			<?php foreach ($kategori as $row) : ?>
			getRandomColor(),
			<?php endforeach; ?>
		];

		var colorSet = new am4core.ColorSet();
		colorSet.list = chart.color.map(function(color) {
			return new am4core.color(color);
		});
		pieSeries.colors = colorSet;

		function getRandomColor() {
			var letters = '0123456789ABCDEF';
			var color = '#';
			for (var i = 0; i < 6; i++) {
				color += letters[Math.floor(Math.random() * 16)];
			}
			return color;
		}

		chart.responsive.useDefault = false
		chart.responsive.enabled = true;
		chart.responsive.rules.push({
			relevant: function(target) {
				return false;
			},
			state: function(target, stateId) {
				return;
			}
		});


		var chart = am4core.create("chartdiv3", am4charts.XYChart);
		chart.hiddenState.properties.opacity = 0; // this creates initial fade-in

		chart.paddingRight = 30;


		chart.data = [
			<?php foreach ($laris as $row) : ?> {
				"barang": "<?php echo $row->nama_barang; ?>",
				"total": <?php echo $row->total; ?>,
				"href": url + "uploads/<?php echo $row->foto; ?>"
			},
			<?php endforeach; ?>
		];

		var categoryAxis = chart.yAxes.push(new am4charts.CategoryAxis());
		categoryAxis.dataFields.category = "barang";
		categoryAxis.renderer.grid.template.strokeOpacity = 0;
		categoryAxis.renderer.minGridDistance = 10;
		categoryAxis.renderer.labels.template.dx = -40;
		categoryAxis.renderer.minWidth = 120;
		categoryAxis.renderer.tooltip.dx = -40;

		var valueAxis = chart.xAxes.push(new am4charts.ValueAxis());
		valueAxis.renderer.inside = true;
		valueAxis.renderer.labels.template.fillOpacity = 0.3;
		valueAxis.renderer.grid.template.strokeOpacity = 0;
		valueAxis.min = 0;
		valueAxis.cursorTooltipEnabled = false;
		valueAxis.renderer.baseGrid.strokeOpacity = 0;
		valueAxis.renderer.labels.template.dy = 20;

		var series = chart.series.push(new am4charts.ColumnSeries);
		series.dataFields.valueX = "total";
		series.dataFields.categoryY = "barang";
		series.tooltipText = "{valueX.value}";
		series.tooltip.pointerOrientation = "vertical";
		series.tooltip.dy = -30;
		series.columnsContainer.zIndex = 100;
		series.minBulletDistance = 20;


		var columnTemplate = series.columns.template;
		columnTemplate.height = am4core.percent(50);
		columnTemplate.maxHeight = 30;
		columnTemplate.column.cornerRadius(60, 10, 60, 10);
		columnTemplate.strokeOpacity = 0;

		series.heatRules.push({
			target: columnTemplate,
			property: "fill",
			dataField: "valueX",
			min: am4core.color("#e5dc36"),
			max: am4core.color("#5faa46")
		});
		series.mainContainer.mask = undefined;

		var cursor = new am4charts.XYCursor();
		chart.cursor = cursor;
		cursor.lineX.disabled = true;
		cursor.lineY.disabled = true;
		cursor.behavior = "none";

		var bullet = columnTemplate.createChild(am4charts.CircleBullet);
		bullet.circle.radius = 10;
		bullet.valign = "middle";
		bullet.align = "left";
		bullet.isMeasured = true;
		bullet.interactionsEnabled = false;
		bullet.horizontalCenter = "right";
		bullet.interactionsEnabled = false;

		var hoverState = bullet.states.create("hover");
		var outlineCircle = bullet.createChild(am4core.Circle);
		outlineCircle.adapter.add("radius", function(radius, target) {
			var circleBullet = target.parent;
			return circleBullet.circle.pixelRadius + 10;
		})

		var image = bullet.createChild(am4core.Image);
		image.width = 30;
		image.height = 30;
		image.horizontalCenter = "middle";
		image.verticalCenter = "middle";
		image.propertyFields.href = "href";
		image.adapter.add("mask", function(mask, target) {
			var circleBullet = target.parent;
			return circleBullet.circle;
		})
		var previousBullet;
		chart.cursor.events.on("cursorpositionchanged", function(event) {
			var dataItem = series.tooltipDataItem;
			if (dataItem.column) {
				var bullet = dataItem.column.children.getIndex(1);
				if (previousBullet && previousBullet != bullet) {
					previousBullet.isHover = false;
				}
				if (previousBullet != bullet) {
					var hs = bullet.states.getKey("hover");
					hs.properties.dx = dataItem.column.pixelWidth;
					bullet.isHover = true;
					previousBullet = bullet;
				}
			}
		})

	}); // end am4core.ready()
</script>

<!-- HTML -->