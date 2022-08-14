<!-- Signup Form -->
<div class="container content-space-2 content-space-lg-3">
	<div class="row justify-content-lg-between align-items-md-center">
		<div class="col-md-5 mb-7 mb-md-0">
			<div class="mb-5">
				<h2 class="mb-4">Tahapan suatu project adalah persiapan, proses dan hasil akhir.</h2>
				<p>Mulai masuk ke akun anda, dan mulai jalan keberhasilan dalam berbagai proyek yang anda kerjakan
					dengan mudah dan efisien.</p>
			</div>

			<!-- <h4>Learn more about:</h4> -->

			<!-- List Checked -->
			<!-- <ul class="list-checked list-checked-primary">
        <li class="list-checked-item">Actionable learning insights <span class="badge bg-warning text-dark rounded-pill ms-1">Beta</span></li> -->
			</ul>
			<!-- End List Checked -->
		</div>
		<!-- End Col -->

		<div class="col-md-7 col-lg-6">
			<!-- Form -->
			<form action="<?= site_url('api/auth/register');?>" method="post" class="js-validate needs-validation" novalidate>
				<!-- Card -->
				<div class="card">
					<div class="card-header bg-primary text-center py-4">
						<h4 class="card-header-title text-white">Daftarkan akun anda <span
								class="badge bg-warning text-dark rounded-pill ms-1">sekarang</span></h4>
					</div>

					<div class="card-body">
						<!-- Form -->
						<div class="mb-4">
							<label class="form-label" for="daftarNamaLengkap">Nama lengkap</label>
							<input type="text" class="form-control form-control-lg" name="nama" id="daftarNamaLengkap"
								placeholder="Jhon Doe" aria-label="Jhon Doe" required>
							<span class="invalid-feedback">Masukkan nama anda valid dengan benar</span>
						</div>
						<!-- End Form -->

						<!-- Form -->
						<div class="mb-4">
							<label class="form-label" for="daftarNomorTelepon">Nomor Telepon</label>
							<input type="text" class="form-control form-control-lg" name="no_telp"
								id="daftarNomorTelepon" placeholder="085847xxxxxx" aria-label="085847xxxxxx" required>
							<span class="invalid-feedback">Masukkan nomor telepon valid dengan benar</span>
						</div>
						<!-- End Form -->

						<!-- Form -->
						<div class="mb-4">
							<label class="form-label" for="signupHeroFormWorkEmail">Email</label>
							<input type="email" class="form-control form-control-lg" name="email"
								id="signupHeroFormWorkEmail" placeholder="email@site.com" aria-label="email@site.com"
								required>
							<span class="invalid-feedback">Masukkan email valid dengan benar</span>
						</div>
						<!-- End Form -->

						<!-- Form -->
						<div class="mb-4">
							<label class="form-label" for="signupHeroFormSignupPassword">Password</label>
							<input type="password" class="form-control form-control-lg" name="password"
								id="signupHeroFormSignupPassword" placeholder="8+ karakter diperlukan"
								aria-label="8+ characters required" required>
							<span class="invalid-feedback">Masukkan password valid dengan benar</span>
						</div>
						<!-- End Form -->

						<!-- From -->
						<div class="mb-4" data-hs-validation-validate-class>
							<label class="form-label" for="daftarKonfirmasiPassword">Konfirmasi password</label>
							<input type="password" class="form-control form-control-lg" name="confirmPassword"
								id="daftarKonfirmasiPassword" placeholder="8+ characters required"
								aria-label="8+ characters required" required
								data-hs-validation-equal-field="#signupHeroFormSignupPassword">
							<span class="invalid-feedback">Password tidak sama</span>
						</div>
						<!-- End From -->

						<div class="row align-items-center">
							<div class="col-sm-7 mb-3 mb-sm-0">
								<p class="card-text small">Sudah punya akun? <a class="link"
										href="<?= site_url('masuk');?>">Masuk sekarang</a></p>
							</div>
							<!-- End Col -->

							<div class="col-sm-5 text-sm-end">
								<button type="submit" class="btn btn-primary btn-sm btn-lg">Daftar sekarang</button>
							</div>
							<!-- End Col -->
						</div>
						<!-- End Row -->
					</div>
				</div>
				<!-- End Card -->
			</form>
			<!-- End Form -->
		</div>
		<!-- End Col -->
	</div>
	<!-- End Row -->
</div>
<!-- End Signup Form -->
