<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Check_mark extends CI_Controller
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
        $this->load->model('Excel_model');
    }

    /**
     *
     */
    public function Index()
    {
        $data['class'] = $this->Excel_model->Show_class();
        $this->load->view('tradiem_view', $data);
    }

    public function check($id)
    {
        if (isset($_GET['term'])) {
            $data = $_GET['term'];//lay gia tri tu bien term(cai minh danh vao)
            //lay gia tri
            $data2 = $this->Excel_model->json_model_check($data, $id);
            echo json_encode($data2);
        }
    }
}