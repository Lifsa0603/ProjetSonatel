<?php
//require_once('../identification.php');
include_once 'head.php';
?>
<title>Techniciens</title>
<!-- Autres Lien Css dans le head -->
</head>

<?php

$requete = $PDO->prepare('SELECT * FROM Utilisateur WHERE LOWER(categorie_user)=LOWER(?)');
$requete->execute(array('Technicien'));
$les_utilisateurs = $requete->fetchAll(PDO::FETCH_ASSOC);
include_once 'Profil.php';
$requete = $PDO->prepare('SELECT * FROM Utilisateur WHERE LOWER(categorie_user)=LOWER(?)');
$requete->execute(array('Technicien'));
$les_utilisateurs = $requete->fetchAll(PDO::FETCH_ASSOC);
?>
<!-- Contenu -->
<div class="col-10 row scrollable-div p-0"
    style="border:solid black; box-shadow: 0px 1px 10px orange ;flex:1; height:95%; margin-left:60px; border-width:15px;background-repeat: no-repeat;background-size:100% 100%;">
    <div class="row col-12 p-0 m-0 dashboard">

        <?php
        function Message($msg, $bg)
        {
            $alerte = "alert alert-$bg alert-dismissible fade-show";
            ?>
        <div class="<?php echo $alerte ?> col-12" style="height: min-content;">
            <?php
            echo $msg;
            ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php
    }
    $Verification = isset($_GET["Message_status"]);
    $Delete = isset($_GET["Delete_status"]);
    if ($Verification) {
        $msg = htmlspecialchars(($_GET["Message_status"]));
        if ($msg === "Utilisateur Ajouté avec Succès") {
            Message("Utilisateur Ajouté avec Succès", "success");
        } else {
            Message("Erreur Dans L'enregistrement", "danger");
        }
    }
    if ($Delete) {
        $msg = htmlspecialchars(($_GET["Delete_status"]));
        if ($msg === "Utilisateur Supprimé avec succès") {
            Message("Utilisateur Supprimé avec succès", "success");
        } else {
            Message("Erreur dans la Suppression", "danger");
        }
    }
    ?>
        <!--  -->
        <div class="container col-12">
            <div class="panel panel-primary">
                <div class="panel-heading" style="text-align: center;">Liste des utilisateurs</div>
                <div class="panel-body">
                    <a href="#" id="Filtrer">Filtrer</a>
                    <div class="row col-12" id="div_filtrer"
                        style="display: <?php echo isset($_GET["Prénom"]) || isset($_GET["Nom"]) ? 'flex' : 'none'; ?>;">
                        <!-- Formulaire HTML -->
                        <form method="get" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="col-sm-12">
                            <div class="row barre_recherche" style="background-color: burlywood;" >
                                <!-- Début 1ère Ligne -->
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="Prénom">Prénom</label>
                                        <input type="search" class="form-control" placeholder="Prénom" name="Prénom"
                                            value="<?php echo isset($_GET["Prénom"]) ? htmlspecialchars($_GET["Prénom"]) : ''; ?>">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="Nom">Nom</label>
                                        <input type="search" class="form-control" placeholder="Nom" name="Nom"
                                            value="<?php echo isset($_GET["Nom"]) ? htmlspecialchars($_GET["Nom"]) : ''; ?>">
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
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <input type="submit" value="Rechercher" class="btn" style="background-color:#f67c09;position:relative;" >
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <table class="table table-striped table-bordered table-warning">
                        <thead>
                            <th>ID</th>
                            <th>Prenom</th>
                            <th>Nom</th>
                            <th>Role</th>
                            <th>Identifiant</th>
                            <th>Email</th>
                            <?php if ($_SESSION['categorie_user'] == "Admin") { ?>
                            <th>ACTIONS</th
                            <?php } ?>
                            >
                        </thead>
                        <?php
                            if ($_SERVER["REQUEST_METHOD"] === "GET") {
                                // Récupération des valeurs provenant de la requête GET (si elles existent)
                                $nomrecherche = isset($_GET["Nom"]) ? htmlspecialchars($_GET["Nom"]) : "";
                                $prenomrecherche = isset($_GET["Prénom"]) ? htmlspecialchars($_GET["Prénom"]) : "";
                                $identifiantrecherche=isset($_GET["identifiant"]) ? htmlspecialchars($_GET["identifiant"]) : "";
                                $emailrecherche=isset($_GET["email"]) ? htmlspecialchars($_GET["email"]) : "";
                            }
                            $ligne_requete = "SELECT * FROM Utilisateur WHERE";
                            if (!empty($_GET['Prénom'])) {
                                $ligne_requete .= " prenom LIKE '%$prenomrecherche%' AND";
                            }
                            if (!empty($_GET['Nom'])) {
                                $ligne_requete .= " nom LIKE '%$nomrecherche%' AND";
                            }
                            if (!empty($_GET['identifiant'])) {
                                $ligne_requete .= " identifiant LIKE '%$identifiantrecherche%' AND";
                            }
                            if (!empty($_GET['email'])) {
                                $ligne_requete .= " email LIKE '$emailrecherche' AND";
                            }
                            $ligne_requete .= " categorie_user='Technicien'";
                            $requete = $PDO->prepare($ligne_requete);
                            $requete->execute();
                            $les_utilisateurs = $requete->fetchAll(PDO::FETCH_ASSOC);
                            if ($les_utilisateurs) {
                                foreach ($les_utilisateurs as $utilisateur) { ?>
                        <tr>
                            <td><?php echo $utilisateur['id_technicien'] ?></td>
                            <td><?php echo $utilisateur['prenom'] ?></td>
                            <td><?php echo $utilisateur['nom'] ?></td>
                            <td><?php echo $utilisateur['categorie_user'] ?></td>
                            <td><?php echo $utilisateur['identifiant'] ?></td>
                            <td><?php echo $utilisateur['email'] ?></td>
                            <td>
                                <a href="Edit.php?id=<?php echo $utilisateur['id_technicien'] ?>">
                                    <span class="fa fa-edit"></span>
                                </a>
                                &nbsp;&nbsp;
                                <a onclick='return confirm("Etes-vous sur?")'
                                    href="Delete.php?id=<?php echo $utilisateur['id_technicien'] ?>">
                                    <span class="fa fa-trash"></span>
                                </a>
                            </td>
                        </tr>
                        <?php }
                            } else {
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
        document.addEventListener("DOMContentLoaded", function() {
            var currentURL = window.location.href;
                        // Utilisez une expression régulière pour supprimer tout ce qui suit "technicien.php"
            currentURL = currentURL.replace(/Technicien\.php.*/, 'Technicien');

            // Mettez à jour l'URL dans la barre d'adresse du navigateur
            window.history.replaceState(null, null, currentURL);

            // Ajoutez une variable pour suivre l'état d'affichage de la div de filtrage
            var isDivVisible = <?php echo isset($_GET["Prénom"]) || isset($_GET["Nom"]) ? 'true' : 'false'; ?>;

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
