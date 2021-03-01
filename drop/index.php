<?php
include_once('../main.php');
$module =new Main();
if($id=$module->check_cookie()){
  if(isset($_GET['id'])){
    $module->drop_project($id,($_GET['id']));
    echo "<script>window.location='../';</script>";
  }
}
?>
