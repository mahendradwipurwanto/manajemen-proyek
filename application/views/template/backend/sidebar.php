  <!-- ========== MAIN CONTENT ========== -->
  <main id="content" role="main" class="content-space-t-1">
  	<!-- Navbar -->
  	<nav class="js-nav-scroller navbar navbar-expand-lg navbar-sidebar navbar-vertical navbar-light bg-white border-end"
  		data-hs-nav-scroller-options='{
            "type": "vertical",
            "target": ".navbar-nav .active",
            "offset": 80
           }' style="z-index: 90;">
  		<!-- Navbar Toggle -->
  		<button type="button" class="navbar-toggler btn btn-white d-grid w-100" data-bs-toggle="collapse"
  			data-bs-target="#navbarVerticalNavMenu" aria-label="Toggle navigation" aria-expanded="false"
  			aria-controls="navbarVerticalNavMenu">
  			<span class="d-flex justify-content-between align-items-center">
  				<span class="h3 mb-0">Menu</span>

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
  			<div class="navbar-brand-wrapper border-end" style="height: 75px;">
  				<!-- Default Logo -->
  				<div class="d-flex align-items-center">
  					<a class="navbar-brand" href="<?= base_url(); ?>" aria-label="Space">
  						<img class="navbar-brand-logo" src="<?= base_url(); ?><?= $web_logo;?>" alt="Logo">
  					</a>
  					<a class="navbar-brand-badge">
  						<span class="badge bg-soft-primary text-primary ms-2">v1.5.9</span>
  					</a>
  				</div>
  				<!-- End Default Logo -->
  			</div>

  			<div class="docs-navbar-sidebar-aside-body navbar-sidebar-aside-body">
  				<ul id="navbarSettings" class="navbar-nav nav nav-vertical nav-tabs nav-tabs-borderless nav-sm">
  					<?php if($this->session->userdata('role') == 0 || $this->session->userdata('role') == 1):?>
  					<li class="nav-item" id="tour-dashboard">
  						<a class="nav-link <?= ($this->uri->segment(2) == "dashboard" || !$this->uri->segment(2) ? "active" : "") ?>"
  							href="<?= site_url('admin/dashboard'); ?>">Dashboard</a>
  					</li>
  					<li class="nav-item" id="tour-menu-kpi">
  						<a class="nav-link <?= ($this->uri->segment(2) == "kpi" ? "active" : "") ?>"
  							href="<?= site_url('proyek/kpi'); ?>">KPI </a>
  					</li>
  					<li class="nav-item" id="tour-menu-laporan">
  						<a class="nav-link <?= ($this->uri->segment(2) == "laporan" ? "active" : "") ?>"
  							href="<?= site_url('proyek/laporan'); ?>">Laporan </a>
  					</li>

  					<li class="nav-item my-2 my-lg-5"></li>

  					<li class="nav-item">
  						<span class="nav-subtitle">Pengguna</span>
  					</li>
  					<li class="nav-item" id="tour-menu-staff">
  						<a class="nav-link <?= ($this->uri->segment(2) == "kelola-staff" && $this->uri->segment(1) != "proyek" ? "active" : "") ?>"
  							href="<?= site_url('admin/kelola-staff'); ?>">Staff</a>
  					</li>
  					<li class="nav-item" id="tour-menu-leader">
  						<a class="nav-link <?= ($this->uri->segment(2) == "kelola-leader" ? "active" : "") ?>"
  							href="<?= site_url('admin/kelola-leader'); ?>">Leader (Staff)</a>
  					</li>

  					<li class="nav-item my-2 my-lg-5"></li>

  					<li class="nav-item">
  						<span class="nav-subtitle">Proyek</span>
  					</li>
  					<?php if(empty($proyek_semat)):?>
  					<li class="nav-item" id="tour-menu-proyek">
  						<a class="nav-link <?= ($this->uri->segment(2) == "kelola-proyek" || $this->uri->segment(1) == "proyek" && $this->uri->segment(2) != "kpi" && $this->uri->segment(2) != "laporan" ? "active" : "") ?>"
  							href="<?= site_url('admin/kelola-proyek'); ?>">Proyek
  							<span class="ms-auto badge bg-primary"></span>
  						</a>
  					</li>
  					<?php else:?>
  					<li class="nav-item ">
  						<a class="nav-link dropdown-toggle" href="#proyek-sidebar" role="button"
  							data-bs-toggle="collapse" aria-expanded="true" aria-controls="proyek-sidebar">Proyek</a>

  						<div id="proyek-sidebar" class="nav-collapse collapse show">
  							<a class="nav-link <?= (($this->uri->segment(2) == "kelola-proyek" || $this->uri->segment(1) == "proyek")  && !$this->uri->segment(3) ? "active" : "") ?>"
  								href="<?= site_url('admin/kelola-proyek'); ?>">Semua Proyek</a>
  							<?php foreach($proyek_semat as $key => $val):?>
  							<a class="nav-link text-overflow <?= ($this->uri->segment(1) == "proyek" && $this->uri->segment(3) ? "active" : "") ?>"
  								href="<?= site_url('proyek/kelola/'.$val->kode);?>">#
  								<?= substr($val->judul, 0, 20);?> <?= strlen($val->judul) > 20 ? '...' : '';?></a>
  							<?php endforeach;?>
  						</div>
  					</li>
  					<?php endif;?>
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
  							href="<?= site_url('leader/kpi'); ?>">KPI</a>
  					</li>
  					<li class="nav-item" id="tour-menu-laporan">
  						<a class="nav-link <?= ($this->uri->segment(2) == "laporan" ? "active" : "") ?>"
  							href="<?= site_url('leader/laporan'); ?>">Laporan</a>
  					</li>

  					<li class="nav-item my-2 my-lg-5"></li>

  					<li class="nav-item">
  						<span class="nav-subtitle">Proyek</span>
  					</li>
  					<li class="nav-item" id="tour-menu-staff">
  						<a class="nav-link <?= ($this->uri->segment(2) == "kelola-staff" && $this->uri->segment(1) != "proyek" ? "active" : "") ?>"
  							href="<?= site_url('leader/kelola-staff'); ?>">Staff</a>
  					</li>
  					<?php if(empty($proyek_semat)):?>
  					<li class="nav-item" id="tour-menu-proyek">
  						<a class="nav-link <?= ($this->uri->segment(2) == "kelola-proyek" || $this->uri->segment(1) == "proyek" ? "active" : "") ?>"
  							href="<?= site_url('leader/kelola-proyek'); ?>">Proyek
  							<span class="ms-auto badge bg-primary"></span>
  						</a>
  					</li>
  					<?php else:?>
  					<li class="nav-item ">
  						<a class="nav-link dropdown-toggle" href="#proyek-sidebar" role="button"
  							data-bs-toggle="collapse" aria-expanded="true" aria-controls="proyek-sidebar">Proyek</a>

  						<div id="proyek-sidebar" class="nav-collapse collapse show">
  							<a class="nav-link <?= (($this->uri->segment(2) == "kelola-proyek" || $this->uri->segment(1) == "proyek")  && !$this->uri->segment(3) ? "active" : "") ?>"
  								href="<?= site_url('leader/kelola-proyek'); ?>">Semua Proyek</a>
  							<?php foreach($proyek_semat as $key => $val):?>
  							<a class="nav-link text-overflow <?= ($this->uri->segment(1) == "proyek" && $this->uri->segment(3) ? "active" : "") ?>"
  								href="<?= site_url('proyek/kelola/'.$val->kode);?>">#
  								<?= substr($val->judul, 0, 20);?> <?= strlen($val->judul) > 20 ? '...' : '';?></a>
  							<?php endforeach;?>
  						</div>
  					</li>
  					<?php endif;?>

  					<li class="nav-item my-2 my-lg-5"></li>

  					<li class="nav-item">
  						<span class="nav-subtitle">Pengaturan</span>
  					</li>
  					<li class="nav-item" id="tour-menu-pengaturan">
  						<a class="nav-link <?= ($this->uri->segment(2) == "pengaturan" ? "active" : "") ?>"
  							href="<?= site_url('leader/pengaturan'); ?>">Pengaturan</a>
  					</li>
  					<?php elseif($this->session->userdata('role') == 3):?>
  					<li class="nav-item" id="tour-dashboard">
  						<a class="nav-link <?= ($this->uri->segment(2) == "dashboard" || !$this->uri->segment(2) ? "active" : "") ?>"
  							href="<?= site_url('staff/dashboard'); ?>">Dashboard</a>
  					</li>

  					<li class="nav-item my-2 my-lg-3"></li>

  					<li class="nav-item">
  						<span class="nav-subtitle">Proyek</span>
  					</li>
  					<li class="nav-item" id="tour-dashboard">
  						<a class="nav-link <?= ($this->uri->segment(2) == "kelola-proyek" || $this->uri->segment(2) == "task" ? "active" : "") ?>"
  							href="<?= site_url('staff/kelola-proyek'); ?>">Kelola Task</a>
  					</li>
  					<li class="nav-item" id="tour-dashboard">
  						<a class="nav-link <?= ($this->uri->segment(2) == "pengaturan" ? "active" : "") ?>"
  							href="<?= site_url('staff/pengaturan'); ?>">Pengaturan</a>
  					</li>
  					<?php endif;?>
  				</ul>
  			</div>
  		</div>
  		<!-- End Navbar Collapse -->
  	</nav>
  	<!-- End Navbar -->
  	<!-- Content -->
  	<div class="navbar-sidebar-aside-content content-space-1 content-space-md-2 px-lg-5 px-xl-10">
