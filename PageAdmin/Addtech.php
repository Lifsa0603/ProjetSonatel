<?php
require_once '../Basedonnee/session.php';
require_once '../Basedonnee/Tool.php';
init_session();
$login=$_POST['login'];
$role=$_POST['role'];
$pwd=$_POST['pwd'];
$newprenom=$_POST['prénom'];
$newnom=$_POST['nom'];
$newemail=$_POST['email'];
$tel=$_POST['téléphone'];
 
$pwd=hash('Sha256',$pwd);
$requete=$PDO->prepare("INSERT INTO Utilisateur(prenom,nom,identifiant,motdepasse,categorie_user,email,telephone) VALUES(?,?,?,?,?,?,?)");
$resultat=$requete->execute([$newprenom,$newnom,$login,$pwd,$role,$newemail,$tel]);
if ($resultat) {   
    header("Location:Technicien.php?Message_status=Utilisateur Ajouté avec Succès");  
    exit();
}
else{
    header("Location:Technicien.php?Message_status=Erreur Dans L'enregistrement");  
    exit();    
}
?>