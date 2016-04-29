<?php include("../kahwin/Connections/conn.php");?>
<!DOCTYPE html>
<html>
<head>
	<title>Kahwin Ringkas</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="/kahwin/index.php">Walimatul Urus</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container">  
  <div class="col-md-12">
    <table>
      <thead>
        <tr>
          <th>Pakej</th>
          <th>Harga</th>
          <th>Image</th>
        </tr>
      </thead>
      <tbody>
      <?php
        $vid = $_SEESION['vid'];
        mysql_select_db($database_conn, $conn);
        $sql = mysql_query("SELECT * FROM pakej WHERE v_id = '$vid' ");
        while($rowP = mysql_fetch_array($sql)) {
      ?>
        <tr>
          <td><?php echo $rowP['pakej']?></td>
          <td><?php echo $rowP['harga']?></td>
          <td><?php echo '<img src="data:image;base64,'.$rowP['p_img'].' " class="img-thumbnail">'; ?></td>
        </tr>
        <?php }
        ?>
      </tbody>
    </table>
  </div>
</div>

		

<footer class="container-fluid text-center">
  <p>Salam Barakah kepada Bakal Pengantin</p>
</footer>		

</body>
</html>