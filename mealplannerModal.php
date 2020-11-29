<?php
	session_start();
	include('database.php');
	if($_GET['function']==1){
		if($query=$pdo->prepare("SELECT `recipes` FROM `planners` WHERE `userID`=:id")){
			$query->execute(array(':id'=>$_SESSION['id']));
			$result=$query->fetch(PDO::FETCH_ASSOC);
			$result=json_decode($result['recipes'], true);
			$recipeID=$result[$_GET['place']];
		}//gets recipe info
		if($query=$pdo->prepare("SELECT * FROM `recipes` WHERE `ID`=:id")){
			$query->execute(array(':id'=>$result[$_GET['place']]));
			$result=$query->fetch(PDO::FETCH_ASSOC);
			$ingredients=json_decode($result['ingredients'], true);
		}
		echo '<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Pick New Recipe</h4>
				</div><div class="modal-body" id="body">';
			if($recipeID!=0){
				echo '<h4>Current Recipe:</h4><h4>';
				print_r($result['name']);
				echo '</h4><p><img src="pictures/'.$result['picture'].'" class="img-responsive" style="width:500px"></img><h4>Description:</h4>';
				print_r($result['description']);
        echo '<br><h4>Ingredients:</h4>';
				for($counter=1;$counter<=count($ingredients);$counter++){
          echo $ingredients[$counter]['0'].' ';
          if($ingredients[$counter]['1']=="singular"){
          }else{
            echo $ingredients[$counter]['1'].' ';
          }//ingredient display in modal
          if($query=$pdo->prepare("SELECT `name` FROM `ingredients` WHERE `ID` = :id")){
            $query->execute(array(':id'=>$ingredients[$counter]['2']));
            $ingredient=$query->fetch(PDO::FETCH_ASSOC)['name'];
            print_r($ingredient);
          }
          echo '<br>';
        }
        echo '<br><h4>Instructions:</h4>';
        print_r($result['instructions']);
        echo '</p><br><br>';
			}
				echo '<select id="input" onchange="set()" required>
						<option value="none">No Recipe Selected</option>';
							if($query=$pdo->prepare("SELECT `AUTO_INCREMENT` FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA =  'wcss_recipe' AND TABLE_NAME =  'recipes'")){
								$query->execute();
								$query=$query->fetch(PDO::FETCH_ASSOC);
								$counter=$query['AUTO_INCREMENT'];
								$counter=$counter-1;
							}//displays recipes to choose from for meal planner
							for($counter=$counter;$counter>=0;$counter--){
								if($query=$pdo->prepare("SELECT * FROM `recipes` WHERE `ID`=:id AND `user`=:user")){
									$query->execute(array(':id'=>$counter, ':user'=>$_SESSION['id']));
									$query=$query->fetch(PDO::FETCH_ASSOC);
								}
								if(isset($query) && $query!=""){
									echo '<option value="'.$query['ID'].'">'.$query['name'].'</option>';
								}
							}
					echo '</select>
					<br><br>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" data-dismiss="modal" onclick="save('; print_r($_GET['place']); echo ', input)">Save</button>
				</div>
			</div>
		</div>';
	}else if($_GET['function']==2){
		if($_GET['place']==0 && $_GET['id']==0){
			if($query=$pdo->prepare("UPDATE `planners` SET `recipes` = :recipe WHERE `planners`.`userID` = :id")){
				$query->execute(array(':id'=>$_SESSION['id'], ':recipe'=>'{"1":"0","2":"0","3":"0","4":"0","5":"0","6":"0","7":"0","8":"0","9":"0","10":"0","11":"0","12":"0","13":"0","14":"0","15":"0","16":"0","17":"0","18":"0","19":"0","20":"0","21":"0"}'));
			}
		}else{
			if($query=$pdo->prepare("SELECT * FROM `planners` WHERE `userID`=:id")){
				$query->execute(array(':id'=>$_SESSION['id']));
				$query=$query->fetch(PDO::FETCH_ASSOC);
				$recipes=json_decode($query['recipes'], true);
			}//updates planner with recipe that user added
			$recipes[$_GET['place']]=$_GET['id'];
			if($query=$pdo->prepare("UPDATE `planners` SET `recipes` = :recipe WHERE `planners`.`userID` = :id")){
				$query->execute(array('recipe'=>json_encode($recipes), ':id'=>$_SESSION['id']));
			}
		}
	}
?>