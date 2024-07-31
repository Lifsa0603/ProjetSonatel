<?php
require_once 'Fonction/supp.php';
//require_once('../identification.php');
include_once 'head.php';
?>
<link rel="stylesheet" href="../css/accueil.css?v=1.1">
<title>Accueil OBS</title>
</head>
<?php
include_once 'Profil.php';
?>
            <div class="col-10 row scrollable-div p-0 " style="border:solid #fc8c03; box-shadow: 0px 1px 10px orange ;flex:1; height:95%; margin-left:60px; border-width:15px;background-repeat: no-repeat;background-size:100% 100%;">
                <div class="row col-sm-12 col-md-10 m-0 p-0 scrollable-div">
                    
                    <div class="col-12 col-sm-6 col-md-6 m-0 p-0" id="grapheticket">
                        <?php
                        include_once 'grapheticket.php';
                        $requetetypemaintenance = $PDO->prepare('SELECT tm.typeMaintenance, COALESCE(COUNT(t.typeMaintenance), 0) AS "Nombre Maintenance"
                        FROM (
                            SELECT "Préventive" AS typeMaintenance
                            UNION
                            SELECT "Curative" AS typeMaintenance
                        ) tm
                        LEFT JOIN Ticket t ON tm.typeMaintenance = t.typeMaintenance
                                          AND t.etat_ticket BETWEEN 1 AND 5
                                          AND t.datecloturation IS NOT NULL
                                          AND t.etat_ticket = "Validation"
                                          AND t.numtechnicien = ?
                        GROUP BY tm.typeMaintenance;
                        ');
                        $requetetypemaintenance->execute(array($idtechnicien));
                        $resulttypemaintenance = $requetetypemaintenance->fetchAll(PDO::FETCH_ASSOC);
                        if ($resulttypemaintenance) {
                            foreach ($resulttypemaintenance as $key) {
                                if ($key['typeMaintenance']=="Préventive") {
                                    $nbrepreventive=$key['Nombre Maintenance'];
                                }
                                else if ($key['typeMaintenance']=="Curative") {
                                    $nbrecurative=$key['Nombre Maintenance'];
                                }
                            }
                        }
                        $nombremaintenancetraite=$nbrecurative+$nbrepreventive;
                        ?>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 Maintenance m-0 p-0">
                         <!--  -->
                        <div class="scrollable-div col-sm-6 col-md-6 kpi-card-etoile w-100 h-100 m-0 p-0" style="text-align: center; border:2px solid gray;height:min-content" >
                            <h2 style="text-decoration:underline" >Nombre Maintenance Traités</h2>
                            <h3 style="margin-top: 10px;margin-left:10px" >Maintenance <br>Préventive: <br><?=$nbrepreventive?></h3>
                            <h3 style="margin-top: 10px;margin-left:10px" >Maintenance<br> Curative: <br><?=$nbrecurative?></h3>
                        </div>
                         <!--  -->

                    </div>
                    <div class="col-sm-12 col-md-6 Resolution m-0 p-0">
                        <!--  -->
                        <div class="scrollable-div col-sm-6 col-md-6 kpi-card-etoile w-100 h-100 m-0 p-0" style="text-align: center; border:2px solid gray;position:relative;justify-items:center" >
                            <h2 style="text-decoration:underline" >Pourcentage Résolution <br>En Moins de 24H </h2>
                            <?php
                            /*Moins 24h */
                            $requeteresolutionmoins24h = $PDO->prepare('SELECT datecloturation,dateCreation,
                            COUNT(*) As "Nombre-24h",
                            TIMESTAMPDIFF(DAY,dateCreation,datecloturation) AS NbreJour
                            from Ticket
                            WHERE TIMESTAMPDIFF(DAY,dateCreation,datecloturation)<1
                            AND numtechnicien=? AND etat_ticket="Validation"');
                            $requeteresolutionmoins24h->execute(array($idtechnicien));
                            $resultresolutionmoins24h = $requeteresolutionmoins24h->fetch(PDO::FETCH_ASSOC);
                          
                            if($resultresolutionmoins24h["Nombre-24h"]!=0) {
                                $Pourcentagemoins24h=number_format($resultresolutionmoins24h["Nombre-24h"]/$nombremaintenancetraite,2)*100;
                                /*Plus 24h */
                                if ($Pourcentagemoins24h<=50) {
                                    $Couleurpourcentslice2="#f0f0f0";
                                    $rotation2=-180+3.6*($Pourcentagemoins24h);
                                    if ($Pourcentagemoins24h<=12) {
                                        $Couleurpourcentslice1="rgb(255,0,0)";
                                    }
                                    elseif($Pourcentagemoins24h>12 && $Pourcentagemoins24h<=21){
                                        $Couleurpourcentslice1="rgb(255,128,0)";
                                    }
                                    elseif($Pourcentagemoins24h>21 && $Pourcentagemoins24h<=43){
                                        $Couleurpourcentslice1="rgb(255,153,51)";
                                    }
                                    else{
                                        $Couleurpourcentslice1="rgb(255,255,0)";
                                    }
                                    
                                }
                                else {
                                    $rotation2=180+3.6*($Pourcentagemoins24h-50);
                                    if ($Pourcentagemoins24h>50 && $Pourcentagemoins24h<=79 ) {
                                        $Couleurpourcentslice2="rgb(255,255,0)";
                                        $Couleurpourcentslice1="rgb(255,255,0)";
                                    }
                                    elseif($Pourcentagemoins24h>79 && $Pourcentagemoins24h<=89){
                                        $Couleurpourcentslice2="rgb(128,255,0)";
                                        $Couleurpourcentslice1="rgb(128,255,0)";
                                    }
                                    else{
                                        $Couleurpourcentslice2="rgb(0,255,0)";
                                        $Couleurpourcentslice1="rgb(0,255,0)";
                                    }
                                }
                            }
                            else{
                                $Pourcentagemoins24h=0;
                                $Couleurpourcentslice2="#f0f0f0";
                                $Couleurpourcentslice1="#f0f0f0";
                                $rotation2=360;
                            }
                            ?>
                            
                            <div class="pie-chart" style="position: relative;left:25%">
                                <div class="slice slice-1" style="background-color:<?=$Couleurpourcentslice1?>;transform: rotate(180deg);"></div>
                                <div class="slice slice-2" style="background-color:<?=$Couleurpourcentslice2?>;transform: rotate(<?=$rotation2?>deg);" ></div>
                                <!-- Ajoutez plus de divs pour chaque segment -->
                                <div class="center-text" style="font-size: xx-large;" ><?=$Pourcentagemoins24h?>% <br><?=$resultresolutionmoins24h["Nombre-24h"]?>/<?=$nombremaintenancetraite?> </div>
                            </div>
                        </div>
                        <!--  -->
                    </div>
                    <div class="col-sm-12 col-md-6 h-50">Graphe4</div>
                </div>
                <div id="noteclient" class="row d-flex col-sm-12 col-md-2 m-0 p-0" style="border-radius: 25px;border: 1px solid transparent;background-color:#f28507" >
                    <p id="noteclienttext" style="text-align:center;text-decoration:underline;;">Satisfaction Client</p>
                    <?php
                        $requetenote = $PDO->prepare('SELECT AVG(note_ticket) AS "Moyenne_ticket" FROM Ticket WHERE note_ticket BETWEEN 1 AND 5 AND numtechnicien=?');
                        $requetenote->execute(array($idtechnicien));
                        $resultnote = $requetenote->fetch(PDO::FETCH_ASSOC);
                        /*RequetenoteAll */
                        if ($resultnote) {
                            # code...
                            $realnote=($resultnote["Moyenne_ticket"]*100)/(5);
                            $Notepourcent=number_format($realnote,1);
                        }
                        else {
                            $realnote=0;
                            $Notepourcent=0;
                        }
                        
                    ?>
                    <div id="noteclient1" class="col-12 pie-chartclient" style="position: relative;left:0;bottom:19%">
                    <div class="sliceclient sliceclient-1" style="background-color:#f0f0f0;transform: rotate(180deg);"></div>
                        <div class="sliceclient sliceclient-2" style="background-color:#f0f0f0;transform: rotate(360deg);" ></div>
                        <!-- Ajoutez plus de divs pour chaque segment -->
                        <?php 
                            if ($Notepourcent==0 && $nombremaintenancetraite==0) {
                                $fontsize="Medium";
                                $Notepourcentecrit="Aucune Appréciation Client!";
                            }
                            else {
                                $fontsize="xx-large";
                                $Notepourcentecrit=$Notepourcent."%";
                            }
                            ?>  
                        <div class="center-textclient" style="font-size:<?=$fontsize?>;" ><?=$Notepourcentecrit?>  
                        </div>
                    </div>
                   
                </div>
            </div>
<?php
include_once 'Pied.php';
?>
<!-- Autre Script -->
<script src="../js/grapheticket.js?v=1.1"></script>
</body>
</html>
