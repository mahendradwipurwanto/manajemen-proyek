<!-- Page Header -->
<div class="docs-page-header">
	<div class="row align-items-center">
		<div class="col-sm">
			<h1 class="docs-page-header-title">Staff
				<button type="button" class="btn btn-xs btn-soft-primary float-end" data-bs-toggle="modal"
					data-bs-target="#tambah-staff">Tambah staff</button>
				<a href="<?= site_url('proyek/kelola/'.$proyek_kode);?>"
					class="btn btn-xs btn-light float-end me-3">kembali</a>
			</h1>
			<p class="docs-page-header-text">Kelola semua akun staff yang telah terdaftar pada website</p>
		</div>
	</div>
</div>
<!-- Card -->
<div class="card">
	<!-- Table -->
	<div class="card-body p-4">
		<table class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table"
			id="table">
			<thead class="thead-light">
				<tr>
					<th rowspan="2" width="5%">No</th>
					<th rowspan="2">Nama</th>
					<th rowspan="2">Status staff</th>
					<th colspan="3" class="text-center">Task</th>
					<th rowspan="2" style="width: 5%;"></th>
				</tr>
				<tr>
					<th class="text-center">total</th>
					<th class="text-center">pengerjaan</th>
					<th class="text-center">selesai</th>
				</tr>
			</thead>

			<tbody>
				<?php if(!empty($staff)):?>
				<?php $no=1;foreach($staff as $key => $val):?>
				<tr>
					<td><?= $no++;?>.</td>
					<td>
						<div class="d-flex align-items-center">
							<div class="flex-shrink-0">
								<img class="avatar avatar-sm avatar-circle" src="<?= base_url();?><?= $val->profil;?>"
									alt="Profil">
							</div>

							<div class="flex-grow-1 ms-3">
								<a class="d-inline-block link-dark" href="#">
									<h6 class="text-hover-primary mb-0"><?= $val->nama;?></h6>
								</a>
								<small
									class="d-block"><?= isset($val->jabatan) || $val->jabatan != null ? $val->jabatan : '-';?></small>
							</div>
						</div>
					</td>
					<td>
						<?php if($val->task_proses['total'] > 0):?>
						<span class="badge bg-soft-info">mengerjakan task</span>
						<?php else:?>
						<span class="badge bg-soft-warning">idle</span>
						<?php endif;?>
					</td>
					<td>
						<span data-bs-toggle="modal" data-bs-target="#listTask-<?= $val->user_id;?>"><span
								data-bs-toggle="tooltip" data-bs-html="true"
								title="Lihat daftar total proyek"><b><?= $val->task['total'];?></b>
								Task</span></span>
					</td>
					<td>
						<span data-bs-toggle="modal" data-bs-target="#listTaskProgress-<?= $val->user_id;?>"><span
								data-bs-toggle="tooltip" data-bs-html="true"
								title="Lihat daftar proyek aktif"><b><?= $val->task_proses['total'];?></b>
								Task</span></span>
					</td>
					<td>
						<span data-bs-toggle="modal" data-bs-target="#listTaskSelesai-<?= $val->user_id;?>"><span
								data-bs-toggle="tooltip" data-bs-html="true"
								title="Lihat daftar proyek aktif"><b><?= $val->task_selesai['total'];?></b>
								Task</span></span>
					</td>
					<td>
						<button type="button" class="btn btn-xs btn-soft-danger mr-2" data-bs-toggle="modal"
							data-bs-target="#keluarkan-<?= $val->user_id;?>">keluarkan</button>
						<!-- <button type="button" class="btn btn-xs btn-soft-primary" data-bs-toggle="modal"
							data-bs-target="#detail-<?= $val->user_id;?>">detail</button> -->
					</td>
				</tr>

				<!-- Modal -->
				<div id="listTask-<?= $val->user_id;?>" class="modal fade" tabindex="-1" role="dialog"
					aria-labelledby="modalTambah" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="modalTambah">Daftar task staff</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal"
									aria-label="Close"></button>
							</div>
							<div class="modal-body">
								<?php if(!empty($val->task['list'])):?>
								<!-- List Striped -->
								<ul class="list-group list-group-lg w-100 mx-0"
									style="max-height: 300px; overflow: auto;">
									<?php foreach($val->task['list'] as $keys => $value):?>
									<li class="list-group-item py-2">
										<div class="row justify-content-between">
											<div class="col-sm-6 mb-2 mb-sm-0">
												<span class="h6"><?= $value->task;?></span>
											</div>
											<!-- End Col -->

											<!-- End Col -->
											<div class="col-sm-4 mb-2 mb-sm-0">
												<span
													class="badge bg-soft-<?= $value->warna;?>"><?= $value->status;?></span>
											</div>
											<!-- End Col -->
										</div>
										<!-- End Row -->
									</li>
									<?php endforeach;?>
								</ul>
								<!-- End List Striped -->
								<?php else:?>
								<div class="alert alert-secondary mb-0">
									Belum ada task
								</div>
								<?php endif;?>
							</div>
						</div>
					</div>
				</div>
				<!-- End Modal -->

				<!-- Modal -->
				<div id="listTaskProgress-<?= $val->user_id;?>" class="modal fade" tabindex="-1" role="dialog"
					aria-labelledby="modalTambah" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="modalTambah">Daftar task staff</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal"
									aria-label="Close"></button>
							</div>
							<div class="modal-body">
								<?php if(!empty($val->task_proses['list'])):?>
								<!-- List Striped -->
								<ul class="list-group list-group-lg w-100 mx-0"
									style="max-height: 300px; overflow: auto;">
									<?php foreach($val->task_proses['list'] as $keys => $value):?>
									<li class="list-group-item py-2">
										<div class="row justify-content-between">
											<div class="col-sm-6 mb-2 mb-sm-0">
												<span class="h6"><?= $value->task;?></span>
											</div>
											<!-- End Col -->

											<!-- End Col -->
											<div class="col-sm-4 mb-2 mb-sm-0">
												<span
													class="badge bg-soft-<?= $value->warna;?>"><?= $value->status;?></span>
											</div>
											<!-- End Col -->
										</div>
										<!-- End Row -->
									</li>
									<?php endforeach;?>
								</ul>
								<!-- End List Striped -->
								<?php else:?>
								<div class="alert alert-secondary mb-0">
									Belum ada task
								</div>
								<?php endif;?>
							</div>
						</div>
					</div>
				</div>
				<!-- End Modal -->

				<!-- Modal -->
				<div id="listTaskSelesai-<?= $val->user_id;?>" class="modal fade" tabindex="-1" role="dialog"
					aria-labelledby="modalTambah" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="modalTambah">Daftar task staff</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal"
									aria-label="Close"></button>
							</div>
							<div class="modal-body">
								<?php if(!empty($val->task_selesai['list'])):?>
								<!-- List Striped -->
								<ul class="list-group list-group-lg w-100 mx-0"
									style="max-height: 300px; overflow: auto;">
									<?php foreach($val->task_selesai['list'] as $keys => $value):?>
									<li class="list-group-item py-2">
										<div class="row justify-content-between">
											<div class="col-sm-6 mb-2 mb-sm-0">
												<span class="h6"><?= $value->task;?></span>
											</div>
											<!-- End Col -->

											<!-- End Col -->
											<div class="col-sm-4 mb-2 mb-sm-0">
												<span
													class="badge bg-soft-<?= $value->warna;?>"><?= $value->status;?></span>
											</div>
											<!-- End Col -->
										</div>
										<!-- End Row -->
									</li>
									<?php endforeach;?>
								</ul>
								<!-- End List Striped -->
								<?php else:?>
								<div class="alert alert-secondary mb-0">
									Belum ada task
								</div>
								<?php endif;?>
							</div>
						</div>
					</div>
				</div>
				<!-- End Modal -->

				<!-- Modal -->
				<div id="keluarkan-<?= $val->user_id;?>" class="modal fade" tabindex="-1" role="dialog"
					aria-labelledby="modalTambah" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="modalTambah">keluarkan</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal"
									aria-label="Close"></button>
							</div>
							<div class="modal-body">
								<p>Apakah anda yakin ingin mengeluarkan <b><?= $val->nama;?></b> dari proyek ini?</p>
								<!-- End Form -->
								<div class="modal-footer p-0 pt-3">
									<button type="button" class="btn btn-sm btn-white"
										data-bs-dismiss="modal">Batal</button>
									<a href="<?= site_url('api/proyek/keluarkanStaff/'.$val->proyek_id.'/'.$val->user_id);?>"
										class="btn btn-sm btn-danger">Keluarkan staff</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- End Modal -->


				<?php endforeach;?>
				<?php endif;?>
			</tbody>
		</table>
	</div>
	<!-- End Table -->
