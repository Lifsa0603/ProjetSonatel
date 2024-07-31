/*
Maintenant, concentrons-nous sur la deuxième partie : 
menutoggle.classList.toggle('active'). classList est une propriété de l'objet Element qui permet 
d'accéder à la liste des classes d'un élément HTML. Cette propriété fournit des méthodes pour ajouter, 
supprimer et vérifier les classes sur l'élément.

Dans ce cas, la méthode toggle() est utilisée. Lorsqu'elle est appelée avec un seul 
argument, elle ajoute la classe spécifiée à l'élément s'il ne la possède pas déjà, 
ou la supprime s'il l'a déjà. Ainsi, si l'élément référencé par menutoggle possède 
la classe "active", la méthode toggle() la supprimera. Si l'élément ne possède pas
la classe "active", elle sera ajoutée.

En résumé, cette syntaxe permet de basculer l'état de la classe "active" 
sur l'élément référencé par menutoggle. Cela peut être utile pour appliquer 
des styles ou déclencher des comportements spécifiques en fonction de la présence 
ou de l'absence de la classe "active".
*/
let barrenav=document.getElementById("barrenav")
let menutoggle = document.querySelector('.divtoggle');
/*menutoggle.onclick = function() {
menutoggle.classList.add('active');
};*/
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

/*Sous Menu Fiche Maintenance */
let fichemaintenance=document.getElementById("maintenanceli")
var submenuLinks = document.querySelectorAll('.sousmenumaintenance a');
let menumaintenance=document.getElementById("menumaintenance")
/*Cliquer */
fichemaintenance.addEventListener('click',function(){
    for (let j = 0; j < menuItems.length; j++) {
        menuItems[j].classList.remove('active');
    }
    openclose.setAttribute('class', 'fa-solid fa-bars fa-2xl');
    barrenav.style.cssText="width:60px;z-index:3;overflow-x:hidden;";
    fichemaintenance.style.cssText="background:antiquewhite;color:black"
    sousmenumaintenance.style.cssText="display:align-items"
})
let quitte=false

let isMouseSupported = ("onmouseenter" in document.documentElement);
/*Verification pour savoir si l'appareil a une souris pour
les evenement mouseover et mouseout */


