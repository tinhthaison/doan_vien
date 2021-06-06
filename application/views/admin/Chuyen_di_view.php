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
            $( "#datepicker" ).datepicker();
            var result={};var array_result=[];var active;var array_move_result=[];var i=0;
            $('.active').change(function () {
                $('.btn-danger.save').prop('disabled', false);
                $(this).attr('class','active-on');
            })//end active
            $('.btn-danger.save').click(function () {
                $('.active-on').each(function () {
                    if($(this).is(':checked')){active='checked';
                        array_result.push({doan_vien_id:$(this).val(),doan_vien_active:active,doan_co_so_id:1});array_move_result.push({move_id:$(this).attr('name')});i++;}
                })
                $.post("<?php echo base_url ()."admin/index/save_active";?>",
                    {   post:'yes',
                        data:array_result
                    },
                    function(data, status){
                        alert("Data: " + data + "\nStatus: " + status);
                    });//end post

                $.post("<?php echo base_url ()."admin/index/save_move";?>",
                    {   save:'yes',
                        data:array_move_result,
                        time:$('#datepicker').val(),
                        move_out:2,
                        move_in:1,
                        move_number_dv:i
                    },
                    function(data, status){
                        alert("Data: " + data + "\nStatus: " + status);
                    });//end post
                window.location.replace("<?php echo base_url()?>admin/index/chuyen_di");
            })//end save
            $('.back').click(function () {
                window.location.replace("<?php echo base_url()?>admin/index/chuyen_sinh_hoat");
            })//end
        })
    </script>
</head>
<title>Chuyển đi</title></head>
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
                    <li><a href="#">Danh hiệu<span class="glyphicon glyphicon-star"></span> </a></li>
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
    <div class="col-md-8"><button class="btn btn-info back">Quay lại</button>
        <button class="btn btn-danger save" disabled>Lưu danh sách chuyển đi</button></div>
    <div class="col-md-8"><p>**************</p></div>
    <div class="col-md-8"><p class="text-primary">Chọn ngày chuyển đi: <input type="text" id="datepicker" ></p></div>
    <div class="col-md-8"><a href=""> <p class="text-primary">Thêm mới chuyển đi</p></a></div>
    <div class="col-md-8"><p class="text-primary">Chọn từ danh sách lấy từ đoàn viên trên địa bàn xã</p></div>
    <div class="col-md-8"><table class="table table-bordered"><th class="active col-xs-1 ">ID</th>
            <th class="active col-xs-3">Tên</th><th class="active col-xs-2">Nơi ở</th><th class="active col-xs-1">Nữ</th><th class="active col-xs-1">Năm sinh</th>
            <th class="active col-xs-1">Lớp</th><th class="active col-xs-2">Dân tộc</th><th class="active col-xs-2">Trạng thái hđ</th><th class="active col-xs-1">Chuyển đi</th>
            <?php foreach ($doan_vien_info as $dv){
                echo "<tr class='warning'><td>".$dv['doan_vien_id']."</td>".
                    "<td>".$dv['doan_vien_name']."</td>".
                    "<td>".$dv['doan_vien_location']."</td>".
                    "<td>".$dv['doan_vien_sex']."</td>".
                    "<td>".$dv['doan_vien_birthday']."</td>".
                    "<td>".$dv['doan_vien_class']."</td>".
                    "<td>".$dv['doan_vien_dantoc']."</td><td>Chưa xác định</td><td><input type='checkbox' class='active' name='".$dv['doan_vien_name']."-".$dv['doan_vien_birthday']."-".$dv['doan_vien_location']."' value='".$dv['doan_vien_id']."' ></td></tr>";
            }?>
        </table></div>
</div>
</body>

</html>
