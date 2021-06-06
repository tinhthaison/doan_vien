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
            var result={};var array_result=[];var active;
            $( "#datepicker" ).datepicker({dateFormat: 'dd/mm/yy'});
            $('.active').change(function () {
                $('.btn-danger.save').prop('disabled', false);
                $(this).attr('class','active-on');
            })//end active
            $('.btn-danger.save').click(function () {
                $('.active-on').each(function () {
                    if($(this).is(':checked')){active='checked'}else {active=''};
                    array_result.push({doan_vien_id:$(this).val(),doan_vien_active:active});
                })
                $.post("<?php echo base_url ()."admin/index/save_active";?>",
                    {   post:'yes',
                        data:array_result
                    },
                    function(data, status){
                        alert("Data: " + data + "\nStatus: " + status);
                    });//end post
                $('.active-on').attr('class','active'); array_result=[];
                $('.btn-danger.save').prop('disabled', true);
            })//end save
            $('.doan-vien').click(function () {
                window.location.replace("<?php echo base_url()?>admin/index/thong_ke_doan_vien");
            })//end
            $('.all').click(function () {
                window.location.replace("<?php echo base_url()?>admin/index/thong_ke");
            })//end
        })
    </script>

</head>
<title>Chỉnh sửa thông tin</title></head>
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
                    <li class="active"><a href="<?php base_url ();?>">Thống kê <span class="glyphicon glyphicon-record"></span> </a></li>
                    <li><a href="<?php echo $base_url;?>admin/index/bieu_do"">Biểu đồ<span class="glyphicon glyphicon-signal"></span> </a></li>
                    <li><a href="<?php echo $base_url;?>admin/index/chuyen_sinh_hoat">Chuyển<span class="glyphicon glyphicon-refresh"></span> </a></li>
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
<div class="row"><h4>Chỉnh sửa thông tin của <?php echo $doan_vien_info['doan_vien_name']; ?></h4>
    <div class="col-md-8"><form class="form-group-lg" method="post" action=""></div>
<div class="col-md-8"><div class="col-md-4"> Họ và tên: <input type="text" name="name" class="form-control" value="<?php echo $doan_vien_info['doan_vien_name']?>"></div>
    <div class="col-md-2" class="form-control">    Năm sinh <input type="text" name="birthday" class="form-control" id="datepicker" value="<?php echo $doan_vien_info['doan_vien_birthday'];?> " ></div>
</div>
    <div class="col-md-8"><div class="col-md-4" class="form-control"> Giới tính: <select class=" form-control" name="sex"><?php
                $doan_vien_sex=array(''=>'Nam','X'=>'Nữ');$doan_vien_active=array(''=>'Chưa gia nhập','checked'=>'Đã gia nhập');
                function check_seclect($sex_option,$sex_select){
                    foreach ($sex_option as $key=>$value){
                        echo "<option value='".$key."'";
                        if($key==$sex_select){ echo 'selected';}
                        echo ">".$value."</option>";
                    }}
                    check_seclect ($doan_vien_sex,$doan_vien_info['doan_vien_sex']); echo $doan_vien_info['doan_vien_sex'];
                ?>

            </select></div>
        <div class="col-md-2" class="form-control"> Dân tộc <input type="text" name="dan_toc" class="form-control" value="<?php echo $doan_vien_info['doan_vien_dantoc']?>"></div>
    </div>
    <div class="col-md-8"><div class="col-md-4"> Nơi ở: <input type="text" name="location" class="form-control" value="<?php echo $doan_vien_info['doan_vien_location']?>"></div>
        <div class="col-md-2" class="form-control"> Đoàn viên:<select class=" form-control" name="active">
            <?php
            check_seclect ($doan_vien_active,$doan_vien_info['doan_vien_active']);
            ?> </select></br></div>
        <div class="col-md-8"><input type="submit" name="ok" value="Lưu" class="btn btn-danger"/> </div>
        </form>
    </div>
</div>
</body>

</html>
