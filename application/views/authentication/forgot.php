<!-- Signup Form -->
<div class="container content-space-2 content-space-lg-3">
	<div class="row justify-content-lg-center align-items-center">
		<div class="col-md-6 col-lg-5">
            <!-- Heading -->
            <div class="text-center mb-5 mb-md-7">
            <h1 class="h2">Lupa Password</h1>
            <p>Masukkan email akun anda yang telah terdaftar</p>
            </div>
            <!-- End Heading -->
			<!-- Form -->
			<form action="<?= site_url('api/auth/lupaPassword');?>" method="post" class="js-validate needs-validation" novalidate>
				<!-- Card -->
				<div class="card">
					<div class="card-body">
						<!-- Form -->
						<div class="mb-4">
							<label class="form-label" for="signupHeroFormWorkEmail">Email</label>
							<input type="email" class="form-control form-control-sm" name="email"
								id="signupHeroFormWorkEmail" placeholder="email@site.com" aria-label="email@site.com"
								required>
							<span class="invalid-feedback">Masukkan email valid dengan benar</span>
                            <small class="text-secondary">Kami akan mengirimkan tautan untuk mengatur ulang kata sandi kamu, melalui email yang telah terdaftar</small>
						</div>
						<!-- End Form -->

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
