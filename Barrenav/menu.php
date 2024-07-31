<div class="navigation col-2 mt-2" id="barrenav" style="width:40%;overflow:hidden; z-index:3;" >
                <ul>
                    <li class="list">
                        <a href="Accueil.php" id="Accueil">
                            <span class="icon">
                                <i class="fa-solid fa-house-user fa-xl" style="color: #f28507;"></i>
                            </span>
                            <span class="title">
                                Home
                            </span>
                        </a>
                    </li>
                    <li class="list">
                        <a href="Ticket.php" id="ticket" >
                            <span class="icon">
                                <i class="fa-solid fa-ticket fa-xl" style="color: #f67c09;"></i>
                                <?php
                                    $requete = $PDO -> prepare('SELECT count(*) AS "Nombre ticket en attente" FROM Ticket WHERE LOWER(etat_ticket)=Lower("Traitement En Cours") AND numtechnicien=?');
                                    $requete->bindParam(1,$_SESSION['id_technicien']);
                                    $requete->execute();
                                    $check_result = $requete -> fetch(PDO::FETCH_ASSOC);
                                    if ($check_result["Nombre ticket en attente"]>0) { 
                                ?>
                                <span class="badge rounded-pill badge-notification bg-danger" id="ticketnotif" ><?=$check_result["Nombre ticket en attente"]?></span>
                                <?php
                                    }
                                    else {
                                ?>
                                <span class="badge rounded-pill badge-notification bg-success" id="ticketnotif">0</span>
                                <?php
                                    }
                                ?>
                            </span>
                            <span class="title">
                                Tickets
                            </span>
                        </a>
                    </li>
                    <li class="list">
                        <a href="Notes.php" id="Notes">
                            <span class="icon">
                                <i class="fa-solid fa-user-pen fa-xl" style="color: #f59105;"></i>
                            </span>
                            <span class="title">
                                Notes & Observations
                            </span>
                        </a>
                    </li>
                    <li class="listmaintenance " id="backgroundmaintenance">
                        <a href="#" id="maintenanceli">
                            <span class="icon">
                                <i class="fa-solid fa-folder-closed fa-xl" style="color: #ec7d22;"></i>
                            </span>
                            <span class="title">
                                Fiche Maintenance <span ><i class="fa-solid fa-caret-down fa-xl" style="color: #ec7d22;"></i></span>
                            </span>
                        </a>
                        <ul style="display:none;" id="menumaintenance" >
                            <li class="sousmenumaintenance">
                                <a href="Ajoutfiche.php" id="Ajouter" >
                                    <span class="icon">
                                        <i class="fa-solid fa-folder-plus fa-xl" style="color: #ec7d22;"></i>                                    </span >
                                    <span class="title" >
                                        Clôturer Ticket
                                    </span>
                                </a>
                            </li>
                            <li class="sousmenumaintenance">
                                <a href="Historique.php" id="Historique" >
                                    <span class="icon" >
                                        <i class="fa-solid fa-file-circle-check fa-xl" style="color: #ec7d22;"></i>                                    </span >
                                    <span class="title" id="historiquetitle">
                                        Historique
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- <i class="fa-regular fa-plus fa-xl" style="color: #e6950a;"></i> -->
                    <hr style="color: gray;" >
                    <li class="list">
                        <a href="../Logout.php" style="position: absolute; bottom:0;" id="Deconnexion" >
                            <span class="icon">
                                <i class="fa-solid fa-power-off fa-xl" style="color: #f07c0f;"></i>                            </span>
                            <span class="title">
                                Déconnexion
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- Navbar et Entête déja fait -->