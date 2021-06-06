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
    <div class="row"><div class="col-md-6 col-md-offset-2"><h2>I.Thông tin về Dân tộc Cao lan</h2><img class="img-responsive" src="<?php echo base_url();?>/image/caolan-%20nguon%20tuyengiao.vn.jpg"></div>
        <div class="col-md-8 col-md-offset-2"><div class="bg-warning text-white"><b> Theo danh mục các dân tộc ở Việt Nam do Tổng cục Thống kê ban hành năm 1979, người Cao Lan là một nhóm địa phương thuộc dân tộc Sán Chay. Kết quả điều tra dân số năm 2009 cho thấy có 169.410 người Sán Chay, sống tập trung tại các tỉnh trung du miền núi phía Bắc: Tuyên Quang (61.343 người), Thái Nguyên (32.483 người), Bắc Giang (25.821 người), Quảng Ninh (13.786 người), Yên Bái
                    (8.461 người), Cao Bằng (7.058 người), Lạng Sơn (4.384 người), Phú Thọ(3.294 người), Vĩnh Phúc (1.611 người), Bắc Kạn (602 người)... Một số mới di cư vào các tỉnh miền Trung, Tây Nguyên và Nam Trung Bộ.</b></div>
            <div class="bg-success text-white"><b> Dân tộc Sán Chay có hai nhóm địa phương là Cao Lan và Sán Chỉ. Trong đó, người Cao Lan chiếm khoảng 63% tổng dân số dân tộc Sán Chay. Người Cao Lan tự gọi mình là Hờn Bán, có nghĩa là "người ở bản". Ở Thái Nguyên, Tuyên Quang và Yên Bái cộng đồng này còn tựgọi mình là Sán Chấy. Ngoài ra, họ còn được biết đến
                    với những tên gọi khác như: Sùn Nhằn (người ở thôn bản), Phén, Chùng...Người Sán Chỉ tự gọi mình là Sán Chay, có nghĩa là "quả ở trên rừng". Cũng có ý kiến cho rằng tộc danh Sán Chay bắt nguồn từ hai chữ Sơn Tử, nghĩa là người ở trên núi Tiếng Cao Lan là một ngôn ngữ đơn tiết, có thanh điệu. Về phân loại thân tộc ngôn ngữ, hiện nay tất cảcác nhà nghiên cứu đều mới chỉthống nhất với nhau vềvịtrí của tiếng Cao Lan là thuộc ngữ hệTai - Kadai, nhánh Kam - Tai, tiểu nhánh Be - Tai, nhóm Tai. Vấn đề tiếng Cao Lan thuộc tiểu nhóm nào trong nhóm Tai vẫn còn
                    chưa được thống nhất.
                </b></div><p class="text-danger">Nguồn: Vị trí của tiếng Cao Lan trong các ngôn ngữ tai- Ths Phan Lương Hùng</p>
        </div>
        <div class="col-md-6 col-md-offset-2"><h2>II.Tại sao không phiên âm sang chuẩn IPA?</h2></div>
        <div class="col-md-8 col-md-offset-2"><div class="bg-danger text-white"><b>Bảng mẫu tự ngữ âm quốc tế hay Bảng ký hiệu ngữ âm quốc tế (viết tắt IPA[1] từ tiếng Anh International Phonetic Alphabet) là hệ thống các ký hiệu ngữ âm được các nhà ngôn ngữ học tạo ra và sử dụng nhằm thể hiện các âm tiết trong mọi ngôn ngữ của nhân loại một cách chuẩn xác và riêng biệt. Nó được phát triển bởi Hội Ngữ âm Quốc tế (ban đầu là Hội Giáo viên Ngữ âm – Dhi Fonètik Tîcerz' Asóciécon) với mục đích trở thành tiêu chuẩn phiên âm cho mọi thứ tiếng trên thế giới.</b></div></div>
        <div class="col-md-8 col-md-offset-2"><div class="bg-primary text-white">
                <b>Thực sự nếu dùng chuẩn IPA để phiên âm tiếng Cao Lan thì sẽ giúp phát âm chính xác hơn rất nhiều, nhưng trong điều kiện của nhóm - chủ yếu là học sinh, thực sự chưa đủ khả năng để phiên âm sang chuẩn IPA, hơn nữa cho dù có thể phiên âm sang chuẩn IPA được( Ví dụ như tiếng anh cover đọc là kəvər) thì không phải ai cũng có thể đọc được dễ dàng, vì vậy nhóm xin được phép dịch theo phiên âm tiếng việt để phục vụ đại đa số mọi người </b></div>
        </div>
</body>
</html>
