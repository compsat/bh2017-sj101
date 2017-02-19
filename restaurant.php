<?php

	session_start();
	
	include("connection.php");
	
	$userID = $_SESSION['id'];
	$query="SELECT * FROM pendingmeal.restaurant where userID = $userID";
	
	$result = mysqli_query($link,$query);
	$row = mysqli_fetch_array($result);
	$name = $row['name'];
	
	$_SESSION['restaurantID'] = $row['restaurantID'];

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
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
  
  <!-- HEADER 
=================================-->
<!-- PHP stuff -->

<?php 

 if(isset($_FILES['image'])){
      $errors= array();
      $file_name = $_FILES['image']['name'];
      $file_size = $_FILES['image']['size'];
      $file_tmp = $_FILES['image']['tmp_name'];
      $file_type = $_FILES['image']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
      
      $expensions= array("jpeg","jpg","png");
      
      if(in_array($file_ext,$expensions)=== false){
         $errors[]="extension not allowed, please choose a JPEG or PNG file.";
      }
      
      if($file_size > 2097152) {
         $errors[]='File size must be excately 2 MB';
      }
      
      if(empty($errors)==true) {
         move_uploaded_file($file_tmp,"images/".$file_name);
         echo "Success";
      }else{
         print_r($errors);
      }
   }

?>


<div class="container main-container">
<!-- 			-->
<div class="jumbotron text-center">
    <div class="container">
      <div class="row">
        <div class="col col-lg-12 col-sm-12">
          <h1>
		  <?php
		  print "$name";
          ?>
		  </h1>
          <p>
		 <?php
		  print "Special Tagline";
          ?>
		  </p>
        </div>
      </div>
    </div> 
</div> 
<!-- /header container-->
	<div class = "container"> 
	
	
	<!--START GRID ROW --> 
	<?php
		$query = "SELECT * FROM pendingorder WHERE restaurantID ='".$row['restaurantID']."'";
		$orderdata = mysqli_query($link,$query);
		$orders = array();
		$quantity = 0;
		for ($i = 1; $i <= mysqli_num_rows($orderdata); $i++){
			$orderrow = mysqli_fetch_array($orderdata);
			if($orderrow['status'] == 0){
				if(array_key_exists($orderrow['mealName'], $orders)){
					$orders[$orderrow['mealName']] += $orderrow['quantity'];
				}else{
					$orders[$orderrow['mealName']] = $orderrow['quantity'];
				}
				$quantity += $orderrow['quantity'];
			}
		}
	?>
        
        
    	<!-- START GRID ROW --> 
	<div class="row">

        <div class="col-md-3 col-md-offset-3">
            <div class="well text-center">
            <!-- ADD PENDING ORDER BUTTON --> 
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Add Pending Order
                    </div>
                        <button type="button" class="btn btn-primary center" data-toggle="modal" data-target="#userModal">As User
                        </button>
                        <button type="button" class="btn btn-primary center" data-toggle="modal" data-target="#userOrderModal">As Guest
                        </button>
                </div>
            </div>
        </div>
         <div class="col-md-3">
            <div class="well text-center">

        <!-- CLAIM PENDING ORDER BUTTON --> 
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Claim Pending Order
                    </div>
                        <button type="button" class="btn btn-primary center" data-toggle="modal" data-target="#claimModal">Claim
                        </button>
                </div>
            </div>
        </div>
    </div>
	
	</div>
	<!-- END GRID ROW -->     
	<div class = "row"> 
	<div class="col-md-3">
		<h1>Pending Meals</h1>
	</div>
	<div class="col-md-3 col-md-offset-6"><h3>Number of pending orders: <?php echo  "" . $quantity?></h3></div>
	</div>
	<!-- END OF GRID ROW --> 

	<!-- LIST START PENDING ORDERS LIST --> 
	
	<div class="panel panel-default">
        <div class="table-div">
            <ul class="list-group"> 
                <?php 
                    foreach ($orders as $key=>$value) {
                        echo "<li class=\"list-group-item\">";
                        echo $key;
                        echo "</li>";				}
                ?>
            </ul>
        </div>
	<!-- END OF PENDING ORDERS LIST --> 
    </div>

      </div>
	<!-- Modal -->
    <!-- add pending order AS GUEST -->
<div id="guestModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add pending order</h4>
      </div>
      <form class="form-signin" role="form" action = "new_order.php" method="post">
      <div class="modal-body">
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
				  <option>Cash</option>
				</select>
			  </div>
			  <label for="example-text-input" class="col-2 col-form-label">Contact Number</label>
			  <div class="col-10">
				<input class="form-control" type="text" value="" id="example-text-input" name="contact">
			  </div>
                
          </div>

</div><!-- /.row -->
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-default" name="guestsubmit">Submit</button>
      </div>
      
    </div>
</form>
  </div>
</div>
      <!-- end pending as guest -->


            <!-- user login -->
<div id="userModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add pending order</h4>
      </div>
        <div>
      <center>
        <h2 class="form-signin-heading">Sign in</h2>
      <form class="form-signin" role="form" action = "restaurantlogin.php" method="post" id="reslogin">
                  <input id = "username" type="username" placeholder="UserID" name = "userid" > <br> <br>
                  <input id = "password" type="password" placeholder="Password" name = "inputPassword" > <br>
                  <button class="loginbutton btn btn-info" type="submit" name ="submit" value="signin">Sign in</button>

               </form>
      <div style = "width=100%; padding-top:50px;"></div> 
      </center>
    </div>

  </div>
</div>
</div>
	<!-- end user login-->

      
           
            <!-- enter user details to order pending meal -->
<div id="claimModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Claim pending order</h4>
      </div>
      <div class="modal-body">
      
      <div class="form-group row">
    
    <div class="col-lg-6">
        <label for="exampleSelect1">Order</label>
    <div class="input-group">
      <span class="input-group-addon">
        <input type="radio" aria-label="..."> Pizza 1
      </span>
    </div><!-- /input-group -->
        <div class="input-group">
      <span class="input-group-addon">
        <input type="radio" aria-label="..."> Pizza 2
      </span>
    </div><!-- /input-group -->
        <div class="input-group">
      <span class="input-group-addon">
        <input type="radio" aria-label="..."> Pizza 3
      </span>
    </div><!-- /input-group -->
  </div><!-- /.col-lg-6 -->
        <label>Upload picture of patron</label>
<form action = "" method = "POST" enctype = "multipart/form-data">
         <input type = "file" name = "image" />
         <input type = "submit"/>
      
      </form>
</div><!-- /.row -->

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Submit</button>
      </div>
    </div>

  </div>
    </div>
  <!-- end submit user details -->
<!-- 
      
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>