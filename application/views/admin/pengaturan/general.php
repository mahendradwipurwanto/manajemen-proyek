<!-- Page Header -->
<div class="docs-page-header">
	<div class="row align-items-center">
		<div class="col-sm">
			<h1 class="docs-page-header-title">Informasi Genaral</h1>
			<p class="docs-page-header-text">Kelola informasi general mengenai website</p>
		</div>
	</div>
</div>
<!-- End Page Header -->

<div class="row">
	<div class="col-md-8">
		<div class="card">
			<div class="card-body">
				<form action="<?= site_url('api/website/ubahGeneral');?>" method="post"
					class="js-validate needs-validation" novalidate enctype="multipart/form-data">
					<div class="mb-3">
						<label for="inputWebsiteTitle" class="form-label">Buka pendaftaran untuk leader <small
								class="text-danger">*</small></label>
						<div class="form-check form-switch mb-4">
							<input type="checkbox" class="form-check-input" id="formPendaftaranLeader" name="leader_daftar"
								<?= $leader_daftar == 1 ? 'checked' : '';?>>
							<label class="form-check-label" for="formPendaftaranLeader">buka pendaftaran?</label>
						</div>
					</div>
					<div class="mb-3">
						<label for="inputWebsiteTitle" class="form-label">Judul Website <small
								class="text-danger">*</small></label>
						<input type="text" id="inputWebsiteTitle" class="form-control form-control-sm" name="web_title"
							value="<?= $web_title;?>" required>
					</div>
					<div class="mb-3">
						<label class="form-label" for="inputWebDesc">Deskripsi Webiste <small
								class="text-danger">*</small></label>
						<textarea type="text" id="inputWebDesc" class="form-control editor" rows="4" name="web_desc"
							placeholder="Website Description" required><?= $web_desc;?></textarea>
					</div>
					<div class="mb-3">
						<label class="form-label" for="inputWebsiteAddress">Alamat <small
								class="text-danger">*</small></label>
						<textarea type="text" id="inputWebsiteAddress" class="form-control form-control-sm" rows="3"
							name="web_alamat" placeholder="Website Address" required><?= $web_alamat;?></textarea>
					</div>
					<div class="mb-3">
						<label for="inputWebsiteFacebook" class="form-label">Website Facebook<small
								class="text-danger">*</small></label>
						<input type="text" id="inputWebsiteFacebook" class="form-control form-control-sm"
							name="sosmed_facebook" value="<?= $sosmed_facebook;?>" required>
					</div>
					<div class="mb-3">
						<label for="inputWebsiteInstagram" class="form-label">Website Instagram<small
								class="text-danger">*</small></label>
						<input type="text" id="inputWebsiteInstagram" class="form-control form-control-sm"
							name="sosmed_ig" value="<?= $sosmed_ig;?>" required>
					</div>
					<div class="mb-3">
						<label for="inputWebsiteTwitter" class="form-label">Website Twitter<small
								class="text-danger">*</small></label>
						<input type="text" id="inputWebsiteTwitter" class="form-control form-control-sm"
							name="sosmed_twitter" value="<?= $sosmed_twitter;?>" required>
					</div>
					<div class="mb-3">
						<label for="inputWebsiteYoutube" class="form-label">Website Youtube<small
								class="text-danger">*</small></label>
						<input type="text" id="inputWebsiteYoutube" class="form-control form-control-sm"
							name="sosmed_yt" value="<?= $sosmed_yt;?>" required>
					</div>
					<div class="card-footer px-0">
						<button type="submit" class="btn btn-primary btn-sm float-end">Simpan perubahan</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>


<script>
	//  ckeditor
	$('textarea.editor').each(function () {

		CKEDITOR.replace($(this).attr('id'));

	});

</script>
