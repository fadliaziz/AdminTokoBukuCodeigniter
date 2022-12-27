<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="<?php echo base_url() ?>dist/css/style.min.css" rel="stylesheet">
	<title>Login | Toko buku App</title>
</head>
<body>

<style type="text/css">
	.container {
		width: 40% !important;
		border: 1px solid #e7e7e7;
		padding: 15px 10px;
		transform: translateY(35%);
	}
</style>

<div class="container">
	<h5>Tokobuku App</h5>
	<hr>

	<?php  

		if($this->session->has_userdata("msg")) {
			echo $this->session->userdata("msg");
			$this->session->unset_userdata("msg");
		}

	?>

	<?php echo form_open("init/login") ?>
	<div class="row clearfix">
		<div class="col-md-12">
			<label>Username</label>
			<input type="text" name="username" class="form-control input-sm" required="" autofocus="">
		</div>
		<div class="col-md-12">
			<br>
			<label>Password</label>
			<input type="password" name="password" class="form-control input-sm" required="">
		</div>
		<div class="col-md-12">
			<br>
			<button class="btn btn-block btn-success" type="submit">Login</button>
		</div>
	</div>
	<?php echo form_close() ?>

	<br>
	<br>
	<p class="text-center">Aplikasi toko buku - develop by <a href="https://koderpedia.blogspot.com">Fadli Aziz</a></p>
</div>

</body>
</html>

<script src="<?php echo base_url() ?>assets/libs/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap tether Core JavaScript -->
<script src="<?php echo base_url() ?>assets/libs/popper.js/dist/umd/popper.min.js"></script>
<script src="<?php echo base_url() ?>assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?php echo base_url() ?>dist/js/app-style-switcher.js"></script>
<!--Wave Effects -->
<script src="<?php echo base_url() ?>dist/js/waves.js"></script>
<!--Menu sidebar -->
<script src="<?php echo base_url() ?>dist/js/sidebarmenu.js"></script>
<!--Custom JavaScript -->
<script src="<?php echo base_url() ?>dist/js/custom.js"></script>