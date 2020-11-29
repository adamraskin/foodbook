<?php
  include('database.php');
  if($query=$pdo->prepare("DELETE FROM `users` WHERE `ID` = :input")){
    $query->execute(array(':input'=>$_GET['input']));
  }
  if($query=$pdo->prepare("DELETE FROM `recipes` WHERE `user` = :input")){
    $query->execute(array(':input'=>$_GET['input']));
  }//referenced by ajax to delete user and their recipes
?>