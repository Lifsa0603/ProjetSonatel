<?php
require_once '../Basedonnee/session.php';
require_once '../Basedonnee/Tool.php';
require('Fpdf/fpdf.php');
init_session();
/*Supprimer repertoire */
function Supprimerrep($dir) {
    $files = array_diff(scandir($dir), array('.', '..'));

    foreach ($files as $file) {
        $filePath = $dir . '/' . $file;

        if (is_dir($filePath)) {
            Supprimerrep($filePath);
        } else {
            unlink($filePath);
        }
    }

    return rmdir($dir);
}

/*Supprimer fichier */

// Remplacez cela par le chemin complet de votre fichier
function suppfichier($nomFichier){
if (file_exists($nomFichier)) {
        if (unlink($nomFichier)) {
            #....
        } else {
            echo "Erreur lors de la suppression du fichier.";
        }
    } else {
        echo "Le fichier n'existe pas.";
    }
}
$prenom=$_SESSION['prenom'];
$nom=$_SESSION['nom'];
$email=$_SESSION['email'];
$identifiant=$_SESSION['identifiant'];
$id=$_SESSION['id_technicien'];
$chemintech='profil_'.$identifiant.'_'.$id;
$pdfchemin=$_SESSION['fichiergenerer'];

// Extraire le nom du fichier du chemin source
$nomFichier = basename($pdfchemin);
$repertoire = dirname($pdfchemin);

// Créer le chemin de destination complet
$cheminDestination = $chemintech . '/' . $nomFichier;
// Obtenir le nom du fichier sans extension
$nomFichierSansExtension = pathinfo($nomFichier, PATHINFO_FILENAME);
// Récupérez le fuseau horaire du navigateur de l'utilisateur s'il est disponible
if(isset($_COOKIE['timezone'])) {
    date_default_timezone_set($_COOKIE['timezone']);
} else {
    // Si le fuseau horaire du navigateur n'est pas disponible, utilisez un fuseau horaire par défaut
    date_default_timezone_set('Africa/Dakar'); // Remplacez par le fuseau horaire souhaité
}

// Obtenez la date et l'heure actuelles au format 'Y-m-d H:i:s'
$datecloturation = $dateFrancais = date('Y-m-d H:i:s');
$dateMoinsUneminute = date('Y-m-d H:i:s', strtotime($dateFrancais) - 60); // 60 secondes équivalent à une minute

$notation=$_SESSION['nbreetoile'];
$observation_client=$_SESSION['Observation'];
require_once 'Error.php';

if (!is_dir($chemintech)) {
    if (mkdir($chemintech, 0777, true)) {
        if (file_exists($pdfchemin)) {
            // Utilisez rename() pour déplacer le fichier
            if (rename($pdfchemin, $cheminDestination)) {
                $urlfichemaintenance=$cheminDestination;
                $etat_ticket="Validation";
                $ref_ticket=$_SESSION['Reference'];
                $requete = $PDO->prepare("SELECT ref_ticket,etat_ticket from Ticket where ref_ticket=? and etat_ticket!=?");
                $requete->execute([$ref_ticket, $etat_ticket]);
                $firstresult= $requete->fetchAll(PDO::FETCH_ASSOC);
                if ($firstresult) {
                    foreach ($firstresult as $key) {
                        if ($key['etat_ticket']=="Validation") {
                            ErrorPage("Ce numéro de référence est déja clôturé dans la base","Error Référence");
                        }
                        else{
                            $requete = $PDO->prepare("UPDATE Ticket 
                            SET urlfichemaintenance = ?, 
                            etat_ticket = ?, 
                            datecloturation = ?,
                            note_ticket=?,
                            observation_client=? 
                            WHERE ref_ticket = ?");
                            $requete->execute([$urlfichemaintenance, $etat_ticket, $datecloturation,$notation,$observation_client, $ref_ticket]);
                            header("Location:Historique.php?Ticket_status=Ticket Clôturé");  
                            exit();
                        }
                    }
                }
                else{
                    $requete = $PDO->prepare("INSERT INTO Ticket 
                    (numtechnicien,urlfichemaintenance,etat_ticket,datecloturation,note_ticket,observation_client,ref_ticket,dateCreation) VALUES(?,?,?,?,?,?,?)");
                    $requete->execute([$id,$urlfichemaintenance, $etat_ticket, $datecloturation,$notation,$observation_client, $ref_ticket,$dateMoinsUneminute]);
                    header("Location:Historique.php?Ticket_status=Ticket non réferencé");  
                    exit();                     
                }
            } else { 
                suppfichier($urlfichemaintenance);
                ErrorPage("Erreur De Notre Part","Error");           
            }
        } else {
            suppfichier($urlfichemaintenance);
            ErrorPage("Erreur De Notre Part","Error");                                         
        }
    }
    else {
        suppfichier($urlfichemaintenance);
        ErrorPage("Erreur De Notre Part","Error");                      
    }
}
else {
    if (file_exists($pdfchemin)) {
        // Utilisez rename() pour déplacer le fichier
        if (rename($pdfchemin, $cheminDestination)) {
            $urlfichemaintenance=$cheminDestination;
            $etat_ticket="Validation";
            $ref_ticket=$_SESSION['Reference'];
            $requete = $PDO->prepare("SELECT ref_ticket,etat_ticket from Ticket where ref_ticket=? AND etat_ticket!=?");
            $requete->execute([$ref_ticket, $etat_ticket]);
            $firstresult= $requete->fetchAll(PDO::FETCH_ASSOC);
            if ($firstresult) {
                foreach ($firstresult as $key) {
                    if ($key['etat_ticket']=="Validation") {
                        ErrorPage("Ce numéro de référence est déja clôturé dans la base","Error Référence");
                    }
                    else{
                        $requete = $PDO->prepare("UPDATE Ticket 
                        SET urlfichemaintenance = ?, 
                        etat_ticket = ?, 
                        datecloturation = ?,
                        note_ticket=?,
                        observation_client=? 
                        WHERE ref_ticket = ?");
                        $requete->execute([$urlfichemaintenance, $etat_ticket, $datecloturation,$notation,$observation_client, $ref_ticket]);
                        header("Location:Historique.php?Ticket_status=Ticket Clôturé");  
                        exit();
                    }
                }
            }
            else{
                $requete = $PDO->prepare("INSERT INTO Ticket (numtechnicien,urlfichemaintenance,etat_ticket,datecloturation,note_ticket,observation_client,ref_ticket,dateCreation) 
                VALUES (?,?,?,?,?,?,?,?)");
                $requete->execute([$id,$urlfichemaintenance, $etat_ticket, $datecloturation,$notation,$observation_client, $ref_ticket,$dateMoinsUneminute]);
                header("Location:Historique.php?Ticket_status=Ticket Clôturé");  
                exit();                     
            }
        } else {
            ErrorPage("Erreur De Notre Part","Error");
        }
    } else {
        ErrorPage("Erreur De Notre Part","Error");
        exit();
    }
}
?>