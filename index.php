<html>
	<head>
		<?php
      session_start();
      include("database.php");
      
		?>
		<title>
			FoodBook
		</title>
		<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script> $(function() {//styling for the switch between login and register

    $('#login-form-link').click(function(e) {
		$("#login-form").delay(100).fadeIn(100);
 		$("#register-form").fadeOut(100);
		$('#register-form-link').removeClass('active');
		$(this).addClass('active');
		e.preventDefault();
	});
		$('#register-form-link').click(function(e) {
		$("#register-form").delay(100).fadeIn(100);
 		$("#login-form").fadeOut(100);
		$('#login-form-link').removeClass('active');
		$(this).addClass('active');
		e.preventDefault();
	});

});
</script>
		<style>
			body {
    padding-top: 90px;
}
.panel-login {
	border-color: #ccc;
	-webkit-box-shadow: 0px 2px 3px 0px rgba(0,0,0,0.2);
	-moz-box-shadow: 0px 2px 3px 0px rgba(0,0,0,0.2);
	box-shadow: 0px 2px 3px 0px rgba(0,0,0,0.2);
}
.panel-login>.panel-heading {
	color: #00415d;
	background-color: #fff;
	border-color: #fff;
	text-align:center;
}
.panel-login>.panel-heading a{
	text-decoration: none;
	color: #666;
	font-weight: bold;
	font-size: 15px;
	-webkit-transition: all 0.1s linear;
	-moz-transition: all 0.1s linear;
	transition: all 0.1s linear;
}
.panel-login>.panel-heading a.active{
	color: #029f5b;
	font-size: 18px;
}
.panel-login>.panel-heading hr{
	margin-top: 10px;
	margin-bottom: 0px;
	clear: both;
	border: 0;
	height: 1px;
	background-image: -webkit-linear-gradient(left,rgba(0, 0, 0, 0),rgba(0, 0, 0, 0.15),rgba(0, 0, 0, 0));
	background-image: -moz-linear-gradient(left,rgba(0,0,0,0),rgba(0,0,0,0.15),rgba(0,0,0,0));
	background-image: -ms-linear-gradient(left,rgba(0,0,0,0),rgba(0,0,0,0.15),rgba(0,0,0,0));
	background-image: -o-linear-gradient(left,rgba(0,0,0,0),rgba(0,0,0,0.15),rgba(0,0,0,0));
}
.panel-login input[type="text"],.panel-login input[type="email"],.panel-login input[type="password"] {
	height: 45px;
	border: 1px solid #ddd;
	font-size: 16px;
	-webkit-transition: all 0.1s linear;
	-moz-transition: all 0.1s linear;
	transition: all 0.1s linear;
}
.panel-login input:hover,
.panel-login input:focus {
	outline:none;
	-webkit-box-shadow: none;
	-moz-box-shadow: none;
	box-shadow: none;
	border-color: #ccc;
}
.btn-login {
	background-color: #59B2E0;
	outline: none;
	color: #fff;
	font-size: 14px;
	height: auto;
	font-weight: normal;
	padding: 14px 0;
	text-transform: uppercase;
	border-color: #59B2E6;
}
.btn-login:hover,
.btn-login:focus {
	color: #fff;
	background-color: #53A3CD;
	border-color: #53A3CD;
}
.forgot-password {
	text-decoration: underline;
	color: #888;
}
.forgot-password:hover,
.forgot-password:focus {
	text-decoration: underline;
	color: #666;
}

