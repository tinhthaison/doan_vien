<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Edit_page extends CI_Controller {


      public function __construct(){
          parent::__construct();
         $this->load->helper('url');
         $this->load->database();
         $this->load->model("Edit_page_model");//truy cap csdl 
         $this->load->helper('date');}    
     
      public function Add_page(){
$menu['name_menu']=$this->Edit_page_model->Set_menu();        
$this->load->View('admin/Add_page_view',$menu);
$datestring = "%h:%i %a- %d/%m/%Y";
$time = time();
if($this->input->post('ok')){
$data["page_name"]=$this->input->post("page_name")  ;
$data["menu_id"]=$this->input->post("menu")  ;  
$data["content"]=$this->input->post("content_page")  ; 
$data["time_add_page"]= mdate($datestring, $time);;
$this->Edit_page_model->Add_page($data);
echo "insert data succsses!";
}}
public function Show_page(){
    $data['info']=$this->Edit_page_model->Show_page();
    $data['link']=base_url();
    $this->load->view('admin/Show_page_view',$data);
}
public function Update_page(){
    $id=$this->uri->rsegment(3);
    $data['info']=$this->Edit_page_model->View_page($id);
    $data['name_menu']=$this->Edit_page_model->Set_menu(); 
    $this->load->view('admin/update_page_view',$data);
    $datestring = "%h:%i %a- %d/%m/%Y edited";
    $time = time(); 
    if($this->input->post('ok')){
$data1["page_name"]=$this->input->post("page_name")  ;
$data1["menu_id"]=$this->input->post("menu")  ;  
$data1["content"]=$this->input->post("content_page")  ;
$data1["time_add_page"]= mdate($datestring, $time);
$this->Edit_page_model->Update_page($id,$data1);
echo "updated success!";
$url=base_url();
echo "<meta http-equiv='refresh' content='1;url=$url/edit_page/show_page' />";
    }}
    public function Delete_page(){
        $id=$this->uri->rsegment(3);
        $this->load->view('admin/delete_page_view');
        if($this->input->post('submit_delete')){
        $this->Edit_page_model->Delete_page($id);
        $url=base_url();
        echo "delete page success!";
echo "<meta http-equiv='refresh' content='1;url=$url/edit_page/show_page' />";
        }
    }
}
?>
