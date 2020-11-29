<html>
<head>
	<?php
		include('database.php');
		session_start();
		if($query=$pdo->prepare("SELECT `hash` FROM `users` WHERE `ID`=:id")){
			$query->execute(array(':id'=>$_SESSION['id']));
			$result=$query->fetch(PDO::FETCH_ASSOC);
			$result=$result['hash'];
		}
		if($result!==$_SESSION['hash'] || !isset($_SESSION['hash'])  || !isset($_SESSION['id'])){
			echo '<script>
						window.location.replace("login.php");
						</script>';
		}
	?>
  <title>FoodBook</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
		.container .img-responsive {
      height: 250px;
    }
		
		.container .panel-body {
      height: 320px;
    }
		
    .navbar {
      margin-bottom: 50px;
      border-radius: 0;
    }
    
    /* Remove the jumbotron's default bottom margin */ 
     .jumbotron {
      margin-bottom: 0;
    }
   
    /* Add a gray background color and some padding to the footer */
    footer {
      background-color: #f2f2f2;
      padding: 25px;
    }
  </style>
</head>
<body>
	<style>
		
		.container .img-responsive {
      height: 250px;
    }
		
		.center-block {
			height: 250px;
		}
		
		.jumbotron {
    position: relative;
    background: #000 url("pictures/spread.jpg") center center;
    width: 100%;
    height: 30%;
    background-size: cover;
    overflow: hidden;
		}
		.jumbotron h1 {
			color: whitesmoke;
			text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black;
		}
		.jumbotron p {
			color: whitesmoke;
			text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black;
		}
		.rate {
			height: 21px;
			width: 23px;
		}
		.delete {
			height: 16px;
			width: 16px;
		}
		.abbr {
			height: 16px;
			width: 16px;
		}
	</style>

<div class="jumbotron">
	<center>
	</center>
  <div class="container text-center">
    <h1>FoodBook</h1>      
    <p>Explore</p>
  </div>
</div>

<nav class="navbar navbar-default" role="navigation">
		  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand"><img src="https://image.freepik.com/free-icon/fork-and-knife-cutlery-circle-interface-symbol-for-restaurant_318-61359.jpg"height=25px width=25px></a>
    </div>
    <ul class="nav navbar-nav">
      <li><a href="profile.php">My Recipes</a></li>
      <li><a href="mealplanner.php">Meal Planner</a></li>
      <li><a href="explore.php">Explore</a></li>
    </li>
  </ul>
		 <ul class="nav navbar-nav navbar-right">
			 <li class="active"><a href="userSettings.php">Settings</a></li>
			<?php if($_SESSION['id']==0){echo '<li><a href="admin.php">Admin</a></li>';}?>
      <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
    </ul>
