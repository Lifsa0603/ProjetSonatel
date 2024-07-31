<?php
require_once 'Fonction/fonction.php';
require_once 'Fonction/supp.php';
suppauto("PdfTemporaire",0);
//require_once('../identification.php');
include_once 'head.php';
?>
<title>Accueil OBS</title>
</head>
<?php
include_once 'Profil.php';
?>
<!-- Contenu -->
<div id="menucontain" class="col-10 row scrollable-divhauteur" style="border:solid black; box-shadow: 0px 1px 10px orange ;flex:1; height:95%; margin-left:60px; border-width:15px;background-repeat: no-repeat;background-size:100% 100%;">
                <div class="container-fluid m-0 p-0 w-100 scrollable-div" style="height: 100%;" >
                    <div class="col-12 row">
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
                        $Verification=isset($_GET["Ticket_status"]);
                        if ($Verification){
                            $msg=htmlspecialchars(($_GET["Ticket_status"]));
                            if ($msg==="Ticket Clôturé") {
                                Message("Ticket Clôturé","success");           
                            }
                            else{
                                Message("Erreur dans la cloture du ticket","danger");
                            }
                        }
                    ?>
                        <!-- Research -->
                        <div class="col-md-4 col-sm-12 scrollable-div">
                                <p>
                                    <strong>Filtrer</strong>
                                </p>
                               <span><a href="#">All</a></span> <br>

                        </div>
                        <!-- Tableau PDF -->
                        <div class="col-md-8 col-sm-12 table-responsive" >
                            <table class="table table-warning table-striped table-hover w-100" >
                                <thead>
                                    <th>Références</th>
                                    <th>Client</th>
                                    <th>Site</th>
                                    <th>Type Maintenance</th>
                                    <th>Date Cloturation</th>
                                    <th>Lien Téléchargement</th>
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
                                        $requeteInfo = $PDO->prepare('SELECT T.urlfichemaintenance,T.ref_ticket,T.etat_ticket,T.typeMaintenance,T.datecloturation,
                                        S.clientproprietaire,S.nomsite_systeme
                                        FROM Ticket AS T INNER JOIN Systeme AS S ON
                                        T.systemeclient=S.ref_systeme_client
                                        WHERE numtechnicien=?
                                        AND urlfichemaintenance IS NOT NULL 
                                        AND datecloturation IS NOT NULL
                                        AND etat_ticket="Validation"
                                        AND note_ticket BETWEEN 1 AND 5
                                        ORDER BY datecloturation DESC');
                                        $requeteInfo->bindParam(1,$_SESSION['id_technicien']);
                                        $requeteInfo->execute();
                                        $resultInfo = $requeteInfo->fetchAll(PDO::FETCH_ASSOC);
                                        foreach ($resultInfo as $key) {
                                            ?>
                                            <!-- <a href="" download="" title="Cliquez pour télécharger"> -->
                                            <tr>
                                            <td><?=$key["ref_ticket"]?></td>
                                            <td><?=$key["clientproprietaire"]?></td>
                                            <td><?=$key["nomsite_systeme"]?></td>
                                            <td><?=$key["typeMaintenance"]?></td>
                                            <td><?=$key["datecloturation"]?></td>
                                            <td>
                                                <a href="<?=$key['urlfichemaintenance']?>" download title="Cliquez pour télécharger">
                                                    <i class="fa-solid fa-file-pdf fa-xl" style="color: #e38a0d;"></i>
                                                </a>
                                            </td>
                                            
                                            <?php
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
<!-- Autre Script -->
<script src="../js/grapheticket.js?v=1.1"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    // Récupérez l'URL actuelle
    var currentURL = window.location.href;


    if (currentURL.includes("Ticket_status")) {
        // Supprimez le paramètre "Ticket_status" de l'URL
        currentURL = currentURL.replace(/([?&])Ticket_status=[^&]+(&|$)/, '$1');
    }

    // Supprimez le point d'interrogation à la fin de l'URL (s'il existe)
    currentURL = currentURL.replace(/\?$/, '');

    // Redirigez vers la nouvelle URL sans les paramètres et le point d'interrogation à la fin
    window.history.replaceState({}, document.title, currentURL);
});

</script>
</body>
</html>
