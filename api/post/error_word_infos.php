<?php
    
    require '../config.php';

    

    $json_str=json_encode($_POST['userErrorWordInfos']);
    
    $query_searchId=mysql_query("SELECT id FROM user WHERE token='{$_POST['token']}'") 
                    or die ('mysql错误！'.mysql_error());
                    
    $row=mysql_fetch_array($query_searchId,MYSQL_ASSOC);

    if($row){

        $query_searchPath=mysql_query("SELECT userErrorWordInfosPath FROM user_info 
                            WHERE userId='{$row['id']}'") 
                            or die ('mysql错误！'.mysql_error());
        $Path=mysql_fetch_array($query_searchPath,MYSQL_ASSOC);
        // echo $Path['userErrorWordInfosPath'];
        $savePath='../../'.$Path['userErrorWordInfosPath'];

        //打开文件，读写模式
        $myfile=fopen($savePath, "w+");

        $key_str="userErrorWordInfos";
        
        $word_json='{"'.$key_str.'":'.$json_str.'}';
        //覆盖原有的内容
        fwrite($myfile, $word_json);

        //关闭文件
        fclose($myfile);

    }else{

        //token错误
        header('Http/1.0 403 用户授权错误，服务器拒绝访问(token错误)');

    }

	mysql_close();

?>
