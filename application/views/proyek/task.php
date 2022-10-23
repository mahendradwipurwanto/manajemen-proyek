<div class="sidebar-footer-offset pt-3">
	<div class="sidebar-scroller">

		<!-- Content -->
		<div class="scrollbar sidebar-body">
			<div class="sidebar-content p-4">
				<div class="row mb-2">
					<div class="col-12">
						<h3><?= $task->task;?></h3>
					</div>
				</div>
				<div class="row mb-2">
					<div class="col-12">
						<span class="badge bg-<?= $status->warna;?> me-2"><?= $status->status;?></span> <span
							class="badge bg-<?= $task->bobot_color;?>">bobot <?= $task->bobot;?>%</span>
					</div>
				</div>
				<div class="row mb-2">
					<div class="col-12">
						<small class="fw-bold">deskripsi</small>
						<p><?= $task->keterangan != '' ? $task->keterangan : '-';?></p>
					</div>
				</div>
				<!-- Accordion -->
				<div class="accordion accordion-btn-icon-start" id="detail-task-parent">
					<div class="accordion-item">
						<div class="accordion-header" id="data-task-content">
							<a class="accordion-button small" role="button" data-bs-toggle="collapse"
								data-bs-target="#detail-task-header" aria-expanded="true"
								aria-controls="detail-task-header">
								Detail Task
							</a>
						</div>
						<div id="detail-task-header" class="accordion-collapse collapse show"
							aria-labelledby="data-task-content" data-bs-parent="#accordionExample">
							<div class="accordion-body small">
								<dl class="row">
									<dt class="col-sm-3">Staff</dt>
									<dd class="col-sm-9">
										<div class="participants d-flex justify-content-start align-items-center">
											<img src="<?= base_url();?><?= $task->profil;?>" alt="<?= $task->nama;?>"
												data-bs-toggle="tooltip" class="me-2" data-bs-html="true"
												title="<?= $task->nama;?>">
											<?= $task->nama;?>
										</div>
									</dd>
								</dl>
								<dl class="row">
									<dt class="col-sm-3">Deadline</dt>
									<dd class="col-sm-9"><?= $task->deadline_tgl;?></dd>
								</dl>
								<dl class="row">
									<dt class="col-sm-3">Status</dt>
									<dd class="col-sm-9">
										<span
											class="badge bg-soft-<?= $status->is_mulai == 1 ? 'secondary' : ($status->is_selesai == 1 ? 'warning' : ($status->is_closed == 1 ? 'success' : 'info')) ;?>"><?= $status->is_mulai == 1 ? 'todo' : ($status->is_selesai == 1 ? 'belum verifikasi' : ($status->is_closed == 1 ? 'selesai' : 'proses pengerjaan')) ;?></span>
										<?php if($task->pernah_ditolak == 1 && $task->is_closed == 0):?>
										<span class="badge bg-soft-danger ms-2">ditolak</span>
										<?php endif;?>
										<?php if($task->is_closed == 1):?>
										<span class="badge bg-soft-success ms-2">selesai</span>
										<?php endif;?>
									</dd>
								</dl>
								<?php if($task->pernah_ditolak == 1 && $task->is_closed == 0):?>
								<dl class="row">
									<dt class="col-sm-3">Alasan</dt>
									<dd class="col-sm-9"><?= $task->catatan_ditolak;?></dd>
								</dl>
								<?php endif;?>
								<?php if($task->is_closed == 1):?>
								<dl class="row">
									<dt class="col-sm-3">Selesai</dt>
									<dd class="col-sm-9"><?= $task->catatan_diterima;?></dd>
								</dl>
								<?php endif;?>
								<?php if(!empty($bukti)):?>
								<dl class="row">
									<dt class="col-sm-3">Bukti</dt>
									<dd class="col-sm-9">
										<?php foreach($bukti as $k => $v):?>
										<a href="<?= base_url();?><?= $v->bukti;?>" target="_blank"
											class="btn btn-outline-primary btn-xs text-left mb-2"><i
												class="bi bi-file-earmark-<?= $v->icon;?>"></i> <?php $nama_file = explode("/", $v->bukti); echo substr(end($nama_file), 0, 30);?></a>
										<?php endforeach;?>
									</dd>
								</dl>
								<?php endif;?>
							</div>
						</div>
					</div>
				</div>
				<div class="d-flex justify-content-between align-items-center mt-3 mb-3">
					<small class="text-secondary">dibuat <?= $task->dibuat_pada;?></small>
					<small class="text-secondary">diubah <?= $task->diubah_pada;?></small>
				</div>
				<hr>
				<div class="row mb-2">
					<div class="col-12">
						<small class="fw-bold">komentar</small>


						<!-- Comment -->
						<ul class="list-comment mt-2 pt-2">
							<?php if(!empty($komentar)):?>
							<?php foreach($komentar as $key => $val):?>
							<?php if($val->user_id == $this->session->userdata('user_id')):?>
							<!-- Item -->
							<li class="list-comment-item mt-2 mb-4 comments-has-border">
								<!-- Media -->
								<div class="d-flex align-items-center mb-3">
									<div class="flex-shrink-0">
										<img class="avatar avatar-xs avatar-circle"
											src="<?= base_url();?><?= $val->profil;?>" alt="Image Description">
									</div>
									<div class="flex-grow-1 ms-3">
										<div class="d-flex justify-content-between align-items-center">
											<h6 class="mb-0">
												<?php $nama = explode(" ", $val->nama); echo $nama[0];?> (You)
												<a href="<?= site_url('api/proyek/hapusKomentar/'.$val->id);?>"
													class="text-danger btn-xs"><i class="bi bi-trash"></i></a>
											</h6>
											<span class="d-block small text-muted"><?= $val->created_at;?></span>
										</div>
									</div>
								</div>
								<!-- End Media -->

								<p class="small"><?= $val->komentar;?></p>
							</li>
							<!-- End Item -->
							<?php else:?>
							<!-- Item -->
							<li class="list-comment-item mt-2 mb-4 comments-has-border">
								<!-- Media -->
								<div class="d-flex align-items-center mb-3">
									<div class="flex-shrink-0">
										<img class="avatar avatar-xs avatar-circle"
											src="<?= base_url();?><?= $val->profil;?>" alt="Image Description">
									</div>

									<div class="flex-grow-1 ms-3">
										<div class="d-flex justify-content-between align-items-center">
											<h6 class="mb-0"><?php $nama = explode(" ", $val->nama); echo $nama[0];?>
											</h6>
											<span class="d-block small text-muted"><?= $val->created_at;?></span>
										</div>
									</div>
								</div>
								<!-- End Media -->

								<p class="small"><?= $val->komentar;?></p>
							</li>
							<!-- End Item -->
							<?php endif;?>
							<?php endforeach;?>
							<?php else:?>
							<h6 class="mb-0 text-center">- belum ada komentar -</h6>
							<?php endif;?>
							<hr>
							<li class="list-comment-item mt-2">
								<div class="mb-4">
									<form action="<?= site_url('api/proyek/tambahKomentar');?>" method="post" class="js-validate needs-validation" novalidate>
										<input type="hidden" name="id" value="<?= $task->id;?>">
										<input type="hidden" name="task" value="<?= $task->task;?>">
										<label class="form-label" for="formKomentar">Tambah komentar</label>
										<textarea class="form-control form-control-sm" name="komentar" id="formKomentar"
											placeholder="Tambah komentar" aria-label="Tambah komentar"
											rows="3"></textarea>
										<button type="submit" class="btn btn-primary btn-xs float-end mt-3">tambah</button>
									</form>
								</div>
							</li>
							<br>
						</ul>


					</div>
				</div>
			</div>
		</div>
		<!-- End Content -->
	</div>
