<!-- Page Header -->
<div class="docs-page-header">
	<div class="row align-items-center">
		<div class="col-sm">
			<h1 class="docs-page-header-title">Proyek
				<a href="<?= site_url('proyek/kelola-task/');?>" class="btn btn-sm btn-primary float-end me-2">Kelola Task</a>
				<a href="<?= site_url('leader/kelola-proyek');?>" class="btn btn-sm btn-light float-end me-3"
					data-bs-toggle="modal" data-bs-target="#tambah">kembali</a>
			</h1>
			<p class="docs-page-header-text">Pantau semua yang sudah dibuat pada website</p>
		</div>
	</div>
</div>
<!-- End Page Header -->

<div class="row">
	<div class="col-md-8">
		<div class="card">
			<div class="card-header">
				<h3 class="card-title mb-0">Kelola Staff
					<button type="button" class="btn btn-sm btn-primary float-end" data-bs-toggle="modal"
						data-bs-target="#tambah-staff">Tugaskan Staff</button>
				</h3>
			</div>
			<div class="card-body">
				<table class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table"
					id="table">
					<thead class="thead-light">
						<tr>
							<th rowspan="2" width="5%">No</th>
							<th rowspan="2">Nama</th>
							<th rowspan="2">Status staff</th>
							<th colspan="3" class="text-center">Task</th>
							<th rowspan="2" style="width: 5%;"></th>
						</tr>
						<tr>
							<th>Total</th>
							<th>Progress</th>
							<th>Selesai</th>
						</tr>
					</thead>

					<tbody>
						<?php if(!empty($staff)):?>
						<?php $no=1;foreach($staff as $key => $val):?>
						<tr>
							<td><?= $no++;?>.</td>
							<td>
								<div class="d-flex align-items-center">
									<div class="flex-grow-1">
										<a class="d-inline-block link-dark" href="#">
											<h6 class="text-hover-primary mb-0"><?= $val->nama;?></h6>
										</a>
										<small
											class="d-block"><?= isset($val->jabatan) || $val->jabatan != null ? $val->jabatan : '-';?></small>
									</div>
								</div>
							</td>
							<td>
								<span class="badge bg-warning">idle</span>
							</td>
							<td>
								<b>12</b> Task
							</td>
							<td>
								<b>4</b> Task
							</td>
							<td>
								<b>54</b> Task
							</td>
							<td>
								<button type="button" class="btn btn-xs btn-success mr-2" data-bs-toggle="modal"
									data-bs-target="#keluar-<?= $val->user_id;?>">keluarkan</button>
								<button type="button" class="btn btn-xs btn-primary" data-bs-toggle="modal"
									data-bs-target="#detail-<?= $val->user_id;?>">detail</button>
							</td>
						</tr>

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
														src="<?= base_url();?><?= $val->profil;?>"
														alt="Image Description">
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
													<li><i class="bi-star dropdown-item-icon"></i> 4.87 Rating project
													</li>
													<li><i class="bi-play-circle dropdown-item-icon"></i> 29 project
													</li>
												</ul>
											</div>
											<div class="col-6">
												<ul class="list-unstyled list-py-1">
													<li><i class="bi-person dropdown-item-icon"></i> 23,912 staff</li>
													<li><i class="bi-chat-left-dots dropdown-item-icon"></i> 1,533 task
													</li>
												</ul>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- End Modal -->

						<!-- Modal -->
						<div id="keluar-<?= $val->user_id;?>" class="modal fade" tabindex="-1" role="dialog"
							aria-labelledby="modalTambah" aria-hidden="true">
							<div class="modal-dialog modal-dialog-centered" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="modalTambah">Keluarkan Staff</h5>
										<button type="button" class="btn-close" data-bs-dismiss="modal"
											aria-label="Close"></button>
									</div>
									<div class="modal-body">
										<form action="" method="post" class="js-validate needs-validation" novalidate>
											<p>Apakah anda yakin? ingin mengeluarkan <?= $val->nama;?> dari proyek ini?
											</p>
											<!-- End Form -->
											<div class="modal-footer p-0 pt-3">
												<button type="button" class="btn btn-sm btn-white"
													data-bs-dismiss="modal">Tidak</button>
												<button type="submit" class="btn btn-sm btn-danger">Ya</button>
											</div>
										</form>
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
		</div>
	</div>
	<div class="col-md-4">
		<div class="card">
			<div class="card-header">
				<h3 class="card-title mb-0">Kelola Status
					<button type="button" class="btn btn-sm btn-primary float-end" data-bs-toggle="modal"
						data-bs-target="#tambah-status">Tambah Status</button>
				</h3>
			</div>
			<div class="card-body">
				<ul class="list-group list-group-lg w-100" style="max-height: 300px; overflow: auto;">
					<li class="list-group-item">
						<div class="row justify-content-between">
							<div class="col-sm-6 mb-2 mb-sm-0">
								<span class="h5">(1) To Do</span>
							</div>
							<!-- End Col -->

							<!-- End Col -->
							<div class="col-sm-4 mb-2 mb-sm-0">
								<span class="badge bg-secondary">secondary</span>
							</div>
							<!-- End Col -->

							<div class="col-sm-2 text-sm-end">
								<span type="button" class="me-1 text-dark" data-bs-toggle="modal"
									data-bs-target="#ubah-status"><i class="bi bi-pencil"></i></span>
								<span type="button" class="text-dark" data-bs-toggle="modal"
									data-bs-target="#hapus-status"><i class="bi bi-trash"></i></span>
							</div>
							<!-- End Col -->
						</div>
						<!-- End Row -->
					</li>
					<li class="list-group-item">
						<div class="row justify-content-between">
							<div class="col-sm-6 mb-2 mb-sm-0">
								<span class="h5">(2) Pengerjaan</span>
							</div>
							<!-- End Col -->

							<!-- End Col -->
							<div class="col-sm-4 mb-2 mb-sm-0">
								<span class="badge bg-warning">warning</span>
							</div>
							<!-- End Col -->

							<div class="col-sm-2 text-sm-end">
								<span type="button" class="me-1 text-dark" data-bs-toggle="modal"
									data-bs-target="#ubah-status"><i class="bi bi-pencil"></i></span>
								<span type="button" class="text-dark" data-bs-toggle="modal"
									data-bs-target="#hapus-status"><i class="bi bi-trash"></i></span>
							</div>
							<!-- End Col -->
						</div>
						<!-- End Row -->
					</li>
					<li class="list-group-item">
						<div class="row justify-content-between">
							<div class="col-sm-6 mb-2 mb-sm-0">
								<span class="h5">(3) Selesai</span>
							</div>
							<!-- End Col -->

							<!-- End Col -->
							<div class="col-sm-4 mb-2 mb-sm-0">
								<span class="badge bg-success">success</span>
							</div>
							<!-- End Col -->

							<div class="col-sm-2 text-sm-end">
								<span type="button" class="me-1 text-dark" data-bs-toggle="modal"
									data-bs-target="#ubah-status"><i class="bi bi-pencil"></i></span>
								<span type="button" class="text-dark" data-bs-toggle="modal"
									data-bs-target="#hapus-status"><i class="bi bi-trash"></i></span>
							</div>
							<!-- End Col -->
						</div>
						<!-- End Row -->
					</li>


					<!-- Modal -->
					<div id="ubah-status" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalTambah"
						aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="modalTambah">Ubah Status Baru</h5>
									<button type="button" class="btn-close" data-bs-dismiss="modal"
										aria-label="Close"></button>
								</div>
								<div class="modal-body">
									<form action="" method="post" class="js-validate needs-validation" novalidate>
										<div class="alert alert-soft-primary">
											<p class="mb-0 small">Fitur ini masih dalam pengembangan, kebutuhan
												informasi pada proyek akan
												bertambah seiring berjalannya waktu</p>
										</div>
										<!-- Form -->
										<div class="mb-3">
											<label class="form-label" for="formJudul">Status</label>
											<input type="text" name="judul" id="formJudul" class="form-control"
												placeholder="Status Proyek" required>
											<small class="text-secondary">Seperti: Todo, Perancangan, Pengerjaan,
												Selesai</small>
										</div>

										<div class="mb-3">
											<label class="form-label" for="formJudul">Warna</label>
											<!-- Select -->
											<div class="tom-select-custom">
												<select class="js-select form-select" autocomplete="off" name="jabatan"
													data-hs-tom-select-options='{"placeholder": "Pilih Warna..."}'>
													<option value="secondary" class="badge bg-secondary">secondary
													</option>
													<option value="primary" class="badge bg-primary">primary</option>
													<option value="info" class="badge bg-info">info</option>
													<option value="warning" class="badge bg-warning">warning</option>
													<option value="danger" class="badge bg-danger">danger</option>
													<option value="success" class="badge bg-success">success</option>
												</select>
											</div>
											<!-- End Select -->
										</div>

										<div class="mb-3">
											<label for="formKeterangan" class="form-label">Keterangan</label>
											<textarea name="keterangan" class="form-control" id="formKeterangan"
												rows="3" placeholder="Keterangan" required></textarea>
											<small class="text-secondary">Tambahkan jika diperlukan</small>
										</div>
										<!-- End Form -->
										<div class="modal-footer p-0 pt-3">
											<button type="button" class="btn btn-sm btn-white"
												data-bs-dismiss="modal">Batal</button>
											<button type="submit" class="btn btn-sm btn-primary">Ubah Status</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
					<!-- End Modal -->

					<!-- Modal -->
					<div id="hapus-status" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalTambah"
						aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="modalTambah">Hapus Status Baru</h5>
									<button type="button" class="btn-close" data-bs-dismiss="modal"
										aria-label="Close"></button>
								</div>
								<div class="modal-body">
									<form action="" method="post" class="js-validate needs-validation" novalidate>
										<p>Apakah anda yakin? ingin menghapus status ini?</p>
										<!-- End Form -->
										<div class="modal-footer p-0 pt-3">
											<button type="button" class="btn btn-sm btn-white"
												data-bs-dismiss="modal">Tidak</button>
											<button type="submit" class="btn btn-sm btn-danger">Ya</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
					<!-- End Modal -->
				</ul>
			</div>
		</div>
	</div>
