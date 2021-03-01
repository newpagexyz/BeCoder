<?php
  include_once '../main.php';
  $module =new Main();
  if($id=$module->check_cookie()){
    if(isset($_POST['id']) AND isset($_POST['json']))
    if($res=$module->send_json($id,$_POST['id'],$_POST['json'])){
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
