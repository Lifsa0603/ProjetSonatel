<?php
function suppauto($repertoireasupprimer,$tempsfichierserveur){
    $files = scandir($repertoireasupprimer);
    // Parcourt chaque fichier
    foreach ($files as $file) {
        $cheminFichier = $repertoireasupprimer . '/' . $file;
        // Vérifie si le fichier est un fichier ordinaire et s'il a été créé il y a plus de 15 minutes
        if (is_file($cheminFichier) && time() - filectime($cheminFichier) > $tempsfichierserveur) {
            // Supprime le fichier
            unlink($cheminFichier);
        }
    }
}

?>
