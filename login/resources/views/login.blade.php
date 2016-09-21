<html>
    <head>
        <title>Login</title>
    </head>
    <body>
        <form action="logon" method="get">
            <table>
                <tr><td>用户名</td><tr>
                <tr><td><input type="text" name="username" value="{{isset($username) ? $username : ''}}"></td></tr>
                <tr><td>密码</td></tr>
                <tr><td><input type="password" name="password"></td></tr>
                <tr><td><button type="submit">登录</button></td></tr>
            </table>
        </form>
    </body>
</html>