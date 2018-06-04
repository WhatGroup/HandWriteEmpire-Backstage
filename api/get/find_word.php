<?php
    
    require '../config.php';

    $query=mysql_query("SELECT token FROM user WHERE token='{$_GET['token']}'") 
            or die ('mysql错误！'.mysql_error());
            
    if(mysql_fetch_array($query,MYSQL_ASSOC)){
        
        //token存在
        $query_word=mysql_query("SELECT pinyin,content,detail FROM word WHERE content='{$_GET['word']}'") or die ('mysql错误！'.mysql_error());
        $row=mysql_fetch_array($query_word,MYSQL_ASSOC);
        if($row){

            //资源存在
            $success=array('pinyin'=>$row['pinyin'],'content'=>$row['content'],
                        'detail'=>$row['detail']);
            $success_json=json_encode($success);
            @header('Http/1.0 200 请求成功');
            print_r(urldecode($success_json));

        }else{

            //资源不存在
            $error=array('type'=>'fail','message'=>'not find resource','attach'=>'');
            $error_json=json_encode($error);
            @header('Http/1.0 410 资源不存在');
            print_r(urldecode($error_json));

        }

    }else{

        //token不存在
        $error = array('type'=>'error','message'=>'token invaild!','attach'=>'');
        $error_json=json_encode($error);
        @header('Http/1.0 403 用户授权错误，服务器拒绝访问(token错误)');
        echo $error_json;

    }

	mysql_close();

?>
       