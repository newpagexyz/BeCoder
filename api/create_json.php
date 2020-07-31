<?php
  include_once '../main.php';
  $module =new Main();
  if($id=$module->check_cookie()){
    if($res=$module->create_json($id)){
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
