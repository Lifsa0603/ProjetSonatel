<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<?php

    if (!(isset($_POST["Nom"]) && isset($_POST["Prenom"]) && isset($_POST["Mail"]) && isset($_POST["Username"]) && isset($_POST["Password"]))) {
?>
<body>
    <form action="Verification.php" method="POST" >
        <input type="text" placeholder="Votre Nom" name="nom" > <br>
        <input type="text" placeholder="Votre Prenom" name="prenom"> <br>
        <input type="email" placeholder="Votre Mail" name="email"> <br>
        <input type="text" placeholder="Identifiant" name="identifiant"> <br>
        <input type="password" placeholder="Mot de Passe" name="motdepasse"> <br>
        <input type="submit" value="Enregistrer">
    </form>
    <?php
}
?>


</body>
</html>
