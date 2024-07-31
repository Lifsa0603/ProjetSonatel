<?php
//require_once('../identification.php');
include_once 'head.php';
$id_user=$_GET['id'];
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
                <div class="container mt-5">
                    <div class="row">
                        <div class="col-lg-4 pb-5">
                            <div class="author-card pb-3">
                                <div class="author-card-profile row" style="border:2px solid green">
                                    <div class="author-card-avatar col-6"><img src="../img/Technicien2.png" alt="Daniel Adams">
                                     </div>
                                    <div class="author-card-details">
                                        <?php
                                        $requeteverification=$PDO->prepare('SELECT * FROM Utilisateur WHERE id_technicien=?');	
                                        $requeteverification->execute([$id_user]);
                                        $verificationrequete = $requeteverification -> fetch(PDO::FETCH_ASSOC);
                                        if ($verificationrequete) {
                                            #...
                                        }
                                        else{
                                            header("Location:Technicien.php");
                                            exit();
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8 pb-5">
                            <form action="" class="row" >
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="account-fn">Prénom</label>
                                        <input class="form-control" type="text" id="account-fn" value="<?=$verificationrequete['prenom']?>" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="account-ln">Nom</label>
                                        <input class="form-control" type="text" id="account-ln" value="<?=$verificationrequete['nom']?>" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="account-email">E-mail Address</label>
                                        <input class="form-control" type="email" id="account-email" value="<?=$verificationrequete['email']?>" >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="account-phone">Phone Number</label>
                                        <input class="form-control" type="text" id="account-phone" value="<?=$verificationrequete['telephone']?>" required>
                                    </div>
                                </div>
                                <!-- <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="account-pass">New Password</label>
                                        <input class="form-control" type="password" id="account-pass">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="account-confirm-pass">Confirm Password</label>
                                        <input class="form-control" type="password" id="account-confirm-pass">
                                    </div>
                                </div> -->
                                <div class="col-12">
                                    <hr class="mt-2 mb-3">
                                    <div class="d-flex flex-wrap justify-content-between align-items-center">
                                        <a onclick='return confirm("Etes-vous sur?")'
                                            href="Delete.php?id=<?php echo $utilisateur['id_technicien'] ?>">
                                            <button class="btn btn-style-1 btn-primary" type="button" data-toast data-toast-position="topRight" data-toast-type="success" data-toast-icon="fe-icon-check-circle" data-toast-title="Success!" data-toast-message="Your profile updated successfuly.">Update Profile</button>
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.1/dist/js/bootstrap.bundle.min.js"></script>
                <script type="text/javascript">
                </script>
            </div>
<?php
include_once 'Pied.php';
?>
<script>
/*document.addEventListener("DOMContentLoaded", function() {
    // Récupérez l'URL actuelle
    var currentURL = window.location.href;


    if (currentURL.includes("Message_status")) {
        // Supprimez le paramètre "Message_status" de l'URL
        currentURL = currentURL.replace(/([?&])Message_status=[^&]+(&|$)/, '$1');
    }

    // Supprimez le point d'interrogation à la fin de l'URL (s'il existe)
    currentURL = currentURL.replace(/\?$/, '');

    // Redirigez vers la nouvelle URL sans les paramètres et le point d'interrogation à la fin
    window.history.replaceState({}, document.title, currentURL);
});*/



</script>
<!-- Autre Script -->
</body>
</html>
