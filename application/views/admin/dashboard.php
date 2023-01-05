<div class="row">
	<div class="col-sm-4">
		<div class="card">
			<div class="card-body">
				<h3 id="asap"> <?= ($data) ? $data->nilai : '0'; ?></h3>

				<p>Nilai Asap</p>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-sm-12">
		<div class="card mt-3">
			<div class="card-body">
				<div id="grafik"></div>
			</div>
		</div>
	</div>
</div>

<script src="<?php echo base_url() ?>assets/highcharts/highcharts.js"></script>
<script src="<?php echo base_url() ?>assets/highcharts/exporting.js"></script>
<script src="<?php echo base_url() ?>assets/highcharts/export-data.js"></script>
<script src="<?php echo base_url() ?>assets/highcharts/accessibility.js"></script>

<script>
	var chart;
	var total = 0,
		waktu = [];

	function tampil_grafik() {
		$.ajax({
			url: '<?php echo base_url('admin/get_realtime') ?>',
			dataType: 'json',
			success: function(result) {
				if (result.count > total) {

					total = result.count;
					var data_akhir = result.data;
					var nilai = Number(data_akhir.nilai);

					var konfersi = new Date(Date.parse(data_akhir.waktu));
					var waktu2 = konfersi.getHours() + ":" + konfersi.getMinutes() + ":" + konfersi
						.getSeconds();
					waktu.push(waktu2);

					chart.series[0].addPoint([data_akhir.waktu, nilai], true, false);
					chart.xAxis[0].setCategories(waktu);
				}

				setTimeout(tampil_grafik, 2000);
			}
		});
	}

	function tampil() {
		$.ajax({
			url: "<?= base_url('admin/get_realtime') ?>",
			dataType: 'json',
			success: function(result) {
				$('#asap').text(result.data.nilai);

				setTimeout(tampil, 2000);
			}
		});
	}

	document.addEventListener('DOMContentLoaded', function() {

		chart = Highcharts.chart('grafik', {
			chart: {
				events: {
					load: tampil_grafik
				}
			},
			title: {
				text: 'Grafik Monitoring Asap'
			},
			xAxis: {
				title: {
					text: 'Waktu'
				},
				type: 'datetime'
			},
			yAxis: {
				title: {
					text: 'Nilai'
				}
			},
			series: [{
				name: "Nilai Asap",
				data: []
			}]
		});

		tampil();
	});
</script>