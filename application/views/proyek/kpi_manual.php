<!-- Page Header -->
<div class="docs-page-header">
	<div class="row align-items-center">
		<div class="col-sm">
			<h1 class="docs-page-header-title">KPI STAFF
				<?php if($this->input->get('periode')):?>
				<span class="text-body pb-3 me-3"> - periode <span
						class="text-primary"><?= $this->input->get('periode');?></span></span>
				<?php endif;?>
			</h1>
			<p class="docs-page-header-text">Pantau kinerja staff pada semua proyek</p>
		</div>
	</div>
</div>
<form action="<?= site_url('proyek/kpi-staff');?>" method="get">
	<div class="row mb-4 d-flex align-items-center">
		<div class="col-1">
			Filter: 
		</div>
		<div class="col-3 d-none">
			<div class="input-group input-group-sm">
				<span class="input-group-text" id="basic-addon2"><i class="bi bi-calendar-week"></i></span>
				<input type="text" class="form-control form-control-sm" name="periode" placeholder="Periode proyek"
					aria-describedby="basic-addon2" >
			</div>
		</div>
		<div class="col-3">
			<!-- Select -->
			<div class="tom-select-custom tom-select-custom-sm">
				<select class="js-select form-select form-select-sm" name="staff" autocomplete="off"
					data-hs-tom-select-options='{"placeholder": "Pilih staff"}'>
					<option value="0" selected>Semua Staff</option>
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
			<a href="<?= site_url('cetak/kpi/'.$this->input->get('proyek'));?>" class="btn btn-warning btn-sm ms-3"
				target="_blank"><i class="bi bi-printer"></i> Cetak</a>
		</div>
	</div>
</form>
<div class="row mb-4">
	<div class="col-md-12">
		<div class="alert bg-soft-primary py-1">
			<small>KPI (Key Index Performance) Staff ini mengacu pada penilaian yang diberikan oleh atasan pada staff saat menutup salah satu proyek.</small>
		</div>
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

<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-body">
				<div id="chartTarget"></div>
			</div>
		</div>
	</div>
</div>

<?php if(!empty($chart_kpi)):?>
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
</script>
<?php endif;?>