// Sélectionnez les éléments une seule fois pour réduire les sélections DOM
var ClientSelect = document.getElementById("Nomclient");
var SystemeSelect = document.getElementById("Systeme");
var SiteSelect = document.getElementById("Siteclient");
var RefTicketInput = document.getElementById("reference");
var DisplayClient = document.getElementById("display_client");
var DisplayRef = document.getElementById("display_ref");
var Maintenance = document.getElementById("Maintenance");
var Technicien = document.getElementById("Technicien");
var BoutonEnregistrer=document.getElementById("Enregistrer")
var verifyreference
// Écouteur d'événement pour le changement de sélection du client
ClientSelect.addEventListener("change", function() {
    var varclient = ClientSelect.value;
    SiteSelect.value = ""; // Efface le contenu du champ du site
    SystemeSelect.value="";
    console.log(varclient);
    if (varclient !== "") {
        // Effectuer la requête AJAX
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "../RechercheBd/fetch_add_ticket.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                try {
                    var response = JSON.parse(xhr.responseText);
                    console.log(response);
                    if (response) {
                        if (response.hassysteme) {
                            // Supprimez toutes les options actuelles du "Systeme" select
                            SystemeSelect.innerHTML = "";

                            // Ajoutez une option cachée vide
                            var hiddenOption = document.createElement("option");
                            hiddenOption.value = "";
                            hiddenOption.text = "";
                            SystemeSelect.appendChild(hiddenOption);

                            // Parcourez les systèmes dans la réponse JSON et ajoutez-les en tant qu'options
                            response.systeme.forEach(function(systeme) {
                                var option = document.createElement("option");
                                option.value = systeme;
                                option.text = systeme;
                                SystemeSelect.appendChild(option);
                            });

                            // Affichez le select maintenant qu'il contient des options
                            SystemeSelect.style.display = "block";

                            if (response.monosyteme) {
                                // Gérez le cas où le client a un seul système
                                DisplayClient.style.color = "greenyellow";
                                DisplayClient.innerHTML = "Ce Client n'a qu'un seul Système";
                                DisplayClient.classList.remove("Système-Indisponible");
                                DisplayClient.classList.remove("Système-Disponible");
                                DisplayClient.classList.add("Système-Disponible-monosysteme");
                                DisplayClient.style.display = "block";
                            } else {
                                var nbresysteme = response.nbresysteme;
                                // Gérez le cas où le client a plusieurs systèmes
                                DisplayClient.style.color = "greenyellow";
                                DisplayClient.innerHTML = "Ce Client a " + nbresysteme + " Systèmes";
                                DisplayClient.classList.remove("Système-Indisponible");
                                DisplayClient.classList.add("Système-Disponible");
                                DisplayClient.classList.remove("Système-Disponible-monosysteme");
                                DisplayClient.style.display = "block";
                            }
                        } else {
                            // Gérez le cas où le client n'a aucun système
                            SystemeSelect.style.display = "none"; // Masquez le select
                            DisplayClient.style.color = "red";
                            DisplayClient.innerHTML = "Ce client n'a aucun système";
                            DisplayClient.classList.remove("Système-Disponible");
                            DisplayClient.classList.remove("Système-Disponible-1");
                            DisplayClient.classList.add("Système-Indisponible");
                            DisplayClient.style.display = "block";
                            
                        }
                    }
                } catch (e) {
                    console.log(e);
                }
            }
        };
        xhr.send("Nomclient=" + varclient);
    } else {
        // Réinitialisez le texte d'affichage si aucun client n'est sélectionné
        SystemeSelect.style.display = "none"; // Masquez le select
        DisplayClient.innerHTML = "";
        DisplayClient.style.display = "none"; // Cacher le texte d'affichage
    }
});

