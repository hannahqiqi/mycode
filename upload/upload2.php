<html>
    <head>
        <title>Upload1</title>
    </head>
    <body>
        <form action="doAction5.php" method="post" enctype="multipart/form-data">
            请选择您要上传的文件：<input type="file" name="myFile1"><br />
            请选择您要上传的文件：<input type="file" name="myFile2"><br />
            请选择您要上传的文件：<input type="file" name="myFile[]"><br />
            请选择您要上传的文件：<input type="file" name="myFile[]"><br />
            请选择您要上传的文件：<input type="file" name="myFile[]" multiple="multiple"><br />
            <button type="submit">上传文件</button>
        </form>
    </body>
</html>