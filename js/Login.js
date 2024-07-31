var largeurEcran = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
var hauteurEcran = window.innerHeight || document.documentElement.clientHeight || document.body.clientHeight;

var Defilementimg = document.getElementById("defilageimg");
var Defilementimg2 = document.getElementById("defilageimg2");

var img2 = ["../img/OBS2.png","../img/OBS1.png","../img/OBS3.jpg","../img/OBS4.png","../img/Orange2.png","../img/Orange3.png","../img/Technicien3.png","../img/Technicien4.png","../img/Personne.jpg"];

var img = ["../img/OBS1.png","../img/OBS2.png","../img/Orange2.png","../img/Orange3.png","../img/Technicien3.png","../img/Technicien4.png"];
var passimg=["../img/Seeeye.png","../img/Hide_eye.png"]
var index = 0;
var See=false;
var Faux=true;
var boutonmdp=document.getElementById("buttonsee");
var casemdp=document.getElementById("Password");
var caseusr=document.getElementById("username");
var boutonconnect=document.getElementById("envoyer");
var imghideorsee=document.getElementById("hideorsee");
function defilement() {
  if (index >= img.length) {
    index = 0;
  }

  Defilementimg.src = img[index];
  Defilementimg.setAttribute("class","mh-100")
  Defilementimg.style.cssText = "background-image: none;width: 100%;height: " + (hauteurEcran)*9/10 + "px;";
  index++;
}
var index2 = 0;
if (largeurEcran<992) {
  function defilement2() {

    if (index2 >= img2.length) {
      index2 = 0;
    }

    Defilementimg2.src = img[index2];
    Defilementimg2.setAttribute("class","mh-100")
    Defilementimg2.style.cssText = "background-image: none;width: 100%;height: " + (hauteurEcran)*9/10 + "px;";
    index++;
  }
}

function motdepasse() {
  See=!See;
  Faux=!Faux;
  if (See && Faux===false) {
    imghideorsee.setAttribute("src", passimg[0]);
    casemdp.setAttribute("type","text");
    imghideorsee.style.cssText = "width:35px;height:35px;";
  } else{
    imghideorsee.setAttribute("src", passimg[1]);
    casemdp.setAttribute("type","password");
    imghideorsee.style.cssText = "width:35px;height:35px;";
  }
}
function checkform(){
    if (casemdp.value==="" || caseusr.value==="") {
      boutonconnect.style.cssText="background-color: rgb(228, 194, 182);border-color: rgb(228, 194, 182);";
      boutonconnect.setAttribute("disabled", "");
                            
    }
    else{
      boutonconnect.style.cssText="background-color: rgb(244, 76, 14);border-color: rgb(244, 76, 14);";
      boutonconnect.removeAttribute("disabled","");
    }
}
let loading=document.getElementById("nombouton")
let iframe=document.getElementById("iframe")

boutonconnect.addEventListener("onclick",function(){
    loading.value="Loading"
    iframe.setAttribute("class","fa fa-circle-o-notch fa-spin")
    iframe.style.cssText="color:rgb(244, 76, 14)"
})
if (largeurEcran>=992) {
  
}
setInterval(defilement, 2000);
setInterval(defilement2)