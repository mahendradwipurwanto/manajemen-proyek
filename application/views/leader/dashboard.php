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
				<h1 class="h1"><?= number_format(1,0,",",".")?></h1>
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
				<h1 class="h1"><?= number_format(1,0,",",".")?></h1>
				<div class="h6">Total Staff</div>
				<div style="position: absolute;right: 10px;bottom: 0px;">
					<i class="bi bi-people text-secondary" style="font-size: 2.5em;"></i>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-3 col-sm-12">
		<div class="card" style="text-align: center;">
			<div class="card-body">
				<h1 class="h1"><?= number_format(1,0,",",".")?></h1>
				<div class="h6">Total Task</div>
				<div style="position: absolute;right: 10px;bottom: 0px;">
					<i class="bi bi-clipboard text-warning" style="font-size: 2.5em;"></i>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-3 col-sm-12">
		<div class="card" style="text-align: center;">
			<div class="card-body">
				<h1 class="h1"><?= number_format($countLeader['totalLeader'],0,",",".")?>%</h1>
				<div class="h6">Presentase proyek</div>
				<div style="position: absolute;right: 10px;bottom: 0px;">
					<i class="bi bi-person-check text-success" style="font-size: 2.5em;"></i>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-8">

	</div>
	<div class="col-md-4">
		
	</div>
</div>