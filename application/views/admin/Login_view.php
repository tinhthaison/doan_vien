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
    </script>
</head>
<title>Login</title></head>
    <body>
    <div class="container-fluid">

        <div class="row col-lg-offset-3"  style="background-image: url('<?php echo base_url()?>image/doan TN.jpg') ; height:100% ;width:100%;background-repeat:no-repeat;">
            <div class="col-xs-offset-2"> <h2 class="text-primary ">GO!DV</h2><h3 class="text-primary">Tiến lên đoàn viên!</h3></div>
                <form action="" class="form-inline" style="padding-top:100px " method="post">
                    <div class="form-group">
                        <div class="col-sm-10">
                         <input type="text" class="form-control" name="user" placeholder="User">
                        </div>
                    </div></br></br>
                    <div class="form-group">
                        <div class="col-sm-10">
                            <input type="password" class="form-control" name="pass" placeholder="Password">
                        </div>
                    </div></br></br>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <button type="submit" name="ok" class=" btn-primary btn-block" value="ok">Đăng nhập</button>
                        </div>
                    </div>
                </form>
        </div>
</body>

</html>
