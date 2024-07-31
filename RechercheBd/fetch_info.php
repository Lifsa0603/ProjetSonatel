<?php
require '../Basedonnee/Tool.php';
require '../Basedonnee/session.php';
init_session();
// Récupérer la valeur du client sélectionné
$response = array();
$idtechnicien=$_SESSION['id_technicien'];
// Effectuer la requête pour obtenir l'email et le numéro de téléphone correspondants
 // Utilisez fetch() au lieu de fetchAll()

/*Requete Ticket */
if (isset($_POST['Ref'])) {
    $NumeroRef = $_POST['Ref'];
    $requeteticket=$PDO->prepare('SELECT T.ref_ticket,T.systemeclient,T.etat_ticket,T.typeMaintenance AS "Type",
    S.clientproprietaire,
    SC.nomsite,SC.telephone,SC.email,
    C.nom AS "Nom Client" FROM Ticket AS T
    INNER JOIN Systeme AS S ON T.systemeclient=S.ref_systeme_client
    INNER JOIN Siteclient AS SC ON SC.nomsite=S.nomsite_systeme
    INNER JOIN Client AS C ON SC.contrat=C.ref_contrat
    WHERE LOWER(T.ref_ticket)=LOWER(?) AND T.numtechnicien=? AND
    T.etat_ticket="Traitement En Cours"');
    $requeteticket->execute([$NumeroRef,$idtechnicien]);
    $resultrequeteticket = $requeteticket->fetch(PDO::FETCH_ASSOC);
    if ($resultrequeteticket) {
        $response['Nomclient']=$resultrequeteticket['Nom Client'];
        $response['typemaintenance']=$resultrequeteticket['Type'];
        $response['telephonecontact']=$resultrequeteticket['telephone'];
        $response['emailcontact']=$resultrequeteticket['email'];
        $response['sites']=$resultrequeteticket['nomsite'];
        $response['result']=true;
        $response['id']=$_SESSION['id_technicien'];
    }
    else {
        $response['adresse']=null;
        $response['Nomclient']=null;
        $response['typemaintenance']=null;
        $response['telephonecontact']=null;
        $response['emailcontact']=null;
        $response['sites']=null;
        $response['result']=false;
    }
}
if (isset($_POST['Client'])) {
    $selectedClient = $_POST['Client'];
    $requeteInfo = $PDO->prepare('SELECT C.nom,C.ref_contrat,Site.nomsite from Client as C INNER JOIN
    Siteclient as Site where Site.Contrat=C.ref_contrat AND C.nom=?');
    $requeteInfo->execute([$selectedClient]);
    $resultInfo = $requeteInfo->fetchAll(PDO::FETCH_ASSOC);

    $requetenbresite = $PDO->prepare('SELECT COUNT(*) AS "nbresite",C.nom FROM Client AS C INNER JOIN 
    SiteClient AS S where S.Contrat=C.ref_contrat AND C.nom=?');
    $requetenbresite->execute([$selectedClient]);
    $resultnbresite = $requetenbresite->fetch(PDO::FETCH_ASSOC);
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
}

// Renvoyer la réponse en JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
