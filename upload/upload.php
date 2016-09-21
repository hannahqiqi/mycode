<html>
    <head>
        <title>Upload</title>
    </head>
    <body>
        <form action="doAction3.php" method="post" enctype="multipart/form-data">
            <!--<input type="hidden" name="MAX_FILE_SIZE" value='999999'>-->
            请选择您要上传的文件：
            <!--<input type="file" name="myFile" accept="image/jpeg,image/gif"><br />-->
            <input type="file" name="myFile">
            <button type="submit">上传文件</button>
        </form>
    </body>
</html>