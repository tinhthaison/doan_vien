<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<html>
<head><meta charset="utf-8"/><script language="javascript" src="<?php echo base_url();?>/ckeditor/ckeditor.js"  type="text/javascript"></script><title>Add page</title></head>
<body><form id="add_page" action="" method="post">
<label>Tên trang</label></br>
<input type="text" name="page_name" size="20" placeholder="Điền tên trang"/></br>
<label>Thuộc chủ đề</label></br>
<select name="menu"><?php foreach($name_menu as $menu){
    echo"<option value={$menu['menu_id']}>"."{$menu['ten_menu']}<option>";}
?></select></br>
<label>Nội dung bài viết</label></br>
<textarea name="content_page" id="soanthao" cols="50" rows="20"></textarea><script type="text/javascript">CKEDITOR.replace( 'soanthao'); </script></br>
<input type="submit" name="ok" value="Gửi"/>
</form></body>
</html>