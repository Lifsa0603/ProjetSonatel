<?php
//require_once('../identification.php');
include_once 'head.php';
?>
<title>Ticket OBS</title>
<link rel="stylesheet" href="../css/Ticket.css">
<!-- Autres Lien Css dans le head -->
</head>
<?php
include_once 'Profil.php';
?>
<!-- Contenu -->
<div class="col-10 row scrollable-div"style="border:solid black; box-shadow: 0px 1px 10px orange ;flex:1; height:95%; margin-left:60px; border-width:15px;background-repeat: no-repeat;background-size:100% 100%;">
                <div class="container-fluid m-0 p-0 w-100 scrollable-div" style="height: 100%;" >
                    <div class="col-12 row">
                        <div class="col-md-4 col-sm-12 scrollable-div" style="z-index: -1;">
                                <p style="text-decoration:underline">
                                    <strong>Légendes</strong>
                                </p>
                                <table class="w-100 table table-dark table-striped table-hover contenttable" >
                                    <tr>
                                        <td>Succès</td>
                                        <td class="colonnecouleur">         
                                            <div class="rond" id="vert" style="background-color:#14F023;position:relative"></div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Traitement en Cours</td>
                                        <td class="colonnecouleur">
                                            <div class="rond" id="rouge" style="background-color:#F90A12;position:relative"></div>   
                                        </td>
                                    </tr>
                                </table>
                        </div>
                        <div class="col-md-8 col-sm-12 table-responsive" >
                            <table class="table table-warning table-striped table-hover w-100" >
                                <thead>
                                    <th>Références</th>
                                    <th>Client</th>
                                    <th>Site</th>
                                    <th>Type Maintenance</th>
                                    <th>Date Creation</th>
                                    <th>Etat Ticket</th>
                                </thead>
                                <?php
                                 function couleurcolonne($couleur,$id){
                                    echo("<td class='colonnecouleur'>
                                            <i class='fa-solid fa-circle fa-xl' id='$id' style='color: $couleur;'></i>
                                        </td>");
                                 }
                                ?>
                                    <?php
                                        /*pagination(2,2,'Ticket.php','SELECT * FROM ticket');*/
                                        $requeteInfo = $PDO->prepare('SELECT T.ref_ticket,T.etat_ticket,T.typeMaintenance,T.dateCreation,
                                        S.clientproprietaire,S.nomsite_systeme
                                        FROM Ticket AS T INNER JOIN Systeme AS S ON
                                        T.systemeclient=S.ref_systeme_client
                                        WHERE numtechnicien=? ORDER BY dateCreation DESC');
                                        $requeteInfo->bindParam(1,$_SESSION['id_technicien']);
                                        $requeteInfo->execute();
                                        $resultInfo = $requeteInfo->fetchAll(PDO::FETCH_ASSOC);
                                        foreach ($resultInfo as $key) {
                                            ?>
                                            <tr>
                                            <td><?=$key["ref_ticket"]?></td>
                                            <td><?=$key["clientproprietaire"]?></td>
                                            <td><?=$key["nomsite_systeme"]?></td>
                                            <td><?=$key["typeMaintenance"]?></td>
                                            <td><?=$key["dateCreation"]?></td>
                                            
                                            <?php
                                                if ($key["etat_ticket"]==="Validation") {
                                                    couleurcolonne("#14F023","vert");
                                                }
                                                elseif ($key["etat_ticket"]==="Traitement En Cours") {
                                                    couleurcolonne("#F90A12",'rouge');
                                                }
                                                echo("</tr>");
                                            }
                                    ?>   
                            </table>
                            
                        </div>
                    </div>
                </div> 
            </div>
<?php
include_once 'Pied.php';
?>
</body>
</html>