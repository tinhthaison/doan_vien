<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Delete_menu extends CI_Controller {


      public function __construct(){
          parent::__construct();
          $this->load->model("Edit_menu_model");
          $this->load->helper('url');
         }
    	public function  delete()
	{
$this->load->view('Delete_menu_view');	
$id=$this->uri->rsegment(3);
    if($this->input->post("submit_delete")){
    $this->Edit_menu_model->Delete_menu($id);
    echo "delete menu success!";
    $url=base_url();
    echo "<meta http-equiv='refresh' content='1;url=$url/see_menu' />";
    $this->Edit_menu_model->Sort_menu();
}   
 }}