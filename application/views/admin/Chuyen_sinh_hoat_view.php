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

        })
    </script>

</head>
<title>Chuyển sinh hoạt</title></head>
<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href=#><img class="img-responsive" src="<?php echo base_url()?>image/logo.png" width="100" height="60"/> </a>
        </div>
        <ul class="nav navbar-nav navbar-right">
            <li class="active"><a href="<?php echo base_url()?>">Home</a></li>
            <li><a href="<?php echo base_url().'welcome/translate'?>">Tìm việc làm</a></li>
            <li><a href="<?php echo base_url().'welcome/thong_tin'?>"><button class="btn btn-primary btn-circle"><span class="glyphicon glyphicon-bell"></span></button>  </a></li>
            <li><a href="<?php echo base_url().'admin/login/logout'?>"><button class="btn btn-warning btn-circle"> <span class="glyphicon glyphicon-log-out"></span> </button></a>
            </li>
        </ul>


    </div>
</nav>


<div class=”row” >
    <div class="col-md-2 container-fluid">
        <p class="text-info text-right">  Xin chào <?php echo $user;?>!</p>
        <nav class="navbar navbar-default">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav nav-pills nav-stacked" style="background-color: white;height: 100%">
                    <li><a href="<?php echo $base_url;?>admin/index">Kết nối<span class="glyphicon glyphicon-transfer"></span></a></li>
                    <li><a href="<?php base_url ();?>">Thống kê <span class="glyphicon glyphicon-record"></span> </a></li>
                    <li><a href="<?php echo $base_url;?>admin/index/bieu_do"">Biểu đồ<span class="glyphicon glyphicon-signal"></span> </a></li>
                    <li class="active"><a href="<?php echo $base_url;?>admin/index/chuyen_sinh_hoat">Chuyển<span class="glyphicon glyphicon-refresh"></span> </a></li>
                    <li><a href="<?php echo $base_url;?>admin/index/ren_luyen">Rèn luyện<span class="glyphicon glyphicon-star"></span> </a></li>
                    <li><a href="#">Quỹ<span class="glyphicon glyphicon-piggy-bank"></span> </a></li>
                    <li><a href="<?php echo $base_url;?>admin/index/sinh_hoat_he">Sinh hoạt hè<span class="glyphicon glyphicon-time"></span> </a></li>
                    <li><a href="#">Văn bản<span class="glyphicon glyphicon-list-alt"></span> </a></li>
                    <li><a href="#">Kế hoạch<span class="glyphicon glyphicon-flag"></span> </a></li>
                    <li><a href="#">Cài đặt <span class="glyphicon glyphicon-cog"></span></a></li>
                </ul>
            </div>
        </nav>
    </div></div>
<div class="row">
    <div class="col-md-8 ">

        <div class="btn-group">
            <button class="btn btn-info dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Chuyển đến <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
                <li class=""><a href="<?php echo base_url()?>admin/index/ket_nap">Từ DV kết nạp mới</a> </li>
                <li class=""><a href="<?php echo base_url()?>admin/index/move_in">Từ cơ sở khác</a> </li>
            </ul>
        </div>
        <div class="btn-group">
            <button class="btn btn-warning dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Chuyển đi <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
                <li class=""><a href="<?php echo base_url()?>admin/index/chuyen_di">Cơ sở khác</a> </li>
                <li class=""><a href="">DV trưởng thành</a> </li>
            </ul>
        </div>
    </div>
    <div class="col-md-8"><h3>Lượt chuyển đến:</h3><?php foreach ($chuyen_den as $chuyen_den){
            echo "<h5 class='text-primary'>".$chuyen_den['move_time'];echo " có ".$chuyen_den['move_number_dv']." đv chuyển</h5>";
            echo "<h5 class='text-danger'>Danh sách</h5>".$chuyen_den['move_data'];
        }?></div>
<div class="col-md-offset-2 col-md-8"><h3>Lượt chuyển đi:</h3>
    <?php foreach ($chuyen_di as $chuyen_di){
    echo "<h5 class=' text-primary'>".$chuyen_di['move_time'];echo " có ".$chuyen_di['move_number_dv']." đv chuyển</h5>";
        echo "<h5 class='text-danger'>Danh sách</h5>".$chuyen_di['move_data'];
    }?></div>
   </div>
</body>

</html>
