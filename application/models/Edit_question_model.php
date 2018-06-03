<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Edit_question_model extends CI_Model {


      public function __construct(){
          parent::__construct();
         $this->load->helper('url');
         $this->load->database();} //truy cap csdl 
             
          public function Last_subject_id(){/*dem dong cuoi*/
   $query=$this->db->query('SELECT subject_id FROM subject ');
    if($query->num_rows()==0){
       echo "khong co CSDL";$data=0;
 	}else {$data=$query->last_row('array');}
     return $data; }
          public function Count_rows(){/*dem so dong*/
   $query=$this->db->query('SELECT question_id FROM cauhoi ');
    if($query->num_rows()==0){
       echo "khong co CSDL";$data=0;
 	}else {$data=$query->num_rows();}
     return $data; }
         
         public function Add_subject($data){/*chen du lieu*/
       $this->db->insert("subject", $data);
       $this->db->query( 'ALTER TABLE cauhoi AUTO_INCREMENT = 1');
      }   
   public function Add_question($data){/*chen du lieu*/
       $this->db->insert("cauhoi", $data);
       $this->db->query( 'ALTER TABLE cauhoi AUTO_INCREMENT = 1');
      }
      public function show_index(){//view pages
      $query=$this->db->query("SELECT subject_id, subject_name FROM subject  LIMIT 0,10");
      if($query->num_rows()>0){
        $data=$query->result_array();
     }else {$data=""; }
       return $data; }        
    public function show_answer(){//view pages
      $url=base_url();
      $query=$this->db->query("SELECT *
FROM cauhoi INNER JOIN answers ON cauhoi.question_id=answers.question_id  ");
      if($query->num_rows()>0){
        $data=$query->result_array();
     }else {$data=0; }
       return $data;}
   public function show_question($id){//view pages
      $query=$this->db->query("SELECT question_id, question_content, subject_id FROM cauhoi WHERE subject_id=$id ");
      if($query->num_rows()>0){
        $data=$query->result_array();
     }else {$data=0; }
       return $data;}
       public function show_question_id(){//view pages
      $query=$this->db->query("SELECT question_id FROM cauhoi");
      if($query->num_rows()>0){
        $data=$query->result_array();
     }else {$data=0; }
       return $data;}
   public function show_question_json($id){
      $query=$this->db->query("SELECT  question_id, question_content FROM cauhoi WHERE subject_id=$id ");
 if($query->num_rows()>0){
        $data=$query->result_array();
     }else {$data=0; }
       return $data;}
       public function count_json($id){
      $query=$this->db->query("SELECT question_id FROM cauhoi WHERE subject_id=$id ");
 if($query->num_rows()>0){
        $data['so_hang']=$query->num_rows();
        $data['hang_dau']=$query->first_row();
        $data['hang_cuoi']=$query->last_row();
     }else {$data=0; }
       return $data;}
         public function answer_json($id){
      $query=$this->db->query("SELECT a.question_id, a.answers_id, a.answer_content, a.answer_true, c.subject_id FROM answers as a, cauhoi as c WHERE 
      a.question_id=c.question_id AND c.subject_id=$id");
 if($query->num_rows()>0){
     $data=$query->result_array();
     }else {$data=0; }
       return $data;}
 }
?>
