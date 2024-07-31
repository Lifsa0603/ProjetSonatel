<?php
//require_once('../identification.php');
include_once 'head.php';
?>
<link rel="stylesheet" href="../css/Ajoutfiche.css?v=1.1">
<script type="text/javascript" src="../js/signature.js"></script>
<title>Ajout Fiche</title>
<!-- Autres Lien Css dans le head -->
</head>
<style type="text/css">
    /* 
     * Rating styles
     */
    .rating {
        width: 100%;
        margin: 0 auto 1em;
        font-size: 100px;
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
<?php
include_once 'Profil.php';
$timezoneSenegal = new DateTimeZone('Africa/Dakar');
$now = new DateTime('now', $timezoneSenegal);
$formattedNow = $now->format('Y-m-d\TH:i');
?>
<?php
?>
<!-- Contenu -->
<div id="menucontain" class="col-10 row scrollable-divhauteur" style="border:solid black; box-shadow: 0px 1px 10px orange ;flex:1; height:95%; margin-left:60px; border-width:15px;    background-image: url(../img/formulaire_transfert_orange_money_original.png);background-repeat: no-repeat;background-size:100% 100%;">
            <div class="container-fluid m-0 p-0 w-100 " style="height: 100%;background-color:url();" >
                <div class="col-12 row" >
                    <div id="contenaire" class="row col-12 d-flex justify-content-center" >
                        <div class="col-12" style="text-align: center; text-shadow:2px 2px orange;text-decoration:underline" >
                            <h2>Créer Fiche Maintenance</h2>
                        </div>
                        <div id="fichemaintenance" class="col-12 col-sm-12 col-md-8 col-lg-8 col-xl-6 col-xxl-6"> 
                            <div class="form-wrapper">
                                <fieldset style="border: solid 5px black;" >
                                    <legend>
                                        <img src="../img/Orange.png" alt="LOGO OBS"> 
                                    </legend>
                                    <form action="generation.php" id="FORM" method="POST" enctype="multipart/form-data">
                                        <legend style="border: solid 1px; background-color: antiquewhite;" >
                                            <h3 style="color:orange;">Informations Client</h3>               
                                        </legend>
                                     
                                        <input list="NumReference" name="Reference" id="Reference" placeholder="N°Reference" autocomplete="off">
                                        <datalist id="NumReference">
                                            <?php
                                                 $requeteticket_traitement = $PDO -> prepare('SELECT * FROM Ticket WHERE LOWER(etat_ticket)=LOWER("Traitement En Cours") AND numtechnicien=? ORDER BY dateCreation');
                                                 $requeteticket_traitement->execute(array($idtechnicien));
                                                 $check_result_traitement = $requeteticket_traitement -> fetchAll(PDO::FETCH_ASSOC);
                                                 foreach ($check_result_traitement as $key) {
                                                     ?>
                                                         <option value="<?=$key['ref_ticket']?>" >
                                                     <?php
                                                 }
                                            ?>
                                        </datalist>
                                        <input list="client" name="client" id="nomclient" placeholder="Nom Client" required>
                                        <datalist id="client" >               
                                            <?php
                                                $requete = $PDO -> prepare('SELECT * FROM Client ORDER BY nom');
                                                $requete->execute();
                                                $check_result = $requete -> fetchAll(PDO::FETCH_ASSOC);
                                                foreach ($check_result as $key) {
                                                    ?>
                                                        <option value="<?=$key['nom']?>" >
                                                    <?php
                                                }
                                            ?>
                                        </datalist>
                                            <br>
                                        <input type="email" placeholder="Mail Client" class="Saisie" name="mailclient" id="emailclient"> <br>
                                        <input type="number" name="telephone" id="numeroclient" placeholder="Téléphone sans indicatif" maxlength="9"> <br>
                                        <!-- Champ de saisie (input text) pour le site -->
                                        <strong>
                                            <div style="display: none; color:yellowgreen" id="nbresiteclient"></div>
                                        </strong>
                                        <input type="text" id="siteInput" placeholder="Adresse du site" name="siteclient">
                                        <!-- Champ de sélection (select) pour les sites -->
                                        <select id="siteSelect" style="display: none;" name="siteclient"></select>
                                        <legend style="border: solid 1px; background-color: antiquewhite;" >
                                            <h3 style="color:orange;">Vos Informations<span style="font-size: 12px; color: red;" >(Pas Besoin de compléter)</span></h3>
                                                            
                                        </legend>
                                        <br>
                                        <!-- Information Technicien -->

                                        Nom Technicien: <br> <input type="text" name="nomagent" value="<?=$prenom." ".$nom ?>" readonly>
                                        <br> Email Technicien: <br>
                                        <input type="email" name="emailagent" value="<?=$email?>">   
                                        <br> Numéro Technicien: <br>
                                        <input type="tel" name="telephoneagent" id="telephoneagent" value="<?=$telephone?>">
                                        

                                        <br>
                                        <legend style="border: solid 1px; background-color: antiquewhite;" >
                                            <h3 style="color:orange;">Ensemble des Travaux</h3>        
                                        </legend>
                                        <br>
                                        <!-- Informations Travaux -->
                                        <legend style="background-color: transparent;" >
                                            <h6 style="color:black;"><u>Type Maintenance</u></h6>        
                                        </legend>
                                        <input type="text" placeholder="Type Maintenance" class="Saisie" name="typemaintenance" id="typemaintenance" required> <br>
                                        <br>

                                        <legend style="background-color: transparent;" >
                                            <h6 style="color:black;"><u>Fournitures</u></h6>        
                                        </legend>
                                        <textarea id="inputArea1" rows="4" name="fournitures" maxlength="225" oninput="updateCharacterCount('inputArea','charCount')"></textarea>
                                        <p>Nombre de caractères restants : <span ><strong id="charCount">225/225</strong></span></p>

                                        <legend style="background-color: transparent;" >
                                            <h6 style="color:black;"><u>Travaux Effectués</u> </h6>        
                                        </legend>                
                                        <textarea id="inputArea2" rows="4" name="travaux" maxlength="225" oninput="updateCharacterCount('inputArea2','charCount2')"></textarea>
                                        <p>Nombre de caractères restants : <span ><strong id="charCount2">225/225</strong></span></p>
                                        
                                        <br>
                                        <legend style="background-color: transparent;" >
                                            <h6 style="color:black;"><u>Date Début Maintenance Format(Jour/Mois/Année Heure:Minute)</u></h6>        
                                        </legend>
                                        <input type="datetime-local" placeholder="Date Début" class="Saisie" name="Datedebut" id="Datedebut" required> <br>
                                        <br>

                                        <legend style="background-color: transparent;" >
                                            <h6 style="color:black;"><u>Date Fin Maintenance Format(Jour/Mois/Année Heure:Minute)</u></h6>        
                                        </legend>
                                        <input type="datetime-local" placeholder="Date Fin" class="Saisie" name="Datefin" id="Datefin" value="<?php echo $formattedNow; ?>" required> <br>
                                        <br>

                                        <!-- Case Entretien -->
                                        <legend style="border: solid 1px; background-color: antiquewhite;" >
                                            <h3 style="color:orange;">Entretien</h3>        
                                        </legend>
                                        <div>
                                            <!-- Soufllage -->
                                            <span class="textrubrique" id="rubrique1"><strong>Soufflage du Pabx</strong></span>
                                            <input type="radio" class="oui" id="oui1" name="Soufflage" value="oui" onchange="updateRubriqueStyle('rubrique1', 'green')" onmouseover="updateRubriqueStyle('rubrique1', 'green')" onmouseout="updateRubriqueStyle('rubrique1', 'black')">
                                            <label for="oui">Oui</label>
                                            <input type="radio" class="non" id="non1" name="Soufflage" value="Non" onchange="updateRubriqueStyle('rubrique1', 'red')" onmouseover="updateRubriqueStyle('rubrique1', 'red')" onmouseout="updateRubriqueStyle('rubrique1', 'black')">
                                            <label for="non">Non</label>
                                            <br>
                                            <!--Rubrique Tension Batterie  -->
                                            <input type="number" placeholder="Valeur Tension Batterie" name="Batterie">Volt
                                            <br>
                                                    <!-- Test Duplication -->
                                                    <span class="textrubrique" id="rubrique3"><strong>Test Duplication</strong></span>
                                            <input type="radio" class="oui" id="oui3" name="Duplication" value="oui" onchange="updateRubriqueStyle('rubrique3', 'green')" onmouseover="updateRubriqueStyle('rubrique3', 'green')" onmouseout="updateRubriqueStyle('rubrique3', 'black')">
                                            <label for="oui">Oui</label>
                                            <input type="radio" class="non" id="non3" name="Duplication" value="Non" onchange="updateRubriqueStyle('rubrique3', 'red')" onmouseover="updateRubriqueStyle('rubrique3', 'red')" onmouseout="updateRubriqueStyle('rubrique3', 'black')">
                                            <label for="non">Non</label>
                                                    <br>
                                            <!-- Présence Onduleur -->
                                            <span class="textrubrique" id="rubrique4"><strong>Présence Onduleur</strong></span>
                                            <input type="radio" class="oui" id="oui4" name="Onduleur" value="oui" onchange="updateRubriqueStyle('rubrique4', 'green')" onmouseover="updateRubriqueStyle('rubrique4', 'green')" onmouseout="updateRubriqueStyle('rubrique4', 'black')">
                                            <label for="oui">Oui</label>
                                            <input type="radio" class="non" id="non4" name="Onduleur" value="Non" onchange="updateRubriqueStyle('rubrique4', 'red')" onmouseover="updateRubriqueStyle('rubrique4', 'red')" onmouseout="updateRubriqueStyle('rubrique4', 'black')">
                                            <label for="non">Non</label>
                                            <!--  -->
                                                    <br>
                                            <span class="textrubrique" id="rubrique5"><strong>Contrôle Carte Alarme</strong></span>
                                            <input type="radio" class="oui" id="oui5" name="Carte_Alarme" value="oui" onchange="updateRubriqueStyle('rubrique5', 'green')" onmouseover="updateRubriqueStyle('rubrique5', 'green')" onmouseout="updateRubriqueStyle('rubrique5', 'black')">
                                            <label for="oui">Oui</label>
                                            <input type="radio" class="non" id="non5" name="Carte_Alarme" value="Non" onchange="updateRubriqueStyle('rubrique5', 'red')" onmouseover="updateRubriqueStyle('rubrique5', 'red')" onmouseout="updateRubriqueStyle('rubrique5', 'black')">
                                            <label for="non">Non</label>
                                                    <br>
                                            <!--  -->
                                            <span class="textrubrique" id="rubrique6"><strong>Sauvegarde du Système</strong></span>
                                            <input type="radio" class="oui" id="oui6" name="Sauvegarde" value="oui" onchange="updateRubriqueStyle('rubrique6', 'green')" onmouseover="updateRubriqueStyle('rubrique6', 'green')" onmouseout="updateRubriqueStyle('rubrique6', 'black')">
                                            <label for="oui">Oui</label>
                                            <input type="radio" class="non" id="non6" name="Sauvegarde" value="Non" onchange="updateRubriqueStyle('rubrique6', 'red')" onmouseover="updateRubriqueStyle('rubrique6', 'red')" onmouseout="updateRubriqueStyle('rubrique6', 'black')">
                                            <label for="non">Non</label>
                                        </div>
                                        <hr>
                                        <legend style="border: solid 1px; background-color: antiquewhite;" >
                                            <h3 style="color:orange;">Avis du Client</h3>        
                                        </legend>
                                        <h3>Observation Client</h3>
                                        <textarea id="inputArea3" rows="4" name="Observation" maxlength="100" oninput="updateCharacterCount('inputArea3','charCount3')"></textarea>
                                        <p>Nombre de caractères restants : <span ><strong id="charCount3">100/100</strong></span></p>
                                        <hr>
                                        <h3>Note Client</h3>
                                        <div id="etoilenote" class="rating rating2 d-flex justify-content-center">
                                            <span id="5stars"  title="Note 5/5">★</span>
                                            <span id="4stars"  title="Note 4/5">★</span>
                                            <span id="3stars"  title="Note 3/5">★</span>
                                            <span id="2stars"  title="Note 2/5">★</span>
                                            <span id="1star"   title="Note 1/5">★</span>
                                        </div>
                                        <input type="text" id="nbreetoile" name="nbreetoile" readonly>
                                        <hr>
                                        <h3>Signature Client</h3>
                                        <div id="signature-pad" height="100px">
                                            <div id="signature-pad2" style="border:solid 2px teal;background-color:white">
                                                <div id="note" style="font-size:larger;"  onmouseover="my_function();">Mettez Une Signature</div>
                                                <canvas id="the_canvas" height="100px"></canvas>
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
                    </div>
                </div>           
                    <!-- <form action="">
                        <div class="col-12 row" style="height: 90%;"> 
                            <div class="col-xl-2 col-md-4 col-sm-6 col-12">
                                N°Ref<input type="text" name="Reference" value="" id="ref" placeholder="Reference">
                            </div>
                            <br>
                            <div class="col-xl-2 col-md-4 col-sm-6 col-12">
                                Nom Client<input type="text" name="nomclient" value="" id="nomclient" placeholder="Nom client">
                            </div>
                            <br>
                            <div class="col-xl-2 col-md-4 col-sm-6 col-12">
                                Site Client<input type="text" name="Siteclient" value="" id="siteclient" placeholder="Site Client">
                            </div>
                            <br>
                            <div class="col-xl-2 col-md-4 col-sm-6 col-12">
                                Type Maintenance<input type="text" name="Type Maintenance" value="" id="typemaint" placeholder="Type Maintenance">
                            </div>
                            <br>
                            <div class="col-xl-2 col-md-4 col-sm-6 col-12">
                                Date Début<input type="Date" name="Date" value="" id="debut" placeholder="Date">
                            </div>
                            <div class="col-xl-2 col-md-4 col-sm-6 col-12">
                               Date Fin <input type="Date" name="Date" value="" id="fin" placeholder="Date">
                            </div>
                            <br>
                            <br>
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12" style="text-align:center" >
                                <button type="submit" id="search" class="btn-box" style="background-color: #f77c08;border-radius:10px">RECHERCHER</button>
                            </div>
                        </div>
                    </form>-->
            </div> 
</div>
<?php
include_once 'Pied.php';
?>
<script src="../js/Ajoutfiche.js"></script>
<script>
 /*if (window.history && window.history.pushState) {
    window.history.pushState('forward', null, 'Accueil.php'); // Redirige vers le fichier dans le sous-répertoire
    window.onpopstate = function(event) {
        history.go(1); // Empêche l'utilisateur de revenir en arrière
        };  
    }*/

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
const inputAreas = [];

for (let i = 1; i <= 3; i++) {
    const inputArea = document.getElementById("inputArea" + i);
    inputAreas.push(inputArea);
}

var maform=document.getElementById("fichemaintenance")
const largeurform=maform.offsetWidth;
const cols=largeurform*0.1
console.log(largeurform)
inputAreas.forEach(function(inputArea) {
    // Appliquer les styles CSS ici
    inputArea.setAttribute("cols",cols)
});
/*Date */



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
var datedebutInput = document.getElementById("Datedebut");
var datefinInput = document.getElementById("Datefin");

envoyer.addEventListener("click", function (event){
    var datedebutValue = datedebutInput.value;
    var datefinValue = datefinInput.value;
    var datedebut = new Date(datedebutValue);
    var datefin = new Date(datefinValue);
   if (signaturePad.isEmpty() && document.getElementById("inputArea3").value.trim()=="" && datefin<=datedebut){
     alert(`Ces informations sont à compléter\n
     •La Signature Client\n
     •Observation Client\n
     •La date debut ne peut devancer la date de fin\n`);
     event.preventDefault();
   }
   else{
        if (signaturePad.isEmpty()) {
            alert("La signature du client est requise!");
            event.preventDefault();
        }
        else if(document.getElementById("inputArea3").value.trim()==""){
            alert("L'Observation du client est requise!");
            event.preventDefault();
        }
        else if(datefin <= datedebut) {
            alert("La date de fin ne peut devancer la date de début. Veuillez corriger les dates.");
            event.preventDefault(); // Empêche la soumission du formulaire
        }
        else{
            var canvas  = document.getElementById("the_canvas");
            var dataUrl = canvas.toDataURL();
            document.getElementById("signature").value = dataUrl;
        }
   }
});
function my_function(){
   document.getElementById("note").innerHTML="";
}
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

/*Note */
var divetoile=document.getElementById("etoilenote")
if (largeurform<=442 && largeurform>=291) {
    divetoile.style.cssText="font-size:65px"
}
if (largeurform<=290) {
    divetoile.style.cssText="font-size:50px"
}
var sizesignature=(largeurform*0.9)+"px"
console.log(sizesignature)
wrapper.setAttribute("width",sizesignature)
document.getElementById("signature-pad2").style.cssText="width" + largeurform + "px;"
wrapper.style.cssText="width" + largeurform + "px;"
document.getElementById("the_canvas").setAttribute("width",sizesignature)
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
</body>
</html>