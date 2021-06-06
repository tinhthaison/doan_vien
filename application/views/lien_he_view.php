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
                <li><a href="<?php echo base_url()?>">Home</a></li>
                <li class="active"><a href="">Thông tin</a></li>
                <li><a href="<?php echo base_url()?>welcome/lien_he">Lời cảm ơn</a></li>
            </ul>
        </div>
    </nav>
    <div class="row"><div class="col-md-6 col-md-offset-2"><div class="bg-primary text-white"><h5>Xin chân thành gửi lời cảm ơn đến:<ul><li>Trần Thị Kim Anh Lớp 9B THCS Phú Lương khóa 2014-2018</li><li>Nịnh Ngọc Bích Lớp 9B THCS Phú Lương khóa 2014-2018</li><li>Cùng tập thể lớp 9B THCS Phú Lương khóa 2014-2018 cũng như rất nhiều các cá nhân khác đã giúp đỡ, hỗ trợ hoàn thành dự án này</li></ul></h5></div>
            <div class="bg-warning text-white">Số lượng từ hiện tại còn chưa được nhiều và có thể có nhiều sai sót, các bạn có thể tiếp tục giúp đỡ nhóm bằng cách gửi cho nhóm thêm các từ mới hoặc các từ cần sửa với nội dung như sau:1.Từ tiếng Việt; 2.Nghĩa khi dịch sang từ Cao Lan, 3. Câu ví dụ với từ đấy ( không bắt buộc) - viết bằng tiếng Cao Lan và có dịch sang tiếng Việt. Sau đó các bạn gửi file đính kèm vào địa chỉ tudiencaolan@gmail.com và chúng tôi sẽ cập nhật dữ liệu cho từ điển</div>
        </div></div>
    </body>
</html>
