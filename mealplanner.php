<html>

	<head>
	<?php
		include("database.php");
		session_start();
		if($query=$pdo->prepare("SELECT `hash` FROM `users` WHERE `ID`=:id")){
			$query->execute(array(':id'=>$_SESSION['id']));
			$result=$query->fetch(PDO::FETCH_ASSOC);
			$result=$result['hash'];
		}//checks suer login info
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
    /* Remove the navbar's default rounded borders and increase the bottom margin */ 
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
		.abbr {
			height: 16px;
			width: 16px;
		}

  </style>
</head>
<body>

<div class="jumbotron">
	<center>
	</center>
  <div class="container text-center">
    <h1>FoodBook</h1>      
    <p>Meal Planner</p>
  </div>
</div>

<nav class="navbar navbar-default" role="navigation">
		  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand"><img src="https://image.freepik.com/free-icon/fork-and-knife-cutlery-circle-interface-symbol-for-restaurant_318-61359.jpg" height="25px" width="25px"></a>
    </div>
    <ul class="nav navbar-nav">
      <li><a href="profile.php">My Recipes</a></li>
      <li class="active"><a href="mealplanner.php">Meal Planner</a></li>
      <li><a href="explore.php">Explore</a></li>
    </li><!--navbar-->
  </ul>
		 <ul class="nav navbar-nav navbar-right">
			<li><a href="userSettings.php">Settings</a></li>
			<?php if($_SESSION['id']==0){echo '<li><a href="admin.php">Admin</a></li>';}//only displays admin link to admin account?>
      <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
    </ul>
</nav>

<style>
	
	.planner {
		height: 100px;
		width: 100px;
	}
	.link {
		text-align: right;
		color: blue;
		text-decoration: underline;
		cursor: pointer;
	}

</style>

