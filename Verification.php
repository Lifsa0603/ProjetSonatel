<?php
require 'Basedonnee/Tool.php';
$identifiant = $_REQUEST['identifiant'];
$nom = $_REQUEST['nom'];
$prenom=$_REQUEST['prenom'];
$email = $_REQUEST['email'];
$motdepasse = $_REQUEST['motdepasse'];
/*Verification mail base de donnée */
$checkmail = $PDO -> prepare('SELECT email FROM Technicien WHERE email = ?');
$checkmail->bindParam(1,$email);
$checkmail->execute();
$checkmailresult= $checkmail -> fetchAll(PDO::FETCH_ASSOC);

/*Verification identifiant base de donnée */
$checkidentifiant = $PDO -> prepare('SELECT identifiant FROM Technicien WHERE identifiant = ?');
$checkidentifiant->bindParam(1,$identifiant);
$checkidentifiant->execute();
$checkidentifiant_result=$checkidentifiant->fetchAll(PDO::FETCH_ASSOC);


if (!$checkmailresult && !$checkidentifiant_result) {
    $motdepasse = hash('sha256', $motdepasse);
    $insert= $PDO -> prepare('INSERT INTO Technicien (prenom,nom,email,identifiant,motdepasse) VALUES (:prenom,:nom,:email,:identifiant,:motdepasse)');
    $insert->bindParam(':prenom', $prenom);
    $insert->bindParam(':nom', $nom);
    $insert->bindParam(':email', $email);
    $insert->bindParam(':identifiant', $identifiant);
    $insert->bindParam(':motdepasse', $motdepasse);

    $insert->execute();
    echo("Identifiant Enregistré");
    header("Location:Login.php");
}
else{
    if ($checkmailresult && $checkidentifiant_result) {
        echo("L'identifiant $identifiant appartient au propriétaire du mail $email");
    }
    else {
        if ($checkidentifiant_result){
            echo("L'identifiant $identifiant est déja dans la base de donnée");
        }
        else {
            echo("Le mail $email est déja dans la base de donnée");
        }
    }
    
}

?>