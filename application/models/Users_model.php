<?php

/**
 *
 */
class Users_model extends CI_Model
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    public function get_user_data($user_login){
        $this->db
        ->select()
        ->from('usuario')
        ->where('u_usuario', $user_login);
        
        $result = $this->db->get();
        
        if($result->num_rows() > 0){
            
            
            return $result->row();
        }else{
            return NULL;
        };
    }

    
    
}