<?php
    
    require '../config.php';

    $json_arr=json_decode($_POST['userInfo'],true);
  
    $query_search=mysql_query("SELECT id FROM user WHERE token='{$_POST['token']}'") 
                    or die ('mysql错误！'.mysql_error());


    $id_res=mysql_fetch_array($query_search ,MYSQL_ASSOC);
    if($id_res){
        $id=$id_res['id'];

        //更新user_info表
        $query_userInfo="UPDATE user_info SET userName='{$json_arr['userName']}',
                            portraitPath='{$json_arr['portraitPath']}',
                            attackValue='{$json_arr['attackValue']}',
                            defenseValue='{$json_arr['defenseValue']}',
                            cureValue='{$json_arr['cureValue']}',
                            level='{$json_arr['level']}',
                            correctNum='{$json_arr['correctNum']}',
                            userLevelInfosPath='{$json_arr['userLevelInfosPath']}'
                            WHERE userId='{$id}'";

        mysql_query($query_userInfo) or die ('sql错误！'.mysql_error());


        //更新user_role表
        $level_count=count($json_arr['roleInfos'],0);
        for($i=0;$i<$level_count;$i++){
            $role_index="role".$json_arr['roleInfos'][$i]['id'];
            $level_index=$json_arr['roleInfos'][$i]['state'];
            $query_userRole="UPDATE user_role SET {$role_index}='{$level_index}' WHERE userId='{$id}'";
            mysql_query($query_userRole) or die ('sql错误!'.mysql_error());
        }
    }else{
        //token错误
        @header('Http/1.0 403 用户授权错误，服务器拒绝访问(token错误)');
    }
    

    

?>