.btn-register {
	background-color: #1CB94E;
	outline: none;
	color: #fff;
	font-size: 14px;
	height: auto;
	font-weight: normal;
	padding: 14px 0;
	text-transform: uppercase;
	border-color: #1CB94A;
}
.btn-register:hover,
.btn-register:focus {
	color: #fff;
	background-color: #1CA347;
	border-color: #1CA347;
}
		</style>
		<div class="container">
    	<div class="row">
			<div class="col-md-6 col-md-offset-3">
						<h1>
			<center>
				FoodBook
			</center>
		</h1>
				<div class="panel panel-login">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-6">
								<a href="#" class="active" id="login-form-link">Login</a>
							</div><!--shows the login box-->
							<div class="col-xs-6">
								<a href="#" id="register-form-link">Register</a>
							</div>
						</div>
						<hr>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-12">
								<form id="login-form" action="" method="POST" role="form" style="display: block;">
									<div class="form-group">
										<input type="text" name="uname" id="username" tabindex="1" class="form-control" placeholder="Username" required>
									</div><!--login form-->
									<div class="form-group">
										<input type="password" name="pass" id="password" tabindex="2" class="form-control" placeholder="Password" required>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-sm-6 col-sm-offset-3">
												<input type="hidden" name="frmname" value="login">
												<input type="submit" name="login-submit" id="login-submit" tabindex="3" class="form-control btn btn-login" value="Login">
											</div>
										</div>
									</div>
								</form>
								<form id="register-form" action="" method="POST" role="form" style="display: none;">
									<div class="form-group">
										<input type="text" name="fname" id="fname" tabindex="1" class="form-control" placeholder="First Name" required>
									</div><!--register form-->
									<div class="form-group">
										<input type="text" name="lname" id="lname" tabindex="2" class="form-control" placeholder="Last Name" required>
									</div>
									<div class="form-group">
										<input type="text" name="uname" id="uname" tabindex="3" class="form-control" placeholder="Username" required>
									</div>
									<div class="form-group">
										<input type="email" name="email" id="email" tabindex="4" class="form-control" placeholder="Email Address" required>
									</div>
									<div class="form-group">
										<input type="password" name="pass" id="pass" tabindex="5" class="form-control" placeholder="Password" required>
									</div>
									<div class="form-group">
										<input type="password" name="pass3" id="pass3" tabindex="5" class="form-control" placeholder="Confirm Password" required>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-sm-6 col-sm-offset-3">
												<input type="hidden" name="frmname" value="register">
												<input type="submit" id="register-submit" tabindex="6" class="form-control btn btn-register" value="Register">
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
		<?php
				
			if(!isset($_POST['frmname'])){
			}else if($_POST['frmname']=="login"){
				//checks that the form name is set to login
				$uname=$_POST['uname'];
				$pass=$_POST['pass'];
				
				if($uname!="" && $pass!=""){
					if($query=$pdo->prepare("SELECT `ID` FROM `users` WHERE `uname` = :uname")){
						$query->execute(array(':uname'=> $uname));
						$id=$query->fetch(PDO::FETCH_ASSOC);
						$id=$id['ID'];
					}//gets users id

					if($query=$pdo->prepare("SELECT `pass` FROM `users` WHERE `ID` = :id")){
						$query->execute(array(':id'=>$id));
						$pass2=$query->fetch(PDO::FETCH_ASSOC);
						$pass2=$pass2['pass'];
					}//gets users password

					if(password_verify($pass, $pass2)){
						if($query=$pdo->prepare("UPDATE `users` SET `hash` = :hash WHERE `ID` = :id")){
							$hash=md5($uname.$id.$pass.time());
							$query->execute(array(':hash'=>$hash, ':id'=>$id));
						}//checks that the input password is the same as the database password
						$_SESSION['hash']=$hash;
						$_SESSION['id']=$id;
						echo 'Successfully logged in!';
						echo '<script>
						window.location.replace("explore.php");
						</script>';//redirects to explore page
					}else{
						echo "<script>alert('Invalid username/password combination!');</script>";

					}
					
			}else{
						echo '<script>alert("Please fill out all fields!");</script>';
					}
				//checks if the form name is register
			}else if($_POST['frmname']=="register"){
				
				$fname=$_POST['fname'];
				$lname=$_POST['lname'];
				$uname=$_POST['uname'];
				$email=filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
				$pass=$_POST['pass'];
				$pass3=$_POST['pass3'];
				//sets variables, gets rid of extra accidental characters in the email address
				if($pass==$pass3){
				
					if($fname!="" && $lname!="" && $uname!="" && $email!="" && $pass!="" && $pass3!=""){

						if($query=$pdo->prepare("SELECT `uname` FROM `users` WHERE `uname` = :uname")){
							$query->execute(array(':uname'=>$uname));
							$uname2 = $query->fetch(PDO::FETCH_ASSOC);
							$uname2 = $uname2['uname'];
						}//makes sure that the username and email entered arent already taken

						if($query=$pdo->prepare("SELECT `email` FROM `users` WHERE `email` = :email")){
							$query->execute(array(':email'=>$email));
							$email2 = $query->fetch(PDO::FETCH_ASSOC);
							$email2 = $email2['email'];
						}

						if(filter_var($email, FILTER_VALIDATE_EMAIL)){
							if($email!=$email2 && $uname!=$uname2){//makes sure email is real, and email and username arent already taken
								$pass = password_hash($pass, PASSWORD_DEFAULT);//hashes password

								if($query=$pdo->prepare("INSERT INTO `users` (fname, lname, uname, email, pass) VALUES (:fname, :lname, :uname, :email, :pass)")){
									$query->execute(array($fname, $lname, $uname, $email, $pass));
									if($query=$pdo->prepare("SELECT `AUTO_INCREMENT` FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA =  'foodbook' AND TABLE_NAME =  'users'")){
										$query->execute();//gets the users id from the database before it is input
										$query=$query->fetch(PDO::FETCH_ASSOC);
										$id=$query['AUTO_INCREMENT']-1;
									}//creates user entry and meal planner entry
									if($query=$pdo->prepare("INSERT INTO `planners` (userID, recipes) VALUES (:userID, :recipes)")){
										$query->execute(array(':userID'=>$id, ':recipes'=>'{"1":"0","2":"0","3":"0","4":"0","5":"0","6":"0","7":"0","8":"0","9":"0","10":"0","11":"0","12":"0","13":"0","14":"0","15":"0","16":"0","17":"0","18":"0","19":"0","20":"0","21":"0"}'));
										echo '<script>alert("Successfully Registered!");</script>';
									}
								}else{
									echo '<script>alert("Failed to register! (Try again)");</script>';
								}//errors incase the register fails
							}else{
								echo '<script>alert("Username or email invalid!");</script>';
							}
						}else{
							echo '<script>alert("Invalid email!");</script>';
						}
					}else{
						echo '<script>alert("Please fill out all fields!");</script>';
					}
				}else{
					echo '<script>alert("Passwords do not match!");</script>';
				}
			}
			
		?>
	</body>
</html>
