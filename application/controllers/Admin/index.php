<?php
/**
 * Created by PhpStorm.
 * User: THAISON
 * Date: 10/02/2018
 * Time: 12:24 SA
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class Index extends CI_Controller
{
private $user_level;
    public function __construct()
    {
        parent::__construct ();
        $this->load->library ('encryption');
        $this->load->library ('session');
        $this->load->model ('Login_model');
        $this->load->helper ('url');
        $this->check_login ();
        $this->setUserlevel ($this->session->userdata('user_level'));

    }
public function setUserlevel($userlevel)
{
    $this->user_level=$userlevel;
}
public function getUserlevel()
{
    return $this->user_level;
}
public function check_login(){
    if(!($this->session->userdata("user_admin"))){redirect (base_url ("admin/login"));}
}
    function index()
    {
        $data['base_url']=base_url ();
        $data['user']=$this->session->userdata("user_admin");
        $data['user_admin_name']=$this->session->userdata("user_admin");
        $data['all_post']=$this->Login_model->All_post_model();
$this->load->view("admin/index_view",$data);
    }
    public  function  Post_user(){
        $this->load->library('form_validation');
        $this->form_validation->set_rules(
            'Post_content', 'Post_content',
            'trim|required|min_length[10]|max_length[320]',
            array(
                'required'      => 'Không được để trống',
                'min_length'=>'Số kí tự không được nhỏ hơn 10',
                'max_length'=> 'Số kí tự không được lớn hơn 320'
            )
        );
        if ($this->form_validation->run() == TRUE)
        {
            if(!empty($this->input->post("Post_content"))){
                $data=array("user_id"=>$this->session->userdata("user_ad_id"), "Post_content"=> "{$this->input->post('Post_content')}",
                    "Post_info"=>$this->session->userdata("user_admin"));
                $this->Login_model->Post_user_model($data);
                echo "Post success!";
            }
        }
        else {echo validation_errors();}
    }
    public  function  Last_post(){
        if(!empty($this->input->post("Post_success"))){
        echo json_encode($this->Login_model->Last_post_model($this->session->userdata("user_ad_id")));
        }
    }
    public function check_get_filter($sex,$year,$location,$dan_toc){
        if($sex=="all"){$sex="doan_vien_sex";}
        if($sex=="y"){$sex=" ";}
        if($year=="all"){$year=NULL;}
        if($location=="all"){$location="doan_vien_location";}
        if($dan_toc=="all"){$dan_toc="doan_vien_dantoc";}
        return $result=array("sex"=>$sex,"year"=>$year,"location"=>$location,"dan_toc"=>$dan_toc);

    }
    public  function  thong_ke(){
        $id=$this->uri->segment(4,1);
        $data['base_url']=base_url ();
        $data['user_level']=$this->getUserlevel ();
        $data['user']=$this->session->userdata("user_admin");
        $data['filter']=$this->Login_model->Filter_model($data['user_level'],$this->session->userdata("user_doan_co_so_id"),$this->get_Time (date ('Y')));
        $data['pagination']=$this->pagination ($id,$this->Login_model->Total_dv_model($data['user_level'],$this->session->userdata("user_doan_co_so_id"),$this->get_Time (date ('Y'))),10);
        $data['doan_vien_info']=$this->Login_model->Danh_sach_he_model($this->session->userdata("user_admin_id"),date ('Y'));
        $data['thong_ke_doan_vien']=$this->Login_model->Thong_ke_model($this->session->userdata("user_admin_id"),date ('Y'));
        if($this->input->get("filter_submit") AND $this->input->get('gender') AND $this->input->get("year") AND $this->input->get("adress") AND $this->input->get("dan_toc")){
            print_r($this->check_get_filter ($this->input->get('gender'), $this->input->get("year"), $this->input->get("adress"),$this->input->get("dan_toc")));
        }
        $this->load->view("admin/thongke_view",$data);
}
    public  function  thong_ke_doan_vien(){
        $id=$this->uri->segment(4,1);
        $data['base_url']=base_url ();
        $data['user_level']=$this->getUserlevel ();
        $data['user']=$this->session->userdata("user_admin");
        $data['filter']=$this->Login_model->Filter_model($data['user_level'],$this->session->userdata("user_doan_co_so_id"),$this->get_Time (date ('Y')));
        $data['thong_ke_doan_vien']=$this->Login_model->Thong_ke_dv_model($this->session->userdata("user_doan_co_so_id"),$this->get_Time (date ('Y')));
        $data['pagination']=$this->pagination ($id,$this->Login_model->Total_dv_model($data['user_level'],$this->session->userdata("user_doan_co_so_id"),$this->get_Time (date ('Y'))),10);
        $data['doan_vien_info']=$this->Login_model->Danh_sach_dv_model($this->session->userdata("user_doan_co_so_id"),$this->get_Time (date ('Y')),$data['pagination']['first_row_ipage'],$data['pagination']['rows_in_page']);
        if($this->input->get("filter_submit") AND $this->input->get('gender') AND $this->input->get("year") AND $this->input->get("adress") AND $this->input->get("dan_toc")){
           $filter=$this->check_get_filter ($this->input->get('gender'), $this->input->get("year"), $this->input->get("adress"),$this->input->get("dan_toc"));
            $data['get_values']=array('gender'=>$this->input->get('gender'),
                'year'=>$this->input->get("year"), 'location'=>$this->input->get("adress"), 'dan_toc'=>$this->input->get("dan_toc"));
           print_r ($data['get_values']);
           $data['thong_ke_doan_vien']=array();
           $data['pagination']=$this->pagination ($this->input->get("filter_submit"),$this->Login_model->Result_filter_model($data['user_level'],$this->session->userdata("user_doan_co_so_id"),$filter['sex'],$this->get_Time (date ('Y')),$filter['year'],$filter['location'],$filter['dan_toc']),10);
          $data['doan_vien_info']=$this->Login_model->Result_filter_model($data['user_level'],$this->session->userdata("user_doan_co_so_id"),$filter['sex'],$this->get_Time (date ('Y')),$filter['year'],$filter['location'],$filter['dan_toc'],$data['pagination']['first_row_ipage'],$data['pagination']['rows_in_page']);

          // print_r ($data['doan_vien_info']);
        }
        $this->load->view("admin/thongke_view",$data);
    }
    public  function  bieu_do(){
        $data['base_url']=base_url ();
        $data['user']=$this->session->userdata("user_admin");
        $data['doan_vien_info']=$this->Login_model->Danh_sach_model($this->session->userdata("user_admin_id"));
        $data['thong_ke_doan_vien']=$this->Login_model->Thong_ke_model($this->session->userdata("user_admin_id"));
        $this->load->view("admin/Bieu_do_view",$data);
    }
    public  function  chuyen_sinh_hoat(){
        $data['base_url']=base_url ();
        $data['chuyen_den']=$this->Login_model->Move_in_model();
        $data['chuyen_di']=$this->Login_model->Move_out_model();
        $data['user']=$this->session->userdata("user_admin");

        $this->load->view("admin/chuyen_sinh_hoat_view",$data);
    }
    public  function  ket_nap(){
        $id=$this->uri->segment(4,1);
        $data['base_url']=base_url ();
        $data['user_level']=$this->getUserlevel ();
        $data['filter']=$this->Login_model->Filter_model($data['user_level'],$this->session->userdata("user_doan_co_so_id"),$this->get_Time (date ('Y')));
        $data['doan_vien_info']=$this->Login_model->Danh_sach_TN_model($this->session->userdata("user_admin_id"),date ('Y'));
        $data['user']=$this->session->userdata("user_admin");
        if($this->input->get("filter_submit") AND $this->input->get('gender') AND $this->input->get("year") AND $this->input->get("adress") AND $this->input->get("dan_toc")){
       $result=$this->get_info_filter ($data['user_level']);
            $data['pagination']=$result['pagination'];
       $data['get_values']=$result ['get_values'];
       $data['doan_vien_info']=$result['doan_vien_info'];
            $data['move_data']=array();
        foreach ($data['doan_vien_info'] as $dv_id){
array_push ($data['move_data'],$dv_id['doan_vien_id']);
        }
        print_r ($data['move_data']);
        }
        $this->load->view("admin/Set_Time_ket_nap_view",$data);
    }
public function move_in(){

}

    private function get_info_filter($user_level){
        $data['user_level']=$user_level;
            $filter=$this->check_get_filter ($this->input->get('gender'), $this->input->get("year"), $this->input->get("adress"),$this->input->get("dan_toc"));
            $data['get_values']=array('gender'=>$this->input->get('gender'),
                'year'=>$this->input->get("year"), 'location'=>$this->input->get("adress"), 'dan_toc'=>$this->input->get("dan_toc"));
            print_r ($data['get_values']);
            $data['pagination']=$this->pagination ($this->input->get("filter_submit"),$this->Login_model->Result_filter_model($data['user_level'],$this->session->userdata("user_doan_co_so_id"),$filter['sex'],$this->get_Time (date ('Y')),$filter['year'],$filter['location'],$filter['dan_toc']),10);
            $data['doan_vien_info']=$this->Login_model->Result_filter_model($data['user_level'],$this->session->userdata("user_doan_co_so_id"),$filter['sex'],$this->get_Time (date ('Y')),$filter['year'],$filter['location'],$filter['dan_toc'],$data['pagination']['first_row_ipage'],$data['pagination']['rows_in_page']);

            // print_r ($data['doan_vien_info']);

        return $data;
}
    public  function  chuyen_di(){
        $data['base_url']=base_url ();
        $data['doan_vien_info']=$this->Login_model->Danh_sach_dv_model($this->session->userdata("user_admin_id"),date ('Y'));
        $data['user']=$this->session->userdata("user_admin");
        $this->load->view("admin/chuyen_di_view",$data);
    }
    public  function  ren_luyen(){
        $data['base_url']=base_url ();
        $data['doan_vien_info']=$this->Login_model->Danh_sach_dv_model($this->session->userdata("user_admin_id"),date ('Y'));
        $data['user']=$this->session->userdata("user_admin");
        $this->load->view("admin/ren_luyen_view",$data);
    }
    public  function  sinh_hoat_he(){
        if(date('m')<6){echo "Chưa tới thời gian kì nghỉ hè!";}
        else if(date ('m')>=6){
            print_r ($this->Login_model->Danh_sach_he_model($this->session->userdata("user_admin_id"),date ('Y')));
             $thu_nghiem=json_encode( $this->Login_model->Danh_sach_he_model($this->session->userdata("user_admin_id"),date ('Y')),JSON_UNESCAPED_UNICODE);
            echo $thu_nghiem; print_r ( json_decode ($thu_nghiem,true));
        }
    }
    public  function  ke_hoach(){
        $data['base_url']=base_url ();
        $data['user']=$this->session->userdata("user_admin");
       $this->load->view('admin/Ke_hoach_view',$data);
        }
    public  function  edit_user(){
    $data['base_url']=base_url ();
    $data['user']=$this->session->userdata("user_admin");
    $data['doan_vien_info']=$this->Login_model->Edit_user_model($this->input->get('user'));
    $this->load->view("admin/Edit_user_view",$data);
    if($this->input->post('ok')){$string_birthday = preg_replace('/\s+/', '', $this->input->post("birthday"));
       $data_updates=array('doan_vien_name'=>$this->input->post("name"),'doan_vien_dantoc'=>$this->input->post("dan_toc"),'doan_vien_birthday'=>$string_birthday,
           'doan_vien_sex'=>$this->input->post("sex"),'doan_vien_active'=>$this->input->post("active"),'doan_vien_location'=>$this->input->post("location"));
       print_r ($data_updates);
       $this->Login_model->Update_user_model($this->input->get('user'),$data_updates);
    }
}
    public  function  save_active(){
        if($this->input->post("post")){
            $this->Login_model->Save_active_model( $this->input->post("data"));
            $this->thong_ke_doan_vien ();
        }
    }//luu xem la doan vien chua
    public  function  save_move(){
        $move=array();
        if($this->input->post("save")){
            $data['move_data']=json_encode ($this->input->post("data"),JSON_UNESCAPED_UNICODE);
            $mv['move_data2']=$this->input->post("data");
            $data['move_time']=$this->input->post("time");
            $data['move_from']=$this->input->post("move_out");
            $data['move_to']=$this->input->post("move_in");
            $data['move_number_dv']=$this->input->post("move_number_dv");
            $move_id=$this->Login_model->Save_move_model($data,1);
            echo $move_id;
           foreach ($mv['move_data2'] as $move_data){
               array_push ($move,array('move_id'=>$move_id,'doan_vien_id'=>$move_data['doan_vien_id']));
            }
            print_r($move);
           ($this->Login_model->Save_move_model($move,2));
        }
    }//luu di chuyen
    public function update_user(){
        echo "xin chào";
    }
    private function pagination($current_page,$total_rows,$rows_in_page){
        $result_mod=($total_rows/$rows_in_page);
        $total_pages=ceil ($result_mod);
        if($current_page>$total_pages){return false;}
        else
        $first_row_ipage=$rows_in_page*($current_page-1);
        $max_row_ipage=($rows_in_page*$current_page)-1;
        if ($max_row_ipage<$total_rows){
            $last_row_ipage=$max_row_ipage;
        }else $last_row_ipage=$total_rows-1;
return array("rows_in_page"=>$rows_in_page,"current_page"=>$current_page, "total_rows"=>$total_rows,"first_row_ipage"=>$first_row_ipage,"last_row_ipage"=>$last_row_ipage,"total_pages"=>$total_pages);

}
   private function  get_Time($year,$select=null)
   {
       $result['max_year']=$year-35;
       $result['min_year']=$year-15;
    if($select=="total_yooth"){
        $result['max_year']=$year-30;
        $result['min_year']=$year-16;
    }
     return $result;
  }
}

?>