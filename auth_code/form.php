<?php
    if(isset($_REQUEST['authcode'])) {
        session_start();
        
        if($_REQUEST['authcode'] == $_SESSION['authcode']) {
            echo '<font color="#0000CC">输入正确</font>';
        } else {
            echo '<font color="#CC0000">输出错误</font>';
        }
        exit();
    }
?>

<html>
    <head>
        <title>确认验证码</title>
    </head>
    <body>
        <form action="./form.php" method="post">
            <p>验证图片：<image border="1" src="./captcha.php?r=<?php echo rand(); ?>" width="100px;"></p>
            <p>请输入图片中的内容：<input type="text" name="authcode" value=""></p>
            <p><button type="submit" style="padding: 6px 20px;">提交</button></p>
        </form>
    </body>
</html>