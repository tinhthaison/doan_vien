<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*include('left_view.php');*/
?>
<html>
<head><meta charset="utf-8"/><link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/templates/style.css"/>
<title>Trắc nghiệm lịch sử</title></head><div id="left_view"></div>
<div id="content_view">
<body>
<h1>Trắc nghiệm lịch sử</h1>
<?php
    $url= base_url();
    foreach($subject_view as $sb2){echo "<a href='$url/welcome/bo_de/{$sb2['subject_id']}'>".$sb2['subject_name']."</a></br>";}
?>
</body></div></html>
