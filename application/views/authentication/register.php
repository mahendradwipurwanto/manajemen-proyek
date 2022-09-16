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
			<form action="<?= site_url('api/auth/register');?>" method="post" class="js-validate needs-validation"
				novalidate>
				<input type="hidden" name="undangan"
					value="<?php if (isset($email)):?>true<?php else:?>false<?php endif;?>">
				<!-- Card -->
				<div class="card">
					<div class="card-header bg-primary text-center py-4">
						<?php if (isset($email)):?>
						<h4 class="card-header-title text-white">Lengkapi data diri untuk menyelesaikan <span
								class="badge bg-warning text-dark rounded-pill ms-1">undangan</span></h4>
						<?php else:?>
						<h4 class="card-header-title text-white">Daftarkan akun anda <span
								class="badge bg-warning text-dark rounded-pill ms-1">sekarang</span></h4>
						<?php endif;?>
					</div>

					<div class="card-body">
						<!-- Form -->
						<div class="mb-4">
							<label class="form-label" for="daftarNamaLengkap">Nama lengkap</label>
							<input type="text" class="form-control form-control-sm" name="nama" id="daftarNamaLengkap"
								placeholder="Jhon Doe" aria-label="Jhon Doe" required>
							<span class="invalid-feedback">Masukkan nama anda valid dengan benar</span>
						</div>
						<!-- End Form -->

						<!-- Form -->
						<div class="mb-4">
							<label class="form-label" for="daftarNomorTelepon">Nomor Telepon</label>
							<input type="text" class="form-control form-control-sm" name="no_telp"
								id="daftarNomorTelepon" placeholder="085847xxxxxx" aria-label="085847xxxxxx" required>
							<span class="invalid-feedback">Masukkan nomor telepon valid dengan benar</span>
						</div>
						<!-- End Form -->

						<!-- Form -->
						<div class="mb-4">
							<label class="form-label" for="signupHeroFormWorkEmail">Email</label>
							<input type="email" class="form-control form-control-sm" name="email"
								id="signupHeroFormWorkEmail" <?php if(isset($email)):?>value="<?= $email;?>"
								<?php else:?>placeholder="email@site.com" aria-label="email@site.com" <?php endif;?>
								required <?php if(isset($email)):?>readonly<?php endif;?>>
							<span class="invalid-feedback">Masukkan email valid dengan benar</span>
						</div>
						<!-- End Form -->

						<?php if($leader_daftar == 1):?>
						<div class="row mb-4">
							<label class="form-label">Daftarkan akun sebagai</label>
							<div class="col-sm mb-2 mb-sm-0">
								<!-- Form Radio -->
								<label class="form-control" for="daftar-staff">
									<span class="form-check">
										<input type="radio" class="form-check-input" name="role" value="3"
											id="daftar-staff" <?= $role == 3 ? 'checked' : '';?>>
										<span class="form-check-label">Sebagai staff</span>
									</span>
								</label>
								<!-- End Form Radio -->
							</div>
							<div class="col-sm mb-2 mb-sm-0">
								<!-- Form Radio -->
								<label class="form-control" for="daftar-leader">
									<span class="form-check">
										<input type="radio" class="form-check-input" name="role" value="2"
											id="daftar-leader" <?= $role == 2 ? 'checked' : '';?>>
										<span class="form-check-label">Sebagai leader</span>
									</span>
								</label>
								<!-- End Form Radio -->
							</div>
						</div>
						<!-- End Row -->
						<?php endif;?>

						<!-- Form -->
						<div class="mb-4">
							<label class="form-label" for="signupHeroFormSignupPassword">Password</label>
							<input type="password" class="form-control form-control-sm" name="password"
								id="signupHeroFormSignupPassword" placeholder="8+ karakter diperlukan"
								aria-label="8+ characters required" required>
							<span class="invalid-feedback">Masukkan password valid dengan benar</span>
						</div>
						<!-- End Form -->

						<!-- From -->
						<div class="mb-4" data-hs-validation-validate-class>
							<label class="form-label" for="daftarKonfirmasiPassword">Konfirmasi password</label>
							<input type="password" class="form-control form-control-sm" name="confirmPassword"
								id="daftarKonfirmasiPassword" placeholder="8+ characters required"
								aria-label="8+ characters required" required
								data-hs-validation-equal-field="#signupHeroFormSignupPassword">
							<span class="invalid-feedback">Password tidak sama</span>
						</div>
						<!-- End From -->

						<!-- Form -->
						<div class="mb-4">
							<label class="form-label" for="daftarCaptcha">Captcha</label><br>
							<div class="row d-flex align-items-center">
								<div class="col-4">
									<?=$captcha?>
								</div>
								<div class="col-8">
									<input type="text" class="form-control form-control-sm" name="captcha"
										id="daftarCaptcha" placeholder="Masukkan captcha" aria-label="Masukkan captcha"
										required>
								</div>
							</div>
							<span class="invalid-feedback">Masukkan captcha dengan benar</span>
						</div>
						<!-- End Form -->

						<div class="row align-items-center">
							<div class="col-sm-7 mb-3 mb-sm-0">
								<p class="card-text small">Sudah punya akun? <a class="link"
										href="<?= site_url('masuk');?>">Masuk sekarang</a></p>
							</div>
							<!-- End Col -->

							<div class="col-sm-5 text-sm-end">
								<button type="submit"
									class="btn btn-primary btn-sm btn-sm"><?php if(isset($email)):?>Bergabung Sekarang
									<?php else:?>Daftar Sekarang<?php endif;?></button>
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
