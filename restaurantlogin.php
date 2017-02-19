<?php
	session_start();
	include("connection.php");
	$user_username = mysqli_real_escape_string($link, trim($_POST['userid']));
		$user_password = mysqli_real_escape_string($link, trim($_POST['inputPassword']));
     if (!empty($user_username) && !empty($user_password)) {
        // Look up the username and password in the database
        $query = "SELECT userID, name, type FROM user WHERE username = '$user_username' AND password = '$user_password'";
        $data = mysqli_query($link, $query);

        if (mysqli_num_rows($data) == 1) {
          // The log-in is OK so set the user ID and username session vars (and cookies), and redirect to the home page
          $row = mysqli_fetch_array($data);
          
          $_SESSION['userid'] = $row['userID'];
		  if ($row['type'] == 0){
			// die(header("location:index.php?loginCorrect=true&reason=password"));
		  			$show_modal=true;
		  			//echo "success";
		  	 $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/restaurant.php?submit=true';
		  	 header('Location: ' . $home_url);}
		// echo  "<script type='text/javascript'>
			
		// 	$('#userOrderModal').modal('show');
			
		// 	</script>";}
	 }
		  else{
			  //error cannot into
		  }

          exit();
        }
        else {
          // The username/password are incorrect so set an error message
          die(header("location:restaurant.php?loginFailed=true&reason=password"));
        }
      
	  mysqli_close($link);
	  ?>
		