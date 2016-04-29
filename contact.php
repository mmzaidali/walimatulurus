<?php include("../kahwin/Connections/conn.php");
error_reporting(0); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Kahwin Ringkas</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <style>
    body {
    margin-top: 50px; /* Required padding for .navbar-fixed-top. Remove if using .navbar-static-top. Change if height of navigation changes. */
}

footer {
    margin: 50px 0;
}

#map-container { height: 300px }

</style>
</head>
<body>

<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
      <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="/kahwin/index.php">Walimatul Urus</a>
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
          <li class="dropdown" >
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Perkhidmatan <b class="caret"></b></a>
                  <ul class="dropdown-menu">
                      <li><a href="#katering">Katering</a></li>
                      <li><a href="#jurugambar">Jurugambar & Juruvideo</a></li>
                      <li><a href="#cenderahati">Cenderahati</a></li>
                      <li><a href="#">Butik Pengantin</a></li>
                  </ul>
          </li>
          <li>
              <a href="kursus.php">Pendaftaran Kursus</a>
          </li>
          <li>
              <a href="contact.php">Hubungi Kami</a>
          </li>
      </ul>
    </div>
  </div>
</nav>

<div class="col-md-12">
  <div class="col-md-2"></div>

  <div class="col-md-8">
    <div class="page-header">
      <h1>Tentang Kami <small>& Hubungi Kami</small></h1>
    </div>

    <div class="col-md-6">
      <h3><strong>Apa yang kami buat?</strong></h3>
      <p class="text-justify">
        Merupakan sebuah hub yang mengumpulkan semua keperluan perkahwinan anda dan 
        pengguna hanya perlu buat pilihan persediaan yang tepat dalam melangkah ke alam rumahtangga.
      </p>

      <h3><strong>Kenapa Kami buat?</strong></h3>
      <p class="text-justify">
        Walimatulurus.my ingin meringankan beban bakal-bakal pengantin dalam urusan persediaan perkahwinan dimana 
        kami ingin mewujudkan idea dimana majlis perkahwinan adalah sebuah aktiviti yang mudah untuk diselesaikan 
        dan menjadi masalah yang terakhir untuk difikirkan untuk bakal-bakal pengantin.
      </p>
    </div>

    <div id="map-container" class="col-md-6">
 
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.1.1/js/bootstrap.min.js"></script>
    <script src="http://maps.google.com/maps/api/js?sensor=false"></script>
    <script>  
 
      function init_map() {
    var var_location = new google.maps.LatLng(3.1588896,101.7045835);
 
        var var_mapoptions = {
          center: var_location,
          zoom: 17
        };
 
    var var_marker = new google.maps.Marker({
      position: var_location,
      map: var_map,
      title:"Venice"});
 
        var var_map = new google.maps.Map(document.getElementById("map-container"),
            var_mapoptions);
 
    var_marker.setMap(var_map); 
 
      }
 
      google.maps.event.addDomListener(window, 'load', init_map);
 
    </script>
    </div>

    <div class="col-md-12"> <hr> </div>

    <div class="col-md-6">
      <h3><strong>Alamat Kami</strong></h3>
      <p>
        Walimatul Urus<br>
        Mercu Summer Suites,<br>
        Jalan Cendana,  Off Jalan Sultan Ismail,<br>
        50250 Kuala Lumpur, Malaysia
      </p>
    </div>

    <div class="col-md-6">
      <h3><strong>Cara Hubungi Kami</strong></h3>
      <p>
        Email : info@walimatulurus.my<br>
        Office : 03-4920 0062
      </p>
    </div>

  </div>

  <div class="col-md-2"></div>
</div>

<!-- Footer -->
<footer>
    <div class="footer">
        <div class="col-md-12">
            <p class="text-center">All Right Reserved. Copyright &copy; Zaid & Tamimi 2016<br><a href="../kahwin/index.php">www.walimatulurus.my</a></p>
        </div>
    </div>
</footer>


</body>
</html>