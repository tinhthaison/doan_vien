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
        if (($this->session->userdata('user_admin'))==NULL){
            $this->load->view("admin/Login_view");
            if($this->input->post("ok")){
                $user=$this->input->post("user");
                $pass=md5($this->input->post("pass"));
                $result=$this->Login_model->Check_login($user,$pass);print_r($result);
                if (isset($result[0]['user_id'])){
                    $this->session->set_userdata("user_admin",$result[0]['user_name']);
                    $this->session->set_userdata("user_ad_id",$result[0]['user_id']);
                    $this->session->set_userdata("user_level",$result[0]['user_level']);
                    $this->session->set_userdata("user_doan_co_so_id",$result[0]['doan_co_so_id']);
                    $this->session->set_userdata("user_dia_ban_tinh_id",$result[0]['dia_ban_tinh_id']);
                    $this->session->set_userdata("user_dia_ban_huyen_id",$result[0]['dia_ban_tinh_id']);
                    redirect(base_url ()."admin/index");
                }
            }
        }else{
            redirect(base_url ()."admin/index");
        }
    }
    function admin_1(){
        if (($this->session->userdata('user_admin'))==NULL){
            $this->load->view("admin/Login_view");
            if($this->input->post("ok")){
                $user=$_POST["user"];
                $pass=md5($_POST["pass"]);
                $result=$this->Login_model->Check_login_admin_1($user,$pass);print_r($result);
                if (isset($result[0]['doan_co_so_name'])){
                    $this->session->set_userdata("user_admin",$result[0]['doan_co_so_name']);
                    $this->session->set_userdata("user_admin_name",'Bí thư đoàn '.$result[0]['doan_co_so_name']);
                    redirect(base_url ()."admin/index");
                }
            }
        }else{
            redirect(base_url ()."admin/index");
        }
    }
    function logout(){
        $this->session->sess_destroy();
        redirect(base_url ("/admin/login"));
    }
}


?>