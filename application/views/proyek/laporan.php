<!-- Page Header -->
<div class="docs-page-header mt-5">
	<div class="row align-items-center">
		<div class="col-sm">
			<h1 class="docs-page-header-title">Laporan Proyek - <?= $nama_proyek;?>
				<?php if($this->input->get('periode')):?>
				<span class="text-body pb-3 me-3"> - periode <span
						class="text-primary"><?= $this->input->get('periode');?></span></span>
				<?php endif;?>
			</h1>
			<p class="docs-page-header-text">Pantau progres dari semua proyek
			</p>
		</div>
	</div>
</div>
<form action="<?= site_url('proyek/laporan');?>" method="get">
	<div class="row mb-4 d-flex align-items-center">
		<div class="col-1">
			Filter: 
		</div>
		<div class="col-3">
			<div class="input-group input-group-sm">
				<span class="input-group-text" id="basic-addon2"><i class="bi bi-calendar-week"></i></span>
				<input type="text" class="form-control form-control-sm" name="periode" placeholder="Periode proyek"
					aria-describedby="basic-addon2" required>
			</div>
		</div>
		<div class="col-3">
			<!-- Select -->
			<div class="tom-select-custom tom-select-custom-sm">
				<select class="js-select form-select form-select-sm" name="proyek" autocomplete="off"
					data-hs-tom-select-options='{"placeholder": "Pilih proyek"}'>
					<option value="0" selected>Semua Proyek</option>
					<?php if(!empty($proyek)):?>
					<?php foreach($proyek as $key => $val):?>
					<option value="<?= $val->id;?>"><?= $val->judul;?></option>
					<?php endforeach;?>
					<?php endif;?>
				</select>
			</div>
			<!-- End Select -->
		</div>
		<div class="col-5 d-flex justify-content-end">
			<button type="submit" class="btn btn-primary btn-sm ms-3">Tampilkan</button>
			<?php if($this->input->get('periode')):?>
			<a href="<?= current_url();?>" class="btn btn-sm btn-outline-secondary ms-2">Reset</a>
			<?php endif;?>
			<a href="<?= site_url('cetak/kpi/'.$this->input->get('proyek'));?>" class="btn btn-warning btn-sm ms-3"
				target="_blank"><i class="bi bi-printer"></i> Cetak</a>
			<a href="<?= site_url('excel/ekspor-kpi/'.$this->input->get('proyek'));?>"
				class="btn btn-success btn-sm ms-3" target="_blank"><i class="bi bi-file-spreadsheet"></i> Ekspor</a>
		</div>
	</div>
</form>

<div class="row">
	<div class="col-6 mb-4">
		<div class="card">
			<div class="card-header p-3 text-center">
				<h4 class="card-header-title">Status deadline semua proyek</h4>
			</div>
			<div class="card-body p-3">
				<div id="chartPieChartProyekMain"></div>
			</div>
		</div>
	</div>
	<div class="col-6 mb-4">
		<div class="card">
			<div class="card-header p-3 text-center">
				<h4 class="card-header-title">Status pengerjaan task</h4>
			</div>
			<div class="card-body p-3">
				<div id="chartPieChartProyekTask"></div>
			</div>
		</div>
	</div>
	<div class="col-4 mb-4">
		<div class="card">
			<div class="card-header p-3">
				<h4 class="card-header-title">Target deadline pengerjaan staff</h4>
			</div>
			<div class="card-body p-3">
				<table
					class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table dataTables-nosearch w-100"
					id="table-chart-kpi">
					<thead class="thead-light">
						<tr>
							<th>Staff</th>
							<th>On Deadline</th>
							<th>Over Deadline</th>
						</tr>
					</thead>

					<tbody>
						<?php if(!empty($tabel_target)):?>
						<?php $no=1;foreach($tabel_target as $key => $val):?>
						<tr>
							<td>
								<b><?= $val['nama'];?></b><br>
							</td>
							<td class="text-center">
								<?= $val['dateOnDeadline'];?>
							</td>
							<td class="text-center">
								<?= $val['dateOverDeadline'];?>
							</td>
						</tr>
						<?php endforeach;?>
						<?php endif;?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="col-8 mb-4">
		<div class="card">
			<div class="card-header p-3">
				<h4 class="card-header-title">Target deadline pengerjaan staff (grafik)</h4>
			</div>
			<div class="card-body p-3">
				<div id="chartTarget"></div>
			</div>
		</div>
	</div>
	<div class="col-12 mb-4">
		<div class="card">
			<div class="card-header p-3 text-center">
				<h4 class="card-header-title">Status pengerjaan task setiap staff (grafik)</h4>
			</div>
			<div class="card-body p-3">
				<div id="chartTargetMain"></div>
			</div>
		</div>
	</div>
	<div class="col-12 mb-4">
		<div class="card">
			<div class="card-header p-3 text-center">
				<h4 class="card-header-title">Status pengerjaan task setiap staff</h4>
			</div>
			<div class="card-body p-3">
				<table
					class="table table-borderless table-hover table-thead-bordered table-nowrap table-align-middle card-table dataTables-button w-100"
					id="table-chart-status-pengerjaan" style="width:100%">
					<thead class="thead-light">
						<tr>
							<th>Staff</th>
							<?php if(!empty($proyek_status)):?>
							<?php foreach($proyek_status as $key => $val):?>
							<th><?= $val->status;?></th>
							<?php endforeach;?>
							<?php endif;?>
						</tr>
					</thead>

					<tbody>
						<?php if(!empty($tabel_main)):?>
						<?php $no=1;foreach($tabel_main as $key => $val):?>
						<tr>
							<td>
								<b><?= $val['nama'];?></b><br>
							</td>
							<?php if(!empty($val['status'])):?>
							<?php foreach($val['status'] as $k => $v):?>
							<td class="text-center">
								<?= $v['total'];?>
							</td>
							<?php endforeach;?>
							<?php endif;?>
						</tr>
						<?php endforeach;?>
						<?php endif;?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>


