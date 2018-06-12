<?php
    
    require '../config.php';

    $query=mysql_query("SELECT id,account FROM user WHERE token='{$_GET['token']}'") 
    		or die('Mysql错误！'.mysql_error());

    $row=mysql_fetch_array($query ,MYSQL_ASSOC);
    
    if($row){
        
        @header('Http/1.0 200 请求成功');
    	getData($row['id'],$row['account']);

    }else{
    	$error_arr=Array('type'=>'error','message'=>'token invalid!','attach'=>'');
    	$error_json=json_encode($error_arr);
    	@header('Http/1.0 403 用户授权错误，服务器拒绝访问(token错误)');
    	echo $error_json;
    }

    //获取数据，返回json对象
    function getData($id,$account){
        $query_userInfo=mysql_query("SELECT userName,portraitPath,attackValue,defenseValue,cureValue,level,correctNum,rank,userLevelInfosPath,userErrorWordInfosPath FROM user_info WHERE userId='{$id}'") 
            or die('Mysql错误！'.mysql_error());

    	$row1=mysql_fetch_array($query_userInfo ,MYSQL_ASSOC);
    
    	$row2=Array('account'=>$account);

        //间名
    	$row_roleKey=array("roleInfos");

    	$query_roleAll=mysql_query("SELECT 
            id,roleName,rolePortraitPath,roleLiHuiPath,roleType,roleIntro,roleSkillDesc,
    	unlockValue,roleHp,roleSkillValue FROM role_info LIMIT 0,6") 
    		or die('Mysql错误！'.mysql_error());

        //获取角色状态
        $query_roleState=mysql_query("SELECT 
            role1,role2,role3,role4,role5,role6 FROM user_role WHERE userId='{$id}'") 
            or die('Mysql错误！'.mysql_error());

        $roleState=mysql_fetch_array($query_roleState,MYSQL_ASSOC);

        //存储role_info的数据
        $role_arr=[];
        $i=1;
    	while ($row_roleValue=mysql_fetch_array($query_roleAll ,MYSQL_ASSOC)) {
            
            $role=array('state'=>$roleState["role".$i]);
            $i++;
            $row_All=array_merge($role,$row_roleValue);
            array_push($role_arr,$row_All);
    	}

        


        //使用指定的键和值填充数组
		$row3=array_fill_keys($row_roleKey,$role_arr);

        $rowAll=array_merge($row1,$row2,$row3);

    	echo json_encode($rowAll);
    }

	mysql_close();

?>
