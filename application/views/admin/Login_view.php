<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<html>
<head><title>Login page</title><meta charset="utf-8"></head>
<body>
<form id="login" method="post">
 <label>Tên đăng nhập</label><br/>
    <input type="text" name="user" maxlength="20" placeholder="tên đăng nhập"><br/>
    <label>Mật khẩu</label><br/>
    <input type="password" name="pass" placeholder="mật khẩu"><br/>
    <input type="submit" value="đăng nhập" name="ok">
</form>
</body>
</html>
