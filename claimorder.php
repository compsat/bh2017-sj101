<?php
session_start();
 include("connection.php");

 date_default_timezone_set('Australia/Melbourne');
$date = date('m-d-y');

          //   $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/student.php';
          // header('Location: ' . $home_url);
          // exit();
 $query = "SELECT * FROM meal WHERE restaurantID ='".$_SESSION['restaurantID']."'";
    $mealdata = mysqli_query($link,$query);

  for ($i = 1; $i <= mysqli_num_rows($mealdata); $i++) {
    $mealrow = mysqli_fetch_array($mealdata);
    $data = $_POST[$mealrow['mealID'].'radio'];
    if($data == 'on'){
    	$query = "SELECT * FROM pendingorder WHERE mealName ='".$mealrow['description']."' AND restaurantID ='".$_SESSION['restaurantID']."' AND orderID IN (
         SELECT orderID FROM (
             SELECT orderID FROM pendingorder 
             ORDER BY orderID ASC  
             LIMIT 1
         ) tmp";
    	$orderdata = mysqli_query($link,$query);
    	for ($j = 1; $j <= mysqli_num_rows($orderdata); $j++) {

    		$orderrow = mysqli_fetch_array($orderdata);

			if($orderrow['status'] == 0){

    	$query="UPDATE pendingorder SET status = 1 WHERE restaurantID ='".$_SESSION['restaurantID']."' LIMIT 1";
   		echo $query;
        if(mysqli_query($link, $query)){
          // echo "Records added successfully.";
      } else{
          echo "ERROR: Could not able to execute $query. " . mysqli_error($link);
      }
      break;
 	 }
    } 
}
  		
  
  echo $mealrow['description'];
  }
  mysqli_close($link);
  // $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/restaurant.php';
  // header('Location: ' . $home_url);
  // exit();
 ?>