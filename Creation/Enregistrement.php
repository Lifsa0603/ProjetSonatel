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

$nomFichier = 'chemin/vers/le/fichier.txt'; // Remplacez cela par le chemin complet de votre fichier
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
$nomentreprise=$_POST['nomentreprise'];
$chemintech='profil_'.$identifiant.'_'.$id;
$pdfchemin=$_SESSION['pdf'];
if (!is_dir($chemintech)) {
    if (mkdir($chemintech, 0777, true)) {
        if (file_exists($pdfchemin)) {
            // Utilisez rename() pour déplacer le fichier
            if (rename($pdfchemin, $chemintech."/$pdfchemin")) {
                echo "<script>
                        document.querySelector('#downloadButton').addEventListener('click', function () {
                        var nomFichierServeur = '{$nomentreprise}.pdf';
                        var lienTelechargement = document.createElement('a');
                        lienTelechargement.href = '{$pdfchemin}';
                        lienTelechargement.download = nomFichierServeur;
                        lienTelechargement.target = '_blank';
                        lienTelechargement.style.display = 'none';
                        document.body.appendChild(lienTelechargement);
                        lienTelechargement.click();
                    });
                    </script>";
                echo "Le fichier a été déplacé avec succès <br>";
                if (suppfichier("imgsignature/img.png")) {
                    echo "Et l'image de la signature a été supprimé";
                }
            } else {
                suppfichier($pdfchemin);    
                Supprimerrep("imgsignature");     
                header("Location:../Errorpage/Error.php");  
            }
        } else {
            suppfichier($pdfchemin);
            header("Location:../Errorpage/Error.php");  
            echo "Le fichier n'a pas été généré correctement";
        }
    }
    else {
       echo "Impossible de créer le dossier.";
  }
}
else {
        if (file_exists($pdfchemin)) {
            // Utilisez rename() pour déplacer le fichier
            if (rename($pdfchemin, $chemintech."/$pdfchemin")) {
                    echo "<script>
                    document.querySelector('#downloadButton').addEventListener('click', function () {
                    var nomFichierServeur = '{$nomentreprise}.pdf';
                    var lienTelechargement = document.createElement('a');
                    lienTelechargement.href = '{$pdfchemin}';
                    lienTelechargement.download = nomFichierServeur;
                    lienTelechargement.target = '_blank';
                    lienTelechargement.style.display = 'none';
                    document.body.appendChild(lienTelechargement);
                    lienTelechargement.click();
                });
                </script>";
                echo "Le fichier a été déplacé avec succès <br>";
                if ( Supprimerrep("imgsignature")) {
                    echo "Et l'image de la signature a été supprimé";
                }
                /* */
            } else {
                echo "Impossible de déplacer le fichier.";
            }
        } else {
            echo "Le fichier d'origine n'existe pas.";
        }
}
 //Dossier unique du technicien
 /*$chemintech="profil_$identifiant-tech$id";
 if (!is_dir($chemintech)) {
     if (mkdir($chemintech, 0777, true)) {
        file_put_contents($chemintech, $fichierpdf);
        if (file_put_contents($chemintech, $fichierpdf)) {
            echo "Le fichier PDF a été enregistré avec succès dans le répertoire $chemintech.";
        } else {
            echo "Une erreur s'est produite lors de l'enregistrement du fichier PDF.";
        }
     }
     else {
        echo "Impossible de créer le dossier.";
   }
}
if (file_exists($nom_fichier)) {
    // Utilisez unlink() pour supprimer le fichier
    if (unlink($nom_fichier)) {
        echo "Le fichier a été supprimé avec succès.";
    } else {
        echo "Impossible de supprimer le fichier.";
    }
} else {
    echo "Le fichier n'existe pas.";
}



else {
    echo "Le dossier existe déjà.";
    file_put_contents($chemintech, $fichierpdf);
    if (file_put_contents($chemintech, $fichierpdf)) {
        echo "Le fichier PDF a été enregistré avec succès dans le répertoire $chemintech.";
    } else {
        echo "Une erreur s'est produite lors de l'enregistrement du fichier PDF.";
    }
}
if (chmod($chemintech, 0777)) {
    echo "Les permissions du répertoire $chemintech ont été mises à jour avec succès.";
} else {
    echo "Impossible de mettre à jour les permissions du répertoire $chemintech.";
}*/


?>