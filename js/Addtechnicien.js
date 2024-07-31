
    var enregistrer = document.getElementById("Enregistrer");
    var loginInput = document.getElementById("login");
    var passwordInput = document.getElementById("pwd");
    var emailInput = document.getElementById("email");
    var log = loginInput.value;

    var prenomInput = document.getElementById("prénom");
    var nomInput = document.getElementById("nom");
    
    var displayLogin = document.getElementById("display_login");
    var displayEmail = document.getElementById("display_email");
    var loginverification=false
    var mailverification=false
    /** */
    var input_pwd = document.getElementById("pwd");
    var span_oeil = document.querySelector('.oeil'); // Utilise querySelector pour obtenir le premier élément avec la classe "oeil"
    
    span_oeil.addEventListener("click", function() {
        if (input_pwd.getAttribute('type') === 'password') {
            input_pwd.setAttribute('type', 'text');
            this.className = 'fa fa-eye fa-2x oeil';
        } else {
            input_pwd.setAttribute('type', 'password');
            this.className = 'fa fa-eye-slash fa-2x oeil';
        }
    });
    
    
    
    // Sélectionnez tous les éléments input dans toute l'application
    var inputElements = document.querySelectorAll('input');
    
    
    

    /** */


    // Fonction pour gérer la vérification de l'identifiant
    function verifyLogin() {
        var log = loginInput.value;
        if (log !== "") {
            // Effectuer la requête AJAX
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "../RechercheBd/fetch_add_tech.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    console.log(response);
                    if (response) {
                        if (response.loginverification) {
                            displayLogin.style.color = "greenyellow";
                            displayLogin.innerHTML = "Identifiant disponible";
                            displayLogin.classList.remove("identifiant-pris");
                            displayLogin.classList.add("identifiant-disponible");
                            displayLogin.style.display = "block";
                            loginverification=true
                        } else {
                            // Pour changer la couleur du texte en rouge
                            displayLogin.style.color = "red";
                            displayLogin.innerHTML = "Cet Identifiant appartient à un utilisateur";
                            displayLogin.classList.remove("identifiant-disponible");
                            displayLogin.classList.add("identifiant-pris");
                            displayLogin.style.display = "block";
                            loginverification=false
                        }
                    }
                }
            };
            xhr.send("login=" + log);
        } else {
            displayLogin.innerHTML = "";
        }
    }

    loginInput.addEventListener("input", verifyLogin);

    // Fonction pour gérer la vérification de l'email
    function verifyEmail() {
        var varemail = emailInput.value;
        if (varemail !== "") {
            // Effectuer la requête AJAX
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "../RechercheBd/fetch_add_tech.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    console.log(response);
                    if (response) {
                        if (response.emailverification) {
                            displayEmail.style.color = "greenyellow";
                            displayEmail.innerHTML = "";
                            displayEmail.classList.remove("email-pris");
                            displayEmail.classList.add("email-disponible");
                            displayEmail.style.display = "block";
                            mailverification=true;
                        } else {
                            displayEmail.style.color = "red";
                            displayEmail.innerHTML = "Cet email appartient à un utilisateur";
                            displayEmail.classList.remove("email-disponible");
                            displayEmail.classList.add("email-pris");
                            displayEmail.style.display = "block";
                            mailverification=false;
                        }
                    }
                }
            };
            xhr.send("email=" + varemail);
        } else {
            displayEmail.innerHTML = "";
        }
    }

    emailInput.addEventListener("input", verifyEmail);


    function toggleSubmitButton() {
        var log = loginInput.value;
        var password = passwordInput.value;
        var varemail = emailInput.value;
        var nom = nomInput.value;
        var prenom = prenomInput.value;;
        

        // Vérifier les champs avant de réactiver/désactiver le bouton
        var log = loginInput.value;
        var password = passwordInput.value;
        var varemail = emailInput.value;
        var nom = nomInput.value;
        var prenom = prenomInput.value;
    
        if (prenom === "" || nom === "" || log === "" || password === "" || varemail === "") {
            enregistrer.setAttribute("disabled", "");
        } else {
            if (!loginverification || !mailverification) {
                enregistrer.setAttribute("disabled", "");
            }
            else{
                enregistrer.removeAttribute("disabled", "");
            }
        }
    }

    loginInput.addEventListener("input", toggleSubmitButton);
    passwordInput.addEventListener("input", toggleSubmitButton);
    emailInput.addEventListener("input", toggleSubmitButton);
    prenomInput.addEventListener("input", toggleSubmitButton);
    nomInput.addEventListener("input", toggleSubmitButton);



    /*Numéro */
    const phoneInputField = document.querySelector("#téléphone");
    const phoneInput = window.intlTelInput(phoneInputField, {
    /*
    Parametre lors de l'utilisation ip 
    initialCountry:"auto",
    geoIpLookup:getIp,*/
    preferredCountries:["sn","us","fr"],
    utilsScript:"https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
});
// Accéder à l'élément de l'image avec son ID

// Changer la source de l'image
var imgdisplay = document.getElementById("image");
var isPhoneNumberValid = false;

function verification(event) {
    event.preventDefault();

    const phoneNumber = phoneInput.getNumber();
    /*La fonction getNumber() permet d'avoir le numéro dans les normes internationaux*/

    if (phoneNumber.startsWith("+")) {
        imgdisplay.setAttribute("src","../img/Vrai.png");
    } 
    else {
        imgdisplay.setAttribute("src","../img/Faux.png");
        isPhoneNumberValid = false;
    }
}

