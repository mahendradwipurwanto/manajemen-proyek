<!-- ========== MAIN CONTENT ========== -->
<main id="content" role="main" class="content-space-t-1">

	<div class="container-fuild mx-10 px-0 content-space-1 content-space-md-2">
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

						<span class="d-block text-dark"><?= $user->nama;?></span>
						<div class="my-2">
							<span class="badge bg-info">staff</span>
						</div>
						<span class="d-block text-body small">Bergabung sejak
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
											<img class="avatar-img"
												src="<?= base_url();?>assets/svg/illustrations/star.svg"
												alt="Image Description">
										</span>
									</div>

									<div class="flex-grow-1 ms-3">
										<span
											class="text-body small"><?= number_format($countDashboard['totalProyek'],0,",",".")?>
											proyek</span>
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
											<img class="avatar-img"
												src="<?= base_url();?>assets/svg/illustrations/add-file.svg"
												alt="Image Description">
										</span>
									</div>

									<div class="flex-grow-1 ms-3">
										<span
											class="text-body small"><?= number_format($countDashboard['totalTask'],0,",",".")?>
											task</span>
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
							<li class="nav-item" id="tour-dashboard">
								<a class="nav-link <?= ($this->uri->segment(2) == "dashboard" || !$this->uri->segment(2) ? "active" : "") ?>"
									href="<?= site_url('staff/dashboard'); ?>">
									<i class="bi bi-person-badge nav-icon"></i> Dashboard
								</a>
							</li>
							<li class="nav-item d-none" id="tour-menu-kpi">
								<a class="nav-link <?= ($this->uri->segment(2) == "kpi" || $this->uri->segment(2) == "task" ? "active" : "") ?>"
									href="<?= site_url('staff/kpi'); ?>">
									<i class="bi bi-file-bar-graph nav-icon"></i> KPI
								</a>
							</li>
							<li class="nav-item" id="tour-menu-laporan">
								<a class="nav-link <?= ($this->uri->segment(2) == "laporan" || $this->uri->segment(2) == "task" ? "active" : "") ?>"
									href="<?= site_url('staff/laporan'); ?>">
									<i class="bi bi-file-bar-graph nav-icon"></i> Laporan
								</a>
							</li>
							<li class="nav-item d-none" id="tour-menu-staff">
								<a class="nav-link <?= ($this->uri->segment(2) == "daftar-staff" || $this->uri->segment(2) == "task" ? "active" : "") ?>"
									href="<?= site_url('staff/daftar-staff'); ?>">
									<i class="bi bi-people-fill nav-icon"></i> Daftar Staff
								</a>
							</li>
							<li class="nav-item" id="tour-menu-proyek">
								<a class="nav-link <?= ($this->uri->segment(2) == "kelola-proyek" || $this->uri->segment(2) == "task" || $this->uri->segment(2) == "kelola" ? "active" : "") ?>"
									href="<?= site_url('staff/kelola-proyek'); ?>">
									<i class="bi bi-clipboard nav-icon"></i> Kelola Task
								</a>
							</li>
							<li class="nav-item" id="tour-pengaturan">
								<a class="nav-link <?= ($this->uri->segment(2) == "pengaturan" ? "active" : "") ?>"
									href="<?= site_url('staff/pengaturan'); ?>">
									<i class="bi bi-sliders nav-icon"></i> Pengaturan
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
