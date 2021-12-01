<?php
include( 'config.php' );
session_start();
$MAC = $_SERVER['REMOTE_ADDR'];
$MAC = strtok( $MAC, ' ' );
$_SESSION[ "MACIP" ] = $MAC;
$_SESSION[ "Vote" ] = new votesDB( $_SESSION[ "MACIP" ] );
//echo $_SESSION[ "Vote" ]->savevisitor('20201201', 'muscat_001_bma' );
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>ISANGO NA MUZIKA AWARDS 2020</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css"></script>
  <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
<link href="ressources/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="ressources/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="ressources/css/styles.css?t=2" rel="stylesheet" type="text/css">
  <style>.sv{padding: 0 15px;}.card{margin-bottom: 5px;}
  @media screen and (max-width: 600px) {
.hidden-xs{display:none;}
	  .col, .col-1, .col-10, .col-11, .col-12, .col-2, .col-3, .col-4, .col-5, .col-6, .col-7, .col-8, .col-9, .col-auto, .col-lg, .col-lg-1, .col-lg-10, .col-lg-11, .col-lg-12, .col-lg-2, .col-lg-3, .col-lg-4, .col-lg-5, .col-lg-6, .col-lg-7, .col-lg-8, .col-lg-9, .col-lg-auto, .col-md, .col-md-1, .col-md-10, .col-md-11, .col-md-12, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-md-auto, .col-sm, .col-sm-1, .col-sm-10, .col-sm-11, .col-sm-12, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-sm-auto, .col-xl, .col-xl-1, .col-xl-10, .col-xl-11, .col-xl-12, .col-xl-2, .col-xl-3, .col-xl-4, .col-xl-5, .col-xl-6, .col-xl-7, .col-xl-8, .col-xl-9, .col-xl-auto {
    padding-right: 5px;
    padding-left: 5px;
}.container {
    padding-right: 5px;
    padding-left: 5px;
}
}</style>
</head>
<body class="body">
<div class="page-wrap container-fluid"> 
  
  <!--    Header content-->
  <header class="top-header container" role="banner" >
    <div class="row">
      <div class="col-md-2 hidden-xs logo-col"> <img src="images/isango-logo.jpg" class="img-fluid isango-logo" alt="isango star"> </div>
      <div class="col-md-8 welcome-message">
        <h4 class="welcome-pre">
        <p>Online Voting Page for</p>
         
        <h1 class="welcome-title black-title" >ISANGO NA MUZIKA AWARDS 2020</h1>
      </div>
      <div class="col-md-2 hidden-xs logo-col"> <img src="images/IGIHE Logo.jpg" class="img-fluid igihe-logo" alt="Placeholder image"> </div>
    </div>
  </header>
  <!--    Body Content-->
  <div class="body-content"> 
    <!--      Slider content-->
    <section class="slider-section container no-padding hidden-xs ">
      <div class="slide-header align-middle">
        <h2 class="black-title">Nominees</h2>
        <h4>ISANGO NA MUZIKA AWARDS</h4>
      </div>
    </section>
    <!--    Muzika Nominees-->
    <section class="muzika-section nominees-section"> 
      <!--        Muzika Nominees Breadcrumb -->
      <div class=" breadcrumb-row container no-padding">
        <ol class="breadcrumb breadcrumb-style1">
          <li class="breadcrumb-item muzika-title black-title ">MUZIKA</li>
          <li class="breadcrumb-item active muzika-sub" aria-current="page">Nominees</li>
        </ol>
      </div>
      <!--    Muzika Nominees List     -->
      <div class="nominees-list-row container">
        <div class="row margin-row">
          <?php
          foreach ( $categories->getinfo( 'music', 1 ) as $key => $value ) {
            ?>
          <div class="col-md-4 nominees-col">
            <div class="card">
              <div class="card-header">
                <h3><?php echo $value;?></h3>
              </div>
              <ul class="nominees-list">
                <?php
                $nomineesinfo = $nominees->getinfo( $key, 1 );
                foreach ( $nomineesinfo as $nkey => $nvalue ) {
					$votes = $nominees->getinfo($key,5);
          $artCode = "isango".$nominees->getinfo($key,3)[$nkey].$nominees->getinfo($key,4)[$nkey];
                  ?>
                <li class="nominees-list-item">
                  <div class="artist-image"> <img class="card-img-top rounded-circle" src="images/<?php  echo $artCode;  ?>.jpg" alt="Card image cap"> </div>
                  <div class="artist-vote">
                    <p class="card-title">
                      <?php  echo $nvalue;  ?>
                    </p>
                    <a href="#" name ="vote" class="btn btn-primary vote nomine#<?php  echo $nkey .'#'.$key;  ?>">vote</a><span class="sv votes_<?php  echo $nkey;  ?>"><?php  echo $votes[$nkey];  ?></span><br><span class="message_<?php  echo $nkey;?>"></span> </div>
                </li>
                <?php  }?>
              </ul>
            </div>
          </div>
          <?php  }?>
        </div>
      </div>
    </section>
    <!--    Movie Nominees-->
    <section class="Cinema-section  nominees-section"> 
      <!--        Cinema Nominees Breadcrumb -->
      <div class=" breadcrumb-row container no-padding">
        <ol class="breadcrumb breadcrumb-style1">
          <li class="breadcrumb-item breadcrumb-title black-title ">CINEMA</li>
          <li class="breadcrumb-item active breadcrumb-sub" aria-current="page">Nominees</li>
        </ol>
      </div>
      <!--    Cinema Nominees List    -->
      <div class="nominees-list-row container">
        <div class="row margin-row">
          <div class="col-md-3  ads-col">
            <div class="my-ads ">
              <img class="card-img-top" src="images/Web-Banners-500x250Px.png" alt="Card image cap">
            </div>
          </div>
          <?php
          foreach ( $categories->getinfo( 'movie', 1 ) as $key => $value ) {
            ?>
          <div class="col-md-3 nominees-col">
            <div class="card">
              <div class="card-header">
                <h3><?php echo $value;?></h3>
              </div>
              <ul class="nominees-list">
                <?php foreach($nominees->getinfo($key,1) as $nkey => $nvalue){ 
				
				$votes = $nominees->getinfo($key,5);
          $artCode = "isango".$nominees->getinfo($key,3)[$nkey].$nominees->getinfo($key,4)[$nkey];
                  ?>
                <li class="nominees-list-item">
                  <div class="artist-image"> <img class="card-img-top rounded-circle" src="images/<?php  echo $artCode;  ?>.jpg" alt="Card image cap"> </div>
                  <div class="artist-vote">
                    <p class="card-title">
                      <?php  echo $nvalue;  ?>
                    </p>
                    <a href="#" name ="vote" class="btn btn-primary vote nomine#<?php  echo $nkey .'#'.$key;  ?>">vote</a> <span class="sv votes_<?php  echo $nkey;  ?>"><?php  echo $votes[$nkey];  ?></span><br><span class="message_<?php  echo $nkey;?>"></span></div>
                    <?php
//                      if (isset($_GET['vote']))
//                    echo $_SESSION[ "Vote" ]->savevisitor( $nvalue, $value );
                    ?>
                </li>
                <?php  }?>
              </ul>
            </div>
          </div>
          <?php  }?>
          <!-- <div class="col-md-3  empty-ads-col"></div> -->
          <div class="col-md-3  ads-col">
            <div class="my-ads "> 
              <img class="card-img-top" src="images/Web-Banners-500x250Px-Inoventyk.png" alt="Card image cap">
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <!--    footer -->
  <footer class="page-footer container" role="content"ooter class="page-footer container" role="content">
  <!--    Top FOOTER-->
  <div class=" top-footer">
    <div class="row"> 
      <!-- CONTACT column -->
      <div class="footer-col footer-contact col-md-4 col-lg-4">
        <h6 class="text-uppercase font-weight-bold footer-title">CONTACT US</h6>
        <!--       COntact Info-->
        <ul class="contact-info ">
          <li class="contact-info contact-address"> <i class="fa fa-home"></i>Head Office Isangostar Nyarugenge Market 1 st floor </li>
          <li class="contact-info contact-phone"> <i class="fa fa-phone"></i><a href="tel:0788693330"> 0788693330 - FINANCE</a> </li>
          <li class="contact-info contact-phone"> <i class="fa fa-phone"></i><a href="tel:0789773438"> 0789773438 - Administration</a> </li>
          <li class="contact-info contact-phone"> <i class="fa fa-phone"></i><a href="tel:0788287900"> 0788287900 - Chief Editor</a> </li>
          <li class="contact-info contact-email"> <i class="fa fa-envelope"></i><a href="mailto:0788287900"> info@isangostar.rw</a> </li>
        </ul>
      </div>
      <!-- SERVICES column -->
      <div class="footer-col footer-services col-md-4 col-lg-4">
        <h6 class="text-uppercase font-weight-bold footer-title">SERVICES</h6>
        <ul class="footer-service-list">
          <li> <a href="#">Production</a> </li>
          <li> <a href="#">Radio & TV Broadcasting </a> </li>
          <li> <a href="#">Supply</a> </li>
        </ul>
      </div>
      <!-- SOCIAL MEDIA -->
      <div class="footer-col footer-social col-md-4 col-lg-4"> 
        <!-- Links -->
        <h6 class="text-uppercase font-weight-bold footer-title">SOCIAL MEDIA</h6>
        <ul class="footer-social-list">
          <li> <i class="fa fa-twitter"></i><a href="https://twitter.com/igihe">Twitter</a></li>
          <li> <i class="fa fa-facebook"></i><a href="https://facebook.com/igihe">Facebook</a></li>
          <li> <i class="fa fa-instagram"></i><a href="https://instagram.com/igiheofficial">Instagram</a></li>
          <li> <i class="fa fa-youtube"></i><a href="https://youtube.com/igihe">Youtube</a></li>
        </ul>
      </div>
    </div>
  </div>
  </footer>
  <!-- Copyright -->
  <div class="footer-copyright text-center py-3">Copyright © 2020 <a href="https://isangostar.rw">isangostar.rw</a> </div>
  <!-- Copyright --> 
</div>
<script>$(document).ready(function(){$('.vote').click(function(dsds){dsds.preventDefault();$class_names = $(this).attr('class');$classcliked = $class_names.split(' ')[3];$id_cliked = $classcliked.split('#')[1]; $cat_cliked = $classcliked.split('#')[2]; $totvote = $('.votes_'+$id_cliked).html(); $('.votes_'+$id_cliked).html('...');$.post('premium.php', {nominee:$id_cliked,catgr:$cat_cliked},function(data){if(data == 'Watoye'){$('.votes_'+$id_cliked).html($totvote);$('.message_'+$id_cliked).html('Watoye');}else{$('.votes_'+$id_cliked).html(data);$('.message_'+$id_cliked).html('Urakoze gutora');}},'html');});});</script>
</body>
</html>
