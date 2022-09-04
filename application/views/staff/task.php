<!-- Page Header -->
<div class="docs-page-header">
	<div class="row align-items-center">
		<div class="col-sm">
			<h1 class="docs-page-header-title">Proyek <?= isset($proyek->judul) ? '<b>- '.$proyek->judul.'</b>' : '';?>
				<a href="<?= site_url('leader/kelola-proyek');?>"
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
	<div class="col-md-9">
		<div class="card mb-3">
			<div class="card-header py-3">
				<h4 class="card-title mb-0">Kelola Task <span class="badge bg-soft-info ms-2">bobot:
						<?= $bobot->quota_bobot;?>/100</span>
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
						<ul class="list-group list-group-lg w-100" style="max-height: 500px; overflow: auto;">
							<?php if(!empty($val->tasks)):?>
							<?php foreach($val->tasks as $k => $v):?>
							<li class="js-hs-unfold-invoker list-group-item py-2 cursor"
								onclick='showDetail(`<?= json_encode($val);?>`, `<?= json_encode($v);?>`)'
								href="javascript:;" data-hs-unfold-options='{
									"target": "#sidebarContent",
									"type": "css-animation",
									"animationIn": "fadeInRight",
									"animationOut": "fadeOutRight",
									"hasOverlay": "rgba(55, 125, 255, 0.1)",
									"smartPositionOff": true
								}'>
								<div class="row justify-content-between">
									<div class="col-sm-7 mb-2 mb-sm-0">
									</div>
									<div class="col-sm-7 mb-2 mb-sm-0">
										<span class="h5 fw-normal"><?= $v->task;?></span>
										<span class="badge bg-<?= $v->bobot_color;?>"><?= $v->bobot;?>%</span>
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
														readonly>
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
														<small class="text-danger">*</small></label>
													<div class="col-4">
														<div class="input-group input-group-sm">
															<input type="number" class="form-control form-control-sm"
																name="bobot" placeholder="Bobot task" min="0"
																max="<?= (100-$bobot->quota_bobot);?>"
																value="<?= $v->bobot;?>" aria-label="Bobot"
																aria-describedby="input-bobot-task" readonly>
															<span class="input-group-text"
																id="input-bobot-task">%</span>
														</div>
													</div>
													<div class="col-5">
														<span class="badge bg-soft-info ms-2">bobot tersisa:
															<?= $bobot->quota_bobot;?>/100</span>
													</div>
												</div>

												<div class="mb-3">
													<label class="form-label" for="formTaskKeterangan">Keterangan <small
															class="text-danger">*</small></label>
													<textarea type="text" name="keterangan"
														class="form-control form-control-sm ckeditor"
														placeholder="Keterangan" rows="3"
														readonly><?= $v->keterangan;?></textarea>
												</div>
												<!-- End Form -->
												<!-- End From -->
												<div class="modal-footer p-0 pt-3">
													<button type="button" class="btn btn-sm btn-white"
														data-bs-dismiss="modal">Batal</button>
													<button type="submit" class="btn btn-sm btn-primary">Simpan</button>
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

<script>
	function showDetail(status, task) {
		$.ajax({
			type: "POST",
			url: `<?= site_url('api/proyek/detailTask');?>`,
			data: {
				status: JSON.parse(status),
				task: JSON.parse(task)
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
