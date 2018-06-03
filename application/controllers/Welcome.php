<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *        http://example.com/index.php/welcome
     *    - or -
     *        http://example.com/index.php/welcome/index
     *    - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('Add_model');
    }

    /**
     *
     */
    public function Index()
    {

        $this->load->view('index_view');

    }

    public function dich()
    {
        if ($this->input->get('ok')) {
            $data = $this->input->get("search");
            if(empty($data)){$data2['tu_da_nhap']="hãy nhập từ cần tra";$this->load->view('index_view',$data2);}else{
                if($this->input->get('lua_chon')=='0'){
            $data2['tu'] = $this->Add_model->Search_caolan($data);}
            else{$data2['tu'] = $this->Add_model->Search_viet($data);}
            $data2['tu_da_nhap']=$data;
            $data2['lua_chon']=$this->input->get('lua_chon');
            $this->load->view('index_view', $data2); }

        }
    }
    public function json_vi()
    {
        if (isset($_GET['term'])) {
            $data = $_GET['term'];//lay gia tri tu bien term(cai minh danh vao)
            $data2=$this->Add_model->json_model_vi($data);//lay gia tri
            echo json_encode($data2);
            }
        }
    public function json_ca()
    {
        if (isset($_GET['term'])) {$data = $_GET['term'];//lay gia tri tu bien term(cai minh danh vao)
           //lay gia tri
            $data2=$this->Add_model->json_model_ca($data);
            echo json_encode($data2);}
    }
    public function thong_tin()
    {
        $this->load->view('thong_tin_view');

        }
    public function lien_he()
    {
        $this->load->view('lien_he_view');

    }

    }


?>