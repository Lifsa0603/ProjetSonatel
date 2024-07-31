<body>
<div class="d-flex flex-column entete scrollable-div" style="height:90vh;z-index:1">
        <div class="row w-100 entete" style="height:20%; border-bottom: 15px solid #fc8c03;">
            <!-- <div class="col-5 p-0 m-0 h-100">
                <img src="../img/Orange.png" class="h-100" style="width:100%;" alt="Orange">
            </div> -->
            <div class="row coltp-6 col-6 col-sm-6 col-md-5 col-lg-5 col-xl-4 p-0 m-0 h-100">
                <div class="row col-10 m-0 p-0 h-100">
                    <img src="../img/Orange.png" alt="Orange Business Services" style="width: 100%; height: 100%;">
                </div>
                <div class="col-2 m-0 p-0">
                    <div>
                        <i class="fa-solid fa-xmark fa-2xl" id="menuacceuil" style="color: #fc8c03;"></i>
                    </div>
                </div>
                    <!-- <i class="fa-solid fa-xmark fa-xl" id="menuacceuil" style="color: #100b05;"></i> -->
            </div>
            <div class="row coltp-6 col-6 col-sm-6 col-md-7 col-lg-7 col-xl-8 p-0 m-0 h-100" style="background-color:#fc8c03;">
                <div class="col-md-3 col-6 col-sm-3 row h-100">
                    <div class="w-100 h-100 w-100 m-0 p-0">
                        <img src="../img/Technicien2.png" class="h-100 w-100 imgtechnicien">
                    </div>
                </div>
                <div class="row col-md-9 col-6 col-sm-9 m-0 p-0">
                    <div class="col-12 h-50 dropdown d-flex order-2 justify-content-end " style="position: relative;">
                        <a href="#" id="profil" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="rounded-circle me-2 fa-solid fa-user-gear fa-xl " style="color: #080808;"></i>
                                <strong><?=$_SESSION["identifiant"]?></strong>
                                <!-- <img src="../img/Personne.jpg" alt="" width="32" height="32" class="rounded-circle me-2">
                            <strong>nom</strong> -->
                        </a>
                        <ul id="menuprofil" class="dropdown-menu dropdown-menu-dark text-small shadow">
                            <li><a class="dropdown-item" href="#">New project...</a></li>
                            <li><a class="dropdown-item" href="#">Settings</a></li>
                            <li><a class="dropdown-item" href="#">Profile</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="../Logout.php">Déconnexion</a></li>
                        </ul>
                    </div>
                    <div class="col-12 order-1">
                        <span>Daalàal AKH JAàM <?="$prenom $nom"?></span>
                    </div>
                </div>
            </div>
        </div>
        <!-- Entete -->
        <div class="row contenu" style="height:80%; width:100%;z-index:1;" >
            <?php
            if ($_SESSION['categorie_user']=="Technicien") {
                include_once 'menu.php';
            }
            else{
                include_once 'Menuadmin.php';
            }  
            ?>

            