</div>


<!-- Modal -->
<div id="tambah-status" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalTambah" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modalTambah">Tambah Status Baru</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form action="" method="post" class="js-validate needs-validation" novalidate>
					<div class="alert alert-soft-primary">
						<p class="mb-0 small">Fitur ini masih dalam pengembangan, kebutuhan informasi pada proyek akan
							bertambah seiring berjalannya waktu</p>
					</div>
					<!-- Form -->
					<div class="mb-3">
						<label class="form-label" for="formJudul">Status</label>
						<input type="text" name="judul" id="formJudul" class="form-control" placeholder="Status Proyek"
							required>
						<small class="text-secondary">Seperti: Todo, Perancangan, Pengerjaan, Selesai</small>
					</div>

					<div class="mb-3">
						<label class="form-label" for="formJudul">Warna</label>
						<!-- Select -->
						<div class="tom-select-custom">
							<select class="js-select form-select" autocomplete="off" name="jabatan"
								data-hs-tom-select-options='{"placeholder": "Pilih Warna..."}'>
								<option value="secondary" class="badge bg-secondary">secondary</option>
								<option value="primary" class="badge bg-primary">primary</option>
								<option value="info" class="badge bg-info">info</option>
								<option value="warning" class="badge bg-warning">warning</option>
								<option value="danger" class="badge bg-danger">danger</option>
								<option value="success" class="badge bg-success">success</option>
							</select>
						</div>
						<!-- End Select -->
					</div>

					<div class="mb-3">
						<label for="formKeterangan" class="form-label">Keterangan</label>
						<textarea name="keterangan" class="form-control" id="formKeterangan" rows="3"
							placeholder="Keterangan" required>

						</textarea>
						<small class="text-secondary">Tambahkan jika diperlukan</small>
					</div>
					<!-- End Form -->
					<div class="modal-footer p-0 pt-3">
						<button type="button" class="btn btn-sm btn-white" data-bs-dismiss="modal">Batal</button>
						<button type="submit" class="btn btn-sm btn-primary">Tambah Status</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- End Modal -->

