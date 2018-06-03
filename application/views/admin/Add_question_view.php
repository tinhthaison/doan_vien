<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html>
<header><meta charset="utf-8"/><title>add_menu</title></header>
<body>
Bạn đang thêm câu hỏi thuộc chủ đề:<?php echo $subject_id;
?>
<form id="add_question" action="" method="post">
Thêm câu hỏi tại đây
<input type="text" value="" name="question" maxlength="200" placeholder="viết câu hỏi" required size="50"/></br>
đáp án:</br>
<input type="text" value="" name="answer_1" maxlength="200" required size="50"/><input type="checkbox"  name="check_box" value="1"/></br>
<input type="text" value="" name="answer_2" maxlength="200" required size="50"/><input type="checkbox"  name="check_box2" value="1"/></br>
<input type="text" value="" name="answer_3" maxlength="200" required size="50"/><input type="checkbox"  name="check_box3" value="1"/></br>
<input type="text" value="" name="answer_4" maxlength="200" required size="50"/><input type="checkbox"  name="check_box4" value="1"/></br>
<input type="submit" name="ok" value="thêm"/>
</form>
</body>
</html>