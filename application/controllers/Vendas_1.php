<?php

defined('BASEPATH') OR exit('Ação não permitida!');

class Vendas extends CI_Controller {

    public function __construct() {
        parent::__construct();

        if (!$this->ion_auth->logged_in()) {
            $this->session->set_flashdata('info', 'Sua sessão expirou!');
            redirect('login');
        }

        $this->load->model('vendas_model');
    }

    public function index() {

        $data = array(
            'titulo' => 'Vendas Cadastradas',
            'styles' => array(
                'vendor/datatables/dataTables.bootstrap4.min.css',
            ),
            'scripts' => array(
                'vendor/datatables/jquery.dataTables.min.js',
                'vendor/datatables/dataTables.bootstrap4.min.js',
                'vendor/datatables/app.js'
            ),
            'vendas' => $this->vendas_model->get_all(), // Pegar todos as vendas      
        );

        //echo'<pre>';
        //print_r($data['vendas']);
        //exit();

        $this->load->view('layout/header', $data);
        $this->load->view('vendas/index');
        $this->load->view('layout/footer');
    }

    public function add() {


        //Validação de Formulário
        $this->form_validation->set_rules('ordem_produto_cliente_id', '', 'required');
        $this->form_validation->set_rules('ordem_produto_equipamento', 'Equipamento', 'trim|required|min_length[2]|max_length[80]');
        $this->form_validation->set_rules('ordem_produto_marca_equipamento_id', 'Marca', 'trim|required|min_length[2]|max_length[80]');
        $this->form_validation->set_rules('ordem_produto_modelo_equipamento', 'Modelo', 'trim|required|min_length[2]|max_length[80]');
        $this->form_validation->set_rules('ordem_produto_acessorios', 'Acessórios', 'trim|required|min_length[2]|max_length[200]');
        $this->form_validation->set_rules('ordem_produto_defeito', 'Defeito', 'trim|required|max_length[700]');
        $this->form_validation->set_rules('ordem_produto_obs', 'Observações', 'trim|min_length[5]|max_length[500]');

        if ($this->form_validation->run()) {



            $ordem_produto_valor_total = str_replace('R$', "", trim($this->input->post('ordem_produto_valor_total')));

            $data = elements(
                    array(
                        'ordem_produto_cliente_id',
                        'ordem_produto_status',
                        'ordem_produto_equipamento',
                        'ordem_produto_marca_equipamento_id',
                        'ordem_produto_modelo_equipamento',
                        'ordem_produto_defeito',
                        'ordem_produto_acessorios',
                        'ordem_produto_obs',
                        'ordem_produto_valor_desconto',
                        'ordem_produto_valor_total',
                    ), $this->input->post()
            );

            $data['ordem_produto_valor_total'] = trim(preg_replace('/\$/', '', $ordem_produto_valor_total));

            $data = html_escape($data);

            $this->core_model->insert('vendas', $data, TRUE);

            //recuperar ID

            $id_ordem_servico = $this->session->userdata('last_id');

            $produto_id = $this->input->post('produto_id');
            $produto_quantidade = $this->input->post('produto_quantidade');
            $produto_desconto = str_replace('%', '', $this->input->post('produto_desconto'));

            $produto_preco = str_replace('R$', '', $this->input->post('produto_preco'));
            $produto_item_total = str_replace('R$', '', $this->input->post('produto_item_total'));

            $produto_preco = str_replace(',', '', $produto_preco);
            $produto_item_total = str_replace('R$', '', $produto_item_total);

            $qty_servico = count($produto_id);

            $venda_id = $this->input->post('venda_id');

            for ($i = 0; $i < $qty_servico; $i++) {

                $data = array(
                    'ordem_ts_id_ordem_servico' => $id_ordem_servico,
                    'ordem_ts_id_servico' => $produto_id[$i],
                    'ordem_ts_quantidade' => $produto_quantidade[$i],
                    'ordem_ts_valor_unitario' => $produto_preco[$i],
                    'ordem_ts_valor_desconto' => $produto_desconto[$i],
                    'ordem_ts_valor_total' => $produto_item_total[$i],
                );

                $data = html_escape($data);

                $this->core_model->insert('ordem_tem_servicos', $data);
            }
            //criar recurso PDF

            redirect('ordem_servicos/imprimir/' . $id_ordem_servico);
        } else {

            //erro de validação
            $data = array(
                'titulo' => 'Cadastrar Ordem de Serviço',
                'styles' => array(
                    'vendor/select2/select2.min.css',
                    'vendor/autocomplete/jquery-ui.css',
                    'vendor/autocomplete/estilo.css',
                ),
                'scripts' => array(
                    'vendor/autocomplete/jquery-migrate.js',
                    'vendor/calcx/jquery-calx-sample-2.2.8.min.js',
                    'vendor/calcx/os.js',
                    'vendor/select2/select2.min.js',
                    'vendor/select2/app.js',
                    'vendor/sweetalert2/sweetalert2.js',
                    'vendor/autocomplete/jquery-ui.js',
                ),
                'clientes' => $this->core_model->get_all('clientes', array('cliente_ativo' => 1)),
                'marcas' => $this->core_model->get_all('marcas', array('marca_ativa' => 1)),
            );

            $this->load->view('layout/header', $data);
            $this->load->view('ordem_servicos/add');
            $this->load->view('layout/footer');
        }
    }

