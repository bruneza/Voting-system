<?php 
include("controller/nomController.php");

$dbnew = new dbConnect( 'nominees' );
$change = array('nom_votes' => '5');
$nomList = $dbnew->update($change,'2021112561');


// $insertArray= array(NULL, 'test', 'movcat_001_ba', 1, 12, 0, 0);

print_r($nomList);

 ?>