<?php

    //$fileInfo = $_FILES['myFile'];
    
    function uploadFile($fileInfo, $uploadPath = 'uploads', $flag = true, $allowExt = array('jpeg', 'jpg', 'png', 'gif'), $maxSize = 2097152) {
            //判断错误号
        if($fileInfo['error'] > 0) {
            switch($fileInfo['error']) {
                case 1:
                    $mes =  '上传文件超过了PHP配置文件中upload_max_filesize选项的值';
                    break;
                case 2:
                    $mes =  '超过了表单MAX_FILE_SIZE的大小';
                    break;
                case 3:
                    $mes =  '部分文件上传';
                    break;
                case 4:
                    $mes =  '没有选择上传文件';
                    break;
                case 6:
                    $mes =  '没有找到临时目录';
                    break;
                case 7:
                case 8:
                    $mes =  '系统错误';
                    break;  
            }
            exit($mes);
        }
        
        if(!is_array($allowExt)) {
        exit('系统错误');
    }
        
        //检测上传文件的类型
        $ext = @pathinfo($fileInfo['name'], PATHINFO_EXTENSION);
        //$allowExt = array('jpeg', 'jpg', 'png', 'gif');
        if(!in_array($ext, $allowExt)) {
            exit('非法文件类型');
        }
        //检测上传文件大小是否符合规范
        //$maxSize = 2097152;//2M;
        if($fileInfo['size'] > $maxSize) {
            exit('上传文件过大');
        }
        //检测图片是否为真实的图片类型
        //$flag = true;默认检测为true，不检测为false
        if($flag) {
            if(!getimagesize($fileInfo['tmp_name'])) {
                exit('不是真实图片类型');
            }
        }
        //检测文件是否通过HTTP POST方式上传来的
        if(!is_uploaded_file($fileInfo['tmp_name'])) {
            exit('文件不是通过HTTP POST方式上传来的');
        }
        //$uploadPath = 'uploads';
        if(!file_exists($uploadPath)) {
            mkdir($uploadPath, 0777, true);
            chmod($uploadPath, 0777);
        }
        $uniName = md5(uniqid(microtime(true), true)) . '.' . $ext;
        $destination = $uploadPath . '/' . $uniName;
        if(!move_uploaded_file($fileInfo['tmp_name'], $destination)) {
            exit('文件移动失败');
        }
        //echo '文件上传成功';
        //return array(
            //'newName' => $destination,
            //'size' => $fileInfo['size'],
            //'type' => $fileInfo['type'] 
        //);
        return $destination;
        }
    