<!-- Modal -->
<div id="tambah-staff" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalTambah" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modalTambah">Tambah Staff</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form action="" method="post" class="js-validate needs-validation" novalidate>

					<!-- Form -->
					<div class="mb-3">
						<label class="form-label" for="formEmail">Staff</label>
						<div class="row">
							<div class="col-md-10">
								<!-- Select -->
								<div class="tom-select-custom">
									<select class="js-select form-select" autocomplete="off" name="jabatan"
										data-hs-tom-select-options='{"placeholder": "Pilih jabatan..."}'
										<?php if(empty($staff)):?>disabled<?php endif;?>>
										<?php if(!empty($staff)):?>
										<?php foreach($staff as $key => $val):?>
										<option value="<?= $val->user_id;?>"><?= $val->nama;?></option>
										<?php endforeach;?>
										<?php else:?>
										<option>Tambahkan staff</option>
										<?php endif;?>
									</select>
								</div>
								<!-- End Select -->
							</div>
							<div class="col-md-2">
								<a href="<?= site_url('leader/kelola-staff');?>" class="btn btn-primary w-100"><i
										class="bi bi-plus"></i></a>
							</div>
						</div>
					</div>
					<p class="small text-secondary">Tambahkan staff untuk bergabung pada proyek ini, setelah menambahkan
						anda dapat menugaskan task pada staff di menu kelola Task</p>
					<!-- End Form -->
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
