<?php
/**
 * Created by PhpStorm.
 * User: THAISON
 * Date: 24/03/2018
 * Time: 11:51 CH
 */
class Excel_model extends CI_Model{

    public function __construct()
    { parent::__construct();
        $this->load->helper('url');
        $this->load->database();}
public function Get_data_cu_tri(){
    $this->db->select("*");
    $this->db->from("danh_sach_bo_phieu");
    $query=$this->db->get();
    if($query->num_rows()>0){ $result=$query->result_array();}return $result;
}
    public function Add_data_danh_sach($data,$table_name){// them danh sach doan vien
        $query=$this->db->get($table_name);
        if($query->num_rows()>0){$this->db->update_batch($table_name,$data,$table_name);}else
$this->db->Insert_batch($table_name,$data);
    }
    public function Show_class(){//lay ten lop
        $query=$this->db->query("SELECT class_id, class_name FROM class");
        if($query->num_rows()>0){$data=$query->result_array();}return $data;
    }
    public function Add_data_bang_diem($data){//them bang diem

            $this->db->Insert_batch('bang_diem',$data);
    }

    public function Thon_name($data){ //them thon
        $query=$this->db->query("SELECT thon_id FROM thon");
        if($query->num_rows()>0){$this->db->update_batch('thon',$data,'thon_id');}else{
       $this->db->Insert_batch('thon',$data);}
    }
    public function Delete_bang_diem($id){// xoa bang diem
    $this->db->delete('bang_diem',array('class_id'=>$id));
}
public function Get_monhoc($name,$class){// lay lop
        $query=$this->db->query("SELECT monhoc_id FROM bang_diem WHERE maso_hocsinh=(SELECT maso_hocsinh FROM danh_sach WHERE name LIKE '%$name' AND class_id='$class' LIMIT 0, 1) ");
        if($query->num_rows()>0){$data=$query->num_rows();}else{$data=FALSE;}return $data;
}
public function Show_diem_model($name,$class){//show bang diem

    $query=$this->db->query("SELECT bang_diem.monhoc_id, bang_diem.maso_hocsinh, bang_diem.diem_mieng, mon_hoc.ten_monhoc,
    bang_diem.diem_15, bang_diem.diem_1_tiet, bang_diem.diem_thi, bang_diem.diem_phay,bang_diem.tbm_canam, danh_sach.Name FROM bang_diem, danh_sach, 
    mon_hoc WHERE  bang_diem.maso_hocsinh =(SELECT maso_hocsinh FROM danh_sach  WHERE name LIKE '%$name' AND class_id='$class' LIMIT 0, 1)  AND bang_diem.maso_hocsinh=danh_sach.maso_hocsinh AND mon_hoc.monhoc_id=bang_diem.monhoc_id");
        if($query->num_rows()>0){
        $data=$query->result_array();
        }else{$data=FALSE;}return $data;
}
public  function Rank_diem($class,$mark){
    $this->db->query("SET @prev_value = NULL");
    $this->db->query("SET @rank_count = 0");
    $query=$this->db->query("SELECT $mark, maso_hocsinh, CASE 
    WHEN @prev_value = $mark THEN @rank_count 
    WHEN @prev_value := $mark THEN @rank_count := @rank_count + 1 
    END AS rank FROM bang_diem WHERE class_id = $class AND `monhoc_id`=6 ORDER BY $mark DESC LIMIT 0,50");
    if($query->num_rows()>0){
        $data=$query->result_array();
    }else{$data=FALSE;}return $data;
}
public function Chart($class){
    $query=$this->db->query("SELECT  (SELECT  COUNT(diem_thi)  FROM bang_diem WHERE class_id=$class and diem_thi<=5 AND monhoc_id=6) as muc1, 
(SELECT  COUNT(diem_thi)  FROM bang_diem WHERE class_id=$class and diem_thi>5 AND diem_thi<=6 AND monhoc_id=6) as muc2, 
(SELECT  COUNT(diem_thi)  FROM bang_diem WHERE class_id=$class and diem_thi>6 AND diem_thi<=7 AND monhoc_id=6) as muc3,
 (SELECT  COUNT(diem_thi)  FROM bang_diem WHERE class_id=$class and diem_thi>7 AND diem_thi<=8 AND monhoc_id=6) as muc4,
 (SELECT  COUNT(diem_thi)  FROM bang_diem WHERE class_id=$class and diem_thi>8 AND diem_thi<=9 AND monhoc_id=6) as muc5,
 (SELECT  COUNT(diem_thi)  FROM bang_diem WHERE class_id=$class and diem_thi>9 AND monhoc_id=6) as muc6");
    if($query->num_rows()>0){
        $data=$query->result_array();
    }else{$data=FALSE;}return $data;
}
    public function json_model_check($data,$class)// tim ten trong csdl trung voi ten dang tim kiem
    {
        $query=$this->db->query("SELECT  name  FROM danh_sach WHERE name LIKE '$data%' AND class_id=$class");
        if($query->num_rows()>0){
            $data2=$query->result_array();
            foreach ($data2 as $show){
                $new_row['label']=$show['name'];
                $new_row['value']=$show['name'];
                $row_set[]=$new_row;
            }
        }
        return $row_set;

    }
}