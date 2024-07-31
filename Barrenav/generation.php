<?php
require_once 'head2.php';
require_once 'Fonction/generation.php';
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
if (isset($_POST['siteclient']) && isset($_POST['signature']) && 
    isset($_POST['Observation']) && isset($_POST['nbreetoile']) 
    && isset($_POST['client']) && isset($_POST['typemaintenance']) &&
    isset($_POST['Datedebut']) && isset($_POST['Datefin'])) {
    $data = $_POST['signature'];
    $_SESSION['Reference']=htmlspecialchars($_POST['Reference']);
    $_SESSION['Observation']=htmlspecialchars($_POST['Observation']);
    $_SESSION['nbreetoile']=htmlspecialchars($_POST['nbreetoile']);
    $_SESSION['siteclient']=htmlspecialchars($_POST['siteclient']);
    $_SESSION['typemaintenance']=htmlspecialchars($_POST['typemaintenance']);
    $mailclient=htmlspecialchars($_POST['mailclient']);
       // Récupérez les dates du formulaire (assurez-vous de les valider et de les formater correctement)
$dateDebutString = htmlspecialchars($_POST['Datedebut']);
$dateFinString = htmlspecialchars($_POST['Datefin']);

// Convertissez les chaînes en objets DateTime
$dateDebut = new DateTime($dateDebutString);
$dateFin = new DateTime($dateFinString);

// Calcul de la différence
$duree = $dateDebut->diff($dateFin);
if ($duree->days != 0) {
    $resultatduree = $duree->format('%a jours');
    if ($duree->h != 0) {
        $resultatduree .= ', ' . $duree->format('%h heures');
    }
    if ($duree->i != 0) {
        $resultatduree .= ', ' . $duree->format('%i minutes');
    }
} elseif ($duree->h != 0) {
    $resultatduree = $duree->format('%h heures');
    if ($duree->i != 0) {
        $resultatduree .= ', ' . $duree->format('%i minutes');
    }
} else {
    $resultatduree = $duree->format('%i minutes');
}
$dateDebut=$dateDebut->format('d-m-Y H:i');
$dateFin=$dateFin->format('d-m-Y H:i');

// Obtenez les jours, heures et minutes
$jours = $duree->format('%a');
$heures = $duree->format('%h');
$minutes = $duree->format('%i');




    // Supprimez le préfixe "data:image/png;base64," du format de données
    $data = str_replace("data:image/png;base64,", "", $data);
    // Convertit les données en format binaire
    $data = base64_decode($data);
    // Chemin où vous souhaitez enregistrer l'image
    $filepath = "imgsignature/img.png";
    // Enregistre l'image dans le fichier
    file_put_contents($filepath, $data);
    $nomclient=htmlspecialchars($_POST['client']);
    $nbrefichevalidation = 0; // Initialisation à zéro
    $requetefiche = $PDO->prepare('SELECT COUNT(*) AS "nbrefiche" FROM Ticket WHERE numtechnicien=? AND etat_ticket="Validation"');
    $requetefiche->execute([$_SESSION['id_technicien']]);
    $resultfiche = $requetefiche->fetch(PDO::FETCH_ASSOC);
    if ($resultfiche['nbrefiche']) {
        $nbrefichevalidation = $resultfiche['nbrefiche']; 
    }
    $nbrefichevalidation=$nbrefichevalidation+1;
    $idfiche=("$idtechnicien"."$nbrefichevalidation");
    $file="PdfTemporaire/$nomclient"."_T-00$idtechnicien"."N_$idfiche";
    $nomfichiertelecharger=$nomclient."_T-00$idtechnicien"."N_$idfiche";
    $_SESSION['fichiergenerer']=$file.".pdf";
    generationpdf($file,$nomclient,$_POST['Observation'],$_POST['Reference'],
    $_POST['typemaintenance'],$idfiche,$mailclient,$_POST['siteclient'],$_POST['telephone'],
    $prenom,$nom,$email,$telephone,$data,$dateDebut,$dateFin,$resultatduree);
}

/* */

?>
<!-- Inclure les fichiers JavaScript et CSS de PDF.js -->
<script src="PDFjs/build/pdf.js"></script>
<link rel="stylesheet" href="PDFjs/web/viewer.css">
<title>Fiche Maintenance</title>
</head>
<form action="Enregistrement.php" method="POST" enctype="multipart/form-data" >
      <!-- The Modal -->
              <div class="modal" id="generation">
                  <div class="modal-dialog">
                    <div class="modal-content" style="width: 90%; height: 60%;">
                          <!-- Modal Header -->
                          <div class="modal-header">
                              <h4 class="modal-title">Fichier PDF Généré</h4>
                              <button type="button" class="btn-close" id="Closebutton" data-bs-dismiss="modal"></button>
                          </div>
                          <!-- Modal body -->
                          <div class="modal-body">
                                 <iframe src="<?=$file?>.pdf#toolbar=0" width="100%" height="400" style="border: none;"></iframe>
                            </div>
                          <!-- Modal footer -->
                          <div class="modal-footer">
                              <button type="button" id="Closebutton2" class="btn btn-danger" data-bs-dismiss="modal">Annuler</button>
                              <button type="submit" class="btn btn-success" id="downloadButton" data-bs-dismiss="modal">Télécharger le PDF et Enregistrer</button>
                          </div>
                      </div>
                  </div>
              </div>
      </form>
      <script>
    $(document).ready(function () {
        // Sélectionnez le modal par son ID et configurez les paramètres
        $("#generation").modal({
            backdrop: 'static', // Empêche la fermeture en cliquant en dehors du modal
            keyboard: false // Désactive la fermeture en appuyant sur la touche "Esc"
        });

        // Maintenant, affichez le modal
        $("#generation").modal("show");

        // ...
    });
</script> 
<script>
     var shouldRedirect = true; // Par défaut, permet la redirection
    document.getElementById("downloadButton").addEventListener('click', function () {
    var nomFichierServeur = '<?=$nomfichiertelecharger?>.pdf';
    var cheminDestination = '<?=$file?>.pdf';
    var lienTelechargement = document.createElement('a');
    lienTelechargement.href = cheminDestination;
    lienTelechargement.download = nomFichierServeur;
    lienTelechargement.style.display = 'none';
    document.body.appendChild(lienTelechargement);
    lienTelechargement.click();
    });
    document.getElementById("Closebutton").addEventListener('click', function () {
    // Effectuez la redirection ici
    if (shouldRedirect) {
            // Effectuez la redirection uniquement si shouldRedirect est vrai
            window.location.href = 'Accueil.php';
        }
});
document.getElementById("Closebutton2").addEventListener('click', function () {
    // Effectuez la redirection ici
    if (shouldRedirect) {
            // Effectuez la redirection uniquement si shouldRedirect est vrai
            window.location.href = 'Accueil.php';
        }
});

</script>
</body>
</html>