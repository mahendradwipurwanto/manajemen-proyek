<!-- Page Header -->
<div class="docs-page-header">
	<div class="row align-items-center">
		<div class="col-sm">
			<h1 class="docs-page-header-title d-flex justify-content-between">KPI - <?= $nama_proyek;?>
				<form action="<?= site_url('proyek/kpi');?>" method="get" class="d-flex">
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
					<button type="submit" class="btn btn-primary btn-sm ms-3">Tampilkan</button>
					<a href="<?= site_url('cetak/kpi/'.$this->input->get('proyek'));?>"
						class="btn btn-warning btn-sm ms-3" target="_blank"><i class="bi bi-printer"></i> Cetak</a>
					<a href="<?= site_url('excel/ekspor-kpi/'.$this->input->get('proyek'));?>"
						class="btn btn-success btn-sm ms-3" target="_blank"><i class="bi bi-file-spreadsheet"></i> Ekspor</a>
				</form>
			</h1>
			<p class="docs-page-header-text">Pantau kinerja staff pada semua proyek</p>
		</div>
	</div>
</div>

<div class="row mb-4">
	<div class="col-md-12">
		<div class="alert bg-soft-primary py-1">
			<small>KPI (Key Index Performance) pada sistem ini, mengacu pada perhitungan bobot setiap task terhadap
				total bobot yang dimiliki setiap task pada suatu proyek. Dan acuan minimal index KPI untuk nilai didapat
				dari 3/4 total bobot task staff. Setiap staf dapat memiliki nilai maksimal yang berbeda tergantung dari
				total bobot yang merekam miliki.</small>
		</div>
		<div class="card">
			<!-- Table -->
			<div class="card-body p-4">
				<table class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table"
					id="table-kpi">
					<thead class="thead-light">
						<tr>
							<th rowspan="2" width="5%">Peringkat</th>
							<th rowspan="2">Staff</th>
							<th colspan="4" class="text-center">Proyek</th>
							<th rowspan="2">Nilai</th>
							<th rowspan="2">Presentase</th>
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
							<td class="text-center"><?= $no++;?>.</td>
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
							<td class="text-center">
								<?= $val->nilai;?>
							</td>
							<td class="text-center">
								<span class="badge bg-soft-<?= $val->color_badge;?>"><?= $val->persentase;?>%</span>
							</td>
						</tr>

						<!-- Modal -->
						<div id="proyek-<?= $val->user_id;?>" class="modal fade" tabindex="-1" role="dialog"
							aria-labelledby="modalTambah" aria-hidden="true">
							<div class="modal-dialog modal-dialog-centered" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="modalTambah">Daftar proyek</h5>
										<button type="button" class="btn-close" data-bs-dismiss="modal"
											aria-label="Close"></button>
									</div>
									<div class="modal-body">
										<?php if(!empty($val->proyek)):?>
										<!-- List Striped -->
										<ul class="list-group list-group-lg w-100 mx-0"
											style="max-height: 300px; overflow: auto;">
											<?php foreach($val->proyek as $keys => $value):?>
											<li class="list-group-item py-2">
												<div class="row justify-content-between">
													<div class="col-sm-6 mb-2 mb-sm-0">
														<span class="h6"><?= $value->judul;?></span>
													</div>
													<!-- End Col -->
												</div>
												<!-- End Row -->
											</li>
											<?php endforeach;?>
										</ul>
										<!-- End List Striped -->
										<?php else:?>
										<div class="alert alert-secondary mb-0">
											Belum ada proyek
										</div>
										<?php endif;?>
									</div>
								</div>
							</div>
						</div>
						<!-- End Modal -->

						<!-- Modal -->
						<div id="task-<?= $val->user_id;?>" class="modal fade" tabindex="-1" role="dialog"
							aria-labelledby="modalTambah" aria-hidden="true">
							<div class="modal-dialog modal-dialog-centered" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="modalTambah">Daftar proyek</h5>
										<button type="button" class="btn-close" data-bs-dismiss="modal"
											aria-label="Close"></button>
									</div>
									<div class="modal-body">
										<?php if(!empty($val->task)):?>
										<!-- List Striped -->
										<ul class="list-group list-group-lg w-100 mx-0"
											style="max-height: 300px; overflow: auto;">
											<?php foreach($val->task as $keys => $value):?>
											<li class="list-group-item py-2">
												<div class="row justify-content-between">
													<div class="col-sm-6 mb-2 mb-sm-0">
														<span class="h6"><?= $value->task;?></span>
													</div>
													<!-- End Col -->
												</div>
												<!-- End Row -->
											</li>
											<?php endforeach;?>
										</ul>
										<!-- End List Striped -->
										<?php else:?>
										<div class="alert alert-secondary mb-0">
											Belum ada proyek
										</div>
										<?php endif;?>
									</div>
								</div>
							</div>
						</div>
						<!-- End Modal -->

						<!-- Modal -->
						<div id="taskProses-<?= $val->user_id;?>" class="modal fade" tabindex="-1" role="dialog"
							aria-labelledby="modalTambah" aria-hidden="true">
							<div class="modal-dialog modal-dialog-centered" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="modalTambah">Daftar proyek</h5>
										<button type="button" class="btn-close" data-bs-dismiss="modal"
											aria-label="Close"></button>
									</div>
									<div class="modal-body">
										<?php if(!empty($val->taskProsesData)):?>
										<!-- List Striped -->
										<ul class="list-group list-group-lg w-100 mx-0"
											style="max-height: 300px; overflow: auto;">
											<?php foreach($val->taskProsesData as $keys => $value):?>
											<li class="list-group-item py-2">
												<div class="row justify-content-between">
													<div class="col-sm-6 mb-2 mb-sm-0">
														<span class="h6"><?= $value->task;?></span>
													</div>
													<!-- End Col -->
												</div>
												<!-- End Row -->
											</li>
											<?php endforeach;?>
										</ul>
										<!-- End List Striped -->
										<?php else:?>
										<div class="alert alert-secondary mb-0">
											Belum ada task
										</div>
										<?php endif;?>
									</div>
								</div>
							</div>
						</div>
						<!-- End Modal -->

						<!-- Modal -->
						<div id="taskSelesai-<?= $val->user_id;?>" class="modal fade" tabindex="-1" role="dialog"
							aria-labelledby="modalTambah" aria-hidden="true">
							<div class="modal-dialog modal-dialog-centered" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="modalTambah">Daftar proyek</h5>
										<button type="button" class="btn-close" data-bs-dismiss="modal"
											aria-label="Close"></button>
									</div>
									<div class="modal-body">
										<?php if(!empty($val->taskSelesaiData)):?>
										<!-- List Striped -->
										<ul class="list-group list-group-lg w-100 mx-0"
											style="max-height: 300px; overflow: auto;">
											<?php foreach($val->taskSelesaiData as $keys => $value):?>
											<li class="list-group-item py-2">
												<div class="row justify-content-between">
													<div class="col-sm-6 mb-2 mb-sm-0">
														<span class="h6"><?= $value->task;?></span>
													</div>
													<!-- End Col -->
												</div>
												<!-- End Row -->
											</li>
											<?php endforeach;?>
										</ul>
										<!-- End List Striped -->
										<?php else:?>
										<div class="alert alert-secondary mb-0">
											Belum ada task
										</div>
										<?php endif;?>
									</div>
								</div>
							</div>
						</div>
						<!-- End Modal -->
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
	<div class="col-md-4">
		<div class="card">
			<!-- Table -->
			<div class="card-body p-4">
				<table
					class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table dataTables-nosearch w-100"
					id="table-chart-kpi">
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
