<?php

defined('BASEPATH') OR exit('Ação não permitida!');

class Clientes extends CI_Controller {

    public function __construct() {
        parent::__construct();

        if (!$this->ion_auth->logged_in()) {
            $this->session->set_flashdata('info', 'Sua sessão expirou!');
            redirect('login');
        }
    }

    public function index() {

        $data = array(
            'titulo' => 'Clientes Cadastrados',
            'styles' => array(
                'vendor/datatables/dataTables.bootstrap4.min.css',
            ),
            'scripts' => array(
                'vendor/datatables/jquery.dataTables.min.js',
                'vendor/datatables/dataTables.bootstrap4.min.js',
                'vendor/datatables/app.js'
            ),
            'clientes' => $this->core_model->get_all('clientes'), // Pegar todos os usuarios        
        );

        //echo'<pre>';
        // print_r($data['clientes']);
        //exit();

        $this->load->view('layout/header', $data);
        $this->load->view('clientes/index');
        $this->load->view('layout/footer');
    }

    public function add() {



        $this->form_validation->set_rules('cliente_nome', '', 'trim|required|min_length[4]|max_length[45]');
        $this->form_validation->set_rules('cliente_sobrenome', '', 'trim|required|min_length[4]|max_length[150]');
        $this->form_validation->set_rules('cliente_data_nascimento', '', 'required');

        $this->form_validation->set_rules('cliente_cpf_cnpj', '', 'trim|min_length[4]|max_length[20]');

        $cliente_tipo = $this->input->post('cliente_tipo');

        if ($cliente_tipo == 1) {
            $this->form_validation->set_rules('cliente_cpf', 'cliente_cpf', 'exact_length[14]|is_unique[clientes.cliente_cpf_cnpj]|callback_valida_cpf');
        } else {
            $this->form_validation->set_rules('cliente_cnpj', 'cliente_cnpj', 'exact_length[18]|is_unique[clientes.cliente_cpf_cnpj]|callback_valida_cnpj');
        }
        if (!empty($this->input->post('cliente_telefone'))) {
            $this->form_validation->set_rules('cliente_telefone', '', 'trim|max_length[15]|is_unique[clientes.cliente_telefone]');
        }

        if (!empty($this->input->post('cliente_celular'))) {
            $this->form_validation->set_rules('cliente_celular', '', 'trim|max_length[16]|is_unique[clientes.cliente_celular]');
        }

        $this->form_validation->set_rules('cliente_rg_ie', '', 'trim|min_length[4]|max_length[20]|is_unique[clientes.cliente_rg_ie]');
        $this->form_validation->set_rules('cliente_email', '', 'trim|required|valid_email|max_length[50]|is_unique[clientes.cliente_email]');
        $this->form_validation->set_rules('cliente_cep', '', 'trim|min_length[4]|exact_length[10]');
        $this->form_validation->set_rules('cliente_endereco', '', 'trim|required|min_length[4]|max_length[155]');
        $this->form_validation->set_rules('cliente_numero_endereco', '', 'trim|max_length[20]');
        $this->form_validation->set_rules('cliente_bairro', '', 'trim|required|min_length[4]|max_length[45]');
        $this->form_validation->set_rules('cliente_complemento', '', 'trim|min_length[4]|max_length[145]');
        $this->form_validation->set_rules('cliente_cidade', '', 'trim|required|min_length[4]|max_length[105]');
        $this->form_validation->set_rules('cliente_estado', '', 'trim|required|exact_length[2]');
        $this->form_validation->set_rules('cliente_obs', '', 'max_length[500]');

        if ($this->form_validation->run()) {

            $data = elements(
                    array(
                        'cliente_nome',
                        'cliente_sobrenome',
                        'cliente_data_nascimento',
                        'cliente_rg_ie',
                        'cliente_email',
                        'cliente_telefone',
                        'cliente_celular',
                        'cliente_endereco',
                        'cliente_numero_endereco',
                        'cliente_complemento',
                        'cliente_bairro',
                        'cliente_cidade',
                        'cliente_cep',
                        'cliente_ativo',
                        'cliente_obs',
                        'cliente_tipo'
                    ), $this->input->post()
            );
            if ($cliente_tipo == 1) {
                $data['cliente_cpf_cnpj'] = $this->input->post('cliente_cpf');
            } else {
                $data['cliente_cpf_cnpj'] = $this->input->post('cliente_cnpj');
            }

            $data['cliente_estado'] = strtoupper($this->input->post('cliente_estado'));

            $data = html_escape($data);

            $this->core_model->insert('clientes', $data);
            redirect('clientes');

            //echo'<pre>';
            //print_r($data);
            //exit();
        } else {
            //erro de validação
            $data = array(
                'titulo' => 'Cadastrar Cliente',
                'scripts' => array(
                    '/vendor/mask/jquery.mask.min.js',
                    '/vendor/mask/app.js',
                    'js/clientes.js',
                ),
            );

            //echo'<pre>';
            //print_r($data['cliente']);
            //exit();

            $this->load->view('layout/header', $data);
            $this->load->view('clientes/add');
            $this->load->view('layout/footer');
        }
    }

