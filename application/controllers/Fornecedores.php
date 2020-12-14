<?php

defined('BASEPATH') OR exit('Ação não permitida!');

class Fornecedores extends CI_Controller {

    public function __construct() {
        parent::__construct();

        if (!$this->ion_auth->logged_in()) {
            $this->session->set_flashdata('info', 'Sua sessão expirou!');
            redirect('login');
        }
    }

    public function index() {

        $data = array(
            'titulo' => 'Fornecedores Cadastrados',
            'styles' => array(
                'vendor/datatables/dataTables.bootstrap4.min.css',
            ),
            'scripts' => array(
                'vendor/datatables/jquery.dataTables.min.js',
                'vendor/datatables/dataTables.bootstrap4.min.js',
                'vendor/datatables/app.js'
            ),
            'fornecedores' => $this->core_model->get_all('fornecedores'), // Pegar todos os fornecedores        
        );

        //echo'<pre>';
        // print_r($data['fornecedores']);
        //exit();

        $this->load->view('layout/header', $data);
        $this->load->view('fornecedores/index');
        $this->load->view('layout/footer');
    }

    public function add() {
        $this->form_validation->set_rules('fornecedor_razao', '', 'trim|required|min_length[4]|max_length[200]');
        $this->form_validation->set_rules('fornecedor_nome_fantasia', '', 'trim|required|min_length[4]|max_length[145]');
        $this->form_validation->set_rules('fornecedor_cnpj', '', 'trim|min_length[4]|max_length[20]|is_unique[fornecedores.fornecedor_cnpj]');
        $this->form_validation->set_rules('fornecedor_ie', '', 'trim|min_length[4]|max_length[20]|is_unique[fornecedores.fornecedor_ie]');
        if (!empty($this->input->post('fornecedor_telefone'))) {
            $this->form_validation->set_rules('fornecedor_telefone', '', 'trim|max_length[15]|is_unique[fornecedores.fornecedor_telefone]');
        }
        if (!empty($this->input->post('fornecedor_celular'))) {
            $this->form_validation->set_rules('fornecedor_celular', '', 'trim|max_length[16]|is_unique[fornecedores.fornecedor_celular]');
        }
        $this->form_validation->set_rules('fornecedor_email', '', 'trim|required|valid_email|max_length[100]|is_unique[fornecedores.fornecedor_email]');
        $this->form_validation->set_rules('fornecedor_contato', '', 'trim|min_length[4]|max_length[45]');
        $this->form_validation->set_rules('fornecedor_cep', '', 'trim|min_length[4]|exact_length[10]');
        $this->form_validation->set_rules('fornecedor_endereco', '', 'trim|required|min_length[4]|max_length[155]');
        $this->form_validation->set_rules('fornecedor_numero_endereco', '', 'trim|max_length[20]');
        $this->form_validation->set_rules('fornecedor_bairro', '', 'trim|required|min_length[4]|max_length[45]');
        $this->form_validation->set_rules('fornecedor_complemento', '', 'trim|min_length[4]|max_length[145]');
        $this->form_validation->set_rules('fornecedor_cidade', '', 'trim|required|min_length[4]|max_length[105]');
        $this->form_validation->set_rules('fornecedor_estado', '', 'trim|required|exact_length[2]');
        $this->form_validation->set_rules('fornecedor_obs', '', 'max_length[500]');

        if ($this->form_validation->run()) {

            $data = elements(
                    array(
                        'fornecedor_razao',
                        'fornecedor_nome_fantasia',
                        'fornecedor_cnpj',
                        'fornecedor_ie',
                        'fornecedor_telefone',
                        'fornecedor_celular',
                        'fornecedor_email',
                        'fornecedor_contato',
                        'fornecedor_cep',
                        'fornecedor_endereco',
                        'fornecedor_numero_endereco',
                        'fornecedor_bairro',
                        'fornecedor_complemento',
                        'fornecedor_cidade',
                        'fornecedor_ativo',
                        'fornecedor_obs',
                    ), $this->input->post()
            );

            $data['fornecedor_estado'] = strtoupper($this->input->post('fornecedor_estado'));

            $data = html_escape($data);

            $this->core_model->insert('fornecedores', $data);
            redirect('fornecedores');

            //echo'<pre>';
            //print_r($data);
            //exit();
        } else {
            //erro de validação
            $data = array(
                'titulo' => 'Cadastrar Fornecedor',
                'scripts' => array(
                    '/vendor/mask/jquery.mask.min.js',
                    '/vendor/mask/app.js',
                    'js/fornecedores.js',
                ),
            );

            //echo'<pre>';
            //print_r($data['fornecedor']);
            //exit();

            $this->load->view('layout/header', $data);
            $this->load->view('fornecedores/add');
            $this->load->view('layout/footer');
        }
    }

