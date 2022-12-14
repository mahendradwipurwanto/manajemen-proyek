<!-- Page Header -->
<div class="docs-page-header mt-5">
	<div class="row align-items-center">
		<div class="col-sm">
			<h1 class="docs-page-header-title d-flex justify-content-between">Laporan Proyek - <?= $nama_proyek;?>
				<form action="<?= site_url('staff/laporan');?>" method="get" class="d-flex">
					<!-- Select -->
					<div class="tom-select-custom tom-select-custom-sm">
						<select class="js-select form-select form-select-sm" name="proyek" autocomplete="off"
							data-hs-tom-select-options='{"placeholder": "Pilih proyek"}'>
							<?php if(!empty($proyek)):?>
							<?php foreach($proyek as $key => $val):?>
							<option value="<?= $val->id;?>"><?= $val->judul;?></option>
							<?php endforeach;?>
							<?php endif;?>
						</select>
					</div>
					<!-- End Select -->
					<button type="submit" class="btn btn-primary btn-sm ms-3">Tampilkan</button>
					<?php if($this->input->get('proyek')):?>
					<a href="<?= site_url('cetak/laporan/'.$this->input->get('proyek'));?>"
						class="btn btn-warning btn-sm ms-3" target="_blank"><i class="bi bi-printer"></i> Cetak</a>
					<?php endif;?>
				</form>
			</h1>
			<p class="docs-page-header-text">Pantau progres dari semua proyek yang <?php if($leader == true):?>tim anda<?php else:?>anda<?php endif;?> kerjakan
			</p>
		</div>
	</div>
</div>
<?php if($nama_proyek == "Harap pilih proyek"):?>
<div class="card card-body text-center d-flex align-items-center">
	<img src="<?= base_url();?>assets/svg/illustrations/sorry.svg" alt="" class="mb-3" style="width: 15rem;">
	<p>Harap pilih proyek</p>
</div>
<?php else:?>
<div class="row">
	<div class="col-6 mb-4">
		<div class="card">
			<div class="card-header p-3 text-center">
				<h4 class="card-header-title">Status deadline semua proyek <?php if($leader == true):?>tim anda<?php else:?>anda<?php endif;?></h4>
			</div>
			<div class="card-body p-3">
				<div id="chartPieChartProyekMain"></div>
			</div>
		</div>
	</div>
	<div class="col-6 mb-4">
		<div class="card">
			<div class="card-header p-3 text-center">
				<h4 class="card-header-title">Status pengerjaan task <?php if($leader == true):?>tim anda<?php else:?>anda<?php endif;?></h4>
			</div>
			<div class="card-body p-3">
				<div id="chartPieChartProyekTask"></div>
			</div>
		</div>
	</div>
	<div class="col-4 mb-4">
		<div class="card">
			<div class="card-header p-3">
				<h4 class="card-header-title">Target deadline pengerjaan <?php if($leader == true):?>tim anda<?php else:?>anda<?php endif;?></h4>
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
				<h4 class="card-header-title">Target deadline pengerjaan <?php if($leader == true):?>tim anda<?php else:?>anda<?php endif;?> (grafik)</h4>
			</div>
			<div class="card-body p-3">
				<div id="chartTarget"></div>
			</div>
		</div>
	</div>
	<div class="col-12 mb-4">
		<div class="card">
			<div class="card-header p-3 text-center">
				<h4 class="card-header-title">Status pengerjaan task <?php if($leader == true):?>tim anda<?php else:?>anda<?php endif;?> (grafik)</h4>
			</div>
			<div class="card-body p-3">
				<div id="chartTargetMain"></div>
			</div>
		</div>
	</div>
	<div class="col-12 mb-4">
		<div class="card">
			<div class="card-header p-3 text-center">
				<h4 class="card-header-title">Status pengerjaan task <?php if($leader == true):?>tim anda<?php else:?>anda<?php endif;?></h4>
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
<?php endif;?>

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