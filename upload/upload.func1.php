<?php
    //构建上传文件信息
    function getFiles() {
        foreach($_FILES as $file) {
            $i = 0;
            if(is_string($file['name'])) {
                $files[$i] = $file;
                $i++;
            } elseif(is_array($file['name'])) {
                foreach($file['name'] as $key => $val) {
                    $files[$i]['name'] = $file['name'][$key];
                    $files[$i]['type'] = $file['type'][$key];
                    $files[$i]['tmp_name'] = $file['tmp_name'][$key];
                    $files[$i]['error'] = $file['error'][$key];
                    $files[$i]['size'] = $file['size'][$key];
                    $i++;
                }
            }
        }
        return $files;
        
    }
    
    function uploadFile($fileInfo, $path='./uploads', $flag=true, $maxSize=1048576, $allowExt=array('jpeg', 'jpg', 'png', 'gif')) {
        //$maxSize = 1048576; //1M
        //$flag = true;
        //$allowExt = array('jpeg', 'jpg', 'gif', 'png');
        //判断错误号
        if($fileInfo['error'] === UPLOAD_ERR_OK) {
            //检测上传文件大小
            if($fileInfo['size'] > $maxSize) {
                $res['mes'] = $fileInfo['name'] . '上传文件过大';
            }
            // 检测上传文件类型
            $ext = getExt($fileInfo['name']);
            if(@!in_array($ext, $allowExt)) {
                $res['mes'] = $fileInfo['name'] . '非法文件类型';
            }
            //检测图片是否为真实图片类型
            if($flag) {
                if(!getimagesize($fileInfo['tmp_name'])) {
                    $res['mes'] = $fileInfo['name'] . '不是真实图片类型';
                }
            }
            //检测图片是否通过HTTP POST方式上传来的
            if(!is_uploaded_file($fileInfo['tmp_name'])) {
                $res['mes'] = $fileInfo['name'] . '文件不是通过HTTP POST方式上传的';
            }
            if(@$res) return $res;
            //$path = './uploads';
            if(file_exists($path)) {
                mkdir($path, 0777, true);
                chmod($path, 0777);
            }
            $uniName = getUniName();
            $destination = $path . '/' . $uniName . '.' . $ext;
            if(@!move_uploaded_file($fileInfo['tmp_name'], $destination)) {
                $res['mes'] = $fileInfo['name'] . '文件移动失败';
            }
            $res['mes'] = $fileInfo['name'] . '文件上传成功';
            $res['dest'] = $destination;
            return $res;
        } else {
            //匹配错误信息
            switch($fileInfo['error']) {
                case 1:
                    $res['mes'] =  '上传文件超过了PHP配置文件中upload_max_filesize选项的值';
                    break;
                case 2:
                    $res['mes'] =  '超过了表单MAX_FILE_SIZE的大小';
                    break;
                case 3:
                    $res['mes'] =  '部分文件上传';
                    break;
                case 4:
                    $res['mes'] =  '没有选择上传文件';
                    break;
                case 6:
                    $res['mes'] =  '没有找到临时目录';
                    break;
                case 7:
                case 8:
                    $res['mes'] =  '系统错误';
                    break;  
            }
                return $res;
        }
    }