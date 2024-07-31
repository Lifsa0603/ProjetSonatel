<?php
    require_once '../Basedonnee/session.php';
    require_once '../Basedonnee/Tool.php';
    init_session(); 
    $prenom=$_SESSION['prenom'];
    $nom=$_SESSION['nom'];
    $email=$_SESSION['email'];
    $identifiant=$_SESSION['identifiant'];
    $telephone=$_SESSION['telephone'];
    $idtechnicien=$_SESSION['id_technicien'];
    $categorie_user=$_SESSION['categorie_user'];
    if(!isset($_SESSION['user'])) {
        header('Location:../Login.php');
        exit();
    }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../ico/Orange.ico" type="image/x-icon">
    <link rel="stylesheet" href="../css/Profil.css?v=1.1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script><!-- Inclure jQuery ici -->
    <script src="https://cdn.plot.ly/plotly-latest.min.js"></script> <!-- Inclure Plotly ici -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.css" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js?v=1.1"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css?v=1.1" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css?v=1.1" rel="stylesheet">