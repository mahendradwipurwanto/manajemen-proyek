<!-- Page Header -->
<div class="docs-page-header">
	<div class="row align-items-center">
		<div class="col-sm">
			<h1 class="docs-page-header-title">Proyek <?= isset($proyek->judul) ? '<b>- '.$proyek->judul.'</b>' : '';?>
				<?php if($proyek->is_selesai == 1):?>
				<span class="badge bg-soft-success h5 mx-0 ms-2">proyek selesai</span>
				<?php endif;?>
				<a href="<?= site_url('proyek/master-status/'.$proyek->kode);?>"
					class="btn btn-xs btn-soft-primary float-end me-2">Master status</a>
				<a href="<?= site_url('proyek/kelola-staff/'.$proyek->kode);?>"
					class="btn btn-xs btn-soft-info float-end me-2">Kelola Staff</a>
				<button type="button" class="btn btn-xs btn-soft-secondary float-end me-2" data-bs-toggle="modal"
					href="#edit-proyek">informasi proyek</button>
				<?php if($proyek->is_selesai == 0):?>
				<button type="button" class="btn btn-xs btn-soft-warning float-end me-2" data-bs-toggle="modal" href="#tutup-proyek">tutup proyek</button>
				<?php endif;?>
				<?php if($this->session->userdata('role') == 2):?>
				<a href="<?= site_url('leader/kelola-proyek');?>"
					class="btn btn-xs btn-light float-end me-3">kembali</a>
				<?php else:?>
				<a href="<?= site_url('admin/kelola-proyek');?>" class="btn btn-xs btn-light float-end me-3">kembali</a>
				<?php endif;?>
			</h1>
			<p class="docs-page-header-text">
				<?= isset($proyek->keterangan) && $proyek->keterangan != '' ? $proyek->keterangan : 'Kelola semua komponen pendukung proyek anda disini';?>
			</p>
		</div>
	</div>
</div>
<!-- End Page Header -->