    public function edit($venda_id = NULL) {

        if (!$venda_id || !$this->core_model->get_by_id('vendas', array('venda_id' => $venda_id))) {

            $this->session->set_flashdata('error', 'Venda não encontrada!');
            redirect('vendas');
        } else {

            $venda_produtos = $this->vendas_model->get_all_produtos_by_venda($venda_id);


            //Validação de Formulário

            $this->form_validation->set_rules('venda_cliente_id', '', 'required');
            $this->form_validation->set_rules('venda_tipo', '', 'required');
            $this->form_validation->set_rules('venda_forma_pagamento_id', '', 'required');

            if ($this->form_validation->run()) {

                $venda_valor_total = str_replace('R$', "", trim($this->input->post('venda_valor_total')));

                $data = elements(
                        array(
                            'venda_cliente_id',
                            'venda_forma_pagamento_id',
                            'venda_tipo',
                            'venda_vendedor_id',
                            'venda_valor_desconto',
                            'venda_valor_total',
                        ), $this->input->post()
                );

                $data['venda_valor_total'] = trim(preg_replace('/\$/', '', $venda_valor_total));

                $data = html_escape($data);

                $this->core_model->update('vendas', $data, array('venda_id' => $venda_id));

                /* deletando da venda, os produtos antigos da venda editada */
                $this->vendas_model->delete_old_products($venda_id);

                $produto_id = $this->input->post('produto_id');
                $produto_quantidade = $this->input->post('produto_quantidade');
                $produto_desconto = str_replace('%', '', $this->input->post('produto_desconto'));

                $produto_preco_venda = str_replace('R$', '', $this->input->post('produto_preco_venda'));
                $produto_item_total = str_replace('R$', '', $this->input->post('produto_item_total'));

                $produto_preco_venda = str_replace(',', '', $produto_preco_venda);
                $produto_item_total = str_replace('R$', '', $produto_item_total);

                $qty_produto = count($produto_id);

//                $venda_id = $this->input->post('venda_id');

                for ($i = 0; $i < $qty_produto; $i++) {

                    $data = array(
                        'venda_produto_id_venda' => $venda_id,
                        'venda_produto_id_produto' => $produto_id[$i],
                        'venda_produto_quantidade' => $produto_quantidade[$i],
                        'venda_produto_valor_unitario' => $produto_preco_venda[$i],
                        'venda_produto_valor_desconto' => $produto_desconto[$i],
                        'venda_produto_valor_total' => $produto_item_total[$i],
                    );

                    $data = html_escape($data);

                    $this->core_model->insert('venda_produtos', $data);
                }
//                criar recurso PDF
//
//                redirect('vendas/imprimir/' . $venda_id);
                redirect('vendas');
            } else {

                //echo '<pre>';
                //print_r($this->input->post());
                //exit();
                //erro de validação
                $data = array(
                    'titulo' => 'Atualizar Venda',
                    'styles' => array(
                        'vendor/select2/select2.min.css',
                        'vendor/autocomplete/jquery-ui.css',
                        'vendor/autocomplete/estilo.css',
                    ),
                    'scripts' => array(
                        'vendor/autocomplete/jquery-migrate.js',
                        'vendor/calcx/jquery-calx-sample-2.2.8.min.js',
                        'vendor/calcx/venda.js',
                        'vendor/select2/select2.min.js',
                        'vendor/select2/app.js',
                        'vendor/sweetalert2/sweetalert2.js',
                        'vendor/autocomplete/jquery-ui.js',
                    ),
                    'clientes' => $this->core_model->get_all('clientes', array('cliente_ativo' => 1)),
                    'formas_pagamentos' => $this->core_model->get_all('formas_pagamentos', array('forma_pagamento_ativa' => 1)),
                    'venda_produtos' => $this->core_model->get_all('venda_produtos', array('venda_produto_id_venda' => $venda_produto_id_venda)),
                    'vendedores' => $this->core_model->get_all('vendedores', array('vendedor_ativo' => 1)),
                );



                $venda = $data['venda'] = $this->vendas_model->get_by_id($venda_id);
                $vendas = $data['vendas'] = $this->vendas_model->get_by_id($venda_id);

//                $venda_produtos = $this->vendas_model->get_all_produtos_by_venda($venda_id);

                $this->load->view('layout/header', $data);
                $this->load->view('vendas/edit');
                $this->load->view('layout/footer');
            }
        }
    }

    public function del($venda_id = NULL) {
        if (!$venda_id || !$this->core_model->get_by_id('vendas', array('venda_id' => $venda_id))) {

            $this->session->set_flashdata('error', 'Ordem de serviço não encontrada!');
            redirect('ordem_servicos');
        }

        if ($this->core_model->get_by_id('vendas', array('venda_id' => $venda_id, 'ordem_produto_status' => 0))) {

            $this->session->set_flashdata('error', 'Não é possivel excluir uma ordem de serviço em aberto !');
            redirect('ordem_servicos');
        }

        $this->core_model->delete('vendas', array('venda_id' => $venda_id));
        redirect('ordem_servicos');
    }

}
