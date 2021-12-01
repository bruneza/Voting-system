<?php
include( 'config.php' );
session_start();
$MAC = $_SERVER['REMOTE_ADDR'];
$MAC = strtok( $MAC, ' ' );
$_SESSION[ "MACIP" ] = $MAC;
$_SESSION[ "Vote" ] = new votesDB( $_SESSION[ "MACIP" ] );
$nominee = $_POST['nominee'];
$catgr = $_POST['catgr'];
//echo $_SESSION[ "Vote" ]->savevisitor($nominee,$catgr );
?>