<!DOCTYPE html>
<html lang="en" dir="">

<head>
	<!-- Required Meta Tags Always Come First -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Meta Website -->
	<meta name="description" content="<?= $web_desc; ?>">
	<meta property="og:title"
		content="<?= ($this->uri->segment(1) ? ucwords(str_replace('-', ' ', $this->uri->segment(1)) . ' ' . ($this->uri->segment(2) ? str_replace('-', ' ', $this->uri->segment(2)) : "") . $web_title) : $web_title); ?>">
	<meta property="og:description" content="<?= $web_desc; ?>">
	<meta property="og:image" content="<?= base_url(); ?><?= $web_icon?>">
	<meta property="og:url" content="<?= base_url(uri_string()) ?>">

	<title>
		<?= ($this->uri->segment(1) ? ucwords(str_replace('-', ' ', $this->uri->segment(1)) . ' ' . ($this->uri->segment(2) ? str_replace('-', ' ', $this->uri->segment(2)) : "") . " - ".$web_title) : $web_title); ?>
	</title>

	<!-- Favicon -->
	<link rel="shortcut icon" href="<?= base_url(); ?><?= $web_icon;?>">

	<!-- Font -->
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">

	<!-- CSS Implementing Plugins -->
	<link rel="stylesheet" href="<?= base_url(); ?>assets/vendor/bootstrap-icons/font/bootstrap-icons.css">

	<!-- datatables -->
	<link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
	<!-- <link rel="stylesheet" href="//cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css"> -->
	<link rel="stylesheet" href="//https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap5.min.css">

	<link rel="stylesheet" href="<?= base_url(); ?>assets/vendor/swiper/swiper-bundle.min.css">
	<link rel="stylesheet" href="<?= base_url(); ?>assets/vendor/aos/dist/aos.css">
	<link rel="stylesheet" href="<?= base_url(); ?>assets/vendor/tom-select/dist/css/tom-select.bootstrap5.css">
	<link rel="stylesheet" href="<?= base_url(); ?>assets/plugin/sweetalert2/sweetalert2.min.css">
	<link rel="stylesheet" href="<?= base_url(); ?>assets/vendor/nouislider/dist/nouislider.min.css">
	<link rel="stylesheet" href="<?= base_url(); ?>assets/vendor/hs-unfold/dist/hs-unfold.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intro.js@5.0.0/minified/introjs.min.css">
	<link rel="stylesheet" href="<?= base_url(); ?>assets/plugin/intro-js-modern.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

	<!-- CSS Front Template -->
	<link rel="stylesheet" href="<?= base_url(); ?>assets/css/theme.min.css">
	<link rel="stylesheet" href="<?= base_url(); ?>assets/css/docs.min.css">
	<link rel="stylesheet" href="<?= base_url(); ?>assets/css/custom.min.css?<?= time();?>">
	<link rel="stylesheet" href="<?= base_url(); ?>assets/css/proyek.css?<?= time();?>">

	<!-- Plugins css -->
	<link href="<?= base_url();?>assets/plugin/dropzone/min/dropzone.min.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/@mdi/font@6.9.96/css/materialdesignicons.min.css">

	<!-- JS Global Compulsory  -->
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
	<script type="text/javascript" src="<?= base_url(); ?>assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js">
	</script>

	<!-- datatables -->
	<script type="text/javascript" src="//cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="//cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
	<script type="text/javascript" src="//cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
	<script type="text/javascript" src="//dn.datatables.net/buttons/2.2.3/js/buttons.bootstrap5.min.js"></script>
	<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
	<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
	<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
	<script type="text/javascript" src="//cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
	<script type="text/javascript" src="//cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
	<script type="text/javascript" src="//cdn.datatables.net/buttons/2.2.3/js/buttons.colVis.min.js"></script>
	<!-- sweetalert2 -->
	<script type="text/javascript" src="<?= base_url(); ?>assets/plugin/sweetalert2/sweetalert2.min.js"></script>
	<!-- tinyMCE -->
	<script type="text/javascript" src="<?= base_url(); ?>assets/plugin/tinymce/jquery.tinymce.min.js"></script>
	<script type="text/javascript" src="<?= base_url(); ?>assets/plugin/tinymce/tinymce.min.js"></script>
	<script type="text/javascript" src="<?= base_url(); ?>assets/plugin/tinymce-textarea.js"></script>

	<!-- ckeditor -->
	<script type="text/javascript" src="<?= base_url(); ?>assets/plugin/ckeditor/ckeditor.js"></script>
	<script type="text/javascript" src="https://cdn.ckeditor.com/ckeditor5/35.0.1/classic/ckeditor.js"></script>

	<!-- intro js -->
	<script src="https://cdn.jsdelivr.net/npm/intro.js@5.0.0/minified/intro.min.js"></script>

	<!-- daterange picker -->
	<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
	<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

	

	<!-- apex -->
	<script type="text/javascript" src="<?= base_url();?>assets/js/apexchart.js"></script>

	<!-- Plugins js -->
	<script src="<?= base_url();?>assets/plugin/dropzone/min/dropzone.min.js"></script>

</head>
<div class="loader">
	<div class="ring"></div>
</div>
<body class="navbar-sidebar-aside-lg">
