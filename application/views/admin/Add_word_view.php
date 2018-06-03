<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html>
<header><meta charset="utf-8"/><title>add_menu</title></header>
<body><?php echo "Xin chào&nbsp".$_SESSION['user'];?><br/><a href="<?php echo base_url().'/admin/login/logout';?>">Đăng xuất</a><br/>
<b>Bạn thêm cơ sở dữ liệu tại đây:</b>
<form id="add_word" action="" method="post">
    Tiếng Việt:<br/>
    <input type="text" value="" name="vietnamese" maxlength="200" placeholder="từ cần tra" required size="50"/></br>
    Tiếng Cao lan:<br/>
    <input type="text" value="" name="caolan" maxlength="200" required size="50"/></br>
    Câu ví dụ<br/>
    <textarea name="vi_du" cols="30" rows="5"/></textarea></br>Loại từ</br>
    <select name="loai_tu"><?php $loai_tu=array('Danh từ', 'Động từ', 'Tính từ', 'Trạng từ' , 'Cảm thán từ', 'Số từ', 'Lượng từ', 'Chỉ từ', 'Giới từ', 'Quan hệ từ', 'Từ mượn tiếng Việt');
        for($i=0;$i<=10;$i++){echo "<option value='{$loai_tu[$i]}'>{$loai_tu[$i]}</option>";}?></select>
    <input type="submit" name="ok" value="thêm"/>
</form>
</body>
</html>