// Écouteur d'événement pour le changement de sélection du système
SystemeSelect.addEventListener("change", function() {
    var varsysteme = SystemeSelect.value;
      // Réinitialisez le champ du site lorsque le client change
      SiteSelect.value = ""; // Efface le contenu du champ du site

    console.log(varsysteme);
    if (varsysteme !== "") {
        // Effectuer la requête AJAX
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "../RechercheBd/fetch_add_ticket.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                try {
                    var response = JSON.parse(xhr.responseText);
                    console.log(response);
                    if (response) {
                        if (response.resultatsite) {
                            // Supprimez toutes les options actuelles du "Site" select
                            SiteSelect.innerHTML = "";

                            // Ajoutez une option cachée vide
                            var hiddenOption = document.createElement("option");
                            hiddenOption.value = "";
                            hiddenOption.text = "";
                            SiteSelect.appendChild(hiddenOption);

                            // Créez une option avec le nom du site et ajoutez-la au "Site" select
                            var option = document.createElement("option");
                            option.value = response.site;
                            option.text = response.site;
                            SiteSelect.appendChild(option);
                        } else {
                            // Gérez le cas où le client n'a aucun système
                            SiteSelect.style.display = "none"; // Masquez le select du site
                            SiteSelect.value="";
                        }
                    }
                } catch (e) {
                    console.log(e);
                }
            }
        };
        xhr.send("Systeme=" + varsysteme);
    } else {
        // Réinitialisez le texte d'affichage si aucun système n'est sélectionné
        SiteSelect.style.display = "none"; // Masquez le select du site
    }
});

// ... Votre code précédent ...







/*Reference */
var refticketInput = document.getElementById("reference");  
var displayref = document.getElementById("display_ref");
function verifyref() {
    var varref = refticketInput.value;
    console.log(varref)
    if (varref !== "") {
        // Effectuer la requête AJAX
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "../RechercheBd/fetch_add_ticket.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                try {
                    var response = JSON.parse(xhr.responseText);
                    console.log(response);
                    if (response) {
                        if (response.refverification) {
                            displayref.style.color = "greenyellow";
                            displayref.innerHTML = "N° Référence Disponible";
                            displayref.classList.remove("N-Référence-Déja-Dans-la-Base");
                            displayref.classList.add("N-Référence-Disponible");
                            displayref.style.display = "block";
                            verifyreference=true
                        } else {
                            displayref.style.color = "red";
                            displayref.innerHTML = "N° Référence Déja Dans la Base";
                            displayref.classList.remove("N-Référence-Disponible");
                            displayref.classList.add("N-Référence-Déja-Dans-la-Base");
                            displayref.style.display = "block";
                            verifyreference=false
                        }
                          // Appel de toggleSubmitButton lorsque displayref est mis à jour
                          toggleSubmitButton();
                    }
                }
                catch(e){
                    console.error('Erreur lors de l\'analyse JSON :', e);
                }
            }
        };
        xhr.send("reference=" + varref);
    } else {
        displayref.innerHTML = "";
    }
}


refticketInput.addEventListener("input", verifyref);


function toggleSubmitButton() {
    var valeurtech = Technicien.value;
    var valeurref = refticketInput.value;
    var valeursite = SiteSelect.value;
    var valeursysteme = SystemeSelect.value;
    var valeurclient = ClientSelect.value;
    var valeurtype = Maintenance.value;
 
     if (valeurref === "" || valeurtech === "" || valeurclient === "" || valeursite === "" || valeursysteme === "" || valeurtype === "") {
         BoutonEnregistrer.disabled = true; // Désactiver le bouton
     } else {
         if (verifyreference === true) {
             BoutonEnregistrer.disabled = false; // Activer le bouton
         } else {
             BoutonEnregistrer.disabled = true; // Désactiver le bouton
         }
     }
 }
 


RefTicketInput.addEventListener("input", toggleSubmitButton);
Technicien.addEventListener("change", toggleSubmitButton);
SiteSelect.addEventListener("change", toggleSubmitButton);
SystemeSelect.addEventListener("change", toggleSubmitButton);
ClientSelect.addEventListener("change", toggleSubmitButton);
Maintenance.addEventListener("change", toggleSubmitButton);
