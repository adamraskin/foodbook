<?php
	include('database.php');
	session_start();
	if($query=$pdo->prepare("SELECT * FROM `recipes` WHERE `ID` = :id")){
		$query->execute(array(':id'=>$_GET['id']));
		$result=$query->fetch(PDO::FETCH_ASSOC);
		print_r($result);
	}//gets info from recipe that was selected
?>
<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header modal-header-success">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title">Edit Recipe</h4>
		</div>
		<div class="modal-body">
			<form action="" method="POST" id="input" enctype="multipart/form-data">
				<?php //creates form and populates it with info from recipe to be edited
					echo '<label>Recipe Name</label>
				<br>
				<input type="text" name="name" id="name" placeholder="Recipe Name" value="'; print_r($result['name']); echo '" required>
				<br><br>
				<label>Picture (optional)</label>
				<br>
				<input type="file" name="pic" id="pic" value="'; print_r($result['pic']); echo '" accept="image/*">
				<br>
				<label>Description</label>
				<br>
				<textarea name="description" id="description" rows=4 cols=50 placeholder="Description" required>'; print_r($result['description']); echo '</textarea>
				<br><br>
				<label>Instructions</label>
				<br>
				<textarea name="instructions" id="instructions" rows=4 cols=50 placeholder="Instructions" required>'; print_r($result['instructions']); echo '</textarea>
				<br>
				<label>Ingredients</label>
				<div id="fields"><div class="ingredient1"><input type="number" name="quantity1" id="quantity1" placeholder="Quantity" min="1" required><select form="input" name="measurement1" id="measurement1">
						<option value="Cup(s) of">Cup(s) of</option>
						<option value="Pint(s) of">Pint(s) of</option>
						<option value="Quart(s) of">Quart(s) of</option>
						<option value="Milliliter(s) of">Milliliter(s) of</option>
						<option value="Drop(s) of">Drop(s) of</option>
						<option value="Dashe(s) of">Dashe(s) of</option>
						<option value="Pinche(s) of">Pinche(s) of</option>
						<option value="Litre(s) of">Litre(s) of</option>
						<option value="Teaspoon(s) of">Teaspoon(s) of</option>
						<option value="Tablespoon(s) of">Tablespoon(s) of</option>
						<option value="Pound(s) of">Pound(s) of</option>
						<option value="Ounce(s) of">Ounce(s) of</option>
						<option value="Fluid Ounce(s) of">Fluid Ounce(s) of</option>
						<option value="Gram(s) of">Gram(s) of</option>
						<option value="singular">Unit(s) of</option>
						</select>';

							echo '<select form="input" name="ingredient1" id="ingredient1">';
							if($query=$pdo->prepare("SELECT `AUTO_INCREMENT` FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA =  'wcss_recipe' AND TABLE_NAME =  'ingredients'")){
								$query->execute();
								$query=$query->fetch(PDO::FETCH_ASSOC);
								$max=$query['AUTO_INCREMENT'];//gets info to display ingredients in select input
							}
							for($counter=1;$counter<=$max;$counter++){
								if($query=$pdo->prepare("SELECT * FROM `ingredients` WHERE `ID`= :counter")){
									$query->execute(array($counter));
									$query=$query->fetch(PDO::FETCH_ASSOC);
									$result=json_decode($query["tags"], true);
									$name=$query["name"];
									$id=$query["ID"];
								}
							if($query['ID']!=""){
								echo '<option value="";print_r($id);echo"">'; print_r($name); echo '</option>';
							}
						}//button to add more ingredient fields
							echo '</select>   <button class="btn btn-success" onclick="fields();" type="button"><span class="glyphicon glyphicon glyphicon-plus" aria-hidden="true"></span></button></div><br></div>';
						?>
				<br>
				<button type="submit" class="btn btn-success">Submit</button>
				<input type="hidden" name="hidden" class="hidden" id="hidden" value="1">
			</form>
		</div>
		<div class="modal-footer"><!--button to add new ingredient if its not already there-->
			<p class="link" onclick="ingredientModal()">Cant find the ingredient you're looking for?</p>
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		</div>
	</div>
</div>