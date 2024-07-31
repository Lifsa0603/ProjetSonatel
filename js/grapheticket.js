function generateGraph(container, TraitementValue, validationValue) {
    var ticket=[TraitementValue,validationValue]
    var xArray = ["Traitement:"+TraitementValue, "Validation:"+validationValue];
    var yArray = [TraitementValue, validationValue];
    var total =TraitementValue+validationValue
    var layout = {
        title: {
            x: 0.015, // Position horizontale du titre (0 = à gauche, 1 = à droite, 0.5 = au centre)
            y: 0.9,// Position verticale du titre (0 = en bas, 1 = en haut, 0.5 = au milieu)
            text: "Tickets",
            font: {
                size: 24, // Taille de la police du titre
                color: 'white' // Couleur de la police du titre
            }
        },
        showlegend: true,
        legend: {
            x: -1, // Ajuster la position horizontale de la légende
            y: -4,  // Ajuster la position verticale de la légende
            font: { size: 20,
                    color:"white" 
                } // Ajuster la taille de la police de la légende
        },
        paper_bgcolor: 'black', // Couleur de fond du graphique
        plot_bgcolor: 'white', // Couleur de fond du tracé
        margin: {
            t: 0, // Marge supérieure
            l: 0, // Marge gauche
            r: 0, // Marge droite
            b: 0  // Marge inférieure
        },
    };
    
    var couleur = [
        "#F90A12", // Couleur pour "Traitement"
        "#14F023" // Couleur pour "Validation"
    ];
    
    var data = [{
        labels: xArray,
        values: yArray, 
        hole: 0.7, 
        type: "pie",
        marker: {
            colors: couleur
        },
        //textinfo: "label+percent", // Afficher le label et le pourcentage
        textfont: {
            color: "white" // Changer la couleur du texte ici
        }
    }];

    const annotation = {
        x: 0.5,
        y: 0.5,
        text: total,
        showarrow: false,
        font: {
            size: 45,
            color: 'white',
            
            
        },
    };
    var config = { displayModeBar: false }; // Configuration pour désactiver la barre d'options
    
    layout.annotations = [annotation];
    Plotly.newPlot(container, data, layout,config);
}
//Receuillir les données 
$(document).ready(function() {
    $.ajax({
        url: "../RechercheBd/graphefetch.php",
        method: "POST",
        dataType: "json",
        success: function(response) {
            var Traitementvalue = response.Traitement;
            var validationValue = response.Validation;
            
            $('.graph-container').each(function(index, container) {
                generateGraph(container, parseInt(Traitementvalue), parseInt(validationValue));
            });
        },
        error: function() {
            // Gérer les erreurs
        }
    });
});
