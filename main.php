<?php

 error_reporting(E_ALL);
 ini_set("display_errors", 1);


class Main
{
  private function my_connect(){
	  return new mysqli('localhost', 'becoder_user', 'password123', 'becoder');
  }
  public function user_info($id){
    $mysqli=$this->my_connect();
    if (!$mysqli->connect_errno){
      $find_user = $mysqli->query("SELECT `photo`,`name`,`surname`,`email` FROM users WHERE `id`='$id';");
      if($res=$find_user->fetch_assoc()){
        $re=$res;
      }
      else{
        $re=false;
      }
      $find_user->close();
      $mysqli->close();
      return $re;
    }
    else{
      return false;
    }
  }
  public function upload_profile_photo($id,$files){
    $uploaddir = '/var/www/becoder/public_html/user_images/';
    $uploadfile = $this->gen_token().pathinfo($files['logo']['name'])['extension'];;
    if(move_uploaded_file($files['logo']['tmp_name'], $uploaddir.$uploadfile)){
      $mysqli=$this->my_connect();
      $mysqli->query("UPDATE `users` SET `photo`='$uploadfile' WHERE `id`=$id;");
        $mysqli->close();
      return true;
    }
    else{
      return false;
    }
  }
  public function reg_user($email,$password,$name,$surname){
  		$mysqli=$this->my_connect();
  		if (!$mysqli->connect_errno){
  			$email 	 = $mysqli->real_escape_string($email);
  			$surname	 = $mysqli->real_escape_string($surname);
  			$name   	 = $mysqli->real_escape_string($name);
  			$password = $this->my_hash($password);
  			$find_user = $mysqli->query("SELECT `id` FROM users WHERE `email`='$email';");
  			if($find_user->num_rows>0){
				return false;
  			}
  			else{
  				$reg_query = $mysqli->query("INSERT INTO `users` SET `email`='$email',`password`='$password',`name`='$name',`surname`='$surname';");
  				$this->email_confirmer($email,$mysqli->insert_id);
  				return true;
  			}
  			$find_user->close();
  			$mysqli->close();
  		}
  		else{
  			printf("Connect failed: %s\n", $mysqli->connect_error);
    		exit();
 	 		return false;
  		}
  }
  public function user_projects($uid){
    $mysqli=$this->my_connect();
    if (!$mysqli->connect_errno){
        $re=$mysqli->query("SELECT `projects`.`pid` `id`, `project`.`name` `name`,`project`.`status` `status`, `project`.`description` `description` FROM `projects` INNER JOIN `project` on `projects`.`pid`=`project`.`id`  WHERE `projects`.`uid`=$uid;");
        $arr=array();
        while($res=$re->fetch_assoc()){
            array_push($arr,$res);
        }
        $mysqli->close();
        return $arr;
    }
    else{
      return false;
    }
  }
  public function project_info($uid,$pid){
    $mysqli=$this->my_connect();
    if (!$mysqli->connect_errno){
        $re=$mysqli->query("SELECT `id` FROM `projects` WHERE `pid`=$pid AND `uid`=$uid;");
        if($re->num_rows>0){
          $re=$mysqli->query("SELECT `name`,`description` FROM `project` WHERE `id`=$pid;");
          if($res=$re->fetch_assoc()){
          $mysqli->close();
          return json_encode($res, JSON_UNESCAPED_UNICODE);
          }
        }
        else{
          $mysqli->close();
          return false;
        }
    }
    else{
      return false;
    }
  }
  public function change_profile($id,$name,$surname,$email){
    $mysqli=$this->my_connect();
    if (!$mysqli->connect_errno){
        $name=$mysqli->real_escape_string($name);
        $description=$mysqli->real_escape_string($surname);
        $description=$mysqli->real_escape_string($email);
        $re=$mysqli->query("UPDATE `users` SET `name`='$name',`surname`='$surname',`email`='$email' WHERE`id`=$id;");
        return "true";
    }
    else{
      return false;
    }
  }
  public function project_change($uid,$pid,$name,$description){
    $mysqli=$this->my_connect();
    if (!$mysqli->connect_errno){
        $name=$mysqli->real_escape_string($name);
        $description=$mysqli->real_escape_string($description);
        $re=$mysqli->query("SELECT `id` FROM `projects` WHERE `pid`=$pid AND `uid`=$uid;");
        if($re->num_rows>0){
          $re=$mysqli->query("UPDATE  `project` SET `name`='$name',`description`='$description' WHERE `id`=$pid;");
          return true;
        }
        else{
          $mysqli->close();
          return false;
        }
    }
    else{
      return false;
    }
  }
  public function drop_project($uid,$pid){
    $mysqli=$this->my_connect();
    if (!$mysqli->connect_errno){
        $re=$mysqli->query("SELECT `id` FROM `projects` WHERE `pid`=$pid AND `uid`=$uid;");
        if($re->num_rows>0){
          $mysqli->query("DELETE FROM `projects` WHERE `pid`=$pid");
          $mysqli->query("DELETE FROM `project` WHERE `id`=$pid;");
          $mysqli->close();
          return true;
        }
        else{
          $mysqli->close();
          return false;
        }
    }
    else{
      return false;
    }
  }
  public function get_json($uid,$pid){
    $mysqli=$this->my_connect();
    if (!$mysqli->connect_errno){
        $re=$mysqli->query("SELECT `id` FROM `projects` WHERE `pid`=$pid AND `uid`=$uid;");
        if($re->num_rows>0){
          $re=$mysqli->query("SELECT `JSON` FROM `project` WHERE `id`=$pid;");
          if($res=$re->fetch_assoc()){
          $mysqli->close();
          return $res['JSON'];
          }
        }
        else{
          $mysqli->close();
          return false;
        }
    }
    else{
      return false;
    }
  }
  public function send_json($uid,$pid,$json){
    $mysqli=$this->my_connect();
    if (!$mysqli->connect_errno){
        $json=$mysqli->real_escape_string($json);
        $re=$mysqli->query("SELECT `id` FROM `projects` WHERE `pid`=$pid AND `uid`=$uid;");
        if($re->num_rows>0){
          $re=$mysqli->query("UPDATE `project` SET `JSON` ='$json' WHERE `id`=$pid;");
          return true;
        }
    }
    else{
      return false;
    }
  }
  public function create_json($uid){
    $mysqli=$this->my_connect();
    if (!$mysqli->connect_errno){
      $mysqli->query("INSERT INTO `project` set `JSON`='{}';");
      $pid=$mysqli->insert_id;
      $mysqli->query("INSERT INTO `projects` set `uid`=$uid,`pid`=$pid;");
      $mysqli->close();
      return $pid;
    }
    else{
      return false;
    }
  }
  public function auth($email,$password){
    $mysqli=$this->my_connect();
    if (!$mysqli->connect_errno){
      $email 	 = $mysqli->real_escape_string($email);
      $password = $this->my_hash($password);
      $find_user = $mysqli->query("SELECT `id` FROM `users` WHERE `email`='$email';");
      if($find_user->num_rows>0){
        $s=$this->gen_token();
        $t=$this->gen_token();
        $reg_query = $mysqli->query("INSERT INTO `session` SET `session`='$s',`token`='$t',`uid`=".$find_user->fetch_assoc()['id'].";");
        $this->auth_cookie($s,$t);
        $mysqli->close();
        $find_user->close();
        return true;
      }
      else{
        $find_user->close();
        $mysqli->close();
        return false;
      }
    }
    else{
      $mysqli->close();
      return false;
    }
  }
  public function check_cookie(){
    $mysqli=$this->my_connect();
    if (!$mysqli->connect_errno){
      if(isset($_COOKIE['session']) AND isset($_COOKIE['token'])){
        $session 	 = $mysqli->real_escape_string($_COOKIE['session']);
        $token 	 = $mysqli->real_escape_string($_COOKIE['token']);
        $user=$mysqli->query("SELECT `uid` `id` FROM `session` WHERE `session`='".$session."' AND `token`='".$token."';");
        if($user->num_rows>0){
          $id=$user->fetch_assoc()['id'];
          $mysqli->close();
          $user->close();
          return $id;
        }
        else{
          $mysqli->close();
          $user->close();
          return false;
        }
      }
      else{
        $mysqli->close();
        return false;
      }
    }
    else{
      $mysqli->close();
      return false;
    }
  }
  private function auth_cookie($session,$token){
    setcookie("session", $session, time()+3600000, "/");
		setcookie("token", $token, time()+3600000, "/");
    return 0;
  }
  private function smtp_send($to,$subject,$body,$from){
		require_once "mail_config.php";
		require_once "SendMailSmtpClass.php"; // Сторонний код для smtp
		$mailSMTP = new SendMailSmtpClass($mail_config['smtp_username'], $mail_config['smtp_password'], $mail_config['smtp_host'], $mail_config['sender_name'], $mail_config['smtp_port']);
		// заголовок письма
		$headers= "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: text/html; charset=utf-8\r\n"; // кодировка письма
		$headers .= "From: '".$from."'<".$mail_config['sender_name'].">\r\n"; // от кого письмо
		$result =  $mailSMTP->send($to, $subject, $body, $headers); // отправляем письмо
		return $result;
  }
  private function email_confirmer($email,$uid){
  		$token=$this->gen_token();
  		$links='https://becoder.newpage.xyz';
  		$text="<h1>Подтверждение регистрации</h1><br>".
  		$email.", вы получили данное письмо, так как был зарегистрированы в системе %System%. Для окончания регистрации перейдите по ссылке<br>".
  		'<a href="'.$links.'/confirm?t='.$token.'">'.$links.'/confirm?t='.$token.'</a>' ;
  		$mysqli=	$this->my_connect();
  		$mysqli->query("INSERT INTO `mail_confirm` SET `uid`=$uid, `token`='$token';");
  		$mysqli->close();
		return $this->smtp_send($email,"Регистрация нового пользователя",$text,"sendbot newpage.xyz");
  }
  public function email_confirm_by_token($token){
  		$mysqli=	$this->my_connect();
		$find_token=$mysqli->query("SELECT `uid` from `mail_confirm` WHERE `token`='$token';");
		if($find_token->num_rows>0){
			$mysqli->query("UPDATE `users` SET `power`=1 WHERE	`id`=".$find_token->fetch_assoc()['uid'].";");
			$mysqli->query("DELETE from `mail_confirm` WHERE	`token`='$token';");
      $mysqli->close();
      $find_token->close();
			return true;
		}
		else{
      $find_token->close();
      $mysqli->close();
			return false;
		}
  }
  private function my_hash($string){
  		return hash('sha256',$string."salt");
  }
  private function gen_token(){
  		return hash('sha256',random_bytes(64));
  }

}
?>
