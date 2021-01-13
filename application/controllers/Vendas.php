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
        $this->load->model('produtos_model');
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

        //            $venda_produtos = $data['vendas_produtos'] = $this->vendas_model->get_all_produtos_by_venda($venda_id);

            $this->form_validation->set_rules('venda_cliente_id', '', 'required');
            $this->form_validation->set_rules('venda_tipo', '', 'required');
            $this->form_validation->set_rules('venda_forma_pagamento_id', '', 'required');


            if ($this->form_validation->run()) {
                //echo '<pre>';
                //print_r($this->input->post());
                //exit();

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

                $this->core_model->insert('vendas', $data, TRUE);
                
                $id_venda = $this->session->userdata('last_id');

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
                        'venda_produto_desconto' => $produto_desconto[$i],
                        'venda_produto_valor_total' => $produto_item_total[$i],
                    );

                    $data = html_escape($data);

                    $this->core_model->insert('venda_produtos', $data);

                    //inico controle de estoque
                    
                    $produto_qtde_estoque = 0;
                    
                    $produto_qtde_estoque += intval($produto_quantidade[$i]);
                    
                    $produtos = array(
                        'produtos_qtde_estoque' =>$produto_qtde_estoque,
                    );
                    
                     $this->produtos_model->update($produto_id[$i], $produto_qtde_estoque);
                    
                    //fim controle de estoque
                }
                //criar recurso PDF

                redirect('vendas/imprimir/' .$id_venda);
            } else {

                //echo '<pre>';
                //print_r($this->input->post());
                //exit();
                //erro de validação
                $data = array(
                    'titulo' => 'Cadastrar Venda',
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
                    'vendedores' => $this->core_model->get_all('vendedores', array('vendedor_ativo' => 1)),
                    'marcas' => $this->core_model->get_all('marcas', array('marca_ativa' => 1)),
                    'produtos' => $this->core_model->get_all('produtos', array('produto_ativo' => 1)),
                );



                //$venda = $data['venda'] = $this->vendas_model->get_by_id($venda_id);

                $this->load->view('layout/header', $data);
                $this->load->view('vendas/add');
                $this->load->view('layout/footer');
            }
    }

    public function edit($venda_id = NULL) {

        if (!$venda_id || !$this->core_model->get_by_id('vendas', array('venda_id' => $venda_id))) {

            $this->session->set_flashdata('error', 'Venda não encontrada!');
            redirect('vendas');
        } else {

//            $venda_produtos = $data['vendas_produtos'] = $this->vendas_model->get_all_produtos_by_venda($venda_id);

            $this->form_validation->set_rules('venda_cliente_id', '', 'required');
            $this->form_validation->set_rules('venda_tipo', '', 'required');
            $this->form_validation->set_rules('venda_forma_pagamento_id', '', 'required');


            if ($this->form_validation->run()) {
                //echo '<pre>';
                //print_r($this->input->post());
                //exit();

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

                /* deletando dvenda, os produtos antigos da venda editada */
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
                        'venda_produto_desconto' => $produto_desconto[$i],
                        'venda_produto_valor_total' => $produto_item_total[$i],
                    );

                    $data = html_escape($data);

                    $this->core_model->insert('venda_produtos', $data);

                    //inico controle de estoque

//                    foreach ($venda_produtos as $venda_p) {
//
//                        if ($venda_p->venda_produto_quantidade < $produto_quantidade[$i]) {
//
//                            $produto_qtde_estoque = 0;
//
//                            $produto_qtde_estoque += intval($produto_quantidade[$i]);
//
//                            $diferenca = ($produto_qtde_estoque - $venda_p->venda_produto_quantidade);
//
//                            $this->produtos_model->update($produto_id[$i], $diferenca);
//                        }
//                    }
                    //fim controle de estoque
                }
                //criar recurso PDF

                redirect('vendas');
            } else {

                //echo '<pre>';
                //print_r($this->input->post());
                //exit();
                //erro de validação
                $data = array(
                    'titulo' => 'Atualizar Venda',
                    'desabilitar' => TRUE, //Desabilita botão de submit
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
                    'vendedores' => $this->core_model->get_all('vendedores', array('vendedor_ativo' => 1)),
                    'venda_produtos' => $this->vendas_model->get_all_produtos_by_venda($venda_id),
                    'marcas' => $this->core_model->get_all('marcas', array('marca_ativa' => 1)),
                    'produtos' => $this->core_model->get_all('produtos', array('produto_ativo' => 1)),
//                    'vendas' => $this->core_model->get_all('vendas', array('venda_id' => $venda_id)),
                );



                $venda = $data['venda'] = $this->vendas_model->get_by_id($venda_id);

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

        $this->core_model->delete('vendas', array('venda_id' => $venda_id));
        redirect('vendas');
    }
    
    public function imprimir($ordem_servico_id = NULL) {

        if (!$ordem_servico_id || !$this->core_model->get_by_id('ordens_servicos', array('ordem_servico_id' => $ordem_servico_id))) {

            $this->session->set_flashdata('error', 'Venda não encontrada!');
            redirect('vendas');
        } else {

            $data = array(
                'titulo' => 'Escolha uma opção',
                'venda' => $this->core_model->get_by_id('vendas', array('venda_id' => $venda_id)),
            );

            $this->load->view('layout/header', $data);
            $this->load->view('vendas/imprimir');
            $this->load->view('layout/footer');
        }
    }

    public function pdf($ordem_servico_id = NULL) {

        if (!$ordem_servico_id || !$this->core_model->get_by_id('ordens_servicos', array('ordem_servico_id' => $ordem_servico_id))) {

            $this->session->set_flashdata('error', 'Venda não encontrada!');
            redirect('vendas');
        } else {

            $empresa = $this->core_model->get_by_id('sistema', array('sistema_id' => 1));
            
//            $situacao = $this->core_model->get_by_id($situacao_id);
            
            $ordem_servico = $this->ordem_servicos_model->get_by_id($ordem_servico_id);


            $file_name = 'O.S ' . $ordem_servico->ordem_servico_id;

            $html = '<html>';

            $html .= '<head>';

            $html .= '<title>' . $empresa->sistema_nome_fantasia . ' | Impressão de Ordem de Serviço</title>';

            $html .= '</head>';

            $html .= '<body style="font-size: 14px">';

            $html .= '<p align="right" style="font-size: 12px"><u>Ordem de Serviço Nº&nbsp;&nbsp;<strong>' . $ordem_servico->ordem_servico_id . '</strong><br> <strong align="right">Data de Emissão: </strong>' . formata_data_banco_com_hora($ordem_servico->ordem_servico_data_emissao) . '</p></u>';


            $html .= '<h4 align="center">
                       ' . $empresa->sistema_razao_social . '  | CNPJ:' . $empresa->sistema_cnpj . ' <br>
                       ' . $empresa->sistema_endereco . ', ' . $empresa->sistema_numero . ' | ' . $empresa->sistema_cidade . ' <br>
                       ' . $empresa->sistema_telefone_movel . '  |  ' . $empresa->sistema_telefone_fixo . ' <br>
                       <hr>
                     </h4>';
            //dados do cliente


            $html .= '<p>'
                    . '<strong>Cliente: </strong>' . $ordem_servico->cliente_nome_completo . '<>'
                    . '<strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;CPF: </strong>' . $ordem_servico->cliente_cpf_cnpj . '<>'
                    . '<strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Celular: </strong>' . $ordem_servico->cliente_celular . '<>' . '<strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Situação: </strong>' . $ordem_servico->ordem_servico_status . '<br>'
                    . '<strong>Forma de Pagamento: </strong>' . ($ordem_servico->ordem_servico_status == 1 ? $ordem_servico->forma_pagamento : 'Em aberto') . '<>'
                    . '<strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Equipamento </strong>' . $ordem_servico->ordem_servico_equipamento . '<>' . '<strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Acessórios: </strong>' . $ordem_servico->ordem_servico_acessorios . '<br>'
                    . '<strong>Obs. da O.S: </strong>' . $ordem_servico->ordem_servico_obs . '<>'
                    . '</p>';

            $html .= '<hr>';
            //dados da OS


            $html .= '<table width="100%" border: solid #ddd 1px>';


            $html .= '<tr>';
            $html .= '<th>Serviço</th>';
            $html .= '<th>Qtde</th>';
            $html .= '<th>Valor</th>';
            $html .= '<th>Desc.</th>';
            $html .= '<th>Total</th>';
            $html .= '</tr>';

            $ordem_servico_id = $ordem_servico->ordem_servico_id;

            $servicos_ordem = $this->ordem_servicos_model->get_all_servicos($ordem_servico_id);
            ;

            $valor_final_os = $this->ordem_servicos_model->get_valor_final_os($ordem_servico_id);
            
            
            

            foreach ($servicos_ordem as $servico):

                $html .= '<tr>';
                $html .= '<td>' . $servico->servico_nome . '</td>';
                $html .= '<td align="center">' . $servico->ordem_ts_quantidade . '</td>';
                $html .= '<td style="font-size: 12px">' . 'R$ ' . $servico->ordem_ts_valor_unitario . '</td>';
                $html .= '<td style="font-size: 12px">' . $servico->ordem_ts_valor_desconto . '%' . '</td>';
                $html .= '<td>' . 'R$ ' . $servico->ordem_ts_valor_total . '</td>';
                $html .= '</tr>';

            endforeach;

            $html .= '<th colspan="3">';

            $html .= '<td style="border-top: solid #ddd 2px"><stron>Valor Final</strong></td>';
            $html .= '<td style="border-top: solid #ddd 2px">' . 'R$ ' . $valor_final_os->os_valor_total . '</td>';

            $html .= '</th>';

            $html .= '</table>';

            $html .= '<hr>';


            $html .= '<p align="center" style="font-size: 10px"> Caso o equipamento não seja retirado em até 90 Dias a contar da data de emissão desta ordem de serviços, Eu,' . $ordem_servico->cliente_nome_completo . ', autorizo a empresa ' . $empresa->sistema_razao_social .', a sucatear, vender ou desfazer quaisquer serviços que tenham sido feitos no equipamento sem quaisquer prejuízo para a empresa '  . $empresa->sistema_razao_social . ' e declaro o abandono do equipamento como sendo verdadeiro.</p><br>';
            $html .= '<p align="center" style="font-size: 10px">______________________________________________</p>';
            $html .= '<p align="center" style="font-size: 10px">' . $ordem_servico->cliente_nome_completo . '</p><br><br><br>';

            $html .= '<hr style="border:2px dashed #ddd;"><br><br>';

            $html .= '<p align="right" style="font-size: 12px"><u>Ordem de Serviço Nº&nbsp;&nbsp;<strong>' . $ordem_servico->ordem_servico_id . '</strong><br> <strong align="right">Data de Emissão: </strong>' . formata_data_banco_com_hora($ordem_servico->ordem_servico_data_emissao) . '</p></u>';

            $html .= '<h4 align="center">
                       ' . $empresa->sistema_razao_social . '  | CNPJ:' . $empresa->sistema_cnpj . ' <br>
                       ' . $empresa->sistema_endereco . ', ' . $empresa->sistema_numero . ' | ' . $empresa->sistema_cidade . ' <br>
                       ' . $empresa->sistema_telefone_movel . '  |  ' . $empresa->sistema_telefone_fixo . ' <br>
                       <hr>
                     </h4>';
            //dados do cliente

            $html .= '<p>'
                    . '<strong>Cliente: </strong>' . $ordem_servico->cliente_nome_completo . '<>'
                    . '<strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;CPF: </strong>' . $ordem_servico->cliente_cpf_cnpj . '<>'
                    . '<strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Celular: </strong>' . $ordem_servico->cliente_celular . '<>' . '<strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Situação: </strong>' . $ordem_servico->ordem_servico_status . '<br>'
                    . '<strong>Forma de Pagamento: </strong>' . ($ordem_servico->ordem_servico_status == 1 ? $ordem_servico->forma_pagamento : 'Em aberto') . '<>'
                    . '<strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Equipamento </strong>' . $ordem_servico->ordem_servico_equipamento . '<>' . '<strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Acessórios: </strong>' . $ordem_servico->ordem_servico_acessorios . '<br>'
                    . '<strong>Obs. da O.S: </strong>' . $ordem_servico->ordem_servico_obs . '<>'
                    . '</p>';

            $html .= '<hr>';
            //dados da OS


            $html .= '<table width="100%" border: solid #ddd 1px>';


            $html .= '<tr>';
            $html .= '<th>Serviço</th>';
            $html .= '<th>Qtde</th>';
            $html .= '<th>Valor</th>';
            $html .= '<th>Desc.</th>';
            $html .= '<th>Total</th>';
            $html .= '</tr>';

            $ordem_servico_id = $ordem_servico->ordem_servico_id;

            $servicos_ordem = $this->ordem_servicos_model->get_all_servicos($ordem_servico_id);
            ;

            $valor_final_os = $this->ordem_servicos_model->get_valor_final_os($ordem_servico_id);

            foreach ($servicos_ordem as $servico):

                $html .= '<tr>';
                $html .= '<td>' . $servico->servico_nome . '</td>';
                $html .= '<td align="center">' . $servico->ordem_ts_quantidade . '</td>';
                $html .= '<td style="font-size: 12px">' . 'R$ ' . $servico->ordem_ts_valor_unitario . '</td>';
                $html .= '<td style="font-size: 12px">' . $servico->ordem_ts_valor_desconto . '%' . '</td>';
                $html .= '<td>' . 'R$ ' . $servico->ordem_ts_valor_total . '</td>';
                $html .= '</tr>';

            endforeach;

            $html .= '<th colspan="3">';

            $html .= '<td style="border-top: solid #ddd 2px"><stron>Valor Final</strong></td>';
            $html .= '<td style="border-top: solid #ddd 2px">' . 'R$ ' . $valor_final_os->os_valor_total . '</td>';

            $html .= '</th>';

            $html .= '</table>';

            $html .= '<hr>';

            $html .= '<p align="center" style="font-size: 10px"> Caso o equipamento não seja retirado em até 90 Dias a contar da data de emissão desta ordem de serviços, Eu,' . $ordem_servico->cliente_nome_completo . ', autorizo a empresa ' . $empresa->sistema_razao_social .', a sucatear, vender ou desfazer quaisquer serviços que tenham sido feitos no equipamento sem quaisquer prejuízo para a empresa '  . $empresa->sistema_razao_social . ' e declaro o abandono do equipamento como sendo verdadeiro.</p><br>';
            $html .= '<p align="center" style="font-size: 10px">______________________________________________</p>';
            $html .= '<p align="center" style="font-size: 10px">' . $ordem_servico->cliente_nome_completo . '</p><br>';


            $html .= '</body>';


            $html .= '</html>';

            //false abre PDF direto no navegador
            //true faz download
            $this->pdf->createPDF($html, $file_name, false);
        }
    }

}
