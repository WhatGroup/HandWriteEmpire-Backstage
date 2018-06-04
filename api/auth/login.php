<?php
    
   require "../config.php";

    $_pass=sha1($_GET['paw']);
	$query=mysql_query("SELECT token FROM user WHERE account='{$_GET['account']}' AND password='$_pass'") or die('SQL错误！'.mysql_error());

	$row=mysql_fetch_array($query ,MYSQL_ASSOC);
	if($row){  //登录成功
		// echo $row['token'];
		// echo 0;
		$success_arr=Array('type'=>'success','message'=>'login success','attach'=>$row['token']);
		$success_json=json_encode($success_arr);
		@header('Http/1.0 200 请求成功');
		echo $success_json;
	}else{  //登录失败
		$error_arr=Array('type'=>'error','message'=>'username or password invalid!','atttch'=>'');
		$error_json=json_encode($error_arr);
		@header('Http/1.0 401 用户名或密码错误');
		echo $error_json;
	}

	mysql_close();
	
?>
