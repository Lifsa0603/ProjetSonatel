<?php
    require_once 'Fonction/supp.php';
    suppauto("PdfTemporaire",0);
    if(!isset($_SESSION['user'])) {
        header('Location:../Login.php');
        exit();
    }
    else{
        if ($_SESSION['categorie_user']==="Admin") {
            header('Location:../PageAdmin/Accueiladmin.php');
            exit();
        }
    }
?>