    public function edit($fornecedor_id = NULL) {

        if (!$fornecedor_id || !$this->core_model->get_by_id('fornecedores', array('fornecedor_id' => $fornecedor_id))) {

            $this->session->set_flashdata('error', 'Fornecedor não encontrado!');
            redirect('fornecedores');
        } else {

            /*
              [fornecedor_razao] => fulano de tal ME
              [fornecedor_nome_fantasia] => bing ball
              [fornecedor_cnpj] => 08.992.623/0001-00
              [fornecedor_ie] =>
              [fornecedor_telefone] => (88) 3512-2545
              [fornecedor_celular] =>
              [fornecedor_email] => fulano@gmail.com
              [fornecedor_contato] =>
              [fornecedor_cep] =>
              [fornecedor_endereco] =>
              [fornecedor_numero_endereco] =>
              [fornecedor_bairro] =>
              [fornecedor_complemento] =>
              [fornecedor_cidade] =>
              [fornecedor_estado] =>
              [fornecedor_ativo] => 1
              [fornecedor_obs] =>
             * */

            $this->form_validation->set_rules('fornecedor_razao', '', 'trim|required|min_length[4]|max_length[200]|callback_check_razao_social');
            $this->form_validation->set_rules('fornecedor_nome_fantasia', '', 'trim|required|min_length[4]|max_length[150]|callback_check_nome_fantasia');
            $this->form_validation->set_rules('fornecedor_cnpj', 'fornecedor_cnpj', 'exact_length[18]|callback_valida_cnpj');
            $this->form_validation->set_rules('fornecedor_ie', '', 'trim|min_length[4]|max_length[20]|callback_check_fornecedor_ie');
            $this->form_validation->set_rules('fornecedor_email', '', 'trim|required|valid_email|max_length[50]|callback_check_fornecedor_email');
            $this->form_validation->set_rules('fornecedor_cep', '', 'trim|min_length[4]|exact_length[10]');
            $this->form_validation->set_rules('fornecedor_endereco', '', 'trim|required|min_length[4]|max_length[155]');
            $this->form_validation->set_rules('fornecedor_numero_endereco', '', 'trim|max_length[20]');
            $this->form_validation->set_rules('fornecedor_bairro', '', 'trim|required|min_length[4]|max_length[45]');
            $this->form_validation->set_rules('fornecedor_complemento', '', 'trim|min_length[4]|max_length[145]');
            $this->form_validation->set_rules('fornecedor_cidade', '', 'trim|required|min_length[4]|max_length[105]');
            $this->form_validation->set_rules('fornecedor_estado', '', 'trim|required|exact_length[2]');
            $this->form_validation->set_rules('fornecedor_obs', '', 'max_length[500]');
            $this->form_validation->set_rules('fornecedor_telefone', '', 'trim|max_length[15]|callback_check_fornecedor_telefone');
            $this->form_validation->set_rules('fornecedor_celular', '', 'trim|required|max_length[16]|callback_check_fornecedor_celular');

            if ($this->form_validation->run()) {
                $data = elements(
                        array(
                            'fornecedor_razao',
                            'fornecedor_nome_fantasia',
                            'fornecedor_cnpj',
                            'fornecedor_ie',
                            'fornecedor_telefone',
                            'fornecedor_celular',
                            'fornecedor_email',
                            'fornecedor_contato',
                            'fornecedor_cep',
                            'fornecedor_endereco',
                            'fornecedor_numero_endereco',
                            'fornecedor_bairro',
                            'fornecedor_cidade',
                            'fornecedor_estado',
                            'fornecedor_ativo',
                            'fornecedor_obs'
                        ), $this->input->post()
                );
               
                $data['fornecedor_estado'] = strtoupper($this->input->post('fornecedor_estado'));

                $data = html_escape($data);

                $this->core_model->update('fornecedores', $data, array('fornecedor_id' =>$fornecedor_id));
                redirect('fornecedores');
            } else {

                $data = array(
                    'titulo' => 'Atualizar Fornecedor',
                    'scripts' => array(
                        '/vendor/mask/jquery.mask.min.js',
                        '/vendor/mask/app.js',
                    ),
                    'fornecedor' => $this->core_model->get_by_id('fornecedores', array('fornecedor_id' => $fornecedor_id)),
                );

                //echo'<pre>';
                //print_r($data['fornecedor']);
                //exit();

                $this->load->view('layout/header', $data);
                $this->load->view('fornecedores/edit');
                $this->load->view('layout/footer');
            }
        }
    }

