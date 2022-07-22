<?php
/* ****************************************************************************

        //------------------------test file-----------------------------//

 *****************************************************************************/
//$mystring = 'bonjour';

//var_dump($mystring[1]);
//$m = strtoupper($mystring[1]);

//echo $m;

//function matriculFab($nom, $prenom) :string{
    //$preMat = strtoupper($nom[0].$prenom[0]);
    //return $preMat;
//}


//echo matriculFab('bonjour', 'comment');

//$nbr = (string)rand(0, 99);
//var_dump($nbr);
//if(strlen($nbr) <3){
    //$nbr = '0'.$nbr;
    //echo $nbr;
//}else{
    //echo 'bonjour';
//}

/* function matriculFab($nom, $prenom) :string{
    $preMat = strtoupper($nom[0].$prenom[0]);
    $nbr = (string)rand(0, 999);
    if(strlen($nbr) <3){
        $nbr = '0'.$nbr;
    }
    $temps = date('H').date('i').date('s');
    $matricule = $preMat.'-'.$temps.'-'.$nbr;
    return $matricule;
}

//echo matriculFab('bonjour', 'comment');
$code = 'bonjour@2021';
$b = password_hash($code, null);
echo $b;
$c = password_verify($code, $b);
var_dump($c);
 */
/* $mot = 'mt25';
if(preg_match('#^[a-zA-Z]{2}[0-9]{3}#', $mot)){
    echo "ok";
}else{
    echo 'non';
} */



/* $b = 'lm';
//var_dump($b);
if((int)$b){
    echo 'oui';
}else{
    echo 'non';
} */

$tab = ['A', 'B', 'C', 'D', 'E', 'G', 'H', 'I', 'J', 'K'];

shuffle($tab);

var_dump($tab);

//echo $mel;