let nomclient =document.getElementById("nomclient")
$(document).ready(function() {
    $("#nomclient").on("input", function() {
        var selectedClient = $(this).val(); // Assurez-vous que "#nomclient
        $.ajax({
            url: "fetch_info.php",
            method: "POST",
            data: { Client: selectedClient },
            dataType: "json",
            success: function(response) {
                /*if (response && response.email) {
                    $("#emailclient").val(response.email);
                    $("#emailclient").prop("readonly", true);
                } else {
                    $("#emailclient").val("");
                    $("#emailclient").prop("readonly", false);
                }

                if (response && response.telephone) {
                    $("#numeroclient").val(response.telephone);
                    $("#numeroclient").prop("readonly", true);
                } else {
                    $("#numeroclient").val("");
                    $("#numeroclient").prop("readonly", false);
                }*/

                if (response && response.hasSites) {
                    // Le client a des sites, utiliser un select pour les afficher
                    if (response.monosite) {
                        $("#nbresiteclient").html("Un seul site est disponible pour le client:" + response.nomclient );                    
                    }
                    else{
                        $("#nbresiteclient").html("Le nombre de site est de : " + response.nbresite + " <br>Choississez le Bon Site");                    
                    }
                    $("#siteInput").hide();
                    $("#siteSelect").empty();
                    $.each(response.sites, function(index, site) {
                        $("#siteSelect").append('<option value="' + site + '">' + site + '</option>');
                    });
                    $("#nbresiteclient").show();
                    $("#siteSelect").show();
                } else {
                    // Le client n'a pas de sites, utiliser un input text pour saisir le site
                    $("#siteSelect").hide();
                    $("#nbresiteclient").hide();
                    $("#siteInput").val("");
                    $("#siteInput").show();
                }
            },
            error: function() {
                $("#emailclient").val("");
                $("#numeroclient").val("");
                $("#siteclient").empty();
            }
        });
    });
});


