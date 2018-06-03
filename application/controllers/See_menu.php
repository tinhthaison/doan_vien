<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class See_menu extends CI_Controller {

      public function __construct(){
          parent::__construct();
          $this->load->model("Edit_menu_model");
         }
    	public function  index()
	{
	  $data['table']=$this->Edit_menu_model->Show_menu();
      
      $this->load->view('admin/See_menu_view',$data);
 }}?>
