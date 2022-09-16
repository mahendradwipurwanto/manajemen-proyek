<!-- Page Header -->
<div class="docs-page-header">
	<div class="row align-items-center">
		<div class="col-sm">
			<h1 class="docs-page-header-title">Staff
				<button type="button" class="btn btn-xs btn-soft-primary float-end" data-bs-toggle="modal"
					data-bs-target="#tambah">Tambah staff</button>
				<button type="button" class="btn btn-xs btn-outline-secondary float-end me-2" data-bs-toggle="modal"
					data-bs-target="#undang"><i class="bi bi-link-45deg"></i> Undang staff</button>
				<a href="<?= site_url('admin/pengaturan?p=jabatan');?>"
					class="btn btn-xs btn-soft-info float-end me-2">Jabatan</a>
			</h1>
			<p class="docs-page-header-text">Kelola semua akun staff yang telah terdaftar pada website</p>
		</div>
	</div>
</div>
<!-- End Page Header -->
<div class="row mb-4">
	<div class="col-md-3 col-sm-12">
		<div class="card">
			<div class="card-body p-4">
				<div class="h6">Total staff</div>
				<div style="position: absolute;right: 15px;bottom: 0px;">
					<h1 class="h1"><?= number_format($countStaff['totalStaff'],0,",",".")?></h1>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-3 col-sm-12">
		<div class="card">
			<div class="card-body p-4">
				<div class="h6">Aktif staff</div>
				<div style="position: absolute;right: 15px;bottom: 0px;">
					<h1 class="h1"><?= number_format($countStaff['aktifStaff'],0,",",".")?></h1>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-3 col-sm-12">
		<div class="card">
			<div class="card-body p-4">
				<div class="h6">Idle</div>
				<div style="position: absolute;right: 15px;bottom: 0px;">
					<h1 class="h1"><?= number_format($countStaff['idleStaff'],0,",",".")?></h1>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-3 col-sm-12">
		<div class="card">
			<div class="card-body p-4">
				<div class="h6">Akun non-aktif</div>
				<div style="position: absolute;right: 15px;bottom: 0px;">
					<h1 class="h1"><?= number_format($countStaff['suspendStaff'],0,",",".")?></h1>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Card -->