if (isMouseSupported) {
    
    /*Souris PLace sur Fiche Maintenance*/
    fichemaintenance.addEventListener('mouseover', function() {
        openclose.setAttribute('class', 'fa-solid fa-xmark fa-2xl');
        if (largeurEcran>=552) {
            barrenav.style.cssText="width:40%;z-index:3;overflow-x:hidden;";
        }
        else{
            barrenav.style.cssText="width:70%;z-index:3;overflow-x:hidden;";
        }
        fichemaintenance.style.cssText="background:antiquewhite;color:black"
        menumaintenance.style.cssText="display:align-items"
        quitte=false
    });
    /*Souris deplacer sur Fiche maintenance */
    fichemaintenance.addEventListener('mouseout', function() {
        /*2possibilités soit il va sur le sous menu soit il va dans les rubrique menus */
        // Donc il va soit se placer sur le sous menu d'ou mouveover soit quitter 
        // et aller vers le haut mouseout
        
        menumaintenance.addEventListener('mouseover', function() {
            menumaintenance.style.cssText="display:align-items"
            fichemaintenance.style.cssText="background:antiquewhite;color:black"
            quitte=false
        });

        menumaintenance.addEventListener('mouseout', function() {
            menumaintenance.style.cssText="display:none"
            fichemaintenance.style.cssText="background:transparent;color:white"
            quitte=true
        });
        if (!(path.includes(fichemaintenance.getAttribute('href')))) {
            if (!quitte) {
            menumaintenance.style.cssText="display:none"
            fichemaintenance.style.cssText="background:transparent;color:white"
            }
            else{
                menumaintenance.style.cssText="display:align-items"
                fichemaintenance.style.cssText="background:antiquewhite;color:black"
            }
        }
    });

    /*Quand on clique sur fiche maintenance */

    fichemaintenance.addEventListener('click', function() {
        openclose.setAttribute('class', 'fa-solid fa-xmark fa-2xl');
        if (largeurEcran>=552) {
            barrenav.style.cssText="width:40%;z-index:3;overflow-x:visible;";
        }
        else{
            barrenav.style.cssText="width:70%;z-index:3;overflow-x:visible;";
        }
        fichemaintenance.style.cssText="background:antiquewhite;color:black"
        menumaintenance.style.cssText="display:align-items"
    });
    // Vérifiez si le chemin correspond au lien
    if (path.includes(fichemaintenance.getAttribute('href'))) {
        // Ajoutez la classe "active" à l'élément parent du lien
        openclose.setAttribute('class', 'fa-solid fa-xmark fa-2xl');
        if (largeurEcran>=552) {
            barrenav.style.cssText="width:40%;z-index:3;overflow-x:visible;";
        }
        else{
            barrenav.style.cssText="width:70%;z-index:3;overflow-x:visible;";
        }
        fichemaintenance.style.cssText="background:antiquewhite;color:black"
        menumaintenance.style.cssText="display:align-items"
        fichemaintenance.addEventListener('mouseout', function() {
            openclose.setAttribute('class', 'fa-solid fa-xmark fa-2xl');
            if (largeurEcran>=552) {
                barrenav.style.cssText="width:40%;z-index:3;overflow-x:visible;";
            }
            else{
                barrenav.style.cssText="width:70%;z-index:3;overflow-x:visible;";
            }
            fichemaintenance.style.cssText="background-color:antiquewhite;color:black"
            menumaintenance.style.cssText="display:align-items"
        });

        fichemaintenance.addEventListener('mouseover', function() {
            openclose.setAttribute('class', 'fa-solid fa-xmark fa-2xl');
            barrenav.style.cssText="width:40%;z-index:3;overflow-x:visible";    
            fichemaintenance.style.cssText="background-color:antiquewhite;color:black"
            menumaintenance.style.cssText="display:align-items"
        });


        fichemaintenance.addEventListener('click', function() {
            openclose.setAttribute('class', 'fa-solid fa-xmark fa-2xl');
            if (largeurEcran>=552) {
                barrenav.style.cssText="width:40%;z-index:3;overflow-x:visible;";
            }
            else{
                barrenav.style.cssText="width:70%;z-index:3;overflow-x:visible;";
            }  
            fichemaintenance.style.cssText="background-color:antiquewhite;color:black"
            menumaintenance.style.cssText="display:align-items"
        });
    }
    // Gestionnaire d'événements pour les liens du sous-menu
    /*if (path.includes(ajouter.getAttribute('href'))) {
        // Ajoutez la classe "active" à l'élément parent du lien
        openclose.setAttribute('class', 'fa-solid fa-xmark fa-2xl');
        barrenav.style.cssText="width:40%;z-index:3;overflow-x:hidden";
        menumaintenance.style.cssText="display:align-items"
        ajouter.style.cssText="background:antiquewhite;color:black"
    }*/
    for (var i = 0; i < submenuLinks.length; i++) {
        var link = submenuLinks[i];
    
        // Vérifiez si le chemin correspond au lien
        if (path.includes(link.getAttribute('href'))) {
            // Ajoutez la classe "active" à l'élément parent du lien
            link.parentElement.classList.add('active');
            openclose.setAttribute('class', 'fa-solid fa-bars fa-2xl');
            barrenav.style.cssText="width:60px;z-index:3;overflow-x:hidden";
            menumaintenance.style.cssText="display:align-items"
            link.style.cssText="color:black";
            break;
        }

        submenuLinks[i].addEventListener('click',function(){
            openclose.setAttribute('class', 'fa-solid fa-bars fa-2xl');
            barrenav.style.cssText="width:60px;z-index:3;overflow-x:hidden";
        });
        submenuLinks[i].addEventListener('mouseover',function(){
            openclose.setAttribute('class', 'fa-solid fa-xmark fa-2xl');
            if (largeurEcran>=552) {
                barrenav.style.cssText="width:40%;z-index:3;overflow-x:visible;";
            }
            else{
                barrenav.style.cssText="width:70%;z-index:3;overflow-x:visible;";
            }
        });  
    }    
   
} 
    
    
    
    
else {
    //code
    /*Quand on clique sur fiche maintenance */
    fichemaintenance.addEventListener('click', function() {
        fichemaintenance.style.cssText="background:antiquewhite;color:black"
        menumaintenance.style.cssText="display:align-items"
    });

}
