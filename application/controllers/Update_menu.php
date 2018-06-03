<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Update_menu extends CI_Controller {


      public function __construct(){
          parent::__construct();
          $this->load->model("Edit_menu_model");
          $this->load->helper('url');
         }
    	public function  chinhsua()
	{
      $id=$this->uri->rsegment(3);
	  $data['Config']=$this->Edit_menu_model->View_menu($id);
      $data['vitri']=$this->Edit_menu_model->count_rows();
      $this->load->view('admin/Update_menu_view',$data);    
      if ($this->input->post("submit_menu")) {
      $data1["ten_menu"] = $this->input->post("name_menu");
      $data1["vitri_menu"] = $this->input->post("point_menu");
      $this->Edit_menu_model->Update_menu($data1,$id);
       echo"sửa dữ liệu thành công!";
       $url=base_url();
      echo "<meta http-equiv='refresh' content='1;url=$url/see_menu' />";}}}      
?>