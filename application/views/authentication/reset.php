<!-- Signup Form -->
<div class="container content-space-2 content-space-lg-3">
	<div class="row justify-content-lg-center align-items-center">
		<div class="col-md-6 col-lg-5">
            <!-- Heading -->
            <div class="text-center mb-5 mb-md-7">
            <h1 class="h2">Reset Password</h1>
            <p>Masukkan password baru untuk akun anda</p>
            </div>
            <!-- End Heading -->
			<!-- Form -->
			<form action="<?= site_url('api/auth/resetPassword');?>" method="post" class="js-validate needs-validation" novalidate>
				<!-- Card -->
				<div class="card">
					<div class="card-body">
						<!-- Form -->
						<div class="mb-4">
							<label class="form-label" for="signupHeroFormWorkEmail">Email</label>
							<input type="email" class="form-control form-control-lg" name="email"
								id="signupHeroFormWorkEmail" value="<?= $email;?>" aria-label="email@site.com"
								readonly>
							<span class="invalid-feedback">Masukkan email valid dengan benar</span>
						</div>
						<!-- End Form -->

						<!-- Form -->
						<div class="mb-4">
							<label class="form-label" for="signupHeroFormSignupPassword">Password Baru</label>
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
							<div class="col-sm-12 text-sm-end">
								<button type="submit" class="btn btn-sm btn-primary btn-sm w-100">Kirim Link</button>
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
