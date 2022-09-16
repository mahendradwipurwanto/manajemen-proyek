<div class="sidebar-footer-offset" style="padding-bottom: 5rem;">
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
								<?php if($task->bukti !== null && $task->bukti !== 0 && $task->bukti !== ''):?>
								<dl class="row">
									<dt class="col-sm-3">Bukti</dt>
									<dd class="col-sm-9">
										<a href="<?= base_url();?><?= $task->bukti;?>" target="_blank"
											class="btn btn-outline-primary btn-xs text-left"><i
												class="bi bi-file-earmark-pdf"></i> Bukti
											penyelesaian</a></dd>
								</dl>
								<?php endif;?>
							</div>
						</div>
					</div>
				</div>
				<div class="d-flex justify-content-between align-items-center mt-3">
					<small class="text-secondary">dibuat <?= $task->dibuat_pada;?></small>
					<small class="text-secondary">diubah <?= $task->diubah_pada;?></small>
				</div>
			</div>
		</div>
		<!-- End Content -->
	</div>
</div>
<?php if($this->session->userdata('role') != 3 || ($this->session->userdata('user_id') == $task->user_id && $task->is_selesai == 0 && $task->is_closed == 0)):?>
<!-- Footer -->
<footer class="sidebar-footer border-top p-2">
	<div class="row">
		<?php if($task->is_selesai == 1 && $this->session->userdata('role') != 3):?>
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
		<?php if($task->is_selesai == 1 && $this->session->userdata('role') != 3):?>
		<div class="col">
			<button type="button" class="btn btn-sm btn-success w-100" data-bs-toggle="modal"
				data-bs-target="#verifikasi-task-<?= $task->id;?>">Verifikasi</button>
		</div>
		<?php endif;?>
	</div>
</footer>
<!-- End Footer -->
<?php endif;?>