<script>
	// main proyek pie chart
	var optionsPieChartProyekMain = {
		series: [<?= implode(',', $proyekdata->data) ?>],
		chart: {
			width: 380,
			type: 'pie',
		},
		labels: [<?= implode(',', $proyekdata->categories) ?>],
		responsive: [{
			breakpoint: 480,
			options: {
				chart: {
					width: 200
				},
				legend: {
					position: 'bottom'
				}
			}
		}]
	};

	var chartPieChartProyekMain = new ApexCharts(document.querySelector("#chartPieChartProyekMain"), optionsPieChartProyekMain);
	chartPieChartProyekMain.render();
</script>
<?php if($this->input->get('proyek')):?>
<script>
	// task proyek pie chart
	var optionsPieChartProyekTask = {
		series: [<?= implode(',', $tasks->data) ?>],
		chart: {
			width: 380,
			type: 'pie',
		},
		labels: [<?= implode(',', $tasks->categories) ?>],
		responsive: [{
			breakpoint: 480,
			options: {
				chart: {
					width: 200
				},
				legend: {
					position: 'bottom'
				}
			}
		}]
	};

	var chartPieChartProyekTask = new ApexCharts(document.querySelector("#chartPieChartProyekTask"), optionsPieChartProyekTask);
	chartPieChartProyekTask.render();

	// target bar chart
	var optionsChartTarget = {
		series: [{
			name: 'On Deadline',
			data: [<?= implode(',', $staff_target->dateOnDeadline) ?>]
		}, {
			name: 'Over Deadline',
			data: [<?= implode(',', $staff_target->dateOverDeadline) ?>]
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
			categories: [<?= implode(',', $staff_target->categories) ?>],
		},
		yaxis: {
			title: {
				text: ' (tasks)'
			}
		},
		fill: {
			opacity: 1
		},
		tooltip: {
			y: {
				formatter: function (val) {
					return val + " tasks"
				}
			}
		}
	};

	var chartTarget = new ApexCharts(document.querySelector("#chartTarget"), optionsChartTarget);
	chartTarget.render();

	// main bar chart
	var chartTargetMain = <?= json_encode($staff_main['series']); ?> ;
	var optionsChartTargetMain = {
		series: chartTargetMain,
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
			categories: [ <?= implode(',', $staff_main['categories']) ?> ],
		},
		yaxis: {
			title: {
				text: '(task)'
			}
		},
		fill: {
			opacity: 1
		},
		tooltip: {
			y: {
				formatter: function (val) {
					return val + " task"
				}
			}
		}
	};

	var chartTargetMain = new ApexCharts(document.querySelector("#chartTargetMain"), optionsChartTargetMain);
	chartTargetMain.render();

	// add class
</script>
<?php endif;?>