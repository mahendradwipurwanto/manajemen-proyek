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
					href="#edit-proyek" onclick='showEditProyek()'>informasi proyek</button>
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
										<div class="modal-body" id="contentSelesaikan">
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
		<div class="card mb-4">
			<div class="card-header py-3">
				<h4 class="card-title mb-0">File pendukung</h4>
			</div>
			<div class="card-body p-3">
				<?php if(!empty($proyek->file_pendukung)):?>
				<?php foreach($proyek->file_pendukung as $keyPendukung => $valPendukung):?>
				<a href="<?= base_url();?><?= $valPendukung->file;?>" class="btn btn-outline-primary btn-sm mb-2" target="_blank"><i class="bi bi-file-pdf"></i> file pendukung proyek</a>
				<?php endforeach;?>
				<?php else:?>
				<center><span class="text-secondary">Tidak ada file pendukung</span></center>
				<?php endif;?>
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
			<div class="modal-body" id="editDetailProyek">
			</div>
		</div>
	</div>
</div>
<!-- End Modal -->



<!-- Modal -->
<div id="tutup-proyek" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalTambah" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modalTambah">Tutup Proyek</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form action="<?= site_url('api/proyek/tutup');?>" method="post" class="js-validate needs-validation" enctype="multipart/form-data"
					novalidate>
					<input type="hidden" name="id" value="<?= $proyek->id;?>">
					<div class="alert alert-soft-primary small">Anda akan menutup proyek ini, harap berikan nilai pada staff yang terlibat pada proyek ini</div>
					<table class="table table-hover w-100">
						<thead class="thead-light">
							<tr>
								<th style="width: 10%;" class="border-bottom">No</th>
								<th style="width: 40%;" class="border-bottom">Nama</th>
								<th style="width: 15%;" class="border-bottom">Total Task</th>
								<th style="width: 15%;" class="border-bottom">Selesai</th>
								<th style="width: 20%;" class="border-bottom">Nilai</th>
							</tr>
						</thead>
						<tbody>
							<?php if(!empty($leader)):?>
							<tr>
								<td>1</td>
								<td><?= $leader[0]->nama;?> <span class="badge bg-warning">leader</span></td>
								<td><?= $leader[0]->task['total'];?></td>
								<td><?= $leader[0]->task_selesai['total'];?></td>
								<td>
									<input type="hidden" class="form-control form-control-sm w-100" name="leader_id" value="<?= $leader[0]->user_id;?>" required>
									<input type="text" class="form-control form-control-sm w-100" name="nilai_leader" placeholder="nilai" required>
								</td>
							</tr>
							<?php endif;?>
							<?php if(!empty($staff)):?>
							<?php $no = 2; foreach($staff as $k => $v):?>
							<tr>
								<td><?= $no++;?></td>
								<td><?= $v->nama;?></td>
								<td><?= $v->task['total'];?></td>
								<td><?= $v->task_selesai['total'];?></td>
								<td>
									<input type="hidden" class="form-control form-control-sm w-100" name="staff_id[]" value="<?= $v->user_id;?>" required>
									<input type="text" class="form-control form-control-sm w-100" name="nilai[]" placeholder="nilai" required>
								</td>
							</tr>
							<?php endforeach;?>
							<?php endif;?>
						</tbody>
					</table>
					<!-- #KPI MANUAL -->
					<!-- End Form -->
					<div class="modal-footer p-0 pt-3">
						<button type="button" class="btn btn-sm btn-white" data-bs-dismiss="modal">Batal</button>
						<button type="submit" class="btn btn-sm btn-warning">Simpan nilai dan Tutup Proyek</button>
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

	function showSelesaikan(id) {
		$.ajax({
			type: "POST",
			url: `<?= site_url('api/proyek/selesaikanTaskEdit');?>`,
			data: {
				task_id: id
			},
			success: function (data) {
				$('#contentSelesaikan').html(data);
			},
			error: function (xhr, status, error) {
				Swal.fire({
					text: 'Gagal menampilkan task',
					icon: 'error',
				})
				console.error(xhr);
			}
		});
	}

	function showEditProyek() {
		$.ajax({
			type: "POST",
			url: `<?= site_url('api/proyek/ajaxEditProyek');?>`,
			success: function (data) {
				$('#editDetailProyek').html(data);
			},
			error: function (xhr, status, error) {
				Swal.fire({
					text: 'Gagal menampilkan proyek',
					icon: 'error',
				})
				console.error(xhr);
			}
		});
	}

</script>