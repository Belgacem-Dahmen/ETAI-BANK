<?php
    include 'includes/Compte.php';

    //$kacem= New Compte("kacem","epargne");
    $hamza= New Compte("Hamza","courant");




    $hamza->depot(1200);
    $hamza->depot(1200);
    $hamza->retrait(1000);
    $hamza->retrait(1200);
    $hamza->depot(1200);
   
 //echo(count($kacem->operations));
  //echo(($kacem->operations)[1]);
    /*
  $extraitHamza = $hamza->getExtrait();
  echo(gettype($extraitHamza));
  $hamza->printExtrait()
    */

    //var_dump($hamza->operations);
     $time =time();
    
     echo($time);
    
    $hamza->printExtrait();// voir fichier dans le dossier home directory

    
?>