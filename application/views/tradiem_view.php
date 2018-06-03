<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*include('left_view.php');*/
?>
<html>
<head><meta charset="utf-8"/>
    <link rel="stylesheet" href="<?php echo base_url()?>jquery/jquery-ui.css"><meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="<?php echo base_url()?>jquery/jquery-3.2.1.min.js"></script>
    <script src="<?php echo base_url()?>jquery/jquery-ui.js"></script>
    <link rel="stylesheet" href="<?php echo base_url()?>/bootstrap/css/bootstrap.min.css">
    <script src="<?php echo base_url()?>bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function()
        {
            $a=$("#lua_chon1").val();
            $("#key").autocomplete({
                    source: "<?php echo base_url()?>check_mark/check/"+$a
                } //link xử lý dữ liệu tìm kiếm
            );
            $("#lua_chon1").change(function(){
              $a=$("#lua_chon1").val();
                $("#key").autocomplete({
                        source: "<?php echo base_url()?>check_mark/check/"+$a
                    } //link xử lý dữ liệu tìm kiếm
                );//ket thuc lay dl
            });
        })
    </script>

</head>
<title>Tra điểm</title></head><div id="container-fluid"><body>
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="">Tra điểm</a>
            </div>
        </div>
    </nav>
    <div class=”row”>
        <p><div class="col-md-2"><?php  //echo "<table class='table table-striped'><tr><td class='success'> CSDL MYSQL:".$this->db->version()."</td></tr></table>";?></div></p></div>
    <div class="col-md-4 col-md-offset-2 col-xs-12 col-sm-12">
        <form  form action="<?php echo base_url().'excel/show_diem/';?>" method="get">
            <input type="search"  name="search" id="key" value="<?php if(isset($tu_da_nhap)){echo $tu_da_nhap;}?>"><select name="lua_chon" id="lua_chon1">
                <?php
                foreach ($class as $class){
                    echo "<option value=".$class['class_id'].">".$class['class_name']."</option>";}
                ?></select>
            <br><button type="submit" class="btn-success" name="ok" value="Check">tra điểm</button></form>
       </div>
</div>
</body>
</html>
