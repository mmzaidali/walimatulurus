<?php include("../kahwin/Connections/conn.php");
include("../kahwin/functions.php");?>
<?php 
if($_REQUEST['command']=='delete' && $_REQUEST['pid']>0){
    remove_product($_REQUEST['pid']);
  }
  else if($_REQUEST['command']=='clear'){
    unset($_SESSION['cart']);
  }
  else if($_REQUEST['command']=='update'){
    $max=count($_SESSION['cart']);
    for($i=0;$i<$max;$i++){
      $pid=$_SESSION['cart'][$i]['pakejid'];
      $q=intval($_REQUEST['pakej'.$pid]);
      if($q>0 && $q<=999){
        $_SESSION['cart'][$i]['qty']=$q;
      }
      else{
        $msg='Some proudcts not updated!, quantity must be a number between 1 and 999';
      }
    }
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
    <script language="javascript">
  function del(pid){
    if(confirm('Do you really mean to delete this item')){
      document.form1.pid.value=pid;
      document.form1.command.value='delete';
      document.form1.submit();
    }
  }
  function clear_cart(){
    if(confirm('This will empty your shopping cart, continue?')){
      document.form1.command.value='clear';
      document.form1.submit();
    }
  }
  function update_cart(){
    document.form1.command.value='update';
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
        <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
      </ul>
    </div>
  </div>
</nav>

<! -- HIDDEN FORM -- >
<form name="form1" method="post">
<input type="hidden" name="pid" />
</form>

<!-- Page Content -->
  <div class="col-md-12">
    <div class="col-md-2"></div>

    <div class="col-md-8">
      <div class="page-header">
        <h1>Your cart</h1>      
      </div>

      <table class="table table-striped">
          <thead>
              <tr>
                  <th>#</th>
                  <th width="13%">Vendor ID</th>
                  <th width="49%">Nama Pakej</th>
                  <th width="25%">Amount</th>
                  <th width="13%"></th>
              </tr>
          </thead>
          <tbody>

            <?php
              if(is_array($_SESSION['cart'])){
                  $totalprice = 0;
                  $max = count($_SESSION['cart']);
                  for ($i=0; $i<$max; $i++) {
                    $pid = $_SESSION['cart'][$i]['pakejid'];
                    $pName = get_product_name($pid);
                    $price = get_price($pid);
                    $vendor = get_vendor_name($pid);
            ?>
              <tr>
                  <td><?php echo $i+1 ?></td>
                  <td><?php echo $vendor ?></td>
                  <td><?php echo $pName ?></td>
                  <td>RM <?php echo $price ?></td>
                  <td><a href="javascript:del(<?php echo $pid?>)" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> Remove</a></td>
              </tr>

              <?php 
              $totalprice += $price;
            }
          }
            ?>
          </tbody>
      </table>

      <p class="lead text-center">Your total price is : RM <?php echo $totalprice ?><br></p>

            <p class="text-center">
                <button class="btn btn-default" type="button" onClick="window.location='../kahwin/index.php'">Add more package</button>&nbsp;
                <button class="btn btn-warning" type="button" onclick="clear_cart()">Clear Cart</button>&nbsp;
                <button class="btn btn-success" type="button" onClick="window.location='#'">Checkout</button>&nbsp;
            </p>
    </div>

    <div class="col-md-2"></div>
  </div>

</body>
</html>