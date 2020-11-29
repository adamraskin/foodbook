<?php
session_start();
  include('database.php');
  if($query=$pdo->prepare("SELECT * FROM `recipes` WHERE `ID`=:id")){
    $query->execute(array(':id'=>$_GET['id']));
    $result=$query->fetch(PDO::FETCH_ASSOC);//gets recipe info
    $ingredients=json_decode($result['ingredients'], true);
    
    echo '<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header modal-header-success">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">'; print_r($result['name']); echo '</h4>
			</div>
			<div class="modal-body">
				<p><img src="pictures/'.$result['picture'].'" class="img-responsive" style="width:500px"></img><h4>Description:</h4>';
				print_r($result['description']);
        echo '<br><h4>Ingredients:</h4>';
				for($counter=1;$counter<=count($ingredients);$counter++){
          echo $ingredients[$counter]['0'].' ';
          if($ingredients[$counter]['1']=="singular"){
          }else{
            echo $ingredients[$counter]['1'].' ';
          }
          if($query=$pdo->prepare("SELECT `name` FROM `ingredients` WHERE `ID` = :id")){
            $query->execute(array(':id'=>$ingredients[$counter]['2']));
            $ingredient=$query->fetch(PDO::FETCH_ASSOC)['name'];
            print_r($ingredient);
          }//displays ingredients
          echo '<br>';
        }
        echo '<br><h4>Instructions:</h4>';
        print_r($result['instructions']);
        echo '</p>
				<div class="modal-footer" onload="rateShow(0, '.$_SESSION['id'].', '.$result['ID'].')">';
				if($_GET['page']==3){
					echo '<div id="rate" align="left" onmouseout="rateShow(0, '.$_SESSION['id'].', '.$result['ID'].')" style="width: 160px;height: 50px;padding: 10px;">
								<span id="star1"><img style="cursor:pointer" src="pictures/emptystar.png" class="rate" onclick="rate(1, '.$_SESSION['id'].', '.$result['ID'].')" onmousemove="rateShow(1, '.$_SESSION['id'].', '.$result['ID'].')"></img></span>
								<span id="star2"><img style="cursor:pointer" src="pictures/emptystar.png" class="rate" onclick="rate(1, '.$_SESSION['id'].', '.$result['ID'].')" onmousemove="rateShow(2, '.$_SESSION['id'].', '.$result['ID'].')"></img></span>
								<span id="star3"><img style="cursor:pointer" src="pictures/emptystar.png" class="rate" onclick="rate(3, '.$_SESSION['id'].', '.$result['ID'].')" onmousemove="rateShow(3, '.$_SESSION['id'].', '.$result['ID'].')"></img></span>
								<span id="star4"><img style="cursor:pointer" src="pictures/emptystar.png" class="rate" onclick="rate(4, '.$_SESSION['id'].', '.$result['ID'].')" onmousemove="rateShow(4, '.$_SESSION['id'].', '.$result['ID'].')"></img></span>
								<span id="star5"><img style="cursor:pointer" src="pictures/emptystar.png" class="rate" onclick="rate(5, '.$_SESSION['id'].', '.$result['ID'].')" onmousemove="rateShow(5, '.$_SESSION['id'].', '.$result['ID'].')"></img></span>
								<span id="textnode">';
								print_r(count(json_decode($result['ratings'], true)));
								echo ' ratings!';
						echo '</span>
							</div>';
				}//rating widget
								echo '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							</div>
						</div>
					</div>
				</div>';
  }
?>