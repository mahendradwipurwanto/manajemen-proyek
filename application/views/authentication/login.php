<!-- Signup Form -->
<div class="container content-space-2 content-space-lg-3">
	<div class="row justify-content-lg-center align-items-center">
		<div class="col-md-6 col-lg-5">
            <!-- Heading -->
            <div class="text-center mb-5 mb-md-7">
            <h1 class="h2">Selamat Datang</h1>
            <p>Masukkan email dan password akun anda.</p>
            </div>
            <!-- End Heading -->
			<!-- Form -->
			<form action="<?= site_url('api/auth/login');?>" method="post" class="js-validate needs-validation" novalidate>
				<!-- Card -->
				<div class="card">
					<div class="card-body">
						<!-- Form -->
						<div class="mb-4">
							<label class="form-label" for="signupHeroFormWorkEmail">Email</label>
							<input type="email" class="form-control form-control-lg" name="email"
								id="signupHeroFormWorkEmail" placeholder="email@site.com" aria-label="email@site.com"
								required>
							<span class="invalid-feedback">Masukkan email valid dengan benar</span>
							<a href="<?= site_url('lupa-password');?>"
								class="btn-link text-secondary float-end small">lupa password?</a>
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

						<div class="row align-items-center">
							<div class="col-sm-7 mb-3 mb-sm-0">
								<p class="card-text small">Belum punya akun? <a class="link"
										href="<?= site_url('daftar');?>">Daftar sekarang</a></p>
							</div>
							<!-- End Col -->

							<div class="col-sm-5 text-sm-end">
								<button type="submit" class="btn btn-sm btn-primary btn-lg">Masuk</button>
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
