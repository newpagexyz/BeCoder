<?php
  include_once '../main.php';
  $module =new Main();
  if($id=$module->check_cookie()){
    if(isset($_GET['id']))
    if($res=$module->get_json($id,$_GET['id'])){
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
