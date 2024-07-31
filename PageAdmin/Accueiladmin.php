<?php
//require_once('../identification.php');
include_once 'head.php';
?>
    <link rel="stylesheet" href="../css/accueil.css?v=1.1">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../css/monStyle.css">
    <script src="../js/jquery-1.10.2.js"></script>
    <script src="../js/bootstrap.min.js"></script>
<title>Accueil OBS</title>
</head>
<?php
include_once 'Profil.php';
?>
            <div class="col-10 row scrollable-div p-0 " style="border:solid #fc8c03; background-color:antiquewhite; box-shadow: 0px 1px 10px orange ;flex:1; height:95%; margin-left:60px; border-width:15px;background-repeat: no-repeat;background-size:100% 100%;">
                <div class="row col-sm-12 col-md-12 m-0 p-0 scrollable-div">
                    <div class="container  tableau-stat text-center">
                        <div class="row">
                        <?php
                function Message($msg,$bg){
                    $alerte="alert alert-$bg alert-dismissible fade-show";
                    ?>
                    <div class="<?php echo $alerte ?> col-12" style="height: min-content;">
                            <?php
                                echo $msg;
                            ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php
                }
                    $Verification=isset($_GET["Message_status"]);
                    if ($Verification){
                        $msg=htmlspecialchars(($_GET["Message_status"]));
                        if ($msg==="Ticket Ajouté avec Succès") {
                            Message("Ticket Ajouté avec Succès","success");           
                        }
                        else{
                            Message("Erreur Dans L'enregistrement","danger");
                        }
                    }
                    ?>
                            <!-- ************ Total des Techniciens ******************  -->
 
                            <div class="col-6">
                                <div class="stat" style="background-color:black">
                                    <?php
                                                $requete = $PDO -> prepare('SELECT COUNT(*) AS "Nbretech" FROM Utilisateur WHERE LOWER(categorie_user)=LOWER(?)');
                                                $requete->execute(["Technicien"]);
                                                $resulttech = $requete -> fetch(PDO::FETCH_ASSOC);                                        
                                    ?>
                                    <a href="Technicien.php">
                                        <span class="fa fa-users" style="color:white"></span>
                                        <div class="effectif" style="color: white;">
                                            Effectif Technicien
                                            <div class="nbr"><?=$resulttech["Nbretech"]?></div>
                                        </div>
                                    </a>
                                </div>
                            </div>

                            <!-- ************* Total des tickets  *****************  -->

                            <div class="col-6">
                                <div class="stat" style="background-color:darkslategrey">
                                    <?php
                                                $requete = $PDO -> prepare('SELECT COUNT(*) AS "Nbreticket" FROM Ticket');
                                                $requete->execute();
                                                $resultticket = $requete -> fetch(PDO::FETCH_ASSOC); 
                                                if ($resultticket) {
                                                    $requete = $PDO -> prepare('SELECT COUNT(*) AS "Nbreticket" FROM Ticket WHERE LOWER(etat_ticket)=LOWER(?)');
                                                    $requete->execute(["Validation"]);
                                                    $resultticketresolu = $requete -> fetch(PDO::FETCH_ASSOC);
                                                }                                       
                                    ?>
                                    <a href="Ticketadmin.php">
                                        <span class="fa fa-ticket" style="color:#fc8c03"></span>
                                        <div class="effectif" style="color: white;">
                                                Résolus/Total
                                            <div class="nbr"><?=$resultticketresolu["Nbreticket"]?>/<?=$resultticket["Nbreticket"]?></div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <!-- ************* Total Curative *****************  -->


                            <div class="col-6">
                                <div class="stat" style="background-color: red;">
                                    <span class="fa fa-screwdriver-wrench"></span>
                                    <?php
                                                $requete = $PDO -> prepare('SELECT COUNT(*) AS "Curative" FROM Ticket WHERE typeMaintenance=? ');
                                                $requete->execute(["Curative"]);
                                                $resultcurative = $requete -> fetch(PDO::FETCH_ASSOC);
                                                if ($resultcurative) {
                                                    $requete = $PDO -> prepare('SELECT COUNT(*) AS "Curative" FROM Ticket WHERE LOWER(etat_ticket)=LOWER(?) AND typeMaintenance=?');
                                                    $requete->execute(["Validation","Curative"]);
                                                    $resultcurativeresolu = $requete -> fetch(PDO::FETCH_ASSOC);
                                                }      
                                                                              
                                    ?>
                                    <div class="effectif">
                                        Curative <br> Resolu/Total
                                        <div class="nbr">
                                            <?=$resultcurativeresolu['Curative']?>/ <?=$resultcurative['Curative']?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- ************* Total Préventive*****************  -->
                            <div class="col-6">
                                <div class="stat" style="background-color: yellowgreen;">
                                    <span class="fa fa-server"></span>
                                    <?php
                                                $requete = $PDO -> prepare('SELECT COUNT(*) AS "Préventive" FROM Ticket WHERE typeMaintenance=? ');
                                                $requete->execute(["Préventive"]);
                                                $resultcurative = $requete -> fetch(PDO::FETCH_ASSOC);
                                                if ($resultcurative) {
                                                    $requete = $PDO -> prepare('SELECT COUNT(*) AS "Préventive" FROM Ticket WHERE LOWER(etat_ticket)=LOWER(?) AND typeMaintenance=?');
                                                    $requete->execute(["Validation","Préventive"]);
                                                    $resultcurativeresolu = $requete -> fetch(PDO::FETCH_ASSOC);
                                                }                                          
                                    ?>
                                    <div class="effectif">
                                        Préventive <br> Resolu/Total
                                        <div class="nbr">
                                            <?=$resultcurativeresolu['Préventive']?>/ <?=$resultcurative['Préventive']?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div> 
                </div>
            </div>
<?php
include_once 'Pied.php';
?>
<script>
document.addEventListener("DOMContentLoaded", function() {
    // Récupérez l'URL actuelle
    var currentURL = window.location.href;
    if (currentURL.includes("Accueiladmin")) {
        currentURL = currentURL.replace(/Accueiladmin.*/, 'Accueiladmin');
    }
                // Utilisez une expression régulière pour supprimer tout ce qui suit "technicien.php" 
    // Mettez à jour l'URL dans la barre d'adresse du navigateur
    window.history.replaceState(null, null, currentURL);
});



</script>
<!-- Autre Script -->
</body>
</html>
