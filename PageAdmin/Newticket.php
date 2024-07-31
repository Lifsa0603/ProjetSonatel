<?php
//require_once('../identification.php');
require '../Basedonnee/session.php';
require '../Basedonnee/Tool.php';
init_session();
?>
<title>Fiche</title>
</head>
<?php
   if (isset($_POST['reference']) && isset($_POST['Nomclient']) &&
   isset($_POST['Systeme']) && isset($_POST['Technicien']) && 
   isset($_POST['Siteclient']) && isset($_POST['Maintenance'])) {
       $reference=htmlspecialchars($_POST['reference']);
       $Nomclient=htmlspecialchars($_POST['Nomclient']); 
       $Technicien=htmlspecialchars($_POST['Technicien']);
       $Systeme=htmlspecialchars($_POST['Systeme']);
       $Siteclient=htmlspecialchars($_POST['Siteclient']);
       $Maintenance=htmlspecialchars($_POST['Maintenance']);
       $requete = $PDO->prepare('SELECT * FROM Utilisateur WHERE identifiant=?');
       $requete->execute([$Technicien]);
       $check_result = $requete->fetch(PDO::FETCH_ASSOC);
       if ($check_result) {
            $idtechencharge=$check_result['id_technicien'];
            $nomprenomtech=$check_result['prenom']." ".$check_result['nom'];
       }
       else {
            $idtechencharge="Errorid";
            $nomprenomtech="Error Nom Prenom";
       }
   }
?>
<link rel="stylesheet" href="../css/Card.css">
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../ico/Orange.ico" type="image/x-icon">
    <link rel="stylesheet" href="../css/Profil.css?v=1.1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script><!-- Inclure jQuery ici -->
    <script src="https://cdn.plot.ly/plotly-latest.min.js"></script> <!-- Inclure Plotly ici -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.css" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js?v=1.1"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css?v=1.1" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css?v=1.1" rel="stylesheet">
<title>Ticket</title>
</head>
<form action="Addticket.php" method="POST" enctype="multipart/form-data" >
      <!-- The Modal -->
              <div class="modal" id="Card_ticket">
                  <div class="modal-dialog">
                        <div class="modal-content" style="width: 90%; height: 60%;">
                          <!-- Modal Header -->
                          <div class="modal-header">
                              <h4 class="modal-title">Informations Nouveau Ticket</h4>
                              <button type="button" class="btn-close" id="Closebutton" data-bs-dismiss="modal"></button>
                          </div>
                          <!-- Modal body -->
                          <div class="modal-body">
                            <input type="hidden" name="reference" value=<?=$reference?>>
                            <input type="hidden" name="Technicien" value=<?=$idtechencharge?>>
                            <input type="hidden" name="Maintenance" value=<?=$Maintenance?>>
                            <input type="hidden" name="Nomclient" value=<?=$Nomclient?>>
                            <input type="hidden" name="Systeme" value=<?=$Systeme?>>
                            <input type="hidden" name="Siteclient" value=<?=$Siteclient?>>
                                <div class="row kpi-card w-100 h-100">
                                    <h3>Informations Nouveau Ticket</h3>
                                    <div class="row col-6">
                                        <div class="col-12 info">
                                            <span class="label">Reference:</span>
                                            <span class="value"><?=$reference?></span>
                                        </div>
                                        <div class="col-12 info">
                                            <span class="label">Technicien:</span>
                                            <span class="value"><?=$nomprenomtech?></span>                                        </div>
                                        <div class="col-12 info">
                                            <span class="label">Maintenance:</span>
                                            <span class="value"><?=$Maintenance?></span>
                                        </div>
                                    </div>
                                    <div class="row col-6">
                                        <div class="col-12 info">
                                            <span class="label">Nom Client:</span>
                                            <span class="value"><?=$Nomclient?></span>
                                        </div>
                                        <div class="col-12 info">
                                            <span class="label">Systeme:</span>
                                            <span class="value"><?=$Systeme?></span>
                                        </div>
                                        <div class="col-12 info">
                                            <span class="label">Site Client</span>
                                            <span class="value"><?=$Siteclient?></span>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                          <!-- Modal footer -->
                          <div class="modal-footer">
                              <button type="button" id="Closebutton2" class="btn btn-danger" data-bs-dismiss="modal">Annuler L'Ajout</button>
                              <button type="submit" class="btn btn-success"  data-bs-dismiss="modal">Enregistrer</button>
                          </div>
                      </div>
                  </div>
              </div>
      </form>
      <script>
    $(document).ready(function () {
        // Sélectionnez le modal par son ID et configurez les paramètres
        $("#Card_ticket").modal({
            backdrop: 'static', // Empêche la fermeture en cliquant en dehors du modal
            keyboard: false // Désactive la fermeture en appuyant sur la touche "Esc"
        });

        // Maintenant, affichez le modal
        $("#Card_ticket").modal("show");

        // ...
    });
</script> 
<script>
    var shouldRedirect = true; // Par défaut, permet la redirection
    document.getElementById("Closebutton").addEventListener('click', function () {
    // Effectuez la redirection ici
    if (shouldRedirect) {
            // Effectuez la redirection uniquement si shouldRedirect est vrai
            window.location.href = 'Generer.php';
        }
});
document.getElementById("Closebutton2").addEventListener('click', function () {
    // Effectuez la redirection ici
    if (shouldRedirect) {
            // Effectuez la redirection uniquement si shouldRedirect est vrai
            window.location.href = 'Accueiladmin.php';
        }
});
</script>
</body>
</html>