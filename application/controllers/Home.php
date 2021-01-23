<?php

defined('BASEPATH') OR exit('Ação não permitida!');

class Home extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
        
        if(!$this->ion_auth->logged_in()){
            $this->session->set_flashdata('info', 'Sua sessão expirou!');
            redirect('login');
        }
        
        $this->load->model('home_model');
    }
    
    public function index() {
        
        $data = array(
            'titulo' => 'Início',
            //Home
            'soma_vendas' => $this->home_model->get_sum_vendas(),
            'soma_servicos' => $this->home_model->get_sum_ordem_servico(),
            'soma_pagar' => $this->home_model->get_sum_pagar(),
            'soma_receber' => $this->home_model->get_sum_receber(),
        );
        
        $this->load->view('layout/header', $data);
        $this->load->view('home/index');
        $this->load->view('layout/footer');
        
        
    }
    
}