<div class="row">
	<div class="col-md-9">
		<?php if($proyek->is_selesai == 1):?>
		<div class="alert bg-soft-primary py-1">
			<small>Proyek ini telah selesai, staff tidak akan dapat mengakses proyek ini dari akun mereka. Anda dapat
				mengaktifkan proyek ini lagi, pada tombol informasi proyek.</small>
		</div>
		<?php endif;?>
		<?php if(time() > $proyek->periode_selesai && $proyek->is_selesai == 0):?>
		<div class="alert bg-soft-warning py-1">
			<small>Proyek ini telah melewati batas waktu pengerjaan.</small>
		</div>
		<?php endif;?>
		<div class="card mb-3">
			<div class="card-header py-3">
				<h4 class="card-title mb-0 d-flex justify-content-between align-items-center">
					<span class="d-flex justify-content-left align-items-center">
						Kelola Task
						<div class="participants ms-2">
							<?php if(!empty($leader)):?>
							<img src="<?= base_url();?><?= $leader[0]->profil;?>"
								alt="leader: <?= $leader[0]->nama;?>" data-bs-toggle="tooltip" data-bs-html="true"
								title="leader: <?= $leader[0]->nama;?>" class="me-3">
							<?php endif;?>
							<?php if(!empty($staff)):?>
							<?php foreach($staff as $k => $v):?>
							<img src="<?= base_url();?><?= $v->profil;?>" alt="staff: <?= $v->nama;?>"
								data-bs-toggle="tooltip" data-bs-html="true" title="staff: <?= $v->nama;?>">
							<?php endforeach;?>
							<?php endif;?>
						</div>
					</span>
					<span class="badge bg-soft-info ms-2">bobot:
						<?= isset($bobot->quota_bobot) ? $bobot->quota_bobot : 0;?>/100</span>
					<button type="button"
						class="btn btn-xs <?= $proyek->is_selesai == 1 ? 'btn-secondary' : 'btn-outline-primary';?> float-end"
						data-bs-toggle="modal" data-bs-target="#tambah-task"
						<?= $proyek->is_selesai == 1 ? 'disabled' : '';?>>Tambahkan task baru</button>
				</h4>
			</div>
		</div>
		<!-- Nav -->
		<div class="text-left">
			<ul class="nav nav-segment mb-3" role="tablist">
				<?php if(!empty($task)):?>
				<?php foreach ($task as $key => $val):?>
				<li class="nav-item">
					<a class="nav-link <?= $val->urutan == 1 ? 'active' : '';?>" id="status-<?= $val->id;?>-tab"
						href="#status-<?= $val->id;?>" data-bs-toggle="pill" data-bs-target="#status-<?= $val->id;?>"
						role="tab" aria-controls="status-<?= $val->id;?>" aria-selected="true"><?= $val->status;?>
						<?php if(count($val->tasks) > 0):?><span
							class="badge bg-danger"><?= count($val->tasks);?></span><?php endif;?></a>
				</li>
				<?php endforeach;?>
				<?php endif;?>
			</ul>
		</div>
		<!-- End Nav -->
		<div class="card">
			<div class="card-body p-3">
				<?php if(!empty($task)):?>
				<!-- Tab Content -->
				<div class="tab-content">
					<?php foreach ($task as $key => $val):?>
					<div class="tab-pane fade <?= $val->urutan == "1" ? 'show active' : '';?>"
						id="status-<?= $val->id;?>" role="tabpanel" aria-labelledby="status-<?= $val->id;?>-tab">
						<?php if($val->is_selesai == 1):?>
						<div class="alert bg-soft-primary py-1">
							<small>Pada tab <b>Done</b>, anda dapat memverifikasi task yang telah selesai agar
								dapat berpindah ke status closed</small>
						</div>
						<?php endif;?>
						<?php if($val->is_closed == 1):?>
						<div class="alert bg-soft-primary py-1">
							<small>Pada tab <b>Closed</b>, semua task pada tab ini telah diverifikasi oleh leader dan
								dinyatakan selesai. Staff akan mendapatkan poin sesuai dari bobot task yang ada.</small>
						</div>
						<?php endif;?>
						<ul class="list-group list-group-lg w-100" style="max-height: 500px; overflow: auto;">
							<?php if(!empty($val->tasks)):?>
							<?php foreach($val->tasks as $k => $v):?>
							<li class="js-hs-unfold-invoker list-group-item py-2 cursor"
								onclick='showDetail(<?= $key;?>, <?= $k;?>)' data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbarSignup" aria-controls="offcanvasNavbarSignup">
								<div class="row justify-content-between">
									<div class="col-sm-7 mb-2 mb-sm-0">
									</div>
									<div class="col-sm-7 mb-2 mb-sm-0">
										<span class="h5 fw-normal"><?= $v->task;?></span>
										<span class="badge bg-<?= $v->bobot_color;?>"><?= $v->bobot;?>%</span>
										<?php if($v->pernah_ditolak == 1):?>
										<span class="badge bg-soft-danger">ditolak</span>
										<?php endif;?>
									</div>
									<div class="col-sm-3 mb-2 mb-sm-0 d-flex justify-content-end">
										<span class="badge bg-<?= $val->warna;?> me-3"><?= $val->status;?></span>
										<div class="participants float-end">
											<img src="<?= base_url();?><?= $v->profil;?>" alt="<?= $v->nama;?>"
												data-bs-toggle="tooltip" data-bs-html="true" title="<?= $v->nama;?>">
										</div>
									</div>
									<!-- End Col -->
								</div>
								<!-- End Row -->
							</li>

							<!-- Modal -->
							<div id="detail-task-<?= $v->id;?>" class="modal fade" tabindex="-1" role="dialog"
								aria-labelledby="modalTambah" aria-hidden="true">
								<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="modalTambah">Detail task</h5>
											<button type="button" class="btn-close" data-bs-dismiss="modal"
												aria-label="Close"></button>
										</div>
										<div class="modal-body">
											<form action="<?= site_url('api/proyek/editTask');?>" method="post"
												class="js-validate needs-validation" novalidate>
												<input type="hidden" name="id" value="<?= $v->id;?>">
												<div class="mb-3">
													<label class="form-label" for="formTask">Task <small
															class="text-danger">*</small></label>
													<input type="text" name="task" id="formTask"
														class="form-control form-control-sm" value="<?= $v->task;?>"
														required>
													<small class="text-secondary">Task baru akan otomatis masuk kedalam
														status To Do</small>
												</div>
												<div class="mb-3">
													<label class="form-label" for="formTask">Pindah status <small
															class="text-danger">*</small></label>
													<select class="js-select form-select form-select-sm"
														autocomplete="off" name="status_id"
														data-hs-tom-select-options='{"placeholder": "Pilih status"}'
														required>
														<option value="<?= $val->id;?>"><?= $val->status;?></option>
														<?php if(!empty($status)):?>
														<?php foreach($status as $keys => $value):?>
														<option value="<?= $value->id;?>"><?= $value->status;?>
														</option>
														<?php endforeach;?>
														<?php endif;?>
													</select>
												</div>
												<div class="mb-4 row align-items-center">
													<label class="form-label col-3 mb-0" for="formTask">Bobot task
														</label>
													<div class="col-4">
														<div class="input-group input-group-sm">
															<input type="number" class="form-control form-control-sm"
																name="bobot" placeholder="Bobot task" min="0"
																value="<?= $v->bobot;?>" aria-label="Bobot"
																aria-describedby="input-bobot-task" required>
															<span class="input-group-text"
																id="input-bobot-task">%</span>
														</div>
													</div>
													<div class="col-5">
														<span class="badge bg-soft-info ms-2">bobot tersisa:
															<?= isset($bobot->quota_bobot) ? $bobot->quota_bobot : 0;?>/100</span>
													</div>
												</div>

												<div class="mb-3 row">
													<div class="col">
														<label class="form-label" for="formTaskKeterangan">Staff <small
																class="text-danger">*</small></label>
														<div class="tom-select-custom">
															<select class="js-select form-select form-select-sm"
																autocomplete="off" name="staff_id"
																data-hs-tom-select-options='{"placeholder": "Pilih staff"}'
																required>
																<option value="<?= $v->user_id;?>"><?= $v->nama;?>
																	<?php if(!empty($staff)):?>
																	<?php foreach($staff as $keys => $value):?>
																<option value="<?= $value->user_id;?>">
																	<?= $value->nama;?></option>
																<?php endforeach;?>
																<?php endif;?>
															</select>
														</div>
														<small class="text-secondary">Staff akan mendapatkan email
															pemberitahuan</small>
													</div>
													<div class="col">
														<label class="form-label" for="formDeadline">Deadline Task
															</label>
														<input type="date" name="deadline" id="formDeadline"
															class="form-control form-control-sm"
															value="<?= $v->deadline;?>" required>
													</div>
												</div>

												<div class="mb-3">
													<label class="form-label" for="formTaskKeterangan">Keterangan <small
															class="text-secondary">(optional)</small></label>
													<textarea type="text" name="keterangan"
														class="form-control form-control-sm ckeditor"
														placeholder="Keterangan"
														rows="3"><?= $v->keterangan;?></textarea>
												</div>
												<!-- End Form -->
												<!-- End From -->
												<div class="modal-footer p-0 pt-3">
													<button type="button" class="btn btn-sm btn-white"
														data-bs-dismiss="modal">Batal</button>
													<button type="submit" class="btn btn-sm btn-primary">Simpan</button>
													<a href="<?= site_url('api/proyek/hapusTask/'.$v->id);?>"
														class="btn btn-sm btn-soft-danger">Hapus</a>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
							<!-- End Modal -->

							<!-- Modal -->
							<div id="selesaikan-task-<?= $v->id;?>" class="modal fade" tabindex="-1" role="dialog"
								aria-labelledby="modalTambah" aria-hidden="true">
								<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="modalTambah">Selesaikan task -
												<strong><?= $v->task;?></strong></h5>
											<button type="button" class="btn-close" data-bs-dismiss="modal"
												aria-label="Close"></button>
										</div>
										<div class="modal-body">
											<form action="<?= site_url('api/proyek/selesaikanTask');?>" method="post"
												class="js-validate needs-validation" enctype="multipart/form-data"
												novalidate>
												<input type="hidden" name="id" value="<?= $v->id;?>">
												<input type="hidden" name="proyek_id" value="<?= $v->proyek_id;?>">
												<?php if($v->bukti != null && $v->bukti != 0 && $v->bukti != ''):?>
												<div class="mb-3">
													<label class="form-label" for="formTask">Bukti penyelesaian <small
															class="text-danger">*</small></label>
													<div class="row">
														<div class="col-4">
															<a href="<?= base_url();?><?= $v->bukti;?>" target="_blank"
																class="btn btn-outline-primary btn-sm text-left"><i
																	class="bi bi-file-earmark-<?= $v->icon;?>"></i> Bukti
																penyelesaian</a>
														</div>
														<div class="col-8">
															<input type="file" name="file" id="formTask"
																class="form-control form-control-sm"
																accept="<?= $proyek->upload_string?>">
														</div>
													</div>
													<small class="text-secondary">Upload bukti penyelesaian task, berupa
														file <?= $proyek->upload_allowed?>. Maksimal 5Mb</small>
												</div>
												<input type="hidden" name="sudah_upload" value="1">
												<?php else:?>
												<div class="mb-3">
													<label class="form-label" for="formTask">Bukti penyelesaian <small
															class="text-danger">*</small></label>
													<!-- <input type="file" name="file" id="formTask"
														class="form-control form-control-sm"
														accept="application/pdf,.pdf" required> -->
														<div action="#" class="dropzone p-1">
															<div class="fallback">
															</div>
															<div class="dz-message needsclick">
																<div class="mb-2">
																	<i class="display-4 text-muted mdi mdi-upload-network-outline"></i>
																</div>

																<h4>Drop file atau klik untuk mengunggah.</h4>
															</div>
														</div>
													<small class="text-secondary">Upload bukti penyelesaian task, berupa
														file <?= $proyek->upload_allowed?>. Maksimal 5Mb</small>
												</div>
												<input type="hidden" name="sudah_upload" value="0">
												<?php endif;?>

												<div class="mb-3">
													<label class="form-label" for="formTaskKeterangan">Catatan <small
															class="text-secondary">(optional)</small></label>
													<textarea type="text" name="catatan"
														class="form-control form-control-sm ckeditor"
														placeholder="Keterangan" rows="3"><?= $v->catatan;?></textarea>
												</div>
												<!-- End Form -->
												<!-- End From -->
												<div class="modal-footer p-0 pt-3">
													<button type="button" class="btn btn-sm btn-white"
														data-bs-dismiss="modal">Batal</button>
													<button type="submit" onclick="inikirim()"
														class="btn btn-sm btn-success">Selesaikan</button>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
							<!-- End Modal -->

							<!-- Modal -->
							<div id="verifikasi-task-<?= $v->id;?>" class="modal fade" tabindex="-1" role="dialog"
								aria-labelledby="modalTambah" aria-hidden="true">
								<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="modalTambah">verifikasi task -
												<strong><?= $v->task;?></strong></h5>
											<button type="button" class="btn-close" data-bs-dismiss="modal"
												aria-label="Close"></button>
										</div>
										<div class="modal-body">
											<form action="<?= site_url('api/proyek/verifikasiTask');?>" method="post"
												class="js-validate needs-validation" enctype="multipart/form-data"
												novalidate>
												<input type="hidden" name="id" value="<?= $v->id;?>">
												<input type="hidden" name="proyek_id" value="<?= $v->proyek_id;?>">
												<div class="mb-3">
													<?php foreach($v->bukti_task as $kkk => $vvv):?>
													<a href="<?= base_url();?><?= $vvv->bukti;?>" target="_blank"
														class="btn btn-outline-primary btn-xs text-left mb-2"><i
															class="bi bi-file-earmark-<?= $vvv->icon;?>"></i> <?php $nama_file = explode("/", $vvv->bukti); echo substr(end($nama_file), 0, 50);?></a><br>
													<?php endforeach;?>
												</div>
												<p>Verifikasi penyelesaian task ini, tambahkan catatan jika ada</p>
												<div class="mb-3">
													<label class="form-label" for="formTaskKeterangan">Catatan <small
															class="text-secondary">(optional)</small></label>
													<textarea type="text" name="catatan_diterima"
														class="form-control form-control-sm ckeditor"
														placeholder="Keterangan"
														rows="3"><?= $v->catatan_diterima;?></textarea>
												</div>
												<!-- End Form -->
												<!-- End From -->
												<div class="modal-footer p-0 pt-3">
													<button type="button" class="btn btn-sm btn-white"
														data-bs-dismiss="modal">Batal</button>
													<button type="submit"
														class="btn btn-sm btn-success">verifikasi</button>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
							<!-- End Modal -->

							<!-- Modal -->
							<div id="tolak-task-<?= $v->id;?>" class="modal fade" tabindex="-1" role="dialog"
								aria-labelledby="modalTambah" aria-hidden="true">
								<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="modalTambah">tolak task -
												<strong><?= $v->task;?></strong></h5>
											<button type="button" class="btn-close" data-bs-dismiss="modal"
												aria-label="Close"></button>
										</div>
										<div class="modal-body">
											<form action="<?= site_url('api/proyek/tolakTask');?>" method="post"
												class="js-validate needs-validation" enctype="multipart/form-data"
												novalidate>
												<input type="hidden" name="id" value="<?= $v->id;?>">
												<input type="hidden" name="proyek_id" value="<?= $v->proyek_id;?>">

												<p>Tolak penyelesaian task ini, berikan alasan jika diperlukan</p>

												<div class="mb-3">
													<label class="form-label" for="formTaskKeterangan">Catatan <small
															class="text-secondary">(optional)</small></label>
													<textarea type="text" name="catatan_ditolak"
														class="form-control form-control-sm ckeditor"
														placeholder="Keterangan"
														rows="3"><?= $v->catatan_ditolak;?></textarea>
												</div>
												<!-- End Form -->
												<!-- End From -->
												<div class="modal-footer p-0 pt-3">
													<button type="button" class="btn btn-sm btn-white"
														data-bs-dismiss="modal">Batal</button>
													<button type="submit"
														class="btn btn-sm btn-soft-danger">tolak</button>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
							<!-- End Modal -->

							<script>
									Dropzone.autoDiscover = false;

									$('.dz-message').addClass('hidden');

									var foto_upload = new Dropzone(".dropzone", {
										autoProcessQueue: false,
										url: "<?= site_url('api/proyek/upload_bukti/'.$v->proyek_id.'/'.$v->id) ?>",
										maxFilesize: 2,
										maxFiles: 30,
										parallelUploads: 30,
										method: "post",
										acceptedFiles: "<?= $proyek->upload_string?>",
										paramName: "bukti",
										dictInvalidFileType: "File type not allowed",
										addRemoveLinks: true,
										init: function() {
											let myDropzone = this;
											let mockFile = null;
											let callback = null; // Optional callback when it's done
											let crossOrigin = null; // Added to the `img` tag for crossOrigin handling
											let resizeThumbnail = false; // Tells Dropzone whether it should resize the image first

											<?php if (!empty($v->bukti_task)) : ?>
												<?php foreach ($v->bukti_task as $kkk => $vvv) : ?>
													mockFile = {
														name: "<?= $vvv->bukti; ?>",
														size: 10*1024
													};

													myDropzone.displayExistingFile(mockFile, "<?= base_url(); ?>assets/images/pdf.png", callback, crossOrigin, resizeThumbnail);
												<?php endforeach; ?>
											<?php endif; ?>
											let fileCountOnServer = 2; // The number of files already uploaded
											myDropzone.options.maxFiles = myDropzone.options.maxFiles - fileCountOnServer;
										},
										removedfile: function(file) {
											var fileName = file.name;

											$.ajax({
												type: 'POST',
												url: '<?= site_url('api/proyek/delete_bukti/'.$v->proyek_id.'/'.$v->id) ?>',
												data: {
													filename: fileName,
													request: 'delete'
												},
												success: function(data) {
													console.log('success: ' + data);
												}
											});

											var _ref;
											return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
										}
									});

									function inikirim() {
										foto_upload.processQueue();
									}
							</script>

							<?php endforeach;?>
							<?php else:?>
							<li class="list-group-item py-3 task-empty">
								<div class="row justify-content-between">
									<div class="col-sm-12 mb-2 mb-sm-0">
										<span class="h5 fw-normal">Belum ada task di <?= $val->status;?></span>
									</div>
									<!-- End Col -->
								</div>
								<!-- End Row -->
							</li>
							<?php endif;?>
						</ul>
					</div>
					<?php endforeach;?>
				</div>
				<!-- End Tab Content -->
				<?php endif;?>
			</div>
		</div>
	</div>
	<div class="col-md-3">
		<div class="card">
			<div class="card-header py-3">
				<h4 class="card-title mb-0">File pendukung</h4>
			</div>
			<div class="card-body p-3">
				<a href="<?= base_url();?><?= $proyek->file_pendukung;?>" class="btn btn-outline-primary btn-sm" target="_blank"><i class="bi bi-file-pdf"></i> file pendukung proyek</a>
			</div>
		</div>
		<div class="card">
			<div class="card-header py-3">
				<h4 class="card-title mb-0">Aktifitas terbaru</h4>
			</div>
			<div class="card-body p-3">
				<ul class="list-group list-group-lg w-100" style="max-height: 590px; overflow: auto;">
					<?php if(!empty($log_proyek)):?>
					<?php foreach($log_proyek as $key => $val):?>
					<li class="list-group-item py-3">
						<div class="row justify-content-between">
							<div class="col-sm-12 mb-2 mb-sm-0">
								<span class="h5 fw-normal"><b><?= $val->nama;?></b> <?= $val->message;?></span>
								<br>
								<span class="text-secondary small float-end"><?= $val->created_at;?></span>
							</div>
							<!-- End Col -->
						</div>
						<!-- End Row -->
					</li>
					<?php endforeach;?>
					<?php else:?>
					<li class="list-group-item py-3">
						<div class="row justify-content-between">
							<div class="col-sm-12 mb-2 mb-sm-0 text-center">
								<span class="h5 fw-normal">belum ada aktivitas terbaru</span>
							</div>
							<!-- End Col -->
						</div>
						<!-- End Row -->
					</li>
					<?php endif;?>
				</ul>
			</div>
		</div>
	</div>
