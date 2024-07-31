<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" /> -->
    <title>Orange Business Services</title>
    <link rel="stylesheet" href="css/login.css?v=1.1">
    <!-- le (?v=1.1) permet de charger les fichiers css qui ont été mise a jour dans un délai court -->
    <link rel="shortcut icon" href="ico/Orange.ico?v=1.1" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="container-fluid p-0 m-0">
    <!-- Corps -->
    <div class="row w-100 p-0 m-0" style="height: 90vh;">
        <div class="col-12 col-lg-5 h-100 p-0 d-lg-flex d-none">
            <img src="" id="defilageimg" alt="img">
        </div>

        <div id="formulaire2" class="col-12 col-lg-7 h-100 p-0">
            <span class="d-block p-0 h-25 text-white">
                <img src="img/Orange.png" alt="Orange" class="h-10">
                <?php
                $Verification=isset($_GET["login_status"]);
                if ($Verification){
                    $msg=htmlspecialchars(($_GET["login_status"]));
                    if($msg=='False'){
                        ?>
                        <div class="alert alert alert-dismissible fade show " id="bannieredis">
                    <button type="button" class="btn-close btn-lg " data-bs-dismiss="alert"></button>
                    <span class="badge bg-danger h-100 w-50">
                        Identifiant <br> ou <br> Mot de Passe <br> Incorrect
                    </span>
                    </div>
                  <?php
                    }           
                }
                ?>
            <span class="d-block text-white w-100 px-5 py-5" style="height: 480px;">
                <div id="my-row" class="row h-100 py-5 px-5">
                    <div class="d-inline px-3 py-3 text-white">
                        <form id="vraiformulaire" action="Connexion.php" method="POST" class="formulaire">
                            <!-- Le reste du formulaire -->
                            <div class="input-group mb-3">
                                <span class="input-group-text">
                                    <img class="login" src="img/Personne.jpg" style="background-size: cover;" alt="Identifiant">
                                </span>
                                <input type="text" class="form-control" placeholder="Username" id="username" onkeyup="checkform()" name="username">
                            </div>
                        
                            <div class="input-group mb-3">
                                <span class="input-group-text">
                                    <img class="login" src="img/cadenas.png" alt="">
                                </span>
                                <input type="password" onkeyup='checkform()' class="form-control" placeholder="Password" name="Password" id="Password">
                                <span class="input-group-text p-0">
                                    <button type="button" id="buttonsee" class="border-0 bg-light p-0 m-0 w-100" onclick="motdepasse()"><img src="img/Hide_eye.png" style="width: 35px;height:35px ;" alt="" id="hideorsee" class="hideorsee p-0 m-0 w-100"></button>
                                </span>
                            </div>
                            <div class="row" id="validation">
                                <div class="col-6 w-50 btn-box">
                                    <input type="submit" class="form-control" name="Submit" value="Se Connecter" id="envoyer" disabled>
                                </div>
                                <div class="col-6">
                                    <a style="color: rgb(244, 76, 14);
                                            font-size:15px;" href="maintenance/maintenance.php" class="px-3 ">Mot de Passe Oublié?
                                    </a>
                                </div>
                            </div>   
                        </form>
                    </div>
                </div>
            </span>
        </div>
    </div>
    <footer style="height: 10vh;" class="p-0 m-0">
        <!-- PIED -->
        <div class="mobile-container h-100 p-0 d-flex justify-content-around flex-wrap flex-column flex-md-row py-3 py-md-0 bg-dark">
            <a class="text-white mb-2 mb-lg-0 mb-md-3" target="_blank" href="https://www.orangebusiness.sn/">
                <span style="font-size: 20px;">© Orange Business Services 2023</span>
            </a>
            <a class="text-white mb-2 mb-lg-0 mb-md-3" target="_blank" href="https://sonatel.sn/" target="_blank">
                <span style="font-size: 20px;">Sonatel</span>
            </a>
        </div>
    </footer>
    <script src="js/Login.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
    // Récupérez l'URL actuelle
    var currentURL = window.location.href;

    // Vérifiez si l'URL contient le paramètre "Delete_status"
    if (currentURL.includes("login_status")) {
        // Supprimez le paramètre "Delete_status" de l'URL
        currentURL = currentURL.replace(/([?&])login_status=[^&]+(&|$)/, '$1');
    }
    // Supprimez le point d'interrogation à la fin de l'URL (s'il existe)
    currentURL = currentURL.replace(/\?$/, '');
    if (currentURL.includes("Login")) {
        currentURL = currentURL.replace(/Login.*/, '');
    }
    // Redirigez vers la nouvelle URL sans les paramètres et le point d'interrogation à la fin
    window.history.replaceState({}, document.title, currentURL);
});
    </script>
</body>
</html>
