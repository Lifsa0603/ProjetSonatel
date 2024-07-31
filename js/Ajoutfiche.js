let nomclient =document.getElementById("nomclient")
$(document).ready(function() {
    $("#nomclient").on("input", function() {
        var selectedClient = $(this).val(); // Assurez-vous que "#nomclient
        $.ajax({
            url: "../RechercheBd/fetch_info.php",
            method: "POST",
            data: { Client: selectedClient },
            dataType: "json",
            success: function(response) {
                if (response && response.hasSites) {
                    // Le client a des sites, utiliser un select pour les afficher
                    if (response.monosite) {
                        $("#nbresiteclient").html("Un seul site est disponible pour le client:" + response.nomclient ); 
                        $("#siteInput").hide();
                        $("#siteSelect").empty(); 
                        $("#siteSelect").append('<option value="' + response.sites + '">' + response.sites + '</option>'); 
                        $("#nbresiteclient").show();
                        $("#siteSelect").show();     
                    }
                    else{
                        $("#nbresiteclient").html("Le nombre de site est de : " + response.nbresite + " <br>Choississez le Bon Site");
                        $("#siteInput").hide();
                        $("#siteSelect").empty();
                        $.each(response.sites, function(index, site) {
                        $("#siteSelect").append('<option value="' + site + '">' + site + '</option>');
                        });
                        $("#nbresiteclient").show();
                        $("#siteSelect").show();                    
                    }
                    
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
    $("#Reference").on("input", function(){
        var NumeroRef = $(this).val();
        $.ajax({
            url: "../RechercheBd/fetch_info.php",
            method: "POST",
            data: { Ref: NumeroRef },
            dataType: "json",
            success: function(response) {
              if (response && response.result) {
                $("#nomclient").val(response.Nomclient);
                $("#nomclient").prop("readonly",true);
                $("#typemaintenance").val(response.typemaintenance);
                $("#typemaintenance").prop("readonly",true);
                $("#emailclient").val(response.emailcontact);
                $("#emailclient").prop("readonly",true);
                $("#numeroclient").val(response.telephonecontact);
                $("#numeroclient").prop("readonly",true);
                $("#siteInput").hide();
                $("#siteSelect").show();
                $("#siteSelect").empty(); 
                $("#siteSelect").append('<option value="' + response.sites + '">' + response.sites + '</option>');
              }
              else{
                    $("#emailclient").val("");
                    $("#emailclient").prop("readonly",false);
                    $("#numeroclient").val("");
                    $("#numeroclient").prop("readonly",false);

                    $("#typemaintenance").val("");
                    $("#typemaintenance").prop("readonly",false);


                    $("#nomclient").val("")
                    $("#nomclient").prop("readonly",false)
                    $("#siteSelect").hide();
                    $("#siteInput").val("");
                    $("#siteInput").show();
                }
            },
            error: function() {
                //....
            }
        });
    });
});