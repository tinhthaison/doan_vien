<?php
class Add_model extends CI_Model{

    public function __construct()
    { parent::__construct();
        $this->load->helper('url');
        $this->load->database();}
public function Add_word($data){//add word
    $this->db->insert("dich",$data);
}
public function Search_caolan($data)// tim tu cao lan
{
   $query=$this->db->query("SELECT id, Caolan, vietnamese, Vidu FROM dich WHERE vietnamese LIKE '$data'");
    if($query->num_rows()>0){
        $query2=$query->result_array();
        foreach ($query2 as $show){
        $data2['dich']=$show['vietnamese'];
        $data2['y_nghia']=$show['Caolan'];
            $data2['Vidu']=$show['Vidu'];}
        $set_data[]=$data2;
    }else {$set_data=null;}
    return $set_data;

}
    public function Search_viet($data)// tim tu cao lan
    {
        $query=$this->db->query("SELECT id, Caolan, vietnamese, Vidu FROM dich WHERE Caolan LIKE '$data'");
        if($query->num_rows()>0){
            $query2=$query->result_array();
            foreach ($query2 as $show){
                $data2['dich']=$show['Caolan'];
                $data2['y_nghia']=$show['vietnamese'];
                $data2['Vidu']=$show['Vidu'];}
            $set_data[]=$data2;
        }else {$set_data=null;}
        return $set_data;

    }
    public function json_model_vi($data)// tim tu cao lan
    {
        $query=$this->db->query("SELECT  vietnamese  FROM dich WHERE vietnamese LIKE '$data%'");
        if($query->num_rows()>0){
            $data2=$query->result_array();
            foreach ($data2 as $show){
                $new_row['label']=$show['vietnamese'];
                $new_row['value']=$show['vietnamese'];
                $row_set[]=$new_row;
            }
        }
        return $row_set;

    }
    public function json_model_ca($data)// tim tu cao lan
    {
        $query=$this->db->query("SELECT  Caolan  FROM dich WHERE Caolan LIKE '$data%'");
        if($query->num_rows()>0){
            $data2=$query->result_array();
            foreach ($data2 as $show){
                $new_row['label']=$show['Caolan'];
                $new_row['value']=$show['Caolan'];
                $row_set[]=$new_row;
            }
        }
        return $row_set;

    }
}