</div>

<!-- Modal -->
<div id="tambah-task" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalTambah" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modalTambah">Tambahkan task</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form action="<?= site_url('api/proyek/tambahTask');?>" method="post"
					class="js-validate needs-validation" novalidate>
					<input type="hidden" name="proyek_id" value="<?= $proyek->id;?>">
					<div class="mb-3">
						<label class="form-label" for="formTask">Task </label>
						<input type="text" name="task" id="formTask" class="form-control form-control-sm"
							placeholder="Task" required>
						<small class="text-secondary">Task baru akan otomatis masuk kedalam status To Do</small>
					</div>
					<div class="mb-4 row align-items-center">
						<label class="form-label col-3 mb-0" for="formTask">Bobot task <small
								class="text-danger">*</small></label>
						<div class="col-4">
							<div class="input-group input-group-sm">
								<input type="number" class="form-control form-control-sm" name="bobot"
									placeholder="Bobot task" min="0" max="<?= (100-(isset($bobot->quota_bobot) ? $bobot->quota_bobot : 0));?>" value="0"
									aria-label="Bobot" aria-describedby="input-bobot-task"
									<?= (100-(isset($bobot->quota_bobot) ? $bobot->quota_bobot : 0)) == 0 ? 'readonly' : '';?> required>
								<span class="input-group-text" id="input-bobot-task">%</span>
							</div>
						</div>
						<div class="col-5">
							<span class="badge bg-soft-info ms-2">bobot tersisa: <?= isset($bobot->quota_bobot) ? $bobot->quota_bobot : 0;?>/100</span>
						</div>
						<?php if((100-(isset($bobot->quota_bobot) ? $bobot->quota_bobot : 0)) == 0):?>
						<small class="text-danger">anda tidak dapat membuat task baru dengan bobot lebih dari 0, ketika
							quota bobot mencapai batas maksimal. ini akan berpengaruh terhadap sistem penilaian
							KPI</small>
						<?php endif;?>
					</div>

					<div class="mb-3 row">
						<div class="col">
							<label class="form-label" for="formTaskKeterangan">Staff</label>
							<div class="tom-select-custom">
								<select class="js-select form-select form-select-sm" autocomplete="off" name="staff_id"
									data-hs-tom-select-options='{"placeholder": "Pilih staff"}' required>
									<?php if(!empty($staff)):?>
									<?php foreach($staff as $keys => $value):?>
									<option value="<?= $value->user_id;?>"><?= $value->nama;?></option>
									<?php endforeach;?>
									<?php endif;?>
								</select>
							</div>
							<small class="text-secondary">Staff akan mendapatkan email pemberitahuan</small>
						</div>
						<div class="col">
							<label class="form-label" for="formDeadline">Deadline Task</label>
							<input type="date" name="deadline" id="formDeadline" class="form-control form-control-sm"
								 value="<?= date('Y-m-d', strtotime('+1 week'));?>" required>
						</div>
					</div>

					<div class="mb-3">
						<label class="form-label" for="formTaskKeterangan">Keterangan <small
								class="text-danger">*</small></label>
						<textarea type="text" name="keterangan" id="formTaskKeterangan"
							class="form-control form-control-sm ckeditor" placeholder="Keterangan" rows="3"></textarea>
					</div>
					<!-- End Form -->
					<!-- End From -->
					<div class="modal-footer p-0 pt-3">
						<button type="button" class="btn btn-sm btn-white" data-bs-dismiss="modal">Batal</button>
						<button type="submit" class="btn btn-sm btn-primary">Tambahkan</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- End Modal -->



