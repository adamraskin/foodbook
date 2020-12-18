<html>
<head>
	<?php
		include('database.php');
		session_start();
		if($query=$pdo->prepare("SELECT `hash` FROM `users` WHERE `ID`=:id")){
			$query->execute(array(':id'=>$_SESSION['id']));
			$result=$query->fetch(PDO::FETCH_ASSOC);
			$result=$result['hash'];
		}//checks hash to confirm user
		if($result!==$_SESSION['hash'] || !isset($_SESSION['hash'])  || !isset($_SESSION['id'])){
			echo '<script>
						window.location.replace("login.php");
						</script>';
		}//checks that user is logged in
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
      <li><a href="profile.php">My Recipes</a></li><!--navbar-->
      <li><a href="mealplanner.php">Meal Planner</a></li>
      <li class="active"><a href="explore.php">Explore</a></li>
			<li><a href="geneticAlgorithm.php">Genetic Algorithm Test</a></li>
    </li>
  </ul>
		 <ul class="nav navbar-nav navbar-right">
			<li><a href="userSettings.php">Settings</a></li>
			<?php if($_SESSION['id']==0){echo '<li><a href="admin.php">Admin</a></li>';}//only display the link to the admin button if the user is logged in as admin?>
      <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
    </ul>
</nav>
		<?php
			if($query=$pdo->prepare("SELECT `AUTO_INCREMENT` FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA =  'foodbook' AND TABLE_NAME =  'recipes'")){
				$query->execute();
				$query=$query->fetch(PDO::FETCH_ASSOC);
				$counter=$query['AUTO_INCREMENT'];
				$max=$query['AUTO_INCREMENT'];
			}//auto increment value to count through recipes backwards
		do{

			echo '<div class="container">
 			<div class="row content">';
			
			$check=0;
			do{//loop to display each recipe in a row of 3
				$string="pictures/";
				 if($query=$pdo->prepare("SELECT * FROM `recipes` WHERE `ID` = :counter")){
							$query->execute(array($counter));
							$result=$query->fetch(PDO::FETCH_ASSOC);
							$string.=$result['picture'];
				 }
				if(isset($result) && $result!="" && $result['copy']==0){//if the copy id is not 0, its not displayed to avoid duplicate
					echo '<div class="col-sm-4">
					<div class="panel panel-success" id="'.$result['ID'].'">
						<div class="panel-heading">'; print_r($result['name']);
				$dairy=0;
				$eggs=0;
				$peanuts=0;
				$nuts=0;
				$soy=0;
				$gluten=0;
				$fish=0;
				$shellfish=0;
				$corn=0;
				$gelatin=0;
				$meat=0;
				$abbr=0;
				$tagsArray=array();
				foreach(json_decode($result['ingredients'], true) as $value){//ingredient array
					if($query=$pdo->prepare("SELECT `tags` FROM `ingredients` WHERE `ID`=:id")){
						$query->execute(array(':id'=>$value[2]));
						$tags=json_decode($query->fetch(PDO::FETCH_ASSOC)['tags'], true);
					}
					if($tags['dairy']==1){$tagsArray[0]="dairy";$abbr=1;}
					if($tags['eggs']==1){$tagsArray[1]="eggs";$abbr=1;}
					if($tags['peanuts']==1){$tagsArray[2]="peanuts";$abbr=1;}
					if($tags['nuts']==1){$tagsArray[3]="nuts";$abbr=1;}
					if($tags['soy']==1){$tagsArray[4]="soy";$abbr=1;}
					if($tags['gluten']==1){$tagsArray[5]="gluten";$abbr=1;}
					if($tags['fish']==1){$tagsArray[6]="fish";$abbr=1;}
					if($tags['shellfish']==1){$tagsArray[7]="shellfish";$abbr=1;}
					if($tags['corn']==1){$tagsArray[8]="corn";$abbr=1;}
					if($tags['gelatin']==1){$tagsArray[9]="gelatin";$abbr=1;}
					if($tags['meat']==1){$tagsArray[10]="meat";$abbr=1;}
				}
				if($abbr==1){//reads through the array and displays the allergy warnings in a warning tag
					echo '  <abbr title="This recipe contains: ';
					$tagsString=rtrim(implode(', ', $tagsArray), ', ');
					echo $tagsString;
					echo '"><img class="abbr" src="https://pngimg.com/uploads/exclamation_mark/exclamation_mark_PNG76.png"></img></abbr>';
				}//button to delete recipe shown to admin only
				if($_SESSION['id']==0){echo '<img src="https://vignette.wikia.nocookie.net/grimm/images/a/a5/X.png/revision/latest?cb=20161103004859" class="delete" onclick="remove('.$result['ID'].')" align="right" style="cursor:pointer"></img>';} echo '</div>
						<div class="panel-body" onclick="modal('.$result['ID'].')" data-toggle="modal" data-target="#myModal" style="cursor:pointer"><img src="';print_r($string); echo '" class="img-responsive" style="width:500px">';
					echo 'Description: ';  
					print_r($result['description']);
						echo '</div>
						<div class="panel-footer">';
							$numerator=0;
							$denominator=0;
							foreach(json_decode($result['ratings'], true) as $value){//gets the ratings array and displays an average rating
								$numerator=$numerator+$value;
								$denominator++;
							}
							$rating=round($numerator/$denominator);
							for($i=1;$i<=5;$i++){
								if($rating>=$i){echo '<img class="rate" src="pictures/fullstar.png"></img>';}
								else{echo '<img class="rate" src="emptystar.png"></img>';}
							}//button to save recipe to your own list
							echo '<br>out of '.$denominator.' ratings<button class="btn btn-xs btn-success" style="position: absolute; right: 25;" onclick="save('.$result['ID'].')">Save</button>
						</div>
					</div>
				</div>';
						$check++;
				}//counters used to display rows properly
				$counter--;
			}while($check<=2 && $counter>0);
			echo '</div></div><br>';
		}while($counter>0);
	?>
		<script>
			function save(id){//save recipe function
				$.ajax({url: 'saveRecipe.php?id='+id, success: function(result){
					alert("Saved!");
				}});
			}
			function remove(id){//delete recipe function
				$.ajax({url: 'removeRecipe.php?id='+id, success: function(result){
					var element = document.getElementById(id);
					element.setAttribute('style', 'opacity: 0.2');
				}});
			}
			function modal(id){//function to change contents of modal before its displayed
				$.ajax({url: 'getModal.php?id='+id+"&page=3", success: function(result){
					var element = document.getElementById('myModal');
					element.innerHTML = result;
					var user = "<?php echo $_SESSION['id'] ?>";
					rateShow(0, user, id);
				}});
			}
			function rate(id, user, recipe){
				console.log("rate");//function used to update your rating on a recipe
				$.ajax({url: "rate.php?id="+id+"&user="+user+"&recipe="+recipe+"&function=2", success: function(result){
					var rate = document.getElementById('rate');
						var remove = document.getElementById('textnode');
						remove.remove();
					var element = document.createElement("span");
					var textnode = document.createTextNode(result);
					element.setAttribute("id", "textnode");
					element.appendChild(textnode);
					rate.appendChild(element);
				}});
			}
			function rateShow(id, user, recipe){
				console.log("rateShow");//used to update how the rate widget  is displayed based on which star you're hovering over
				var rate = document.getElementById('rate');
				var star1 = document.getElementById('star1');
				var star2 = document.getElementById('star2');
				var star3 = document.getElementById('star3');
				var star4 = document.getElementById('star4');
				var star5 = document.getElementById('star5');
				if(id==0){
					$.ajax({url: "rate.php?id="+id+"&recipe="+recipe+"&function=1", success: function(result){
						var rate = document.getElementById('rate');
						for(var i=1;i<=5;i++){//displays the average rating
							if(result>=i){eval("star"+i+".innerHTML = '<img style=\"cursor:pointer\" src=\"pictures/fullstar.png\" class=\"rate\" onclick=\"rate(1, '+user+', '+recipe+')\" onmousemove=\"rateShow(1, '+user+', '+recipe+')\"></img>';");}
							else{eval("star"+i+".innerHTML = '<img style=\"cursor:pointer\" src=\"pictures/emptystar.png\" class=\"rate\" onclick=\"rate(1, '+user+', '+recipe+')\" onmousemove=\"rateShow(1, '+user+', '+recipe+')\"></img>';");}
						}
					}});
				}
				if(id==1){//displays amount of stars based on which star is hovered over
					star1.innerHTML = '<img style="cursor:pointer" src="pictures/fullstar.png" class="rate" onclick="rate(1, '+user+', '+recipe+')" onmousemove="rateShow(1, '+user+', '+recipe+')"></img>';
					star2.innerHTML = '<img style="cursor:pointer" src="pictures/emptystar.png" class="rate" onclick="rate(2, '+user+', '+recipe+')" onmousemove="rateShow(2, '+user+', '+recipe+')"></img>';
					star3.innerHTML = '<img style="cursor:pointer" src="pictures/emptystar.png" class="rate" onclick="rate(3, '+user+', '+recipe+')" onmousemove="rateShow(3, '+user+', '+recipe+')"></img>';
					star4.innerHTML = '<img style="cursor:pointer" src="pictures/emptystar.png" class="rate" onclick="rate(4, '+user+', '+recipe+')" onmousemove="rateShow(4, '+user+', '+recipe+')"></img>';
					star5.innerHTML = '<img style="cursor:pointer" src="pictures/emptystar.png" class="rate" onclick="rate(5, '+user+', '+recipe+')" onmousemove="rateShow(5, '+user+', '+recipe+')"></img>';
				}
				if(id==2){
					star1.innerHTML = '<img style="cursor:pointer" src="pictures/fullstar.png" class="rate" onclick="rate(1, '+user+', '+recipe+')" onmousemove="rateShow(1, '+user+', '+recipe+')"></img>';
					star2.innerHTML = '<img style="cursor:pointer" src="pictures/fullstar.png" class="rate" onclick="rate(2, '+user+', '+recipe+')" onmousemove="rateShow(2, '+user+', '+recipe+')"></img>';
					star3.innerHTML = '<img style="cursor:pointer" src="pictures/emptystar.png" class="rate" onclick="rate(3, '+user+', '+recipe+')" onmousemove="rateShow(3, '+user+', '+recipe+')"></img>';
					star4.innerHTML = '<img style="cursor:pointer" src="pictures/emptystar.png" class="rate" onclick="rate(4, '+user+', '+recipe+')" onmousemove="rateShow(4, '+user+', '+recipe+')"></img>';
					star5.innerHTML = '<img style="cursor:pointer" src="pictures/emptystar.png" class="rate" onclick="rate(5, '+user+', '+recipe+')" onmousemove="rateShow(5, '+user+', '+recipe+')"></img>';
				}
				if(id==3){
					star1.innerHTML = '<img style="cursor:pointer" src="pictures/fullstar.png" class="rate" onclick="rate(1, '+user+', '+recipe+')" onmousemove="rateShow(1, '+user+', '+recipe+')"></img>';
					star2.innerHTML = '<img style="cursor:pointer" src="pictures/fullstar.png" class="rate" onclick="rate(2, '+user+', '+recipe+')" onmousemove="rateShow(2, '+user+', '+recipe+')"></img>';
					star3.innerHTML = '<img style="cursor:pointer" src="pictures/fullstar.png" class="rate" onclick="rate(3, '+user+', '+recipe+')" onmousemove="rateShow(3, '+user+', '+recipe+')"></img>';
					star4.innerHTML = '<img style="cursor:pointer" src="pictures/emptystar.png" class="rate" onclick="rate(4, '+user+', '+recipe+')" onmousemove="rateShow(4, '+user+', '+recipe+')"></img>';
					star5.innerHTML = '<img style="cursor:pointer" src="pictures/emptystar.png" class="rate" onclick="rate(5, '+user+', '+recipe+')" onmousemove="rateShow(5, '+user+', '+recipe+')"></img>';
				}
				if(id==4){
					star1.innerHTML = '<img style="cursor:pointer" src="pictures/fullstar.png" class="rate" onclick="rate(1, '+user+', '+recipe+')" onmousemove="rateShow(1, '+user+', '+recipe+')"></img>';
					star2.innerHTML = '<img style="cursor:pointer" src="pictures/fullstar.png" class="rate" onclick="rate(2, '+user+', '+recipe+')" onmousemove="rateShow(2, '+user+', '+recipe+')"></img>';
					star3.innerHTML = '<img style="cursor:pointer" src="pictures/fullstar.png" class="rate" onclick="rate(3, '+user+', '+recipe+')" onmousemove="rateShow(3, '+user+', '+recipe+')"></img>';
					star4.innerHTML = '<img style="cursor:pointer" src="pictures/fullstar.png" class="rate" onclick="rate(4, '+user+', '+recipe+')" onmousemove="rateShow(4, '+user+', '+recipe+')"></img>';
					star5.innerHTML = '<img style="cursor:pointer" src="pictures/emptystar.png" class="rate" onclick="rate(5, '+user+', '+recipe+')" onmousemove="rateShow(5, '+user+', '+recipe+')"></img>';
				}
				if(id==5){
					star1.innerHTML = '<img style="cursor:pointer" src="pictures/fullstar.png" class="rate" onclick="rate(1, '+user+', '+recipe+')" onmousemove="rateShow(1, '+user+', '+recipe+')"></img>';
					star2.innerHTML = '<img style="cursor:pointer" src="pictures/fullstar.png" class="rate" onclick="rate(2, '+user+', '+recipe+')" onmousemove="rateShow(2, '+user+', '+recipe+')"></img>';
					star3.innerHTML = '<img style="cursor:pointer" src="pictures/fullstar.png" class="rate" onclick="rate(3, '+user+', '+recipe+')" onmousemove="rateShow(3, '+user+', '+recipe+')"></img>';
					star4.innerHTML = '<img style="cursor:pointer" src="pictures/fullstar.png" class="rate" onclick="rate(4, '+user+', '+recipe+')" onmousemove="rateShow(4, '+user+', '+recipe+')"></img>';
					star5.innerHTML = '<img style="cursor:pointer" src="pictures/fullstar.png" class="rate" onclick="rate(5, '+user+', '+recipe+')" onmousemove="rateShow(5, '+user+', '+recipe+')"></img>';
				}
			}
		</script>
		<div id="myModal" class="modal fade" role="dialog">
		</div>
</body>
</html>
