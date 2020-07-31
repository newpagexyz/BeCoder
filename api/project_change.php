<?php
  include_once '../main.php';
  $module =new Main();
  if($id=$module->check_cookie()){
    if(isset($_POST['id']) AND isset($_POST['name']) AND isset($_POST['description']))
    if($res=$module->project_change($id,$_POST['id'],$_POST['name'],$_POST['description'])){
      echo $res;
    }
    else{
      echo'["false"]';
    }
  }
  else{
    echo'["false"]';
  }
?>
