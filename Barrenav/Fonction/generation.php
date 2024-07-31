<?php
/* */
require_once('Fpdf/fpdf.php');
function dateToFrench($date, $format) {
    $english_days = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');
    $french_days = array('Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche');
    $english_months = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
    $french_months = array('Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre');
    return str_replace($english_months, $french_months, str_replace($english_days, $french_days, date($format, strtotime($date) ) ) );
}

class PDFmodification extends FPDF
{
    private $Reference; // Propriété pour stocker la référence
    private $Typemaintenance;
    private $Idfiche;
    // Le constructeur de votre classe PDF
    public function __construct($reference,$maintenance,$id)
    {
        parent::__construct();
        $this->Reference = $reference; // Assignez la référence à la propriété de classe
        $this->Typemaintenance=$maintenance;
        $this->Idfiche=$id;
    }

    // En-tête
    function Header()
    {
        // Utilisez $this->Reference pour accéder à la référence
        $reference = $this->Reference;
        $maintenance=$this->Typemaintenance;
        $id=$this->Idfiche;
        // Le reste de votre code d'en-tête ici...

        $this->Image('../img/Orange.png',5,0,30,14);
        // Police Arial gras 15
        $this->SetAutoPageBreak(false);
        $this->SetXY(100,0);
        $this->SetFillColor(169,169,169);
        $this->Cell(112.5,30,'',1,0,'C',true);	
        $this->SetFont('Arial','',10);
        $this->SetXY(5,15);
        $this->Write(5, "Direction des Entreprises"."\n");
        $this->SetXY(5,20);
        $this->Write(5, "Immeuble Talix RUE 03 Angle B"."\n");
        $this->SetXY(5,25);
        $this->Write(5, "Point E Dakar"."\n");
        $this->SetXY(52.5,0);
        $this->Image('../img/parametres_orange.png',60,0,35,35);
        $this->SetXY(100,0);
        $this->SetFont('Arial','B',12);
        $this->MultiCell(112.5,10,iconv('UTF-8', 'windows-1252',"Type de maintenance:\nFiche Maintenance Nº:\nCase Nº:"),1,"J");
        $this->SetXY(145,0);
        $this->SetFont('Arial','',12);
        /*Type Maintenance et numéro maintenance*/
        $this->MultiCell(70,10,iconv('UTF-8', 'windows-1252',"$id\n $maintenance "),0,"J");
        $this->SetXY(120,0);
        /*Numéro Case */
        $this->Cell(90,50,$reference,0,0,'L');	
        $this->SetXY(105,32);
        $this->SetFont('Arial','BU',15);
        $this->Write(5,"Date:");
                /*Date */
            /*Conversion Date  */
            
            $dateformatted=iconv('UTF-8','windows-1252', dateToFrench("now","l j F Y"));
            // Affichez la date formatée
            $this->SetFont('Arial', '', 15);
            $this->Write(5,$dateformatted);

            // Saut de ligne
            $this->Ln(1);
    }

    function Footer()
            {
            
                $this->SetXY(5,283);
                $this->Image("../img/LOGO_SONATEL.jpeg",null,null,30,15);
                $this->Cell(30,30,'SONATEL',0,0,'L');
            }

    // Reste de votre classe PDF...
}

