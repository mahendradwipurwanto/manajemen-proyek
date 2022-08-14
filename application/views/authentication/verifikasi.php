<!-- Signup Form -->
<div class="container content-space-2 content-space-lg-3">
	<div class="row justify-content-lg-center align-items-center">
		<div class="col-md-6 col-lg-5">
			<!-- Heading -->
			<div class="text-center mb-5 mb-md-7">
				<h1 class="h2">Verifikasi Email</h1>
				<p>Verifikasi email untuk mengaktifkan akun anda</p>
			</div>
			<!-- End Heading -->
			<!-- Form -->
			<form action="<?= site_url('api/auth/verifikasi');?>" method="post" class="js-validate needs-validation"
				novalidate>
				<!-- Card -->
				<div class="card">
					<div class="card-body">
						<!-- Form -->
						<div class="mb-4">
							<label class="form-label" for="signupHeroFormWorkEmail">Kode Verifikasi</label>
							<input type="text" class="form-control form-control-lg" name="kode"
								id="signupHeroFormWorkEmail" data-inputmask="'mask': '999-999'"
								required style="font-size: 30px; text-align: center; padding: 1px; line-height: 1;">
							<span class="invalid-feedback">Masukkan kode verifikasi valid dengan benar</span>
							<small class="text-secondary">Masukkan kode verifikasi yang telah kami kirimkan melalui
								email pendaftaran anda</small>
						</div>
						<!-- End Form -->

						<div class="row align-items-center">
							<div class="col-sm-12 text-sm-center">
								<button type="submit" class="btn btn-sm btn-primary btn-sm w-100">Verifikasi</button>
							</div>
							<!-- End Col -->
						</div>
						<!-- End Row -->
					</div>
				</div>
				<!-- End Card -->

				<div class="text-center mt-3">
					<small class="text-muted">Cek kotak masuk atau kotak spam pada emailmu. atau <br><a
							href="<?= site_url('verifikasi-email?act=resend-email'); ?>" class="text-primary">kirim
							kembali email</a></small>
				</div>
			</form>
			<!-- End Form -->
		</div>
		<!-- End Col -->
	</div>
	<!-- End Row -->
</div>
<!-- End Signup Form -->

<script type="text/javascript">
  $(document).ready(function () {
    $(":input").inputmask();
  });
</script>