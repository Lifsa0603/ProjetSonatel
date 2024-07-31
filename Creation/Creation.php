<?php
require_once '../Basedonnee/Tool.php';
require_once '../Basedonnee/session.php';
init_session();
$prenom=$_SESSION['prenom'];
$nom=$_SESSION['nom'];
$email=$_SESSION['email'];
$identifiant=$_SESSION['identifiant'];
$telephone=$_SESSION['telephone'];
$requete = $PDO -> prepare('SELECT * FROM Client');
$requete->execute();
$check_result = $requete -> fetchAll(PDO::FETCH_ASSOC);
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/Creation.css?v=1.1">
    <script type="text/javascript" src="signature.js"></script>
    <link rel="shortcut icon" href="ico/Orange.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<style>
    /* Masquer le bouton radio par défaut */
input[type="radio"] {
    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    width: 10px;
    height: 10px;
    border: 2px solid #0b0303;
    border-radius: 50%;
    outline: none;
    cursor: pointer;
  }
  #signature-pad{
    background-color: antiquewhite;
  }
  
  
  /* Styler le bouton radio sélectionné */
  input[type="radio"].oui:checked {
    background-color: #22ed0c; /* Exemple de couleur de fond pour le bouton sélectionné */
    border-color: #111314; /* Exemple de couleur de bordure pour le bouton sélectionné */
  }
  input[type="radio"].non:checked {
    background-color: #ed1f0c; /* Exemple de couleur de fond pour le bouton sélectionné */
    border-color: #111314; /* Exemple de couleur de bordure pour le bouton sélectionné */
  }
  input[type="radio"].non:hover {
    background-color: #ed1f0c; 
    border-color: #111314; 
  }
  
  /* Styler le label associé */
  label {
    margin-left: 5px; /* Ajustez la marge selon vos préférences */
    cursor: pointer;
  }
  
  /* Facultatif : Ajouter un style au survol du bouton radio */
  input[type="radio"].oui:hover {
    background-color: #22ed0c;
    border-color: #111314; /* Exemple de couleur de bordure au survol */
  }
</style>
<style type="text/css">
    /* 
     * Rating styles
     */
    .rating {
        width: 300px;
        margin: 0 auto 1em;
        font-size: 45px;
        overflow: hidden;
        margin: 0;
        padding: 0;
    }

    .rating a {
        float: right;
        color: #aaa;
        text-decoration: none;
        -webkit-transition: color .4s;
        -moz-transition: color .4s;
        -o-transition: color .4s;
        transition: color .4s;
    }

    .rating a:hover,
    .rating a:hover ~ a,
    .rating a:focus,
    .rating a:focus ~ a {
        cursor: pointer;
    }

    .rating2 {
        direction: rtl;
    }

    .rating2 a {
        float: none;
    }

    .rating a.selected {
        color: orange;
    }
