<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Add_subject extends CI_Controller {


      public function __construct(){
          parent::__construct();
          $this->load->helper('url');
          $this->load->model("Edit_question_model");
          $this->load->model("Edit_answer_model");
          
         }
    	public function  index()
	{
	   $url["url"]=base_url(); 
	  $this->load->view('admin/Add_subject_view',$url);
      if($this->input->post('ok')){
        $data["subject_note"]=$this->input->post("age");
        $data["subject_name"]=$this->input->post("subject_name");
        $this->Edit_question_model->Add_subject($data);
    echo"insertdata succssess";
    echo "<meta http-equiv='refresh' content='1;url={$url['url']}/add_subject/add_question' />";
      }
 }
 public function add_question(){
$data0=$this->Edit_question_model->Last_subject_id();
$this->load->view("admin/Add_question_view",$data0);
     $count_rows=$this->Edit_question_model->Count_rows();
     $check_box=$this->input->post("check_box");
     $check_box2=$this->input->post("check_box2");
     $check_box3=$this->input->post("check_box3");
     $check_box4=$this->input->post("check_box4");
     $b=$this->Edit_question_model->Last_subject_id();
     print_r($b) ;
      if($this->input->post('ok')){
$data["question_content"]=$this->input->post("question")  ;
$data["subject_id"]=$b['subject_id'];
$this->Edit_question_model->Add_question($data);
$data1["answer_content"]="a.".$this->input->post("answer_1");
if(isset($check_box)){
$data1["answer_true"]=$check_box;}else {$data1["answer_true"]=0;}
$data1["Question_id"]=$count_rows+1;
$this->Edit_answer_model->Add_answer($data1);// insert cau hoi 1
$data2["answer_content"]="b.".$this->input->post("answer_2");
if(isset($check_box2)){
$data2["answer_true"]=$check_box2;}else {$data2["answer_true"]=0;}
$data2["Question_id"]=$count_rows+1;
$this->Edit_answer_model->Add_answer($data2);//chen y b
$data3["answer_content"]="c.".$this->input->post("answer_3");
if(isset($check_box3)){
$data3["answer_true"]=$check_box3;}else {$data3["answer_true"]=0;}
$data3["Question_id"]=$count_rows+1;
$this->Edit_answer_model->Add_answer($data3);//chen y c
$data4["answer_content"]="d.".$this->input->post("answer_4");
if(isset($check_box4)){
$data4["answer_true"]=$check_box4;}else {$data4["answer_true"]=0;}
$data4["Question_id"]=$count_rows+1;
$this->Edit_answer_model->Add_answer($data4);
echo "insert data succsses!";
}
  
 }
 }
?>