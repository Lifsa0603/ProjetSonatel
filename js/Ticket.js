let ticket=document.getElementById("ticket");
let notif=document.getElementById("ticketnotif");
ticket.onclick = function() {
    notif.style.display="none";
};  
// Obtenez le chemin de la page actuelle
var path = window.location.pathname;

// Affichez le chemin dans la console
/*console.log("Chemin actuel :", path);
if (path="/SONATEL2/Barrenav/Ticket.php") {
    notif.style.display="none";
}*/