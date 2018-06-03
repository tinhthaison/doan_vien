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
        $query=$this->db->query("SELECT user_name FROM user_login WHERE user_name ='$user' AND user_password ='$pass' ");
            if($query->num_rows()>0){return TRUE;}else{return FALSE;}
}
}