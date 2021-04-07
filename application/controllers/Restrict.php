<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Restrict extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library('session');
    }

    public function index()
    {
        if ($this->session->userdata('user_id')) {
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
                    'restrict.js',
                    'tarefa.js'
                )
            );

                $inicio = 'protocolo.php';


            $this->template->show($inicio, $data);
        } else {

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


    function logoff()
    {
        $this->session->sess_destroy();
        header('Location:' . base_url('restrict'));
    }

   
    function ajax_login()
    {
        if (! $this->input->is_ajax_request()) {
            header('Location:' . base_url('restrict'));
        }

        $json = array();
        $json['status'] = 1;
        $json['error_list'] = array();

        $username = $this->input->post('username');
        $passrword = $this->input->post('password');

        if (empty($username)) {
            $json['status'] = 0;
            $json['error_list']['#username'] = 'Digite um nome de usuário';
        } else {

            $this->load->model('users_model');
            $result = $this->users_model->get_user_data($username);

            if ($result) {
                $user_id = $result->idusuario;
                $user_password = $result->u_senha;

                if (sha1($passrword) == $user_password) {

                    $user = array(
                        'user_id' => $user_id,
                        'user_name' => $result->u_nome,
                        'user_email' => $result->u_email,
                        'user_orgao' => $result->u_orgao,
                        'user_prefixo' => $result->u_prefixo,
                        'user_tipo' => $result->u_tipo
                    );

                    $this->session->set_userdata($user);
                } else {
                    $json['status'] = 0;
                }
            } else {
                $json['status'] = 0;
            }

            if ($json['status'] == 0) {
                $json['error_list']['#btn_login'] = 'Usuário e/ou senha incorretos';
            }
        }

        echo json_encode($json);
    }
}
