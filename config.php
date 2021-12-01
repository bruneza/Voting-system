<?php
include("controller/db.php");
include 'controller/nomController.php';
include 'controller/catController.php';
include 'controller/voteController.php';
// $ip='105.179.5.146';
$nominees = new nomController();
$categories = new catController();
$voteCon = new voteController('105.179.5.146','2021112527','movcat_001_ba');