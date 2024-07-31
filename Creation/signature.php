<?php
if (isset($_POST['signature'])) {
   $data = $_POST['signature'];
   // Supprimez le préfixe "data:image/png;base64," du format de données
   $data = str_replace("data:image/png;base64,", "", $data);
   // Convertit les données en format binaire
   $data = base64_decode($data);
   // Chemin où vous souhaitez enregistrer l'image
   $filepath = "imgsignature/img.png";
   // Enregistre l'image dans le fichier
   file_put_contents($filepath, $data);
   echo "L'image de la signature a été enregistrée avec succès.";
} else {
   echo "Aucune donnée de signature n'a été reçue.";
}
?>
<!DOCTYPE html>
<html>
<head> 
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <title>The Signature</title>
   <script type="text/javascript" src="signature.js"></script>
   <style>
     body{
     padding: 15px;
     }
     #note{position:absolute;left:50px;top:35px;padding:0px;margin:0px;cursor:default;}
</style>
</head>
<body>
<h1>Digital Signature</h1>
<form method="post" action="signature.php" target="_blank" enctype="multipart/form-data">
   <div id="signature-pad">
     <div style="border:solid 1px teal; width:360px;height:110px;padding:3px;position:relative;">
        <div id="note" onmouseover="my_function();">The signature should be inside box</div>
        <canvas id="the_canvas" width="350px" height="100px"></canvas>
     </div>
     <div style="margin:10px;">
      <input type="image" src="" alt="">
        <input type="hidden" id="signature" name="signature">
        <button type="button" id="clear_btn" class="btn btn-danger" data-action="clear"><span class="glyphicon glyphicon-remove"></span> Clear</button>
        <button type="submit" id="save_btn" class="btn btn-primary" data-action="save-png"><span class="glyphicon glyphicon-ok"></span> Save as PNG</button>
     </div>
   </div>
<form>
   
<script>
var wrapper = document.getElementById("signature-pad");
var clearButton = wrapper.querySelector("[data-action=clear]");
var savePNGButton = wrapper.querySelector("[data-action=save-png]");
var canvas = wrapper.querySelector("canvas");
var el_note = document.getElementById("note");
var signaturePad;
signaturePad = new SignaturePad(canvas);
clearButton.addEventListener("click", function (event) {
   document.getElementById("note").innerHTML="The signature should be inside box";
   signaturePad.clear();
});
savePNGButton.addEventListener("click", function (event){
   if (signaturePad.isEmpty()){
     alert("Please provide signature first.");
     event.preventDefault();
   }else{
     var canvas  = document.getElementById("the_canvas");
     var dataUrl = canvas.toDataURL();
     document.getElementById("signature").value = dataUrl;
   }
});
function my_function(){
   document.getElementById("note").innerHTML="";
}
</script>
</body>
</html>