</div>
<!-- End Card -->


<!-- Modal -->
<div id="tambah-staff" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalTambah" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modalTambah">Assign Staff</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<!-- Form -->
				<div class="mb-3">
					<form action="<?= site_url('api/proyek/assignStaffBulk');?>" method="post"
						class="js-validate need-validate" novalidate>
						<input type="hidden" name="proyek_id" value="<?= $proyek_id;?>">
						<label class="form-label" for="formEmail">Staff</label>
						<div class="row">
							<div class="col-9">
								<div class="tom-select-custom tom-select-custom-with-tags">
									<select class="js-select form-select form-select-sm" autocomplete="off" multiple
										name="staff[]" data-hs-tom-select-options='{"placeholder": "Pilih staff"}'>
										<?php if(!empty($staff_free)):?>
										<?php foreach($staff_free as $k => $v):?>
										<option value="<?= $v->user_id;?>"><?= $v->nama;?>
										</option>
										<?php endforeach;?>
										<?php else:?>
										<option>Tidak ada staff yang tersedia</option>
										<?php endif;?>
									</select>
								</div>
							</div>
							<div class="col-3">
								<button type="submit" class="btn btn-sm btn-primary w-100">Undang</button>
							</div>
						</div>
						<small class="text-secondary">Staff akan menerima pemberitahuan saat
							ditambahkan kedalam proyek</small>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- End Modal -->
