<?php

defined('BASEPATH') OR exit('Ação não permitida!');

class Ordem_servicos extends CI_Controller {

    public function __construct() {
        parent::__construct();

        if (!$this->ion_auth->logged_in()) {
            $this->session->set_flashdata('info', 'Sua sessão expirou!');
            redirect('login');
        }

        $this->load->model('ordem_servicos_model');
    }

    public function index() {

        $data = array(
            'titulo' => 'Ordens de Serviços Cadastradas',
            'styles' => array(
                'vendor/datatables/dataTables.bootstrap4.min.css',
            ),
            'scripts' => array(
                'vendor/datatables/jquery.dataTables.min.js',
                'vendor/datatables/dataTables.bootstrap4.min.js',
                'vendor/datatables/app.js'
            ),
            'ordens_servicos' => $this->ordem_servicos_model->get_all(), // Pegar todos as ordens_servicos        
        );

        //echo'<pre>';
        //print_r($data['ordens_servicos']);
        //exit();

        $this->load->view('layout/header', $data);
        $this->load->view('ordem_servicos/index');
        $this->load->view('layout/footer');
    }

    public function add() {


        //Validação de Formulário
        $this->form_validation->set_rules('ordem_servico_cliente_id', '', 'required');
        $this->form_validation->set_rules('ordem_servico_equipamento', 'Equipamento', 'trim|required|min_length[2]|max_length[80]');
        $this->form_validation->set_rules('ordem_servico_marca_equipamento_id', 'Marca', 'trim|required|min_length[2]|max_length[80]');
        $this->form_validation->set_rules('ordem_servico_modelo_equipamento', 'Modelo', 'trim|required|min_length[2]|max_length[80]');
        $this->form_validation->set_rules('ordem_servico_acessorios', 'Acessórios', 'trim|required|min_length[2]|max_length[200]');
        $this->form_validation->set_rules('ordem_servico_defeito', 'Defeito', 'trim|required|max_length[700]');
        $this->form_validation->set_rules('ordem_servico_obs', 'Observações', 'trim|min_length[5]|max_length[500]');

        if ($this->form_validation->run()) {




            $ordem_servico_valor_total = str_replace('R$', "", trim($this->input->post('ordem_servico_valor_total')));

            $data = elements(
                    array(
                        'ordem_servico_cliente_id',
                        'ordem_servico_status',
                        'ordem_servico_equipamento',
                        'ordem_servico_marca_equipamento_id',
                        'ordem_servico_modelo_equipamento',
                        'ordem_servico_defeito',
                        'ordem_servico_acessorios',
                        'ordem_servico_obs',
                        'ordem_servico_valor_desconto',
                        'ordem_servico_valor_total',
                    ), $this->input->post()
            );

//            echo'<pre>';
//            print_r($data);
//            exit();

            $data['ordem_servico_valor_total'] = trim(preg_replace('/\$/', '', $ordem_servico_valor_total));

            $data = html_escape($data);

            $this->core_model->insert('ordens_servicos', $data, TRUE);

            //recuperar ID

            $id_ordem_servico = $this->session->userdata('last_id');

            $servico_id = $this->input->post('servico_id');
            $servico_quantidade = $this->input->post('servico_quantidade');
            $servico_desconto = str_replace('%', '', $this->input->post('servico_desconto'));

            $servico_preco = str_replace('R$', '', $this->input->post('servico_preco'));
            $servico_item_total = str_replace('R$', '', $this->input->post('servico_item_total'));

            $servico_preco = str_replace(',', '', $servico_preco);
            $servico_item_total = str_replace('R$', '', $servico_item_total);

            $qty_servico = count($servico_id);

            $ordem_servico_id = $this->input->post('ordem_servico_id');

            for ($i = 0; $i < $qty_servico; $i++) {

                $data = array(
                    'ordem_ts_id_ordem_servico' => $id_ordem_servico,
                    'ordem_ts_id_servico' => $servico_id[$i],
                    'ordem_ts_quantidade' => $servico_quantidade[$i],
                    'ordem_ts_valor_unitario' => $servico_preco[$i],
                    'ordem_ts_valor_desconto' => $servico_desconto[$i],
                    'ordem_ts_valor_total' => $servico_item_total[$i],
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

    public function edit($ordem_servico_id = NULL) {

        if (!$ordem_servico_id || !$this->core_model->get_by_id('ordens_servicos', array('ordem_servico_id' => $ordem_servico_id))) {

            $this->session->set_flashdata('error', 'Ordem de serviço não encontrada!');
            redirect('ordem_servicos');
        } else {

            //Validação de Formulário

            $this->form_validation->set_rules('ordem_servico_cliente_id', '', 'required');

            $ordem_servico_status = $this->input->post('ordem_servico_status');

            if ($ordem_servico_status == 1) {
                $this->form_validation->set_rules('ordem_servico_forma_pagamento_id', '', 'required');
            }

            $this->form_validation->set_rules('ordem_servico_equipamento', 'Equipamento', 'trim|required|min_length[2]|max_length[80]');
            $this->form_validation->set_rules('ordem_servico_marca_equipamento_id', 'Marca', 'trim|required|max_length[80]');
            $this->form_validation->set_rules('ordem_servico_modelo_equipamento', 'Modelo', 'trim|required|min_length[2]|max_length[80]');
            $this->form_validation->set_rules('ordem_servico_acessorios', 'Acessórios', 'trim|required|min_length[2]|max_length[200]');
            $this->form_validation->set_rules('ordem_servico_defeito', 'Defeito', 'trim|required|max_length[700]');
            $this->form_validation->set_rules('ordem_servico_obs', 'Observações', 'trim|min_length[5]|max_length[500]');

            if ($this->form_validation->run()) {
                //echo '<pre>';
                //print_r($this->input->post());
                //exit();

                $ordem_servico_valor_total = str_replace('R$', "", trim($this->input->post('ordem_servico_valor_total')));

                $data = elements(
                        array(
                            'ordem_servico_cliente_id',
                            'ordem_servico_forma_pagamento_id',
                            'ordem_servico_status',
                            'ordem_servico_equipamento',
                            'ordem_servico_marca_equipamento_id',
                            'ordem_servico_modelo_equipamento',
                            'ordem_servico_defeito',
                            'ordem_servico_acessorios',
                            'ordem_servico_obs',
                            'ordem_servico_valor_desconto',
                            'ordem_servico_valor_total',
                        ), $this->input->post()
                );

                $data['ordem_servico_valor_total'] = trim(preg_replace('/\$/', '', $ordem_servico_valor_total));

                $data = html_escape($data);

                $this->core_model->update('ordens_servicos', $data, array('ordem_servico_id' => $ordem_servico_id));

                /* deletando de ordem_tem_servicos, os seviços antigos da ordem editada */
                $this->ordem_servicos_model->delete_old_services($ordem_servico_id);

                $servico_id = $this->input->post('servico_id');
                $servico_quantidade = $this->input->post('servico_quantidade');
                $servico_desconto = str_replace('%', '', $this->input->post('servico_desconto'));

                $servico_preco = str_replace('R$', '', $this->input->post('servico_preco'));
                $servico_item_total = str_replace('R$', '', $this->input->post('servico_item_total'));

                $servico_preco = str_replace(',', '', $servico_preco);
                $servico_item_total = str_replace('R$', '', $servico_item_total);

                $qty_servico = count($servico_id);

                $ordem_servico_id = $this->input->post('ordem_servico_id');

                for ($i = 0; $i < $qty_servico; $i++) {

                    $data = array(
                        'ordem_ts_id_ordem_servico' => $ordem_servico_id,
                        'ordem_ts_id_servico' => $servico_id[$i],
                        'ordem_ts_quantidade' => $servico_quantidade[$i],
                        'ordem_ts_valor_unitario' => $servico_preco[$i],
                        'ordem_ts_valor_desconto' => $servico_desconto[$i],
                        'ordem_ts_valor_total' => $servico_item_total[$i],
                    );

                    $data = html_escape($data);

                    $this->core_model->insert('ordem_tem_servicos', $data);
                }
                //criar recurso PDF

                redirect('ordem_servicos/imprimir/' . $ordem_servico_id);
            } else {

                //echo '<pre>';
                //print_r($this->input->post());
                //exit();
                //erro de validação
                $data = array(
                    'titulo' => 'Atualizar Ordem de Serviço',
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
                    'formas_pagamentos' => $this->core_model->get_all('formas_pagamentos', array('forma_pagamento_ativa' => 1)),
                    'ordem_tem_servicos' => $this->ordem_servicos_model->get_all_servicos_by_ordem($ordem_servico_id),
                    'marcas' => $this->core_model->get_all('marcas', array('marca_ativa' => 1)),
                    'situacoes' => $this->core_model->get_all('situacoes', array('situacao_ativa' => 1)),
                );



                $ordem_servico = $data['ordem_servico'] = $this->ordem_servicos_model->get_by_id($ordem_servico_id);

                $this->load->view('layout/header', $data);
                $this->load->view('ordem_servicos/edit');
                $this->load->view('layout/footer');
            }
        }
    }

    public function del($ordem_servico_id = NULL) {
        if (!$ordem_servico_id || !$this->core_model->get_by_id('ordens_servicos', array('ordem_servico_id' => $ordem_servico_id))) {

            $this->session->set_flashdata('error', 'Ordem de serviço não encontrada!');
            redirect('ordem_servicos');
        }

        if ($this->core_model->get_by_id('ordens_servicos', array('ordem_servico_id' => $ordem_servico_id, 'ordem_servico_status' => 0))) {

            $this->session->set_flashdata('error', 'Não é possivel excluir uma ordem de serviço em aberto !');
            redirect('ordem_servicos');
        }

        $this->core_model->delete('ordens_servicos', array('ordem_servico_id' => $ordem_servico_id));
        redirect('ordem_servicos');
    }

    public function imprimir($ordem_servico_id = NULL) {

        if (!$ordem_servico_id || !$this->core_model->get_by_id('ordens_servicos', array('ordem_servico_id' => $ordem_servico_id))) {

            $this->session->set_flashdata('error', 'Ordem de serviço não encontrada!');
            redirect('ordem_servicos');
        } else {

            $data = array(
                'titulo' => 'Escolha uma opção',
                'ordem_servico' => $this->core_model->get_by_id('ordens_servicos', array('ordem_servico_id' => $ordem_servico_id)),
            );

            $this->load->view('layout/header', $data);
            $this->load->view('ordem_servicos/imprimir');
            $this->load->view('layout/footer');
        }
    }

    public function pdf($ordem_servico_id = NULL) {

        if (!$ordem_servico_id || !$this->core_model->get_by_id('ordens_servicos', array('ordem_servico_id' => $ordem_servico_id))) {

            $this->session->set_flashdata('error', 'Ordem de serviço não encontrada!');
            redirect('ordem_servicos');
        } else {

            $empresa = $this->core_model->get_by_id('sistema', array('sistema_id' => 1));
//            $situacao_os = $this->core_model->get_by_id('situacoes', array('situacao_id' => $ordem_servico->ordem_servico_situacao_id));
            
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
                    . '<strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Celular: </strong>' . $ordem_servico->cliente_celular . '<>' . '<strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Situação: </strong>' . $ordem_servico->ordem_servico_situacao_id . '<br>'
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
