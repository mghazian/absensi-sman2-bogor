<!DOCTYPE html>
<html>

<head>
	<!--Import Google Icon Font-->
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<!--Import materialize.css-->
	<link type="text/css" rel="stylesheet" href="<?php echo base_url ('assets/materialize/css/materialize.min.css'); ?>" media="screen,projection" />

	<!--Import additional css-->
	<?php if (isset ($css)) foreach ($css as $file) { ?>
	<link type="text/css" rel="stylesheet" href="<?php echo base_url ('assets/' . $file); ?>" media="screen,projection" />
	<?php } ?>

	<link type="text/css" rel="stylesheet" href="<?php echo base_url ('assets/datatables/datatables.css'); ?>" media="screen,projection" />
	<!--Let browser know website is optimized for mobile-->
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body style="min-height: 100%">
	<!--Import jQuery before materialize.js-->
	<script type="text/javascript" src="<?php echo base_url ('assets/materialize/js/jquery-3.2.1.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url ('assets/materialize/js/materialize.min.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url ('assets/common.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url ('assets/datatables/datatables.js'); ?>"></script>
	<?php if (isset ($js)) foreach ($js as $file) { ?>
	<script type="text/javascript" src="<?php echo base_url ('assets/' . $file); ?>"></script>
	<?php } ?>

	<div class="content">
		<div class="row">