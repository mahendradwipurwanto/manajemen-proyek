<!-- Page Header -->
<div class="docs-page-header <?php if($this->agent->is_mobile()):?>mb-0<?php endif;?>">
	<div class="row align-items-center">
		<div class="col-sm">
			<h1 class="docs-page-header-title">Dashboard</h1>
			<p class="docs-page-header-text">Pantau secara singkat informasi websitemu.</p>
		</div>
	</div>
</div>
<!-- End Page Header -->
<div class="row">
	<div class="col-md-3 col-sm-12 mb-4">
		<div class="card" style="text-align: center;">
			<div class="card-body">
				<h1 class="h1"><?= number_format($count['proyek'],0,",",".")?></h1>
				<div class="h6">Proyek</div>
				<div style="position: absolute;right: 10px;bottom: 0px;">
					<i class="bi bi-kanban text-primary" style="font-size: 2.5em;"></i>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-3 col-sm-12 mb-4">
		<div class="card" style="text-align: center;">
			<div class="card-body">
				<h1 class="h1"><?= number_format($count['leader'],0,",",".")?></h1>
				<div class="h6">Total Leader</div>
				<div style="position: absolute;right: 10px;bottom: 0px;">
					<i class="bi bi-person-check text-success" style="font-size: 2.5em;"></i>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-3 col-sm-12 mb-4">
		<div class="card" style="text-align: center;">
			<div class="card-body">
				<h1 class="h1"><?= number_format($count['staff'],0,",",".")?></h1>
				<div class="h6">Total Staff</div>
				<div style="position: absolute;right: 10px;bottom: 0px;">
					<i class="bi bi-people text-secondary" style="font-size: 2.5em;"></i>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-3 col-sm-12 mb-4">
		<div class="card" style="text-align: center;">
			<div class="card-body">
				<h1 class="h1"><?= number_format($count['tasks'],0,",",".")?></h1>
				<div class="h6">Total Task</div>
				<div style="position: absolute;right: 10px;bottom: 0px;">
					<i class="bi bi-clipboard text-warning" style="font-size: 2.5em;"></i>
				</div>
			</div>
		</div>
	</div>
</div>


<div class="row d-none">
	<div class="col-12">
		<div class="alert alert-soft-primary">
			<small>Free maintenance selama 6 bulan terhitung dari tanggal waktu penyelesaiian yaitu (dd MM YYYY). Maintenance hanya berupa perbaikan fitur yang ada (tanpa ada penambahan fitur baru)</small>
		</div>
	</div>
</div>


<div class="row">
	<div class="col-md-8">
		<div class="card">
			<div class="card-header">
				<h3 class="card-title">Proyek Terbaru</h3>
			</div>
			<!-- Table -->
			<div class="card-body p-4">
				<table class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table"
					id="table">
					<thead class="thead-light">
						<tr>
							<th width="5%">No</th>
							<th>Proyek</th>
							<th>Dibuat</th>
							<th>Pengerjaan</th>
							<th>Status</th>
							<th style="width: 5%;"></th>
						</tr>
					</thead>

					<tbody>
						<?php if(!empty($proyek)):?>
						<?php $no=1;foreach($proyek as $key => $val):?>
						<tr>
							<td><?= $no++;?>.</td>
							<td>
								<b><?= $val->judul;?></b>
							</td>
							<td>
								<span class="badge bg-info"><?= date("d F Y", $val->created_at);?></span>
							</td>
							<td>
								<?= round(($val->periode_selesai - $val->periode_mulai)/  (60 * 60 * 24)) ;?> Hari
							</td>
							<td>
								<?php if($val->status == 1):?>
								<span class="badge bg-secondary">Perencanaan</span>
								<?php elseif($val->status == 2):?>
								<span class="badge bg-warning">Pengerjaan</span>
								<?php elseif($val->status == 3):?>
								<span class="badge bg-success">Selesai</span>
								<?php else:?>
								<span class="badge bg-danger">uknow</span>
								<?php endif;?>
							</td>
							<td>
								<a href="<?= site_url('proyek/kelola/'.$val->kode);?>"
									class="btn btn-xs btn-primary">detail</a>
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
	<div class="col-md-4">
		<div class="card">
			<div class="card-header py-3">
				<h4 class="card-title mb-0">Aktifitas terbaru</h4>
			</div>
			<div class="card-body p-3">
				<ul class="list-group list-group-lg w-100" style="max-height: 500px; overflow: auto;">
					<?php if(!empty($log_proyek)):?>
					<?php foreach($log_proyek as $key => $val):?>
					<li class="list-group-item py-3">
						<div class="row justify-content-between">
							<div class="col-sm-12 mb-2 mb-sm-0">
								<span class="h5 fw-normal"><b><?= $val->nama;?></b> <?= $val->message;?></span>
								<br>
								<span class="text-secondary small float-end"><?= $val->created_at;?></span>
							</div>
							<!-- End Col -->
						</div>
						<!-- End Row -->
					</li>
					<?php endforeach;?>
					<?php else:?>
					<li class="list-group-item py-3">
						<div class="row justify-content-between">
							<div class="col-sm-12 mb-2 mb-sm-0 text-center">
								<span class="h5 fw-normal">belum ada aktivitas terbaru</span>
							</div>
							<!-- End Col -->
						</div>
						<!-- End Row -->
					</li>
					<?php endif;?>
				</ul>
			</div>
		</div>
	</div>
</div>
