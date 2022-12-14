

</div>

</main>
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
	function tourAdmin() {
		introJs().setOptions({
			disableInteraction: true,
			steps: [{
				intro: "Selamat Datang di web aplikasi Manajemen Proyek"
			}, {
				element: document.querySelector('#tour-landing-button'),
				intro: "Anda dapat langsung menuju halaman utama dengan menekan tombol ini"
			}, {
				element: document.querySelector('#tour-dashboard'),
				intro: "Anda dapat melihat ringkasan mengenai web app pada laman ini"
			}, {
				element: document.querySelector('#tour-menu-kpi'),
				intro: "Anda dapat melihat laporan KPI dari staff anda pada laman ini"
			}, {
				element: document.querySelector('#tour-menu-laporan'),
				intro: "Anda dapat melihat laporan proyek dan task pada laman ini"
			}, {
				element: document.querySelector('#tour-menu-staff'),
				intro: "Anda dapat mengelola data staff anda pada laman ini"
			}, {
				element: document.querySelector('#tour-menu-leader'),
				intro: "Anda dapat melihat data staff yang menjadi leader pada laman ini"
			}, {
				element: document.querySelector('#tour-menu-proyek'),
				intro: "Anda dapat mengelola data seluruh proyek dan task anda pada laman ini"
			}, {
				element: document.querySelector('#tour-menu-pengaturan'),
				intro: "Anda dapat mengelola pengaturan seputar website anda pada laman ini"
			}]
		}).onbeforeexit(function () {
			return confirm("Keluar dari intro?");
		}).start();
	}

	function tourStaff() {
		introJs().setOptions({
			disableInteraction: true,
			steps: [{
				intro: "Selamat Datang di web aplikasi Manajemen Proyek"
			}, {
				element: document.querySelector('#tour-landing-button'),
				intro: "Anda dapat langsung menuju halaman utama dengan menekan tombol ini"
			}, {
				element: document.querySelector('#tour-dashboard'),
				intro: "Anda dapat melihat ringkasan mengenai web app pada laman ini"
			}, {
				element: document.querySelector('#tour-menu-kpi'),
				intro: "Anda dapat melihat laporan KPI dari staff anda pada laman ini"
			}, {
				element: document.querySelector('#tour-menu-laporan'),
				intro: "Anda dapat melihat laporan proyek dan task pada laman ini"
			}, {
				element: document.querySelector('#tour-menu-staff'),
				intro: "Anda dapat mengelola data staff anda pada laman ini"
			}, {
				element: document.querySelector('#tour-menu-proyek'),
				intro: "Anda dapat mengelola data seluruh proyek dan task anda pada laman ini"
			}, {
				element: document.querySelector('#tour-pengaturan'),
				intro: "Anda dapat mengelola pengaturan profil anda pada laman ini"
			}]
		}).onbeforeexit(function () {
			return confirm("Keluar dari intro?");
		}).start();
	}

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

			$('#table2').DataTable({
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
					"targets": [0, 1],
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
				if (!loader.classList.contains('d-none')) {
					// do something if 'hasClass' is exist.
					$('.loader').addClass('d-none');
				}
			}, 2000);

			$('input[name="periode"]').daterangepicker();
		})
	})()

	$(document).ready(function () {
		$('table.dataTables-nosearch').each(function () {
			$('#' + $(this).attr('id')).DataTable({
				"language": {
					"emptyTable": '<div class="text-center p-4">' +
						'<img class="mb-3" src="../assets/svg/illustrations/sorry.svg" alt="Image Description" style="width: 7rem;">' +
						'<p class="mb-0">No data to display</p>' +
						'</div>'
				},
				"searching": false,
				"scrollX": true,
				"responsive": true
			});
		});
		$('table.dataTables').each(function () {
			$('#' + $(this).attr('id')).DataTable({
				"language": {
					"emptyTable": '<div class="text-center p-4">' +
						'<img class="mb-3" src="../assets/svg/illustrations/sorry.svg" alt="Image Description" style="width: 7rem;">' +
						'<p class="mb-0">No data to display</p>' +
						'</div>'
				},
				"scrollX": true,
				"responsive": true
			});
		});
	});

</script>
</body>

</html>
