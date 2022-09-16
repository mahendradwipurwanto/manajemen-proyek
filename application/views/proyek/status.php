<!-- Page Header -->
<div class="docs-page-header">
	<div class="row align-items-center">
		<div class="col-sm">
			<h1 class="docs-page-header-title">Master status proyek
				<?= isset($proyek->judul) ? '<b>- '.$proyek->judul.'</b>' : '';?>
				<button type="button" class="btn btn-xs btn-soft-primary float-end float-end me-2"
					data-bs-toggle="modal" data-bs-target="#tambah-status">Tambah master</button>
				<a href="<?= site_url('proyek/kelola/'.$proyek->kode);?>"
					class="btn btn-xs btn-light float-end me-3">kembali</a>
			</h1>
			<p class="docs-page-header-text">
				<?= isset($proyek->keterangan) && $proyek->keterangan != '' ? $proyek->keterangan : 'Kelola semua komponen pendukung proyek anda disini';?>
			</p>
		</div>
	</div>
</div>
<!-- End Page Header -->

<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<ul class="list-group list-group-lg w-100" style="max-height: 500px; overflow: auto;">
					<?php if(!empty($status)):?>
					<?php foreach($status as $key => $val):?>
					<li class="list-group-item py-3">
						<div class="row justify-content-between">
							<div class="col-sm-3 mb-2 mb-sm-0">
								<span class="h5">(<?= $val->urutan;?>) <?= $val->status;?></span>
								<?php if($val->is_default == 1):?>
								<span class="badge bg-soft-primary">default</span>
								<?php endif;?>
							</div>
							<!-- End Col -->

							<!-- End Col -->
							<div class="col-sm-2 mb-2 mb-sm-0">
								<span class="badge bg-soft-<?= $val->warna;?>"><?= $val->warna;?></span>
							</div>
							<!-- End Col -->

							<!-- End Col -->
							<div class="col-sm-5 mb-2 mb-sm-0">
								<span class="text-secondary"><?= $val->keterangan;?></span>
							</div>
							<!-- End Col -->

							<div class="col-sm-2 text-sm-end">
								<span type="button" class="me-1 text-dark" data-bs-toggle="modal"
									data-bs-target="#ubah-status-<?= $val->id;?>"><i class="bi bi-pencil"></i></span>
								<?php if($val->is_default == 0):?>
								<span type="button" class="text-dark" data-bs-toggle="modal"
									data-bs-target="#hapus-status-<?= $val->id;?>"><i class="bi bi-trash"></i></span>
								<?php endif;?>
							</div>
							<!-- End Col -->
						</div>
						<!-- End Row -->
					</li>

					<!-- Modal -->
					<div id="ubah-status-<?= $val->id;?>" class="modal fade" tabindex="-1" aria-labelledby="modalTambah"
						aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered modal-lg">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="modalTambah">Ubah Status Baru</h5>
									<button type="button" class="btn-close" data-bs-dismiss="modal"
										aria-label="Close"></button>
								</div>
								<div class="modal-body">
									<form action="<?= site_url('api/proyek/edit_status');?>" method="post"
										class="js-validate needs-validation" novalidate>
										<?php if($val->is_mulai == 1):?>
										<div class="alert alert-soft-info">
											Task yang telah dibuat pertama kali akan secara otomatis dikategorikan pada
											status ini
										</div>
										<?php endif;?>
										<?php if($val->is_selesai == 1):?>
										<div class="alert alert-soft-info">
											Task yang dipindahkan pada status ini secara default akan, dianggap selesai.
										</div>
										<?php endif;?>
										<input type="hidden" name="id" value="<?= $val->id;?>">
										<input type="hidden" name="proyek_id" value="<?= $proyek->id;?>">
										<!-- Form -->
										<div class="mb-3">
											<label class="form-label" for="formJudul">Status</label>
											<input type="text" name="status" id="formJudul"
												class="form-control form-control-sm" value="<?= $val->status;?>"
												required>
											<small class="text-secondary">Seperti: Todo, Perancangan, Pengerjaan,
												Selesai</small>
										</div>

										<div class="mb-3">
											<label class="form-label" for="formJudul">Warna</label>
											<!-- Select -->
											<div class="tom-select-custom">
												<select class="js-select form-select form-select-sm" autocomplete="off"
													name="warna"
													data-hs-tom-select-options='{"placeholder": "Pilih Warna..."}'>
													<optgroup label="Current">
														<option value="<?= $val->warna;?>" class="badge bg-secondary">
															<?= $val->warna;?>
														</option>
													</optgroup>
													<optgroup label="Changes">
														<option value="secondary" class="badge bg-secondary">secondary
														</option>
														<option value="primary" class="badge bg-primary">primary
														</option>
														<option value="info" class="badge bg-info">info</option>
														<option value="warning" class="badge bg-warning">warning
														</option>
														<option value="danger" class="badge bg-danger">danger</option>
														<option value="success" class="badge bg-success">success
														</option>
													</optgroup>
												</select>
											</div>
											<!-- End Select -->
										</div>

										<div class="mb-3">
											<label for="formKeterangan" class="form-label">Keterangan</label>
											<textarea name="keterangan" class="form-control form-control-sm"
												id="formKeterangan" rows="3" placeholder="Keterangan"
												required><?= $val->keterangan;?></textarea>
											<small class="text-secondary">Tambahkan jika diperlukan</small>
										</div>
										<!-- End Form -->
										<div class="modal-footer p-0 pt-3">
											<button type="button" class="btn btn-sm btn-white"
												data-bs-dismiss="modal">Batal</button>
											<button type="submit" class="btn btn-sm btn-primary">Ubah Status</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
					<!-- End Modal -->

					<!-- Modal -->
					<div id="hapus-status-<?= $val->id;?>" class="modal fade" tabindex="-1" role="dialog"
						aria-labelledby="modalTambah" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="modalTambah">Hapus Status Baru</h5>
									<button type="button" class="btn-close" data-bs-dismiss="modal"
										aria-label="Close"></button>
								</div>
								<div class="modal-body">
									<form action="<?= site_url('api/proyek/hapus_status');?>" method="post"
										class="js-validate needs-validation" novalidate>
										<p>Apakah anda yakin? ingin menghapus status ini?</p>
										<!-- End Form -->
										<input type="hidden" name="id" value="<?= $val->id;?>">
										<input type="hidden" name="proyek_id" value="<?= $val->id;?>">
										<input type="hidden" name="urutan" value="<?= $val->urutan;?>">
										<div class="modal-footer p-0 pt-3">
											<button type="button" class="btn btn-sm btn-white"
												data-bs-dismiss="modal">Tidak</button>
											<button type="submit" class="btn btn-sm btn-danger">Ya</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
					<!-- End Modal -->
					<?php endforeach;?>
					<?php else:?>
					<div class="alert alert-secondary text-center mb-0">
						belum ada data
					</div>
					<?php endif;?>
				</ul>
			</div>
		</div>
	</div>
