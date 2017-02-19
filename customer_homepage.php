<?php
session_start();

$id =  $_SESSION['id'];
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Customer Home</title>

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
  		<?php
      		# $num = $_GET["userid"];
			include("connection.php");
  			$dbc = $link;
            $query = "SELECT * FROM user WHERE userID = '$id'";
            $userdata = mysqli_query($dbc, $query);

            if(mysqli_num_rows($userdata) == 1)
				$userrow = mysqli_fetch_array($userdata);

			?>
      <div class="container">
        <div class="row text-center">
            <img src="images/pusheen%20pikachu.jpg" class="img-circle col-sm-3">
            <?php
            	echo '<h1 class="col-sm-3">'.$userrow['name'].'</h1>';

                $query = "SELECT * FROM paymentoption WHERE userID = '".$userrow['userID']."'";
            	$paymentdata = mysqli_query($dbc, $query);

  				echo '<h1 class="col-sm-3">'.mysqli_num_rows($paymentdata).'</h1>';
  			?>
            <h1 class="col-sm-3"> completed orders</h1>
        </div>
          
        <!-- PAYMENT OPTIONS TABLE -->
        <div class="panel panel-default"> 
          <!-- Default panel contents -->
          <div class="panel-heading">
              <h1 class="panel-title">Payment Options</h1>
          </div> 

          <!-- Table -->
          <table class="table">
                <thead>
                    <th>Company</th>
                    <th>Account Number</th>
                </thead>
                <tbody>
                	<?php
            			for ($i = 1; $i <= mysqli_num_rows($paymentdata); $i++) {
            				$row = mysqli_fetch_array($paymentdata);
                    		echo '<tr>';
                        		echo '<td>'.$row['paymentType'].'</td>';
                        		echo '<td>'.$row['accountID'].'</td>';                    
                    		echo '<//tr>';
                    	}
                    ?>              
                </tbody>
            </table>
        </div> 
        <!-- END PAYMENT OPTIONS -->
       
        <!-- TRANSACTION HISTORY -->
         <div class="panel panel-default"> 
          <!-- Default panel contents -->
         <div class="panel-heading">
              <h1 class="panel-title">Transaction History</h1>
          </div> 

          <!-- Table -->
         <table class="table">
                <thead>
                    <th>Restaurant</th>
                    <th>Order</th>
                    <th>Cost</th>
                    <th>Date</th>
                    <th>Status</th>
                </thead> 
                <tbody>
                 	<?php
                		$query = "SELECT * FROM pendingorder p INNER JOIN restaurant r ON p.restaurantID=r.restaurantID where p.userID ='".$userrow['userID']."' ";
            			$orderdata = mysqli_query($dbc, $query);

            			for ($i = 1; $i <= mysqli_num_rows($orderdata); $i++) {
            				$row = mysqli_fetch_array($orderdata);
                    		echo '<tr>';
                        		echo '<td>'.$row['name'].'</td>'; 
                        		echo '<td>'.$row['mealName'].'</td>'; 
                        		echo '<td>Php '.$row['totalPrice'].'</td>';
                        		echo '<td>'.$row['date'].'</td>';
                        		if($row['status'] == 1)
                        			echo '<td> Complete </td>';
                        		else
                        			echo '<td> Pending </td>';
                        	echo '</tr>';
                        }

                     ?>                
                </tbody> 
            </table>
        </div> 
        <!-- END TRANSACTION HISTORY -->
            
        </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>