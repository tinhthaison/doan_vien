<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html>
<head><title>See menu</title></head>
<body>
<table border="1px">
<th>Id</th>
<th>Vitri menu</th>
<th>Tên menu</th>
<th>Edit</th>
<th>DEl</th>
<?php foreach($table as $table){
    echo "<tr><td>".$table['menu_id']."</td>";
    echo "<td>".$table['vitri_menu']."</td>";
    echo "<td>".$table['ten_menu']."</td>";
    echo "<td><a href='update_menu/chinhsua/{$table['menu_id']}'>Edit</a></td>";
    echo "<td><a href='delete_menu/delete/{$table['menu_id']}'>DEl</a></td></tr>";
}?>
</table>
</body>
</html>