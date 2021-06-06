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
        $(document).ready(function()
        {
            if($("#lua_chon1").val()==0){$a="json_vi";}else {$a="json_ca";}
            $("#key").autocomplete({
                    source: "<?php echo base_url()?>welcome/"+$a
                } //link xử lý dữ liệu tìm kiếm
            );
            $("#lua_chon1").change(function(){
                 if($("#lua_chon1").val()==0){$a="json_vi";}else {$a="json_ca";}
                $("#key").autocomplete({
                        source: "<?php echo base_url()?>welcome/"+$a
                    } //link xử lý dữ liệu tìm kiếm
                );//ket thuc lay dl
            });
            })
    </script>

</head>
<title>Go!DV</title></head>
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href=#><img class="img-responsive" src="<?php echo base_url()?>image/logo.png" width="100" height="60"/> </a>
            </div>
            <ul class="nav navbar-nav navbar-right">
                <li class="active"><a href="<?php echo base_url()?>">Home</a></li>
                <li><a href="<?php echo base_url().'welcome/translate'?>">Tìm việc làm</a></li>
                <li><a href="<?php echo base_url().'welcome/thong_tin'?>"><button class="btn btn-primary btn-circle"><span class="glyphicon glyphicon-bell"></span></button>  </a></li>
                <li><a href="<?php echo base_url()?>welcome/lien_he"><button class="btn btn-warning btn-circle"> <span class="glyphicon glyphicon-user"></span> </button></a></li>
            </ul>
        </div>
    </nav>


    <div class=”row” >
        <div class="col-md-2 container-fluid">
            <p class="text-info text-right">  Xin chào bí thư chi đoàn thôn ***!</p>
        <nav class="navbar navbar-default">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav nav-pills nav-stacked" style="background-color: white;height: 100%">
                    <li class="active"><a href="#">Thông tin chung<span class="glyphicon glyphicon-exclamation-sign"></span></a></li>
                    <li><a href="#">Thống kê <span class="glyphicon glyphicon-record"></span> </a></li>
                    <li><a href="#">Biểu đồ<span class="glyphicon glyphicon-signal"></span> </a></li>
                    <li><a href="#">Danh hiệu<span class="glyphicon glyphicon-star"></span> </a></li>
                    <li><a href="#">Văn bản<span class="glyphicon glyphicon-list-alt"></span> </a></li>
                    <li><a href="#">Kế hoạch<span class="glyphicon glyphicon-flag"></span> </a></li>
                    <li><a href="#">Cài đặt <span class="glyphicon glyphicon-wrench"></span></a></li>
                </ul>
                </div>
        </nav>
        </div></div>
    <div class="row"> <div class="col-md-4"><h5><a href=""> <img src="" class="btn-circle">Bootstrap</a> <small>Đoàn viên-Time</small></h5><p>Finally exploring our own SVG icon library for v5! If all goes well, we'll be using these for our own components and open sourcing them alongside our next major update :D
        </p> </div> <div class="col-md-8"></div></div>
    <div class="row"><div class="col-md-4"><img src="" class="btn-circle"><p class="text-primary">Bootstrap2</p><p>Finally exploring our own SVG icon library for v5! If all goes well, we'll be using these for our own components and open sourcing them alongside our next major update :D
            </p> </div><div class="col-md-8"></div></div>
</body>

</html>
