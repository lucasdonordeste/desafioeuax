<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Protocolo extends CI_Controller {
    
    function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        
        if (!$this->session->userdata('user_id')) {
            $data = array(
                'scripts' => array(
                    'utils.js',
                    'login.js'
                ),
                'btn_login' => 'Entrar'
            );
            $this->template->show('login', $data);
        }
    }

	public function index()
	{
	    
	    if($this->session->userdata('user_id')){
	        $data = array(
	            'styles' => array(
	                'dataTables.bootstrap.min.css',
	                'datatables.min.css'
	            ),
	            'scripts' => array(
	                'jquery.dataTables.min.js',
	                'dataTables.bootstrap.min.js',
	                'datatables.min.js',
	                'utils.js',
	                'restrict.js'
	            )
	            
	        );
	        
	        $this->template->show('protocolo.php',$data);
	        
	        
	    }else{

    		$data = array(
    			'scripts' => array(
    				'utils.js',
    				'login.js'
    			),
    		    'btn_login'=>'Entrar'
    
    		 );
    		$this->template->show('login',$data);
	    }
	}
	

	
	function ajax_save_projeto(){
	    
	    if(!$this->input->is_ajax_request()){
	        exit('Acesso direto não permitido');
	    }
	    
	    $json = array();
	    $json['status'] = 1;
	    $json['error_list'] = array();

	    $data = $this->input->post();

	    
	    if(empty($data['p_nome'])){
	        $json['status'] = 0;
	        $json['error_list']['#p_nome']='Campo Nome está vazio';
	    }
	    if(empty($data['p_inicio'])){
	        $json['status'] = 0;
	        $json['error_list']['#p_inicio']='Campo Início está vazio';
	    }
	    
	    if(empty($data['p_fim'])){
	        $json['status'] = 0;
	        $json['error_list']['#p_fim']='Campo Fim está vazio';
	    }
	    
	   
	    
	    if($json['status']){
 
	    
	    
    
	    $this->load->model('projeto_model');
	    
	    $campos['p_nome'] = $data['p_nome'];
	    $campos['p_inicio'] = $data['p_inicio'];
	    $campos['p_fim'] = $data['p_fim'];
	    
	    if(!$this->projeto_model->exist($campos)){
	        
	        if(!empty($data['projeto_id'])){
	            $this->protocolo_model->update($data);
	        }else{
	            $id_protocolo = $this->projeto_model->insert($data);
	            
	            if($id_protocolo){


	            };
	            
	        }
	    }else{
	        $json['status'] = 0;
	        $json['error_list']['#p_nome'] = 'Um projeto com essa descrição já foi inserido no sistema';
	    }
	    
	    }
	    echo json_encode($json);

	    
	}
	

	
	public function ajax_list_protocolos(){
	    if(!$this->input->is_ajax_request()){
	        exit('Acesso direto não permitido');
	    };
	    
	    $this->load->model('projeto_model');
	    $protocolos = $this->projeto_model->get_dataTable();
	    
	    $data = array();
	    
	    foreach ($protocolos as $protocolo){
	        
	        $button = '<button class="btn btn-light btn-view-protodetalhes" 
                        protocolo_id="'.$protocolo->idprojeto.'">
	                       <i class="fa fa-search-plus">&nbsp;Detalhes</i>
                        </button>';
    	            
    	                $button.=' <button class="btn btn-success btn-create-atividade"
                                projeto_id="'.$protocolo->idprojeto.'">
    	                       <i class="fa fa-edit">Criar Atividade</i>
                               </button>';

				$row = array();
				$row[] = $protocolo->p_nome;
				$row[] = date_format(date_create($protocolo->p_inicio),'d/m/y');
				$row[] = date_format(date_create($protocolo->p_fim),'d/m/y');
				$row[] = '<div style="display:inline-block">'.$button.'</div>';

				
				$data[] = $row;

	    }
	    
	    
	    $json = array(
	        'draw' => $this->input->post('draw'),
	        'recordsTotal' => $this->projeto_model->records_total(),
	        'recordsFiltered' => $this->projeto_model->records_filtered(),
	        'data' => $data,
	    );
	    
	    
	    echo json_encode($json);
	}


public function ajax_get_detalhes_projeto($idprojeto)
    {
        $json['status'] = 0;

        $this->load->model('projeto_model');
        $this->load->model('atividade_model');

        $dados['projeto'] = $this->projeto_model->get_data($idprojeto)[0];

        if ($dados['projeto']) {

            $json['status'] = 1;
 
            $dados['atividades'] = $this->atividade_model->list_atividades($idprojeto);

            $dados['atividades_finalizadas'] = $this->atividade_model->get_finalizadas($idprojeto);
            $dados['atividades_pendentes'] = $this->atividade_model->get_pendentes($idprojeto);
        }

        $json['data'] = $this->load->view('detalhes_projeto', $dados, true);

        echo json_encode($json);
    }

public function ajax_nova_atividade($idprojeto)
    {
        $dados['idprotocolo'] = $idprojeto;
        $json['status'] = 1;


        $json['data'] = $this->load->view('create_atividade', $dados, true);

        echo json_encode($json);
    }


public function ajax_finalizar_atividade($idatividade)
    {
        $dados['idatividade'] = $idatividade;
        
        $json['status'] = 0;

        $json['message'] = 'Nenhuma alteração';

		$this->load->model('atividade_model');

        if($result = $this->atividade_model->finalizar($dados)>0){
        

        $json['status'] = 1;

        $json['message'] = 'Atividade Finalizada';

   		}

        echo json_encode($json);
    }

public function ajax_excluir_atividade($idatividade)
    {
        $dados['idatividade'] = $idatividade;
        
        $json['status'] = 0;

        $json['message'] = '';

		$this->load->model('atividade_model');

        if($result = $this->atividade_model->delete($dados)>0){
        

        $json['status'] = 1;

        $json['message'] = 'Atividade Removida';

   		}

        echo json_encode($json);
    }

public function ajax_excluir_projeto($idprojeto)
    {
        $dados['idprojeto'] = $idprojeto;
        
        $json['status'] = 0;

        $json['message'] = '';

		$this->load->model('projeto_model');

        if($result = $this->projeto_model->delete($dados)>0){
        

        $json['status'] = 1;

        $json['message'] = 'Projeto Removido';

   		}

        echo json_encode($json);
    } 
	
public function ajax_criar_atividade()
    {
        $dados = $this->input->post();
        $dados['a_finalizada'] = 0;

        $json['status'] = 1;

        if (empty($dados['a_nome'])) {
            $json['status'] = 0;
            $json['error_list']['#a_nome'] = 'Campo Nome está vazio';
        }

        if (empty($dados['a_inicio'])) {
            $json['status'] = 0;
            $json['error_list']['#a_inicio'] = 'Campo Início está vazio';
        }

        if (empty($dados['a_fim'])) {
            $json['status'] = 0;
            $json['error_list']['#a_fim'] = 'Campo Fim está vazio';
        }

        if ($json['status']) {

           


            $this->load->model('atividade_model');

            $id_atividade = $this->atividade_model->insert($dados);

            if ($id_atividade) {
                $json['status'] = 1;
                $json['message'] = 'Atividade cadastrada';

                
            } 
        }
        echo json_encode($json);
    }
	
}
