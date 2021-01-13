<?php

defined('BASEPATH') OR exit('Ação não permitida!');

class Situacoes extends CI_Controller {

    public function __construct() {
        parent::__construct();

        if (!$this->ion_auth->logged_in()) {
            $this->session->set_flashdata('info', 'Sua sessão expirou!');
            redirect('login');
        }
    }

    public function index() {

        $data = array(
            'titulo' => 'Situações Cadastradas',
            'styles' => array(
                'vendor/datatables/dataTables.bootstrap4.min.css',
            ),
            'scripts' => array(
                'vendor/datatables/jquery.dataTables.min.js',
                'vendor/datatables/dataTables.bootstrap4.min.js',
                'vendor/datatables/app.js'
            ),
            'situacoes' => $this->core_model->get_all('situacoes'), // Pegar todas as SSituacaos        
        );

        //echo'<pre>';
        //print_r($data['situacoes']);
        //exit();

        $this->load->view('layout/header', $data);
        $this->load->view('situacoes/index');
        $this->load->view('layout/footer');
    }

    public function add() {
        $this->form_validation->set_rules('situacao_nome', '', 'trim|required|required|min_length[2]|max_length[45]');

        if ($this->form_validation->run()) {
            $data = elements(
                        array(
                            'situacao_nome',
                            'situacao_ativa'
                        ), $this->input->post()
                );


            $data = html_escape($data);

            $this->core_model->insert('situacoes', $data);
            redirect('situacoes');

        } else {
            //erro de validação
            $data = array(
                'titulo' => 'Cadastrar Situação',
                'scripts' => array(
                    '/vendor/mask/jquery.mask.min.js',
                    '/vendor/mask/app.js',
                ),
               
            );

            $this->load->view('layout/header', $data);
            $this->load->view('situacoes/add');
            $this->load->view('layout/footer');
        }
    }

    public function edit($situacao_id = NULL) {

        if (!$situacao_id || !$this->core_model->get_by_id('situacoes', array('situacao_id' => $situacao_id))) {
            $this->session->set_flashdata('error', 'Situação não encontrada!');
            redirect('situacoes');
        } else {
            $this->form_validation->set_rules('situacao_nome', '', 'trim|required|required|min_length[4]|max_length[45]');

            if ($this->form_validation->run()) {
                
                $situacao_ativa = $this->input->post('situacao_ativa');
                
//                if($this->db->table_exists('ordens_servicos')){
//                    
//                    if($situacao_ativa == 0 && $this->core_model->get_by_id('ordens_servicos', array('ordem_servico_situacao_id' =>$situacao_id, 'ordem_servico_ativa' => 1))){
//                        $this->session->set_flashdata('error', 'Esta Situacao está em uso em ORDEM DE SERVIÇOS e não pode ser desativada!');
//                        redirect('situacoeos');
//                        
//                    }
//                    
//                }
                
                $data = elements(
                        array(
                            'situacao_nome',
                            'situacao_ativa'
                        ), $this->input->post()
                );

                $data = html_escape($data);

                $this->core_model->update('situacoes', $data, array('situacao_id' => $situacao_id));
                redirect('situacoes');
            } else {

                $data = array(
                    'titulo' => 'Atualizar Situação',
                    'scripts' => array(
                        '/vendor/mask/jquery.mask.min.js',
                        '/vendor/mask/app.js',
                    ),
                    'situacoes' => $this->core_model->get_by_id('situacoes', array('situacao_id' => $situacao_id)),
                );

                //echo'<pre>';
                //print_r($data['fornecedor']);
                //exit();

                $this->load->view('layout/header', $data);
                $this->load->view('situacoes/edit');
                $this->load->view('layout/footer');
            }
        }
    }
    
    public function del($situacao_id = NULL) {

        if (!$situacao_id || !$this->core_model->get_by_id('situacoes', array('situacao_id' => $situacao_id))) {
            $this->session->set_flashdata('error', 'Situacao não encontrada');
            redirect('situacoes');
        } else {

            $this->core_model->delete('situacoes', array('situacao_id' => $situacao_id));
            redirect('situacoes');
        }
    }
    

}
