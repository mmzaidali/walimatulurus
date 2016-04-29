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

<div class="row">
<form method="post">
  <div class="pull-right">
    <button class="btn btn-success" name="filter" type="button">Filter</button>&nbsp;&nbsp;&nbsp;&nbsp;
  </div>

  <div class="pull-right">
    <select class="form-control" name="search">
      <option value="kuala lumpur">Kuala Lumpur</option>
      <option value="selangor">Selangor</option>
      <option value="melaka">Melaka</option>
      <option value="perak">Perak</option>
      <option value="pahang">Pahang</option>
      <option value="negeri sembilan">Negeri Sembilan</option>
    </select>
  </div>
  <br><br><br>
</form>
</div>

  <?php
    mysql_select_db($database_conn, $conn);
      $sql = mysql_query("SELECT * FROM vendor WHERE type = 'Katering'") or die (mysql_error());
      while ($row = mysql_fetch_array($sql)) {
  ?>
    <div class="col-md-4">
      <?php echo '<img src="data:image;base64, '.$row['img'].'" class="img-thumbnail">' ?>
      <h4><?php echo $row['companyName']?></h4>
      <p><?php echo $row['address']?>, <?php echo $row['code']?> <?php echo $row['city']?>, <?php echo $row['state']?><br><?php echo $row['contact']?><br><?php echo $row['email']?><br></p>
      <button class="btn btn-primary" value="<?php echo $vid = $row['v_id']?>" data-toggle="modal" data-target="#pakej">View Package</a><br>
    </div>
    <?php }
    ?>
</div>

<!-- MODAL
<div id="pakej" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h3><strong></strong></h3>
      </div>

      <div class="modal-body">
        <?php
            mysql_select_db($database_conn, $conn);
            $sql = mysql_query("SELECT * FROM pakej WHERE v_id = '$vid' ") or die (mysql_error());
            while ($row = mysql_fetch_array($sql)) {
        ?>
                <h3><?php echo $row['name_p']?> <small>RM <?php echo $row['harga']?></small> <a href="pakejlist.php?id=<?php echo $row['v_id']?>&name=<?php echo $row['name_p']?>" class="btn btn-success btn-xs">Add to cart</a></h3>
                <p><?php echo $row['descr']?></p>
        <?php }
        ?>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close &times;</button>
      </div>
    </div>
  </div>
</div> -->

</body>
</html>