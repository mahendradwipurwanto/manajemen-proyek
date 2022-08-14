  <!-- ========== MAIN CONTENT ========== -->
  <main id="content" role="main">
  	<!-- Navbar -->
  	<nav class="js-nav-scroller navbar navbar-expand-lg navbar-sidebar navbar-vertical navbar-light bg-white border-end"
  		data-hs-nav-scroller-options='{
            "type": "vertical",
            "target": ".navbar-nav .active",
            "offset": 80
           }'>
  		<!-- Navbar Toggle -->
  		<button type="button" class="navbar-toggler btn btn-white d-grid w-100" data-bs-toggle="collapse"
  			data-bs-target="#navbarVerticalNavMenu" aria-label="Toggle navigation" aria-expanded="false"
  			aria-controls="navbarVerticalNavMenu">
  			<span class="d-flex justify-content-between align-items-center">
  				<span class="h3 mb-0">Nav menu</span>

  				<span class="navbar-toggler-default">
  					<i class="bi-list"></i>
  				</span>

  				<span class="navbar-toggler-toggled">
  					<i class="bi-x"></i>
  				</span>
  			</span>
  		</button>
  		<!-- End Navbar Toggle -->

  		<!-- Navbar Collapse -->
  		<div id="navbarVerticalNavMenu" class="collapse navbar-collapse">
  			<div class="navbar-brand-wrapper border-end" style="height: auto;">
  				<!-- Default Logo -->
  				<div class="d-flex align-items-center">
  					<a class="navbar-brand" href="<?= site_url('dashboard'); ?>" aria-label="Space">
  						<img class="navbar-brand-logo" src="<?= base_url(); ?>assets/images/logo.png" alt="Logo">
  					</a>
  					<a class="navbar-brand-badge">
  						<span class="badge bg-soft-primary text-primary ms-2">v1.0</span>
  					</a>
  				</div>
  				<!-- End Default Logo -->
  			</div>

  			<div class="docs-navbar-sidebar-aside-body navbar-sidebar-aside-body">
  				<ul id="navbarSettings" class="navbar-nav nav nav-vertical nav-tabs nav-tabs-borderless nav-sm">
  					<?php if($this->session->userdata('role') == 1):?>
  					<li class="nav-item" id="tour-dashboard">
  						<a class="nav-link <?= ($this->uri->segment(2) == "dashboard" && !$this->uri->segment(2) ? "active" : "") ?>"
  							href="<?= site_url('admin/dashboard'); ?>">Dashboard</a>
  					</li>

  					<li class="nav-item my-2 my-lg-5"></li>

  					<li class="nav-item">
  						<span class="nav-subtitle">Pengguna</span>
  					</li>
  					<li class="nav-item" id="tour-menu-leader">
  						<a class="nav-link <?= ($this->uri->segment(2) == "kelola-leader" ? "active" : "") ?>"
  							href="<?= site_url('admin/kelola-leader'); ?>">Leader</a>
  					</li>
  					<li class="nav-item" id="tour-menu-staff">
  						<a class="nav-link <?= ($this->uri->segment(2) == "kelola-staff" ? "active" : "") ?>"
  							href="<?= site_url('admin/kelola-staff'); ?>">Staff</a>
  					</li>

  					<li class="nav-item my-2 my-lg-5"></li>

  					<li class="nav-item">
  						<span class="nav-subtitle">Proyek</span>
  					</li>
  					<li class="nav-item" id="tour-menu-proyek">
  						<a class="nav-link <?= ($this->uri->segment(2) == "kelola-proyek" ? "active" : "") ?>"
  							href="<?= site_url('admin/kelola-proyek'); ?>">Proyek
  							<span class="ms-auto badge bg-primary"></span>
  						</a>
  					</li>

  					<li class="nav-item my-2 my-lg-5"></li>

  					<li class="nav-item">
  						<span class="nav-subtitle">Pengaturan</span>
  					</li>
  					<li class="nav-item" id="tour-menu-cms">
  						<a class="nav-link <?= ($this->uri->segment(1) == "cms" ? "active" : "") ?>"
  							href="<?= site_url('cms/dashboard'); ?>">CMS Website</a>
  					</li>
  					<li class="nav-item" id="tour-menu-pengaturan">
  						<a class="nav-link <?= ($this->uri->segment(2) == "pengaturan" ? "active" : "") ?>"
  							href="<?= site_url('admin/pengaturan'); ?>">Pengaturan</a>
  					</li>
  					<?php elseif($this->session->userdata('role') == 2):?>
  					<li class="nav-item" id="tour-dashboard">
  						<a class="nav-link <?= ($this->uri->segment(2) == "dashboard" || !$this->uri->segment(2) ? "active" : "") ?>"
  							href="<?= site_url('leader/dashboard'); ?>">Dashboard</a>
  					</li>
  					<li class="nav-item" id="tour-menu-kpi">
  						<a class="nav-link <?= ($this->uri->segment(2) == "kpi" ? "active" : "") ?>"
  							href="<?= site_url('leader/kpi'); ?>">KPI / Laporan</a>
  					</li>

  					<li class="nav-item my-2 my-lg-5"></li>

  					<li class="nav-item">
  						<span class="nav-subtitle">Proyek</span>
  					</li>
  					<li class="nav-item" id="tour-menu-staff">
  						<a class="nav-link <?= ($this->uri->segment(2) == "kelola-staff" ? "active" : "") ?>"
  							href="<?= site_url('leader/kelola-staff'); ?>">Staff</a>
  					</li>
  					<li class="nav-item" id="tour-menu-proyek">
  						<a class="nav-link <?= ($this->uri->segment(2) == "kelola-proyek" ? "active" : "") ?>"
  							href="<?= site_url('leader/kelola-proyek'); ?>">Proyek
  							<span class="ms-auto badge bg-primary"></span>
  						</a>
  					</li>

  					<li class="nav-item my-2 my-lg-5"></li>

  					<li class="nav-item">
  						<span class="nav-subtitle">Pengaturan</span>
  					</li>
  					<li class="nav-item" id="tour-menu-pengaturan">
  						<a class="nav-link <?= ($this->uri->segment(2) == "pengaturan" ? "active" : "") ?>"
  							href="<?= site_url('leader/pengaturan'); ?>">Pengaturan</a>
  					</li>
  					<?php elseif($this->session->userdata('role') == 3):?>
  					<?php endif;?>
  				</ul>
  			</div>
  		</div>
  		<!-- End Navbar Collapse -->
  	</nav>
  	<!-- End Navbar -->
  	<!-- Content -->
  	<div class="navbar-sidebar-aside-content content-space-1 content-space-md-2 px-lg-5 px-xl-10">