<!-- Modal -->
<div id="edit-proyek" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalTambah" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modalTambah">Ubah Informasi Proyek</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form action="<?= site_url('api/proyek/edit');?>" method="post" class="js-validate needs-validation" enctype="multipart/form-data"
					novalidate>
					<input type="hidden" name="id" value="<?= $proyek->id;?>">
					<!-- Form -->
					<div class="mb-3 row">
						<div class="col-8">
							<label class="form-label" for="formJudul">Nama Proyek</label>
							<input type="text" name="judul" id="formJudul" class="form-control form-control-sm"
								value="<?= $proyek->judul;?>" <?= $proyek->is_selesai == 1 ? 'readonly' : 'required'?>>
						</div>
						<div class="col-4">
							<label class="form-label" for="formKode">Kode Proyek  <i
									class="bi bi-info-square-fill" data-bs-toggle="tooltip" data-bs-html="true"
									title="Kode sebagai kunci/id proyek anda untuk mengenali pekerjaan dari proyek ini."></i></label>
							<input type="text" name="kode" id="formKode" class="form-control form-control-sm alphanum"
								placeholder="Ex: PYK01" value="<?= $proyek->kode;?>" readonly>
						</div>
					</div>
					<div class="mb-3">
						<label class="form-label" for="formSelesaikanProyek">Selesaikan Proyek</label>
						<div class="form-check form-switch mb-4">
							<input type="checkbox" class="form-check-input" id="formSelesaikan" name="is_selesai"
								<?= $proyek->is_selesai == 1 ? 'checked' : '';?>>
							<label class="form-check-label" for="formSelesaikan">Selesaikan proyek? saat proyek selesai,
								maka staff tidak dapat mengakses proyek ini</label>
						</div>
					</div>
					<div class="mb-3 row">
						<div class="col-6">
							<label class="form-label" for="formPeriodeMulai">Periode Mulai</label>
							<input type="date" name="periode_mulai" id="formPeriodeMulai"
								class="form-control form-control-sm"
								value="<?= date('Y-m-d', $proyek->periode_mulai);?>"
								<?= $proyek->is_selesai == 1 ? 'readonly' : 'required'?>>
						</div>
						<div class="col-6">
							<label class="form-label" for="formPeriodeSelesai">Periode Selesai</label>
							<input type="date" name="periode_selesai" id="formPeriodeSelesai"
								class="form-control form-control-sm"
								value="<?= date('Y-m-d', $proyek->periode_selesai);?>"
								<?= $proyek->is_selesai == 1 ? 'readonly' : 'required'?>>
						</div>
						<?php if($proyek->is_selesai == 0):?>
						<div class="col-12 mt-3">
							<div class="alert alert-soft-primary mb-0">
								<small class="text-secondary">Periode mulai dan selesai digunakan sebagai acuan laporan
									mengenai ketepatan waktu penyelesaian proyek, anda dapat mengubah hal ini nanti jika
									terjadi kendala saat proses pengerjaan berlangsung</small>
							</div>
						</div>
						<?php endif;?>
					</div>

					<div class="mb-3">
						<label for="formKeterangan" class="form-label">Berkas pendukung (optional)</label>
						<input type="file" class="form-control form-control-sm" name="file" accept=".pdf">
						<small class="text-secondary">Upload file pdf. Maksimal 5Mb</small>
					</div>

					<div class="mb-3">
						<label for="formKeterangan" class="form-label">Tipe File yang diperbolehkan</label>
						<div class="row">
							<div class="col-4">
								<!-- Checkbox -->
								<div class="form-check mb-3">
									<input type="checkbox" id="checkPdf" name="upload_type[pdf]" class="form-check-input"
										value="application/pdf" <?= isset($proyek->upload_type->pdf) ? 'checked' : '';?>>
									<label class="form-check-label" for="checkPdf">pdf</label>
								</div>
								<!-- End Checkbox -->
								<!-- Checkbox -->
								<div class="form-check mb-3">
									<input type="checkbox" id="checkDocx" name="upload_type[docx]" class="form-check-input"
										value="application/vnd.openxmlformats-officedocument.wordprocessingml.document" <?= isset($proyek->upload_type->docx) ? 'checked' : '';?>>
									<label class="form-check-label" for="checkDocx">Docx (word file)</label>
								</div>
								<!-- End Checkbox -->
								<!-- Checkbox -->
								<div class="form-check mb-3">
									<input type="checkbox" id="checkPptx" name="upload_type[pptx]" class="form-check-input"
										value="application/vnd.openxmlformats-officedocument.presentationml.presentation" <?= isset($proyek->upload_type->pptx) ? 'checked' : '';?>>
									<label class="form-check-label" for="checkPptx">Pptx (powerpoint file)</label>
								</div>
								<!-- End Checkbox -->
							</div>
							<div class="col-4">
								<!-- Checkbox -->
								<div class="form-check mb-3">
									<input type="checkbox" id="checkXlsx" name="upload_type[xlsx]" class="form-check-input"
										value="vapplication/vnd.openxmlformats-officedocument.spreadsheetml.sheet" <?= isset($proyek->upload_type->xlsx) ? 'checked' : '';?>>
									<label class="form-check-label" for="checkXlsx">Xlsx (Excel file)</label>
								</div>
								<!-- End Checkbox -->
								<!-- Checkbox -->
								<div class="form-check mb-3">
									<input type="checkbox" id="checkJpg" name="upload_type[jpg]" class="form-check-input" value="image/jpg" <?= isset($proyek->upload_type->jpg) ? 'checked' : '';?>>
									<label class="form-check-label" for="checkJpg">jpg</label>
								</div>
								<!-- End Checkbox -->
							</div>
							<div class="col-4">
								<!-- Checkbox -->
								<div class="form-check mb-3">
									<input type="checkbox" id="checkJpeg" name="upload_type[jpeg]" class="form-check-input" value="image/jpeg" <?= isset($proyek->upload_type->jpeg) ? 'checked' : '';?>>
									<label class="form-check-label" for="checkJpeg">jpeg</label>
								</div>
								<!-- End Checkbox -->
								<!-- Checkbox -->
								<div class="form-check mb-3">
									<input type="checkbox" id="checkPng" name="upload_type[png]" class="form-check-input" value="image/png" <?= isset($proyek->upload_type->png) ? 'checked' : '';?>>
									<label class="form-check-label" for="checkPng">png</label>
								</div>
								<!-- End Checkbox -->
							</div>
						</div>
						<small class="text-secondary">Pilih tipe file yang diperbolehkan untuk staff mengunggah berkas
							verifikasi task mereka. (harap pilih minimal 1)</small>
					</div>

					<div class="mb-3">
						<label for="formKeterangan" class="form-label">Keterangan <small
								class="text-secondary">(optional)</small></label>
						<?php if($proyek->is_selesai == 1):?>
						<p><?= $proyek->keterangan;?></p>
						<?php else:?>
						<textarea name="keterangan" class="form-control form-control-sm ckeditor" id="formKeterangan"
							rows="3" placeholder="Keterangan"
							<?= $proyek->is_selesai == 1 ? 'readonly' : ''?>><?= $proyek->keterangan;?></textarea>
						<?php endif;?>
					</div>
					<!-- End Form -->
					<div class="modal-footer p-0 pt-3">
						<button type="button" class="btn btn-sm btn-white" data-bs-dismiss="modal">Batal</button>
						<button type="submit" class="btn btn-sm btn-primary">Ubah Proyek</button>
						<a href="<?= site_url('api/proyek/hapus/'.$proyek->id);?>"
							class="btn btn-sm btn-soft-danger">Hapus Proyek</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- End Modal -->



<!-- Modal -->
<div id="tutup-proyek" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalTambah" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered " role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modalTambah">Ubah Informasi Proyek</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form action="<?= site_url('api/proyek/tutup');?>" method="post" class="js-validate needs-validation" enctype="multipart/form-data"
					novalidate>
					<input type="hidden" name="id" value="<?= $proyek->id;?>">
					<p>Apakah anda yakin ingin menutup proyek ini?</p>
					<!-- End Form -->
					<div class="modal-footer p-0 pt-3">
						<button type="button" class="btn btn-sm btn-white" data-bs-dismiss="modal">Batal</button>
						<button type="submit" class="btn btn-sm btn-warning">Tutup Proyek</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- End Modal -->

<script>
	function showDetail(status, task) {
		$.ajax({
			type: "POST",
			url: `<?= site_url('api/proyek/detailTask');?>`,
			data: {
				status: status,
				task: task
			},
			success: function (data) {
				$('#detailTask').html(data);
			},
			error: function (xhr, status, error) {
				Swal.fire({
					text: 'Gagal menampilkan detail task',
					icon: 'error',
				})
				console.error(xhr);
			}
		});
	}

</script>