<?php //get recipe info
	if($query=$pdo->prepare("SELECT `recipes` FROM `planners` WHERE `userID` = :id")){
		$query->execute(array(':id'=>$_SESSION['id']));
		$recipes=json_decode($query->fetch(PDO::FETCH_ASSOC)['recipes'], true);
	 }
	$counter=0;
	?>
	<table class="table table-bordered">
		<thead>
				<tr><!--table header-->
						<th style="width:10%">Day</th>
						<th style="width:10%">Sunday</th>
						<th style="width:10%">Monday</th>
						<th style="width:10%">Tuesday</th>
						<th style="width:10%">Wednesday</th>
						<th style="width:10%">Thursday</th>
						<th style="width:10%">Friday</th>
						<th style="width:10%">Saturday</th>
				</tr>
		</thead>
		<tbody>
				<tr><!--table row with each sections set to display current recipe and have modal to get more info on recipe or pick new recipe-->
						<td class="col-sm-1" style="width:10%"><b><h2>Breakfast</h2></b></td>
						<?php if($query=$pdo->prepare("SELECT `name`,`picture` FROM `recipes` WHERE `ID`=:recipe")){ $counter++; $query->execute(array(':recipe'=>$recipes[$counter])); $result=$query->fetch(PDO::FETCH_ASSOC); $name=$result['name']; $picture="pictures/".$result['picture'];}?>
						<td class="col-sm-1" style="width:10%"><div onclick="modal(1)" data-toggle="modal" data-target="#myModal" style="cursor:pointer"><img class="planner" src="<? echo $picture; ?>"></img><br><? echo $name; ?></div></td>
						<?php if($query=$pdo->prepare("SELECT `name`,`picture` FROM `recipes` WHERE `ID`=:recipe")){ $counter++; $query->execute(array(':recipe'=>$recipes[$counter])); $result=$query->fetch(PDO::FETCH_ASSOC); $name=$result['name']; $picture="pictures/".$result['picture'];}?>
						<td class="col-sm-1" style="width:10%"><div onclick="modal(2)" data-toggle="modal" data-target="#myModal" style="cursor:pointer"><img class="planner" src="<? echo $picture; ?>"></img><br><? echo $name; ?></div></td>
						<?php if($query=$pdo->prepare("SELECT `name`,`picture` FROM `recipes` WHERE `ID`=:recipe")){ $counter++; $query->execute(array(':recipe'=>$recipes[$counter])); $result=$query->fetch(PDO::FETCH_ASSOC); $name=$result['name']; $picture="pictures/".$result['picture'];}?>
						<td class="col-sm-1" style="width:10%"><div onclick="modal(3)" data-toggle="modal" data-target="#myModal" style="cursor:pointer"><img class="planner" src="<? echo $picture; ?>"></img><br><? echo $name; ?></div></td>
						<?php if($query=$pdo->prepare("SELECT `name`,`picture` FROM `recipes` WHERE `ID`=:recipe")){ $counter++; $query->execute(array(':recipe'=>$recipes[$counter])); $result=$query->fetch(PDO::FETCH_ASSOC); $name=$result['name']; $picture="pictures/".$result['picture'];}?>
						<td class="col-sm-1" style="width:10%"><div onclick="modal(4)" data-toggle="modal" data-target="#myModal" style="cursor:pointer"><img class="planner" src="<? echo $picture; ?>"></img><br><? echo $name; ?></div></td>
						<?php if($query=$pdo->prepare("SELECT `name`,`picture` FROM `recipes` WHERE `ID`=:recipe")){ $counter++; $query->execute(array(':recipe'=>$recipes[$counter])); $result=$query->fetch(PDO::FETCH_ASSOC); $name=$result['name']; $picture="pictures/".$result['picture'];}?>
						<td class="col-sm-1" style="width:10%"><div onclick="modal(5)" data-toggle="modal" data-target="#myModal" style="cursor:pointer"><img class="planner" src="<? echo $picture; ?>"></img><br><? echo $name; ?></div></td>
						<?php if($query=$pdo->prepare("SELECT `name`,`picture` FROM `recipes` WHERE `ID`=:recipe")){ $counter++; $query->execute(array(':recipe'=>$recipes[$counter])); $result=$query->fetch(PDO::FETCH_ASSOC); $name=$result['name']; $picture="pictures/".$result['picture'];}?>
						<td class="col-sm-1" style="width:10%"><div onclick="modal(6)" data-toggle="modal" data-target="#myModal" style="cursor:pointer"><img class="planner" src="<? echo $picture; ?>"></img><br><? echo $name; ?></div></td>
						<?php if($query=$pdo->prepare("SELECT `name`,`picture` FROM `recipes` WHERE `ID`=:recipe")){ $counter++; $query->execute(array(':recipe'=>$recipes[$counter])); $result=$query->fetch(PDO::FETCH_ASSOC); $name=$result['name']; $picture="pictures/".$result['picture'];}?>
						<td class="col-sm-1" style="width:10%"><div onclick="modal(7)" data-toggle="modal" data-target="#myModal" style="cursor:pointer"><img class="planner" src="<? echo $picture; ?>"></img><br><? echo $name; ?></div></td>
				</tr>
				<tr><!--same as row 1-->
						<td class="col-sm-1" style="width:10%"><b><h2>Lunch</h2></b></td>
						<?php if($query=$pdo->prepare("SELECT `name`,`picture` FROM `recipes` WHERE `ID`=:recipe")){ $counter++; $query->execute(array(':recipe'=>$recipes[$counter])); $result=$query->fetch(PDO::FETCH_ASSOC); $name=$result['name']; $picture="pictures/".$result['picture'];}?>
						<td class="col-sm-1" style="width:10%"><div onclick="modal(8)" data-toggle="modal" data-target="#myModal" style="cursor:pointer"><img class="planner" src="<? echo $picture; ?>"></img><br><? echo $name; ?></div></td>
						<?php if($query=$pdo->prepare("SELECT `name`,`picture` FROM `recipes` WHERE `ID`=:recipe")){ $counter++; $query->execute(array(':recipe'=>$recipes[$counter])); $result=$query->fetch(PDO::FETCH_ASSOC); $name=$result['name']; $picture="pictures/".$result['picture'];}?>
						<td class="col-sm-1" style="width:10%"><div onclick="modal(9)" data-toggle="modal" data-target="#myModal" style="cursor:pointer"><img class="planner" src="<? echo $picture; ?>"></img><br><? echo $name; ?></div></td>
						<?php if($query=$pdo->prepare("SELECT `name`,`picture` FROM `recipes` WHERE `ID`=:recipe")){ $counter++; $query->execute(array(':recipe'=>$recipes[$counter])); $result=$query->fetch(PDO::FETCH_ASSOC); $name=$result['name']; $picture="pictures/".$result['picture'];}?>
						<td class="col-sm-1" style="width:10%"><div onclick="modal(10)" data-toggle="modal" data-target="#myModal" style="cursor:pointer"><img class="planner" src="<? echo $picture; ?>"></img><br><? echo $name; ?></div></td>
						<?php if($query=$pdo->prepare("SELECT `name`,`picture` FROM `recipes` WHERE `ID`=:recipe")){ $counter++; $query->execute(array(':recipe'=>$recipes[$counter])); $result=$query->fetch(PDO::FETCH_ASSOC); $name=$result['name']; $picture="pictures/".$result['picture'];}?>
						<td class="col-sm-1" style="width:10%"><div onclick="modal(11)" data-toggle="modal" data-target="#myModal" style="cursor:pointer"><img class="planner" src="<? echo $picture; ?>"></img><br><? echo $name; ?></div></td>
						<?php if($query=$pdo->prepare("SELECT `name`,`picture` FROM `recipes` WHERE `ID`=:recipe")){ $counter++; $query->execute(array(':recipe'=>$recipes[$counter])); $result=$query->fetch(PDO::FETCH_ASSOC); $name=$result['name']; $picture="pictures/".$result['picture'];}?>
						<td class="col-sm-1" style="width:10%"><div onclick="modal(12)" data-toggle="modal" data-target="#myModal" style="cursor:pointer"><img class="planner" src="<? echo $picture; ?>"></img><br><? echo $name; ?></div></td>
						<?php if($query=$pdo->prepare("SELECT `name`,`picture` FROM `recipes` WHERE `ID`=:recipe")){ $counter++; $query->execute(array(':recipe'=>$recipes[$counter])); $result=$query->fetch(PDO::FETCH_ASSOC); $name=$result['name']; $picture="pictures/".$result['picture'];}?>
						<td class="col-sm-1" style="width:10%"><div onclick="modal(13)" data-toggle="modal" data-target="#myModal" style="cursor:pointer"><img class="planner" src="<? echo $picture; ?>"></img><br><? echo $name; ?></div></td>
						<?php if($query=$pdo->prepare("SELECT `name`,`picture` FROM `recipes` WHERE `ID`=:recipe")){ $counter++; $query->execute(array(':recipe'=>$recipes[$counter])); $result=$query->fetch(PDO::FETCH_ASSOC); $name=$result['name']; $picture="pictures/".$result['picture'];}?>
						<td class="col-sm-1" style="width:10%"><div onclick="modal(14)" data-toggle="modal" data-target="#myModal" style="cursor:pointer"><img class="planner" src="<? echo $picture; ?>"></img><br><? echo $name; ?></div></td>
				</tr>
				<tr><!--same as row 1-->
						<td class="col-sm-1" style="width:10%"><b><h2>Dinner</h2></b></td>
						<?php if($query=$pdo->prepare("SELECT `name`,`picture` FROM `recipes` WHERE `ID`=:recipe")){ $counter++; $query->execute(array(':recipe'=>$recipes[$counter])); $result=$query->fetch(PDO::FETCH_ASSOC); $name=$result['name']; $picture="pictures/".$result['picture'];}?>
						<td class="col-sm-1" style="width:10%"><div onclick="modal(15)" data-toggle="modal" data-target="#myModal" style="cursor:pointer"><img class="planner" src="<? echo $picture; ?>"></img><br><? echo $name; ?></div></td>
						<?php if($query=$pdo->prepare("SELECT `name`,`picture` FROM `recipes` WHERE `ID`=:recipe")){ $counter++; $query->execute(array(':recipe'=>$recipes[$counter])); $result=$query->fetch(PDO::FETCH_ASSOC); $name=$result['name']; $picture="pictures/".$result['picture'];}?>
						<td class="col-sm-1" style="width:10%"><div onclick="modal(16)" data-toggle="modal" data-target="#myModal" style="cursor:pointer"><img class="planner" src="<? echo $picture; ?>"></img><br><? echo $name; ?></div></td>
						<?php if($query=$pdo->prepare("SELECT `name`,`picture` FROM `recipes` WHERE `ID`=:recipe")){ $counter++; $query->execute(array(':recipe'=>$recipes[$counter])); $result=$query->fetch(PDO::FETCH_ASSOC); $name=$result['name']; $picture="pictures/".$result['picture'];}?>
						<td class="col-sm-1" style="width:10%"><div onclick="modal(17)" data-toggle="modal" data-target="#myModal" style="cursor:pointer"><img class="planner" src="<? echo $picture; ?>"></img><br><? echo $name; ?></div></td>
						<?php if($query=$pdo->prepare("SELECT `name`,`picture` FROM `recipes` WHERE `ID`=:recipe")){ $counter++; $query->execute(array(':recipe'=>$recipes[$counter])); $result=$query->fetch(PDO::FETCH_ASSOC); $name=$result['name']; $picture="pictures/".$result['picture'];}?>
						<td class="col-sm-1" style="width:10%"><div onclick="modal(18)" data-toggle="modal" data-target="#myModal" style="cursor:pointer"><img class="planner" src="<? echo $picture; ?>"></img><br><? echo $name; ?></div></td>
						<?php if($query=$pdo->prepare("SELECT `name`,`picture` FROM `recipes` WHERE `ID`=:recipe")){ $counter++; $query->execute(array(':recipe'=>$recipes[$counter])); $result=$query->fetch(PDO::FETCH_ASSOC); $name=$result['name']; $picture="pictures/".$result['picture'];}?>
						<td class="col-sm-1" style="width:10%"><div onclick="modal(19)" data-toggle="modal" data-target="#myModal" style="cursor:pointer"><img class="planner" src="<? echo $picture; ?>"></img><br><? echo $name; ?></div></td>
						<?php if($query=$pdo->prepare("SELECT `name`,`picture` FROM `recipes` WHERE `ID`=:recipe")){ $counter++; $query->execute(array(':recipe'=>$recipes[$counter])); $result=$query->fetch(PDO::FETCH_ASSOC); $name=$result['name']; $picture="pictures/".$result['picture'];}?>
						<td class="col-sm-1" style="width:10%"><div onclick="modal(20)" data-toggle="modal" data-target="#myModal" style="cursor:pointer"><img class="planner" src="<? echo $picture; ?>"></img><br><? echo $name; ?></div></td>
						<?php if($query=$pdo->prepare("SELECT `name`,`picture` FROM `recipes` WHERE `ID`=:recipe")){ $counter++; $query->execute(array(':recipe'=>$recipes[$counter])); $result=$query->fetch(PDO::FETCH_ASSOC); $name=$result['name']; $picture="pictures/".$result['picture'];}?>
						<td class="col-sm-1" style="width:10%"><div onclick="modal(21)" data-toggle="modal" data-target="#myModal" style="cursor:pointer"><img class="planner" src="<? echo $picture; ?>"></img><br><? echo $name; ?></div></td>
				</tr>
		</tbody>
