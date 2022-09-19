  <!-- ========== HEADER ========== -->
  <header id="header"
  	class="navbar navbar-expand-lg navbar-end navbar-absolute-top navbar-light bg-white shadow-sm navbar-show-hide"
  	data-hs-header-options='{
            "fixMoment": 1000,
            "fixEffect": "slide"
          }'>

  	<div class="container">
  		<nav class="js-mega-menu navbar-nav-wrap">
  			<!-- Default Logo -->
  			<a class="navbar-brand" href="<?= base_url();?>" aria-label="Front">
  				<img class="navbar-brand-logo" src="<?= base_url(); ?>assets/images/logo.png" alt="Logo">
  			</a>
  			<!-- End Default Logo -->

  			<!-- Toggler -->
  			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
  				aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
  				<span class="navbar-toggler-default">
  					<i class="bi-list"></i>
  				</span>
  				<span class="navbar-toggler-toggled">
  					<i class="bi-x"></i>
  				</span>
  			</button>
  			<!-- End Toggler -->

  			<!-- Collapse -->
  			<div class="collapse navbar-collapse" id="navbarNavDropdown">
  				<div class="navbar-absolute-top-scroller">
  					<ul class="navbar-nav">

  						<!-- Beranda -->
  						<li class="nav-item">
  							<a class="nav-link" href="<?= base_url();?>">Beranda</a>
  						</li>
  						<!-- End Beranda -->

  						<?php if($this->session->userdata('logged_in') == true || $this->session->userdata('logged_in')):?>

  						<!-- Button -->
  						<li class="nav-item">
  							<?php if($this->session->userdata('role') == 1 || $this->session->userdata('role') == 0):?>
                                <a class="btn btn-xs btn-primary btn-transition" href="<?= site_url('admin');?>">Dashboard</a>
  							<?php elseif($this->session->userdata('role') == 2):?>
                                <a class="btn btn-xs btn-primary btn-transition" href="<?= site_url('leader');?>">Dashboard</a>
  							<?php else:?>
                                <a class="btn btn-xs btn-primary btn-transition" href="<?= site_url('staff');?>">Dashboard</a>
  							<?php endif;?>
  						</li>
  						<!-- End Button -->

  						<!-- Button -->
  						<li class="nav-item">
  							<a class="btn btn-xs btn-outline-primary btn-transition"
  								href="<?= site_url('keluar');?>">Keluar</a>
  						</li>
  						<!-- End Button -->
  						<?php else:?>

  						<!-- Button -->
  						<li class="nav-item">
  							<a class="btn btn-xs btn-primary btn-transition" href="<?= site_url('daftar');?>">Daftar</a>
  						</li>
  						<!-- End Button -->

  						<!-- Button -->
  						<li class="nav-item">
  							<a class="btn btn-xs btn-outline-primary btn-transition"
  								href="<?= site_url('masuk');?>">Masuk</a>
  						</li>
  						<!-- End Button -->
  						<?php endif;?>
  					</ul>
  				</div>
  			</div>
  			<!-- End Collapse -->
  		</nav>
  	</div>
  </header>

  <!-- ========== MAIN CONTENT ========== -->
  <main id="content" role="main" class="overflow-hidden">