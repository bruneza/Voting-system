<?php 
include("controller/nomController.php");

$dbnew = new nomController();

// $insertArray= array(NULL, 'test', 'movcat_001_ba', 1, 12, 0, 0);

print_r($dbnew->addNominee($insertArray));

 ?>