<div class="sidebar-footer-offset" style="padding-bottom: 5rem;">
  	<div class="sidebar-scroller">
	<!-- Toggle Button -->
	<div class="d-flex justify-content-between align-items-center pt-4 px-4">
		<div class="d-flex justify-content-start align-items-center">
			<span class="badge bg-soft-primary"><i class="bi bi-chevron-double-up"></i></span>
			<small class="text-secondary ms-2"><?= $this->session->userdata('proyek')['kode'];?>-<?= $task['id'];?></small>
		</div>
		<div class="hs-unfold">
			<a class="js-hs-unfold-invoker btn btn-icon btn-xs btn-soft-secondary" href="javascript:;"
				data-hs-unfold-options='{
                                "target": "#sidebarContent",
                                "type": "css-animation",
                                "animationIn": "fadeInRight",
                                "animationOut": "fadeOutRight",
                                "hasOverlay": "rgba(55, 125, 255, 0.1)",
                                "smartPositionOff": true
                                }'>
				<svg width="10" height="10" viewBox="0 0 18 18" xmlns="http://www.w3.org/2000/svg">
					<path fill="currentColor"
						d="M11.5,9.5l5-5c0.2-0.2,0.2-0.6-0.1-0.9l-1-1c-0.3-0.3-0.7-0.3-0.9-0.1l-5,5l-5-5C4.3,2.3,3.9,2.4,3.6,2.6l-1,1 C2.4,3.9,2.3,4.3,2.5,4.5l5,5l-5,5c-0.2,0.2-0.2,0.6,0.1,0.9l1,1c0.3,0.3,0.7,0.3,0.9,0.1l5-5l5,5c0.2,0.2,0.6,0.2,0.9-0.1l1-1 c0.3-0.3,0.3-0.7,0.1-0.9L11.5,9.5z" />
				</svg>
			</a>
		</div>
	</div>
	<!-- End Toggle Button -->

	<!-- Content -->
	<div class="scrollbar sidebar-body">
		<div class="sidebar-content p-4">
			<div class="row mb-2">
				<div class="col-12">
					<h3><?= $task['task'];?></h3>
				</div>
			</div>
			<div class="row mb-2">
				<div class="col-12">
					<span class="badge bg-<?= $status['warna'];?> me-2"><?= $status['status'];?></span> <span
						class="badge bg-<?= $task['bobot_color'];?>"><?= $task['bobot'];?>%</span>
				</div>
			</div>
			<div class="row mb-2">
				<div class="col-12">
					<small class="fw-bold">deskripsi</small>
					<p><?= $task['keterangan'];?></p>
				</div>
			</div>
			<!-- Accordion -->
			<div class="accordion accordion-btn-icon-start" id="detail-task-parent">
				<div class="accordion-item">
					<div class="accordion-header">
						<a class="accordion-button text-dark small">
							Detail Task
						</a>
					</div>
					<div id="detail-task-content" class="accordion-collapse" aria-labelledby="detail-task-header">
						<div class="accordion-body small">
							<dl class="row">
								<dt class="col-sm-4">Staff</dt>
								<dd class="col-sm-8">
									<div class="participants d-flex justify-content-start align-items-center">
										<img src="<?= base_url();?><?= $task['profil'];?>" alt="<?= $task['nama'];?>"
											data-bs-toggle="tooltip" class="me-2" data-bs-html="true"
											title="<?= $task['nama'];?>">
										<?= $task['nama'];?>
									</div>
								</dd>
							</dl>
							<!-- <dl class="row">
								<dt class="col-sm-4">Kategori</dt>
								<dd class="col-sm-8">E-commerce</dd>
							</dl>
							<dl class="row">
								<dt class="col-sm-4">Deadline</dt>
								<dd class="col-sm-8">E-commerce</dd>
							</dl> -->
						</div>
					</div>
				</div>
			</div>
			<div class="d-flex justify-content-between align-items-center mt-3">
				<small class="text-secondary">dibuat <?= $task['dibuat_pada'];?></small>
				<small class="text-secondary">diubah <?= $task['diubah_pada'];?></small>
			</div>
		</div>
	</div>
	<!-- End Content -->
</div>
</div>
<!-- Footer -->
<footer class="sidebar-footer border-top p-2">
	<button type="button" class="btn btn-sm btn-soft-primary w-100" data-bs-toggle="modal"
		data-bs-target="#detail-task-<?= $task['id'];?>">ubah informasi task</button>
</footer>
<!-- End Footer -->
