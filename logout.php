<?php
	include('database.php');
	session_start();
	if($query=$pdo->prepare("UPDATE `users` SET `hash` = :hash WHERE `ID` = :id")){
		$query->execute(array(':hash'=>"", ':id'=>$_SESSION['id']));
	}//unsets hash in database
  session_unset();
  session_destroy();
//unsets and destroys session info
?>
<script>
	//send back to login page
	window.location.replace("login.php");
</script>