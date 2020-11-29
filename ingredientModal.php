<?php
		include("database.php");
		if($_GET['id']==1){//if id is 1, displays ingredient entry modal
			echo '<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header modal-header-success">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title">Add Ingredient</h4>
		</div>
		<div class="modal-body">
			<form action="" method="POST">
		<input type="text" id="name" name="name" placeholder="Ingredient Name" required>
		<br>
		<input type="checkbox" id="dairy" name="dairy" value=1>Does this ingredient contain dairy?
		<br>
		<input type="checkbox" id="eggs" name="eggs" value=1>Does this ingredient contain eggs?
		<br>
		<input type="checkbox" id="peanuts" name="peanuts" value=1>Does this ingredient contain peanuts?
		<br>
		<input type="checkbox" id="nuts" name="nuts" value=1>Does this ingredient contain tree nuts?
		<br>
		<input type="checkbox" id="soy" name="soy" value=1>Does this ingredient contain soy?
		<br>
		<input type="checkbox" id="gluten" name="gluten" value=1>Does this ingredient contain gluten?
		<br>
		<input type="checkbox" id="fish" name="fish" value=1>Does this ingredient contain fish?
		<br>
		<input type="checkbox" id="shellfish" name="shellfish" value=1>Does this ingredient contain shellfish?
		<br>
		<input type="checkbox" id="corn" name="corn" value=1>Does this ingredient contain corn products?
		<br>
		<input type="checkbox" id="gelatin" name="gelatin" value=1>Does this ingredient contain gelatin?
		<br>
		<input type="checkbox" id="meat" name="meat" value=1>Does this ingredient contain any meat products?
		<br>
		<button type="button" class="btn btn-success" onclick="ingredient()">Submit</button>
	</form>
	</div>
		<div class="modal-footer">
			<p class="link" onclick="backModal()">Go back</p>
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		</div>
	</div>
</div>';
		}else if($_GET['id']==2){//if function is 2, enters data to database
				if($_GET['dairy']!=1){$_GET['dairy']=0;}
				if($_GET['eggs']!=1){$_GET['eggs']=0;}
				if($_GET['peanuts']!=1){$_GET['peanuts']=0;}
				if($_GET['nuts']!=1){$_GET['nuts']=0;}
				if($_GET['soy']!=1){$_GET['soy']=0;}
				if($_GET['gluten']!=1){$_GET['gluten']=0;}
				if($_GET['fish']!=1){$_GET['fish']=0;}
				if($_GET['shellfish']!=1){$_GET['shellfish']=0;}
				if($_GET['corn']!=1){$_GET['corn']=0;}
				if($_GET['gelatin']!=1){$_GET['gelatin']=0;}
				if($_GET['meat']!=1){$_GET['meat']=0;}
			$array=array("dairy"=>$_GET['dairy'], "eggs"=>$_GET['eggs'], "peanuts"=>$_GET['peanuts'], "nuts"=>$_GET['nuts'], "soy"=>$_GET['soy'], "gluten"=>$_GET['gluten'], "fish"=>$_GET['fish'], "shellfish"=>$_GET['shellfish'], "corn"=>$_GET['corn'], "gelatin"=>$_GET['gelatin'], "meat"=>$_GET['meat']);
			$array=json_encode($array);
			if($query=$pdo->prepare("INSERT INTO `ingredients` (name, tags) VALUES (:name, :tags)")){
				$query->execute(array($_GET['name'], $array));
			}
		}
?>
