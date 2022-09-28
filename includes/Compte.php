<?php
require('fpdf/fpdf.php');
class Compte {

    public $proprietaire="" ;
    public $type ="";
    public $solde= 0;
    public $message="";
    public $operations=array();

    public function __construct($proprietaire,$type){
        //$this->id = time.now();
        $this->proprietaire = $proprietaire;
        $this->type = $type;
        $message=" Bonjour , Le compte de ".$proprietaire ." a été crée avec succés .</br>";
        array_push($this->operations, " Creation du compte") ;
        echo($message);
        
        
    }

    public function depot($montant){
        
         if($montant>0){
         $this->solde += $montant ;
         $message=(" Bonjour " . $this->proprietaire . " Votre Operation de depôt de ". $montant ." a été effectuée avec succés , Votre solde restant est ".$this->solde ."</br>") ;
         array_push($this->operations, " Operation de depot :"."$montant"." dinars ");
         print("$message". "</br> ") ;
          
        } else print(" Bonjour " . $this->proprietaire ." Attention , Merci de verifier le Montant que vous souhaitez deposer .</br> ");
          
    }


    public function retrait($montant){
        $tab= array();
        $this->solde -= $montant ;
        $message= ("Bonjour " . $this->proprietaire . " Votre Operation de retrait de ". $montant. " a été effectuée avec succés , Votre solde restant est " . $this->solde .".</br>") ;
        array_push($this->operations, " Operation de Retrait :"."$montant"." dinars ");
        print("$message". "</br> ") ;
        print("$message". " ") ;
    }

    public function virement($montant,$cible){
        $tab= array();
        if ($this->solde > $montant){
            $this->solde -=$montant;
            $cible->solde += $montant;
            $message ="Bonjour " . $this->proprietaire ." Votre virement de ". $montant ." a été effectué vers le compte de " . $cible->proprietaire .".</br>" ;
            print $message ;
            array_push($this->operations, " Virement de :"."$montant"." dinars  à ".$cible->proprietaire);
            print("$message". "</br> ") ;
        } else print "Bonjour " . $this->proprietaire ." Attention , Votre solde ne vous permet pas d'effectuer cette action ."; 
        
    }

public function getExtrait(){
        for ($i=0 ; $i<count($this->operations);$i++){
            print($this->operations[$i]);
            
        } return($this->operations);
    }



public function printExtrait(){
       echo " </br> Extrait sous format pdf est en cours de generation .</br> ";
       
         $pdf = new FPDF();
         $pdf->AddPage();
         $pdf->Image('includes/images/logo.png',120,5,75);
         $pdf->Line(0,0,20,20);
         $pdf->Line(20,20,200,20);
         $pdf->SetTextColor(0, 55, 140);
         $pdf->SetFont('Arial','B',12);
         $pdf->Cell(80,40,utf8_decode("Extrait Bancaire : "));
         $pdf->Ln(10);
         $pdf->Cell(10,40,utf8_decode("Propriétaire : "."$this->proprietaire"));
         $pdf->Ln(50);
         for($i=0;$i<count($this->operations);$i++){
            $content=$this->operations[$i];
            $pdf->Cell(20,40,utf8_decode("$i" ."-"." "."$content"));
            $pdf->Ln(10);
        }
        $pdf->Ln(50);
        $pdf->Cell(120,5,utf8_decode("Solde restant  : " .$this->solde . " dinars "));
            $pdf->PageNo(1);
         $pdf->Output("F","Extrait"."$this->proprietaire"."."."pdf");
        


}


}
?>



