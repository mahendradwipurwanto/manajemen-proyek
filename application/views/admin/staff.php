<!-- Page Header -->
<div class="docs-page-header">
	<div class="row align-items-center">
		<div class="col-sm">
			<h1 class="docs-page-header-title">Staff
				<!-- <button type="button" class="btn btn-sm btn-primary float-end" data-bs-toggle="modal"
					data-bs-target="#tambah">Tambah leader</button> -->
			</h1>
			<p class="docs-page-header-text">Pantau semua akun staff yang telah terdaftar pada website</p>
		</div>
	</div>
</div>
<!-- End Page Header -->
<div class="row mb-4">
	<div class="col-md-3 col-sm-12">
		<div class="card">
			<div class="card-body p-4">
				<div class="h6">Total staff</div>
				<div style="position: absolute;right: 15px;bottom: 0px;">
					<h1 class="h1"><?= number_format(1,0,",",".")?></h1>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-3 col-sm-12">
		<div class="card">
			<div class="card-body p-4">
				<div class="h6">Aktif staff</div>
				<div style="position: absolute;right: 15px;bottom: 0px;">
					<h1 class="h1"><?= number_format(1,0,",",".")?></h1>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-3 col-sm-12">
		<div class="card">
			<div class="card-body p-4">
				<div class="h6">Idle</div>
				<div style="position: absolute;right: 15px;bottom: 0px;">
					<h1 class="h1"><?= number_format(1,0,",",".")?></h1>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-3 col-sm-12">
		<div class="card">
			<div class="card-body p-4">
				<div class="h6">Akun non-aktif</div>
				<div style="position: absolute;right: 15px;bottom: 0px;">
					<h1 class="h1"><?= number_format(1,0,",",".")?></h1>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Card -->
<div class="card">
	<!-- Table -->
	<div class="card-body p-4">
		<table class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table" id="table">
			<thead class="thead-light">
				<tr>
					<th width="5%">No</th>
					<th>Nama</th>
					<th>Status staff</th>
					<th>Total proyek</th>
					<th>Proyek aktif</th>
					<th style="width: 5%;"></th>
				</tr>
			</thead>

			<tbody>
				<tr>
                    <td>1.</td>
					<td>
						<div class="d-flex align-items-center">
							<div class="flex-shrink-0">
								<img class="avatar avatar-sm avatar-circle" src="<?= base_url();?>assets/img/160x160/img8.jpg"
									alt="Image Description">
							</div>

							<div class="flex-grow-1 ms-3">
								<a class="d-inline-block link-dark" href="#">
									<h6 class="text-hover-primary mb-0">Amanda Harvey <img
											class="avatar avatar-xss ms-1"
											src="<?= base_url();?>/assets/svg/illustrations/top-vendor.svg" alt="Image Description"
											data-bs-toggle="tooltip" data-bs-placement="top" title="Verified user"></h6>
								</a>
								<small class="d-block">amanda@example.com</small>
							</div>
						</div>
					</td>
					<td>
						<span class="badge bg-warning">idle</span>
					</td>
					<td>
						<b>12</b> Proyek
					</td>
					<td>
						<b>4</b> Proyek
					</td>
					<td>
						<a class="text-body" href="javascript:;" data-bs-toggle="tooltip" data-bs-placement="top"
							title="Locked">
							<i class="bi-lock-fill"></i>
						</a>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
	<!-- End Table -->
</div>
<!-- End Card -->
