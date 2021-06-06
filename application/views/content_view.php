<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('header_view');
?>
<title>Xin chào đến với website thpkhangnhat.ga</title>
<body>
<div id="content_view"><?php 
foreach ($tenchude as $menu){
        echo  "<li id='menu'><a href='http://localhost/CodeIgniter-3.1.2/welcome/chude/{$menu['menu_id']}'>".$menu['image_menu']."</a></li>";}?></div></body>
<?php $this->load->view('right_view');$this->load->view('footer_view');?>

