<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<html>
<head><meta charset="utf-8"/><title><?php echo $name_menu['ten_menu']?></title></head>
<body><h1><?php echo $name_menu['ten_menu']?></h1><ul><h3><?php foreach($info_menu as $r1){ echo "<li><a href='$link/Welcome/View_page/{$r1['page_id']}'>{$r1['page_name']}</a></li>";}?></h3></ul></body>
</html>