<?php
class Test_model extends CI_model
{
    function test(){
        $this->load->database();
        $query=$this->db->get('menu');
    if($query->num_rows()>0){
         $row=$query->row();
        echo $row->menu_id;
        }
    }
    }
    

?>