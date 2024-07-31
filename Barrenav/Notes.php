<?php
require_once 'Fonction/supp.php';
suppauto("PdfTemporaire",0);
//require_once('../identification.php');
include_once 'head.php';
?>
<title>Notes&Observations OBS</title>
<!-- Autres Lien Css dans le head -->
<link rel="stylesheet" href="../css/Notes.css">
</head>
<?php
include_once 'Profil.php';
?>
<!-- Contenu -->
        <div class="col-10 row scrollable-div p-0" style="border:solid black; box-shadow: 0px 1px 10px orange ;flex:1; height:95%; margin-left:60px; border-width:15px;background-repeat: no-repeat;background-size:100% 100%;">
            <div class="row col-12 p-0 m-0 w-100 h-100 dashboard">

                
                <div class="row col-12 content w-100 h-100 m-0 p-0 scrollable-div">
                    <div class="scrollable-div col-sm-7 col-12 col-md-6 col-lg-6 col-xl-6 col-xxl-6 kpi-card-etoile h-50 m-0 p-0" style="text-align: center; border:2px solid gray" >
                        <h2 style="margin-top: 10px;margin-left:10px" >Nombre de tickets résolus</h2>
                        <?php
                            $requetenote = $PDO->prepare('SELECT AVG(note_ticket) AS "Moyenne_ticket",COUNT(*) AS "Nombre_ticket_noté" FROM Ticket WHERE note_ticket BETWEEN 1 AND 5
                            AND numtechnicien=?');
                            $requetenote->execute(array($idtechnicien));
                            $resultnote = $requetenote->fetch(PDO::FETCH_ASSOC);
                            
                            //RequetenoteAll
                            $moyennenote=$resultnote["Moyenne_ticket"];
                            $noterealsur5=($resultnote["Moyenne_ticket"])/(5);
                            $Notepourcent=($noterealsur5)*100;
                            if (number_format($moyennenote, 2)-number_format($moyennenote, 1)==0) {
                                $averageNoteFormatted = number_format($moyennenote, 1);
                            }
                            else{
                                $averageNoteFormatted = number_format($moyennenote, 2);
                            }
                            $Nombreticketnote=$resultnote["Nombre_ticket_noté"];
                        ?>
                        <div class="kpi-value" style="margin-top: 10px;margin-left:10px">
                            <?=$Nombreticketnote?>
                        </div>
                        <div class="rating" style="height:100%">
                            <?php
                                $couleur;
                                if ($Notepourcent<=12) {
                                    $couleur="rgb(255,0,0)";
                                }
                                elseif ($Notepourcent>12 && $Notepourcent<=21) {
                                    $couleur="rgb(255,128,0)";
                                }
                                elseif ($Notepourcent>21 && $Notepourcent<=43) {
                                    $couleur="rgb(255,153,51)";
                                }
                                elseif ($Notepourcent>43 && $Notepourcent<=79) {
                                    $couleur="rgb(255,255,0)";
                                }
                                elseif ($Notepourcent>79 && $Notepourcent<=89) {
                                    $couleur="rgb(128,255,0)";
                                }
                                else{
                                    $couleur="green";
                                }

                            ?>
                            <div class="rating-upper" style="width: <?=$Notepourcent?>%; color: <?=$couleur?>;">
                                <span class="star star-large">★</span>
                                <span class="star star-large">★</span>
                                <span class="star star-large">★</span>
                                <span class="star star-large">★</span>
                                <span class="star star-large">★</span>
                            </div>  
                            <div class="rating-lower">
                                <span class="star star-large">★</span>
                                <span class="star star-large">★</span>
                                <span class="star star-large">★</span>
                                <span class="star star-large">★</span>
                                <span class="star star-large">★</span>
                            </div>
                            <div style="position:relative;text-align:center" >
                                <p style="font-size: xx-large;"><?php
                                    if($Nombreticketnote==0){
                                        echo("Aucun Ticket Noté");
                                    }
                                    else{
                                        echo("NOTE:$averageNoteFormatted/5");
                                    }
                                    ?>
                                    <!-- Ajout du texte ici -->
                                </p> 
                            </div>
                        </div>
                    </div>
                    <div class="row scrollable-div col-sm-5 col-12 col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-3 kpi-card-noteclient"  >
                        <h2 style="text-align: center;" >NOTES CLIENT</h2>
                            <div class="row col-12 m-0 p-0">
                                <div class="col-12 col-md-12" >
                                    <?php
                                        $requetenotenbre = $PDO->prepare('SELECT n.note, COUNT(t.note_ticket) AS nombre_tickets
                                        FROM (
                                            SELECT 1 AS note
                                            UNION SELECT 2
                                            UNION SELECT 3
                                            UNION SELECT 4
                                            UNION SELECT 5
                                        ) n
                                        LEFT JOIN Ticket t ON n.note = t.note_ticket AND t.numtechnicien = ?
                                        GROUP BY n.note
                                        ORDER BY n.note');
                                        $requetenotenbre->execute(array($idtechnicien));
                                        $resultnotenbre = $requetenotenbre->fetchAll(PDO::FETCH_ASSOC);
                                        if ($resultnotenbre && $Nombreticketnote>0) {
                                            foreach ($resultnotenbre as $row) {
                                                if ($row['note'] == 1) { 
                                                    $Nbrenote1 = $row['nombre_tickets'];
                                                    $PourcentageNbrenote1=number_format(($Nbrenote1/$Nombreticketnote),2)*100;
                                                }
                                                elseif ($row['note'] == 2) { 
                                                    $Nbrenote2 = $row['nombre_tickets'];
                                                    $PourcentageNbrenote2=number_format(($Nbrenote2/$Nombreticketnote),2)*100;
                                                }
                                                elseif ($row['note'] == 3) { 
                                                    $Nbrenote3 = $row['nombre_tickets'];
                                                    $PourcentageNbrenote3=number_format(($Nbrenote3/$Nombreticketnote),2)*100;
                                                }
                                                elseif ($row['note'] == 4) { 
                                                    $Nbrenote4 = $row['nombre_tickets'];
                                                    $PourcentageNbrenote4=number_format(($Nbrenote4/$Nombreticketnote),2)*100;
                                                }
                                                else{ 
                                                    $Nbrenote5 = $row['nombre_tickets'];
                                                    $PourcentageNbrenote5=number_format(($Nbrenote5/$Nombreticketnote),2)*100;
                                                }
                                            }
                                        }
                                        else{
                                            $Nbrenote1=0;
                                            $Nbrenote2=0;
                                            $Nbrenote3=0;
                                            $Nbrenote4=0;
                                            $Nbrenote5=0;
                                        }
                                        
                                    ?>
                                    <span class="star checked" style="color:green" >★★★★★</span>
                                    <span class="star checked"><?=$Nbrenote5?></span>
                                </div>
                                <div class="col-12 col-md-12 m-0 p-0 progress">
                                    <div class="progress-bar" style="width:<?=$PourcentageNbrenote5?>%;background-color:green"></div>
                                </div>
                                <div class="col-12 col-md-12" >
                                    <span class="star checked" style="color:rgb(128,255,0)">★★★★</span>
                                    <span class="star checked">★<?=$Nbrenote4?></span>
                                </div>
                                <div class="col-12 col-md-12 m-0 p-0 progress">
                                    <div class="progress-bar" style="width:<?=$PourcentageNbrenote4?>%;background-color:green"></div>
                                </div>     
                                <div class="col-12 col-md-12" >
                                    <span class="star checked" style="color:rgb(255,255,0)" >★★★</span>
                                    <span class="star checked">★★<?=$Nbrenote3?></span>
                                </div>
                                <div class="col-12 col-md-12 m-0 p-0 progress">
                                    <div class="progress-bar" style="width:<?=$PourcentageNbrenote3?>%;background-color:yellow"></div>
                                </div>
                                <div class="col-12 col-md-12" >
                                    <span class="star checked" style="color:rgb(255,153,51)">★★</span>
                                    <span class="star checked">★★★<?=$Nbrenote2?></span>
                                </div>
                                <div class="col-12 col-md-12 m-0 p-0 progress">
                                    <div class="progress-bar" style="width:<?=$PourcentageNbrenote2?>%;background-color:red"></div>
                                </div>
                                <div class="col-12 col-md-12" >
                                    <span class="star checked" style="color:rgb(255,0,0)" >★</span>
                                    <span class="star checked">★★★★<?=$Nbrenote1?></span>
                                </div>
                                <div class="col-12 col-md-12 m-0 p-0 progress">
                                    <div class="progress-bar" style="width:<?=$PourcentageNbrenote1?>%;background-color:red"></div>
                                </div>
                            </div>                   
                        </div>
                    <div class="col-12 kpi-card" style="background-color:antiquewhite">
                    <h3 style="text-decoration: overline orange;">Notes et Observations Client</h3>
                        <div style="border: 2px solid black;" >
                        <?php
                            $requetenoteall = $PDO->prepare('SELECT Ticket.note_ticket as Note,Ticket.observation_client AS Observation_Client,Systeme.clientproprietaire AS Client,Ticket.datecloturation 
                            FROM Ticket inner join Systeme where 
                            Ticket.systemeclient=Systeme.ref_systeme_client AND Ticket.note_ticket 
                            BETWEEN 1 AND 5 AND numtechnicien=? Order By datecloturation');
                            $requetenoteall->execute(array($idtechnicien));
                            $resultnoteall = $requetenoteall->fetchAll(PDO::FETCH_ASSOC);
                            if ($resultnoteall) {
                                foreach ($resultnoteall as $key) {
                                    ?>
                                        <i class="fa-solid fa-building-user fa-xl" style="color: #f17909;"></i><?=$key["Client"]?>
                                    <?php
                                    if ($key["Note"]<=2) {
                                        if ($key["Note"]==1) {
                                            ?>
                                            <span class="star checked" style="float:right">★★★★</span>
                                            <span class="star checked" style="color:rgb(255,0,0);float:right">★</span>
                                            <?php
                                        }
                                        if ($key["Note"]==2) {
                                            ?>
                                            <span class="star checked" style="float:right">★★★</span>
                                            <span class="star checked" style="color:rgb(255,153,51);float:right">★★</span>
                                            <?php
                                        }
                                    }
                                    elseif ($key["Note"]==3) {
                                            ?>
                                            <span class="star checked" style="float:right">★★</span>
                                            <span class="star checked" style="color:rgb(255,255,0);float:right">★★★</span>
                                            <?php
                                    }
                                    else{
                                        $couleurnote="green";
                                        if ($key["Note"]==4) {
                                            ?>
                                            <span class="star checked" style="float:right">★</span>
                                            <span class="star checked" style="color:rgb(128,255,0);float:right">★★★★</span>
                                            <?php
                                        }
                                        if ($key["Note"]==5) {
                                            ?>
                                            <span class="star checked" style="color:green;float:right">★★★★★</span>
                                            <?php
                                        }
                                    }
                                    ?>
                                        <br>  <?=$key['datecloturation']?>
                                        <div style="background-color: bisque;border:1px solid black">
                                            <?=$key['Observation_Client']?>
                                        </div>
                                    <?php
                                }
                            }
                            else{
                                #code...
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
<?php
include_once 'Pied.php';
?>
</body>
</html>