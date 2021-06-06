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
</head>
<title>Upload</title></head><div id="container-fluid"><body>
<form action="<?php echo base_url()?>excel/reader" method="post" enctype="multipart/form-data" ><div class="custom-file">
        <label class="custom-file-label" for="validatedCustomFile">Chọn bảng điểm để upload</label>
        <input type="file" class="custom-file-input" id="validatedCustomFile" name="xls" required>
        <label class="custom-file-label" for="validatedCustomFile">Bạn sẽ cập nhật điểm cho lớp?</label>
        <select name="select_class"><?php foreach ($Class_id as $class){
            echo '<option value='.$class['class_id'].'>'
            .$class['class_name'].'</option>';}?></select>
     <br>  <input type='submit' value="upload" name="ok"></div>
    </form></body>
</div>

</html>