    public function edit($cliente_id = NULL) {

        if (!$cliente_id || !$this->core_model->get_by_id('clientes', array('cliente_id' => $cliente_id))) {

            $this->session->set_flashdata('error', 'Cliente não encontrado!');
            redirect('clientes');
        } else {

            $this->form_validation->set_rules('cliente_nome', '', 'trim|required|min_length[4]|max_length[45]');
            $this->form_validation->set_rules('cliente_sobrenome', '', 'trim|required|min_length[4]|max_length[150]');
            $this->form_validation->set_rules('cliente_data_nascimento', '', 'required');

            $this->form_validation->set_rules('cliente_cpf_cnpj', '', 'trim|min_length[4]|max_length[20]');

            $cliente_tipo = $this->input->post('cliente_tipo');

            if ($cliente_tipo == 1) {
                $this->form_validation->set_rules('cliente_cpf', 'cliente_cpf', 'exact_length[14]|callback_valida_cpf');
            } else {
                $this->form_validation->set_rules('cliente_cnpj', 'cliente_cnpj', 'exact_length[18]|callback_valida_cnpj');
            }

            $this->form_validation->set_rules('cliente_rg_ie', '', 'trim|min_length[4]|max_length[20]|callback_check_rg_ie');
            $this->form_validation->set_rules('cliente_email', '', 'trim|required|valid_email|max_length[50]|callback_check_email');
            $this->form_validation->set_rules('cliente_cep', '', 'trim|min_length[4]|exact_length[10]');
            $this->form_validation->set_rules('cliente_endereco', '', 'trim|required|min_length[4]|max_length[155]');
            $this->form_validation->set_rules('cliente_numero_endereco', '', 'trim|max_length[20]');
            $this->form_validation->set_rules('cliente_bairro', '', 'trim|required|min_length[4]|max_length[45]');
            $this->form_validation->set_rules('cliente_complemento', '', 'trim|min_length[4]|max_length[145]');
            $this->form_validation->set_rules('cliente_cidade', '', 'trim|required|min_length[4]|max_length[105]');
            $this->form_validation->set_rules('cliente_estado', '', 'trim|required|exact_length[2]');
            $this->form_validation->set_rules('cliente_obs', '', 'max_length[500]');

            if (!empty($this->input->post('cliente_telefone'))) {
                $this->form_validation->set_rules('cliente_telefone', '', 'trim|max_length[15]|callback_check_telefone');
            }

            if (!empty($this->input->post('cliente_celular'))) {
                $this->form_validation->set_rules('cliente_celular', '', 'trim|max_length[16]|callback_check_celular');
            }


            if ($this->form_validation->run()) {
                
                $cliente_ativo = $this->input->post('cliente_ativo');
                
                if($this->db->table_exists('contas_receber')){
                    
                    if($cliente_ativo == 0 && $this->core_model->get_by_id('contas_receber', array('conta_receber_cliente_id' =>$cliente_id, 'conta_receber_status' => 0))){
                        $this->session->set_flashdata('error', 'Este Cliente está em uso em CONTAS A RECEBER e não pode ser desativado!');
                        redirect('receber');
                        
                    }
                }

                $data = elements(
                        array(
                            'cliente_nome',
                            'cliente_sobrenome',
                            'cliente_data_nascimento',
                            'cliente_rg_ie',
                            'cliente_email',
                            'cliente_telefone',
                            'cliente_celular',
                            'cliente_endereco',
                            'cliente_numero_endereco',
                            'cliente_complemento',
                            'cliente_bairro',
                            'cliente_cidade',
                            'cliente_cep',
                            'cliente_ativo',
                            'cliente_obs',
                            'cliente_tipo'
                        ), $this->input->post()
                );
                if ($cliente_tipo == 1) {
                    $data['cliente_cpf_cnpj'] = $this->input->post('cliente_cpf');
                } else {
                    $data['cliente_cpf_cnpj'] = $this->input->post('cliente_cnpj');
                }

                $data['cliente_estado'] = strtoupper($this->input->post('cliente_estado'));

                $data = html_escape($data);

                $this->core_model->update('clientes', $data, array('cliente_id' => $cliente_id));
                redirect('clientes');

                //echo'<pre>';
                //print_r($data);
                //exit();
            } else {
                //erro de validação
                $data = array(
                    'titulo' => 'Atualizar Cliente',
                    'scripts' => array(
                        '/vendor/mask/jquery.mask.min.js',
                        '/vendor/mask/app.js',
                    ),
                    'cliente' => $this->core_model->get_by_id('clientes', array('cliente_id' => $cliente_id)),
                );

                //echo'<pre>';
                //print_r($data['cliente']);
                //exit();

                $this->load->view('layout/header', $data);
                $this->load->view('clientes/edit');
                $this->load->view('layout/footer');
            }
        }
    }
    