    public function del($fornecedor_id = NULL) {

        if (!$fornecedor_id || !$this->core_model->get_by_id('fornecedores', array('fornecedor_id' => $fornecedor_id))) {
            $this->session->set_flashdata('error', 'Cliente não encontrado');
            redirect('fornecedores');
        } else {

            $this->core_model->delete('fornecedores', array('fornecedor_id' => $fornecedor_id));
            redirect('fornecedores');
        }
    }

    public function check_ie($fornecedor_ie) {
        $fornecedor_id = $this->input->post('fornecedor_id');

        if ($this->core_model->get_by_id('fornecedores', array('fornecedor_ie' => $fornecedor_ie, 'fornecedor_id !=' => $fornecedor_id))) {
            $this->form_validation->set_message('check_ie', 'Já existe um fornecedor cadastrado com essa inscrição estadual!');
            return FALSE;
        } else {

            return TRUE;
        }
    }

    public function check_fornecedor_email($fornecedor_email) {
        $fornecedor_id = $this->input->post('fornecedor_id');

        if ($this->core_model->get_by_id('fornecedores', array('fornecedor_email' => $fornecedor_email, 'fornecedor_id !=' => $fornecedor_id))) {
            $this->form_validation->set_message('check_fornecedor_email', 'Já existe um fornecedor cadastrado com esse E-mail!');
            return FALSE;
        } else {

            return TRUE;
        }
    }

    public function check_fornecedor_telefone($fornecedor_telefone) {
        $fornecedor_id = $this->input->post('fornecedor_id');

        if ($this->core_model->get_by_id('fornecedores', array('fornecedor_telefone' => $fornecedor_telefone, 'fornecedor_id !=' => $fornecedor_id))) {
            $this->form_validation->set_message('check_fornecedor_telefone', 'Já existe um fornecedor cadastrado com esse Telefone!');
            return FALSE;
        } else {

            return TRUE;
        }
    }

    public function check_fornecedor_celular($fornecedor_celular) {
        $fornecedor_id = $this->input->post('fornecedor_id');

        if ($this->core_model->get_by_id('fornecedores', array('fornecedor_celular' => $fornecedor_celular, 'fornecedor_id !=' => $fornecedor_id))) {
            $this->form_validation->set_message('check_fornecedor_celular', 'Já existe um fornecedor cadastrado com esse Celular!');
            return FALSE;
        } else {

            return TRUE;
        }
    }

