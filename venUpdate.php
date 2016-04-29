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
    <script language="javascript">
      function clearForm(){
          document.form1.reset.value='clear';
          document.form1.submit();
        }
    </script>
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
    <div class="col-md-3">
      <div class="panel-group">
        <div class="panel panel-primary">
          <div class="panel-heading">
            <h4 class="panel-title">
              <a data-toggle="collapse" href="#collapse1">Information</a>
            </h4>
          </div>
          <div id="collapse1" class="panel-collapse collapse in">
            <ul class="list-group">
              <li class="list-group-item"><a href="venProfile.php">Profile</a></li>
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
              <li class="list-group-item"><a href="#">Edit</a></li>
            </ul>
            <!--<div class="panel-footer">Footer</div>-->
          </div>
        </div>
      </div>
    </div>
  
    <div class="col-md-9">

        <table class="table table-bordered">
          <thead>
            <tr>
              <th>Nama Pakej</th>
              <th>Huraian</th>
              <th>Harga</th>
              <th></th>
            </tr>
          </thead>
          <tbody>

          <!-- ## RETRIEVE DATA FROM DB FUNCTIONS -->
          <?php
            mysql_select_db($database_conn, $conn);
            $sql = mysql_query("SELECT * FROM pakej WHERE username = '$user' ") or die (mysql_error());
            while ($row = mysql_fetch_array($sql)) {
          ?>
            <tr>
              <form method="post">
                <td><?php echo $row['name_p']?></td>
                <td><?php echo $row['descr']?></td>
                <td><?php echo $row['harga']?></td>
                <td><button class="btn btn-warning btn-block" type="submit" name="edit" value="<?php echo $id = $row['p_id']?>">EDIT</button></td>
              </form>
            </tr>

          <?php }
          ?>
          </tbody>

          <!-- ## EDIT DATA FUNCTIONS-->
          <?php
            if (isset($_POST['edit'])) {
              mysql_select_db($database_conn, $conn);
              $sql = mysql_query("SELECT * FROM pakej WHERE p_id = '$id' ") or die (mysql_error());
              $qry = mysql_fetch_array($sql);

            }
          ?>
        </table>
        <form name="form1" method="POST" action="../kahwin/venUpdate.php">
          <label>Nama Pakej</label>
          <input type="text" class="form-control" name="name_p" value="<?php echo $qry['name_p']?>"><br>

          <label>Huraian</label>
          <textarea class="form-control" name="descr"><?php echo $qry['descr'] ?></textarea><br>

          <label>Harga</label>
          <input type="number" step="any" name="harga" class="form-control" value="<?php echo $qry['harga']?>"><br>

          <label>Pakej id</label>
          <input type="text" class="form-control" name="pid" value="<?php echo $qry['p_id']?>"><br>

          <input type="hidden" name="reset">

          <button type="submit" class="btn btn-success" name="hantar">Save</button>&nbsp;
          <button type="reset" class="btn btn-info" name="reset" onclick="clearForm();">Reset</button><br>
          <hr>
      </form>
    </div>

      <!-- ## SEND DATA AFTER UPDATE INTO DB FUNCTIONS -->
        <?php
            /*if(isset($_POST['hantar'])) {
                mysql_select_db($database_conn, $conn);

                $namep = $_POST['name_p'];
                $descr = $_POST['descr'];
                $price = $_POST['harga'];
                $vid = $_POST['pid'];

                $sql = mysql_query("UPDATE pakej SET name_p = '$namep', descr = '$descr', harga = '$price' WHERE p_id = '$vid' ") or die (mysql_error());
                $result = mysql_query($sql);
                header("location:../kahwin/venUpdate.php");
            }*/
        ?>
  </div>
</div>

</body>
</html>