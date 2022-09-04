<!-- Page Header -->
<div class="docs-page-header <?php if($this->agent->is_mobile()):?>mb-0<?php endif;?>">
	<div class="row align-items-center">
		<div class="col-sm">
			<h1 class="docs-page-header-title">Pengguna</h1>
			<p class="docs-page-header-text">Kelola data pengguna</p>
		</div>
	</div>
</div>

<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-xl-5 mb-6">

	<div class="col mb-4">
		<!-- Card -->
		<a class="card card-sm card-transition h-100" href="<?= site_url('admin/kelola-leader'); ?>"
			data-aos="fade-up">
			<img class="card-img p-2" src="<?= base_url(); ?>assets/svg/design-system/docs-bs-icons.svg"
				alt="Image Description">
			<div class="card-body">
				<h4 class="card-title text-inherit">Leader</h4>
				<p class="card-text small text-body">Kelola data mengenai leadermu</p>
			</div>
		</a>
		<!-- End Card -->
	</div>
	<!-- End Col -->
	<div class="col mb-4">
		<!-- Card -->
		<a class="card card-sm card-transition h-100" href="<?= site_url('admin/kelola-staff'); ?>"
			data-aos="fade-up">
			<img class="card-img p-2" src="<?= base_url(); ?>assets/svg/design-system/docs-toasts.svg"
				alt="Image Description">
			<div class="card-body">
				<h4 class="card-title text-inherit">Staff</h4>
				<p class="card-text small text-body">Kelola data mengenai staffmu</p>
			</div>
		</a>
		<!-- End Card -->
	</div>
	<!-- End Col -->
</div>