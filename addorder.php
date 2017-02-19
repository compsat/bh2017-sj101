<?php



session_start();

		
		include("connection.php");
		
		
		$submit = mysqli_real_escape_string($link, trim($_POST['submit']));


?>