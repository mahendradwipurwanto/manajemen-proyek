</main>
<br><br>
<div class="tab-mobile-nav-container shadow-sm-top">
	<?php if($this->session->userdata('role') == 1):?>
	<a href="<?= site_url('admin/dashboard');?>" class="tab-mobile <?= ($this->uri->segment(2) == "dashboard" || !$this->uri->segment(2) ? "active" : "") ?> purple">
		<i class="bi bi-house"></i>
		<p>Dashboard</p>
	</a>
	<a href="<?= site_url('admin/kelola-pengguna');?>"  class="tab-mobile <?= ($this->uri->segment(2) == "kelola-pengguna" || $this->uri->segment(2) == "kelola-staff" || $this->uri->segment(2) == "kelola-leader" ? "active" : "") ?> pink">
		<i class="bi bi-people"></i>
		<p>Pengguna</p>
	</a>
	<a href="<?= site_url('admin/kelola-proyek');?>" class="tab-mobile <?= ($this->uri->segment(2) == "kelola-proyek" ? "active" : "") ?> yellow">
		<i class="bi bi-box-seam"></i>
		<p>Proyek</p>
	</a>
	<a href="<?= site_url('admin/pengaturan');?>" class="tab-mobile <?= ($this->uri->segment(2) == "pengaturan" ? "active" : "") ?> teal">
		<i class="bi bi-sliders"></i>
		<p>Pengaturan</p>
	</a>
</div>
<?php elseif($this->session->userdata('role') == 2):?>
<a href="<?= site_url('leader/dashboard');?>" class="tab-mobile <?= ($this->uri->segment(2) == "dashboard" || !$this->uri->segment(2) ? "active" : "") ?> purple">
	<i class="bi bi-house"></i>
	<p>Dashboard</p>
</a>
<a href="<?= site_url('leader/kelola-proyek');?>" class="tab-mobile <?= ($this->uri->segment(2) == "kelola-proyek" ? "active" : "") ?> yellow">
	<i class="bi bi-box-seam"></i>
	<p>Proyek</p>
</a>
<a href="<?= site_url('leader/kelola-staff');?>" class="tab-mobile <?= ($this->uri->segment(2) == "kelola-staff" ? "active" : "") ?> pink">
	<i class="bi bi-clipboard-check"></i>
	<p>Staff</p>
</a>
<a href="<?= site_url('leader/pengaturan');?>" class="tab-mobile <?= ($this->uri->segment(2) == "pengaturan" ? "active" : "") ?> teal">
	<i class="bi bi-sliders"></i>
	<p>Pengaturan</p>
</a>
</div>
<?php elseif($this->session->userdata('role') == 3):?>
<a href="<?= site_url('staff/dashboard');?>" class="tab-mobile <?= ($this->uri->segment(2) == "dashboard" && $this->uri->segment(1) == 'staff' ? "active" : "") ?>  purple">
	<i class="bi bi-house"></i>
	<p>Dashboard</p>
</a>
<a href="<?= site_url('staff/kelola-proyek');?>" class="tab-mobile <?= ($this->uri->segment(2) == "kelola-proyek" ? "active" : "") ?> pink">
	<i class="bi bi-clipboard-check"></i>
	<p>Task</p>
</a>
<a href="<?= site_url('staff/pengaturan');?>" class="tab-mobile <?= ($this->uri->segment(2) == "pengaturan" ? "active" : "") ?> teal">
	<i class="bi bi-sliders"></i>
	<p>Pengaturan</p>
</a>
</div>
<?php endif;?>
