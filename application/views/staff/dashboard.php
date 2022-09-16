<div class="row">
	<div class="col-3">
		<!-- Card -->
		<div class="card">
			<!-- Card Header -->
			<div class="card-header text-center">
				<div class="mb-3">
					<img class="avatar avatar-xxl avatar-circle avatar-centered"
						src="<?= base_url();?><?= $user->profil;?>" alt="Image Description">
				</div>

				<span class="d-block text-dark mb-3"><?= $user->nama;?></span>

				<span class="d-block text-body small mb-3">Bergabung sejak
					<?= date("d M Y", $user->created_at);?></span>
			</div>
			<!-- End Card Header -->

			<!-- Card Body -->
			<div class="card-body">
				<div class="row mb-3">

					<div class="col-6 col-md-12 col-lg-6 mb-4">
						<!-- Icon Block -->
						<div class="d-flex align-items-center">
							<div class="flex-shrink-0">
								<span class="avatar avatar-xs">
									<img class="avatar-img" src="<?= base_url();?>assets/svg/illustrations/star.svg"
										alt="Image Description">
								</span>
							</div>

							<div class="flex-grow-1 ms-3">
								<span class="text-body small"><?= number_format($countDashboard['totalProyek'],0,",",".")?> proyek</span>
							</div>
						</div>
						<!-- End Icon Block -->
					</div>
					<!-- End Col -->

					<div class="col-6 col-md-12 col-lg-6">
						<!-- Icon Block -->
						<div class="d-flex align-items-center">
							<div class="flex-shrink-0">
								<span class="avatar avatar-xs">
									<img class="avatar-img" src="<?= base_url();?>assets/svg/illustrations/add-file.svg"
										alt="Image Description">
								</span>
							</div>

							<div class="flex-grow-1 ms-3">
								<span class="text-body small"><?= number_format($countDashboard['totalTask'],0,",",".")?> task</span>
							</div>
						</div>
						<!-- End Icon Block -->
					</div>
					<!-- End Col -->
				</div>
				<!-- End Row -->

				<!-- Nav -->
				<span class="text-cap">Akun</span>

				<!-- List -->
				<ul class="nav nav-sm nav-tabs nav-vertical">
					<li class="nav-item">
						<a class="nav-link <?= ($this->uri->segment(2) == "dashboard" || !$this->uri->segment(2) ? "active" : "") ?>"
							href="<?= site_url('staff/dashboard'); ?>">
							<i class="bi-person-badge nav-icon"></i> Dashboard
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link <?= ($this->uri->segment(2) == "kelola-proyek" || $this->uri->segment(2) == "task" ? "active" : "") ?>"
							href="<?= site_url('staff/kelola-proyek'); ?>">
							<i class="bi-shield-shaded nav-icon"></i> Kelola Task
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link <?= ($this->uri->segment(2) == "pengaturan" ? "active" : "") ?>"
							href="<?= site_url('staff/pengaturan'); ?>">
							<i class="bi-sliders nav-icon"></i> Pengaturan
						</a>
					</li>
				</ul>
				<!-- End List -->
			</div>
			<!-- End Card Body -->
		</div>
		<!-- End Card -->
	</div>
	<div class="col-9">
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

	</div>
</div>
