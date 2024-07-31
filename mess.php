<?php
	session_start();
	if(!isset($_SESSION['user'])) {
		echo("Perte Valeur");
	 }
	 else{
		 echo("<pre>");
		 print_r($_SESSION['user']);
		 echo("</pre>");
	 }
	if(isset($_GET['msg']))
		$msg=$_GET['msg'];
	else
		$msg="";
	
	if(isset($_GET['color']))
		$color=$_GET['color'];
	else
		$color="v";
	
	if(isset($_GET['url']))
		$url=$_GET['url'];
	else
		$url=$_SERVER['HTTP_REFERER'];
		
	if($color=="v")
		$alerte='alert alert-success';
	else
		$alerte='alert alert-danger';
	$tempsRestant=3;
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>Les messages</title> 
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	</head>
		
	<body>
		<br><br><br>
		<div class="container col-md-6 col-md-offset-3">
			
			<div id="alerte" class="<?php echo $alerte ?>">
				<h2><?php echo $msg; ?></h2>
				<p>Redirection dans <?php echo $tempsRestant; ?> secondes...</p>
			</div>
			
		</div>
		<script>
			var tempsRestant = 3; // Nombre de secondes restantes
			// Fonction pour mettre à jour le compte à rebours
			function miseAJourCompteRebours() {
				var alerteDiv = document.getElementById("alerte");
				if (tempsRestant > 0) {
					alerteDiv.innerHTML = "<h2><?php echo $msg; ?></h2><p>Redirection dans " + tempsRestant + " secondes...</p>";
					tempsRestant--;
					setTimeout(miseAJourCompteRebours, 1000); // Appel récursif chaque seconde
				} else {
					window.location.href = "<?php echo $url; ?>";
				}
			}
			
			// Démarrer le compte à rebours lorsque la page est chargée
			window.onload = function() {
				miseAJourCompteRebours();
			};
		</script>
	</body>
</html>
