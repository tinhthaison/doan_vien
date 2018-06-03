<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Edit_answer_model extends CI_Model {


      public function __construct(){
          parent::__construct();
         $this->load->helper('url');
         $this->load->database();} //truy cap csdl 
         
    public function Add_answer($data){//add answer 
      $this->db->insert("answers",$data);
}
   public function Set_menu(){//set menu to page
      $query=$this->db->query("SELECT menu_id,ten_menu FROM menu");
      if($query->num_rows()>0){
        $data=$query->result_array();
      }else {echo "empty";} return $data;
}
public function RView_page($id){//review pages
      $url=base_url();
      $query=$this->db->query("SELECT page.page_name,page.menu_id,page.time_add_page,page.page_id,menu.menu_id FROM page, menu  
      WHERE page.menu_id=menu.menu_id AND page.menu_id=$id");
      if($query->num_rows()>0){
        $data=$query->result_array();
     }else {redirect('','refresh'); }
       return $data;
}
public function Title_RView_page($id){//review pages
      $query=$this->db->query("SELECT menu.menu_id,menu.ten_menu,page.menu_id FROM menu,page WHERE menu.menu_id=page.menu_id AND menu.menu_id=$id");
     if($query->num_rows()>0){
        $data=$query->row_array();
     }
       return $data;
}
public function View_page($id){//for view pages and update page
      $query=$this->db->query("SELECT * FROM page,menu WHERE page.page_id=$id AND menu.menu_id=page.menu_id");
      if($query->num_rows()>0){
        $data=$query->row_array();
      }else {echo "ko bai viet nao";} return $data;
}
public function Show_page(){//show pages
    $query=$this->db->query('SELECT * FROM page');
    if($query->num_rows()>0){
        $data=$query->row_array();
    } return $data;
}
public function Update_page($id,$data){//update pages
   $this->db->Where('page_id',$id);
    $this->db->UPDATE('page',$data);
}
public function Delete_page($id){//update pages
   $this->db->Where('page_id',$id);
    $this->db->DELETE('page');
}
}
?>
