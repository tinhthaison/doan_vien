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
<title>Từ điển tiếng Cao Lan</title></head><div id="container-fluid"><body>
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="<?php echo base_url()?>">Từ điển tiếng Cao Lan</a>
            </div>
            <ul class="nav navbar-nav">
                <li class="active"><a href="<?php echo base_url()?>">Home</a></li>
                <li><a href="<?php echo base_url().'welcome/thong_tin'?>">Thông tin</a></li>
                <li><a href="<?php echo base_url()?>welcome/lien_he">Lời cảm ơn</a></li>
            </ul>
        </div>
    </nav>
    <div class=”row”>
    <p><div class="col-md-2"><?php  //echo "<table class='table table-striped'><tr><td class='success'> CSDL MYSQL:".$this->db->version()."</td></tr></table>";?></div></p></div>
    <div class="col-md-4 col-md-offset-2 col-xs-12 col-sm-12">
<form  form action="<?php echo base_url().'welcome/dich';?>" method="get"><select name="lua_chon" id="lua_chon1"><?php $stick=array('Việt-Cao lan','Cao lan-Việt');for($i=0;$i<=1;$i++){
    echo "<option value='$i'";
    if(isset($lua_chon)&&$lua_chon==$i){echo "selected='selecteđ'";}  echo ">".$stick[$i]."</option>";
        }?></select>&nbsp
    <input type="search"  name="search" id="key" value="<?php if(isset($tu_da_nhap)){echo $tu_da_nhap;}?>"><button type="submit" class="btn-success" name="ok" value="Dịch">Dịch</button></form>
<?php if(isset($tu_da_nhap)){if(isset($tu)){
foreach($tu as $tu){echo "<p style='color:red; font-size:20px'>".$tu['dich'].':&nbsp'.$tu['y_nghia'].'</p><br/>'. $tu['Vidu'];}
}else{echo "Từ này không có trong từ điển, xin lỗi bạn";}}
?></div>
</div>
</body>
</html>
