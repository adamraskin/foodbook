<?php
	include('database.php');
session_start();
	if($query=$pdo->prepare("SELECT * FROM `recipes` WHERE `ID`=:id")){
		$query->execute(array(':id'=>$_GET['id']));
		$result=$query->fetch(PDO::FETCH_ASSOC);
	}//saves recipe to the current users "my recipes list"
	if($query=$pdo->prepare("INSERT INTO `recipes` (`name`, `picture`, `description`, `ingredients`, `instructions`, `ratings`, `copy`, `user`) VALUES (:name, :picture, :description, :ingredients, :instructions, :ratings, :copy, :user)")){
		$query->execute(array(':name'=>$result['name'], ':picture'=>$result['picture'], ':description'=>$result['description'], ':ingredients'=>$result['ingredients'], ':instructions'=>$result['instructions'], ':ratings'=>$result['ratings'], ':copy'=>1, ':user'=>$_SESSION['id']));
	}
?>