<?php

defined('BASEPATH') OR exit('Ação não permitida!');

class Categorias extends CI_Controller {

    public function __construct() {
        parent::__construct();

        if (!$this->ion_auth->logged_in()) {
            $this->session->set_flashdata('info', 'Sua sessão expirou!');
            redirect('login');
        }
    }

    public function index() {

        $data = array(
            'titulo' => 'Categorias Cadastradas',
            'styles' => array(
                'vendor/datatables/dataTables.bootstrap4.min.css',
            ),
            'scripts' => array(
                'vendor/datatables/jquery.dataTables.min.js',
                'vendor/datatables/dataTables.bootstrap4.min.js',
                'vendor/datatables/app.js'
            ),
            'categorias' => $this->core_model->get_all('categorias'), // Pegar todas as SCategorias        
        );

        //echo'<pre>';
        //print_r($data['categorias']);
        //exit();

        $this->load->view('layout/header', $data);
        $this->load->view('categorias/index');
        $this->load->view('layout/footer');
    }

    public function add() {
        $this->form_validation->set_rules('categoria_nome', '', 'trim|required|required|min_length[2]|max_length[45]');

        if ($this->form_validation->run()) {
            $data = elements(
                        array(
                            'categoria_nome',
                            'categoria_ativa'
                        ), $this->input->post()
                );


            $data = html_escape($data);

            $this->core_model->insert('categorias', $data);
            redirect('categorias');

        } else {
            //erro de validação
            $data = array(
                'titulo' => 'Cadastrar Marca',
                'scripts' => array(
                    '/vendor/mask/jquery.mask.min.js',
                    '/vendor/mask/app.js',
                ),
               
            );

            $this->load->view('layout/header', $data);
            $this->load->view('categorias/add');
            $this->load->view('layout/footer');
        }
    }

    public function edit($categoria_id = NULL) {

        if (!$categoria_id || !$this->core_model->get_by_id('categorias', array('categoria_id' => $categoria_id))) {
            $this->session->set_flashdata('error', 'Categoria não encontrada!');
            redirect('categorias');
        } else {
            $this->form_validation->set_rules('categoria_nome', '', 'trim|required|required|min_length[4]|max_length[45]');

            if ($this->form_validation->run()) {
                $data = elements(
                        array(
                            'categoria_nome',
                            'categoria_ativa'
                        ), $this->input->post()
                );

                $data = html_escape($data);

                $this->core_model->update('categorias', $data, array('categoria_id' => $categoria_id));
                redirect('categorias');
            } else {

                $data = array(
                    'titulo' => 'Atualizar Categoria',
                    'scripts' => array(
                        '/vendor/mask/jquery.mask.min.js',
                        '/vendor/mask/app.js',
                    ),
                    'categoria' => $this->core_model->get_by_id('categorias', array('categoria_id' => $categoria_id)),
                );

                //echo'<pre>';
                //print_r($data['fornecedor']);
                //exit();

                $this->load->view('layout/header', $data);
                $this->load->view('categorias/edit');
                $this->load->view('layout/footer');
            }
        }
    }
    
    public function del($categoria_id = NULL) {

        if (!$categoria_id || !$this->core_model->get_by_id('categorias', array('categoria_id' => $categoria_id))) {
            $this->session->set_flashdata('error', 'Categoria não encontrado');
            redirect('categorias');
        } else {

            $this->core_model->delete('categorias', array('categoria_id' => $categoria_id));
            redirect('categorias');
        }
    }
    
    
    

}
