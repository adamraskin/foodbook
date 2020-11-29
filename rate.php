<?php
	include('database.php');
	session_start();
	if($query=$pdo->prepare("SELECT `ratings` FROM `recipes` WHERE `ID` = :recipe")){
		$query->execute(array(':recipe'=>$_GET['recipe']));
		$query=$query->fetch(PDO::FETCH_ASSOC);
		$result=json_decode($query['ratings'], true);
		if($_GET['function']==1){//checks if user has rated the recipe before to display the users current rating
			foreach($result as $key => $value){
				if($key==$_SESSION['id']){
					print_r($value);
				}
			}
		}
	}
	if($_GET['function']==2){
		$result[$_GET['user']]=$_GET['id'];
		if($query=$pdo->prepare("UPDATE `recipes` SET `ratings` = :ratings WHERE `ID` = :id")){
			$query->execute(array(':ratings'=>json_encode($result), ':id'=>$_GET['recipe']));
			$counter=0;
			foreach($result as $value){//updates the users rating i
				$counter++;
			}
			echo '		';
			print_r($counter+1);
			echo ' ratings!';
		}
	}
?>