</style>
<body>
<div class="container-fluid"> 
    <div class="form-wrapper scrollable-div">
        <fieldset style="border: solid 5px black;" >
            <legend>
                <img src="../img/Orange.png" alt="LOGO OBS"> 
            </legend>
            <form action="generation.php" id="FORM" name="FORM" method="POST" enctype="multipart/form-data">
                <legend style="border: solid 1px; background-color: antiquewhite;" >
                    <h3 style="color:orange;">Informations Client</h3>               
                 </legend>
                <input list="client" name="client" id="nomclient" placeholder="Nom Client">
                <datalist id="client" >               
                    <?php
                            foreach ($check_result as $key) {
                                ?>
                                    <option value="<?=$key['nom']?>" >
                                <?php
                            }
                    ?>
                </datalist>
                    <br>
                <input type="email" placeholder="Mail Client" class="Saisie" name="Mail" id="emailclient"> <br>
                <input type="number" name="telephone" id="numeroclient" placeholder="Téléphone sans indicatif" maxlength="9"> <br>
                <!-- Champ de saisie (input text) pour le site -->
                <strong>
                    <div style="display: none; color:yellowgreen" id="nbresiteclient" ></div>
                </strong>
                <input type="text" id="siteInput" placeholder="Adresse du site" name="siteclient">
                <!-- Champ de sélection (select) pour les sites -->
                <select id="siteSelect" style="display: none;" name="siteclient"></select>
                <legend style="border: solid 1px; background-color: antiquewhite;" >
                    <h3 style="color:orange;">Vos Informations<span style="font-size: 12px; color: red;" >(Pas Besoin de compléter)</span></h3>
                                    
                </legend>
                <br>

                Nom Technicien:<input type="text" name="nomagent" value="<?=$prenom." ".$nom ?>" readonly>
                <br> Email Technicien:
                <input type="email" name="emailagent" value="<?=$email?>" readonly>   
                <br> Numéro Technicien:
                <input type="tel" name="telephoneagent" id="telephoneagent" value="<?=$telephone?>" readonly>
                

                <br>
                <legend style="border: solid 1px; background-color: antiquewhite;" >
                    <h3 style="color:orange;">Ensemble des Travaux</h3>        
                </legend>
                <br>
                <legend style="background-color: transparent;" >
                    <h6 style="color:black;"><u>Fournitures</u></h6>        
                </legend>
                <textarea id="inputArea" rows="6" cols="48" name="fournitures" maxlength="225" oninput="updateCharacterCount('inputArea','charCount')"></textarea>
                <p>Nombre de caractères restants : <span ><strong id="charCount">225/225</strong></span></p>

                <legend style="background-color: transparent;" >
                    <h6 style="color:black;"><u>Travaux Effectués</u> </h6>        
                </legend>                
                <textarea id="inputArea2" rows="6" cols="48" name="travaux" maxlength="225" oninput="updateCharacterCount('inputArea2','charCount2')"></textarea>
                <p>Nombre de caractères restants : <span ><strong id="charCount2">225/225</strong></span></p>
                
                <legend style="border: solid 1px; background-color: antiquewhite;" >
                    <h3 style="color:orange;">Entretien</h3>        
                </legend>
                <div>
                  <!-- Soufflage -->
                    <span class="textrubrique" id="rubrique1"><strong>Soufflage du Pabx</strong></span>
                    <input type="radio" class="oui" id="oui1" name="Soufflage" value="Oui" onchange="updateRubriqueStyle('rubrique1', 'green')" onmouseover="updateRubriqueStyle('rubrique1', 'green')" onmouseout="updateRubriqueStyle('rubrique1', 'black')">
                    <label for="oui1">Oui</label>
                    <input type="radio" class="non" id="non1" name="Soufflage" value="Non" onchange="updateRubriqueStyle('rubrique1', 'red')" onmouseover="updateRubriqueStyle('rubrique1', 'red')" onmouseout="updateRubriqueStyle('rubrique1', 'black')">
                    <label for="non1">Non</label>
                    <br>

                    <!-- Rubrique Tension Batterie -->
                    <input type="number" placeholder="Valeur Tension Batterie" name="Batterie">Volt
                    <br>

                    <!-- Test Duplication -->
                    <span class="textrubrique" id="rubrique3"><strong>Test Duplication</strong></span>
                    <input type="radio" class="Oui" id="Oui3" name="Duplication" value="Oui" onchange="updateRubriqueStyle('rubrique3', 'green')" onmouseover="updateRubriqueStyle('rubrique3', 'green')" onmouseout="updateRubriqueStyle('rubrique3', 'black')">
                    <label for="Oui3">Oui</label>
                    <input type="radio" class="non" id="non3" name="Duplication" value="Non" onchange="updateRubriqueStyle('rubrique3', 'red')" onmouseover="updateRubriqueStyle('rubrique3', 'red')" onmouseout="updateRubriqueStyle('rubrique3', 'black')">
                    <label for="non3">Non</label>
                    <br>

                    <!-- Présence Onduleur -->
                    <span class="textrubrique" id="rubrique4"><strong>Présence Onduleur</strong></span>
                    <input type="radio" class="Oui" id="Oui4" name="Onduleur" value="Oui" onchange="updateRubriqueStyle('rubrique4', 'green')" onmouseover="updateRubriqueStyle('rubrique4', 'green')" onmouseout="updateRubriqueStyle('rubrique4', 'black')">
                    <label for="Oui4">Oui</label>
                    <input type="radio" class="non" id="non4" name="Onduleur" value="Non" onchange="updateRubriqueStyle('rubrique4', 'red')" onmouseover="updateRubriqueStyle('rubrique4', 'red')" onmouseout="updateRubriqueStyle('rubrique4', 'black')">
                    <label for="non4">Non</label>
                    <br>

                    <!-- Contrôle Carte Alarme -->
                    <span class="textrubrique" id="rubrique5"><strong>Contrôle Carte Alarme</strong></span>
                    <input type="radio" class="Oui" id="Oui5" name="Carte_Alarme" value="Oui" onchange="updateRubriqueStyle('rubrique5', 'green')" onmouseover="updateRubriqueStyle('rubrique5', 'green')" onmouseout="updateRubriqueStyle('rubrique5', 'black')">
                    <label for="Oui5">Oui</label>
                    <input type="radio" class="non" id="non5" name="Carte_Alarme" value="Non" onchange="updateRubriqueStyle('rubrique5', 'red')" onmouseover="updateRubriqueStyle('rubrique5', 'red')" onmouseout="updateRubriqueStyle('rubrique5', 'black')">
                    <label for="non5">Non</label>
                    <br>

                    <!-- Sauvegarde du Système -->
                    <span class="textrubrique" id="rubrique6"><strong>Sauvegarde du Système</strong></span>
                    <input type="radio" class="Oui" id="Oui6" name="Sauvegarde" value="Oui" onchange="updateRubriqueStyle('rubrique6', 'green')" onmouseover="updateRubriqueStyle('rubrique6', 'green')" onmouseout="updateRubriqueStyle('rubrique6', 'black')">
                    <label for="Oui6">Oui</label>
                    <input type="radio" class="non" id="non6" name="Sauvegarde" value="Non" onchange="updateRubriqueStyle('rubrique6', 'red')" onmouseover="updateRubriqueStyle('rubrique6', 'red')" onmouseout="updateRubriqueStyle('rubrique6', 'black')">
                    <label for="non6">Non</label>
                </div>
                <hr>
                <legend style="border: solid 1px; background-color: antiquewhite;" >
                    <h3 style="color:orange;">Observation Client</h3>        
                </legend>
                <textarea id="inputArea3" rows="3"  name="Observation" maxlength="225" oninput="updateCharacterCount('inputArea3','charCount3')"></textarea>
                <p>Nombre de caractères restants : <span ><strong id="charCount3">225/225</strong></span></p>

                <hr>
                <h3>Note Client</h3>
                <div class="rating rating2">
                    <span id="5stars"  title="Note 5/5">★</span>
                    <span id="4stars"  title="Note 4/5">★</span>
                    <span id="3stars"  title="Note 3/5">★</span>
                    <span id="2stars"  title="Note 2/5">★</span>
                    <span id="1star"   title="Note 1/5">★</span>
                </div>
                <input type="hidden" id="nbreetoile" name="nbreetoile">
                <hr>
                <h3>Signature Client</h3>
                <div id="signature-pad" width="250px" height="100px">
                    <div style="border:solid 1px teal;">
                        <div id="note" style="font-size:larger;"  onmouseover="my_function();">Mettez Une Signature</div>
                        <canvas id="the_canvas" width="350px" height="100px"></canvas>
                    </div>
                    <div style="margin:10px;">
                        <input type="hidden" id="signature" name="signature">
                        <button type="button" id="clear_btn" class="btn btn-danger" data-action="clear"><span class="glyphicon glyphicon-remove"></span> Clear</button>
                        <button type="submit" id="generation" class="btn btn-success">Générer</button>
                    </div>
                </div>
                <br>
            </form>
        </fieldset>   
    </div>                 
