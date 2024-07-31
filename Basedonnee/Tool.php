<?php
/*$BD_DSN = "mysql:host=localhost;dbname=c2099974c_SONATEL";
$BD_user = "c2099974c_sona";
$BD_usercode = "43kHW.JyY5cQ";*/



$BD_DSN = "mysql:host=localhost;dbname=Sonatel";
$BD_user = "root";
$BD_usercode = "";
try {

    $option =
        [
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8', 
            /*
            Pour être sur de travailler avec une bonne 
            encodage dans mysql
            */
            PDO::ATTR_ERRMODE => PDO::ERRMODE_SILENT, 
            /*
            Mode par défaut pour la gestion des erreurs donc aucun n'affichage a faire
            Le mieux est de travailler avec des avertissements donc changeons
            ERRMODE_SILENT en ERRMODE_EXCEPTION car nous sommes en développement
            */
            PDO::ATTR_EMULATE_PREPARES=>false
            /*
            Permet d'utiliser des vraies requêtes préparées car 
            car par défaut l'interface PDO simule des requêtes préparées
            */
        ];
		$PDO = new PDO ($BD_DSN,$BD_user,$BD_usercode,$option);
}

catch(PDOException $e){
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/config.css?v=1.1">
	<link rel="shortcut icon" href="ico/Erreur500.ico" type="image/x-icon">
	<title>Erreur!</title>
</head>
<body>
<main>

<div id="wrap">
	<div class="hand hand-left">
		<span class='hand-part part-top'></span>
		<span class='hand-part part-middle'></span>
		<span class='hand-part part-bottom'></span>
	</div>
	<div class="hand hand-right">
		<span class='hand-part part-top'></span>
		<span class='hand-part part-middle'></span>
		<span class='hand-part part-bottom'></span>
	</div>
	<div class='line line-1'>
		<div class="ball">5</div>
	</div>
	<div class='line line-2'>
		<div class="ball">0</div>
	</div>
	<div class='line line-3'>
		<div class="ball">0</div>
	</div>
	<div id="server">
		<div class="eye eye-left"><span></span></div>
		<div class="eye eye-right"><span></span></div>
		<div class="block">
			<div class="light"></div>
		</div>
		<div class="block">
						<div class="light"></div>
		</div>
		<div class="block">
						<div class="light"></div>
		</div>
		<div class="block">
						<div class="light"></div>
		</div>
		<div class="block">
						<div class="light"></div>
		</div>
		<div id="bottom-block">
			<div class="bottom-line"></div>
			<div id="bottom-light"></div>
		</div>
	</div>	
</div>

<div id="code-error">
	<h1>Poblème Serveur Interne!</h1> <hr>
	<h3>Nous ne sommes pas encore en mesure de savoir ce qui se passe</h4>
	<h5>Revenez Plus-Tard <i class="fa-solid fa-question fa-2xl" style="color: #1e1a1a;"></i></h5>
	
</div>
</main>
</body>
</html>
<?php  
}

?>