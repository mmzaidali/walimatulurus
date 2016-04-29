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
</style>
</head>
<body>

<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="/kahwin/index.php">Walimatul Urus</a>
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="<?php echo $logoutAction ?>"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="col-md-12">
  <div class="col-md-1"></div>

  <div class="col-md-10">
    <div class="col-md-6">
      <div class="page-header">
        <h1>Seminar<small> Kursus Kahwin</small></h1>
      </div>

      <p><strong><h2>Apa?</h2></strong></p>
      <p class="text-justify">Kami menyediakan seminar kursus kahwin bagi memudahkan pasangan yang bakal mendirikan rumah tangga.
      Seminar ini terbuka kepada semua warga tidak mengira umur. Disamping itu, kami juga menyediakan makanan bagi
      calon seminar.</p>

      <p><strong><h2>Kenapa Kami?</h2></strong></p>
      <p class="text-justify">Kami melantik khas pakar seminar kahwin untuk menyampaikan seminar selama dua hari (Sabtu dan Ahad). Kami juga
      menyediakan tempat yang selesa yang boleh memuatkan seramai 50 calon. Ruang solat juga disediakan bagi memudahkan urusan solat.
      Kami sangat mementingkan keselesaan anda. Pada akhir seminar, Kami akan menyampaikan sijil sah kursus kahwin yang disahkan oleh Jabatan Agama Malaysia.</p>

      <p><strong><h2>Bila Beroperasi?</h2></strong></p>
      <p class="text-justify">Seminar akan beroperasi dua kali setiap bulan iaitu waktu pertama akan dilakukan pada minggu pertama dan ketiga. Pada minggu
      tersebut akan dijayakan selama dua hari iaitu Sabtu dan Ahad bermula pada pukul 9.00 pagi hingga 5.00 petang. Jadi, calon boleh memilih pada waktu yang mereka selesa dan sesuai.</p>
      <br>
    </div>

    <div class="col-md-6">
      <div class="page-header">
        <h1>Borang <small>Pra-Pendaftaran</small></h1>
      </div>

      <form method="post">
        <div class="col-md-6">
          <label>Nama Anda</label>
          <input type="text" class="form-control" name="anda" required></input><br>

          <label>No I/C Anda</label>
          <input type="text" class="form-control" name="icAnda" required></input><br>

          <label>Telefon Anda</label>
          <input type="text" class="form-control" name="fonAnda" required></input><br>

          <label>Bulan</label>
          <select class="form-control" name="bulan">
            <option value="Januari 2016">Jan 2016</option>
            <option value="Februari 2016">Feb 2016</option>
            <option value="March 2016">March 2016</option>
            <option value="April 2016">April 2016</option>
            <option value="Mei 2016">Mei 2016</option>
            <option value="Jun 2016">Jun 2016</option>
            <option value="Julai 2016">Julai 2016</option>
            <option value="Ogos 2016">Ogos 2016</option>
            <option value="September 2016">Sept 2016</option>
            <option value="Oktober 2016">Okt 2016</option>
            <option value="November 2016">Nov 2016</option>
            <option value="Disember 2016">Dis 2016</option>
          </select><br>
        </div>

        <div class="col-md-6">
          <label>Nama Pasangan</label>
          <input type="text" class="form-control" name="pasangan" required></input><br>

          <label>No I/C Pasangan</label>
          <input type="text" class="form-control" name="icPasangan" required></input><br>
          
          <label>Telefon Pasangan</label>
          <input type="text" class="form-control" name="fonPasangan" required></input><br>

          <label>Minggu</label><br>
          <label class="radio-inline"><input type="radio" name="optradio" value="Pertama">Pertama</label>
          <label class="radio-inline"><input type="radio" name="optradio" value="Ketiga">Ketiga</label><br>
        </div>
      <p><button type="submit" class="btn btn-primary btn-block" name="daftar">Daftar</button></p>
      </form>
    </div>

    <div class="col-md-1"></div>
  </div>

  <?php
    if (isset($_POST['daftar'])) {
      $anda = $_POST['anda'];
      $icanda = $_POST['icAnda'];
      $fon = $_POST['fonAnda'];
      $bulan = $_POST['bulan'];
      $psngn = $_POST['pasangan'];
      $icPsngn = $_POST['icPasangan'];
      $fonPsngn = $_POST['fonPasangan'];
      $week = $_POST['optradio'];

      mysql_select_db($database_conn, $conn);
      $sql = mysql_query("INSERT INTO kursus (n_anda, icAnda, fonAnda, n_psngn, icPsngn, fonPsngn, bulan, minggu) VALUES ('$anda', '$icanda', '$fon', '$psngn', '$icPsngn', '$fonPsngn', '$bulan', '$week') ");

      if ($sql === false) {
        die (mysql_error());
      }
      else {
        $qry = mysql_fetch_array($sql);
        echo '<script language="javascript">';
        echo 'alert("Pra-Daftar telah berjaya.\nCalon boleh buat bayaran pada hari seminar beroperasi.")';
        echo '</script>';
      }

    }
  ?>
      <!-- Footer -->
    <footer>
        <div class="footer">
            <div class="col-md-12">
                <p class="text-center">All Right Reserved. Copyright &copy; Zaid & Tamimi 2016<br><a href="../kahwin/index.php">www.walimatulurus.my</a></p>
            </div>
        </div>
    </footer>
</div>


</body>
</html>