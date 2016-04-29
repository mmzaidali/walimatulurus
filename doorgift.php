<?php include("../kahwin/Connections/conn.php"); ?>

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
<div class="page-header">
  <h1>Carian Katering</h1>
</div>
  
  <?php
    mysql_select_db($database_conn, $conn);
    $sql = mysql_query("SELECT * FROM vendor WHERE type = 'Cenderahati'") or die (mysql_error());
    while ($row = mysql_fetch_array($sql)) {
  ?>
    <div class="col-md-4">
      <?php echo '<img src="data:image;base64, '.$row['img'].'" class="img-thumbnail">' ?>
      <h4><?php echo $row['companyName']?></h4>
      <p><?php echo $row['address']?>, <?php echo $row['code']?> <?php echo $row['city']?>, <?php echo $row['state']?><br><?php echo $row['contact']?><br><?php echo $row['email']?><br></p>
      <a href="pakejlist.php?v_id=<?php echo $row['v_id']?>" class="btn btn-primary">View Package</a><br>
    </div>
    <?php }
    ?>

</div>

</body>
</html>