    public function del($cliente_id = NULL) {

        if(!$cliente_id || !$this->core_model->get_by_id('clientes', array('cliente_id' => $cliente_id))){
            $this->session->set_flashdata('error', 'Cliente não encontrado');
            redirect('clientes');
        }else{
            
            $this->core_model->delete('clientes', array('cliente_id' =>$cliente_id));
            redirect('clientes');
        }
        
    }

    public function check_rg_ie($cliente_rg_ie) {
        $cliente_id = $this->input->post('cliente_id');

        if ($this->core_model->get_by_id('clientes', array('cliente_rg_ie' => $cliente_rg_ie, 'cliente_id !=' => $cliente_id))) {
            $this->form_validation->set_message('check_rg_ie', 'Já existe um cliente cadastrado com esse documento!');
            return FALSE;
        } else {

            return TRUE;
        }
    }

    public function check_email($cliente_email) {
        $cliente_id = $this->input->post('cliente_id');

        if ($this->core_model->get_by_id('clientes', array('cliente_email' => $cliente_email, 'cliente_id !=' => $cliente_id))) {
            $this->form_validation->set_message('check_email', 'Já existe um cliente cadastrado com esse E-mail!');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function check_telefone($cliente_telefone) {
        $cliente_id = $this->input->post('cliente_id');

        if ($this->core_model->get_by_id('clientes', array('cliente_telefone' => $cliente_telefone, 'cliente_id !=' => $cliente_id))) {
            $this->form_validation->set_message('check_telefone', 'Já existe um cliente cadastrado com esse Telefone!');
            return FALSE;
        } else {

            return TRUE;
        }
    }

    public function check_celular($cliente_celular) {
        $cliente_id = $this->input->post('cliente_id');

        if ($this->core_model->get_by_id('clientes', array('cliente_celular' => $cliente_celular, 'cliente_id !=' => $cliente_id))) {
            $this->form_validation->set_message('check_celular', 'Já existe um cliente cadastrado com esse Celular!');
            return FALSE;
        } else {

            return TRUE;
        }
    }

    public function valida_cpf($cliente_cpf) {

        if ($this->input->post('cliente_id')) {

            $cliente_id = $this->input->post('cliente_id');

            if ($this->core_model->get_by_id('clientes', array('cliente_id !=' => $cliente_id, 'cliente_cpf_cnpj' => $cliente_cpf))) {
                $this->form_validation->set_message('valida_cpf', 'Este CPF já existe');
                return FALSE;
            }
        }

        $cliente_cpf = str_pad(preg_replace('/[^0-9]/', '', $cliente_cpf), 11, '0', STR_PAD_LEFT);
// Verifica se nenhuma das sequências abaixo foi digitada, caso seja, retorna falso
        if (strlen($cliente_cpf) != 11 || $cliente_cpf == '00000000000' || $cliente_cpf == '11111111111' || $cliente_cpf == '22222222222' || $cliente_cpf == '33333333333' || $cliente_cpf == '44444444444' || $cliente_cpf == '55555555555' || $cliente_cpf == '66666666666' || $cliente_cpf == '77777777777' || $cliente_cpf == '88888888888' || $cliente_cpf == '99999999999') {

            $this->form_validation->set_message('valida_cpf', 'Por favor digite um CPF válido');
            return FALSE;
        } else {
// Calcula os números para verificar se o CPF é verdadeiro
            for ($t = 9; $t < 11; $t++) {
                for ($d = 0, $c = 0; $c < $t; $c++) {
                    //$d += $cliente_cpf{$c} * (($t + 1) - $c); // Para PHP com versão < 7.4
                    $d += $cliente_cpf[$c] * (($t + 1) - $c);
                    //Para PHP com versão < 7.4
                }
                $d = ((10 * $d) % 11) % 10;
                if ($cliente_cpf[$c] != $d) {
                    $this->form_validation->set_message('valida_cpf', 'Por favor digite um CPF válido');
                    return FALSE;
                }
            }
            return TRUE;
        }
    }

    public function valida_cnpj($cliente_cnpj) {

// Verifica se um número foi informado
        if (empty($cliente_cnpj)) {
            $this->form_validation->set_message('valida_cnpj', 'Por favor digite um CNPJ válido');
            return false;
        }

        if ($this->input->post('cliente_id')) {

            $cliente_id = $this->input->post('cliente_id');

            if ($this->core_model->get_by_id('clientes', array('cliente_id !=' => $cliente_id, 'cliente_cpf_cnpj' => $cliente_cnpj))) {
                $this->form_validation->set_message('valida_cnpj', 'Já existe um cliente cadastrado com esse CPF!');
                return FALSE;
            }
        }

// Elimina possivel mascara
        $cliente_cnpj = preg_replace("/[^0-9]/", "", $cliente_cnpj);
        $cliente_cnpj = str_pad($cliente_cnpj, 14, '0', STR_PAD_LEFT);


// Verifica se o numero de digitos informados é igual a 11 
        if (strlen($cliente_cnpj) != 14) {
            $this->form_validation->set_message('valida_cnpj', 'Por favor digite um CNPJ válido');
            return false;
        }

// Verifica se nenhuma das sequências invalidas abaixo 
// foi digitada. Caso afirmativo, retorna falso
        else if ($cliente_cnpj == '00000000000000' ||
                $cliente_cnpj == '11111111111111' ||
                $cliente_cnpj == '22222222222222' ||
                $cliente_cnpj == '33333333333333' ||
                $cliente_cnpj == '44444444444444' ||
                $cliente_cnpj == '55555555555555' ||
                $cliente_cnpj == '66666666666666' ||
                $cliente_cnpj == '77777777777777' ||
                $cliente_cnpj == '88888888888888' ||
                $cliente_cnpj == '99999999999999') {
            $this->form_validation->set_message('valida_cnpj', 'Por favor digite um CNPJ válido');
            return false;

// Calcula os digitos verificadores para verificar se o
// CPF é válido
        } else {

            $j = 5;
            $k = 6;
            $soma1 = "";
            $soma2 = "";

            for ($i = 0; $i < 13; $i++) {

                $j = $j == 1 ? 9 : $j;
                $k = $k == 1 ? 9 : $k;

                //$soma2 += ($cliente_cnpj{$i} * $k);
                //$soma2 = intval($soma2) + ($cliente_cnpj{$i} * $k); //Para PHP com versão < 7.4
                $soma2 = intval($soma2) + ($cliente_cnpj[$i] * $k); //Para PHP com versão > 7.4

                if ($i < 12) {
                    //$soma1 = intval($soma1) + ($cliente_cnpj{$i} * $j); //Para PHP com versão < 7.4
                    $soma1 = intval($soma1) + ($cliente_cnpj[$i] * $j); //Para PHP com versão > 7.4
                }

                $k--;
                $j--;
            }

            $digito1 = $soma1 % 11 < 2 ? 0 : 11 - $soma1 % 11;
            $digito2 = $soma2 % 11 < 2 ? 0 : 11 - $soma2 % 11;

            if (!($cliente_cnpj[12] == $digito1) and ( $cliente_cnpj[13] == $digito2)) {
                $this->form_validation->set_message('valida_cnpj', 'Por favor digite um CNPJ válido');
                return false;
            } else {
                return true;
            }
        }
    }

}
