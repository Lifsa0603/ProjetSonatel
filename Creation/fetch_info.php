<?php
require '../Basedonnee/Tool.php';
require '../Basedonnee/session.php';

// Récupérer la valeur du client sélectionné
$selectedClient = $_POST['Client'];

// Effectuer la requête pour obtenir l'email et le numéro de téléphone correspondants
$requeteInfo = $PDO->prepare('SELECT C.nom,C.ref_contrat,Site.nomsite from Client as C INNER JOIN
Siteclient as Site where Site.Contrat=C.ref_contrat AND C.nom=?');
$requeteInfo->execute([$selectedClient]);
$resultInfo = $requeteInfo->fetchAll(PDO::FETCH_ASSOC);

$requetenbresite = $PDO->prepare('SELECT COUNT(*) AS "nbresite",C.nom FROM Client AS C INNER JOIN 
SiteClient AS S where S.Contrat=C.ref_contrat AND C.nom=?');
$requetenbresite->execute([$selectedClient]);
$resultnbresite = $requetenbresite->fetch(PDO::FETCH_ASSOC); // Utilisez fetch() au lieu de fetchAll()

$response = array();

if ($resultInfo) {
    $response['hasSites'] = true;
    $nbresite = $resultnbresite['nbresite']; // Accédez à la valeur de "nbresite"
    $response['nbresite']=$nbresite;
    $response["nomclient"]=$resultnbresite['nom'];
    if ($nbresite >= 2) {
        $response['monosite'] = false;
        $sites = array(); // Créer un tableau pour stocker les noms de site
        // Parcourir tous les enregistrements pour collecter les noms de site
        foreach ($resultInfo as $info) {
            $sites[] = $info['nomsite'];
        }
        
        $response['sites'] = $sites; // Stocker les noms de site dans la réponse
    } else {
        $response['monosite'] = true;
        $response['sites'] = $resultInfo[0]['nomsite'];
    }
} else {
    $response['hasSites'] = false;
}

// Renvoyer la réponse en JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
