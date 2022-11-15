<!-- Page Header -->
<div class="docs-page-header">
	<div class="row align-items-center">
		<div class="col-sm">
			<h1 class="docs-page-header-title">Dashboard</h1>
			<p class="docs-page-header-text">Pantau secara singkat informasi semua proyekmu</p>
		</div>
	</div>
</div>
<!-- End Page Header -->
<div class="row">
	<div class="col-md-3 col-sm-12 mb-4">
		<div class="card" style="text-align: center;">
			<div class="card-body">
				<h1 class="h1"><?= number_format($countDashboard['totalProyek'],0,",",".")?></h1>
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
				<h1 class="h1"><?= number_format($countDashboard['totalTask'],0,",",".")?></h1>
				<div class="h6">Total Task</div>
				<div style="position: absolute;right: 10px;bottom: 0px;">
					<i class="bi bi-people text-secondary" style="font-size: 2.5em;"></i>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-3 col-sm-12 mb-4">
		<div class="card" style="text-align: center;">
			<div class="card-body">
				<h1 class="h1"><?= number_format($countDashboard['taskProses'],0,",",".")?></h1>
				<div class="h6">Task Progress</div>
				<div style="position: absolute;right: 10px;bottom: 0px;">
					<i class="bi bi-clipboard text-warning" style="font-size: 2.5em;"></i>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-3 col-sm-12 mb-4">
		<div class="card" style="text-align: center;">
			<div class="card-body">
				<h1 class="h1"><?= number_format($countDashboard['taskSelesai'],0,",",".")?></h1>
				<div class="h6">Task Selesai</div>
				<div style="position: absolute;right: 10px;bottom: 0px;">
					<i class="bi bi-clipboard-check text-success" style="font-size: 2.5em;"></i>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-8 col-sm-12 mb-4">
		<div class="card">
			<div class="card-header py-3">
				<h4 class="card-title mb-0">Notifikasi</h4>
			</div>
			<div class="card-body p-3">
				<ul class="list-group list-group-lg w-100" style="max-height: 500px; overflow: auto;">
					<?php if(!empty($notifikasi)):?>
					<?php foreach($notifikasi as $key => $val):?>
					<li class="list-group-item py-3">
						<div class="row justify-content-between">
							<div class="col-sm-12 mb-2 mb-sm-0">
								<span class="h5 fw-normal"><b><?= $val->nama;?></b> <?= $val->message;?>
									<?php if($val->is_read == 0):?>
									<span class="badge bg-soft-danger float-end">baru</span>
									<?php endif;?>
								</span>
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
								<span class="h5 fw-normal">belum ada notifikasi terbaru</span>
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
	<div class="col-md-4 col-sm-12 mb-4">
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
