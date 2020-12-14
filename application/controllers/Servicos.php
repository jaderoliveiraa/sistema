<?php

defined('BASEPATH') OR exit('Ação não permitida!');

class Servicos extends CI_Controller {

    public function __construct() {
        parent::__construct();

        if (!$this->ion_auth->logged_in()) {
            $this->session->set_flashdata('info', 'Sua sessão expirou!');
            redirect('login');
        }
    }

    public function index() {

        $data = array(
            'titulo' => 'Servicos Cadastrados',
            'styles' => array(
                'vendor/datatables/dataTables.bootstrap4.min.css',
            ),
            'scripts' => array(
                'vendor/datatables/jquery.dataTables.min.js',
                'vendor/datatables/dataTables.bootstrap4.min.js',
                'vendor/datatables/app.js'
            ),
            'servicos' => $this->core_model->get_all('servicos'), // Pegar todos os Serviços        
        );

        //echo'<pre>';
        //print_r($data['servicos']);
        //exit();

        $this->load->view('layout/header', $data);
        $this->load->view('servicos/index');
        $this->load->view('layout/footer');
    }

    public function add() {
        $this->form_validation->set_rules('servico_nome', '', 'trim|required|required|min_length[4]|max_length[150]');
        $this->form_validation->set_rules('servico_preco', 'servico_preco', 'required');
        $this->form_validation->set_rules('servico_descricao', '', 'trim|required|min_length[4]|max_length[700]');

        if ($this->form_validation->run()) {
            $data = elements(
                        array(
                            'servico_nome',
                            'servico_preco',
                            'servico_descricao',
                            'servico_ativo'
                        ), $this->input->post()
                );


            $data = html_escape($data);

            $this->core_model->insert('servicos', $data);
            redirect('servicos');

        } else {
            //erro de validação
            $data = array(
                'titulo' => 'Cadastrar Serviço',
                'scripts' => array(
                    '/vendor/mask/jquery.mask.min.js',
                    '/vendor/mask/app.js',
                ),
               
            );

            $this->load->view('layout/header', $data);
            $this->load->view('servicos/add');
            $this->load->view('layout/footer');
        }
    }

    public function edit($servico_id = NULL) {

        if (!$servico_id || !$this->core_model->get_by_id('servicos', array('servico_id' => $servico_id))) {
            $this->session->set_flashdata('error', 'Serviço não encontrado!');
            redirect('servicos');
        } else {
            $this->form_validation->set_rules('servico_nome', '', 'trim|required|required|min_length[4]|max_length[150]');
            $this->form_validation->set_rules('servico_preco', 'servico_preco', 'required');
            $this->form_validation->set_rules('servico_descricao', '', 'trim|required|min_length[4]|max_length[700]');

            if ($this->form_validation->run()) {
                $data = elements(
                        array(
                            'servico_nome',
                            'servico_preco',
                            'servico_descricao',
                            'servico_ativo'
                        ), $this->input->post()
                );

                $data = html_escape($data);

                $this->core_model->update('servicos', $data, array('servico_id' => $servico_id));
                redirect('servicos');
            } else {

                $data = array(
                    'titulo' => 'Atualizar Serviço',
                    'scripts' => array(
                        '/vendor/mask/jquery.mask.min.js',
                        '/vendor/mask/app.js',
                    ),
                    'servico' => $this->core_model->get_by_id('servicos', array('servico_id' => $servico_id)),
                );

                //echo'<pre>';
                //print_r($data['fornecedor']);
                //exit();

                $this->load->view('layout/header', $data);
                $this->load->view('servicos/edit');
                $this->load->view('layout/footer');
            }
        }
    }
    
    public function del($servico_id = NULL) {

        if (!$servico_id || !$this->core_model->get_by_id('servicos', array('servico_id' => $servico_id))) {
            $this->session->set_flashdata('error', 'Serviço não encontrado');
            redirect('servicos');
        } else {

            $this->core_model->delete('servicos', array('servico_id' => $servico_id));
            redirect('servicos');
        }
    }
    

}
