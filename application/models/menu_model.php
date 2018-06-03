<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu_model extends CI_Model {

      public function __construct(){
          parent::__construct();
          $this->load->database();
          $this->load->helper('url');}
 
 public function xuly(){
   $query=$this->db->query('SELECT * FROM menu ORDER BY vitri_menu ASC Limit 0,6');
    if($query->num_rows()>0){
    $data=$query->result_array();
    return $data;
 	}echo "<meta http-equiv='refresh' content='0.5;url=$url'/>";}
 }
 ?>
