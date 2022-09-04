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
				<button type="button" class="btn btn-sm btn-soft-primary float-end me-3" data-bs-toggle="modal"
					data-bs-target="#tambah">Buat Proyek Baru</button>
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

					<!-- Modal -->
					<div id="tambah-staff" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalTambah"
						aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="modalTambah">Assign Staff</h5>
									<button type="button" class="btn-close" data-bs-dismiss="modal"
										aria-label="Close"></button>
								</div>
								<div class="modal-body">
									<!-- Form -->
									<div class="mb-3">
										<form action="<?= site_url('api/proyek/assignStaffBulk');?>" method="post"
											class="js-validate need-validate" novalidate>
											<input type="hidden" name="proyek_id" value="<?= $val->id;?>">
											<label class="form-label" for="formEmail">Staff</label>
											<div class="row">
												<div class="col-9">
													<div class="tom-select-custom tom-select-custom-with-tags">
														<select class="js-select form-select form-select-sm"
															autocomplete="off" multiple name="staff[]"
															data-hs-tom-select-options='{"placeholder": "Pilih staff"}'>
															<?php if(!empty($val->staff_free)):?>
															<?php foreach($val->staff_free as $k => $v):?>
															<option value="<?= $v->user_id;?>"><?= $v->nama;?>
															</option>
															<?php endforeach;?>
															<?php else:?>
															<option>Tidak ada staff yang tersedia</option>
															<?php endif;?>
														</select>
													</div>
												</div>
												<div class="col-3">
													<button type="submit"
														class="btn btn-sm btn-primary w-100">Undang</button>
												</div>
											</div>
											<small class="text-secondary">Staff akan menerima pemberitahuan saat
												ditambahkan kedalam proyek</small>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- End Modal -->
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


<!-- Modal -->
<div id="tambah" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalTambah" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modalTambah">Buat Proyek Baru</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form action="<?= site_url('api/proyek/save');?>" method="post" class="js-validate needs-validation"
					novalidate>
					<!-- Form -->
					<div class="mb-3 row">
						<div class="col-8">
							<label class="form-label" for="formJudul">Nama Proyek <small
									class="text-danger">*</small></label>
							<input type="text" name="judul" id="formJudul" class="form-control form-control-sm"
								placeholder="Judul Proyek" required>
						</div>
						<div class="col-4">
							<label class="form-label" for="formKode">Kode Proyek <small class="text-danger">*</small> <i
									class="bi bi-info-square-fill" data-bs-toggle="tooltip" data-bs-html="true"
									title="Pilih kode sebagai kunci/id proyek anda untuk mengenali pekerjaan dari proyek ini."></i></label>
							<input type="text" name="kode" id="formKode" class="form-control form-control-sm alphanum"
								placeholder="Ex: PYK01" value="PYK0<?= (count($proyekAktif)+count($proyekAktif));?>"
								required>
						</div>
					</div>
					<div class="mb-3 row">
						<div class="col-6">
							<label class="form-label" for="formPeriodeMulai">Periode Mulai <small
									class="text-danger">*</small></label>
							<input type="date" name="periode_mulai" id="formPeriodeMulai"
								class="form-control form-control-sm" value="<?= date('Y-m-d');?>" required>
						</div>
						<div class="col-6">
							<label class="form-label" for="formPeriodeSelesai">Periode Selesai <small
									class="text-danger">*</small></label>
							<input type="date" name="periode_selesai" id="formPeriodeSelesai"
								class="form-control form-control-sm" value="<?= date('Y-m-d', strtotime('+1 month'));?>"
								required>
						</div>
						<div class="col-12 mt-3">
							<div class="alert alert-soft-primary mb-0">
								<small class="text-secondary">Periode mulai dan selesai digunakan sebagai acuan laporan
									mengenai ketepatan waktu penyelesaian proyek, anda dapat mengubah hal ini nanti jika
									terjadi kendala saat proses pengerjaan berlangsung</small>
							</div>
						</div>
					</div>

					<div class="mb-3">
						<label for="formKeterangan" class="form-label">Staff <small
								class="text-secondary">(optional)</small></label>
						<div class="tom-select-custom tom-select-custom-with-tags">
							<select class="js-select form-select form-select-sm" autocomplete="off" multiple
								name="staff[]" data-hs-tom-select-options='{"placeholder": "Pilih staff"}'>
								<?php if(!empty($staff)):?>
								<?php foreach($staff as $key => $val):?>
								<option value="<?= $val->user_id;?>"><?= $val->nama;?></option>
								<?php endforeach;?>
								<?php else:?>
								<option>Belum ada staff yang tersedia</option>
								<?php endif;?>
							</select>
						</div>
						<small class="text-secondary">Anda dapat menambahkan staff nanti</small>
					</div>

					<div class="mb-3">
						<label for="formKeterangan" class="form-label">Keterangan <small
								class="text-secondary">(optional)</small></label>
						<textarea name="keterangan" class="form-control form-control-sm" id="formKeterangan" rows="3"
							placeholder="Keterangan"></textarea>
					</div>
					<!-- End Form -->
					<div class="modal-footer p-0 pt-3">
						<button type="button" class="btn btn-sm btn-white" data-bs-dismiss="modal">Batal</button>
						<button type="submit" class="btn btn-sm btn-primary">Buat Proyek</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- End Modal -->
