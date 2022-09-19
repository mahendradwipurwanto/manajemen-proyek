  <!-- <aside id="sidebarContent" class="hs-unfold-content sidebar">
  	<div class="d-flex justify-content-between align-items-center pt-4 px-4">
  		<div class="d-flex justify-content-start align-items-center">
  			<span class="badge bg-soft-primary"><i class="bi bi-chevron-double-up"></i></span>
  			<small class="text-secondary ms-2"><?= $this->session->userdata('proyek')['kode'];?></small>
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
  	<div class="sidebar-container" id="detailTask">
  		<div class="loader-task">
  			<div class="ring"></div>
  		</div>
  	</div>
  </aside> -->

  <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbarSignup">
  	<div class="offcanvas-header justify-content-between border-0 pb-0">
  		<div class="d-flex justify-content-start align-items-center">
  			<span class="badge bg-soft-primary"><i class="bi bi-chevron-double-up"></i></span>
  			<small class="text-secondary ms-2"><?= $this->session->userdata('proyek')['kode'];?></small>
  		</div>
  		<button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  	</div>

  	<div class="offcanvas-body" id="detailTask">
  		<div class="loader-task">
  			<div class="ring"></div>
  		</div>
  	</div>
  </div>