</div>

<script>
    function updateCharacterCount(idarea,idcount) {
    const inputArea = document.getElementById(idarea);
    const charCount = document.getElementById(idcount);
    const maxLength = parseInt(inputArea.getAttribute('maxlength'));
    const currentLength = inputArea.value.length;
    const remainingCharacters = maxLength - currentLength;
    
    charCount.textContent = remainingCharacters+"/"+maxLength;
}
function updateRubriqueStyle(rubriqueId, color) {
  const rubrique = document.getElementById(rubriqueId);
  rubrique.style.color = color;
}

/*Signature */

var envoyer=document.getElementById("generation")
var wrapper = document.getElementById("signature-pad");
var clearButton = wrapper.querySelector("[data-action=clear]");
var savePNGButton = wrapper.querySelector("[data-action=save-png]");
var canvas = wrapper.querySelector("canvas");
var el_note = document.getElementById("note");
var signaturePad;
signaturePad = new SignaturePad(canvas);
clearButton.addEventListener("click", function (event) {
   document.getElementById("note").innerHTML="Mettez une signature";
   signaturePad.clear();
});
envoyer.addEventListener("click", function (event){
   if (signaturePad.isEmpty()){
     alert("Mettez d'abord la signature du client");
     event.preventDefault();
   }else{
     var canvas  = document.getElementById("the_canvas");
     var dataUrl = canvas.toDataURL();
     document.getElementById("signature").value = dataUrl;
   }
   if (document.getElementById("inputArea3").value="") {
        alert("Le client doit donner son observation");
        event.preventDefault();
   }
   
});
function my_function(){
   document.getElementById("note").innerHTML="";
}
function updateCharacterCount() {
    const inputArea = document.getElementById('inputArea');
    const charCount = document.getElementById('charCount');
    const maxLength = parseInt(inputArea.getAttribute('maxlength'));
    const currentLength = inputArea.value.length;
    const remainingCharacters = maxLength - currentLength;
    
    charCount.textContent = remainingCharacters;
}

