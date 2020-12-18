<html>
<head>
	<?php
		include("database.php");
		session_start();
		if($query=$pdo->prepare("SELECT `hash` FROM `users` WHERE `ID`=:id")){
			$query->execute(array(':id'=>$_SESSION['id']));
			$result=$query->fetch(PDO::FETCH_ASSOC);
			$result=$result['hash'];//gets the users hash from the database
		}
		if($result!==$_SESSION['hash'] || !isset($_SESSION['hash'])  || !isset($_SESSION['id'])){
			echo '<script>
						window.location.replace("login.php");
						</script>';
		}else if($_SESSION['id']!=0){
			echo '<script>
						window.location.replace("explore.php");
						</script>';//checks that the logged in user to make sure that its the admin account, otherwise kicks them out
		}
	?>
  <title>FoodBook</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
    /* Remove the navbar's default rounded borders and increase the bottom margin */ 
    .navbar {
      margin-bottom: 0px;
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
		
	</style>

<div class="jumbotron">
	<center>
	</center>
  <div class="container text-center">
    <h1>FoodBook</h1>      
		<p>Admin</p>
  </div>
</div>

<nav class="navbar navbar-default" role="navigation">
		  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#"><img src="https://image.freepik.com/free-icon/fork-and-knife-cutlery-circle-interface-symbol-for-restaurant_318-61359.jpg"height=25px width=25px></a>
    </div>
    <ul class="nav navbar-nav">
      <li><a href="profile.php">My Recipes</a></li>
      <li><a href="mealplanner.php">Meal Planner</a></li>
      <li><a href="explore.php">Explore</a></li>
    </li>
  </ul>
		 <ul class="nav navbar-nav navbar-right">
			<li><a href="userSettings.php">Settings</a></li>
			<li class="active"><a href="admin.php">Admin</a></li><!--navbar-->
			<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
    </ul>
	</nav>
	
	
	
	<style>
		body {font-family: Arial;}

		/* Style the tab */
		.tab {
				overflow: hidden;
				border: 1px solid #ccc;
				background-color: #f1f1f1;
		}

		/* Style the buttons inside the tab */
		.tab button {
				background-color: inherit;
				float: left;
				border: none;
				outline: none;
				cursor: pointer;
				padding: 14px 16px;
				transition: 0.3s;
				font-size: 17px;
		}

		/* Create an active/current tablink class */
		.tab button.active {
				background-color: #ccc;
		}

		/* Style the tab content */
		.tabcontent {
				display: none;
				padding: 6px 12px;
				border: 1px solid #ccc;
				border-top: none;
		}
		.navbar {
      margin-bottom: 20px;
      border-radius: 0;
    }
		</style>
		</head>
		<body>
				<ul class="nav nav-tabs">
			<li class="active"><a data-toggle="tab" href="#users">Users</a></li>
			<li><a data-toggle="tab" href="#ingredients">Ingredients</a></li>
		</ul>

		<div class="tab-content">
			<div id="users" class="tab-pane fade in active">
				<h3>Users</h3>
				<?php
					if($query=$pdo->prepare("SELECT `AUTO_INCREMENT` FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'foodbook' AND TABLE_NAME = 'users'")){
						$query->execute();
						$query=$query->fetch(PDO::FETCH_ASSOC);
						$max=$query['AUTO_INCREMENT'];
						$max=$max-1;
					}//gets auto increment value to  read through users backwards(otherwise the same users always appear at the top)

					echo'
						<table id="myTable" width="83%" align="center" border="solid">
							<tr>
								<th width="1%" text-align="center">ID</th>
								<th width="20%" text-align="center">First Name</th>
								<th width="20%" text-align="center">Last Name</th> 
								<th width="20%" text-align="center">Username</th>
								<th width="20%" text-align="center">Email</th>
								<th width="2%"></th>
							</tr>';//starts table

					for($counter=1;$counter<=$max;$counter++){
						if($query=$pdo->prepare("SELECT * FROM `users` WHERE `ID` = :counter")){
							$query->execute(array(':counter'=>$counter));
							$result=$query->fetch(PDO::FETCH_ASSOC);
						}//gets user info from id as counter

						if($result['ID']!=""){
								echo '<tr><td text-align="center">';
									print_r($result['ID']);
									echo '<br>';
								echo'</td>
								<td text-align="center">';
									print_r($result['fname']);
									echo '<br>';
								echo'</td>
								<td text-align="center">';
									print_r($result['lname']);
									echo '<br>';
								echo'</td>
								<td text-align="center">';
									print_r($result['uname']);
									echo '<br>';
								echo'</td>
								<td text-align="center">';
									print_r($result['email']);
									echo '<br>';
								echo'</td>';
								echo'<td>
									<button class="btn btn-danger" id="delButton" type="button" onclick="deleteRow(this,'.$result['ID'].');"><span class="glyphicon glyphicon glyphicon-minus" aria-hidden="true"></span></button>';
									'</td>';
								echo'</tr>';//display the table with some of the user info, and a delete button to delete the user
						}
					}	
				echo'</table>';
				?>
			
					<script>
					function deleteRow(r,id){//deletes user
							$.ajax({url: "deleteUser.php?input="+id, success: function(result){
									var i = r.parentNode.parentNode.rowIndex;
									document.getElementById("myTable").deleteRow(i);
							}});
					}
					</script>
			</div>
			<div id="ingredients" class="tab-pane fade">
				<h3>Ingredients</h3>
				<?php
					if($query=$pdo->prepare("SELECT `AUTO_INCREMENT` FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'foodbook' AND TABLE_NAME = 'ingredients'")){
						$query->execute();
						$query=$query->fetch(PDO::FETCH_ASSOC);
						$max=$query['AUTO_INCREMENT'];
						$max=$max-1;//auto increment value to read through recipes without the same ones appearing at the top
					}

					echo'
						<table id="table2" align="center" width="80%" border="dashed">
							<tr>
								<th text-align="center">ID</th>
								<th text-align="center">Name</th>
								<th text-align="center">Tags</th> 
								<th></th>
							</tr>';

					for($counter=1;$counter<=$max;$counter++){
						if($query=$pdo->prepare("SELECT * FROM `ingredients` WHERE `ID` = :counter")){
							$query->execute(array(':counter'=>$counter));
							$result=$query->fetch(PDO::FETCH_ASSOC);
						}//gets the ingredient info to display in table

						if($result['ID']!=""){
							echo '<tr><td text-align="center">';
								print_r($result['ID']);
								echo '<br>';
							echo'</td>
							<td text-align="center">';
								print_r($result['name']);
								echo '<br>';
							echo'</td>
							<td text-align="center">';
								$tags=json_decode($result["tags"], true);
									echo 'Dairy: ';
									print_r($tags['dairy']);
									echo ', eggs: ';
									print_r($tags['eggs']);
									echo ', Peanuts: ';
									print_r($tags['peanuts']);
									echo ', Tree nuts: ';
									print_r($tags['nuts']);
									echo ', Soy: ';
									print_r($tags['soy']);
									echo ', Gluten: ';
									print_r($tags['gluten']);
									echo ', Fish: ';
									print_r($tags['fish']);
									echo ', Shellfish: ';
									print_r($tags['shellfish']);
									echo ', Corn Produts: ';
									print_r($tags['corn']);
									echo ', Gelatin: ';
									print_r($tags['gelatin']);
									echo ', Meat Products: ';
									print_r($tags['meat']);//display ingredient name and tags in a table
								echo '<br>';
							echo'</td>';
							echo'<td>
								<button class="btn btn-danger" id="dButton" type="button" onclick="delRow(this,'.$result['ID'].');"><span class="glyphicon glyphicon glyphicon-minus" aria-hidden="true"></span></button>';
							'</td>
							</tr>';//option to delete ingredient
							}	
					}
					echo'</table>';
				?>

					<script>
					function delRow(s,id){//deletes the entry after the ingredient is deleted to provide visual feedback
							$.ajax({url: "deleteIngredient.php?input="+id, success: function(result){
									var t = s.parentNode.parentNode.rowIndex;
									document.getElementById("table2").deleteRow(t);
							}});
					}
					</script>
			</div>
		</div>
		<script src="https://code.jquery.com/jquery-2.2.2.min.js"></script>
   <script src="/bootstrap/js/bootstrap.min.js"></script>
			</body>
	
</html>