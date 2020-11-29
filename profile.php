<html>

<head>
	<?php
		include("database.php");
		session_start();
		if($query=$pdo->prepare("SELECT `hash` FROM `users` WHERE `ID`=:id")){
			$query->execute(array(':id'=>$_SESSION['id']));
			$result=$query->fetch(PDO::FETCH_ASSOC);
			$result=$result['hash'];
		}//checks login info
		if($result!==$_SESSION['hash'] || !isset($_SESSION['hash']) || !isset($_SESSION['id'])){
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
		
		.link {
			text-align: left;
			color: blue;
			text-decoration: underline;
			cursor: pointer;
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
			<p>My Recipes</p>
		</div>
	</div>

	<nav class="navbar navbar-default" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand"><img src="https://image.freepik.com/free-icon/fork-and-knife-cutlery-circle-interface-symbol-for-restaurant_318-61359.jpg"height=25px width=25px></a>
			</div>
			<ul class="nav navbar-nav">
				<li class="active"><a href="profile.php">My Recipes</a></li>
				<li><a href="mealplanner.php">Meal Planner</a></li>
				<li><a href="explore.php">Explore</a></li>
				</li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="userSettings.php">Settings</a></li><!--navbar-->
				<?php if($_SESSION['id']==0){echo '<li><a href="admin.php">Admin</a></li>';}?>
				<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
			</ul>
	</nav>
				<div id="myModal" class="modal fade" role="dialog">
				</div>
				<?php
				if(isset($_POST['name']) && isset($_POST['description']) && isset($_POST['instructions']) && isset($_POST['quantity1']) && $_POST['name']!="" && $_POST['description']!="" && $_POST['instructions']!="" && $_POST['quantity1']!=""){
					$name=$_POST['name'];
					$description=$_POST['description'];
					$instructions=$_POST['instructions'];
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
					}
					$ingredients=json_encode($largeArray);
					//checks all picture info before uploading to make sure its small enough and in the right format
					if(isset($_FILES)){
						$fileName = $_FILES['pic']['name'];
						$file_size = $_FILES['pic']['size'];
						$file_tmp = $_FILES['pic']['tmp_name'];
						$file_type = $_FILES['pic']['type'];
						$fileNamePerm = md5($fileName.time());
						$target_file="/var/www/html/recipe/pictures/".$fileName;
						$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
						$fileNamePerm = $fileNamePerm.".".$imageFileType;
						$uploadOk = 1;
						if ($file_size > 5000000){
								echo "Your file is too large.";
								$uploadOk = 0;
						}
						if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ){
							echo "Only JPG, JPEG, PNG & GIF files are allowed.";
							$uploadOk = 0;
						}
						if ($uploadOk == 0){
							if($query=$pdo->prepare("INSERT INTO `recipes` (name, picture, description, instructions, ingredients, user, ratings) VALUES (:name, :pic, :description, :instructions, :ingredients, :user, :ratings)")){
								$pic="noimage.png";
								$query->execute(array($name, $pic, $description, $instructions, $ingredients, $_SESSION['id'], json_encode(array($_SESSION['id']=>5))));
							}
						}else{//uploads info
							if($query=$pdo->prepare("INSERT INTO `recipes` (name, picture, description, instructions, ingredients, user, ratings) VALUES (:name, :pic, :description, :instructions, :ingredients, :user, :ratings)")){
								move_uploaded_file($file_tmp, "/var/www/html/recipe/pictures/$fileNamePerm");
								$query->execute(array($name, $fileNamePerm, $description, $instructions, $ingredients, $_SESSION['id'], json_encode(array($_SESSION['id']=>5))));
							}
						}
					}else{
						if($query=$pdo->prepare("INSERT INTO `recipes` (name, picture, description, instructions, ingredients, user, ratings) VALUES (:name, :pic, :description, :instructions, :ingredients, :user, :ratings)")){
							$pic="noimage.png";
							$query->execute(array($name, $pic, $description, $instructions, $ingredients, $_SESSION['id'], json_encode(array($_SESSION['id']=>5))));
						}
					}
				echo '<script>
					window.location.replace("profile.php");
				</script>';
				}
				
			if($query=$pdo->prepare("SELECT `AUTO_INCREMENT` FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA =  'wcss_recipe' AND TABLE_NAME =  'recipes'")){
				$query->execute();
				$query=$query->fetch(PDO::FETCH_ASSOC);
				$counter=$query['AUTO_INCREMENT'];
				$max=$query['AUTO_INCREMENT'];
			}
	do{

			echo '<div class="container">
 			<div class="row content">';
			
			$check=0;
			do{//displays recipes in rows of three
				$string="pictures/";
				 if($query=$pdo->prepare("SELECT * FROM `recipes` WHERE `ID` = :counter")){
							$query->execute(array($counter));
							$result=$query->fetch(PDO::FETCH_ASSOC);
							$string.=$result['picture'];
				 }
				if($counter==$max){
					echo '<div class="col-sm-4">
							<div class="panel panel-success"  onclick="backModal()" data-toggle="modal" data-target="#myModal" style="cursor:pointer">
								<div class="panel-heading">Add Recipe</div>
								<div class="panel-body"><img class="center-block" src="pictures/plus.png" class="img-responsive"></div></a>
								<div class="panel-footer"></div>
							</div>
						</div>';
					$check++;
				}
				if($result['user']==$_SESSION['id']){
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
											}//warning system for allergies
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
											echo '<img src="https://vignette.wikia.nocookie.net/grimm/images/a/a5/X.png/revision/latest?cb=20161103004859" class="delete" onclick="deleteRecipe('.$result['ID'].')" align="right" style="cursor:pointer"></img></div>
										<div class="panel-body" onclick="modal('.$result['ID'].')" data-toggle="modal" data-target="#viewModal" style="cursor:pointer"><img src="';print_r($string); echo '" class="img-responsive" style="width:500px">';
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
										echo '<br>out of '.$denominator.' ratings<button class="btn btn-xs btn-primary" style="position: absolute; right: 25;" onclick="edit('.$result['ID'].')" data-toggle="modal" data-target="#myModal" style="cursor:pointer">Edit</button>
										</div>
									</div>
								</div>';
						$check++;
				}
				$counter--;
			}while($check<=2 && $counter>0);
			echo '</div></div><br>';
		}while($counter>0);
			?>
			<script>
				var fieldCount = 1;
				var activeFields = 1;
				
				function fields(){//adds ingredient field
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
					hidden.setAttribute('value', activeFields);
					input.appendChild(hidden);
				}

				function remove(del){//removes ingredient field
					$('.ingredient'+del).remove();
				}
				
				function deleteRecipe(id){//function to delete recipe
					$.ajax({url: 'removeRecipe.php?id='+id, success: function(result){
						var element = document.getElementById(id);
						element.setAttribute('style', 'opacity: 0.2');
					}});
				}
				
				function edit(id){//fucntion to open edit recipe modal
					$.ajax({url: 'editRecipeModal.php?id='+id, success: function(result){
						var element=document.getElementById('myModal');
						element.innerHTML = result;
					}});
				}
				
				function ingredientModal(){//collects all info from add recipe modal to be re entered when it goes back to add recipe modal, then opens ingredient entry modal
					var name=document.getElementById("name").value;
					window.name=name;
					var description=document.getElementById("description").value;
					window.description=description;
					var instructions=document.getElementById("instructions").value;
					window.instructions=instructions;
					var hiddenVal=document.getElementById("hidden").value;
					window.hiddenVal=hiddenVal;
					var quantity1=document.getElementById("quantity1").value;
					window.quantity1=quantity1;
					var measurement1=document.getElementById("measurement1").value;
					window.measurement1=measurement1;
					var ingredient1=document.getElementById("ingredient1").value;
					window.ingredient1=ingredient1;
					for(var i=2;i<=document.getElementById("hidden").value;i++){
						if(eval("document.getElementById(\"quantity"+i+"\")")){
							eval("var quantity"+i+"=document.getElementById(\"quantity"+i+"\").value");
							eval("window.quantity"+i+"=quantity"+i);
							eval("var measurement"+i+"=document.getElementById(\"measurement"+i+"\").value");
							eval("window.measurement"+i+"=measurement"+i);
							eval("var ingredient"+i+"=document.getElementById(\"ingredient"+i+"\").value");
							eval("window.ingredient"+i+"=ingredient"+i);
						}
					}//opens ingredient modal
					$.ajax({url: "ingredientModal.php?id=1", success: function(result){
						var element = document.getElementById('myModal');
						element.innerHTML = result;
					}});
				}
				
				var name="";
				var description="";
				var instructions="";
				var quantity1="";
				var hiddenVal=1;
				function backModal(){//opens add recipe modal to input all the info, also capable of entering info back into modal when coming back from ingredient modal
					$.ajax({url: "addRecipeModal.php", success: function(result){
						var element=document.getElementById('myModal');
						element.innerHTML = result;
							document.getElementById("name").value=name;
							document.getElementById("description").value=description;
							document.getElementById("instructions").value=instructions;
							document.getElementById("quantity1").value=quantity1;
							document.getElementById("measurement1").value=measurement1;
							document.getElementById("ingredient1").value=ingredient1;
							document.getElementById("hidden").value=window.hiddenVal;
							for(var i=2;i<=document.getElementById("hidden").value;i++){
								if(eval("quantity"+i+"!=undefined")){
									console.log(document.getElementById("hidden").value);
									
									var fieldL = document.getElementById('fields');
									var divL = document.createElement('div');
									divL.setAttribute('class', 'form-group ingredient'+fieldCount);
									divL.innerHTML = '<?php echo "<input type=\"number\" name=\"quantity'+ i +'\" id=\"quantity'+ i +'\" placeholder=\"Quantity\" min=\"1\" required><select form=\"input\" name=\"measurement'+ i +'\" id=\"measurement'+ i +'\"><option value=\"Cup(s) of\">Cup(s) of</option><option value=\"Pint(s) of\">Pint(s) of</option><option value=\"Quart(s) of\">Quart(s) of</option><option value=\"Milliliter(s) of\">Milliliter(s) of</option><option value=\"Drop(s) of\">Drop(s) of</option><option value=\"Dashe(s) of\">Dashe(s) of</option><option value=\"Pinche(s) of\">Pinche(s) of</option><option value=\"Litre(s) of\">Litre(s) of</option><option value=\"Teaspoon(s) of\">Teaspoon(s) of</option><option value=\"Tablespoon(s) of\">Tablespoon(s) of</option><option value=\"Pound(s) of\">Pound(s) of</option><option value=\"Ounce(s) of\">Ounce(s) of</option><option value=\"Fluid Ounce(s) of\">Fluid Ounce(s) of</option><option value=\"Gram(s) of\">Gram(s) of</option><option value=\"singular\">Unit(s) of</option></select>"; echo "<select form=\"input\" name=\"ingredient'+ i +'\" id=\"ingredient'+ i +'\">"; if($query=$pdo->prepare("SELECT `AUTO_INCREMENT` FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA =  'wcss_recipe' AND TABLE_NAME =  'ingredients'")){$query->execute();$query=$query->fetch(PDO::FETCH_ASSOC);$max=$query['AUTO_INCREMENT'];} for($counter=1;$counter<=$max;$counter++){ if($query=$pdo->prepare("SELECT * FROM `ingredients` WHERE `ID`= :counter")){ $query->execute(array($counter)); $query=$query->fetch(PDO::FETCH_ASSOC); $result=json_decode($query["tags"], true); $name=$query["name"]; $id=$query["ID"];} if($query!=""){ echo "<option value=\"";print_r($id);echo"\">";print_r($name);echo"</option>";}} echo "</select>   ";?>  <button class="btn btn-danger" type="button" onclick="remove('+ i +');"> <span class="glyphicon glyphicon glyphicon-minus" aria-hidden="true"></span></button><br>';
									fieldL.appendChild(divL);
									eval("document.getElementById(\"quantity"+i+"\").value=quantity"+i);
									eval("document.getElementById(\"measurement"+i+"\").value=measurement"+i);
									eval("document.getElementById(\"ingredient"+i+"\").value==ingredient"+i);
									
								}
							}
					}});
				}
				window.onload=backModal();
			function modal(id){//display modal
				$.ajax({url: 'getModal.php?id='+id+"&page=1", success: function(result){
					var element = document.getElementById('viewModal');
					element.innerHTML= result;
				}});
			}//add ingredient function
			function ingredient(){
				var name = document.getElementById("name").value;
				if(name!=""){
					var dairy = document.getElementById("dairy").value;
					var eggs = document.getElementById("eggs").value;
					var peanuts = document.getElementById("peanuts").value;
					var nuts = document.getElementById("nuts").value;
					var soy = document.getElementById("soy").value;
					var gluten = document.getElementById("gluten").value;
					var fish = document.getElementById("fish").value;
					var shellfish = document.getElementById("shellfish").value;
					var corn = document.getElementById("corn").value;
					var gelatin = document.getElementById("gelatin").value;
					var meat = document.getElementById("meat").value;
					$.ajax({url: "ingredientModal.php?id=2&name="+name+"&dairy="+dairy+"&eggs="+eggs+"&peanuts="+peanuts+"&nuts="+nuts+"&soy="+soy+"&gluten="+gluten+"&fish="+fish+"&shellfish="+shellfish+"&corn="+corn+"&gelatin="+gelatin+"&meat="+meat, success: function(result){
						alert('Your ingredient has been saved!');
					}});
				}else{
					alert('Your ingredient was not saved!');
				}
			}
</script>
		<div id="viewModal" class="modal fade" role="dialog">
		</div>

</body>

</html>