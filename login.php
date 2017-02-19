<?php

		session_start();

		
		include("connection.php");
		
		
		$submit = mysqli_real_escape_string($link, trim($_POST['submit']));


	if($submit=="signin"){
		$user_username = mysqli_real_escape_string($link, trim($_POST['userid']));
		$user_password = mysqli_real_escape_string($link, trim($_POST['inputPassword']));
		
     if (!empty($user_username) && !empty($user_password)) {
        // Look up the username and password in the database
        Echo $user_username;
        $query = "SELECT userID, name, type FROM user WHERE username = '$user_username' AND password = '$user_password'";
        Echo $query;
        $data = mysqli_query($link, $query);

        if (mysqli_num_rows($data) == 1) {
          // The log-in is OK so set the user ID and username session vars (and cookies), and redirect to the home page
          $row = mysqli_fetch_array($data);
          
          $_SESSION['id'] = $row['userID'];
          $_SESSION['name'] = $row['name'];
          $_SESSION['type'] = $row['type'];
          
		  if ($row['type'] ==0){
          $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/customer_homepage.php';}
		  else{
			  $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/restaurant.php';
		  }
          header('Location: ' . $home_url);
          exit();
        }
        else {
          // The username/password are incorrect so set an error message
          die(header("location:index.php?loginFailed=true&reason=password"));
        }
      }
	  mysqli_close($link);
	}
	else{
					// Escape user inputs for security
			
			$username = mysqli_real_escape_string($link, $_POST['email']);
		$password = md5(md5($_POST['email']).$_POST['password']);
			$name = mysqli_real_escape_string($link, $_POST['name']);
			
			$query = "INSERT INTO user (username, password,name,type) VALUES ('$username', '$password', '$name','0')";
   
    		if(mysqli_query($link, $query)){
    echo "Records added successfully.";
} else{
    echo "ERROR: Could not able to execute $query. " . mysqli_error($link);
}
    		
    		$success="You've been signed up!";
    		
    		 
          $_SESSION['id'] = $row['userID'];
          $_SESSION['name'] = $row['name'];
          $_SESSION['type'] = $row['type'];
			
			//$home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/test.php';
			//header('Location: ' . $home_url);
	}
?>