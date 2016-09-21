<html>
    <head>
        <title>edit</title>
        <style>
            .wrapper {
                display: flex;
                justify-content: center;
            }
        </style>
    </head>
    <body>
        <div class="wrapper">
            <form action="update.php" method="get">
                <table>
                    <tbody>
                        <tr>
                            <td><input type="hidden" name="id" value="<?php echo @$_GET['id']; ?>"></td>
                        </tr>
                        <tr>
                            <td><input type="text" name="name" value="<?php echo @$_GET['name']; ?>"></td>
                        </tr>
                        <tr>
                            <td><input type="number" name="price" value="<?php echo @$_GET['price']; ?>"></td>
                        </tr>
                        <tr>
                            <td><button type="submit">Submit</button></td>
                        </tr>
                    </tbody>
                </table>
            </form>
        </div>
    </body>
</html>
    
    
    
