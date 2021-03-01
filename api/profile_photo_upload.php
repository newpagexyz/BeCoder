<?php
  include_once '../main.php';
  $module =new Main();
  if($id=$module->check_cookie()){
    if(!empty($_FILES)){
      echo $module->upload_profile_photo($id,$_FILES);
    }
    else{
      echo false;
    }
  }
  else{
    echo false;
  }
?>
