<!-- Page Header -->
<div class="docs-page-header">
	<div class="row align-items-center">
		<div class="col-sm">
			<h1 class="docs-page-header-title">Leader
				<button type="button" class="btn btn-sm btn-primary float-end" data-bs-toggle="modal"
					data-bs-target="#tambah">Tambah leader</button>
				<button type="button" class="btn btn-sm btn-outline-secondary float-end me-2" data-bs-toggle="modal"
					data-bs-target="#undang"><i class="bi bi-link-45deg"></i> Undang leader</button>
			</h1>
			<p class="docs-page-header-text">Kelola semua akun leader yang telah terdaftar pada website</p>
		</div>
	</div>
</div>
<!-- End Page Header -->
<div class="row mb-4">
	<div class="col-md-3 col-sm-12">
		<div class="card">
			<div class="card-body p-4">
				<div class="h6">Total leader</div>
				<div style="position: absolute;right: 15px;bottom: 0px;">
					<h1 class="h1"><?= number_format(1,0,",",".")?></h1>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-3 col-sm-12">
		<div class="card">
			<div class="card-body p-4">
				<div class="h6">Aktif leader</div>
				<div style="position: absolute;right: 15px;bottom: 0px;">
					<h1 class="h1"><?= number_format(1,0,",",".")?></h1>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-3 col-sm-12">
		<div class="card">
			<div class="card-body p-4">
				<div class="h6">Idle</div>
				<div style="position: absolute;right: 15px;bottom: 0px;">
					<h1 class="h1"><?= number_format(1,0,",",".")?></h1>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-3 col-sm-12">
		<div class="card">
			<div class="card-body p-4">
				<div class="h6">Akun non-aktif</div>
				<div style="position: absolute;right: 15px;bottom: 0px;">
					<h1 class="h1"><?= number_format(1,0,",",".")?></h1>
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
					<th>Status leader</th>
					<th>Total Proyek</th>
					<th>Proyek aktif</th>
					<th style="width: 5%;"></th>
				</tr>
			</thead>

			<tbody>
				<tr>
					<td>1.</td>
					<td>
						<div class="d-flex align-items-center">
							<div class="flex-shrink-0">
								<img class="avatar avatar-sm avatar-circle"
									src="<?= base_url();?>assets/img/160x160/img8.jpg" alt="Image Description">
							</div>

							<div class="flex-grow-1 ms-3">
								<a class="d-inline-block link-dark" href="#">
									<h6 class="text-hover-primary mb-0">Amanda Harvey <img
											class="avatar avatar-xss ms-1"
											src="<?= base_url();?>/assets/svg/illustrations/top-vendor.svg"
											alt="Image Description" data-bs-toggle="tooltip" data-bs-placement="top"
											title="Verified user"></h6>
								</a>
								<small class="d-block">amanda@example.com</small>
							</div>
						</div>
					</td>
					<td>
						<span class="badge bg-warning">idle</span>
					</td>
					<td>
						<b>12</b> Proyek
					</td>
					<td>
						<b>4</b> Proyek
					</td>
					<td>
						<button type="button" class="btn btn-xs btn-primary" data-bs-toggle="modal"
							data-bs-target="#detail">detail</button>
					</td>
				</tr>

				<!-- Modal -->
				<div id="detail" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalTambah"
					aria-hidden="true">
					<div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
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
												src="../assets/img/160x160/img9.jpg" alt="Image Description">
										</div>

										<div class="flex-grow-1 ms-4">
											<div class="row">
												<div class="col-lg mb-3 mb-lg-0">
													<h1 class="page-header-title h2">Maria Williams</h1>

													<ul class="list-inline list-separator">
														<li class="list-inline-item">
															<i class="bi-envelope text-primary me-1"></i>
															mahendra@gmail.com
														</li>
													</ul>
												</div>
												<!-- End Col -->

												<div class="col-lg-auto align-self-lg-end text-lg-right">
													<div class="d-flex gap-2">
														<a class="btn btn-primary btn-sm" href="#">
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
								<ul class="list-unstyled list-py-1">
									<li><i class="bi-star dropdown-item-icon"></i> 4.87 Rating project</li>
									<li><i class="bi-play-circle dropdown-item-icon"></i> 29 project</li>
									<li><i class="bi-person dropdown-item-icon"></i> 23,912 staff</li>
									<li><i class="bi-chat-left-dots dropdown-item-icon"></i> 1,533 task</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<!-- End Modal -->
			</tbody>
		</table>
	</div>
	<!-- End Table -->
