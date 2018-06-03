<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<html>
<table border=1><th>Page_id</th><th>Menu_id</th><th>Title</th><th>Time</th><th>Content</th><th>Updates</th><th>Del</th>
<?php
Foreach($info as $info){
    echo "<tr><td>{$info['page_id']}</td>
    <td>{$info['menu_id']}</td>
    <td>{$info['page_name']}</td>
    <td>{$info['time_add_page']}</td>
    <td><a href='$link/welcome/View_page/{$info['page_id']}' target='_blank'>view</td>
    <td><a href='$link/edit_page/update_page/{$info['page_id']}'>edit</td>
    <td><a href='$link/edit_page/delete_page/{$info['page_id']}'>del</td></tr>";
}
?>
</table>
</html>