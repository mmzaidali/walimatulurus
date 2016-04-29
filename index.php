<?php require_once('Connections/conn.php');
include("../kahwin/functions.php");?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}
?>
<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['username'])) {
  $loginUsername=$_POST['username'];
  $password=$_POST['password'];
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "venProfile.php";
  $MM_redirectLoginFailed = "index.php";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_conn, $conn);
  
  $LoginRS__query=sprintf("SELECT username, password FROM vendor WHERE username=%s AND password=%s",
    GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysql_query($LoginRS__query, $conn) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
     $loginStrGroup = "";
    
	if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}

if($_REQUEST['command']=='add' && $_REQUEST['pakejid']>0){
        $pid=$_REQUEST['pakejid'];
        addtocart($pid,1);
        header("location:pakejlist.php");
        exit();
    }
?>
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

.header-image {
    display: block;
    width: 100%;
    text-align: center;
    background: url('../kahwin/img/slider.jpg') no-repeat center center scroll;
    -webkit-background-size: cover;
    -moz-background-size: cover;
    background-size: cover;
    -o-background-size: cover;
}

.headline {
    padding: 120px 0;
}

.headline h1 {
    font-size: 130px;
    background: transparent;
    background: rgba(255,255,255,0.9);
}

.headline h2 {
    font-size: 77px;
    background: transparent;
    background: rgba(255,255,255,0.9);
}

.featurette-divider {
    margin: 80px 0;
}

.featurette {
    overflow: hidden;
}

.featurette-image.pull-left {
    margin-right: 40px;
}

.featurette-image.pull-right {
    margin-left: 40px;
}

.featurette-heading {
    font-size: 50px;
}

footer {
    margin: 50px 0;
}

@media(max-width:1200px) {
    .headline h1 {
        font-size: 140px;
    }

    .headline h2 {
        font-size: 63px;
    }

    .featurette-divider {
        margin: 50px 0;
    }

    .featurette-image.pull-left {
        margin-right: 20px;
    }

    .featurette-image.pull-right {
        margin-left: 20px;
    }

    .featurette-heading {
        font-size: 35px;
    }
}

@media(max-width:991px) {
    .headline h1 {
        font-size: 105px;
    }

    .headline h2 {
        font-size: 50px;
    }

    .featurette-divider {
        margin: 40px 0;
    }

    .featurette-image {
        max-width: 50%;
    }

    .featurette-image.pull-left {
        margin-right: 10px;
    }

    .featurette-image.pull-right {
        margin-left: 10px;
    }

    .featurette-heading {
        font-size: 30px;
    }
}

@media(max-width:768px) {
    .container {
        margin: 0 15px;
    }

    .featurette-divider {
        margin: 40px 0;
    }

    .featurette-heading {
        font-size: 25px;
    }
}

@media(max-width:668px) {
    .headline h1 {
        font-size: 70px;
    }

    .headline h2 {
        font-size: 32px;
    }

    .featurette-divider {
        margin: 30px 0;
    }
}

@media(max-width:640px) {
    .headline {
        padding: 75px 0 25px 0;
    }

    .headline h1 {
        font-size: 60px;
    }

    .headline h2 {
        font-size: 30px;
    }
}

@media(max-width:375px) {
    .featurette-divider {
        margin: 10px 0;
    }

    .featurette-image {
        max-width: 100%;
    }

    .featurette-image.pull-left {
        margin-right: 0;
        margin-bottom: 10px;
    }

    .featurette-image.pull-right {
        margin-bottom: 10px;
        margin-left: 0;
    }
}
  	</style>

    <script language="javascript">
    function addtocart(pid){
        document.form1.pakejid.value=pid;
        document.form1.command.value='add';
        document.form1.submit();
    }
</script>
</head>
<body>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="../kahwin/index.php">Walimatul Urus</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
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
                    <li>
                    <?php
                        $cart_count=count($_SESSION['cart_items']);
                    ?>
                        <a href="pakejlist.php">Cart <span class="badge" id="comparison-count"><?php echo $cart_count ?></span></a>
                    </li>
                </ul>

                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="#" data-toggle="modal" data-target="#LoginModal">Login</a>
                    </li>
                    <li>
                        <a href="#">Register as Vendor</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

<!-- Full Width Image Header -->
    <header class="header-image">
        <div class="headline">
            <div class="container">
            	<h1>Walimatul Urus</h1>
                <h2>www.walimatulurus.my</h2>
            </div>
        </div>
    </header>

<!-- HIDDEN FORM -->
<form name="form1">
    <input type="hidden" name="pakejid" />
    <input type="hidden" name="command" />
</form>

<!-- Searching Part -->
<div class="container">
		<div class="page-header text-center">
			<h1>Carian Walimatul Urus</h1>
		</div>