</nav>
	
	<style>

	.formContainer {
    border: 1px solid grey;
		width: 50%;
		height: 250px;
		position: relative;
		z-index: 1;
		text-align: center;
		margin-left: 25%;
		margin-bottom: 50px;
		border-radius: 8px;
}
		
	.formContainer2 {
    border: 1px solid grey;
		width: 50%;
		height: 250px;
		position: relative;
		z-index: 1;
		text-align: center;
		margin-left: 25%;
		border-radius: 8px;
}
		
	.formContainer3 {
    border: 1px solid grey;
		width: 50%;
		height: 250px;
		position: relative;
		z-index: 1;
		text-align: center;
		margin-left: 25%;
		margin-top: 50px;
		margin-bottom: 50px;
		border-radius: 8px;
}	
		
		.email, .email2, .pass, .uname, .uname2, .pass2, .pass3, .pass4, .pass5 {
			width: 60%;
			height: 30px;
		}
		
	</style>
	
			<div class="formContainer">
				<form action="" method="POST">
					<h3>Change Email</h3>
					<div class="form-group">
						<input type="email" class="email" name="email" id="email" tabindex="1" placeholder="Current email" required>
					</div>
					<div class="form-group">
						<input type="email" class="email2" name="email2" id="email2" tabindex="2" placeholder="New Email" required>
					</div>
					<div class="form-group">
						<input type="password" class="pass" name="pass" id="pass" tabindex="3" placeholder="Password" required>
					</div>
					<input type="hidden" name="frmname" value="email">
					<input type="submit" class="btn btn-success" tabindex="4" value="Change Email">
				</form>
			</div>
		<div class=formcontainer2>
			<form action="" method="POST">
				<h3>Change Username</h3>
				<div class="form-group">
					<input type="text" class="uname" name="uname" id="uname" tabindex="5" placeholder="Current Username" required>
				</div>
				<div class="form-group">
					<input type="text" class="uname2" name="uname2" id="uname2" tabindex="6" placeholder="New Username" required>
				</div>
				<div class="form-group">
					<input type="password" class="pass2" name="pass2" id="pass2" tabindex="7" placeholder="Password" required>
				</div>
				<input type="hidden" name="frmname" value="uname">
				<input type="submit" class="btn btn-success" tabindex="8" value="Change Username">
			</form>
		</div>
		<div class="formcontainer3">
			<form action="" method="POST">
				<h3>Change Password</h3>
				<div class="form-group">
					<input type="password" class="pass3" name="pass3" id="pass3" tabindex="9" placeholder="Current Password" required>
				</div>
				<div class="form-group">
					<input type="password" class="pass4" name="pass4" id="pass4" tabindex="10" placeholder="New Password" required>
				</div>
				<div class="form-group">
					<input type="password" class="pass5" name="pass5" id="pass5" tabindex="11" placeholder="Confirm New Password" required>
				</div>
				<input type="hidden" name="frmname" value="password">
				<input type="submit" class="btn btn-success" tabindex="12" value="Change Password">
			</form>
		</div>
	
				<?php	
					if(isset($_POST['frmname'])){
						if($_POST['frmname']=="email"){
							$email=$_POST['email'];
							$email2=$_POST['email2'];
							$pass=$_POST['pass'];
							if($query=$pdo->prepare("SELECT * FROM `users` WHERE `ID` = :id")){
								$query->execute(array(':id'=>$_SESSION['id']));
								$result=$query->fetch(PDO::FETCH_ASSOC);
								$id=$result['ID'];
								$pass2=$result['pass'];
							}
							if($query=$pdo->prepare("SELECT `email` FROM `users` WHERE `email` = :email")){
								$query->execute(array(':email'=>$email2));
								$check=$query->fetch(PDO::FETCH_ASSOC);
								$check=$check['email'];
							}
							if($check==""){
								if($result['email'] == $email){
									if(password_verify($pass, $pass2)){
										if($query=$pdo->prepare("UPDATE `users` SET `email` = :email WHERE `ID` = :id")){
											$query->execute(array(':email'=>$email2, ':id'=>$_SESSION['id']));
											echo 'Email updated!';
										}
									}else{
									echo 'Incorrect password!';
								}
								}else{
									echo 'Incorrect email!';
								}
							}else{
									echo 'Email already in use!';
								}
						}
					}
				?>
				
				<?php	
					if(isset($_POST['frmname'])){
						if($_POST['frmname']=="uname"){
							$uname=$_POST['uname'];
							$uname2=$_POST['uname2'];
							$pass2=$_POST['pass'];
							if($query=$pdo->prepare("SELECT * FROM `users` WHERE `ID` = :id")){
								$query->execute(array(':id'=>$_SESSION['id']));
								$result=$query->fetch(PDO::FETCH_ASSOC);
								$id=$result['ID'];
								$pass=$result['pass'];
							}
							if($query=$pdo->prepare("SELECT `uname` FROM `users` WHERE `uname` = :uname")){
								$query->execute(array(':uname'=>$uname2));
								$check=$query->fetch(PDO::FETCH_ASSOC);
								$check=$check['uname'];
							}
							
							if($check==""){
								if($result['uname'] == $uname){
									if(password_verify($pass, $pass2)){
										if($query=$pdo->prepare("UPDATE `users` SET `uname` = :uname WHERE `ID` = :id")){
											$query->execute(array(':uname'=>$uname2, ':id'=>$_SESSION['id']));
											echo 'Username Updated!';
										}
									}else{
									echo 'Incorrect password!';
								}
								}else{
									echo 'Incorrect Username!';
								}
							}else{
									echo 'Username already in use!';
								}
						}
					}
				?>
			
				<?php	
					if(isset($_POST['frmname'])){
						if($_POST['frmname']=="password"){
							$originalPass=$_POST['pass3'];
							$newPass=$_POST['pass4'];
							$confirmPass=$_POST['pass5'];
							$hashPass = password_hash($newPass, PASSWORD_DEFAULT);
							
							if($query=$pdo->prepare("SELECT * FROM `users` WHERE `ID` = :id")){
								$query->execute(array(':id'=>$_SESSION['id']));
								$result=$query->fetch(PDO::FETCH_ASSOC);
								$id=$result['ID'];
								$DBpass=$result['pass'];
							}
							
								if($newPass == $confirmPass){
									if(password_verify($originalPass, $DBpass)){
										if($query=$pdo->prepare("UPDATE `users` SET `pass` = :pass WHERE `ID` = :id")){
											$query->execute(array(':pass'=>$hashPass, ':id'=>$_SESSION['id']));

											echo 'Password Updated!';
										}
									}else{
									echo 'Incorrect password!';
									}
								}
						}
					}
				?>
	
	
	
	
	</body>
</html>