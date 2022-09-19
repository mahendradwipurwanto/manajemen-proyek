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
<div class="row mb-4">
	<div class="col-md-3 col-sm-12">
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
	<div class="col-md-3 col-sm-12">
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
	<div class="col-md-3 col-sm-12">
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
	<div class="col-md-3 col-sm-12">
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
</div>