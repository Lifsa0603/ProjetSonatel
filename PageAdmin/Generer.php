<?php
//require_once('../identification.php');
include 'head.php';
?>
<link rel="stylesheet" href="../css/Ajoutech.css">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">	
    <link rel="stylesheet" type="text/css" href="../css/monstyle.css?v=1.1">		
    <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Inclure Select2 pour l'interface utilisateur améliorée -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/js/select2.min.js"></script>
    <title>Ajout Ticket</title>
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
                           Ajout Ticket
                        </div>
				        <div class="panel-body">
                            <form class="form" action="Newticket.php" method="POST">
                                <!-- Début Ligne 1 -->
                                <div class="row my-row">
                                    <!-- Debut 1.1 -->
                                    <div class="col-sm-6" >
                                        <label for="reference" class="control-label col-sm-4"><span style="word-break:break-all">N°Référence<span style="color:red">*</span></span></label>
                                        <div class="row m-0 p-0 col-sm-8">
                                                <div class="col-sm-12" >
                                                    <input type="text" autocomplete="off" required style="position: absolute;left:-10px" name="reference" id="reference" class="form-control">
                                                </div> <br><br>
                                                <strong>
                                                    <div style="display: none;" id="display_ref" class="col-sm-12 m-0 p-0"></div>
                                                </strong>
                                        </div>
                                    </div>
                                    <!-- Fin 1.1 -->
                                    <div class="col-sm-6">
                                        <label for="Nomclient" class="control-label col-sm-4" ><span style="color:red">*</span>Nom Client</label>
                                        <div class="row m-0 p-0 col-sm-8">
                                                <div class="col-sm-12" >
                                                    <!-- Select -->
                                                    <select id="Nomclient" name="Nomclient" style="width:100%;height:37px;border-radius:7px" class="Nomclient" style="overflow-x: hidden;" required class="form-control">
                                                        <option value="" hidden></option>
                                                        <?php
                                                        $requete = $PDO->prepare('SELECT * FROM Client');
                                                        $requete->execute();
                                                        $check_result = $requete->fetchAll(PDO::FETCH_ASSOC);

                                                        if ($check_result) {
                                                            $clients = [];
                                                            foreach ($check_result as $key) {
                                                                $firstLetter = strtoupper($key['nom'][0]); // Obtenir la première lettre en majuscule
                                                                $clients[$firstLetter][] = '<option value="' . $key['nom'] . '">' . $key['nom'] . '-' . $key['sigle'] . '</option>';
                                                            }

                                                            // Trier les groupes par ordre alphabétique
                                                            ksort($clients);

                                                            foreach ($clients as $group => $options) {
                                                                echo '<optgroup label="' . $group . '">' . implode('', $options) . '</optgroup>';
                                                            }
                                                        } else {
                                                            echo("<option value=\"\" disabled> No Result Found</option>");
                                                        }
                                                        ?>
                                                    </select>
                                                    
                                                    <!-- Fin Select -->
                                                </div>
                                                <br> <br> 
                                                <strong>
                                                    <div style="display: none;" id="display_client" class="col-sm-12 m-0 p-0">
                                                         
                                                    </div>
                                                </strong>
                                        </div>
                                    </div>
                                </div> 
                                <!--  Fin Ligne 1-->



                                <!-- Début Ligne 2 -->
                                <div class="row my-row">
                                    <div class="col-sm-6">
                                        <label for="Technicien" class="control-label col-sm-4" ><span style="color:red">*</span>Technicien Affecté</label>
                                        <div class="row m-0 p-0 col-sm-8">
                                            <div class="col-sm-12" >
                                                <!-- Select -->
                                                
                                                <select id="Technicien" name="Technicien" style="width:100%;height:37px;border-radius:7px" class="Technicien" style="overflow-x: hidden;" required class="form-control">
                                                    <option value="" hidden></option>
                                                    <?php
                                                        $requete = $PDO -> prepare('SELECT * FROM Utilisateur WHERE LOWER(categorie_user)=LOWER(?)');
                                                        $requete->execute(["Technicien"]);
                                                        $check_result = $requete -> fetchAll(PDO::FETCH_ASSOC);
                                                        if ($check_result) {
                                                            $technicien = [];
                                                            foreach ($check_result as $key) {
                                                                $firstLetter = strtoupper($key['nom'][0]); // Obtenir la première lettre en majuscule
                                                                $technicien[$firstLetter][] = '<option value="' . $key['identifiant'] . '">' . $key['nom'] . ' ' . $key['prenom'] .'('.$key['identifiant'].')'. '</option>';
                                                            }

                                                            // Trier les groupes par ordre alphabétique
                                                            ksort($technicien);

                                                            foreach ($technicien as $group => $options) {
                                                                echo '<optgroup label="' . $group . '">' . implode('', $options) . '</optgroup>';
                                                            }
                                                        }
                                                    ?>
                                                </select>
                                                
                                                <!-- Fin Select -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="Systeme" class="control-label col-sm-4" ><span style="color:red"> *</span>Systeme</span></label>
                                        <div class="row m-0 p-0 col-sm-8">
                                            <div class="col-sm-12" >
                                                <!-- Select -->
                                                <select id="Systeme" name="Systeme" class="Systeme" style="width:100%;height:37px;border-radius:7px" required class="form-control">
                                                    <option value="" hidden></option>
                                                   
                                                </select>
                                                <!-- Fin Select -->
                                            </div>
                                        </div>
                                    </div>
                                </div>                            
                                <!-- Fin Ligne 2 -->


                                <!--  Début Ligne 3-->

                                
                                <div class="row my-row">
                                   <div class="col-sm-6" >
                                   <label for="Maintenance" class="control-label col-sm-4" ><span style="color:red">* </span>Type Maintenance</label>
                                        <div class="row m-0 p-0 col-sm-8">
                                            <div class="col-sm-12" >
                                                <!-- Select -->
                                                <select id="Maintenance" placeholder="Type Maintenance" name="Maintenance" class="Maintenance" style="width:100%;height:37px;border-radius:7px" required class="form-control">
                                                    <option value="" hidden></option>
                                                    <option value="Préventive">Préventive</option>
                                                    <option value="Curative">Curative</option>
                                                </select>
                                                <!-- Fin Select -->
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="col-sm-6" >
                                        <label for="Siteclient" class="control-label col-sm-4" ><span style="color:red"> *</span>Siteclient</label>
                                        <div class="row m-0 p-0 col-sm-8">
                                            <div class="col-sm-12" >
                                                <!-- Select -->
                                                <select id="Siteclient" name="Siteclient" class="Siteclient" style="width:100%;height:37px;border-radius:7px" required class="form-control">
                                                    <option value="" hidden></option>
                                                </select>
                                                <!-- Fin Select -->
                                            </div>
                                        </div>
                                    </div>
                                </div>                                
                                <!-- Fin Ligne 3 -->

                             <!-- Début Ligne 4 -->
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
<script>    
</script>
<!-- Autre Script -->
<script src="../js/Addtick.js?v=1.1"></script>
</body>
</html>