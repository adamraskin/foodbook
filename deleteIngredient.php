<?php
  include('database.php');
  if($query=$pdo->prepare("DELETE FROM `ingredients` WHERE `ID` = :input")){
    $query->execute(array(':input'=>$_GET['input']));
  }//referenced by ajax to delete ingredient from database

?>