/*Note */
let first=document.getElementById("1star")
    let second=document.getElementById("2stars")
    let three=document.getElementById("3stars")
    let four=document.getElementById("4stars")
    let five=document.getElementById("5stars")
    let nbreetoile=document.getElementById("nbreetoile")
    /*Hover */
    first.addEventListener("mouseover" ,function(){
        first.style.color="red";
        second.style.color="black";
        three.style.color="black"
        four.style.color="black"
        five.style.color="black"
        nbreetoile.value=1
    })
    second.addEventListener("mouseover" ,function(){
        second.style.color="red";
        first.style.color="red"
        three.style.color="black"
        four.style.color="black"
        five.style.color="black"
        nbreetoile.value=2
    })
    three.addEventListener("mouseover" ,function(){
        second.style.color="yellow";
        first.style.color="yellow"
        three.style.color="yellow"
        four.style.color="black"
        five.style.color="black"
        nbreetoile.value=3
    })
    four.addEventListener("mouseover" ,function(){
        second.style.color="green";
        first.style.color="green"
        three.style.color="green"
        four.style.color="green"
        five.style.color="black"
        nbreetoile.value=4
    })
    five.addEventListener("mouseover" ,function(){
        second.style.color="green";
        first.style.color="green"
        three.style.color="green"
        four.style.color="green"
        five.style.color="green"
        nbreetoile.value=5
    })


    /*Click */
    first.addEventListener("click" ,function(){
        first.style.color="red";
        second.style.color="black"
        three.style.color="black"
        four.style.color="black"
        five.style.color="black"
        nbreetoile.value=1

    })
    
    second.addEventListener("click" ,function(){
        second.style.color="red";
        first.style.color="red";        
        three.style.color="black"
        four.style.color="black"
        five.style.color="black"
        nbreetoile.value=2
    })

    three.addEventListener("click" ,function(){
        second.style.color="yellow";
        first.style.color="yellow"
        three.style.color="yellow"
        four.style.color="black"
        five.style.color="black"
        nbreetoile.value=3
    })
    four.addEventListener("click" ,function(){
        second.style.color="green";
        first.style.color="green"
        three.style.color="green"
        four.style.color="green"
        five.style.color="black"
        nbreetoile.value=4
    })
    five.addEventListener("click" ,function(){
        second.style.color="green";
        first.style.color="green"
        three.style.color="green"
        four.style.color="green"
        five.style.color="green"
        nbreetoile.value=5
    })
    
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="Creation.js?v=1.1"></script>
</body>
</html>