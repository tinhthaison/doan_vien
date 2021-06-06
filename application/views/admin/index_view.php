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

    $("#post").click(function(){
        var Post_content=$("#comment").val();
        var $this=$(this);
        $this.button('loading');
        setTimeout(function() {
            $this.button('reset');
        }, 3000);
        $.post("<?php echo base_url ()."admin/index/Post_user";?>",
            {
                Post_content: Post_content
            },
            function(data, status){
                $(".alert-danger").delay(2000).show();
                $(".alert-danger").text(data);
                $("#comment").val("");
                $(".alert-danger").delay(500).fadeOut();
                if (data == 'Post success!') {
                    $.post("<?php echo base_url ()."admin/index/Last_post";?>",
                        {
                            Post_success: 'ok'
                }, function Last_post(data2, status2) {
                            var value=JSON.parse(data2);
                           console.log(value.user_name);
                            $("#post-list").prepend("<div class='row'> <div class='col-md-offset-2 col-md-4'><h5><a href=''><img src='<?php echo base_url ();?>/image/user.png' class='btn-circle btn-lg img-circle'>"+value.user_name+"</a><small>"+value.Post_time+"</small></h5>"+value.Post_content+"</p> </div> <div class='col-md-8'></div></div>");

                        });//end last_post
                };//end if data
            });
    });//end post

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
                    <li class="active"><a href="<?php base_url ();?>">Kết nối<span class="glyphicon glyphicon-transfer"></span></a></li>
                    <li><a href="<?php echo $base_url;?>admin/index/thong_ke">Thống kê <span class="glyphicon glyphicon-record"></span> </a></li>
                    <li><a href="#">Biểu đồ<span class="glyphicon glyphicon-signal"></span> </a></li>
                    <li><a href="<?php echo $base_url;?>admin/index/chuyen_sinh_hoat"">Chuyển<span class="glyphicon glyphicon-refresh"></span> </a></li>
                    <li><a href="<?php echo $base_url;?>admin/index/ren_luyen">Rèn luyện<span class="glyphicon glyphicon-star"></span> </a></li>
                    <li><a href="#">Quỹ<span class="glyphicon glyphicon-piggy-bank"></span> </a></li>
                    <li><a href="<?php echo $base_url;?>admin/index/sinh_hoat_he">Sinh hoạt hè<span class="glyphicon glyphicon-time"></span> </a></li>
                    <li><a href="#">Văn bản<span class="glyphicon glyphicon-list-alt"></span> </a></li>
                    <li><a href="<?php echo $base_url;?>admin/index/ke_hoach">Kế hoạch<span class="glyphicon glyphicon-flag"></span> </a></li>
                    <li><a href="#">Cài đặt <span class="glyphicon glyphicon-cog"></span></a></li>
                </ul>
                </div>
        </nav>
        </div>
<div class="row"> <div class="col-md-offset-2 col-md-4"><div class="col-md-offset-2 col-md-6 alert alert-danger"  style="display:none ; position: absolute; z-index: 1000;opacity: 0.8"></div>
<div class="form-group" >
    </div>
  <label class="label-danger" for="comment">Tạo bài viết</label>
    <textarea class="form-control" rows="5" name="comment" id="comment" placeholder="Hey! Bạn muốn gì nào?"></textarea>
<button class="btn-primary btn-block"  data-loading-text="Posting..." value="ok" name="ok" type="submit" id="post">Post</button></div></div><div class="col-md-8"></div></div>
<div id="post-list">
<?php if(!empty($all_post)){foreach ($all_post as $all_post){
echo "<div class='row'> <div class='col-md-offset-2 col-md-4'><h5><a href=''><img src='".base_url ()."/image/user.png' class='btn-circle btn-lg img-circle'>".$all_post['user_name']."</a><small>".$all_post['Post_time']."</small></h5>".$all_post['Post_content']."</p> </div> <div class='col-md-8'></div></div>";
}}
?>
</div>
</body>
</html>