function generationpdf($file,$nomentreprise,$Observationclient,$Reference,$maintenance,
$idfiche,$mailentreprise,$siteclient,$telephoneclient,
$prenom,$nom,$email,$telephone,$signature,$arrivee,$depart,$duree){  
  // Instanciation de la classe d�riv�e
  $pdf = new PDFmodification($Reference,$idfiche,$maintenance);
  $pdf->SetAutoPageBreak(false); // Désactivez l'ajout automatique de nouvelles pages
  $pdf->AddPage();
  /*Info Client */
  $pdf->SetXY(5,40);
  $pdf->SetFillColor(169,169,169);
  $pdf->Cell(90,10,'',1,0,'C',true);
  $pdf->SetXY(5,40);
  $pdf->SetFont('Arial','',12);
  $pdf->MultiCell(90,10,iconv('UTF-8','windows-1252',"Informations sur le Client\nClient:$nomentreprise\nAdresse:$siteclient\nTel:$telephoneclient\nEmail:$mailentreprise"),1,'L');
  $hc1=$pdf->GetY();
  /*Info Agent */
  $pdf->SetXY(110,40);
  $pdf->SetFillColor(169,169,169);
  $pdf->Cell(90,10,'',1,0,'C',true);
  $pdf->SetXY(110,40);
  $pdf->MultiCell(90,10,iconv('UTF-8','windows-1252',"Informations Agent\nNom Agent:$prenom $nom\nHiérarchie:DDE/SNT/ICT/DTP/CCRS/SCS\nTel:$telephone\nEmail:$email"),1,'L');
  $hc2=$pdf->GetY();
  $hmax=max($hc1,$hc2);
  /*Fournitures*/
  $fournitures=isset($_REQUEST['fournitures']) ? $_REQUEST['fournitures'] : '';
  $pdf->SetXY(5,$hmax+2);
  $pdf->SetFillColor(169,169,169);
  $pdf->Cell(90,10,'',1,0,'C',true);
  $pdf->SetXY(5,$hmax+2);
  $pdf->SetXY(5,$hmax+2);
  $pdf->Cell(90,10,'Fournitures',1,0,'L');
  $hcontenufourniture=$pdf->GetY();
  $pdf->SetXY(5,$hcontenufourniture+10);
  $pdf->Cell(90,53,'',1,0,'L');
  $pdf->SetXY(5,$hcontenufourniture+10);
  $pdf->MultiCell(90,10,iconv('UTF-8','windows-1252',$fournitures),0,'J');
  /*Contenu Travaux Effectués */
  $travaux=isset($_REQUEST["travaux"]) ? $_REQUEST["travaux"]:'';
  $pdf->SetXY(110,$hmax+2);
  $pdf->SetFillColor(169,169,169);
  $pdf->Cell(90,10,'',1,0,'C',true);
  $pdf->SetXY(110,$hmax+2);
  $pdf->SetXY(110,$hmax+2);
  $pdf->Cell(90,10,iconv('UTF-8','windows-1252',"Travaux Effectués"),1,0,'L');
  $hcontenufourniture=$pdf->GetY();
  $pdf->SetXY(110,$hcontenufourniture+10);
  $pdf->Cell(90,53,'',1,0,'L');
  $pdf->SetXY(110,$hcontenufourniture+10);
  $pdf->MultiCell(90,10,iconv('UTF-8','windows-1252',$travaux),0,'J');
  
  /*Entretien */
  $hfinal=160;
  $pdf->SetXY(5,$hfinal+2);
  $pdf->SetFillColor(169,169,169);
  $pdf->Cell(200,10,'',1,0,'C',true);
  $pdf->SetXY(5,$hfinal+2);
  $pdf->Cell(200,10,'Entretien',1,0,'C');
  $hentretien=$pdf->GetY();
  /* Rubrique oui ou non*/
  
  $pdf->SetXY(5,$hfinal+10+2);
  $hentretien=$pdf->GetY();
  $Soufflage=isset($_REQUEST['Soufflage']) ? $_REQUEST['Soufflage'] : '';
  $Batterie=isset($_REQUEST["Batterie"]) ? $_REQUEST["Batterie"]:'........';
  $Duplication=isset($_REQUEST['Duplication']) ? $_REQUEST['Duplication'] : '';
  $Onduleur=isset($_REQUEST['Onduleur']) ? $_REQUEST['Onduleur'] : '';
  $Carte_Alarme=isset($_REQUEST['Carte_Alarme']) ? $_REQUEST['Carte_Alarme'] : '';
  $Sauvegarde=isset($_REQUEST['Sauvegarde']) ? $_REQUEST['Sauvegarde'] : '';
  $Caseentretien=["Soufflage Du Pabx"=>$Soufflage,
                  "Vérification Valeur Tension batterie"=>$Batterie."Volt",
                  "Test Duplication"=>$Duplication,
                  "Présence Onduleur"=>$Onduleur,
                  "Contrôle Carte Alarme"=>$Carte_Alarme,
                  "Sauvegarde Du Système"=>$Sauvegarde
              ];
  $i=0;
  foreach ($Caseentretien as $key => $value) {
      $pdf->SetX(5); 
      $pdf->MultiCell(105,10,iconv('UTF-8','windows-1252',"$key\n"),1,'L');
      $pdf->Text(75,$hentretien+($i+1)*10-4,$value);
      $i=$i+1;
  }
  
  /*Autre Rubrique */
  $pdf->SetXY(110,$hentretien);
  $pdf->SetFillColor(169,169,169);
  $pdf->Cell(95,10,'',1,0,'C',true);
  $pdf->SetXY(110,$hentretien);
  /*Poste TDM/IP */
  $pdf->Cell(95,10,'Entretien Poste TDM/IP',1,0,'C');
  $hentretien=$pdf->GetY();
  $pdf->SetXY(110,$hentretien+10);
  /*Champs tdm */
  $pdf->MultiCell(95,5,iconv('UTF-8','windows-1252',"1.\n2.\n3.\n4.\n"),1,'L');
  
  /*Entretien Réseau lan switch */
  $hentretien=$pdf->GetY();
  $pdf->SetXY(110,$hentretien);
  
  
  $pdf->SetFillColor(169,169,169);
  $pdf->Cell(95,10,'',1,0,'C',true);
  $pdf->SetXY(110,$hentretien);
  /*Poste TDM/IP */
  $pdf->Cell(95,10,iconv('UTF-8','windows-1252',"Entretien Réseau Lan Switching"),1,0,'C');
  $hentretien=$pdf->GetY();
  $pdf->SetXY(110,$hentretien+10);
  /*Champs Entretien Réseau Lan Switching */
  $pdf->MultiCell(95,5,iconv('UTF-8','windows-1252',"1.\n2.\n3.\n4.\n"),1,'L');
  /*Entete Observation */
  $hfin=$pdf->GetY();
  $hnote=$hfin;
  $pdf->SetXY(5,$hfin);
  $pdf->SetFillColor(169,169,169);
  $pdf->Cell(60,5,'Observation Client',1,0,'C',true);
  /* Entete Note */
  $pdf->SetFont('Arial','B',15);
  $pdf->SetXY(97,$hfin);
  $pdf->Cell(60,5,iconv('UTF-8','windows-1252',"Note"),0,0,'L');
  $pdf->SetXY(90,$hfin+5);
  /*Nbre d'etoile */
  $etoile=isset($_REQUEST["nbreetoile"]) ? $_REQUEST['nbreetoile']:0;
  
  if ($etoile>=1 && $etoile<=2) {
      $r=255;
      $g=$b=0;
  }
  else if($etoile==3){
      $r=255;
      $g=255;
      $b=0;
  }
  else if($etoile==4 || $etoile==5 ){
      $g=102;
      $r=0;
      $b=0;
  }
  else{
      $r=0;
      $g=0;
      $b=0;
  }
  for ($i=0; $i <=5 ; $i++) {
      /*Contenu Note 1 */ 
      if ($etoile==$i) {
          $cheminimage="../Creation/Note$i.png";
          $pdf->Image($cheminimage,null,null,30,15);
          break;
      }
  }
  /*Entete Signature Client */
  $pdf->SetFont('Arial','BU',15);
  $pdf->Text(150,$hfin+4,"Signature Client:");
  
  /*Contenu Signature */
  $pdf->SetXY(150,$hfin+6);
  $path="imgsignature/img.png";
  $pdf->Image($path,null,null,50,20);
  
  /*Contenu note 2 */
  $pdf->SetFont('Arial','B',15);
  $pdf->SetXY(90,$hfin+15+5+1);
  $pdf->SetFillColor(169,169,169);
  $pdf->SetTextColor($r,$g,$b);
  if ($etoile>=1 && $etoile<=5) {
      $pdf->Cell(35,5,$etoile."/5",1,0,'C',true);
  }
  else{
      $pdf->Cell(35,5,"/5",1,0,'C',true);
  }
  $pdf->SetFont('Arial','',12);
  $pdf->SetXY(5,$hfin+5);
  $pdf->SetTextColor(0,0,0);
  
  /*Contenu Observation client */
  $observation=iconv('UTF-8','windows-1252',$Observationclient);
  $pdf->MultiCell(60,5,$observation,1,"L");
  
  /*Durée 
  heure arrivée et départ */
  $hfin=$pdf->GetY();
  $pdf->SetXY(65,$hfin+3);

/*Arret */
  $hfin=$pdf->GetY();
  $pdf->SetXY(5,$hfin+3);
  $pdf->MultiCell(75,5,iconv('UTF-8','windows-1252',".Durée Travail:$duree\n.Heure d'arrivée:$arrivee\n.Heure de départ:$depart"),0,'L');
  $pdf->Output('F',"$file.pdf");
  //$_SESSION['pdf']=$nomentreprise.'.pdf';
}

?>