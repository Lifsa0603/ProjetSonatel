
<?php

?>
</head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../ico/Orange.ico" type="image/x-icon">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js?v=1.1"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css?v=1.1" rel="stylesheet">
</head>
<?php
	function Message($msg,$bg){
		$alerte="alert alert-$bg alert-dismissible fade-show";
		?>
		<div class="<?php echo $alerte ?> col-12" style="height: min-content;">
				<?php
					echo $msg;
				?>
				<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
		</div>
	<?php
	}
?>