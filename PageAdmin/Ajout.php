<?php
//require_once('../identification.php');
include 'head.php';
?>
<head>
<link rel="stylesheet" href="../css/Ajoutech.css">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">	
    <link rel="stylesheet" type="text/css" href="../css/monStyle.css">		
    <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
    <script src="../js/jquery-1.10.2.js"></script>
    <title>Ajout Utilisateur</title>
<!-- Autres Lien Css dans le head -->
</head>

<?php
 include_once 'Profil.php';	
?>
<!-- Contenu -->
        <div class="col-10 row scrollable-div p-0" style="border:solid black; box-shadow: 0px 1px 10px orange ;flex:1; height:95%; margin-left:60px; border-width:15px;background-repeat: no-repeat;background-size:100% 100%;">
            <div class="row col-12 p-0 m-0 dashboard">
                <!--  -->
                <div class="container col-md-6 col-md-offset-3">
                    <div style="background-color: gray;" class="panel panel-success">
				        <div class="panel-heading">
                           Ajout Utilisateur Champs Obigatoire(<span style="color:red">*</span>)
                        </div>
				        <div class="panel-body">
                            <form class="form" action="Newtech.php" method="POST">
                                <!-- Début Ligne 1 -->
                                <div class="row my-row">
                                    <div class="col-sm-6" >
                                        <label for="Prénom" class="control-label col-sm-4"><span style="color:red">*</span>Prénom</label>
                                        <div class="row m-0 p-0 col-sm-8">
                                                <div class="col-sm-12" >
                                                    <input type="text" autocomplete="off" required style="position: absolute;left:-10px" name="prénom" id="prénom" class="form-control">
                                                </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6" >
                                        <label for="nom" class="control-label col-sm-4"><span style="color:red">*</span>Nom</label>
                                        <div class="row m-0 p-0 col-sm-8">
                                                <div class="col-sm-12" >
                                                    <input type="text" autocomplete="off" required style="position: absolute;left:-10px" name="nom" id="nom" class="form-control">
                                                </div>
                                        </div>
                                    </div>
                                </div> 
                                <!--  Fin Ligne 1-->



                                <!-- Début Ligne 2 -->
                                <div class="row my-row">
                                    <div class="col-sm-6" >
                                        <label for="email" class="control-label col-sm-4"><span style="color:red">*</span>Email</label>
                                        <div class="row m-0 p-0 col-sm-8">
                                                <div class="col-sm-12" >
                                                    <input type="email" autocomplete="off" required style="position: absolute;left:-10px" name="email" id="email" class="form-control">
                                                </div>
                                        </div>
                                        <strong>
                                            <div style="display: none;" id="display_email" class="col-sm-12 mt-3"></div>
                                        </strong>
                                    </div>
                                    
                                    <div class="col-sm-6" >
                                    <?php if(isset($_SESSION['user']) && $_SESSION['categorie_user']=="Admin") {?> 
                                                <label for="role" class="control-label col-sm-4">Role</label>
                                        <div class="row m-0 p-0 col-sm-8">
                                            <div class="col-sm-12" >
                                                <select name="role" id="role" class="form-control" style="position: absolute;left:-10px">
                                                    <option>Technicien</option>
                                                    <option>Admin</option>
                                                </select>
                                            </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>                            
                                <!-- Fin Ligne 2 -->


                                <!--  Début Ligne 3-->

                                
                                <div class="row my-row">
                                    <div class="col-sm-6" >
                                        <label for="login" class="control-label col-sm-4"><span style="color:red">*</span>Login</label>
                                        <div class="row m-0 p-0 col-sm-8">
                                                <div class="col-sm-12" >
                                                    <input type="text" autocomplete="off" required style="position: absolute;left:-10px" name="login" id="login" class="form-control">
                                                </div>
                                        </div>
                                        <strong>
                                            <div style="display: none;" id="display_login" class="col-sm-12 mt-3"></div>
                                        </strong>
                                    </div>
                                    <div class="col-sm-6" >
                                        <label for="nom" class="control-label col-sm-4"><span style="color:red">*</span>Password</label>
                                        <div class="row m-0 p-0 col-sm-8">
                                            <div class="col-sm-12" >
                                                <input type="password" autocomplete="off" required style="position: absolute;left:-10px" name="pwd" id="pwd" class="form-control">
                                                <span class="fa fa-eye-slash fa-2x oeil" style="position: absolute;top:2px" id="oeil"></span> 
                                            </div>
                                        </div>
                                    </div>
                                </div>                                
                                <!-- Fin Ligne 3 -->

                             <!-- Début Ligne 4 -->
                                <div class="row my-row">
                                    <div class="col-sm-6" >
                                        <label for="téléphone" class="control-label col-sm-4">Téléphone</label>
                                        <div class="row m-0 p-0 col-sm-8">
                                                <div class="col-sm-12" >
                                                    <input type="number" autocomplete="off" style="position: absolute;left:-10px" name="téléphone" id="téléphone" class="form-control">
                                                </div>
                                        </div>
                                    </div>
                                </div> 
                                <!--   Fin Ligne 4 -->
                                <br> 
                                <div class="col-sm-12 d-flex justify-content-center">
                                    <input  type="submit" id="Enregistrer" value="Enregistrer" disabled class="btn btn-success">
                                </div>
                            </form>
				        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Fin Div -->
<?php
include_once 'Pied.php';

?>
<!-- Autre Script -->
<script src="../js/Addtechnicien.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
    // Récupérez l'URL actuelle
    var currentURL = window.location.href;
    if (currentURL.includes("Ajout")) {
        currentURL = currentURL.replace(/Ajout.*/, 'Ajout');
    }
                // Utilisez une expression régulière pour supprimer tout ce qui suit "technicien.php" 
    // Mettez à jour l'URL dans la barre d'adresse du navigateur
    window.history.replaceState(null, null, currentURL);
});
</script>
</body>
</html>