<?php if($this->session->userdata('role') == 3):?>
	
	</div>
</div>

<?php endif;?>

</div>

</main>
<!-- ========== END MAIN CONTENT ========== -->
<!-- Go To -->
<a class="js-go-to go-to position-fixed" href="javascript:;" style="visibility: hidden;" data-hs-go-to-options='{
       "offsetTop": 700,
       "position": {
         "init": {
           "right": "2rem"
         },
         "show": {
           "bottom": "2rem"
         },
         "hide": {
           "bottom": "-2rem"
         }
       }
     }'>
	<i class="bi-chevron-up"></i>
</a>
<!-- ========== END SECONDARY CONTENTS ========== -->

<!-- JS Implementing Plugins -->
<script src="<?= base_url();?>assets/vendor/hs-header/dist/hs-header.min.js"></script>
<script src="<?= base_url();?>assets/vendor/prism/prism.js"></script>
<script src="<?= base_url();?>assets/vendor/hs-mega-menu/dist/hs-mega-menu.min.js"></script>
<script src="<?= base_url();?>assets/vendor/hs-show-animation/dist/hs-show-animation.min.js"></script>
<script src="<?= base_url();?>assets/vendor/hs-go-to/dist/hs-go-to.min.js"></script>
<script src="<?= base_url();?>assets/vendor/aos/dist/aos.js"></script>
<script src="<?= base_url();?>assets/vendor/fslightbox/index.js"></script>
<script src="<?= base_url();?>assets/vendor/appear/dist/appear.min.js"></script>
<script src="<?= base_url();?>assets/vendor/circles.js/circles.js"></script>
<script src="<?= base_url();?>assets/vendor/hs-add-field/dist/hs-add-field.min.js"></script>
<script src="<?= base_url();?>assets/vendor/hs-file-attach/dist/hs-file-attach.min.js"></script>
<script src="<?= base_url();?>assets/vendor/imask/dist/imask.min.js"></script>
<script src="<?= base_url();?>assets/vendor/quill/dist/quill.min.js"></script>
<script src="<?= base_url();?>assets/vendor/tom-select/dist/js/tom-select.complete.min.js"></script>
<script src="<?= base_url();?>assets/vendor/nouislider/dist/nouislider.min.js"></script>
<script src="<?= base_url();?>assets/vendor/hs-unfold/dist/hs-unfold.min.js"></script>
<script src="<?= base_url();?>assets/js/proyek.js"></script>


<!-- JS Front -->
<script src="<?= base_url();?>assets/js/theme.min.js"></script>

<!-- JS Plugins Init. -->
<script>
	(function () {
		// INITIALIZATION OF HEADER
		// =======================================================
		new HSHeader('#header').init()


		// INITIALIZATION OF MEGA MENU
		// =======================================================
		new HSMegaMenu('.js-mega-menu', {
			desktop: {
				position: 'left'
			}
		})


		// INITIALIZATION OF SHOW ANIMATIONS
		// =======================================================
		new HSShowAnimation('.js-animation-link')


		// INITIALIZATION OF FILE ATTACH
		// =======================================================
		new HSFileAttach('.js-file-attach')


		// INITIALIZATION OF BOOTSTRAP DROPDOWN
		// =======================================================
		HSBsDropdown.init()

		// INITIALIZATION OF BOOTSTRAP VALIDATION
		// =======================================================
		HSBsValidation.init('.js-validate', {
			onSubmit: data => {
				$('button[type=submit]').prop("disabled", true);
				// add spinner to button
				$('button[type=submit]').html(
					`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>`
				);
				return;
			}
		})

		// INITIALIZATION OF SELECT
		// =======================================================
		HSCore.components.HSTomSelect.init('.js-select')

		// INITIALIZATION OF GO TO
		// =======================================================
		new HSGoTo('.js-go-to')


		// INITIALIZATION OF AOS
		// =======================================================
		AOS.init({
			duration: 650,
			once: true
		});

		// INITIALIZATION OF NOUISLIDER
		// =======================================================
		HSCore.components.HSNoUISlider.init('.js-nouislider')

		// INITIALIZATION OF CIRCLES
		// =======================================================
		setTimeout(() => {
			HSCore.components.HSCircles.init('.js-circle')
		})

		// INITIALIZATION OF UNFOLD
		// =======================================================
		var unfold = new HSUnfold('.js-hs-unfold-invoker').init();

		$(document).ready(function () {
			$('#table').DataTable({
				"language": {
					"emptyTable": '<div class="text-center p-4">' +
						'<img class="mb-3" src="<?= base_url() ?>assets/svg/illustrations/sorry.svg" alt="Image Description" style="width: 7rem;">' +
						'<p class="mb-0">Tidak ada data untuk ditampilkan</p>' +
						'</div>'
				},
				"scrollX": true,
				"responsive": true
			});

			$('#table-kpi').DataTable({
				"language": {
					"emptyTable": '<div class="text-center p-4">' +
						'<img class="mb-3" src="<?= base_url() ?>assets/svg/illustrations/sorry.svg" alt="Image Description" style="width: 7rem;">' +
						'<p class="mb-0">Tidak ada data untuk ditampilkan</p>' +
						'</div>'
				},
				"scrollX": true,
				"responsive": true,
				"order": false,
				"columnDefs": [{
					"targets": [0,1],
					"orderable": false
				}],
			});

			$(".alphanum").keydown(function (event) {
				var inputValue = event.which;
				// allow letters and whitespaces only.
				if (!(inputValue >= 65 && inputValue <= 120) && (inputValue != 32 && inputValue != 0 &&
						inputValue != 8 && inputValue != 37 && inputValue != 39) && (!inputValue >=
						48 && !inputValue <= 57)) {
					event.preventDefault();
				}
			});

			window.addEventListener('load', function () {
				$('.loader').addClass('d-none');
			})
			
			setTimeout(function () {
				const loader = document.querySelector('.loader');
				// if 'hasClass' is exist on 'loader'
				if(!loader.classList.contains('d-none')) {
					// do something if 'hasClass' is exist.
					$('.loader').addClass('d-none');
				}
			}, 5000);

			$('input[name="periode"]').daterangepicker();
		})
	})()

</script>
</body>

</html>
