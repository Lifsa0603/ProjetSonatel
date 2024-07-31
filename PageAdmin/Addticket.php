<?php
require_once '../Basedonnee/session.php';
require_once '../Basedonnee/Tool.php';
init_session();
if (isset($_POST['reference']) && isset($_POST['Nomclient']) &&
isset($_POST['Systeme']) && isset($_POST['Technicien']) && 
isset($_POST['Siteclient']) && isset($_POST['Maintenance'])) {
    $reference=$_POST['reference'];
    $Nomclient=$_POST['Nomclient']; 
    $Technicien=$_POST['Technicien'];
    $Systeme=$_POST['Systeme'];
    $Siteclient=$_POST['Siteclient'];
    $Maintenance=$_POST['Maintenance'];
    $requete=$PDO->prepare("INSERT INTO Ticket(ref_ticket,numtechnicien,systemeclient,typeMaintenance) VALUES(?,?,?,?)");
    $resultat=$requete->execute([$reference,$Technicien,$Systeme,$Maintenance]);
    if ($resultat) {   
        header("Location:Accueiladmin.php?Message_status=Ticket Ajouté avec Succès");  
        exit();
    }
    else{
        header("Location:Acceuiladmin.php?Message_status=Erreur Dans L'enregistrement");  
        exit();    
    }
}   
?>