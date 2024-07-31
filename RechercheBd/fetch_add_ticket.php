<?php
session_start();
require_once '../Basedonnee/Tool.php';

// Récupérer la valeur du client sélectionné
$response = array();
// Effectuer la requête pour obtenir l'email et le numéro de téléphone correspondants
 // Utilisez fetch() au lieu de fetchAll()

/*Requete Ticket */
if (isset($_POST['reference'])) {
    $reference = $_POST['reference'];
    $req = $PDO->prepare("SELECT COUNT(*) AS 'Nbre' FROM Ticket WHERE LOWER(ref_ticket)=LOWER(?)");
    $valeur = array($reference);
    $req->execute($valeur);
    $check_result = $req -> fetch(PDO::FETCH_ASSOC);
	$nbr_user=$check_result['Nbre'];
    if($nbr_user==0){ //Aucun utilisateur n'utilise ce login
        $response['refverification']=true;
        $response['refverification']=true;
	}else{ // Le login est déja utilisé par un autre utilisateur
		$response['refverification']=false;
        $response['refverification']=false;
	}
}
/*Requete Systeme Du Client  */
if (isset($_POST['Nomclient'])) {
    $Nomclient = $_POST['Nomclient'];
    //$Nomclient ="Nouvelle Minoterie Africaine";
    $requetenbresys = $PDO->prepare('SELECT C.nom,Sys.ref_systeme_client AS "Sysclient",
    C.etatcontrat AS "Contrat",Sys.nomsite_systeme
    FROM Client AS C INNER JOIN 
    Systeme AS Sys ON Sys.clientproprietaire=C.nom AND LOWER(C.nom)=LOWER(?)
    GROUP BY Sysclient');
    $requetenbresys->execute([$Nomclient]);
    $resultnbresys = $requetenbresys->fetchAll(PDO::FETCH_ASSOC);
    $nbresysteme=$requetenbresys->rowCount();
    if ($resultnbresys) {
        $response['nbresysteme']=$nbresysteme;
        $response['hassysteme'] = true;
        $systemetab = array(); // Créer un tableau pour stocker les systemes de site
        // Parcourir tous les enregistrements pour collecter les noms des de site
        foreach ($resultnbresys as $info) {
            $systemetab[] = $info['Sysclient'];
            $response['hassysteme'] = true;
        }
        $response['systeme'] = $systemetab;
        //$response["nomclient"]=$resultnbresite['nom'];
        if ($nbresysteme >= 2) {
            $response['monosyteme'] = false;
             // Stocker les noms de site dans la réponse*/
        }else{
            $response['monosyteme'] = true;
        } 
    } else {
        $response['hassysteme'] = false;
    }
}
if (isset($_POST['Systeme'])) {
    $Systeme = $_POST['Systeme'];
    //$Systeme ="Contrat_IM_PABX06_1";
    $requetenbresys = $PDO->prepare('SELECT * FROM Systeme WHERE ref_systeme_client=?');
    $requetenbresys->execute([$Systeme]);
    $resultnbresys = $requetenbresys->fetch(PDO::FETCH_ASSOC);
    if ($resultnbresys) {
        $response['resultatsite']=true;
        $response['site']=$resultnbresys['nomsite_systeme'];
    }
    else{
        $response['resultatsite']=false;
        $response['site']=NULL;
    }
}
// Renvoyer la réponse en JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
