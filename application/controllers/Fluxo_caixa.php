<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Fluxo_caixa
 *
 * @author falec
 */
class Fluxo_caixa extends CI_Controller {

    public function __construct() {
        parent::__construct();

        if (!$this->ion_auth->logged_in()) {
            $this->session->set_flashdata('info', 'Sua sessão expirou!');
            redirect('login');
        }

        if (!$this->ion_auth->is_admin()) {
            $this->session->set_flashdata('error', 'Acesso negado! Contate o administrador...');
            redirect('home');
        }
        $this->load->model('ordem_servicos_model');
        $this->load->model('financeiro_model');
        $this->load->model('vendas_model');
    }

    public function index() {

        $dataatual = date('Y-m-d');

        $data = array(
            'titulo' => 'Fluxo de Caixa',
            'styles' => array(
                'vendor/datatables/dataTables.bootstrap4.min.css',
            ),
            'scripts' => array(
                'vendor/datatables/jquery.dataTables.min.js',
                'vendor/datatables/dataTables.bootstrap4.min.js',
                'vendor/datatables/app.js'
            ),
            'os' => $this->ordem_servicos_model->get_all('ordens_servicos', array('ordem_servico_status' => 0)), // Pegar todos as ordens_servicos        
            'vendas' => $this->vendas_model->get_all(), // Pegar todos as ordens_servicos        
            'pagar' => $this->financeiro_model->get_all_pagar(), // Pegar todos as ordens_servicos        
            'receber' => $this->financeiro_model->get_all_receber(), // Pegar todos as ordens_servicos        
        );

//        echo '<pre>';
//        print_r($data['vendas']);
//        exit();
        $this->load->view('layout/header', $data);
        $this->load->view('fluxo/index');
        $this->load->view('layout/footer');
    }

}
