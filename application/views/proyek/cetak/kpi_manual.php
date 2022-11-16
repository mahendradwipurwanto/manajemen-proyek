<!-- Page Header -->
<style>
	@media print {
		body {
			zoom: 80%;
		}
	}

</style>
<div class="docs-page-header">
	<div class="row align-items-center">
		<div class="col-sm">
			<h1 class="docs-page-header-title">CETAK KPI STAFF
				<?php if($this->input->get('periode')):?>
				<span class="text-body pb-3 me-3"> - periode <span
						class="text-primary"><?= $this->input->get('periode');?></span></span>
				<?php endif;?>
			</h1>
			<p class="docs-page-header-text">Pantau kinerja staff pada semua proyek</p>
		</div>
	</div>
</div>
<div class="row mb-4">
	<div class="col-md-12">
		<div class="card">
			<!-- Table -->
			<div class="card-body p-4">
				<table class="table table-thead-bordered table-nowrap table-align-middle card-table"
					id="table-kpi">
					<thead class="thead-light">
						<tr>
							<th width="5%">No</th>
							<th width="25%">Staff</th>
							<th width="25%">Proyek</th>
							<th width="25%" class="text-center">Nilai</th>
						</tr>
					</thead>

					<tbody>
						<?php if(!empty($kpi)):?>
						<?php $no=1;foreach($kpi as $key => $val):?>
						<tr>
							<td class="text-center"><?= $no++;?>.</td>
							<td>
								<b><?= $val->nama;?></b>
							</td>
							<td>
								<?= $val->judul;?>
							</td>
							<td class="text-center">
								<?= $val->nilai;?>
							</td>
						</tr>
						<?php endforeach;?>
						<?php endif;?>
					</tbody>
				</table>
			</div>
			<!-- End Table -->
		</div>
	</div>
</div>

<?php if(!empty($chart_kpi)):?>
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-body">
				<div id="chartTarget"></div>
			</div>
		</div>
	</div>
</div>

<script>

	// target bar chart
	var optionsChartTarget = {
		series: [{
            name: 'Nilai',
			data: [<?= implode(',', $chart_kpi['data']) ?>]
        }],
		chart: {
			type: 'bar',
			height: 350
		},
		plotOptions: {
			bar: {
				horizontal: false,
				columnWidth: '55%',
				endingShape: 'rounded'
			},
		},
		dataLabels: {
			enabled: false
		},
		stroke: {
			show: true,
			width: 2,
			colors: ['transparent']
		},
		xaxis: {
			categories: [<?= implode(',', $chart_kpi['kategori']) ?>],
		},
		yaxis: {
			title: {
				text: ' (nilai)'
			}
		},
		fill: {
			opacity: 1
		},
		tooltip: {
			y: {
				formatter: function (val) {
					return val + " nilai"
				}
			}
		}
	};

	var chartTarget = new ApexCharts(document.querySelector("#chartTarget"), optionsChartTarget);
	chartTarget.render();

	$(document).ready(function () {
		setTimeout(function () {
			window.print();
		}, 2000);
	})
</script>
<?php endif;?>