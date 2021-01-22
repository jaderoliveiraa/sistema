<?php

defined('BASEPATH') OR exit('Ação não permitida!');

class Vendedores extends CI_Controller {

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
    }

    public function index() {

        $data = array(
            'titulo' => 'Vendedores Cadastrados',
            'styles' => array(
                'vendor/datatables/dataTables.bootstrap4.min.css',
            ),
            'scripts' => array(
                'vendor/datatables/jquery.dataTables.min.js',
                'vendor/datatables/dataTables.bootstrap4.min.js',
                'vendor/datatables/app.js'
            ),
            'vendedores' => $this->core_model->get_all('vendedores'), // Pegar todos os Vendedores        
        );

        //echo'<pre>';
        //print_r($data['vendedores']);
        //exit();

        $this->load->view('layout/header', $data);
        $this->load->view('vendedores/index');
        $this->load->view('layout/footer');
    }

    public function add() {
        $this->form_validation->set_rules('vendedor_codigo', '', 'trim|required|min_length[4]|max_length[200]');
        $this->form_validation->set_rules('vendedor_nome_completo', '', 'trim|required|min_length[4]|max_length[200]');
        $this->form_validation->set_rules('vendedor_cpf', '', 'trim|min_length[4]|max_length[20]|is_unique[vendedores.vendedor_cpf]');
        $this->form_validation->set_rules('vendedor_rg', '', 'trim|min_length[4]|max_length[20]|is_unique[vendedores.vendedor_rg]');
        $this->form_validation->set_rules('vendedor_telefone', '', 'trim|max_length[15]|is_unique[vendedores.vendedor_telefone]');
        $this->form_validation->set_rules('vendedor_celular', '', 'trim|max_length[16]|is_unique[vendedores.vendedor_celular]');
        $this->form_validation->set_rules('vendedor_email', '', 'trim|required|valid_email|max_length[100]|is_unique[vendedores.vendedor_email]');
        $this->form_validation->set_rules('vendedor_cep', '', 'trim|min_length[4]|exact_length[10]');
        $this->form_validation->set_rules('vendedor_endereco', '', 'trim|required|min_length[4]|max_length[155]');
        $this->form_validation->set_rules('vendedor_numero_endereco', '', 'trim|max_length[20]');
        $this->form_validation->set_rules('vendedor_complemento', '', 'trim|min_length[4]|max_length[145]');
        $this->form_validation->set_rules('vendedor_bairro', '', 'trim|required|min_length[4]|max_length[45]');
        $this->form_validation->set_rules('vendedor_cidade', '', 'trim|required|min_length[4]|max_length[105]');
        $this->form_validation->set_rules('vendedor_estado', '', 'trim|required|exact_length[2]');
        $this->form_validation->set_rules('vendedor_obs', '', 'max_length[500]');

        if ($this->form_validation->run()) {

            $data = elements(
                    array(
                        'vendedor_codigo',
                        'vendedor_nome_completo',
                        'vendedor_cpf',
                        'vendedor_rg',
                        'vendedor_telefone',
                        'vendedor_celular',
                        'vendedor_email',
                        'vendedor_cep',
                        'vendedor_endereco',
                        'vendedor_numero_endereco',
                        'vendedor_complemento',
                        'vendedor_bairro',
                        'vendedor_cidade',
                        'vendedor_ativo',
                        'vendedor_obs',
                    ), $this->input->post()
            );

            $data['vendedor_estado'] = strtoupper($this->input->post('vendedor_estado'));

            $data = html_escape($data);

            $this->core_model->insert('vendedores', $data);
            redirect('vendedores');

            // echo'<pre>';
            //print_r($data);
            // exit();
        } else {
            //erro de validação
            $data = array(
                'titulo' => 'Cadastrar Vendedor',
                'scripts' => array(
                    '/vendor/mask/jquery.mask.min.js',
                    '/vendor/mask/app.js',
                ),
                'vendedor_codigo' => $this->core_model->generate_unique_code('vendedores', 'numeric', 8, 'vendedor_codigo'),
            );

            //echo'<pre>';
            //print_r($data['vendedor']);
            //exit();

            $this->load->view('layout/header', $data);
            $this->load->view('vendedores/add');
            $this->load->view('layout/footer');
        }
    }

    public function edit($vendedor_id = NULL) {

        if (!$vendedor_id || !$this->core_model->get_by_id('vendedores', array('vendedor_id' => $vendedor_id))) {

            $this->session->set_flashdata('error', 'Fornecedor não encontrado!');
            redirect('vendedores');
        } else {
            $this->form_validation->set_rules('vendedor_nome_completo', '', 'trim|required|min_length[4]|max_length[145]');
            $this->form_validation->set_rules('vendedor_cpf', 'vendedor_cpf', 'exact_length[14]|callback_valida_cpf');
            $this->form_validation->set_rules('vendedor_rg', '', 'trim|min_length[4]|max_length[25]');
            $this->form_validation->set_rules('vendedor_telefone', '', 'trim|max_length[15]');
            $this->form_validation->set_rules('vendedor_celular', '', 'trim|required|max_length[16]|callback_check_vendedor_celular');
            $this->form_validation->set_rules('vendedor_email', '', 'trim|required|valid_email|max_length[45]|callback_check_vendedor_email');
            $this->form_validation->set_rules('vendedor_cep', '', 'trim|min_length[4]|exact_length[10]');
            $this->form_validation->set_rules('vendedor_endereco', '', 'trim|required|min_length[4]|max_length[45]');
            $this->form_validation->set_rules('vendedor_numero_endereco', '', 'trim|max_length[20]');
            $this->form_validation->set_rules('vendedor_complemento', '', 'trim|min_length[4]|max_length[45]');
            $this->form_validation->set_rules('vendedor_bairro', '', 'trim|required|min_length[4]|max_length[45]');
            $this->form_validation->set_rules('vendedor_cidade', '', 'trim|required|min_length[4]|max_length[45]');
            $this->form_validation->set_rules('vendedor_estado', '', 'trim|required|exact_length[2]');
            $this->form_validation->set_rules('vendedor_obs', '', 'max_length[500]');

            if ($this->form_validation->run()) {

                $data = elements(
                        array(
                            'vendedor_codigo',
                            'vendedor_nome_completo',
                            'vendedor_cpf',
                            'vendedor_rg',
                            'vendedor_telefone',
                            'vendedor_celular',
                            'vendedor_email',
                            'vendedor_cep',
                            'vendedor_endereco',
                            'vendedor_numero_endereco',
                            'vendedor_complemento',
                            'vendedor_bairro',
                            'vendedor_cidade',
                            'vendedor_estado',
                            'vendedor_ativo',
                            'vendedor_obs'
                        ), $this->input->post()
                );

                $data['vendedor_estado'] = strtoupper($this->input->post('vendedor_estado'));

                $data = html_escape($data);

                $this->core_model->update('vendedores', $data, array('vendedor_id' => $vendedor_id));
                redirect('vendedores');
            } else {

                $data = array(
                    'titulo' => 'Atualizar Vendedor',
                    'scripts' => array(
                        '/vendor/mask/jquery.mask.min.js',
                        '/vendor/mask/app.js',
                    ),
                    'vendedor' => $this->core_model->get_by_id('vendedores', array('vendedor_id' => $vendedor_id)),
                );

                //echo'<pre>';
                //print_r($data['vendedor']);
                //exit();

                $this->load->view('layout/header', $data);
                $this->load->view('vendedores/edit');
                $this->load->view('layout/footer');
            }
        }
    }

    public function del($vendedor_id = NULL) {

        if (!$vendedor_id || !$this->core_model->get_by_id('vendedores', array('vendedor_id' => $vendedor_id))) {
            $this->session->set_flashdata('error', 'Vendedor não encontrado');
            redirect('vendedores');
        } else {

            $this->core_model->delete('vendedores', array('vendedor_id' => $vendedor_id));
            redirect('vendedores');
        }
    }

    public function check_vendedor_email($vendedor_email) {
        $vendedor_id = $this->input->post('vendedor_id');

        if ($this->core_model->get_by_id('vendedores', array('vendedor_email' => $vendedor_email, 'vendedor_id !=' => $vendedor_id))) {
            $this->form_validation->set_message('check_vendedor_email', 'Já existe um vendedor cadastrado com esse E-mail!');
            return FALSE;
        } else {

            return TRUE;
        }
    }

    public function check_vendedor_telefone($vendedor_telefone) {
        $vendedor_id = $this->input->post('vendedor_id');

        if ($this->core_model->get_by_id('vendedores', array('vendedor_telefone' => $vendedor_telefone, 'vendedor_id !=' => $vendedor_id))) {
            $this->form_validation->set_message('check_vendedor_telefone', 'Já existe um vendedor cadastrado com esse Telefone!');
            return FALSE;
        } else {

            return TRUE;
        }
    }

    public function check_vendedor_celular($vendedor_celular) {
        $vendedor_id = $this->input->post('vendedor_id');

        if ($this->core_model->get_by_id('vendedores', array('vendedor_celular' => $vendedor_celular, 'vendedor_id !=' => $vendedor_id))) {
            $this->form_validation->set_message('check_vendedor_celular', 'Já existe um vendedor cadastrado com esse Celular!');
            return FALSE;
        } else {

            return TRUE;
        }
    }

    public function valida_cpf($vendedor_cpf) {

        if ($this->input->post('vendedor_id')) {

            $vendedor_id = $this->input->post('vendedor_id');

            if ($this->core_model->get_by_id('vendedores', array('vendedor_id !=' => $vendedor_id, 'vendedor_cpf' => $vendedor_cpf))) {
                $this->form_validation->set_message('valida_cpf', 'Este CPF já existe');
                return FALSE;
            }
        }

        $vendedor_cpf = str_pad(preg_replace('/[^0-9]/', '', $vendedor_cpf), 11, '0', STR_PAD_LEFT);
// Verifica se nenhuma das sequências abaixo foi digitada, caso seja, retorna falso
        if (strlen($vendedor_cpf) != 11 || $vendedor_cpf == '00000000000' || $vendedor_cpf == '11111111111' || $vendedor_cpf == '22222222222' || $vendedor_cpf == '33333333333' || $vendedor_cpf == '44444444444' || $vendedor_cpf == '55555555555' || $vendedor_cpf == '66666666666' || $vendedor_cpf == '77777777777' || $vendedor_cpf == '88888888888' || $vendedor_cpf == '99999999999') {

            $this->form_validation->set_message('valida_cpf', 'Por favor digite um CPF válido');
            return FALSE;
        } else {
// Calcula os números para verificar se o CPF é verdadeiro
            for ($t = 9; $t < 11; $t++) {
                for ($d = 0, $c = 0; $c < $t; $c++) {
                    //$d += $vendedor_cpf{$c} * (($t + 1) - $c); // Para PHP com versão < 7.4
                    $d += $vendedor_cpf[$c] * (($t + 1) - $c);
                    //Para PHP com versão < 7.4
                }
                $d = ((10 * $d) % 11) % 10;
                if ($vendedor_cpf[$c] != $d) {
                    $this->form_validation->set_message('valida_cpf', 'Por favor digite um CPF válido');
                    return FALSE;
                }
            }
            return TRUE;
        }
    }

}
