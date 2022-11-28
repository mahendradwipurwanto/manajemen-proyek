<!-- Page Header -->
<div class="docs-page-header">
	<div class="row align-items-center">
		<div class="col-sm">
			<h1 class="docs-page-header-title">KPI - <?= $nama_proyek;?>
				<?php if($this->input->get('periode')):?>
				<span class="text-body pb-3 me-3"> - periode <span
						class="text-primary"><?= $this->input->get('periode');?></span></span>
				<?php endif;?>
				<!-- Nav -->
				<div class="float-end">
					<ul class="nav nav-segment mb-7" role="tablist">
						<li class="nav-item">
							<a class="nav-link active" id="nav-one-eg1-tab" href="#nav-one-eg1" data-bs-toggle="tab"
								data-bs-target="#nav-one-eg1" role="tab" aria-controls="nav-one-eg1"
								aria-selected="true">KPI</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="nav-two-eg1-tab" href="#nav-two-eg1" onclick="showTabless()" data-bs-toggle="tab"
								data-bs-target="#nav-two-eg1" role="tab" aria-controls="nav-two-eg1" aria-selected="false">KPI
								(system)</a>
						</li>
					</ul>
				</div>
				<!-- End Nav -->
			</h1>
			<p class="docs-page-header-text">Pantau kinerja staff pada semua proyek</p>
		</div>
	</div>
</div>
<div class="row mb-4">
	<div class="col-md-12">
		<div class="tab-content">

			<div class="tab-pane fade show active" id="nav-one-eg1" role="tabpanel" aria-labelledby="nav-two-eg1-tab">
				<form action="<?= site_url('proyek/kpi-staff');?>" method="get">
					<div class="row mb-4 d-flex align-items-center">
						<div class="col-1">
							Filter:
						</div>
						<div class="col-3 d-none">
							<div class="input-group input-group-sm">
								<span class="input-group-text" id="basic-addon2"><i
										class="bi bi-calendar-week"></i></span>
								<input type="text" class="form-control form-control-sm" name="periode"
									placeholder="Periode proyek" aria-describedby="basic-addon2">
							</div>
						</div>
						<div class="col-3">
							<!-- Select -->
							<div class="tom-select-custom tom-select-custom-sm">
								<select class="js-select form-select form-select-sm" name="staff" autocomplete="off"
									data-hs-tom-select-options='{"placeholder": "Pilih staff"}'>
									<?php if($this->input->get('staff')):?>
									<option value="0">Semua staff</option>
									<option value="<?= $this->input->get('staff');?>" selected><?= $nama_staff;?>
									</option>
									<?php else:?>
									<option value="0" selected>Semua staff</option>
									<?php endif;?>
									<?php if(!empty($staff)):?>
									<?php foreach($staff as $key => $val):?>
									<option value="<?= $val->user_id;?>"><?= $val->nama;?></option>
									<?php endforeach;?>
									<?php endif;?>
								</select>
							</div>
							<!-- End Select -->
						</div>
						<div class="col-8 d-flex justify-content-end">
							<button type="submit" class="btn btn-primary btn-sm ms-3">Tampilkan</button>
							<?php if($this->input->get('periode')):?>
							<a href="<?= current_url();?>" class="btn btn-sm btn-outline-secondary ms-2">Reset</a>
							<?php endif;?>
							<a href="<?= site_url('cetak/kpi-staff/'.$this->input->get('proyek'));?>"
								class="btn btn-warning btn-sm ms-3" target="_blank"><i class="bi bi-printer"></i>
								Cetak</a>
						</div>
					</div>
				</form>
				<?php if(empty($kpi_manual)):?>
				<div class="alert bg-soft-warning py-1">
					Sepertinya staff ini belum memiliki data KPI, harap selesaikan dan beri nilai pada staff ini di
					proyek yang
					diikuti oleh staff ini
				</div>
				<?php else:?>
				<div class="alert bg-soft-primary py-1">
					<small>KPI (Key Index Performance) Staff ini mengacu pada penilaian yang diberikan oleh atasan pada
						staff
						saat <b>menutup/menyelesaikan salah satu proyek</b>.</small>
				</div>
				<?php endif;?>
				<div class="card">
					<!-- Table -->
					<div class="card-body p-4">
						<table class="table table-thead-bordered table-nowrap table-align-middle card-table w-100"
							id="table-kpi2">
							<thead class="thead-light">
								<tr>
									<th width="5%">No</th>
									<th width="25%">Staff</th>
									<th width="25%">Proyek</th>
									<th width="20%" class="text-center">Nilai</th>
									<th width="25%" class="text-center">Keterangan</th>
								</tr>
							</thead>

							<tbody>
								<?php if(!empty($kpi_manual)):?>
								<?php $no=1;foreach($kpi_manual as $key => $val):?>
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
									<td class="text-center">
										(<?= $val->detail;?>)
									</td>
								</tr>
								<?php endforeach;?>
								<?php endif;?>
							</tbody>
						</table>
					</div>
					<!-- End Table -->
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
				<?php endif;?>
			</div>
			<div class="tab-pane fade" id="nav-two-eg1" role="tabpanel" aria-labelledby="nav-one-eg1-tab">

			</div>
		</div>
	</div>
</div>
<script>
	function showTabless() {
		console.log(124124145124);
		$.ajax({
			type: "POST",
			url: `<?= site_url('api/proyek/showTables');?>`,
			success: function (data) {
				$('#nav-two-eg1').html(data);
			},
		});
	}
</script>
<?php if(!empty($chart_kpi)):?>
<script>
	// target bar chart
	var optionsChartTarget = {
		series: [{
			name: 'Nilai',
			data: [ <?= implode(',', $chart_kpi_manual['data']) ?> ]
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
			categories: [ <?= implode(',', $chart_kpi_manual['name']) ?> ],
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

</script>
<?php endif;?>


<?php if(!empty($chart_kpi['data'])):?>
<script>
	var dataKpi = [ <?= implode(',', $chart_kpi['data']) ?> ];
	var categoriesKpi = [ <?= implode(',', $chart_kpi['kategori']) ?> ];

	var optionsChartKpi = {
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

</script>
<?php endif;?>
