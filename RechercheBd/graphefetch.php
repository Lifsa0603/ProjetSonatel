<?php
    require '../Basedonnee/Tool.php';
    require '../Basedonnee/session.php';
    init_session();
    $idtechnicien=$_SESSION['id_technicien'];
    $requete = $PDO -> prepare('SELECT count(*) AS "Ticket_Traitement" FROM Ticket WHERE LOWER(etat_ticket)=Lower("Traitement En Cours") AND numtechnicien=?');
    $requete->bindParam(1,$idtechnicien);
    $requete->execute();
    $check_result = $requete -> fetch(PDO::FETCH_ASSOC);
    $ticket_traitement=$check_result["Ticket_Traitement"];
    /*Ticket Valider */
    $requete = $PDO -> prepare('SELECT count(*) AS "Ticket_Validation" FROM Ticket WHERE LOWER(etat_ticket)=Lower("Validation") AND numtechnicien=?');
    $requete->bindParam(1,$idtechnicien);
    $requete->execute();
    $check_result = $requete -> fetch(PDO::FETCH_ASSOC);
    $ticket_validation=$check_result["Ticket_Validation"];

    $response = array();
    $response['Traitement'] = intval($ticket_traitement);
    $response['Validation'] = intval($ticket_validation);
    header('Content-Type: application/json');
    echo json_encode($response);
?>