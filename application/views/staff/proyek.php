<!-- Page Header -->
<div class="docs-page-header <?php if ($this->agent->is_mobile()):?>mb-0<?php endif;?>">
	<div class="row align-items-center">
		<div class="col-sm">
			<h1 class="docs-page-header-title">Kelola Proyek
			</h1>
			<p class="docs-page-header-text">Kelola semua proyek yang pernah anda buat pada halaman ini</p>
		</div>
	</div>
</div>
<!-- End Page Header -->

<div class="row">
	<div class="col-md-12">
		<!-- Nav -->
		<div class="d-flex justify-content-between align-items-center mb-3">
			<ul class="nav nav-segment w-auto" role="tablist">
				<li class="nav-item">
					<a class="nav-link active" id="proyek-aktif-tab" href="#proyek-aktif" data-bs-toggle="pill"
						data-bs-target="#proyek-aktif" role="tab" aria-controls="proyek-aktif"
						aria-selected="true">Proyek Aktif</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" id="riwayat-proyek-tab" href="#riwayat-proyek" data-bs-toggle="pill"
						data-bs-target="#riwayat-proyek" role="tab" aria-controls="riwayat-proyek"
						aria-selected="false">Riwayat Proyek</a>
				</li>
			</ul>
			<span>Anda memiliki <b><?= count($proyekAktif);?></b> proyek aktif, yang siap anda kelola bersama tim
				anda</span>
			<div class="w-auto">
				<button type="button" class="view-btn grid-view float-end active">
					<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
						stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
						class="feather feather-grid">
						<rect x="3" y="3" width="7" height="7" />
						<rect x="14" y="3" width="7" height="7" />
						<rect x="14" y="14" width="7" height="7" />
						<rect x="3" y="14" width="7" height="7" /></svg>
				</button>
				<button type="button" class="view-btn list-view float-end ">
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
						stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
						class="feather feather-list">
						<line x1="8" y1="6" x2="21" y2="6" />
						<line x1="8" y1="12" x2="21" y2="12" />
						<line x1="8" y1="18" x2="21" y2="18" />
						<line x1="3" y1="6" x2="3.01" y2="6" />
						<line x1="3" y1="12" x2="3.01" y2="12" />
						<line x1="3" y1="18" x2="3.01" y2="18" /></svg>
				</button>
			</div>
		</div>
		<!-- End Nav -->

		<!-- Tab Content -->
		<div class="tab-content">
			<div class="tab-pane fade show active" id="proyek-aktif" role="tabpanel" aria-labelledby="proyek-aktif-tab">
				<div class="project-boxes jsGridView">
					<?php if(!empty($proyekAktif)):?>
					<?php foreach($proyekAktif as $key => $val):?>
					<?php $rand = rand(1, 6);
						if($rand == 1){
							$color = 'warning';
						}elseif($rand == 2){
							$color = 'danger';
						}elseif($rand == 3){
							$color = 'success';
						}elseif($rand == 4){
							$color = 'purple';
						}elseif($rand == 5){
							$color = 'info';
						}else{
							$color = 'primary';
						}
					?>
					<div class="project-box-wrapper">
						<div class="project-box bg-soft-<?= $color;?>">
							<div class="project-box-header">
								<span>Dibuat pada, <?= date("d F Y", $val->created_at);?></span>
							</div>
							<div class="project-box-content-header">
								<p class="box-content-header"><?= $val->judul;?></p>
							</div>
							<div class="box-progress-wrapper">
								<p class="box-progress-header">Progress</p>
								<div class="box-progress-bar">
									<span class="box-progress bg-<?= $color;?>" style="width: 0%;"></span>
								</div>
								<p class="box-progress-percentage">0%</p>
							</div>
							<div class="project-box-footer">
								<div class="participants">
									<?php if(!empty($val->staff)):?>
									<?php foreach($val->staff as $k => $v):?>
									<img src="<?= base_url();?><?= $v->profil;?>" alt="<?= $v->nama;?>"
										data-bs-toggle="tooltip" data-bs-html="true" title="<?= $v->nama;?>">
									<?php endforeach;?>
									<?php endif;?>
								</div>
								<a href="<?= site_url('proyek/kelola/'.$val->kode);?>"
									class="days-left text-soft-<?= $color;?>">
									kelola proyek
								</a>
							</div>
						</div>
					</div>
					<?php endforeach;?>
					<?php else:?>
					<div class="w-100 text-center mt-5">
						<div class="alert alert-soft-secondary" role="alert">
							Anda belum memiliki satupun proyek aktif, ayo buat proyek baru bersama tim anda!
						</div>
					</div>
					<?php endif;?>
				</div>
			</div>

			<div class="tab-pane fade" id="riwayat-proyek" role="tabpanel" aria-labelledby="riwayat-proyek-tab">
				<div class="project-boxes jsGridView">
					<?php if(!empty($proyekArsip)):?>
					<?php foreach($proyekArsip as $key => $val):?>
					<?php $rand = rand(1, 6);
						if($rand == 1){
							$color = 'warning';
						}elseif($rand == 2){
							$color = 'danger';
						}elseif($rand == 3){
							$color = 'success';
						}elseif($rand == 4){
							$color = 'purple';
						}elseif($rand == 5){
							$color = 'info';
						}else{
							$color = 'primary';
						}
					?>
					<div class="project-box-wrapper">
						<div class="project-box bg-soft-<?= $color;?>">
							<div class="project-box-header">
								<span>Dibuat pada, <?= date("d F Y", $val->created_at);?></span>
							</div>
							<div class="project-box-content-header">
								<p class="box-content-header"><?= $val->judul;?></p>
							</div>
							<div class="box-progress-wrapper">
								<p class="box-progress-header">Progress</p>
								<div class="box-progress-bar">
									<span class="box-progress text-soft-<?= $color;?>" style="width: 60%;"></span>
								</div>
								<p class="box-progress-percentage">0%</p>
							</div>
							<div class="project-box-footer">
								<div class="participants">
									<?php if(!empty($val->staff)):?>
									<?php foreach($val->staff as $k => $v):?>
									<img src="<?= base_url();?><?= $v->profil;?>" alt="<?= $v->nama;?>"
										data-bs-toggle="tooltip" data-bs-html="true" title="<?= $v->nama;?>">
									<?php endforeach;?>
									<?php endif;?>
									<button class="add-participant text-soft-<?= $color;?>" data-bs-toggle="modal"
										data-bs-target="#tambah-staff">
										<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12"
											viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"
											stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus">
											<path d="M12 5v14M5 12h14" />
										</svg>
									</button>
								</div>
								<a href="<?= site_url('proyek/kelola/'.$val->kode);?>"
									class="days-left text-soft-<?= $color;?>">
									kelola proyek
								</a>
							</div>
						</div>
					</div>
					<?php endforeach;?>
					<?php else:?>
					<div class="w-100 text-center mt-5">
						<div class="alert alert-soft-secondary" role="alert">
							Anda belum memiliki satupun proyek yang terselesaikan
						</div>
					</div>
					<?php endif;?>
				</div>
			</div>
		</div>
		<!-- End Tab Content -->


	</div>
</div>
