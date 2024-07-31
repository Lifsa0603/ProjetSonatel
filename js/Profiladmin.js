let barrenav=document.getElementById("barrenav")
let menutoggle = document.querySelector('.divtoggle');
let openclose=document.getElementById("menuacceuil")
openclose.onclick=function(){
    if (openclose.classList.contains('fa-bars')) {
        // Réinitialisation : supprimer la classe ajoutée et ajouter la classe d'origine
        openclose.setAttribute('class', 'fa-sharp fa-solid fa-xmark fa-2xl');
        barrenav.style.cssText="width:40%;z-index:3;overflow-x:visible;";
        if (largeurEcran>=552) {
            barrenav.style.cssText="width:40%;z-index:3;overflow-x:visible;";
        }
        else{
            barrenav.style.cssText="width:70%;z-index:3;overflow-x:visible;";
        }

        } else{
        // Ajouter la classe pour la nouvelle apparence
        openclose.setAttribute('class', 'fa-solid fa-bars fa-2xl');
        barrenav.style.cssText="width:60px;z-index:3;overflow-x:hidden;";
        }
}



let menuItems = document.querySelectorAll('.navigation ul li.list a');  
barrenav.addEventListener('mouseenter', function() {
    openclose.setAttribute('class', 'fa-solid fa-xmark fa-2xl');
    barrenav.style.cssText = "width: 40%;z-index:3; overflow-x: visible;";
});

barrenav.addEventListener('mouseleave', function() {
        openclose.setAttribute('class', 'fa-solid fa-bars fa-2xl');
        barrenav.style.cssText = "width: 60px;z-index:3; overflow-x: hidden;";
});

for (let i = 0; i < menuItems.length; i++) {
    menuItems[i].addEventListener('click', function() {
        for (let j = 0; j < menuItems.length; j++) {
            menuItems[j].classList.remove('active');
        }
        this.classList.add('active');
        openclose.setAttribute('class', 'fa-solid fa-bars fa-2xl');
        barrenav.style.cssText="width:60px;z-index:3;overflow-x:hidden;";
        this.style.cssText="background:antiquewhite;"
    });
    menuItems[i].addEventListener('mouseover', function() {
        openclose.setAttribute('class', 'fa-solid fa-xmark fa-2xl');
        if (largeurEcran>=552) {
            barrenav.style.cssText="width:40%;z-index:3;overflow-x:visible;";
        }
        else{
            barrenav.style.cssText="width:70%;z-index:3;overflow-x:visible;";
        }
    });
    menuItems[i].addEventListener('mouseout', function() {
        openclose.setAttribute('class', 'fa-solid fa-bars fa-2xl');
        barrenav.style.cssText="width:60px;z-index:3;overflow-x:hidden";
    });
}
    
// Obtenez le chemin de la page actuelle
var path = window.location.pathname;

// Sélectionnez tous les liens de la barre de navigation
var navLinks = document.querySelectorAll('.navigation ul li.list a');
let ajouter=document.getElementById("Ajouter")


// Parcourez tous les liens
for (var i = 0; i < navLinks.length; i++) {
    var link = navLinks[i];

    // Vérifiez si le chemin correspond au lien
    if (path.includes(link.getAttribute('href'))) {
        // Ajoutez la classe "active" à l'élément parent du lien
        link.parentElement.classList.add('active');
        openclose.setAttribute('class', 'fa-solid fa-bars fa-2xl');
        barrenav.style.cssText="width:60px;z-index:3;overflow-x:hidden";
        break;
    }
}

var largeurEcran = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
var hauteurEcran = window.innerHeight || document.documentElement.clientHeight || document.body.clientHeight;
let largeurecransur2=largeurEcran/2
let hauteurEcransur2=hauteurEcran/2
let ecrit=document.querySelector(".imagetext-fit")
let texticon=document.querySelectorAll(".title") 
let texthistorique=document.getElementById("historiquetitle")

if (largeurEcran>300 && largeurEcran<=400) {
    for (let index = 0; index < texticon.length; index++) {
        texticon[index].style.cssText="font-size:5px"
    }    
}
if (largeurEcran>400 && largeurEcran<=500) {
    texthistorique.style.cssText="font-size:13px"        
}
