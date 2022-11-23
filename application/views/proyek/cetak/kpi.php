<style>
	@media print {
		body {
			zoom: 80%;
		}
	}

</style>

<!-- Page Header -->
<div class="docs-page-header">
	<div class="row align-items-center">
		<div class="col-sm">
			<h1 class="docs-page-header-title d-flex justify-content-between">Cetak KPI - <?= $nama_proyek;?>
			</h1>
		</div>
	</div>
</div>

<div class="row mb-4">
	<div class="col-md-12">
		<div class="card">
			<!-- Table -->
			<div class="card-body p-4">
				<table class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
					<thead class="thead-light">
						<tr>
							<th rowspan="2" width="5%">No</th>
							<th rowspan="2">Staff</th>
							<th colspan="4" class="text-center">Proyek</th>
							<!-- <th rowspan="2">Nilai</th> -->
							<!-- <th rowspan="2">Presentase</th> -->
						</tr>
						<tr>
							<th class="text-center">Total Proyek</th>
							<th class="text-center">Total Task</th>
							<th class="text-center">Ditolak/Proses</th>
							<th class="text-center">Selesai</th>
						</tr>
					</thead>

					<tbody>
						<?php if(!empty($kpi)):?>
						<?php $no=1;foreach($kpi as $key => $val):?>
						<tr>
							<td><?= $no++;?>.</td>
							<td>
								<b><?= $val->nama;?></b><br>
								<small><i class="bi bi-briefcase me-2"></i>
									<?= isset($val->jabatan) ? $val->jabatan : '-';?></small>
							</td>
							<td class="text-center">
								<span class="cursor" data-bs-toggle="modal"
									data-bs-target="#proyek-<?= $val->user_id;?>"><span data-bs-toggle="tooltip"
										data-bs-html="true"
										title="Lihat daftar proyek"><?= $val->totalProyek;?></span></span>
							</td>
							<td class="text-center">
								<span class="cursor" data-bs-toggle="modal"
									data-bs-target="#task-<?= $val->user_id;?>"><span data-bs-toggle="tooltip"
										data-bs-html="true"
										title="Lihat daftar task"><?= $val->totalTask;?></span></span>
							</td>
							<td class="text-center">
								<span class="cursor" data-bs-toggle="modal"
									data-bs-target="#taskProses-<?= $val->user_id;?>"><span data-bs-toggle="tooltip"
										data-bs-html="true"
										title="Lihat daftar task Proses"><?= $val->taskProses;?></span></span>
							</td>
							<td class="text-center">
								<span class="cursor" data-bs-toggle="modal"
									data-bs-target="#taskSelesai-<?= $val->user_id;?>"><span data-bs-toggle="tooltip"
										data-bs-html="true"
										title="Lihat daftar task selesai"><?= $val->taskSelesai;?></span></span>
							</td>
							<!-- <td class="text-center">
								<?= $val->nilai;?>
							</td> -->
							<!-- <td class="text-center">
								<span class="badge bg-soft-<?= $val->color_badge;?>"><?= $val->persentase;?>%</span>
							</td> -->
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

<div class="row d-none">
	<div class="col-md-4">
		<div class="card">
			<!-- Table -->
			<div class="card-body p-4">
				<table
					class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table dataTables-nosearch w-100">
					<thead class="thead-light">
						<tr>
							<th>Staff</th>
							<th>Presentase</th>
						</tr>
					</thead>

					<tbody>
						<?php if(!empty($kpi)):?>
						<?php $no=1;foreach($kpi as $key => $val):?>
						<tr>
							<td>
								<b><?= $val->nama;?></b><br>
								<small><i class="bi bi-briefcase me-2"></i>
									<?= isset($val->jabatan) ? $val->jabatan : '-';?></small>
							</td>
							<td class="text-center">
								<span class="badge bg-soft-<?= $val->color_badge;?>"><?= $val->persentase;?>%</span>
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
	<div class="col-md-8">
		<div class="card">
			<div class="card-body">
				<div id="chart-kpi"></div>
			</div>
		</div>
	</div>
</div>


<script>
	var dataKpi = [ <?= implode(',', $chart_kpi['data']) ?> ];
	var categoriesKpi = [ <?= implode(',', $chart_kpi['kategori']) ?> ];

	var optionsChartKpi = {
		animations: {
			enabled: false
		},
		series: [{
			data: dataKpi
		}],
		chart: {
			type: 'bar',
			height: 430
		},
		plotOptions: {
			bar: {
				horizontal: true,
			}
		},
		dataLabels: {
			enabled: true,
			offsetX: -6,
			style: {
				fontSize: '12px',
				colors: ['#fff']
			}
		},
		xaxis: {
			categories: categoriesKpi,
		}
	};

	var chartKPI = new ApexCharts(document.querySelector("#chart-kpi"), optionsChartKpi);
	chartKPI.render();

	$(document).ready(function () {
		setTimeout(function () {
			window.print();
		}, 2000);
	})

</script>
