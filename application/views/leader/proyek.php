<!-- Page Header -->
<div class="docs-page-header">
	<div class="row align-items-center">
		<div class="col-sm">
			<h1 class="docs-page-header-title">Proyek
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
				<button type="button" class="btn btn-sm btn-primary float-end me-3" data-bs-toggle="modal"
					data-bs-target="#tambah">Buat Proyek Baru</button>
			</h1>
			<p class="docs-page-header-text">Pantau semua yang sudah dibuat pada website</p>
		</div>
	</div>
</div>
<!-- End Page Header -->

<div class="row">
	<!-- <div class="col-md-3">
		<div class="card card-sm card-transition shadow-sm">
			<img class="card-img-top" src="<?= base_url();?>assets/svg/components/card-8.svg" alt="Image Description">
			<div class="card-body">
				<h4 class="card-title">Atlassian</h4>
				<p class="card-text small">Developer tools</p>

				<div class="d-grid">
					<a class="btn btn-primary btn-sm" href="#">Kelola Proyek</a>
				</div>
			</div>
		</div>
	</div> -->
	<div class="col-md-12">
		<div class="project-boxes jsGridView">
			<?php if(!empty($proyek)):?>
			<?php foreach($proyek as $key => $val):?>
			<div class="project-box-wrapper">
				<div class="project-box" style="background-color: #fee4cb;">
					<div class="project-box-header">
						<span><?= date("d F Y", $val->created_at);?></span>
					</div>
					<div class="project-box-content-header">
						<p class="box-content-header"><?= $val->judul;?></p>
						<p class="box-content-subheader"><?= substr($val->keterangan, 0, 150);?></p>
					</div>
					<div class="box-progress-wrapper">
						<p class="box-progress-header">Progress</p>
						<div class="box-progress-bar">
							<span class="box-progress" style="width: 60%; background-color: #ff942e"></span>
						</div>
						<p class="box-progress-percentage">60%</p>
					</div>
					<div class="project-box-footer">
						<div class="participants">
							<img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=2550&q=80"
								alt="participant">
							<img src="https://images.unsplash.com/photo-1503023345310-bd7c1de61c7d?ixid=MXwxMjA3fDB8MHxzZWFyY2h8MTB8fG1hbnxlbnwwfHwwfA%3D%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=900&q=60"
								alt="participant">
							<button class="add-participant" style="color: #ff942e;" data-bs-toggle="modal"
								data-bs-target="#tambah-staff">
								<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24"
									fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round"
									stroke-linejoin="round" class="feather feather-plus">
									<path d="M12 5v14M5 12h14" />
								</svg>
							</button>
						</div>
						<a href="<?= site_url('proyek/kelola/'.$val->kode);?>" class="days-left" style="color: #ff942e;">
							kelola proyek
						</a>
					</div>
				</div>
			</div>
			<?php endforeach;?>
			<?php endif;?>
		</div>
	</div>
</div>

<!-- Modal -->
<div id="tambah-staff" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalTambah" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modalTambah">Tambah Staff</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<!-- Form -->
				<div class="mb-3">
					<form action="<?= site_url('api/staff/undang');?>" method="post" class="js-validate need-validate"
						novalidate>
						<label class="form-label" for="formEmail">Email</label>
						<div class="row">
							<div class="col-8">
								<input type="email" name="email" id="formEmail" class="form-control form-control-sm"
									placeholder="Email staff" required>
							</div>
							<div class="col-4">
								<button type="submit" class="btn btn-sm btn-primary w-100">Undang</button>
							</div>
						</div>
						<small class="text-secondary">Pengguna akan mendapatkan email pemberitahuan telah diundang
							sebagai staff</small>
					</form>
				</div>
				<?php if(!empty($undanganStaff)):?>
				<hr>
				<!-- End Form -->
				<div class="modal-footer p-0 pt-3" style="border-top: none">
					<!-- List Striped -->
					<ul class="list-group list-group-lg w-100 mx-0" style="max-height: 300px; overflow: auto;">
						<?php foreach($undanganStaff as $key => $val):?>
						<li class="list-group-item">
							<div class="row justify-content-between">
								<div class="col-sm-6 mb-2 mb-sm-0">
									<span
										class="h6"><?= mb_substr($val->email, 0, 4) ?>***@<?php $mail = explode("@", $val->email);echo $mail[1]; ?></span>
								</div>
								<!-- End Col -->


								<!-- End Col -->

								<div class="col-sm-4 mb-2 mb-sm-0">
									<?php if($val->status == 1):?>
									<span class="badge bg-secondary">pending</span>
									<?php else:?>
									<span class="badge bg-success">joined</span>
									<?php endif;?>
								</div>
								<!-- End Col -->

								<div class="col-sm-2 text-sm-end">
									<a href="<?= site_url('api/staff/kirimUndangan/'.$val->email);?>"><i
											class="bi bi-envelope"></i></a>
								</div>
								<!-- End Col -->
							</div>
							<!-- End Row -->
						</li>
						<?php endforeach;?>
					</ul>
					<!-- End List Striped -->
				</div>
				<?php endif;?>
			</div>
		</div>
	</div>
</div>
<!-- End Modal -->



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
					<div class="alert alert-soft-primary">
						<p class="mb-0 small">Fitur ini masih dalam pengembangan, kebutuhan informasi pada proyek akan
							bertambah seiring berjalannya waktu</p>
					</div>
					<!-- Form -->
					<div class="mb-3">
						<label class="form-label" for="formJudul">Judul Proyek</label>
						<input type="text" name="judul" id="formJudul" class="form-control" placeholder="Judul Proyek"
							required>
					</div>
					<div class="mb-3 row">
						<div class="col-6">
							<label class="form-label" for="formPeriodeMulai">Periode Mulai</label>
							<input type="date" name="periode_mulai" id="formPeriodeMulai" class="form-control"
								placeholder="Periode Mulai" required>
						</div>
						<div class="col-6">
							<label class="form-label" for="formPeriodeSelesai">Periode Selesai</label>
							<input type="date" name="periode_selesai" id="formPeriodeSelesai" class="form-control"
								placeholder="Periode Selesai" required>
						</div>
					</div>

					<div class="mb-3">
						<label for="formKeterangan" class="form-label">Keterangan</label>
						<textarea name="keterangan" class="form-control" id="formKeterangan" rows="3"
							placeholder="Keterangan" required>

						</textarea>
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
