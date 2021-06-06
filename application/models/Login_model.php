<?php
/**
 * Created by PhpStorm.
 * User: THAISON
 * Date: 15/02/2018
 * Time: 10:55 SA
 */
class Login_model extends CI_Model{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->database();
    }

public function Check_login($user,$pass){
$this->db->select("user_id,user_name,dia_ban_tinh_id, dia_ban_huyen_id, doan_co_so_id, chi_doan_id, user_level, user_password");
    $this->db->where("user_name",$user);
    $this->db->where("user_password",$pass);
    $query=$this->db->get("user");$result=array("Oops!");
    if($query->num_rows()==1){ $result=$query->result_array();}return $result;
}
    public function Check_login_admin_1($user,$pass){
        $this->db->select("doan_co_so_user,doan_co_so_name,doan_co_so_id");
        $this->db->where("doan_co_so_user",$user);
        $this->db->where("doan_co_so_password",$pass);
        $query=$this->db->get("doan_co_so");$result=array("dsađâsa");
        if($query->num_rows()==1){ $result=$query->result_array();}return $result;
    }
    public function Danh_sach_model($id){
        $query=$this->db->query("SELECT * FROM chi_doan_info as cd, doan_vien_info_2 as dv 
        WHERE cd.chi_doan_id_text=dv.chi_doan_id And cd.chi_doan_id_text='$id'");$result=array("");
        if($query->num_rows()>0){ $result=$query->result_array();}return $result;
    }
    public function Danh_sach_he_model($id,$year){
        if(empty($id)){$query=$this->db->query("SELECT * FROM doan_vien_info_2 
        WHERE doan_co_so_id='2' AND RIGHT(doan_vien_birthday,4)<=$year-16 AND RIGHT(doan_vien_birthday,4)>=$year-30 ");}
        else {$query=$this->db->query("SELECT *, (substring_index(doan_vien_name, ' ', -1)) as last_name, (substring_index(doan_vien_name, ' ', 1)) as first_name,
         (substring_index(doan_vien_name, ' ', -2)) as middle_name FROM doan_vien_info_2 
        WHERE chi_doan_id='$id'  AND doan_co_so_id='2' AND RIGHT(doan_vien_birthday,4)<=$year-15 AND RIGHT(doan_vien_birthday,4)>=$year-30 ORDER BY last_name COLLATE utf8_vietnamese2_ci, first_name COLLATE utf8_vietnamese2_ci, middle_name COLLATE utf8_vietnamese2_ci ");}
        $result=array("");
        if($query->num_rows()>0){ $result=$query->result_array();}return $result;
    }
    public function Danh_sach_TN_model($id,$year){
        if(empty($id)){$query=$this->db->query("SELECT * FROM doan_vien_info_2 
        WHERE doan_co_so_id='2' AND RIGHT(doan_vien_birthday,4)<=$year-15 AND RIGHT(doan_vien_birthday,4)>=$year-30 AND doan_vien_active='' ");}
        else{$query=$this->db->query("SELECT * FROM doan_vien_info_2 
        WHERE chi_doan_id='$id' AND doan_co_so_id='2' AND RIGHT(doan_vien_birthday,4)<=$year-15 AND RIGHT(doan_vien_birthday,4)>=$year-30 AND doan_vien_active='' ");}$result=array("");
        if($query->num_rows()>0){ $result=$query->result_array();}return $result;
    }
    public function Danh_sach_dv_model($id,$year=array(),$start,$end){
       $query=$this->db->query("SELECT * FROM doan_vien_info_2 
        WHERE  doan_co_so_id=$id AND RIGHT(doan_vien_birthday,4)<={$year['min_year']} AND RIGHT(doan_vien_birthday,4)>={$year['max_year']} AND doan_vien_active='checked' LIMIT $start, $end");
       /* else{$query=$this->db->query("SELECT * FROM doan_vien_info_2
        WHERE chi_doan_id='$id' AND doan_co_so_id='2' AND RIGHT(doan_vien_birthday,4)<=$year-15 AND RIGHT(doan_vien_birthday,4)>=$year-30 AND doan_vien_active='checked' LIMIT $start,$end");}$result=array("");*/
        if($query->num_rows()>0){ $result=$query->result_array();}
       return $result;
    }
    public function Total_dv_model($user_level,$id,$year=array()){
        switch ($user_level){
            case 0:
                $this->db->select("*");
                $this->db->from("doan_vien_info_2");
                $this->db->where('doan_co_so_id',$id);
                $this->db->where('RIGHT(doan_vien_birthday,4)<=',$year['min_year']);
                $this->db->where('RIGHT(doan_vien_birthday,4)>=', $year['max_year']);
                $this->db->where('doan_vien_active', "checked");
                $query=$this->db->get();
                if($query->num_rows()>0){ $result=$query->num_rows();}return $result;
                break;
        }

    }
    public function Thong_ke_model($id, $year){
        if(empty($id)){$query=$this->db->query("SELECT (SELECT count(CASE WHEN `doan_vien_sex`='x'then 1 end) FROM `doan_vien_info_2` WHERE  doan_co_so_id='2' AND RIGHT(doan_vien_birthday,4)<=$year-15 AND RIGHT(doan_vien_birthday,4)>=$year-30 ) as 'gioi_tinh', 
        (SELECT count(`doan_vien_id`) FROM `doan_vien_info_2` WHERE  doan_co_so_id='2' AND RIGHT(doan_vien_birthday,4)<=$year-16 AND RIGHT(doan_vien_birthday,4)>=$year-30 ) as 'tong_so', 
        (SELECT MAX(RIGHT(`doan_vien_birthday`,4)) FROM `doan_vien_info_2` WHERE  doan_co_so_id='2' AND RIGHT(doan_vien_birthday,4)<=$year-16 AND RIGHT(doan_vien_birthday,4)>=$year-30 ) as 'max_day', 
        (SELECT MIN(RIGHT(`doan_vien_birthday`,4)) FROM `doan_vien_info_2` WHERE  doan_co_so_id='2' AND RIGHT(doan_vien_birthday,4)<=$year-16 AND RIGHT(doan_vien_birthday,4)>=$year-30 ) as 'min_day', 
        (SELECT count(CASE WHEN `doan_vien_dantoc` NOT LIKE 'Kinh' then 1 end) FROM `doan_vien_info_2` WHERE doan_co_so_id='2' AND RIGHT(doan_vien_birthday,4)<=$year-16 AND RIGHT(doan_vien_birthday,4)>=$year-30) as 'dan_toc'");}
        else{$query=$this->db->query("SELECT (SELECT count(CASE WHEN `doan_vien_sex`='x'then 1 end) FROM `doan_vien_info_2` WHERE `chi_doan_id`='$id' AND doan_co_so_id='2' AND RIGHT(doan_vien_birthday,4)<=$year-15 AND RIGHT(doan_vien_birthday,4)>=$year-30 ) as 'gioi_tinh', 
        (SELECT count(`doan_vien_id`) FROM `doan_vien_info_2` WHERE `chi_doan_id`='$id' AND doan_co_so_id='2' AND RIGHT(doan_vien_birthday,4)<=$year-15 AND RIGHT(doan_vien_birthday,4)>=$year-30 ) as 'tong_so', 
        (SELECT MAX(RIGHT(`doan_vien_birthday`,4)) FROM `doan_vien_info_2` WHERE `chi_doan_id`='$id' AND doan_co_so_id='2' AND RIGHT(doan_vien_birthday,4)<=$year-15 AND RIGHT(doan_vien_birthday,4)>=$year-30 ) as 'max_day', 
        (SELECT MIN(RIGHT(`doan_vien_birthday`,4)) FROM `doan_vien_info_2` WHERE `chi_doan_id`='$id' AND doan_co_so_id='2' AND RIGHT(doan_vien_birthday,4)<=$year-15 AND RIGHT(doan_vien_birthday,4)>=$year-30 ) as 'min_day', 
        (SELECT count(CASE WHEN `doan_vien_dantoc` NOT LIKE 'Kinh' then 1 end) FROM `doan_vien_info_2` WHERE `chi_doan_id`='$id' AND doan_co_so_id='2' AND RIGHT(doan_vien_birthday,4)<=$year-15 AND RIGHT(doan_vien_birthday,4)>=$year-30) as 'dan_toc'");}
        if($query->num_rows()>0){ $result=$query->result_array();}return $result;
    }
    public function Thong_ke_dv_model($id, $year=array()){
      {$query=$this->db->query("SELECT (SELECT count(CASE WHEN `doan_vien_sex`='x'then 1 end) FROM `doan_vien_info_2` WHERE  doan_co_so_id='$id' AND RIGHT(doan_vien_birthday,4)<={$year['min_year']} AND RIGHT(doan_vien_birthday,4)>={$year['max_year']} AND doan_vien_active='checked' ) as 'gioi_tinh', 
        (SELECT count(`doan_vien_id`) FROM `doan_vien_info_2` WHERE  doan_co_so_id='$id' AND RIGHT(doan_vien_birthday,4)<={$year['min_year']} AND RIGHT(doan_vien_birthday,4)>={$year['max_year']} AND doan_vien_active='checked' ) as 'tong_so', 
        (SELECT MAX(RIGHT(`doan_vien_birthday`,4)) FROM `doan_vien_info_2` WHERE doan_co_so_id='$id' AND RIGHT(doan_vien_birthday,4)<={$year['min_year']} AND RIGHT(doan_vien_birthday,4)>={$year['max_year']} AND doan_vien_active='checked' ) as 'max_day', 
        (SELECT MIN(RIGHT(`doan_vien_birthday`,4)) FROM `doan_vien_info_2` WHERE  doan_co_so_id='$id' AND RIGHT(doan_vien_birthday,4)<={$year['min_year']} AND RIGHT(doan_vien_birthday,4)>={$year['max_year']} AND doan_vien_active='checked') as 'min_day', 
        (SELECT count(CASE WHEN `doan_vien_dantoc` NOT LIKE 'Kinh' then 1 end) FROM `doan_vien_info_2` WHERE  doan_co_so_id='$id' AND doan_vien_active='checked' AND RIGHT(doan_vien_birthday,4)<={$year['min_year']} AND RIGHT(doan_vien_birthday,4)>={$year['max_year']}) as 'dan_toc'");}
        if($query->num_rows()>0){ $result=$query->result_array();}return $result;
    }
    public function Post_user_model($data){

        $this->db->insert('posts',$data);

    }
    public function Filter_model($user_level,$id,$year){
       switch ($user_level){
           case 0:

               $query_1= $this->db->query("SELECT DISTINCT doan_vien_location FROM doan_vien_info_2 WHERE doan_co_so_id='$id'");
               if($query_1->num_rows()>0){ $result['location']=$query_1->result_array();}
               $query_2=$this->db->query("SELECT DISTINCT doan_vien_dantoc FROM doan_vien_info_2 WHERE doan_co_so_id='$id'");
               if($query_2->num_rows()>0){ $result['dan_toc']=$query_2->result_array();}
               $query_3=$this->db->query("SELECT DISTINCT RIGHT(doan_vien_birthday,4) as birthday FROM doan_vien_info_2 WHERE doan_co_so_id='$id' AND doan_vien_active='checked' Order by birthday DESC");
               if($query_3->num_rows()>0){ $result['birth_day']=$query_3->result_array();}


               return $result;
       }

    }
    public function Result_filter_model($user_level,$id,$sex,$year,$year_chosse,$location,$dan_toc,$start=null,$end=null){
        if($year_chosse==NULL)
        {$query_values['year']="RIGHT(doan_vien_birthday,4)<='".$this->db->escape_like_str ($year['min_year'])."' AND RIGHT(doan_vien_birthday,4)>='"
            .$this->db->escape_like_str ($year['max_year'])."'";}
        else {$query_values['year']="RIGHT(doan_vien_birthday,4)='".$this->db->escape_like_str($year_chosse)."'";}
        if(isset($start)){
            $query_values['limit']="LIMIT ".$this->db->escape_like_str ($start).", ".$this->db->escape_like_str ($end)."";
        } else $query_values['limit']=" ";
        if($sex=='doan_vien_sex'){
            $query_values['sex']="doan_vien_sex=".($sex)."";
        }else{ $query_values['sex']="doan_vien_sex='".($sex)."'";}
        if($location=='doan_vien_location'){
            $query_values['location']="doan_vien_location=".($location)."";
        }else{ $query_values['location']="doan_vien_location='".($location)."'";}
        if($dan_toc=='doan_vien_dantoc'){
            $query_values['dan_toc']="doan_vien_dantoc=".($dan_toc)."";
        }else{ $query_values['dan_toc']="doan_vien_dantoc='".($dan_toc)."'";;}
        switch ($user_level){
            case 0:
                $query=$this->db->query("SELECT * FROM doan_vien_info_2 
        WHERE  doan_co_so_id=$id AND ".$query_values['sex']." AND ".$query_values['location']." AND ".$query_values['dan_toc']." AND ". $query_values['year']." AND doan_vien_active='checked' ". $query_values['limit']."");
                if($query->num_rows()>0) {
                    if (isset($start)) {
                        $result = $query->result_array ();
                    } else {
                        $result = $query->num_rows ();

                    }
                }else{$result=false;}
                return $result;
                break;
        }

    }
    public function Last_post_model($id){
        $this->db->select("*");
        $this->db->from("posts");
        $this->db->where('posts.user_id',$id);
        $this->db->join('user', 'user.user_id = posts.user_id','left');
        $query=$this->db->get();
        if($query->num_rows()>0){ $result=$query->last_row();}return $result;
    }
    public function All_post_model(){
        $this->db->select("*");
        $this->db->from("posts");
        $this->db->join('user', 'user.user_id = posts.user_id','left');
        $this->db->Order_by("Post_time","DESC");
        $query=$this->db->get();
        if($query->num_rows()>0){ $result=$query->result_array();}
        else {$result= false;}
        return $result;
    }

    public function Save_active_model($data){
       $this->db->update_batch('doan_vien_info_2',$data,'doan_vien_id');
    }
    public function Save_move_model($data,$mode){
        switch ($mode){
            case 1:
                $query=$this->db->insert('move',$data);
                if($this->db->affected_rows()>0){
                    return $this->db->insert_id();
                }break;
            case 2:
                $query=$this->db->insert_batch('list_move',$data);
                if($this->db->affected_rows()>0){
                    return  "insert thanh cong!";
                }break;
        }

    }
    public function Save_move_list(){

    }
    public function Move_in_model(){
        $this->db->select("*");
        $this->db->from("move");
        $this->db->where("move_to",'2');
        $this->db->Order_by("move_time","DESC");
        $query=$this->db->get();
        if($query->num_rows()>0){ $result=$query->result_array();}return $result;
    }
    public function Move_out_model(){
        $this->db->select("*");
        $this->db->from("move");
        $this->db->where("move_from",'2');
        $this->db->Order_by("move_time","DESC");
        $query=$this->db->get();
        if($query->num_rows()>0){ $result=$query->result_array();}return $result;
    }
    public function Edit_user_model($user_id){
        $this->db->select("*");
        $this->db->from("doan_vien_info_2");
        $this->db->where("doan_vien_id",$user_id);
        $query=$this->db->get();
        if($query->num_rows()>0){ $result=$query->row_array();}return $result;
    }
    public function Update_user_model($user_id,$data)
    {
        $this->db->where('doan_vien_id',$user_id);
        $this->db->Update('doan_vien_info_2',$data);
    }
}