<?php
  include_once '../main.php';
  $module =new Main();
  if($id=$module->check_cookie()){
    if(isset($_POST['name']) AND isset($_POST['surname']) AND isset($_POST['email'])){
    $res=$module->change_profile($id,$_POST['name'],$_POST['surname'],$_POST['email']);
    echo $res;
    }
    else{
      echo'["false"]';
    }
  }
  else{
    echo'["false"]';
  }
  //print_r($_POST);
?>
