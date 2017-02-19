<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Pending Meal</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
    body {
      background: url(office.jpg) no-repeat center center fixed; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
    }
    </style>
  </head>

  <body id="back1" >
      <div class="container">
      <form class="form-signin" role="form" action = "login.php" method="post">
        <div style = "width=100%; padding-top:200px;"></div>
        <div>
      <center>
        <h2 class="form-signin-heading">Sign in</h2>
                <?php  
                  if (isset($_GET["loginFailed"])) 
                    echo 'Invalid username or password<br>'; 
                  else 
                    echo '<br>'; ?>
                
                <input id = "username" type="username" placeholder="UserID" name = "userid" > <br> <br>
                <input id = "password" type="password" placeholder="Password" name = "inputPassword" > <br>
               <button class="loginbutton btn btn-info" type="submit" name ="submit" value="signin">Sign in</button>  
			   
			   <!-- SIGN UP --> 
			   <button type="button" class="btn btn-primary center" data-toggle="modal" data-target="#myModal" >Sign up	</button>
			   
				<!-- Modal -->
				<div id="myModal" class="modal fade" role="dialog">
				  <div class="modal-dialog">

					<!-- Modal content-->
					<div class="modal-content">
					  <div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Sign up!</h4>
					  </div>
					  <div class="modal-body">
							<div class="form-group">
								<label for="exampleInputEmail1">Email address</label>
								<input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" name = "email">
								<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
							  </div>
							  <div class="form-group">
								<label for="exampleInputPassword1">Password</label>
								<input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name ="password">
							  </div>
							  <div class="form-group">
								<label for="exampleInputEmail1">Name</label>
								<input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Name"name="name">
							  </div>
					  <div class="modal-footer">
						<button  class="btn btn-default" type = "submit" name = "submit" value = "signup">Sign up</button>
					  </div>
					</div>

				  </div>
				</div>
			   
            </center>
    </div>  
      </form>
    </div> <!-- /container -->
      <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
          
      </div>
    </nav>
	
	
	 <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>