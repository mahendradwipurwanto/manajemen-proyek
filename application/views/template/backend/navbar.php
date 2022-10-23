  <!-- ========== HEADER ========== -->
  <header id="header"
  	class="navbar navbar-expand navbar-fixed navbar-end navbar-light shadow-sm navbar-sticky-lg-top bg-white">
  	<div class="container-fluid">
  		<nav class="navbar-nav-wrap">
  			<div class="row flex-grow-1">
  				<!-- Default Logo -->
  				<div class="docs-navbar-sidebar-container d-flex align-items-center mb-2 mb-lg-0">
  					<a class="navbar-brand" href="<?= base_url();?>" aria-label="Space">
  						<img class="navbar-brand-logo" src="<?= base_url(); ?><?= $web_logo;?>" alt="Logo">
  					</a>
  					<a>
  						<span class="badge bg-soft-primary text-primary">v1.5.9</span>
  					</a>
  				</div>
  				<!-- End Default Logo -->

  				<div class="col-md px-lg-0">
  					<div class="d-flex justify-content-between align-items-center px-lg-5 px-xl-10">
  						<!-- Navbar -->
  						<ul class="navbar-nav p-0">
  							<?php if($this->session->userdata('role') == 0 || $this->session->userdata('role') == 1):?>
  							<li class="nav-item">
  								<a class="btn btn-ghost-secondary btn-sm" onclick="tourAdmin()">
  									Pusat Bantuan <i class="bi-question-diamond-fill ms-1"></i>
  								</a>
  							</li>
  							<?php else:?>
  							<li class="nav-item">
  								<a class="btn btn-ghost-secondary btn-sm" onclick="tourStaff()">
  									Pusat Bantuan <i class="bi-question-diamond-fill ms-1"></i>
  								</a>
  							</li>
  							<?php endif;?>
  							<li class="nav-item" id="tour-landing-button">
  								<a class="btn btn-ghost-secondary btn-sm" href="<?= base_url(); ?>" target="_blank">
  									Halaman utama <i class="bi-box-arrow-up-right ms-1"></i>
  								</a>
  							</li>
  							<li class="nav-item">
  								<a class="btn btn-outline-secondary btn-sm" href="<?= site_url('keluar'); ?>">
  									<i class="bi-power me-1"></i> Keluar
  								</a>
  							</li>
  						</ul>
  						<!-- End Navbar -->
  					</div>
  				</div>
  				<!-- End Col -->
  			</div>
  			<!-- End Row -->
  		</nav>
  	</div>
  </header>
  <!-- ========== END HEADER ========== -->
