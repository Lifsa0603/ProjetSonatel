<?php
    require 'Basedonnee/Tool.php';
    require 'Basedonnee/session.php';
    init_session();
    if (isset($_POST['username']) && isset($_POST['Password'])) //Vérification de l'existence des variables issues du formulaire
    {   
        $username = htmlspecialchars($_POST['username']);
        $username=strtolower($username);
        $password = htmlspecialchars($_POST['Password']);
        $password = hash('sha256', $password);
        $requete = $PDO -> prepare('SELECT * FROM Utilisateur WHERE (LOWER(email) = LOWER(?) OR LOWER(identifiant)=LOWER(?) ) AND motdepasse=?');
        $requete->bindParam(1,$username);
        $requete->bindParam(2,$username);
        $requete->bindParam(3,$password);
        $requete->execute();
        $check_result = $requete -> fetchAll(PDO::FETCH_ASSOC);
        if($check_result){
            $_SESSION['user']=$check_result;
            foreach ($check_result as $key) {
                $_SESSION['prenom']=$key["prenom"];
                $_SESSION['nom']=$key["nom"];
                $_SESSION['email']=$key["email"];
                $_SESSION['identifiant']=$key["identifiant"];
                $_SESSION['telephone']=$key["telephone"];
                $_SESSION['id_technicien']=$key["id_technicien"];
                $_SESSION['directory_technicien']=$key["directory_technicien"];
                $_SESSION['categorie_user']=$key['categorie_user'];
                if ($_SESSION['categorie_user']=="Admin") {
                    header("Location:PageAdmin/Accueiladmin.php"); 
                }
                else{
                    header("Location:Barrenav/Accueil.php"); 
                }
                
            }  
        } 
        else{
            header(("Location:Login.php?login_status=False"));
        }
    }
?>