</div>

<!-- Modal -->
<div id="tambah-status" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalTambah" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modalTambah">Tambah Status Baru</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form action="<?= site_url('api/proyek/tambah_status');?>" method="post"
					class="js-validate needs-validation" novalidate>
					<input type="hidden" name="proyek_id" value="<?= $proyek->id;?>">
					<!-- Form -->
					<div class="mb-3">
						<label class="form-label" for="formJudul">Status</label>
						<input type="text" name="status" id="formJudul" class="form-control form-control-sm"
							placeholder="Status Proyek" required>
						<small class="text-secondary">Seperti: Todo, Perancangan, Pengerjaan, Selesai</small>
					</div>

					<div class="mb-3">
						<label class="form-label" for="formJudul">Warna</label>
						<!-- Select -->
						<div class="tom-select-custom">
							<select class="js-select form-select form-select-sm" autocomplete="off" name="warna"
								data-hs-tom-select-options='{"placeholder": "Pilih Warna..."}'>
								<option value="secondary" class="badge bg-secondary">secondary</option>
								<option value="primary" class="badge bg-primary">primary</option>
								<option value="info" class="badge bg-info">info</option>
								<option value="warning" class="badge bg-warning">warning</option>
								<option value="danger" class="badge bg-danger">danger</option>
								<option value="success" class="badge bg-success">success</option>
							</select>
						</div>
						<!-- End Select -->
					</div>

					<div class="mb-3">
						<label for="formKeterangan" class="form-label">Keterangan</label>
						<textarea name="keterangan" class="form-control form-control-sm" id="formKeterangan" rows="3"
							placeholder="Keterangan" required>

						</textarea>
						<small class="text-secondary">Tambahkan jika diperlukan</small>
					</div>
					<!-- End Form -->
					<div class="modal-footer p-0 pt-3">
						<button type="button" class="btn btn-sm btn-white" data-bs-dismiss="modal">Batal</button>
						<button type="submit" class="btn btn-sm btn-primary">Tambah Status</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- End Modal -->
