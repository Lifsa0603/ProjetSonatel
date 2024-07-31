<?php
//require_once('../identification.php');
include_once 'head.php';
?>
<title>Techniciens</title>
<link rel="stylesheet" href="../css/Ticketadmin.css">
<!-- Autres Lien Css dans le head -->
</head>

<?php


include_once 'Profil.php';
$requete = $PDO->prepare('SELECT COUNT(*) AS "Totalticket" FROM Ticket');
$requete->execute();
$Allticket = $requete->fetch(PDO::FETCH_ASSOC);
?>
<!-- Contenu -->
<div class="col-10 row scrollable-div p-0"
    style="border:solid black; box-shadow: 0px 1px 10px orange ;flex:1; height:95%; margin-left:60px; border-width:15px;background-repeat: no-repeat;background-size:100% 100%;">
    <div class="row col-12 p-0 m-0 dashboard">
        <!--  -->
        <div class="container col-12">
            <div class="panel panel-primary">
            <div class="col-12 row card" style="align-items:center">
            <div class="col-12 row justify-content-center">
                <div class="col-5">
                    <div class="flip-box w-100">
                        <div class="flip-box-inner">
                            <div class="flip-box-front" style="background-color: red;color: black;">
                                <h2>Maintenance Curative</h2> <br>
                                <i class="fa-solid fa-screwdriver-wrench fa-2xl" style="color: #080808;font-size:60px"></i> <br> <br>
                                <span>
                                    Cliquez pour voir les détails
                                </span>
                            </div>
                            <div class="flip-box-back" style="background-color:red;color: white;transform: rotateX(180deg);">
                            <?php
                            $requetecurative = $PDO->prepare('SELECT
                            SUM(CASE WHEN (etat_ticket = "Validation" AND typeMaintenance="Curative") THEN 1 ELSE 0 END) AS ValidationCount,
                            SUM(CASE WHEN (etat_ticket = "Traitement en cours" AND typeMaintenance="Curative") THEN 1 ELSE 0 END) AS TraitementCount,
                            ROUND(SUM(CASE WHEN (etat_ticket = "Validation" AND typeMaintenance="Curative")  THEN 1 ELSE 0 END) * 100.0 / COUNT(*), 2) AS ValidationPercentage,
                            ROUND(SUM(CASE WHEN (etat_ticket = "Traitement en cours" AND typeMaintenance="Curative") THEN 1 ELSE 0 END) * 100.0 / COUNT(*), 2) AS TraitementPercentage
                            FROM Ticket WHERE typeMaintenance="Curative"');
                            $requetecurative->execute();
                            $Curative = $requetecurative->fetch(PDO::FETCH_ASSOC);
                            $Totalcurative=$Curative['ValidationCount']+$Curative['TraitementCount']
                            ?>
                            <h2>Statistiques</h2>
                           <span style="text-align:start;color: #080808;">Total Maintenance Curative:<?=$Totalcurative?></span> <br>
                           <span style="text-align:start;color: #080808;">Cloturé:<?=$Curative['ValidationCount']?></span> 
                           <span style="text-align:start;color: #080808;">Traitement:<?=$Curative['TraitementCount']?></span> 
                           <?php
                                $Pourcentagecurativecloture=$Curative['ValidationPercentage'];
                                if ($Pourcentagecurativecloture<=50) {
                                    $Couleurpourcentslice2="#f0f0f0";
                                    $rotation2=-180+3.6*($Pourcentagecurativecloture);
                                    if ($Pourcentagecurativecloture<=12) {
                                        $Couleurpourcentslice1="rgb(255,0,0)";
                                    }
                                    elseif($Pourcentagecurativecloture>12 && $Pourcentagecurativecloture<=21){
                                        $Couleurpourcentslice1="rgb(255,128,0)";
                                    }
                                    elseif($Pourcentagecurativecloture>21 && $Pourcentagecurativecloture<=43){
                                        $Couleurpourcentslice1="rgb(255,153,51)";
                                    }
                                    else{
                                        $Couleurpourcentslice1="rgb(255,255,0)";
                                    }
                                    
                                }
                                else {
                                    $rotation2=180+3.6*($Pourcentagecurativecloture-50);
                                    if ($Pourcentagecurativecloture>50 && $Pourcentagecurativecloture<=79 ) {
                                        $Couleurpourcentslice2="rgb(255,255,0)";
                                        $Couleurpourcentslice1="rgb(255,255,0)";
                                    }
                                    elseif($Pourcentagecurativecloture>79 && $Pourcentagecurativecloture<=89){
                                        $Couleurpourcentslice2="rgb(128,255,0)";
                                        $Couleurpourcentslice1="rgb(128,255,0)";
                                    }
                                    else{
                                        $Couleurpourcentslice2="rgb(0,255,0)";
                                        $Couleurpourcentslice1="rgb(0,255,0)";
                                    }
                                }
                            ?>
                            
                            <div class="pie-chart"  style="position: relative;left:25%;">
                                <div class="slice slice-1" style="background-color:<?=$Couleurpourcentslice1?>;transform: rotate(180deg);"></div>
                                <div class="slice slice-2" style="background-color:<?=$Couleurpourcentslice2?>;transform: rotate(<?=$rotation2?>deg);" ></div>
                                <!-- Ajoutez plus de divs pour chaque segment -->
                                <div class="center-text" style="font-size:larger; color:#080808" ><?=$Pourcentagecurativecloture?>% <br><?=$Curative['ValidationCount']?>/<?=$Totalcurative?> </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-5">
                    <div class="flip-box w-100 ">
                        <div class="flip-box-inner">
                            <div class="flip-box-front" style="background-color: yellowgreen;color: black;">
                                <h2>Maintenance Préventive</h2> <br> 
                                <i class="fa-solid fa-server fa-2xl" style="color: #080808;font-size:60px"></i> <br> <br>
                                <span>
                                    Cliquez pour voir les détails
                                </span>
                            </div>
                            <div class="flip-box-back" style="background-color: yellowgreen;color: white;transform: rotateX(180deg);">
                                <?php
                            $requetepreventive = $PDO->prepare('SELECT
                            SUM(CASE WHEN (etat_ticket = "Validation" AND typeMaintenance="Préventive") THEN 1 ELSE 0 END) AS ValidationCountpreventive,
                            SUM(CASE WHEN (etat_ticket = "Traitement en cours" AND typeMaintenance="Préventive") THEN 1 ELSE 0 END) AS TraitementCountpreventive,
                            ROUND(SUM(CASE WHEN (etat_ticket = "Validation" AND typeMaintenance="Préventive")  THEN 1 ELSE 0 END) * 100.0 / COUNT(*), 2) AS ValidationPercentagepreventive,
                            ROUND(SUM(CASE WHEN (etat_ticket = "Traitement en cours" AND typeMaintenance="Préventive") THEN 1 ELSE 0 END) * 100.0 / COUNT(*), 2) AS TraitementPercentagepreventive
                            FROM Ticket WHERE typeMaintenance="Préventive"');
                            $requetepreventive->execute();
                            $Preventive = $requetepreventive->fetch(PDO::FETCH_ASSOC);
                            $Totalpreventive=$Preventive['ValidationCountpreventive']+$Preventive['TraitementCountpreventive']
                            ?>
                            <h2>Statistiques</h2>
                           <span style="text-align:start;color: #080808;">Total Maintenance Preventive:<?=$Totalpreventive?></span> <br>
                           <span style="text-align:start;color: #080808;">Cloturé:<?=$Preventive['ValidationCountpreventive']?></span> 
                           <span style="text-align:start;color: #080808;">Traitement:<?=$Preventive['TraitementCountpreventive']?></span> 
                           <?php
                                $Pourcentagepreventivecloture=$Preventive['ValidationPercentagepreventive'];
                                if ($Pourcentagepreventivecloture<=50) {
                                    $Couleurpourcentslice2="#f0f0f0";
                                    $rotation2=-180+3.6*($Pourcentagepreventivecloture);
                                    if ($Pourcentagepreventivecloture<=12) {
                                        $Couleurpourcentslice1="rgb(255,0,0)";
                                    }
                                    elseif($Pourcentagepreventivecloture>12 && $Pourcentagepreventivecloture<=21){
                                        $Couleurpourcentslice1="rgb(255,128,0)";
                                    }
                                    elseif($Pourcentagepreventivecloture>21 && $Pourcentagepreventivecloture<=43){
                                        $Couleurpourcentslice1="rgb(255,153,51)";
                                    }
                                    else{
                                        $Couleurpourcentslice1="rgb(255,255,0)";
                                    }
                                    
                                }
                                else {
                                    $rotation2=180+3.6*($Pourcentagepreventivecloture-50);
                                    if ($Pourcentagepreventivecloture>50 && $Pourcentagepreventivecloture<=79 ) {
                                        $Couleurpourcentslice2="rgb(255,255,0)";
                                        $Couleurpourcentslice1="rgb(255,255,0)";
                                    }
                                    elseif($Pourcentagepreventivecloture>79 && $Pourcentagepreventivecloture<=89){
                                        $Couleurpourcentslice2="rgb(128,255,0)";
                                        $Couleurpourcentslice1="rgb(128,255,0)";
                                    }
                                    else{
                                        $Couleurpourcentslice2="rgb(0,255,0)";
                                        $Couleurpourcentslice1="rgb(0,255,0)";
                                    }
                                }
                            ?>
                            
                            <div class="pie-chart"  style="position: relative;left:25%;">
                                <div class="slice slice-1" style="background-color:<?=$Couleurpourcentslice1?>;transform: rotate(180deg);"></div>
                                <div class="slice slice-2" style="background-color:<?=$Couleurpourcentslice2?>;transform: rotate(<?=$rotation2?>deg);" ></div>
                                <!-- Ajoutez plus de divs pour chaque segment -->
                                <div class="center-text" style="font-size:larger; color:#080808" ><?=$Pourcentagepreventivecloture?>% <br><?=$Preventive['ValidationCountpreventive']?>/<?=$Totalpreventive?> </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            </div>
                <div class="panel-body">
                <button id="Filtrer" style="background: none; border: none; color: blue; cursor: pointer; text-decoration: underline;">Filtrer</button>
                    <div class="row col-12" id="div_filtrer"
                        style="display: <?php echo isset($_GET["Client"]) || isset($_GET["Site"]) ? 'flex' : 'none'; ?>;">
                        <!-- Formulaire HTML -->
                        <form method="get" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="col-sm-12">
                            <div class="row barre_recherche" style="background-color: burlywood;" >
                                <!-- Début 1ère Ligne -->
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="Client">Client</label>
                                        <input type="search" class="form-control" placeholder="Client" name="Client"
                                            value="<?php echo isset($_GET["Client"]) ? htmlspecialchars($_GET["Client"]) : ''; ?>">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="Site">Site</label>
                                        <input type="search" class="form-control" placeholder="Site" name="Site"
                                            value="<?php echo isset($_GET["Site"]) ? htmlspecialchars($_GET["Site"]) : ''; ?>">
                                    </div>
                                </div>
                                <!-- Fin 1ère Ligne -->


                                <!--Début 2ème Ligne  -->
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="identifiant">Identifiant</label>
                                        <input type="search" class="form-control" placeholder="Identifiant" name="identifiant"
                                            value="<?php echo isset($_GET["identifiant"]) ? htmlspecialchars($_GET["identifiant"]) : ''; ?>">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="Email">Email</label>
                                        <input type="search" class="form-control" placeholder="Email" name="email"
                                            value="<?php echo isset($_GET["email"]) ? htmlspecialchars($_GET["email"]) : ''; ?>">
                                    </div>
                                </div>

                                <!-- Fin 2ème Ligne -->


                                 <!--Début 3ème Ligne  -->
                                 <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="prénom">Prénom Technicien</label>
                                        <input type="search" class="form-control" placeholder="Prénom Technicien" name="PrénomTechnicien"
                                            value="<?php echo isset($_GET["PrénomTechnicien"]) ? htmlspecialchars($_GET["PrénomTechnicien"]) : ''; ?>">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="NomTechnicien">Nom Technicien</label>
                                        <input type="search" class="form-control" placeholder="Nom Technicien" name="NomTechnicien"
                                            value="<?php echo isset($_GET["NomTechnicien"]) ? htmlspecialchars($_GET["NomTechnicien"]) : ''; ?>">
                                    </div>
                                </div>

                                <!-- Fin 3ème Ligne -->
                                <br>


                                <!--Début 4ème Ligne  -->
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="TypeMaintenance">Type Maintenance</label>
                                        <select class="form-control" name="Typemaintenance">
                                            <option value="" hidden>Type Maintenance</option>
                                            <option value="All" <?php echo isset($_GET["Typemaintenance"]) && $_GET["Typemaintenance"] === "All" ? 'selected' : ''; ?>>All</option>
                                            <option value="Préventive" <?php echo isset($_GET["Typemaintenance"]) && $_GET["Typemaintenance"] === "Préventive" ? 'selected' : ''; ?>>Préventive</option>
                                            <option value="Curative" <?php echo isset($_GET["Typemaintenance"]) && $_GET["Typemaintenance"] === "Curative" ? 'selected' : ''; ?>>Curative</option>
                                            <!-- Ajoutez plus d'options selon les états de ticket que vous avez -->
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="Etat_Ticket">Etat Ticket</label>
                                        <select class="form-control" name="Etat_Ticket">
                                            <option value="" hidden>Sélectionnez Type Ticket</option>
                                            <option value="All" <?php echo isset($_GET["Etat_Ticket"]) && $_GET["Etat_Ticket"] === "All" ? 'selected' : ''; ?>>All</option>
                                            <option value="Validation" <?php echo isset($_GET["Etat_Ticket"]) && $_GET["Etat_Ticket"] === "Validation" ? 'selected' : ''; ?>>Validation</option>
                                            <option value="Traitement en cours" <?php echo isset($_GET["Etat_Ticket"]) && $_GET["Etat_Ticket"] === "Traitement en cours" ? 'selected' : ''; ?>>Traitement en cours</option>
                                            <!-- Ajoutez plus d'options selon les états de ticket que vous avez -->
                                        </select>
                                    </div>
                                </div>
                                <!-- Fin 4ème Ligne -->
                                <br>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <input type="submit" value="Rechercher" class="btn" style="background-color:#f67c09;position:relative;" >
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <hr>
                    <div class="row" >
                        <?php
                         if ($_SERVER["REQUEST_METHOD"] === "GET") {
                            // Récupération des valeurs provenant de la requête GET (si elles existent)
                            $siterecherche = isset($_GET["Site"]) ? htmlspecialchars($_GET["Site"]) : "";
                            $clientrecherche = isset($_GET["Client"]) ? htmlspecialchars($_GET["Client"]) : "";
                            $identifiantrecherche=isset($_GET["identifiant"]) ? htmlspecialchars($_GET["identifiant"]) : "";
                            $emailrecherche=isset($_GET["email"]) ? htmlspecialchars($_GET["email"]) : "";
                            $nomtechticket=isset($_GET["NomTechnicien"]) ? htmlspecialchars($_GET["NomTechnicien"]) : "";
                            $prenomtechticket=isset($_GET["PrénomTechnicien"]) ? htmlspecialchars($_GET["PrénomTechnicien"]) : "";
                            $maintenance=isset($_GET["Typemaintenance"]) ? htmlspecialchars($_GET["Typemaintenance"]) : "";
                            $etat_ticket=isset($_GET["Etat_Ticket"]) ? htmlspecialchars($_GET["Etat_Ticket"]) : "";
                        }
                        $ligne_requete = "SELECT T.urlfichemaintenance,T.ref_ticket,T.etat_ticket,T.typeMaintenance,T.datecloturation,T.numtechnicien,
                        S.clientproprietaire,S.nomsite_systeme,
                        U.prenom,U.nom,U.id_technicien
                        FROM Ticket AS T INNER JOIN Systeme AS S ON
                        T.systemeclient=S.ref_systeme_client
                        INNER JOIN Utilisateur AS U ON 
                        U.id_technicien=T.numtechnicien
                        AND ";
                        if (!empty($_GET['Client'])) {
                            $ligne_requete .= " clientproprietaire LIKE '%$clientrecherche%' AND";
                        }
                        if (!empty($_GET['Site'])) {
                            $ligne_requete .= " nomsite_systeme LIKE '%$siterecherche%' AND";
                        }
                        if (!empty($_GET['identifiant'])) {
                            $ligne_requete .= " identifiant LIKE '%$identifiantrecherche%' AND";
                        }
                        if (!empty($_GET['email'])) {
                            $ligne_requete .= " email LIKE '$emailrecherche' AND";
                        }
                        if (!empty($_GET['NomTechnicien'])) {
                            $ligne_requete .= " nom LIKE '$nomtechticket%' AND";
                        }
                        if (!empty($_GET['Typemaintenance'])) {
                            if ($_GET['Typemaintenance']==="All") {
                                $ligne_requete .= " 3=3 AND";
                            }
                            else{
                                $ligne_requete .= " typeMaintenance='$maintenance' AND";
                            }
                        }
                        if (!empty($_GET['Etat_Ticket'])) {
                            if ($_GET['Etat_Ticket']==="All") {
                                $ligne_requete .= " 2=2 AND";
                            }
                            else{
                                $ligne_requete .= " etat_ticket='$etat_ticket' AND";
                            } 
                        }
                        /*if (!empty($_GET['PrénomTechnicien'])) {
                            $prenomtechticket = $_GET['PrénomTechnicien'];
                            $ligne_requete .= " (prenom LIKE '%$prenomtechticket' OR prenom LIKE '$prenomtechticket %' OR prenom LIKE '%$prenomtechticket %' OR prenom LIKE '% $prenomtechticket%') AND";
                        }  
                        $nbreparpages=5;
                        $limit = ($page_num - 1) * $nbreparpages;   */                                                                                                   
                        $ligne_requete .=" 1=1 ORDER BY datecloturation DESC";
                        $requete = $PDO->prepare($ligne_requete);
                        $requete->execute();
                        $lestickets = $requete->fetchAll(PDO::FETCH_ASSOC);
                        $nbreticket=$requete->rowCount();
                        /*$lastpage=ceil($nbreticket/$nbreparpages);
                        $nbrepdf_avant_apres=2;
                        if (isset($_GET['page']) && is_numeric($_GET['page'])) {
                            $page_num=$_GET['page'];
                        }
                        else{
                            $page_num=1;
                        }
                        if ($page_num<1) {
                            $page_num=1;
                        }
                        else{
                            if ($page_num>=$lastpage) {
                                $page_num=$lastpage;
                            }
                        }*/
                        ?>
                        <div class="col-6" >
                            <b>Total:</b><?=$nbreticket?>
                        </div>
                        <div class="col-6" style="text-align: end;">
                        <b>Enregistrement/Page</b>
                        <select name="Filterbypage" id="" style="width: 25%;" >
                            <option value="" hidden></option>
                            <option value="">5</option>
                            <option value="">25</option>
                            <option value="">50</option>
                        </select>
                        </div>
                    </div>
                    <table class="table table-striped table-bordered table-warning">
                        <thead>
                        <th>Références</th>
                        <th>Client</th>
                        <th>Site</th>
                        <th>Technicien</th>
                        <th>Type Maintenance</th>
                        <th>Date Cloturation</th>
                        <th>Lien Téléchargement</th>
                        </thead>
                        <?php
                           
                            if ($lestickets) {
                                foreach ($lestickets as $key) {
                                    ?>
                                    <!-- <a href="" download="" title="Cliquez pour télécharger"> -->
                                    <tr>
                                    <td><?=$key["ref_ticket"]?></td>
                                    <td><?=$key["clientproprietaire"]?></td>
                                    <td><?=$key["nomsite_systeme"]?></td>
                                    <td><?=$key["prenom"]?> <?=$key["nom"]?></td>
                                    <td><?=$key["typeMaintenance"]?></td>
                                    <td style="text-align: center;" ><?php 
                                    if ($key["datecloturation"]===null) {
                                        $key["datecloturation"]="-";
                                    }
                                    echo ($key["datecloturation"])
                                    ?></td>
                                    <td>
                                        <?php
                                            if ($key["urlfichemaintenance"]==!null) {
                                                
                                        ?>
                                        <a href="../Barrenav/<?=$key['urlfichemaintenance']?>" download title="Cliquez pour télécharger">
                                            <i class="fa-solid fa-file-pdf fa-xl" style="color: #e38a0d;"></i>
                                        </a>
                                        <?php
                                        }
                                        else{
                                            echo ('-');
                                        }
                                        ?> 
                                    </td>
                                    
                                    <?php
                                        echo("</tr>");
                                    }
                                }
                                else {
                                    ?>
                            <td colspan="7" style="text-align: center;">No Records Found</td>
                            <?php
                                }
                                ?> 
                    </table>
                </div>
                <!--  -->
            </div>
        </div>
        <!-- Fin Div -->
        <?php
        include_once 'Pied.php';
        ?>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const flipBoxes = document.querySelectorAll(".flip-box");

        flipBoxes.forEach((flipBox) => {
            let isFlipped = false;

            flipBox.addEventListener("click", function (event) {
                // Empêcher l'effet de survol
                event.preventDefault();

                const inner = flipBox.querySelector(".flip-box-inner");

                if (isFlipped) {
                    inner.style.transform = "rotateX(0deg)";
                } else {
                    inner.style.transform = "rotateX(180deg)";
                }
                // Ajouter une transition CSS pour une animation en douceur
                inner.style.transition = "transform 1s";
                isFlipped = !isFlipped;
            });
        });

    var currentURL = window.location.href;
    // Utilisez une expression régulière pour supprimer tout ce qui suit "Ticketadmin2.php"
    currentURL = currentURL.replace(/Ticketadmin.*/, 'Ticketadmin');

    // Mettez à jour l'URL dans la barre d'adresse du navigateur
    window.history.replaceState(null, null, currentURL);

    // Ajoutez une variable pour suivre l'état d'affichage de la div de filtrage
    var isDivVisible = <?php echo isset($_GET["Client"]) || isset($_GET["Site"]) ? 'true' : 'false'; ?>;

    Boutonfiltrer = document.getElementById("Filtrer");
    divfilter = document.getElementById("div_filtrer");

    // Utilisez la variable pour afficher ou masquer la div de filtrage
    Boutonfiltrer.addEventListener('click', function() {
        if (isDivVisible) {
        divfilter.style.cssText = "display:none";
        Boutonfiltrer.innerHTML = "Filtrer";
        } else {
        divfilter.style.cssText = "display:flex";
        Boutonfiltrer.innerHTML = "Masquer";
        }

        // Inversez l'état d'affichage
        isDivVisible = !isDivVisible;
    });

    // Vérifiez si la div de filtrage devrait être initialement affichée ou masquée
    if (isDivVisible) {
        divfilter.style.cssText = "display:flex";
        Boutonfiltrer.innerHTML = "Masquer";
    } else {
        divfilter.style.cssText = "display:none";
        Boutonfiltrer.innerHTML = "Filtrer";
    }
});

</script>


</body>
</html>
