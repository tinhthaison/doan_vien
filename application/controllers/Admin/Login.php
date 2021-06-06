<?php
/**
 * Created by PhpStorm.
 * User: THAISON
 * Date: 10/02/2018
 * Time: 12:24 SA
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends CI_Controller
{

    public function __construct(){
        parent::__construct();
        $this->load->library('encryption');
        $this->load->library('session');
        $this->load->model('Login_model');
        $this->load->helper('url');

    }

    function index(){
        if (($this->session->userdata('user'))==NULL){
            $this->load->view("admin/Login_view");
            if($this->input->post("ok")){
                $user=$_POST["user"];
                $pass=$_POST["pass"];
                if ($this->Login_model->Check_login($user,$pass)===TRUE){
                    $this->session->set_userdata(array("user"=>$user));
                    redirect("/add_word");
                }
            }
        }else{
            $this->load->view("admin/Add_word_view");
        }
    }
    function logout(){
        $this->session->sess_destroy();
        redirect("/admin/login");
    }
}


?>