</div>
<!-- End Card -->
<!-- Modal -->
<div id="tambah" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalTambah" aria-hidden="true">
	<div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modalTambah">Tambah</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form action="<?= site_url('api/leader/tambah');?>" method="post">
					<!-- Form -->
					<div class="mb-3">
						<label class="form-label" for="formNama">Nama</label>
						<input type="text" name="nama" id="formNama" class="form-control" placeholder="Nama leader"
							required>
					</div>
					<!-- End Form -->

					<!-- Form -->
					<div class="mb-3">
						<label class="form-label" for="formEmail">Email</label>
						<input type="email" name="email" id="formEmail" class="form-control" placeholder="Email leader"
							required>
						<small class="text-secondary">Pengguna akan mendapatkan email pemberitahuan telah ditambahkan
							sebagai leader</small>
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
					<div class="modal-footer px-0">
						<button type="button" class="btn btn-sm btn-white" data-bs-dismiss="modal">Batal</button>
						<button type="button" class="btn btn-sm btn-primary">Tambahkan</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- End Modal -->

<!-- Modal -->
<div id="undang" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalTambah" aria-hidden="true">
	<div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modalTambah">Undang</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form action="<?= site_url('api/leader/undang');?>" method="post">

					<!-- Form -->
					<div class="mb-3">
						<label class="form-label" for="formEmail">Email</label>
						<div class="row">
							<div class="col-9">
								<input type="email" name="email" id="formEmail" class="form-control form-control-sm"
									placeholder="Email leader" required>
							</div>
							<div class="col-3">
								<button type="button" class="btn btn-sm btn-primary w-100">Undang</button>
							</div>
						</div>
						<small class="text-secondary">Pengguna akan mendapatkan email pemberitahuan telah diundang
							sebagai leader</small>
					</div>
					<!-- End Form -->
					<div class="modal-footer px-0">
						<!-- List Striped -->
						<ul class="list-group list-group-lg w-100" style="max-height: 300px; overflow: auto;">
							<li class="list-group-item">
								<div class="row justify-content-between">
									<div class="col-sm-6 mb-2 mb-sm-0">
										<span class="h6">mahendradwi@gmail.com</span>
									</div>
									<!-- End Col -->


									<!-- End Col -->

									<div class="col-sm-4 mb-2 mb-sm-0">
										<span class="badge bg-secondary">pending</span>
									</div>
									<!-- End Col -->

									<div class="col-sm-2 text-sm-end">
										<a href="<?= site_url('api/leader/kirimUndangan/');?>"><i
												class="bi bi-envelope"></i></a>
									</div>
									<!-- End Col -->
								</div>
								<!-- End Row -->
							</li>
							<li class="list-group-item">
								<div class="row justify-content-between">
									<div class="col-sm-6 mb-2 mb-sm-0">
										<span class="h6">mahendradwi@gmail.com</span>
									</div>
									<!-- End Col -->


									<!-- End Col -->

									<div class="col-sm-4 mb-2 mb-sm-0">
										<span class="badge bg-secondary">pending</span>
									</div>
									<!-- End Col -->

									<div class="col-sm-2 text-sm-end">
										<a href="<?= site_url('api/leader/kirimUndangan/');?>"><i
												class="bi bi-envelope"></i></a>
									</div>
									<!-- End Col -->
								</div>
								<!-- End Row -->
							</li>
							<li class="list-group-item">
								<div class="row justify-content-between">
									<div class="col-sm-6 mb-2 mb-sm-0">
										<span class="h6">mahendradwi@gmail.com</span>
									</div>
									<!-- End Col -->


									<!-- End Col -->

									<div class="col-sm-4 mb-2 mb-sm-0">
										<span class="badge bg-success">joined</span>
									</div>
									<!-- End Col -->

									<div class="col-sm-2 text-sm-end">
										<a href="<?= site_url('api/leader/kirimUndangan/');?>"><i
												class="bi bi-envelope"></i></a>
									</div>
									<!-- End Col -->
								</div>
								<!-- End Row -->
							</li>
							<li class="list-group-item">
								<div class="row justify-content-between">
									<div class="col-sm-6 mb-2 mb-sm-0">
										<span class="h6">mahendradwi@gmail.com</span>
									</div>
									<!-- End Col -->


									<!-- End Col -->

									<div class="col-sm-4 mb-2 mb-sm-0">
										<span class="badge bg-secondary">pending</span>
									</div>
									<!-- End Col -->

									<div class="col-sm-2 text-sm-end">
										<a href="<?= site_url('api/leader/kirimUndangan/');?>"><i
												class="bi bi-envelope"></i></a>
									</div>
									<!-- End Col -->
								</div>
								<!-- End Row -->
							</li>
							<li class="list-group-item">
								<div class="row justify-content-between">
									<div class="col-sm-6 mb-2 mb-sm-0">
										<span class="h6">mahendradwi@gmail.com</span>
									</div>
									<!-- End Col -->


									<!-- End Col -->

									<div class="col-sm-4 mb-2 mb-sm-0">
										<span class="badge bg-secondary">pending</span>
									</div>
									<!-- End Col -->

									<div class="col-sm-2 text-sm-end">
										<a href="<?= site_url('api/leader/kirimUndangan/');?>"><i
												class="bi bi-envelope"></i></a>
									</div>
									<!-- End Col -->
								</div>
								<!-- End Row -->
							</li>
						</ul>
						<!-- End List Striped -->
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- End Modal -->
