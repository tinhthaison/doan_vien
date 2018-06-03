<?php
defined('BASEPATH') OR exit('No direct script access allowed');?>
<meta charset="utf-8"/><title><?php echo $view['page_name']?></title>
<body><?php
echo "<h1>{$view['page_name']}</h1>";
echo "</br>".$view['content'];
?></body>