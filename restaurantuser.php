<?php

	session_start();
	
	include("connection.php");
	
	$userID = $_SESSION['id'];
	$query="SELECT * FROM pendingmeal.restaurant where userID = $userID";
	
	$result = mysqli_query($link,$query);
	$row = mysqli_fetch_array($result);
	$name = $row['name'];
	
	
	
	?>	
	
	
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <?php echo '<title>Welcome, '.$name.'</title>';?>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
  
    <form class="form-signin" role="form" action = "new_order.php" method="post">
     <div class= "container" >
			<div class="form-group row">

    <div class="col-lg-6">
        <label for="exampleSelect1">Meal item and amount</label>
  <?php
    $query = "SELECT * FROM meal WHERE restaurantID ='".$row['restaurantID']."'";
    $mealdata = mysqli_query($link,$query);

    for ($i = 1; $i <= mysqli_num_rows($mealdata); $i++) {
      $mealrow = mysqli_fetch_array($mealdata);
      echo '<div class="input-group">';
        echo '<span class="input-group-addon">';
          echo '<input type="radio" name="'.$mealrow['mealID'].'radio">'.$mealrow['description'];
        echo '</span>';
        echo '<input type="text" class="form-control" name="'.$mealrow['mealID'].'qty">';
      echo '</div>';
    }
  ?>
  </div><!-- /.col-lg-6 -->
            <div class="col-lg-6">
			  <div class="form-group">
				<label for="exampleSelect1">Payment Method</label>
				<select class="form-control" id="exampleSelect1" name ="payment">
				<option>PayMaya</option>
				<option>DragonPay</option>
				<option>Paypal</option>
				  <option>Cash</option>
				</select>
			  </div>
          </div>

</div><!-- /.row -->
<div class = "row"> 
	<div class="col-md-3"></div>
	<div class="col-md-3"></div>
	<div class="col-md-3"></div>
	<div class="col-md-3">
 <button type="submit" class="btn btn-default" name="usersubmit">Submit</button></div>
      </div>
	  </form>
  </body>
  </html>