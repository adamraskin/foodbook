<?php
	include('database.php');
	if($query=$pdo->prepare("DELETE FROM `recipes` WHERE `ID` = :id")){
		$query->execute(array(':id'=>$_GET['id']));
	}//deletes recipe
?>