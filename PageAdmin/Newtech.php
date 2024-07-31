<?php
//require_once('../identification.php');
require '../Basedonnee/session.php';
init_session();
?>
<title>Fiche</title>
</head>
<?php
    $login=htmlspecialchars($_POST['login']);
    $role=htmlspecialchars($_POST['role']); 
    $pwd=htmlspecialchars($_POST['pwd']);
    $newprenom=htmlspecialchars($_POST['prénom']);
    $newnom=htmlspecialchars($_POST['nom']);
    $newemail=htmlspecialchars($_POST['email']);
    if(isset($_POST['téléphone']))
        $tel=htmlspecialchars($_POST['téléphone']);
    else{
        $tel='NULL';
    }

    if ($role=="Admin") {
        $rolecomplet="Administrateur";
    }
    else{
        $rolecomplet="Technicien";   
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
<title>Fiche Technicien</title>
</head>
<form action="Addtech.php" method="POST" enctype="multipart/form-data" >
      <!-- The Modal -->
              <div class="modal" id="cardtechnicien">
                  <div class="modal-dialog">
                        <div class="modal-content" style="width: 90%; height: 60%;">
                          <!-- Modal Header -->
                          <div class="modal-header">
                              <h4 class="modal-title">Informations Nouveau <?=$rolecomplet?></h4>
                              <button type="button" class="btn-close" id="Closebutton" data-bs-dismiss="modal"></button>
                          </div>
                          <!-- Modal body -->
                          <div class="modal-body">
                            <input type="hidden" name="login" value=<?=$login?>>
                            <input type="hidden" name="role" value=<?=$role?>>
                            <input type="hidden" name="pwd" value=<?=$pwd?>>
                            <input type="hidden" name="nom" value=<?=$newnom?>>
                            <input type="hidden" name="prénom" value=<?=$newprenom?>>
                            <input type="hidden" name="email" value=<?=$newemail?>>
                            <input type="hidden" name="tel" value=<?=$tel?>>
                                <div class="row kpi-card w-100 h-100">
                                    <h3>Informations Nouveau <?=$rolecomplet?></h3>
                                    <div class="row col-6">
                                        <div class="col-12 info">
                                            <span class="label">Nom:</span>
                                            <span class="value"><?=$newnom?></span>
                                        </div>
                                        <div class="col-12 info">
                                            <span class="label">Prénom:</span>
                                            <span class="value"><?=$newprenom?></span>
                                        </div>
                                        <div class="col-12 info">
                                            <span class="label">Email</span>
                                            <span class="value"><?=$newemail?></span>
                                        </div>
                                    </div>
                                    <div class="row col-6">
                                        <div class="col-12 info">
                                            <span class="label">Login Ou Identifiant:</span>
                                            <span class="value"><?=$login?></span>
                                        </div>
                                        <div class="col-12 info">
                                            <span class="label">Rôle:</span>
                                            <span class="value"><?=$role?></span>
                                        </div>
                                        <div class="col-12 info">
                                            <span class="label">Mot de passe:</span>
                                            <span class="value"><?=$pwd?></span>
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
        $("#cardtechnicien").modal({
            backdrop: 'static', // Empêche la fermeture en cliquant en dehors du modal
            keyboard: false // Désactive la fermeture en appuyant sur la touche "Esc"
        });

        // Maintenant, affichez le modal
        $("#cardtechnicien").modal("show");

        // ...
    });
</script> 
<script>
    var shouldRedirect = true; // Par défaut, permet la redirection
    document.getElementById("Closebutton").addEventListener('click', function () {
    // Effectuez la redirection ici
    if (shouldRedirect) {
            // Effectuez la redirection uniquement si shouldRedirect est vrai
            window.location.href = 'Ajout.php';
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