<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html>
<header><meta charset="utf-8"/><title>config_menu</title></header>
<body>
<form id="update_menu" action="" method="post">
chỉnh sửa tên menu.</br>
<input type="text" name="name_menu" maxlength="500" size="50" value="<?php  echo $Config['ten_menu'];?>"  />
</br>sửa vị trí menu</br>
<select name="point_menu"><?php for($i=1;$i<=$vitri+1;$i++){echo "<option value='$i'";if($Config['vitri_menu']==$i)
echo "selected='selected'";echo ">".$i."</option>";}?></select></br>
<input type="submit" name="submit_menu" value="Sửa"/>
</form>
</body>
</html>