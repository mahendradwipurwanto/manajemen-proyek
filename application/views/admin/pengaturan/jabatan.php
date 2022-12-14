<!-- Page Header -->
<div class="docs-page-header">
	<div class="row align-items-center">
		<div class="col-sm">
			<h1 class="docs-page-header-title">Master jabatan
				<button type="button" class="btn btn-primary btn-sm float-end" data-bs-toggle="modal"
					data-bs-target="#tambah">Tambah data</button>
			</h1>
			<p class="docs-page-header-text">Kelola master jabatan pada website anda</p>
		</div>
	</div>
</div>
<!-- End Page Header -->


<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-body">
				<table class="table table-hover table-striped w-100" id="table">
					<thead>
						<tr>
							<th width="10%">No.</th>
							<th width="25%"></th>
							<th>Jabatan</th>
							<th>Keterangan</th>
						</tr>
					</thead>
					<tbody>
						<?php if(!empty($jabatan)):?>
						<?php $no = 1; foreach($jabatan as $val):?>
						<tr>
							<td><?= $no++;?></td>
							<td>
								<button type="button" class="btn btn-info btn-xs" data-bs-toggle="modal"
									data-bs-target="#edit-<?= $val->id;?>">edit</button>
								<button type="button" class="btn btn-danger btn-xs" data-bs-toggle="modal"
									data-bs-target="#delete-<?= $val->id;?>">delete</button>
							</td>
							<td><?= $val->jabatan;?></td>
							<td><?= $val->keterangan;?></td>
						</tr>

						<!-- Modal -->
						<div id="edit-<?= $val->id;?>" class="modal fade" tabindex="-1" role="dialog"
							aria-labelledby="add" aria-hidden="true">
							<div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title" id="detailUserTitle">Ubah data</h4>
										<button type="button" class="btn-close" data-bs-dismiss="modal"
											aria-label="Close"></button>
									</div>
									<div class="modal-body">
										<form action="<?= site_url('api/master/simpanJabatan');?>" method="post"
											enctype="multipart/form-data" class="js-validate need-validate" novalidate>
											<input type="hidden" name="id" value="<?= $val->id;?>" required>

											<div class="mb-3">
												<label for="inputSubject" class="input-label">Jabatan <small
														class="text-danger">*</small></label>
												<input class="form-control form-control-sm" type="text" name="jabatan"
													value="<?= $val->jabatan;?>" required>
											</div>

											<div class="mb-3">
												<label for="inputSubject" class="input-label">Keterangan <small
														class="text-secondary">(optional)</small></label>
												<textarea class="form-control form-control-sm" type="text"
													name="keterangan"><?= $val->keterangan;?></textarea>
											</div>

											<div class="modal-footer px-0 pb-0">
												<button type="button" class="btn btn-white btn-sm"
													data-bs-dismiss="modal">batal</button>
												<button type="submit" class="btn btn-info btn-sm">Simpan</button>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>

						<div id="delete-<?= $val->id; ?>" class="modal fade" tabindex="-1" role="dialog"
							aria-labelledby="delete" aria-hidden="true">
							<div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm"
								role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title" id="detailUserTitle">Hapus data</h4>
										<button type="button" class="btn-close" data-bs-dismiss="modal"
											aria-label="Close"></button>
									</div>
									<div class="modal-body">
										<form action="<?= site_url('api/master/hapusJabatan');?>" method="post"
											class="js-validate need-validate" novalidate>
											<input type="hidden" name="id" value="<?= $val->id;?>">
											<p>Apakah kamu yakin ingin menghapus data <?= $val->jabatan;?> ini?</p>
											<div class="modal-footer px-0 pb-0">
												<button type="button" class="btn btn-white btn-sm"
													data-bs-dismiss="modal">Tidak</button>
												<button type="submit" class="btn btn-danger btn-sm">Ya</button>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
						<?php endforeach;?>
						<?php endif;?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>


<!-- Modal -->
<div id="tambah" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="add" aria-hidden="true">
	<div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="detailUserTitle">Tambah Data</h4>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form action="<?= site_url('api/master/simpanJabatan');?>" method="post" enctype="multipart/form-data"
					class="js-validate need-validate" novalidate>

					<div class="mb-3">
						<label for="inputSubject" class="input-label">Jabatan <small
								class="text-danger">*</small></label>
						<input class="form-control form-control-sm" type="text" name="jabatan"
							placeholder="Ketikkan jabatan" required>
					</div>

					<div class="mb-3">
						<label for="inputSubject" class="input-label">Keterangan <small
								class="text-secondary">(optional)</small></label>
						<textarea class="form-control form-control-sm" type="text" name="keterangan"
							placeholder="Ketikkan keterangan"></textarea>
					</div>

					<div class="modal-footer px-0 pb-0">
						<button type="button" class="btn btn-white btn-sm" data-bs-dismiss="modal">batal</button>
						<button type="submit" class="btn btn-primary btn-sm">Tambah</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