</div>
<?php if(($this->session->userdata('role') == 0 || $this->session->userdata('role') == 1 || $this->session->userdata('is_leader') == true) || ($this->session->userdata('user_id') == $task->user_id && $task->is_selesai == 0 && $task->is_closed == 0)):?>
<!-- Footer -->
<footer class="sidebar-footer border-top p-2">
	<div class="row">
		<?php if($task->is_selesai == 1 && ($this->session->userdata('role') == 0 || $this->session->userdata('role') == 1 || ($this->session->userdata('is_leader') == true && $this->session->userdata('is_leader') != false))):?>
		<div class="col">
			<button type="button" class="btn btn-sm btn-danger w-100" data-bs-toggle="modal"
				data-bs-target="#tolak-task-<?= $task->id;?>">Tolak</button>
		</div>
		<?php else:?>
		<div class="col">
			<button type="button" class="btn btn-sm btn-primary w-100" data-bs-toggle="modal"
				data-bs-target="#detail-task-<?= $task->id;?>">ubah</button>
		</div>
		<?php endif;?>
		<?php if($task->is_selesai == 0 && $task->is_closed == 0):?>
		<div class="col">
			<button type="button" class="btn btn-sm btn-success w-100" data-bs-toggle="modal"
				data-bs-target="#selesaikan-task-<?= $task->id;?>">selesaikan task</button>
		</div>
		<?php endif;?>
		<?php if($task->is_selesai == 1 && ($this->session->userdata('role') == 0 || $this->session->userdata('role') == 1 || $this->session->userdata('is_leader') == true)):?>
		<div class="col">
			<button type="button" class="btn btn-sm btn-success w-100" data-bs-toggle="modal"
				data-bs-target="#verifikasi-task-<?= $task->id;?>">Verifikasi</button>
		</div>
		<?php endif;?>
	</div>
</footer>
<!-- End Footer -->
<?php endif;?>
