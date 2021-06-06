<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*include('left_view.php');*/
?>
<html>
<head><meta charset="utf-8"/>
    <link rel="stylesheet" href="<?php echo base_url()?>jquery/jquery-ui.css">
    <script src="<?php echo base_url()?>jquery/jquery-3.2.1.min.js"></script>
    <script src="<?php echo base_url()?>jquery/jquery-ui.js"></script>
    <link rel="stylesheet" href="<?php echo base_url()?>/bootstrap/css/bootstrap.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="<?php echo base_url()?>bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            if($(window).width()>1000){
                $("#menu-sticky").attr("class","navigation");
                $("#menu-top").css("margin-bottom","100px");
            }//check screen



        })//end document
    </script>

</head>
<title>Go!DV</title></head>
<nav class="navbar navbar-inverse navbar-fixed-top" >
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href=#><img class="img-responsive" src="<?php echo base_url()?>image/logo.png" width="100" height="60"/> </a>
        </div>
        <ul class="nav navbar-nav navbar-right">
            <li class="active"><a href="<?php echo base_url()?>admin/index">Home</a></li>
            <li><a href="<?php echo base_url().'welcome/translate'?>">Tìm việc làm</a></li>
            <li><a href="<?php echo base_url().'welcome/thong_tin'?>"><button class="btn btn-primary btn-circle"><span class="glyphicon glyphicon-bell"></span></button>  </a></li>
            <li><a href="<?php echo base_url().'admin/login/logout'?>"><button class="btn btn-warning btn-circle "> <span class="glyphicon glyphicon-log-out"></span>  </button></a></li>

        </ul>


    </div>
</nav>
<div id="menu-top"></div>

<div class=”row " >
<div class="col-md-2 left container-fluid " id="menu-sticky" >
    <p class="text-info text-right">  Xin chào <?php echo $user;?>!</p>
    <nav class="navbar navbar-default ">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <div class="collapse navbar-collapse" id="myNavbar"  >
            <ul class="nav nav-pills nav-stacked"   style="background-color: white;height: 100%" >
                <li ><a href="<?php base_url ();?>">Kết nối<span class="glyphicon glyphicon-transfer"></span></a></li>
                <li><a href="<?php echo $base_url;?>admin/index/thong_ke">Thống kê <span class="glyphicon glyphicon-record"></span> </a></li>
                <li><a href="<?php echo $base_url;?>admin/index/bieu_do">Biểu đồ<span class="glyphicon glyphicon-signal"></span> </a></li>
                <li><a href="#">Danh hiệu<span class="glyphicon glyphicon-star"></span> </a></li>
                <li><a href="#">Quỹ<span class="glyphicon glyphicon-piggy-bank"></span> </a></li>
                <li><a href="<?php echo $base_url;?>admin/index/sinh_hoat_he">Sinh hoạt hè<span class="glyphicon glyphicon-time"></span> </a></li>
                <li><a href="#">Văn bản<span class="glyphicon glyphicon-list-alt"></span> </a></li>
                <li class="active"><a href="<?php echo $base_url;?>admin/index/ke_hoach">Kế hoạch<span class="glyphicon glyphicon-flag"></span> </a></li>
                <li><a href="#">Cài đặt <span class="glyphicon glyphicon-cog"></span></a></li>
            </ul>
        </div>
    </nav>
</div>
<div class="row"><div class="col-md-offset-3">
<h4 class="text-primary">Kế hoạch tiếp sức mùa thi</h4> <label class="btn-success">Đã hoàn thành</label>
        <h4 class="text-primary">Kế hoạch chủ nhật xanh</h4> <label class="btn-success">Đã hoàn thành</label>
        <h4 class="text-primary">Kế hoạch mùa đông ...</h4> <label class="btn-warning">Chuẩn bị diễn ra</label>
</div>
</div>
</body>
</html>
