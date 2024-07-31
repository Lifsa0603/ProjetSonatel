<?php
include_once 'head.php';
?>
</head>
<?php
$id_user=$_GET['id'];
$requeteverification=$PDO->prepare('SELECT * FROM Utilisateur WHERE id_technicien=?');	
$requeteverification->execute([$id_user]);
$verificationrequete = $requeteverification -> fetchAll(PDO::FETCH_ASSOC);
if ($verificationrequete) {
    $requete = $PDO->prepare('DELETE FROM Utilisateur WHERE id_technicien = ?');		
    $requete->execute([$id_user]);
    // Vérifier si la suppression a réussi
    if ($requete->rowCount() === 1) {
        // Suppression réussie
        $msg = "Utilisateur Supprimé avec succès";
        header("Location: Technicien.php?Delete_status=Utilisateur Supprimé avec succès");
    } else {
        // Suppression échouée
        $msg = "Erreur dans la Suppression";
        header("Location: Technicien.php?Delete_status=Erreur dans la Suppression");
    }

}
else{
    header("Location:Technicien.php");
    exit();
}



?>