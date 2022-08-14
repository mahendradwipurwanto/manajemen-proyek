<!-- Page Header -->
<div class="docs-page-header">
	<div class="row align-items-center">
		<div class="col-sm">
			<h1 class="docs-page-header-title">Pengaturan
			</h1>
			<p class="docs-page-header-text">Atur semua informasi tentangmu disini</p>
		</div>
	</div>
</div>
<!-- End Page Header -->

<!-- Content -->
<div class="container-fuild">
	<div class="d-grid gap-3 gap-lg-12">
		<!-- Card -->
		<div class="card">
			<div class="card-header border-bottom">
				<h4 class="card-header-title">Informasi umum</h4>
			</div>

			<!-- Body -->
			<div class="card-body">
				<form action="<?= site_url('api/leader/simpanPengaturan');?>" method="post" enctype="multipart/form-data"
					class="js-validate need-validate" novalidate>
					<!-- Form -->
					<div class="row mb-4">
						<label class="col-sm-3 col-form-label form-label">Foto profil</label>

						<div class="col-sm-9">
							<div class="d-flex align-items-center">
								<label class="avatar avatar-xl avatar-circle" for="avatarUploader">
									<img id="avatarImg" class="avatar-img" src="<?= base_url();?><?= $user->profil;?>"
										alt="Image Description">
								</label>

								<div class="d-grid d-sm-flex gap-2 ms-4">
									<div class="form-attachment-btn btn btn-primary btn-sm">Unggah foto
										<input type="file" class="js-file-attach form-attachment-btn-label" name="image"
											id="avatarUploader" data-hs-file-attach-options='{
                                              "textTarget": "#avatarImg",
                                              "mode": "image",
                                              "targetAttr": "src",
                                              "resetTarget": ".js-file-attach-reset-img",
                                              "resetImg": "<?= base_url();?><?= $user->profil;?>",
                                              "allowTypes": [".png", ".jpeg", ".jpg"]
                                           }'>
									</div>
									<button type="button"
										class="js-file-attach-reset-img btn btn-white btn-sm">Hapus</button>
								</div>
							</div>
						</div>
					</div>
					<!-- End Form -->

					<!-- Form -->
					<div class="row mb-4">
						<label for="firstNameLabel" class="col-sm-3 col-form-label form-label">Nama lengkap <i
								class="bi-question-circle text-body ms-1" data-bs-toggle="tooltip"
								data-bs-placement="top" title="Ditampilkan secara umum"></i></label>

						<div class="col-sm-9">
							<div class="input-group">
								<input type="text" class="form-control" name="nama" id="firstNameLabel"
									placeholder="<?= $user->nama;?>" aria-label="<?= $user->nama;?>"
									value="<?= $user->nama;?>" required>
							</div>
						</div>
					</div>
					<!-- End Form -->

					<!-- Form -->
					<div class="row mb-4">
						<label for="emailLabel" class="col-sm-3 col-form-label form-label">Email</label>

						<div class="col-sm-9">
							<input type="email" class="form-control" name="email" id="emailLabel"
								placeholder="<?= $user->email;?>" aria-label="<?= $user->email;?>"
								value="<?= $user->email;?>" required>
						</div>
					</div>
					<!-- End Form -->

					<!-- Form -->
					<div class="row mb-4">
						<label for="teleponLabel" class="col-sm-3 col-form-label form-label">Nomor Telepon</label>

						<div class="col-sm-9">
							<input type="text" class="form-control" name="no_telp" id="teleponLabel"
								placeholder="<?= $user->no_telp;?>" aria-label="<?= $user->no_telp;?>"
								value="<?= $user->no_telp;?>" required>
						</div>
					</div>
					<!-- End Form -->

					<!-- Form -->
					<div class="row mb-4">
						<label class="col-sm-3 col-form-label form-label">Jenis Kelamin</label>

						<div class="col-sm-9">
							<div class="input-group input-group-md-down-break">
								<!-- Radio Check -->
								<label class="form-control" for="genderTypeRadio1">
									<span class="form-check">
										<input type="radio" class="form-check-input" name="jk" id="genderTypeRadio1"
											value="L" <?= $user->jk == 'L' ? 'checked' : '';?>>
										<span class="form-check-label">Laki-laki</span>
									</span>
								</label>
								<!-- End Radio Check -->

								<!-- Radio Check -->
								<label class="form-control" for="genderTypeRadio2">
									<span class="form-check">
										<input type="radio" class="form-check-input" name="jk" id="genderTypeRadio2"
											value="P" <?= $user->jk == 'P' ? 'checked' : '';?>>
										<span class="form-check-label">Perempuan</span>
									</span>
								</label>
								<!-- End Radio Check -->

								<!-- Radio Check -->
								<label class="form-control" for="genderTypeRadio3">
									<span class="form-check">
										<input type="radio" class="form-check-input" name="jk" id="genderTypeRadio3"
											value="O" <?= $user->jk == 'O' ? 'checked' : '';?>>
										<span class="form-check-label">Private</span>
									</span>
								</label>
								<!-- End Radio Check -->
							</div>
						</div>
					</div>
					<!-- End Form -->

					<!-- Form -->
					<div class="row align-items-center">
						<label for="disableAdCheckbox" class="col-sm-3 col-form-label form-label">Matikan pemberitahuan
							email <span class="badge bg-primary text-uppercase ms-1">email</span></label>

						<div class="col-sm-9">
							<!-- Check -->
							<div class="form-check">
								<input type="checkbox" class="form-check-input" id="disableAdCheckbox" name="notifikasi"
									<?= $user->notifikasi == true ? 'checked' : '';?>>
								<label class="form-check-label" for="disableAdCheckbox">Anda dapat mematikan notifikasi
									email seputar proyek dan task yang anda kerjakan</label>
							</div>
							<!-- End Check -->
						</div>
					</div>
					<!-- End Form -->

					<!-- Footer -->
					<div class="card-footer p-0">
						<div class="d-flex justify-content-end gap-3">
							<button type="submit" class="btn btn-sm btn-primary">Simpan perubahan</button>
						</div>
					</div>
					<!-- End Footer -->
				</form>
			</div>
			<!-- End Body -->
		</div>
		<!-- End Card -->
	</div>
</div>
<!-- End Content -->