<div class="card">
	<!-- Table -->
	<div class="card-body p-4">
		<table class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table"
			id="table">
			<thead class="thead-light">
				<tr>
					<th width="5%">No</th>
					<th>Nama</th>
					<th>Status staff</th>
					<th>Total Proyek</th>
					<th>Proyek aktif</th>
					<th>Task</th>
					<th style="width: 5%;"></th>
				</tr>
			</thead>

			<tbody>
				<?php if(!empty($staff)):?>
				<?php $no=1;foreach($staff as $key => $val):?>
				<tr>
					<td><?= $no++;?>.</td>
					<td>
						<div class="d-flex align-items-center">
							<div class="flex-shrink-0">
								<img class="avatar avatar-sm avatar-circle" src="<?= base_url();?><?= $val->profil;?>"
									alt="Profil">
							</div>

							<div class="flex-grow-1 ms-3">
								<a class="d-inline-block link-dark" href="#">
									<h6 class="text-hover-primary mb-0"><?= $val->nama;?></h6>
								</a>
								<small
									class="d-block"><?= isset($val->jabatan) || $val->jabatan != null ? $val->jabatan : '-';?></small>
							</div>
						</div>
					</td>
					<td>
						<span
							class="badge bg-soft-<?= $val->status_staff == 1 ? 'secondary' : 'primary';?>"><?= $val->status_staff == 1 ? 'idle' : 'mengerjakan task';?></span>
					</td>
					<td>
						<span data-bs-toggle="modal" data-bs-target="#listAllProyek-<?= $val->user_id;?>"><span
								data-bs-toggle="tooltip" data-bs-html="true"
								title="Lihat daftar total proyek"><b><?= count($val->proyek_all);?></b>
								Proyek</span></span>
					</td>
					<td>
						<span data-bs-toggle="modal" data-bs-target="#listAktifProyek-<?= $val->user_id;?>"><span
								data-bs-toggle="tooltip" data-bs-html="true"
								title="Lihat daftar proyek aktif"><b><?= count($val->proyek_aktif);?></b>
								Proyek</span></span>
					</td>
					<td>
						<span data-bs-toggle="modal" data-bs-target="#listTask-<?= $val->user_id;?>"><span
								data-bs-toggle="tooltip" data-bs-html="true"
								title="Lihat daftar proyek aktif"><b><?= $val->total_task;?></b> Task</span></span>

					</td>
					<td>
						<button type="button" class="btn btn-xs btn-soft-success mr-2" data-bs-toggle="modal"
							data-bs-target="#assign-<?= $val->user_id;?>">assign / tugaskan</button>
						<button type="button" class="btn btn-xs btn-soft-primary" data-bs-toggle="modal"
							data-bs-target="#detail-<?= $val->user_id;?>">detail</button>
					</td>
				</tr>

				<!-- Modal -->
				<div id="listAllProyek-<?= $val->user_id;?>" class="modal fade" tabindex="-1" role="dialog"
					aria-labelledby="modalTambah" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="modalTambah">Daftar riwayat proyek</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal"
									aria-label="Close"></button>
							</div>
							<div class="modal-body">
								<?php if(!empty($val->proyek_all)):?>
								<!-- List Striped -->
								<ul class="list-group list-group-lg w-100 mx-0"
									style="max-height: 300px; overflow: auto;">
									<?php foreach($val->proyek_all as $keys => $value):?>
									<li class="list-group-item py-2">
										<div class="row justify-content-between">
											<div class="col-sm-6 mb-2 mb-sm-0">
												<span class="h6"><?= $value->judul;?></span>
											</div>
											<!-- End Col -->

											<!-- End Col -->
											<div class="col-sm-4 mb-2 mb-sm-0">
												<?php if($value->status == 1):?>
												<span class="badge bg-soft-primary">aktif dalam proyek</span>
												<?php else:?>
												<span class="badge bg-soft-secondary">nonaktif / dikeluarkan</span>
												<?php endif;?>
											</div>
											<!-- End Col -->
										</div>
										<!-- End Row -->
									</li>
									<?php endforeach;?>
								</ul>
								<!-- End List Striped -->
								<?php else:?>
								<div class="alert alert-secondary mb-0">
									Belum ada proyek
								</div>
								<?php endif;?>
							</div>
						</div>
					</div>
				</div>
				<!-- End Modal -->

				<!-- Modal -->
				<div id="listAktifProyek-<?= $val->user_id;?>" class="modal fade" tabindex="-1" role="dialog"
					aria-labelledby="modalTambah" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="modalTambah">Daftar proyek aktif</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal"
									aria-label="Close"></button>
							</div>
							<div class="modal-body">
								<?php if(!empty($val->proyek_aktif)):?>
								<!-- List Striped -->
								<ul class="list-group list-group-lg w-100 mx-0"
									style="max-height: 300px; overflow: auto;">
									<?php foreach($val->proyek_aktif as $keys => $value):?>
									<li class="list-group-item py-2">
										<div class="row justify-content-between">
											<div class="col-sm-6 mb-2 mb-sm-0">
												<span class="h6"><?= $value->judul;?></span>
											</div>
											<!-- End Col -->

											<!-- End Col -->
											<div class="col-sm-4 mb-2 mb-sm-0">
												<?php if($value->status == 1):?>
												<span class="badge bg-soft-primary">aktif dalam proyek</span>
												<?php else:?>
												<span class="badge bg-soft-secondary">nonaktif / dikeluarkan</span>
												<?php endif;?>
											</div>
											<!-- End Col -->
										</div>
										<!-- End Row -->
									</li>
									<?php endforeach;?>
								</ul>
								<!-- End List Striped -->
								<?php else:?>
								<div class="alert alert-secondary mb-0">
									Belum ada proyek
								</div>
								<?php endif;?>
							</div>
						</div>
					</div>
				</div>
				<!-- End Modal -->

				<!-- Modal -->
				<div id="assign-<?= $val->user_id;?>" class="modal fade" tabindex="-1" role="dialog"
					aria-labelledby="modalTambah" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="modalTambah">Tugaskan staff ke proyek</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal"
									aria-label="Close"></button>
							</div>
							<div class="modal-body">

								<!-- Form -->
								<div class="mb-3">
									<form action="<?= site_url('api/proyek/assignstaff');?>" method="post"
										class="js-validate need-validate" novalidate>
										<input type="hidden" name="staff_id" value="<?= $val->user_id;?>">
										<label class="form-label" for="formEmail">Proyek</label>
										<div class="row">
											<div class="col-8">
												<div class="tom-select-custom">
													<select class="js-select form-select form-select-sm"
														autocomplete="off" name="proyek_id" data-hs-tom-select-options='{
															"placeholder": "Pilih proyek"
														}' required>
														<?php if(!empty($proyek)):?>
														<?php foreach($proyek as $keys => $value):?>
														<option value="<?= $value->id;?>"><?= $value->judul;?></option>
														<?php endforeach;?>
														<?php endif;?>
													</select>
												</div>
											</div>
											<div class="col-4">
												<button type="submit"
													class="btn btn-sm btn-primary w-100">Tugaskan</button>
											</div>
										</div>
										<small class="text-secondary">Tugaskan staff ke proyek yang diinginkan</small>
									</form>
								</div>
								<?php if(!empty($val->proyek_aktif)):?>
								<hr>
								<!-- End Form -->
								<div class="modal-footer border-none p-0">
									<!-- List Striped -->
									<ul class="list-group list-group-lg w-100 mx-0"
										style="max-height: 300px; overflow: auto;">
										<?php foreach($val->proyek_aktif as $keys => $value):?>
										<li class="list-group-item py-2">
											<div class="row justify-content-between">
												<div class="col-sm-6 mb-2 mb-sm-0">
													<span class="h6"><?= $value->judul;?></span>
												</div>
												<!-- End Col -->

												<!-- End Col -->
												<div class="col-sm-4 mb-2 mb-sm-0">
													<?php if($value->status == 1):?>
													<span class="badge bg-soft-primary">proses pengerjaan</span>
													<?php else:?>
													<span class="badge bg-soft-secondary">arsip</span>
													<?php endif;?>
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
				<div id="listTask-<?= $val->user_id;?>" class="modal fade" tabindex="-1" role="dialog"
					aria-labelledby="modalTambah" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="modalTambah">Daftar task staff</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal"
									aria-label="Close"></button>
							</div>
							<div class="modal-body">
								<?php if(!empty($val->tasks)):?>
								<!-- List Striped -->
								<ul class="list-group list-group-lg w-100 mx-0"
									style="max-height: 300px; overflow: auto;">
									<?php foreach($val->tasks as $keys => $value):?>
									<li class="list-group-item py-2">
										<div class="row justify-content-between">
											<div class="col-sm-6 mb-2 mb-sm-0">
												<span class="h6"><?= $value->task;?></span>
											</div>
											<!-- End Col -->
										</div>
										<!-- End Row -->
									</li>
									<?php endforeach;?>
								</ul>
								<!-- End List Striped -->
								<?php else:?>
								<div class="alert alert-secondary mb-0">
									Belum ada task
								</div>
								<?php endif;?>
							</div>
						</div>
					</div>
				</div>
				<!-- End Modal -->

				<!-- Modal -->
				<div id="detail-<?= $val->user_id;?>" class="modal fade" tabindex="-1" role="dialog"
					aria-labelledby="modalTambah" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="modalTambah">detail</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal"
									aria-label="Close"></button>
							</div>
							<div class="modal-body">
								<div class="mb-3">
									<!-- Media -->
									<div class="d-flex align-items-lg-center">
										<div class="flex-shrink-0">
											<img class="avatar avatar-xl avatar-circle"
												src="<?= base_url();?><?= $val->profil;?>" alt="Image Description">
										</div>

										<div class="flex-grow-1 ms-4">
											<div class="row">
												<div class="col-lg mb-3 mb-lg-0">
													<h1 class="page-header-title h2"><?= $val->nama;?></h1>

													<ul class="list-inline list-separator">
														<li class="list-inline-item">
															<i class="bi-envelope text-primary me-1"></i>
															<?= mb_substr($val->email, 0, 4) ?>***@<?php $mail = explode("@", $val->email);echo $mail[1]; ?>
														</li>
													</ul>
												</div>
												<!-- End Col -->

												<div class="col-lg-auto align-self-lg-end text-lg-right">
													<div class="d-flex gap-2">
														<a class="btn btn-primary btn-sm"
															href="mailto:<?= $val->email;?>">
															<i class="bi-envelope-fill me-1"></i> Pesan
														</a>
													</div>
												</div>
												<!-- End Col -->
											</div>
											<!-- End Row -->
										</div>
									</div>
									<!-- End Media -->
								</div>
								<hr>
								<div class="row">
									<div class="col-6">
										<ul class="list-unstyled list-py-1">
											<li><i class="bi-briefcase dropdown-item-icon"></i>
												<?= isset($val->jabatan) || $val->jabatan != null ? $val->jabatan : '-';?>
											</li>
											<li><i class="bi-box-seam dropdown-item-icon"></i>
												<?= count($val->proyek_aktif)+count($val->proyek_arsip);?> Proyek</li>
										</ul>
									</div>
									<div class="col-6">
										<ul class="list-unstyled list-py-1">
											<li><i class="bi-chat-left-dots dropdown-item-icon"></i>
												<?= $val->total_task;?> task</li>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- End Modal -->


				<?php endforeach;?>
				<?php endif;?>
			</tbody>
		</table>
	</div>
	<!-- End Table -->