<form method="post">
	<div class="row">
		<div class="col-md-3"></div>

		<div class="col-md-2">
			<input type="text" name="budget" class="form-control" placeholder="RM xxxx">
		</div>

		<div class="col-md-2">
			<select class="form-control" name="filter">
				<option value="katering">Katering</option>
				<option value="butik pengantin">Butik Pengantin</option>
				<option value="cenderahati">Cenderahati</option>
				<option value="jurufoto">Jurugambar & Juruvideo</option>
				<option value="kad kahwin">Kad Kahwin</option>
			</select><br>
		</div>

		<div class="col-md-2">
			<select class="form-control" name="state">
				<option value="Melaka">Melaka</option>
				<option value="Selangor">Selangor</option>
				<option value="Kuala Lumpur">Kuala Lumpur</option>
				<option value="Perak">Perak</option>
				<option value="Pahang">Pahang</option>
				<option value="Johor">Johor</option>
				<option value="Negeri Sembilan">Negeri Sembilan</option>
				<option value="Penang">Penang</option>
				<option value="Terengganu">Terengganu</option>
			</select>
		</div>

		<div class="col-md-3"></div>
	</div>

	<center><button type="submit" class="btn btn-primary" name="carian">Carian</button></center><hr>
</form>

<?php

	if (isset($_POST['carian'])) {
		$filter = $_POST['filter'];
		$state = $_POST['state'];
		$budget = $_POST['budget'];

		mysql_select_db($database_conn, $conn);
		$qry = mysql_query("SELECT * FROM vendor WHERE type = '$filter' AND state = '$state' ") or die (mysql_error());

		//$sql = mysql_query("SELECT * FROM vendor WHERE type = '$filter' AND state = '$state' ") or die (mysql_error());
		while ($row = mysql_fetch_assoc($qry)) { 
?>
	<div class="col-md-4">
		<?php echo '<img src="data:image;base64,'.$row['img'].'" class="img-thumbnail" ' ?>
		<a href="#"><h3><?php echo $row['companyName']?> <small><?php echo $row['type']?></small></h3></a>
		<p><?php echo $row['address']?><br><?php echo $row['code']?> <?php echo $row['city']?><br><?php echo $row['state']?></p>
		<p><?php echo $row['contact']?></p>
		<p><?php echo $row['email']?></p>
        <button class="btn btn-default" data-toggle="modal" data-target="#myModal" value="<?php echo $vid = $row['v_id']?>">View Package</button>
	</div>
	<?php }
		}
?>
</div>



    <!-- Page Content -->
    <div class="container">

        <hr class="featurette-divider">

        <!-- First Featurette -->
        <div class="featurette" id="katering">
            <a href="../kahwin/food.php"><img class="featurette-image img-circle img-responsive pull-right" src="../kahwin/img/katering1.jpg"></a>
            <h2 class="featurette-heading"><a href="../kahwin/food.php">Katering & Kanopi</a>
            </h2>
            <p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
            <!--<a href="../kahwin/food.php" class="btn btn-block btn-primary">View more</a>-->
        </div>

        <hr class="featurette-divider">

        <!-- Second Featurette -->
        <div class="featurette" id="jurugambar">
            <a href="../kahwin/jurufoto.php"><img class="featurette-image img-circle img-responsive pull-left" src="../kahwin/img/profoto.jpg"></a>
            <h2 class="featurette-heading"><a href="../kahwin/jurufoto.php">Jurugambar & Juruvideo</a>
            </h2>
            <p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
            <!--<a href="../kahwin/jurufoto.php" class="btn btn-block btn-primary">View more</a>-->
        </div>

        <hr class="featurette-divider">

        <!-- Third Featurette -->
        <div class="featurette" id="cenderahati">
            <a href="../kahwin/doorgift.php"><img class="featurette-image img-circle img-responsive pull-right" src="../kahwin/img/doorgiftedited.jpg"></a>
            <h2 class="featurette-heading"><a href="../kahwin/doorgift.php">Cenderahati</a>
            </h2>
            <p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
            <!--<a href="../kahwin/doorgift.php" class="btn btn-block btn-primary">View more</a>-->
        </div>

        <hr class="featurette-divider">

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p class="text-center">All Right Reserved. Copyright &copy; Zaid & Tamimi 2016<br><a href="../kahwin/index.php">www.walimatulurus.my</a></p>
                </div>
            </div>
        </footer>

    </div>
    <!-- /.container -->

    <!-- MODAL -->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3>Welcome</h3>
                </div>

                <div class="modal-body">

                <?php
                    mysql_select_db($database_conn, $conn);
                    $sql = mysql_query("SELECT * FROM pakej WHERE v_id = '$vid' ") or die (mysql_error());
                    while ($row = mysql_fetch_assoc($sql)) {
                ?>
                        <h3><?php echo $row['name_p']?> <small>RM <?php echo $row['harga']?></small> <a class="btn btn-success btn-xs" onclick="addtocart(<?php echo $row['v_id']?>)">Add to cart</a></h3>
                        <p><?php echo $row['descr']?></p>
                <?php }
                ?>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Login Modal -->
    <div id="LoginModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3>Login as Vendor</h3>
                </div>

                <div class="modal-body">
                    <form ACTION="<?php echo $loginFormAction; ?>" method="POST" name="login">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control" placeholder="Username"></input><br>

                        <label>Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Password"></input><br>

                        <button type="submit" name="login" class="btn btn-success pull-right">Login</button>
                        <button type="submit" name="register" class="btn btn-primary">Register</button>&nbsp;&nbsp;
                        <br>
                    </form>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

</body>
</html>