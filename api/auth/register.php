<?php
    
    require '../config.php';

	//获取token
	function settoken()
    {
    	//生成一个不会重复的字符串
        $str = md5(uniqid(md5(microtime(true)),true));
        //加密  
        $str = sha1($str);  
        return $str;

    }
    $token=settoken();

    //检查用户名是否重复
    $query_check=mysql_query("SELECT account FROM user WHERE account='{$_GET['account']}'") or die('SQL错误！'.mysql_error());

    $row=mysql_fetch_array($query_check ,MYSQL_ASSOC);
    
    if($row){

    	//用户名重复如果重复
    	$error_arr=Array('type'=>'error','message'=>'account repeat','atttch'=>'');
		$error_json=json_encode($error_arr);
		@header('Http/1.0 409 服务器在完成请求时发生冲突。');
		echo $error_json;

    }else{

    	
    	$query="INSERT INTO user(account,password,token) 
			VALUES ('{$_GET['account']}',sha1('{$_GET['paw']}'),'{$token}')";

		mysql_query($query) or die('新增失败！'.mysql_error());

		
		//表中改变的行数
		if(mysql_affected_rows()){

			//成功
			$sucess_arr=Array('type'=>'success','message'=>'register success','attach'=>$token);
			$success_json=json_encode($sucess_arr);
			@header('Http/1.0 200 请求成功');
			echo $success_json;

			$id=mysql_insert_id();

			//初始化数据库数据以及创建json文件
			createUser($id);

		}else{

			//失败
			$error_arr=Array('type'=>'error','message'=>'account repeat','atttch'=>'');
			$error_json=json_encode($error_arr);
			@header('Http/1.0 409 服务器在完成请求时发生冲突。');
			echo $error_json;

		} 
    }

    //初始化数据库数据
    function createUser($id){

    	//创建userLevelInfosPath的json文件
    	$userLevelInfosPath=createLevelJson($id);
    	$userErrorWordInfosPath=createWordJson($id);

    	$query_userInfo="INSERT INTO user_info(userId,userLevelInfosPath,userErrorWordInfosPath,userName,portraitPath) 
			VALUES ('{$id}','{$userLevelInfosPath}','{$userErrorWordInfosPath}','玩家','res/images/portrait/img_20180524111830.png')";

		mysql_query($query_userInfo) or die('新增失败！'.mysql_error());

		$query_role="INSERT INTO user_role(userId) 
			VALUES ('{$id}')";

		mysql_query($query_role) or die('新增失败！'.mysql_error());
		
    }

    //对每一个新用户创建userLevelInfosPath的json文件并初始化数据
    function createLevelJson($id){

	    $savename_level = "userlevelInfos_".date('YmdHis',time()).$id.'.json';
	    $relpath_level = "../../";
	    $jsondirs_level = "res/userLevelInfos/";
	    
	    $savepath_level = $relpath_level.$jsondirs_level.$savename_level; 

	    $myfile_level = fopen($savepath_level, "w+");

	    //初始化数据
	    initialLevelJson($myfile_level,$savepath_level);

	    return $jsondirs_level.$savename_level;

    }	

    //初始化userLevelInfosPath的json文件
    function initialLevelJson($file,$savepath){
    	
    	//读取初始化的默认json文件
    	$myfile = fopen("../../res/userLevelInfos/userLevelInfos.json", "r") or die("Unable to open file!");

		$initialData=fread($myfile,filesize("../../res/userLevelInfos/userLevelInfos.json"));
		
		fwrite($file, $initialData);	

		fclose($myfile);
		
    }

    //创建错字本json文件
    function createWordJson($id){
    	$savename_word = "userErrorWordInfos_".date('YmdHis',time()).$id.'.json';
	    $relpath_word = "../../";
	    $jsondirs_word = "res/userErrorWordInfos/";
	    
	    $savepath_word = $relpath_word.$jsondirs_word.$savename_word; 

	    $myfile_word = fopen($savepath_word, "w+");

	    return $jsondirs_word.$savename_word;
    }

	mysql_close();

?>
