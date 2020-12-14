<?php

defined('BASEPATH') OR exit('Ação não permitida!');

class Sistema extends CI_Controller {

    public function __construct() {
        parent::__construct();

        if (!$this->ion_auth->logged_in()) {
            $this->session->set_flashdata('info', 'Sua sessão expirou!');
            redirect('login');
        }
    }

    public function index() {



        $data = array(
            'titulo' => 'Editar informações do sistema',
            
            'scripts'=> array(
                '/vendor/mask/jquery.mask.min.js',
                '/vendor/mask/app.js',
            ),
            
            'sistema' => $this->core_model->get_by_id('sistema', array('sistema_id' => 1)),
        );

        $this->form_validation->set_rules('sistema_razao_social', '', 'min_length[10]|max_length[145]');
        $this->form_validation->set_rules('sistema_nome_fantasia', '', 'required|min_length[10]|max_length[145]');
        $this->form_validation->set_rules('sistema_cnpj', 'CNPJ', 'required|exact_length[18]');
        $this->form_validation->set_rules('sistema_ie', '', 'required|max_length[25]');
        $this->form_validation->set_rules('sistema_telefone_fixo', '', 'required|max_length[25]');
        $this->form_validation->set_rules('sistema_telefone_movel', '', 'required|max_length[25]');
        $this->form_validation->set_rules('sistema_email', 'E-mail', 'required|valid_email|max_length[100]');
        $this->form_validation->set_rules('sistema_site_url', '', 'required|valid_url|max_length[100]');
        $this->form_validation->set_rules('sistema_cep', '', 'required|exact_length[10]');
        $this->form_validation->set_rules('sistema_endereco', '', 'required|max_length[145]');
        $this->form_validation->set_rules('sistema_numero', 'Número', 'max_length[25]');
        $this->form_validation->set_rules('sistema_bairro', 'Bairro', 'required|max_length[75]');
        $this->form_validation->set_rules('sistema_cidade', 'Cidade', 'required|max_length[45]');
        $this->form_validation->set_rules('sistema_estado', 'Estado', 'required|exact_length[2]');
        $this->form_validation->set_rules('sistema_txt_ordem_servico', 'Texto', 'max_length[500]');

        if ($this->form_validation->run()) {

            /*
              [sistema_razao_social] => Teste de sistema
              [sistema_nome_fantasia] => sistema em teste
              [sistema_cnpj] => 96.701.860/0001-21
              [sistema_ie] => 21088827-0
              [sistema_telefone_fixo] => (88)2151-2541
              [sistema_telefone_movel] => (88) 9 8842-0622
              [sistema_email] => contato@sistema.net
              [sistema_site_url] => http://localhost/sistema/
              [sistema_endereco] => rua jose xavier de oliveira
              [sistema_numero] => 68
              [sistema_bairro] => pirajá
              [sistema_cidade] => juazeiro do norte
              [sistema_estado] => CE
              [sistema_cep] => 63.034-118
              [sistema_txt_ordem_servico] => Teste de texto que irá constar nas ordens de serviços e nas vendas...
              )
             */
            $data = elements(
                    array(
                        'sistema_razao_social',
                        'sistema_nome_fantasia',
                        'sistema_cnpj',
                        'sistema_ie',
                        'sistema_ie',
                        'sistema_telefone_fixo',
                        'sistema_telefone_movel',
                        'sistema_email',
                        'sistema_site_url',
                        'sistema_endereco',
                        'sistema_numero',
                        'sistema_bairro',
                        'sistema_cidade',
                        'sistema_estado',
                        'sistema_cep',
                        'sistema_txt_ordem_servico'
                    ), $this->input->post()
            );
            
            $data = html_escape($data);
            
            $this->core_model->update('sistema', $data, array('sistema_id' =>1 ));
            redirect('sistema');

            //echo '<pre>';
            //print_r($this->input->post());
            //exit();
        } else {
            //erro de validação
            $this->load->view('layout/header', $data);
            $this->load->view('sistema/index');
            $this->load->view('layout/footer');
        }
    }

}
