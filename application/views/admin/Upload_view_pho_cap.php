<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*include('left_view.php');*/
?>
<html>
<head><meta charset="utf-8"/>
    <link rel="stylesheet" href="<?php echo base_url()?>jquery/jquery-ui.css">
    <script src="<?php echo base_url()?>doan_vien/jquery/jquery-3.2.1.min.js"></script>
    <script src="<?php echo base_url()?>doan_vien/jquery/jquery-ui.js"></script>
    <link rel="stylesheet" href="<?php echo base_url()?>/bootstrap/css/bootstrap.min.css">
    <script src="<?php echo base_url()?>bootstrap/js/bootstrap.min.js"></script>

</head>
<title>Upload từ file phổ cập</title></head><div id="container-fluid"><body>
    <form action="<?php echo base_url()?>excel/reader_pho_cap" method="post" enctype="multipart/form-data" ><div class="custom-file">
            <label class="custom-file-label text-primary" for="validatedCustomFile">Chọn file dữ liệu để upload</label>
            <input type="file" class="custom-file-input" id="validatedCustomFile" name="xls" required>
            <label class="text-primary">Chọn dữ liệu được upload</label>
            <select name="select">
                <option value="1">Dữ liệu đoàn viên</option>
                <option value="2">Dữ liệu bí thư chi đoàn</option>
                <option value="3">Dữ liệu thiếu niên, nhi đồng</option>
            </select>
            <br>  <input type='submit' value="upload" name="ok"></div>
    </form></body>
</div>

</html>
