<?php

/**
 * 
 */
class Projeto_model extends CI_Model


{
    
    private $column_search = array('p_nome','idprojeto','p_inicio');
    private $column_order = array('p_inicio',' ','p_nome');
    
	
	public function __construct()
	{
    	parent::__construct();
    	$this->load->database();
	}


	public function get_data($id, $select = NULL){
	    
	    if(!empty($select)){
	        
	        $this->db->select($select);
	    }

	    $this->db->from('projeto');
	    $this->db->where('idprojeto', $id);
	    

	    
	    return $this->db->get()->result();
	}
	
	
	public function insert($data){
	    $this->db->insert('projeto', $data);
	    
	    return $this->db->insert_id();
	}
	

   public function delete($dados)
    {


    	$atividade['projeto_idprojeto'] =  $dados['idprojeto'];
   		
   		$this->db->where($atividade);
    	$this->db->delete('atividade',$atividade);

        if($this->db->affected_rows()>0){
        	
	        $this->db->where($dados);
	        $this->db->delete('projeto',$dados);
        }



        return $this->db->affected_rows();
    }
	
    public function exist($fields)
    {
		//Verifica se existe algum registro com os valores informados
        $this->db->from('projeto');
        $this->db->where($fields);

        return $this->db->get()->num_rows() > 0;
    }
	
	private function _get_dataTable(){

	    
	    $search = NULL;
	    
	    if($this->input->post('search')){
	        $search = $this->input->post('search')['value'];
	    }
	    
	    
	    $order_column = NULL;
	    $order_dir = NULL;
	    $order = $this->input->post('order');
	    
	    if(isset($order)){
	        $order_column = $order[0]['column'];
	        $order_dir = 'DESC';
	    }
	    
	    $this->db->from('projeto');

	    
	    if(isset($search)){
	        $first  = TRUE;
	        
	        foreach ($this->column_search as $field) {
	            if($first){
	                $this->db->group_start();
	                $this->db->like($field,$search);
	                $first = FALSE;
	            }else{
	                $this->db->or_like($field,$search);
	            }
	        }
	        
	        if(!$first){
	            $this->db->group_end();
	        }
	    }
	    
	    if(isset($order)){
	        $this->db->order_by($this->column_order[$order_column].' '.$order_dir);
	    }else{
	        $this->db->order_by('p_inicio desc');
	    }
	}
	
	public function get_dataTable(){
	    $length = $this->input->post('length');
	    $start = $this->input->post('start');
	    
	    $this->_get_dataTable();
	    
	    if(isset($length) && $length != -1){
	        $this->db->limit($length, $start);
	    }
	    
	    return $this->db->get()->result();
	    
	}
	
	public function records_filtered(){
	    $this->_get_dataTable();
	    return $this->db->get()->num_rows();
	    
	}
	
	public function records_total(){
	    $this->db->from('projeto');
	   // $this->db->join('tarefa', 'protocolo.idprotocolo = tarefa.protocolo_idprotocolo');
	    
	    return $this->db->count_all_results();
	}
	

}