<?php
	if(isset($_GET['t'])){
		include_once '../main.php';
		$module=new Main();
		return $module->email_confirm_by_token($_GET['t']);
	}
?> 