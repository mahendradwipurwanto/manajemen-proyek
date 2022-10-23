<!-- Page Header -->
<div class="docs-page-header mt-5">
	<div class="row align-items-center">
		<div class="col-sm">
			<h1 class="docs-page-header-title d-flex justify-content-between">Laporan Proyek
				<form action="<?= site_url('proyek/laporan');?>" method="post" class="d-flex">
					<div class="input-group input-group-sm">
						<span class="input-group-text" id="basic-addon2"><i class="bi bi-calendar-week"></i></span>
						<input type="text" class="form-control form-control-sm" name="periode"
							placeholder="Periode proyek" aria-describedby="basic-addon2" required>
					</div>
					<button type="submit" class="btn btn-primary btn-sm ms-3">Tampilkan</button>
					<?php if($this->input->post('periode')):?>
					<a href="<?= current_url();?>" class="btn btn-sm btn-outline-secondary ms-2">Reset</a>
					<?php endif;?>
				</form>
			</h1>
			<p class="docs-page-header-text">Pantau progres dari semua proyek
				<?php if($this->input->post('periode')):?>
				<span class="text-body  pb-3 me-3"> - periode <span
						class="text-primary"><?= $this->input->post('periode');?></span></span>
				<?php endif;?>
			</p>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header py-3">
				<h4 class="card-header-title">Proyek</h4>
			</div>
			<!-- Table -->
			<div class="card-body p-4">
				<table class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table"
					id="table">
					<thead class="thead-light">
						<tr>
							<th width="5%">No</th>
							<th>Proyek</th>
							<th>Deadline Proyek</th>
							<th class="text-center">Total Task</th>
							<th class="text-center">Task Selesai</th>
							<th>Status</th>
						</tr>
					</thead>

					<tbody>
						<?php if(!empty($proyek)):?>
						<?php $no=1;foreach($proyek as $key => $val):?>
						<tr>
							<td><?= $no++;?>.</td>
							<td>
								<div class="d-flex align-items-center">
									<div class="flex-grow-1">
										<a class="d-inline-block link-dark" href="#">
											<h6 class="text-hover-primary mb-0"><?= $val->judul;?>
												<?php if($val->over_deadline == true && $val->status == 1):?>
												<span class="badge bg-soft-danger">over deadline</span>
												<?php else:?>
												<span class="badge bg-soft-info">pengerjaan</span>
												<?php endif;?>
											</h6>
										</a>
										<small class="d-block">Leader: <?= $val->nama;?></small>
									</div>
								</div>
							</td>
							<td>
								<?= date('d F Y', $val->periode_selesai);?>
							</td>
							<td class="text-center">
								<?= $val->tasks == null ? 0 : count($val->tasks);?>
							</td>
							<td class="text-center">
								<?= $val->tasks_selesai;?>
							</td>
							<td>
								<?php if($val->status == 1):?>
								<span class="badge bg-soft-primary">pengerjaan</span>
								<?php else:?>
								<span class="badge bg-soft-success">selesai</span>
								<?php endif;?>
							</td>
						</tr>
						<?php endforeach;?>
						<?php endif;?>
					</tbody>
				</table>
			</div>
			<!-- End Table -->
		</div>
	</div>
	<div class="col-md-12">
		<div class="card">
			<div class="card-header py-3">
				<h4 class="card-header-title">Tasks</h4>
			</div>
			<!-- Table -->
			<div class="card-body p-4">
				<table class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table"
					id="table2">
					<thead class="thead-light">
						<tr>
							<th width="5%">No</th>
							<th>Tasks</th>
							<th>Staff</th>
							<th>Deadline</th>
							<th>Status</th>
						</tr>
					</thead>

					<tbody>
						<?php if(!empty($tasks)):?>
						<?php $no=1;foreach($tasks as $key => $val):?>
						<tr>
							<td><?= $no++;?>.</td>
							<td>
								<div class="d-flex align-items-center">
									<div class="flex-grow-1">
										<a class="d-inline-block link-dark" href="#">
											<h6 class="text-hover-primary mb-0"><?= $val->task;?>
												<?php if($val->over_deadline == true):?>
												<span class="badge bg-soft-danger">over deadline</span>
												<?php else:?>
												<span class="badge bg-soft-info">pengerjaan</span>
												<?php endif;?>
											</h6>
										</a>
										<small class="d-block">Proyek: <?= $val->judul;?></small>
									</div>
								</div>
							</td>
							<td>
								<?= $val->nama;?>
							</td>
							<td>
								<?= date('d F Y', $val->deadline);?>
							</td>
							<td>
								<span class="badge bg-soft-<?= $val->warna;?>"><?= $val->status;?></span>
							</td>
						</tr>
						<?php endforeach;?>
						<?php endif;?>
					</tbody>
				</table>
			</div>
			<!-- End Table -->
		</div>
	</div>
</div>
