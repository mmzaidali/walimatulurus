<?php
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}

// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session varialbles
  $_SESSION['MM_Username'] = NULL;
  $_SESSION['MM_UserGroup'] = NULL;
  $_SESSION['PrevUrl'] = NULL;
  unset($_SESSION['MM_Username']);
  unset($_SESSION['MM_UserGroup']);
  unset($_SESSION['PrevUrl']);
	
  $logoutGoTo = "index.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
?>
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
    <style>
    body {
    margin-top: 50px; /* Required padding for .navbar-fixed-top. Remove if using .navbar-static-top. Change if height of navigation changes. */
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

<div class="container">  
<div class="page-header">
  <h1>Vendor <small><?php echo $user = $_SESSION['MM_Username']; ?></small></h1>
</div>

  <div class="col-md-12">
    <div class="col-md-3"> <!-- SIDEBAR -->
      <div class="panel-group">
        <div class="panel panel-primary">
          <div class="panel-heading">
            <h4 class="panel-title">
              <a data-toggle="collapse" href="#collapse1">Information</a>
            </h4>
          </div>
          <div id="collapse1" class="panel-collapse collapse in">
            <ul class="list-group">
              <li class="list-group-item"><a href="#">Profile</a></li>
            </ul>
            <!--<div class="panel-footer">Footer</div>-->
          </div>
        </div>

        <div class="panel panel-primary">
          <div class="panel-heading">
            <h4 class="panel-title">
              <a data-toggle="collapse" href="#collapse2">Package</a>
            </h4>
          </div>
          <div id="collapse2" class="panel-collapse collapse in">
            <ul class="list-group">
              <li class="list-group-item"><a href="#">View</a></li>
              <li class="list-group-item"><a href="#">Add New</a></li>
              <li class="list-group-item"><a href="venUpdate.php">Edit</a></li>
            </ul>
            <!--<div class="panel-footer">Footer</div>-->    <!-- END SIDEBAR -->
          </div>
        </div>
      </div>
    </div>

<?php

  mysql_select_db($database_conn, $conn);
  $sql = mysql_query("SELECT * FROM vendor WHERE username = '$user' ") or die (mysql_error());
  $row = mysql_fetch_array($sql);
?>
  <form method="post" enctype="multipart/form-data"> <!-- FORM EDIT -->
    <div class="col-md-9">
      <div class="col-md-6">
        <!--<input type="hidden" name="id" value=""?>"></input>-->

        <label>Company Name</label>
        <input type="text" class="form-control" name="com_name" value="<?php echo $row['companyName']?>"></input><br>

        <label>Type</label>
        <input type="text" class="form-control" name="type" value="<?php echo $row['type']?>"></input><br>

        <label>Address</label>
        <textarea class="form-control" name="address"><?php echo $row['address']?></textarea><br>

        <div class="col-md-4">
          <label>ZIP code</label>
          <input type="text" class="form-control" name="code" value="<?php echo $row['code']?>"></input><br>
        </div>
        
        <div class="col-md-4">
          <label>City</label>
          <input type="text" class="form-control" name="city" value="<?php echo $row['city']?>"></input><br>
        </div>

        <div class="col-md-4">
          <label>State</label>
          <input type="text" class="form-control" name="state" value="<?php echo $row['state']?>"></input><br>
        </div>

        <label>Contact</label>
        <input type="text" class="form-control" name="phone" value="<?php echo $row['contact']?>"></input><hr>
      </div>

      <div class="col-md-6">
        <?php echo '<img src="data:image;base64,'.$row['img'].'" class="img-thumbnail">'?><br><br><br>

        <label>Image File</label>
        <input type="file" class="form-control" name="image" value="<?php echo $row['nameImg']?>"></input><br>

        <label>Email</label>
        <input type="email" class="form-control" name="email" value="<?php echo $row['email']?>"></input><hr>
      </div>
    </div>
  </div>
  <hr>

  <p class="text-center">
      <button type="button" class="btn btn-warning" name="update">Update</button>&nbsp;
      <button class="btn btn-primary" onclick="window.print()">Print</button>
  </p>

  </form>  <!-- END FORM -->

</div>

</body>
</html>