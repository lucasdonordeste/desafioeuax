<?php

/**
 * 
 */
class Atividade_model extends CI_Model

{


    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_data($id, $select = NULL)
    {
        if (! empty($select)) {

            $this->db->select($select);
        }

        $this->db->from('tarefa');
        $this->db->where('idtarefa', $id);

        return $this->db->get()->result()[0];
    }

   

     public function insert($data)
    {
        $this->db->insert('atividade', $data);

        return $this->db->insert_id();
    }


    public function finalizar($dados)
    {

        $campos['a_finalizada'] = 1;

        $this->db->where($dados);
        $this->db->update('atividade',$campos);
        return $this->db->affected_rows();
    }

    public function delete($dados)
    {
        $this->db->where($dados);
        $this->db->delete('atividade',$dados);


        return $this->db->affected_rows();
    }

     public function get_finalizadas($idprojeto)
    {
        
     

        $this->db->from('atividade');
        $this->db->where('a_finalizada',1);
        $this->db->where('projeto_idprojeto',$idprojeto);



        return $this->db->get()->result();


    }

     public function get_pendentes($idprojeto)
    {
        
        //$this->db->select('projeto_idprojeto',$idprojeto);
        

        $this->db->from('atividade');
        $this->db->where('a_finalizada',0);
        $this->db->where('projeto_idprojeto',$idprojeto);
        $this->db->order_by('a_fim DESC');

//echo $this->db->last_query();

        return $this->db->get()->result();


    }    



    public function list_atividades($idprojeto, $select = NULL){
        
        if(!empty($select)){
            
            $this->db->select($select);
        }
        
        $this->db->from('atividade a');
        $this->db->where('projeto_idprojeto', $idprojeto);
        
        
        
        return $this->db->get()->result();
    }

    
}