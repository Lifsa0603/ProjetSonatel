document.addEventListener("DOMContentLoaded", function() {
    
    var enregistrer = document.getElementById("Enregistrer");
  /*Ticket */  
var refticketInput = document.getElementById("reference");  
var displayref = document.getElementById("display_ref");

/*Nom Client */
var Clientselect = document.getElementById("Nomclient");  
var varclient = Clientselect.value;


var displayclient = document.getElementById("display_client");

/*Systeme */
var Systemeselect = document.getElementById("Systeme");  


    // Sélectionnez tous les éléments <select>
// Sélectionnez tous les éléments de formulaire
var formElements = document.querySelectorAll('select, input');

// Parcourez tous les éléments de formulaire
formElements.forEach(function(formElement) {
    // Vérifiez si l'élément a l'attribut 'required'
    if (formElement.getAttribute('required') === 'required') {
        // Créez un élément <span> pour l'étoile
        var etoileSpan = document.createElement('span');
        etoileSpan.className = 'etoile';
        etoileSpan.textContent = '*';

        // Insérez l'étoile après l'élément du formulaire
        formElement.parentNode.insertBefore(etoileSpan, formElement.nextSibling);
    }
});



    
    // Sélectionnez tous les éléments input dans toute l'application
    var inputElements = document.querySelectorAll('input');
    
    // Parcourez chaque élément input
    inputElements.forEach(function(inputElement) {
      // Vérifiez si l'élément a l'attribut 'required'
      if (inputElement.getAttribute('required') === 'required') {
        // Créez un élément <span> pour l'étoile
        var etoileSpan = document.createElement('span');
        etoileSpan.className = 'etoile';
        etoileSpan.textContent = '*';
    
        // Insérez l'étoile après l'élément input
        inputElement.parentNode.insertBefore(etoileSpan, inputElement.nextSibling);
      }
    });
    
    
    

    /** */
    /*function toggleSubmitButton() {
        var log = loginInput.value;
        var password = passwordInput.value;
        var varemail = refticketInput.value;
        var nom = nomInput.value;
        var prenom = prenomInput.value;;
        

        // Vérifier les champs avant de réactiver/désactiver le bouton
        var log = loginInput.value;
        var password = passwordInput.value;
        var varemail = refticketInput.value;
        var nom = nomInput.value;
        var prenom = prenomInput.value;
    
        if (prenom === "" || nom === "" || log === "" || password === "" || varemail === "") {
            enregistrer.setAttribute("disabled", "");
        } else {
            enregistrer.removeAttribute("disabled", "");
        }
    }*/

  

    // Fonction pour gérer la vérification référence
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
                            } else {
                                displayref.style.color = "red";
                                displayref.innerHTML = "N° Référence Déja Dans la Base";
                                displayref.classList.remove("N-Référence-Disponible");
                                displayref.classList.add("N-Référence-Déja-Dans-la-Base");
                                displayref.style.display = "block";
                                enregistrer.disabled;
                            }
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
    



    /** */


        // Sélectionnez vos éléments ici...
    
        // ...
    
        /*Nom Client */
    var displayclient = document.getElementById("display_client");
    // Écouteur d'événement pour le changement de sélection
    Clientselect.addEventListener("change", function() {
        var varclient = Clientselect.value;
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
                        // ...
                    if (response) {
                        if (response.hassysteme) {
                            if (response.monosyteme) { // <--- Correction ici
                                displayclient.style.color = "greenyellow";
                                displayclient.innerHTML = "Ce Client n'a qu'un seul Système";
                                displayclient.classList.remove("Système-Indisponible");
                                displayclient.classList.remove("Système-Disponible");
                                displayclient.classList.add("Système-Disponible-monosysteme");
                                displayclient.style.display = "block";
                            } else {
                                displayclient.style.color = "greenyellow";
                                displayclient.innerHTML = "Ce Client a des Systèmes";
                                displayclient.classList.remove("Système-Indisponible");
                                displayclient.classList.add("Système-Disponible");
                                displayclient.classList.remove("Système-Disponible-monosysteme");
                                displayclient.style.display = "block";
                            }
                        } else {
                            displayclient.style.color = "red";
                            displayclient.innerHTML = "Ce client n'a aucun système";
                            displayclient.classList.remove("Système-Disponible");
                            displayclient.classList.remove("Système-Disponible-1");
                            displayclient.classList.add("Système-Indisponible");
                            displayclient.style.display = "block";
                        }
                    }
                    // ...
                    } catch(e) {
                        console.log(e);
                    }
                }
            };
            xhr.send("Nomclient=" + varclient);
        } else {
            // Réinitialisez le texte d'affichage si aucun client n'est sélectionné
            displayclient.innerHTML = "";
            displayclient.style.display = "none"; // Cacher le texte d'affichage
        }
    });    

});