</div>
<!-- End Card -->
<!-- Modal -->
<div id="tambah" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalTambah" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modalTambah">Tambah Staff</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form action="<?= site_url('api/staff/tambahStaff');?>" method="post"
					class="js-validate needs-validation" novalidate>
					<!-- Form -->
					<div class="mb-3">
						<label class="form-label" for="formNama">Nama</label>
						<input type="text" name="nama" id="formNama" class="form-control form-control-sm"
							placeholder="Nama staff" required>
					</div>
					<!-- End Form -->

					<!-- Form -->
					<div class="mb-3">
						<label class="form-label" for="formEmail">Jabatan</label>
						<div class="row">
							<div class="col-md-10">
								<!-- Select -->
								<div class="tom-select-custom">
									<select class="js-select form-select form-select-sm" autocomplete="off"
										name="jabatan" data-hs-tom-select-options='{"placeholder": "Pilih jabatan..."}'
										<?php if(empty($jabatan)):?>disabled<?php endif;?>>
										<?php if(!empty($jabatan)):?>
										<?php foreach($jabatan as $key => $val):?>
										<option value="<?= $val->id;?>"><?= $val->jabatan;?></option>
										<?php endforeach;?>
										<?php else:?>
										<option>Tambahkan jabatan</option>
										<?php endif;?>
									</select>
								</div>
								<!-- End Select -->
							</div>
							<div class="col-md-2">
								<a href="<?= site_url('admin/pengaturan?p=jabatan');?>"
									class="btn btn-sm btn-primary w-100"><i class="bi bi-plus"></i></a>
							</div>
						</div>
					</div>
					<!-- End Form -->

					<!-- Form -->
					<div class="mb-3">
						<label class="form-label" for="formEmail">Email</label>
						<input type="email" name="email" id="formEmail" class="form-control form-control-sm"
							placeholder="Email staff" required>
						<small class="text-secondary">Pengguna akan mendapatkan email pemberitahuan telah ditambahkan
							sebagai staff</small>
					</div>
					<!-- End Form -->

					<!-- Form -->
					<div class="mb-3">
						<label class="form-label" for="signupHeroFormSignupPassword">Password</label>
						<input type="password" class="form-control form-control-lg" name="password"
							id="signupHeroFormSignupPassword" placeholder="8+ karakter diperlukan"
							aria-label="8+ characters required" required>
						<span class="invalid-feedback">Masukkan password valid dengan benar</span>
					</div>
					<!-- End Form -->

					<!-- From -->
					<div class="mb-3" data-hs-validation-validate-class>
						<label class="form-label" for="daftarKonfirmasiPassword">Konfirmasi password</label>
						<input type="password" class="form-control form-control-lg" name="confirmPassword"
							id="daftarKonfirmasiPassword" placeholder="8+ characters required"
							aria-label="8+ characters required" required
							data-hs-validation-equal-field="#signupHeroFormSignupPassword">
						<span class="invalid-feedback">Password tidak sama</span>
					</div>
					<!-- End From -->
					<div class="modal-footer p-0 pt-3">
						<button type="button" class="btn btn-sm btn-white" data-bs-dismiss="modal">Batal</button>
						<button type="submit" class="btn btn-sm btn-primary">Tambahkan</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- End Modal -->

<!-- Modal -->
<div id="undang" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalTambah" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modalTambah">Undang</h5>
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
