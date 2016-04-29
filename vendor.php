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

<div class="container text-center">  
<div class="page-header">
  <h1>Vendor</h1>
</div>

  <div class="col-md-2"></div>
  
  <form method="post" enctype="multipart/form-data">
    <div class="col-md-8">
      <label>Enter name</label>
      <input type="text" class="form-control" name="name"><br>

      <label>Image File</label>
      <input type="file" name="p_img" class="form-control" placeholder="Size photo < 2MB"><br>

      <label>id Vendor</label>
      <input type="number" step="any" name="id" class="form-control"><br>

      <button type="submit" class="btn btn-success" name="hantar">Submit</button><br>
    </div>
  </form>

  <?php
            if(isset($_POST['hantar']))
            {
                if(getimagesize($_FILES['p_img']['tmp_name']) == FALSE)
                
{                    echo "Please select an image.";
                }
                else
                {
                    $image= addslashes($_FILES['p_img']['tmp_name']);
                    $name= addslashes($_FILES['p_img']['name']);
                    $nameImg = $_POST['name'];
                    $id = $_POST['id'];
                    $image= file_get_contents($image);
                    $image= base64_encode($image);
                    saveimage($image,$nameImg,$id,$name);
                }
            }
            
            function saveimage($image,$nameImg,$id,$name)
            {
                $con=mysql_connect("localhost","root","1234");
                mysql_select_db("kahwin4",$con);
                $qry="update vendor set img = '$image', nameImg = '$name' where v_id = '$id'";
                $result=mysql_query($qry,$con);
                if($result)
                {
                    //echo "Image uploaded.";
                }
                else
                {
                    //echo "Image not uploaded.";
                }
            }
        ?>

  <div class="col-md-2"></div>
</div>

</body>
</html>