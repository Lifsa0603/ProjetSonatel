<?php
session_start();
require_once '../Basedonnee/Tool.php';

// Récupérer la valeur du client sélectionné
$response = array();


/*Requete Ticket */
if (isset($_POST['login'])) {
    $login = $_POST['login'];
    $req = $PDO->prepare("SELECT COUNT(*) AS 'Nbre',identifiant,email FROM Utilisateur WHERE LOWER(identifiant)=LOWER(?)");
    $valeur = array($login);
    $req->execute($valeur);
    $check_result = $req -> fetch(PDO::FETCH_ASSOC);
	$nbr_user=$check_result['Nbre'];
    if($nbr_user==0){ //Aucun utilisateur n'utilise ce login
        $response['loginverification']=true;
        $response['emailverification']=true;
        $response['resultat']=true;
	}else{ // Le login est déja utilisé par un autre utilisateur
		$response['loginverification']=false;
        $response['resultat']=true;
        $response['emailverification']=false;
	}
}
else{
    $response['loginverification']=false;
    $response['resultat']=false;
}
if (isset($_POST['email'])) {
    $email = $_POST['email'];
    $req = $PDO->prepare("SELECT COUNT(*) AS 'Nbre',identifiant,email FROM Utilisateur WHERE LOWER(email)=LOWER(?)");
    $valeur = array($email);
    $req->execute($valeur);
    $check_result = $req -> fetch(PDO::FETCH_ASSOC);
	$nbr_user=$check_result['Nbre'];
    if($nbr_user==0){ //Aucun utilisateur n'utilise ce login
        $response['emailverification']=true;
        $response['loginverification']=true;
        $response['resultat']=true;
	}else{ // Le login est déja utilisé par un autre utilisateur
		$response['emailverification']=false;
        $response['loginverification']=false;
        $response['resultat']=true;
	}
}
// Renvoyer la réponse en JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
