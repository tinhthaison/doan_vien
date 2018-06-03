<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Add_word extends CI_Controller {


    public function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->model("Add_model");
        $this->load->library('session');
    }
    public function  index()
    { $check_sesion=$this->session->userdata('user');
    if(!$check_sesion){redirect('admin/login');}
        $url["url"]=base_url();
        $this->load->view('admin/Add_word_view',$url);
        if($this->input->post('ok')){
            $data["vietnamese"]=$this->input->post("vietnamese");
            $data["Caolan"]=$this->input->post("caolan");
            $data["Vidu"]=$this->input->post("vi_du");
            $data["Loai_tu"]=$this->input->post("loai_tu");
            $this->Add_model->Add_word($data);
            echo"insertdata succssess";
            echo "<meta http-equiv='refresh' content='1;url={$url['url']}/add_word' />";
        }
    }}

    ?>