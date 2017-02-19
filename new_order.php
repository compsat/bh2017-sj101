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
    if($data == on){
      echo $data;

  if(is_null($_POST['contact'])){
      $query = "SELECT * FROM contactdetail WHERE userID = '".$_SESSION['id']."'";
  echo $query;
  $contactdata  = mysqli_query($link,$query);
   $contactrow = mysqli_fetch_array($contactdata);
   $contact = $contactrow['contactNumber'];
 }else{
    $contact = $_POST['contact'];
 }


   $total = $_POST[$mealrow['mealID'].'qty']*$mealrow['price'];
$payment = $_POST['payment'];
  $query="INSERT INTO pendingorder (userID,mealName,restaurantID,paymentType,contactDetailID,quantity,totalPrice,date,status) 
        VALUES ('".$_SESSION['id']."','".$mealrow['description']."','".$_SESSION['restaurantID']."','".$payment."','".$contact."','".$_POST[$mealrow['mealID'].'qty']."','".$total."','".$date."','0')";

   
        if(mysqli_query($link, $query)){
          echo "Records added successfully.";
      } else{
          echo "ERROR: Could not able to execute $query. " . mysqli_error($link);
      }
  }  else echo 'oh no';
  }
  mysqli_close($link);
  $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/restaurant.php';
  header('Location: ' . $home_url);
?>