</table>
<button type="button" class="btn btn-primary" style="margin-left:20px" onclick="emptyPlanner()">Clear Planner</button>
<p class="link" data-toggle="modal" data-target="#groceryModal" style="padding-right:20px;">Have some ingredients already?</p>
<script>
	var input;
	function modal(place){//shows modal
		var element = document.getElementById("myModal");
		$.ajax({url: "mealplannerModal.php?place="+place+"&function=1", success: function(result){
			element.innerHTML = result;
		}});
	}
	function set(){//sets value when the select in the modal is updated
		input = document.getElementById("input").value;
	}
	function save(place, id){//saves the recipe to the mealplanner
		$.ajax({url: "mealplannerModal.php?place="+place+"&id="+id+"&function=2", success: function(result){
			document.location.reload();
		}});
	}
	function emptyPlanner(){//clears out the entire planner
			$.ajax({url: "mealplannerModal.php?place=0&id=0&function=2", success: function(result){
		}});
		document.location.reload();
	}
</script>
<div id="myModal" class="modal fade" role="dialog">
</div>
<div class="modal fade" id="groceryModal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Find recipes with ingredients you already have!</h4>
        </div><!--grocery list modal-->
        <div class="modal-body">
				<form action="" method="POST" id="input">
          <label>Ingredients</label>
				<?php
					echo "<div id=\"fields\"><div class=\"ingredient1\"><input type=\"number\" name=\"quantity1\" id=\"quantity1\" placeholder=\"Quantity\" min=\"1\" required><select form=\"input\" name=\"measurement1\" id=\"measurement1\">
						<option value=\"Cup(s) of\">Cup(s) of</option>
						<option value=\"Pint(s) of\">Pint(s) of</option>
						<option value=\"Quart(s) of\">Quart(s) of</option>
						<option value=\"Milliliter(s) of\">Milliliter(s) of</option>
						<option value=\"Drop(s) of\">Drop(s) of</option>
						<option value=\"Dashe(s) of\">Dashe(s) of</option>
						<option value=\"Pinche(s) of\">Pinche(s) of</option>
						<option value=\"Litre(s) of\">Litre(s) of</option>
						<option value=\"Teaspoon(s) of\">Teaspoon(s) of</option>
						<option value=\"Tablespoon(s) of\">Tablespoon(s) of</option>
						<option value=\"Pound(s) of\">Pound(s) of</option>
						<option value=\"Ounce(s) of\">Ounce(s) of</option>
						<option value=\"Fluid Ounce(s) of\">Fluid Ounce(s) of</option>
						<option value=\"Gram(s) of\">Gram(s) of</option>
						<option value=\"singular\">Unit(s) of</option>
						</select>";
							//ingredient input
							echo "<select form=\"input\" name=\"ingredient1\" id=\"ingredient1\">";
							if($query=$pdo->prepare("SELECT `AUTO_INCREMENT` FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA =  'wcss_recipe' AND TABLE_NAME =  'ingredients'")){
								$query->execute();
								$query=$query->fetch(PDO::FETCH_ASSOC);
								$max=$query['AUTO_INCREMENT'];
							}
							for($counter=1;$counter<=$max;$counter++){
								if($query=$pdo->prepare("SELECT * FROM `ingredients` WHERE `ID`= :counter")){
									$query->execute(array($counter));
									$query=$query->fetch(PDO::FETCH_ASSOC);
									$result=json_decode($query["tags"], true);
									$name=$query["name"];
									$id=$query["ID"];
								}//after the ingredients are put in it will check database to find most relevant recipe
							if($query['ID']!=""){
								echo "<option value=\"";print_r($id);echo"\">";print_r($name);echo"</option>";
							}
						}
							echo "</select>   <button class=\"btn btn-success\" onclick=\"fields();\" type=\"button\"><span class=\"glyphicon glyphicon glyphicon-plus\" aria-hidden=\"true\"></span></button></div><br></div>"
						?>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary" form="input">Submit</button>
					<input type="hidden" name="frmname" value="ingredient">
					<input type="hidden" name="hidden" class="hidden" id="hidden" value="1">
					</form>
        </div>
      </div>
    </div>
  </div>
	<?php
	if(isset($_POST['frmname'])){
		if($_POST['frmname']=="ingredient"){
			$arraySet=1;
			for($counter=1;$counter<=$_POST['hidden'];$counter++){
				$quantity='quantity'.$counter;
				$measurement='measurement'.$counter;
				$ingredient='ingredient'.$counter;

				if(isset($_POST[$quantity])){
					${'array'.$arraySet} = array($_POST[$quantity], $_POST[$measurement], $_POST[$ingredient]);
					$largeArray[$arraySet]=${'array'.$arraySet};
					$arraySet++;
				}
			}//collects the info that the user entered for comparison
			$ingredients=json_encode($largeArray);
			
			// this is the ingredients the user entered here
			$userIngredientsCount = sizeof($largeArray);

			// this will hold our matched recipes
			$matchingRecipes = array();
			
			// load all recipes
			if($query=$pdo->prepare("SELECT * FROM `recipes`")){
							if($query->execute()) {
								while ($row = $query->fetch(PDO::FETCH_ASSOC))
								{
									
									// we assume we matched this one
									$match = true;
									
									// loop through all recipe ingredients 
									foreach(json_decode($row['ingredients'], true) as $value){	
										
										// assume the ingredients entered are not matched
										$ingFound = false;
										foreach($largeArray as $ing)
										{
											// if the ingredients is one of the user specified
											if($ing[2] == $value[2]){
												$ingFound = true;
												break;  // no need to continue searching
											}
										}	
										
										// update the total match
										$match = $match && $ingFound;
										
										// exit if this recipe does not match any of the user ingredients
										if(!$match)  break;
									}		

									if($match){
										
										// add this recipe id to our result array
										array_push($matchingRecipes , $row["ID"]);
										
										// This recipe ingredients  matches the user list of ingredients
									}

   							}
							}

				 }
			
			
			//print_r($matchingRecipes);
			
			//////////////////////////////
			echo '<p>We found the following Recipes that match your ingredients!</p>';
			echo '<div class="container">
 			<div class="row content">';
			
			$check=0;
			
			foreach($matchingRecipes as $rId){
			$string="pictures/";
			 if($query=$pdo->prepare("SELECT * FROM `recipes` WHERE `ID` = :counter")){
				$query->execute(array($rId));
				$result=$query->fetch(PDO::FETCH_ASSOC);
				$string.=$result['picture'];
				}//gets recipes from database to display
					if(isset($result) && $result!="" && $result['copy']==0){
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
					foreach(json_decode($result['ingredients'], true) as $value){
						if($query=$pdo->prepare("SELECT `tags` FROM `ingredients` WHERE `ID`=:id")){
							$query->execute(array(':id'=>$value[2]));
							$tags=json_decode($query->fetch(PDO::FETCH_ASSOC)['tags'], true);
						}//ingredient warning system
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
					if($abbr==1){
						echo '  <abbr title="This recipe contains: ';
						$tagsString=rtrim(implode(', ', $tagsArray), ', ');
						echo $tagsString;
						echo '"><img class="abbr" src="https://pngimg.com/uploads/exclamation_mark/exclamation_mark_PNG76.png"></img></abbr>';
					}
						echo '</div>
							<div class="panel-body" onclick="recipeModal('.$result['ID'].')" data-toggle="modal" data-target="#myModal" style="cursor:pointer"><img src="';print_r($string); echo '" class="img-responsive" style="width:500px">';
						echo 'Description: ';  
						print_r($result['description']);
							echo '</div>
							<div class="panel-footer">';
								$numerator=0;
								$denominator=0;
								foreach(json_decode($result['ratings'], true) as $value){
									$numerator=$numerator+$value;
									$denominator++;
								}//rating average
								$rating=round($numerator/$denominator);
								for($i=1;$i<=5;$i++){
									if($rating>=$i){echo '<img class="rate" src="pictures/fullstar.png"></img>';}
									else{echo '<img class="rate" src="pictures/emptystar.png"></img>';}
								}
								echo '<br>out of '.$denominator.' ratings<button class="btn btn-xs btn-success" style="position: absolute; right: 25;" onclick="saveRecipe('.$result['ID'].')">Save</button></div>
						</div>
					</div>';
							$check++;
					}
					
				
			}
			echo '</div></div><br>';
	
			
			/////////////////////////////
			
			// clean the post array 
			$_POST = array();
			
			
		}
	}
	?>
	<script>
				var fieldCount = 1;
				var activeFields = 1;
				//creates more fields to add ingredients
				function fields(){
					fieldCount++;
					var element = document.getElementById('fields');
					var elementToAdd = document.createElement('div');
					elementToAdd.setAttribute('class', 'form-group ingredient'+fieldCount);
					elementToAdd.innerHTML = '<?php echo "<input type=\"number\" name=\"quantity'+ fieldCount +'\" id=\"quantity'+ fieldCount +'\" placeholder=\"Quantity\" min=\"1\" required><select form=\"input\" name=\"measurement'+ fieldCount +'\" id=\"measurement'+ fieldCount +'\"><option value=\"Cup(s) of\">Cup(s) of</option><option value=\"Pint(s) of\">Pint(s) of</option><option value=\"Quart(s) of\">Quart(s) of</option><option value=\"Milliliter(s) of\">Milliliter(s) of</option><option value=\"Drop(s) of\">Drop(s) of</option><option value=\"Dashe(s) of\">Dashe(s) of</option><option value=\"Pinche(s) of\">Pinche(s) of</option><option value=\"Litre(s) of\">Litre(s) of</option><option value=\"Teaspoon(s) of\">Teaspoon(s) of</option><option value=\"Tablespoon(s) of\">Tablespoon(s) of</option><option value=\"Pound(s) of\">Pound(s) of</option><option value=\"Ounce(s) of\">Ounce(s) of</option><option value=\"Fluid Ounce(s) of\">Fluid Ounce(s) of</option><option value=\"Gram(s) of\">Gram(s) of</option><option value=\"singular\">Unit(s) of</option></select>"; echo "<select form=\"input\" name=\"ingredient'+ fieldCount +'\" id=\"ingredient'+ fieldCount +'\">"; if($query=$pdo->prepare("SELECT `AUTO_INCREMENT` FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA =  'wcss_recipe' AND TABLE_NAME =  'ingredients'")){$query->execute();$query=$query->fetch(PDO::FETCH_ASSOC);$max=$query['AUTO_INCREMENT'];} for($counter=1;$counter<=$max;$counter++){ if($query=$pdo->prepare("SELECT * FROM `ingredients` WHERE `ID`= :counter")){ $query->execute(array($counter)); $query=$query->fetch(PDO::FETCH_ASSOC); $result=json_decode($query["tags"], true); $name=$query["name"]; $id=$query["ID"];} if($query!=""){ echo "<option value=\"";print_r($id);echo"\">";print_r($name);echo"</option>";}} echo "</select>   ";?>  <button class="btn btn-danger" type="button" onclick="remove('+ fieldCount +');"> <span class="glyphicon glyphicon glyphicon-minus" aria-hidden="true"></span></button><br>';
					element.appendChild(elementToAdd);

					activeFields++;
					$('.hidden').remove();
					var input = document.getElementById('input');
					var hidden = document.createElement('input');
					hidden.setAttribute('type', 'hidden');
					hidden.setAttribute('name', 'hidden');
					hidden.setAttribute('class', 'hidden');
					hidden.setAttribute('id', 'hidden');
					hidden.value = activeFields;
					input.appendChild(hidden);
				}
				//removes fields
				function remove(del){
					$('.ingredient'+del).remove();
				}
			</script>

<script>
			function saveRecipe(id){//save recipe to personal profile from grocery list
				$.ajax({url: 'saveRecipe.php?id='+id, success: function(result){
					alert("Saved!");
				}});
			}
			function recipeModal(id){//displays recipe in modal
				$.ajax({url: 'getModal.php?id='+id+"&page=3", success: function(result){
					var element = document.getElementById('myModal');
					element.innerHTML = result;
					var user = "<?php echo $_SESSION['id'] ?>";
					rateShow(0, user, id);
				}});
			}
			function rate(id, user, recipe){
				console.log("rate");//updates the recipe rating for the user
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
				console.log("rateShow");//displays the rating widget based on what the mouse is hovered over
				var rate = document.getElementById('rate');
				var star1 = document.getElementById('star1');
				var star2 = document.getElementById('star2');
				var star3 = document.getElementById('star3');
				var star4 = document.getElementById('star4');
				var star5 = document.getElementById('star5');
				if(id==0){
					$.ajax({url: "rate.php?id="+id+"&recipe="+recipe+"&function=1", success: function(result){
						var rate = document.getElementById('rate');
						for(var i=1;i<=5;i++){
							if(result>=i){eval("star"+i+".innerHTML = '<img style=\"cursor:pointer\" src=\"pictures/fullstar.png\" class=\"rate\" onclick=\"rate(1, '+user+', '+recipe+')\" onmousemove=\"rateShow(1, '+user+', '+recipe+')\"></img>';");}
							else{eval("star"+i+".innerHTML = '<img style=\"cursor:pointer\" src=\"pictures/emptystar.png\" class=\"rate\" onclick=\"rate(1, '+user+', '+recipe+')\" onmousemove=\"rateShow(1, '+user+', '+recipe+')\"></img>';");}
						}
					}});
				}//how the rating widget is displayed
				if(id==1){
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

</body>

</html>
