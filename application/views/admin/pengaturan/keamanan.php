<!-- Page Header -->
<div class="docs-page-header">
	<div class="row align-items-center">
		<div class="col-sm">
			<h1 class="docs-page-header-title">Keamanan</h1>
			<p class="docs-page-header-text">Kelola akun dan keamanan website anda</p>
		</div>
	</div>
</div>
<!-- Card -->
<div class="row">
	<div class="col-8">
		<div class="card">
			<!-- Table -->
			<div class="card-body p-4">
				<table class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table"
					id="table">
					<thead class="thead-light">
						<tr>
							<th width="5%">No</th>
							<th>Pengguna</th>
							<th>Akses Terakhir</th>
							<th>Status Akun</th>
						</tr>
					</thead>

					<tbody>
						<?php if(!empty($account)):?>
						<?php $no=1;foreach($account as $key => $val):?>
						<tr>
							<td><?= $no++;?>.</td>
							<td>
								<div class="d-flex align-items-center">
									<div class="flex-grow-1">
										<a class="d-inline-block link-dark" href="#">
											<h6 class="text-hover-primary mb-0"><?= $val->nama;?>
												<?php if($val->role == 0):?>
												<span data-bs-toggle="tooltip" data-bs-html="true" title="Super Admin"
													class="badge bg-soft-danger small ms-2">Super Admin</span>
												<?php elseif($val->role == 1):?>
												<span data-bs-toggle="tooltip" data-bs-html="true" title="Admin"
													class="badge bg-soft-info small ms-2">Admin</span>
												<?php elseif($val->role == 2):?>
												<span data-bs-toggle="tooltip" data-bs-html="true" title="Leader"
													class="badge bg-soft-warning small ms-2">Leader</span>
												<?php elseif($val->role == 3):?>
												<span data-bs-toggle="tooltip" data-bs-html="true" title="Staff"
													class="badge bg-soft-success small ms-2">Staff</span>
												<?php endif;?>
											</h6>
										</a>
										<small class="d-block"><?= $val->email;?></small>
									</div>
								</div>
							</td>
							<td><?= date("d F Y - H:i:s", $val->log_time);?></td>
							<td>
								<?php if($val->is_deleted == 1):?>
								<span data-bs-toggle="tooltip" data-bs-html="true" title="deleted"
									class="badge bg-soft-danger small ms-2">deleted</span>
								<?php elseif($val->status == 0):?>
								<span data-bs-toggle="tooltip" data-bs-html="true" title="unverified"
									class="badge bg-soft-warning small ms-2">unverified</span>
								<?php elseif($val->status == 1):?>
								<span data-bs-toggle="tooltip" data-bs-html="true" title="active"
									class="badge bg-soft-success small ms-2">active</span>
								<?php elseif($val->status == 2):?>
								<span data-bs-toggle="tooltip" data-bs-html="true" title="suspend"
									class="badge bg-secondary small ms-2">suspend</span>
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
	<div class="col-4">
		<div class="card card-body">
			<h4>Master Credentials</h4>
			<form action="<?= site_url('api/website/ubahPasswordMaster');?>" method="post" class="js-validate needs-validation"
				novalidate>
				<div class="mb-3">
					<label for="inputEmailAdmin">Email Admin<small class="text-danger">*</small></label>
					<input type="mail" class="form-control form-control-sm" name="email" placeholder="Input Email" value="<?= $admin->email;?>"
						required>
				</div>
				<div class="mb-3">
					<label for="inputPasswordAdmin">Password Admin<small class="text-danger">*</small></label>
					<input type="password" class="form-control form-control-sm" name="admin" value="">
				</div>
				<div class="mb-3">
					<label for="inputPasswordMaster">Password Master<small class="text-danger">*</small></label>
					<input type="password" class="form-control form-control-sm" name="master" value=""
						required>
				</div>
				<button type="submit" class="btn btn-primary btn-sm float-end">Simpan Perubahan</button>
			</form>
		</div>
	</div>
</div>
<!-- End Card -->