    public function valida_cnpj($fornecedor_cnpj) {

// Verifica se um número foi informado
        if (empty($fornecedor_cnpj)) {
            $this->form_validation->set_message('valida_cnpj', 'Por favor digite um CNPJ válido');
            return false;
        }

        if ($this->input->post('fornecedor_id')) {

            $fornecedor_id = $this->input->post('fornecedor_id');

            if ($this->core_model->get_by_id('fornecedores', array('fornecedor_id !=' => $fornecedor_id, 'fornecedor_cnpj' => $fornecedor_cnpj))) {
                $this->form_validation->set_message('valida_cnpj', 'Já existe um fornecedor cadastrado com esse CPF!');
                return FALSE;
            }
        }

// Elimina possivel mascara
        $fornecedor_cnpj = preg_replace("/[^0-9]/", "", $fornecedor_cnpj);
        $fornecedor_cnpj = str_pad($fornecedor_cnpj, 14, '0', STR_PAD_LEFT);


// Verifica se o numero de digitos informados é igual a 11 
        if (strlen($fornecedor_cnpj) != 14) {
            $this->form_validation->set_message('valida_cnpj', 'Por favor digite um CNPJ válido');
            return false;
        }

// Verifica se nenhuma das sequências invalidas abaixo 
// foi digitada. Caso afirmativo, retorna falso
        else if ($fornecedor_cnpj == '00000000000000' ||
                $fornecedor_cnpj == '11111111111111' ||
                $fornecedor_cnpj == '22222222222222' ||
                $fornecedor_cnpj == '33333333333333' ||
                $fornecedor_cnpj == '44444444444444' ||
                $fornecedor_cnpj == '55555555555555' ||
                $fornecedor_cnpj == '66666666666666' ||
                $fornecedor_cnpj == '77777777777777' ||
                $fornecedor_cnpj == '88888888888888' ||
                $fornecedor_cnpj == '99999999999999') {
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

                //$soma2 += ($fornecedor_cnpj{$i} * $k);
                //$soma2 = intval($soma2) + ($fornecedor_cnpj{$i} * $k); //Para PHP com versão < 7.4
                $soma2 = intval($soma2) + ($fornecedor_cnpj[$i] * $k); //Para PHP com versão > 7.4

                if ($i < 12) {
                    //$soma1 = intval($soma1) + ($fornecedor_cnpj{$i} * $j); //Para PHP com versão < 7.4
                    $soma1 = intval($soma1) + ($fornecedor_cnpj[$i] * $j); //Para PHP com versão > 7.4
                }

                $k--;
                $j--;
            }

            $digito1 = $soma1 % 11 < 2 ? 0 : 11 - $soma1 % 11;
            $digito2 = $soma2 % 11 < 2 ? 0 : 11 - $soma2 % 11;

            if (!($fornecedor_cnpj[12] == $digito1) and ( $fornecedor_cnpj[13] == $digito2)) {
                $this->form_validation->set_message('valida_cnpj', 'Por favor digite um CNPJ válido');
                return false;
            } else {
                return true;
            }
        }
    }

    public function check_razao_social($fornecedor_razao) {
        $fornecedor_id = $this->input->post('fornecedor_id');

        if ($this->core_model->get_by_id('fornecedores', array('fornecedor_razao' => $fornecedor_razao, 'fornecedor_id !=' => $fornecedor_id))) {
            $this->form_validation->set_message('check_razao_social', 'Já existe um fornecedor cadastrado com essa razão social!');
            return FALSE;
        } else {

            return TRUE;
        }
    }

    public function check_nome_fantasia($fornecedor_nome_fantasia) {
        $fornecedor_id = $this->input->post('fornecedor_id');

        if ($this->core_model->get_by_id('fornecedores', array('fornecedor_nome_fantasia' => $fornecedor_nome_fantasia, 'fornecedor_id !=' => $fornecedor_id))) {
            $this->form_validation->set_message('check_nome_fantasia', 'Já existe um fornecedor cadastrado com esse nome fantasia!');
            return FALSE;
        } else {

            return TRUE;
        }
    }

    public function check_fornecedor_ie($fornecedor_ie) {
        $fornecedor_id = $this->input->post('fornecedor_id');

        if ($this->core_model->get_by_id('fornecedores', array('fornecedor_nome_fantasia' => $fornecedor_ie, 'fornecedor_id !=' => $fornecedor_id))) {
            $this->form_validation->set_message('check_fornecedor_ie', 'Já existe um fornecedor cadastrado com esse nome fantasia!');
            return FALSE;
        } else {

            return TRUE;
        }
    }

}
