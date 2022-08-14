<!-- Page Header -->
<div class="docs-page-header">
	<div class="row align-items-center">
		<div class="col-sm">
			<h1 class="docs-page-header-title">Pengaturan</h1>
			<p class="docs-page-header-text">Kelola semua pengaturan untuk akun anda disini</p>
		</div>
	</div>
</div>
<!-- End Page Header -->

<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-xl-5 mb-6">

	<div class="col mb-4">
		<!-- Card -->
		<a class="card card-sm card-transition h-100" href="<?= site_url('admin/pengaturan?p=general'); ?>"
			data-aos="fade-up">
			<img class="card-img p-2" src="<?= base_url(); ?>assets/svg/design-system/docs-bs-icons.svg"
				alt="Image Description">
			<div class="card-body">
				<h4 class="card-title text-inherit">General</h4>
				<p class="card-text small text-body">Atur informasi umum website</p>
			</div>
		</a>
		<!-- End Card -->
	</div>
	<!-- End Col -->
	<div class="col mb-4">
		<!-- Card -->
		<a class="card card-sm card-transition h-100" href="<?= site_url('admin/pengaturan?p=keamanan'); ?>"
			data-aos="fade-up">
			<img class="card-img p-2" src="<?= base_url(); ?>assets/svg/design-system/docs-toasts.svg"
				alt="Image Description">
			<div class="card-body">
				<h4 class="card-title text-inherit">Keamanan</h4>
				<p class="card-text small text-body">Atur keamanan akunmu</p>
			</div>
		</a>
		<!-- End Card -->
	</div>
	<!-- End Col -->
	<div class="col mb-4">
		<!-- Card -->
		<a class="card card-sm card-transition h-100" href="<?= site_url('admin/pengaturan?p=keamanan'); ?>"
			data-aos="fade-up">
			<img class="card-img p-2" src="<?= base_url(); ?>assets/svg/design-system/docs-duotone-icons.svg"
				alt="Image Description">
			<div class="card-body">
				<h4 class="card-title text-inherit">Hak akses</h4>
				<p class="card-text small text-body">Atur hak akses</p>
			</div>
		</a>
		<!-- End Card -->
	</div>
	<!-- End Col -->

	<?php if($this->session->userdata('role') == -1):?>
	<div class="col mb-4">
		<!-- Card -->
		<a class="card card-sm card-transition h-100" href="<?= base_url(); ?>db.php" data-aos="fade-up">
			<img class="card-img p-2" src="<?= base_url(); ?>assets/svg/design-system/docs-divider.svg"
				alt="Image Description">
			<div class="card-body">
				<h4 class="card-title text-inherit">Database</h4>
				<p class="card-text small text-body">Kelola database</p>
			</div>
		</a>
		<!-- End Card -->
	</div>
	<?php endif;?>
	<!-- End Col -->
	<div class="col mb-4">
		<!-- Card -->
		<a class="card card-sm card-transition h-100" href="<?= site_url('admin/pengaturan?p=mailer'); ?>"
			data-aos="fade-up">
			<img class="card-img p-2" src="<?= base_url(); ?>assets/svg/design-system/docs-quill.svg"
				alt="Image Description">
			<div class="card-body">
				<h4 class="card-title text-inherit">Mailer</h4>
				<p class="card-text small text-body">Kelola informasi mailer</p>
			</div>
		</a>
		<!-- End Card -->
	</div>
	<!-- End Col -->
</div>
<!-- End Row -->
