<?php

defined('BASEPATH') OR exit('Ação não permitida!');

class Relatorios extends CI_Controller {

    public function __construct() {
        parent::__construct();

        if (!$this->ion_auth->logged_in()) {
            $this->session->set_flashdata('info', 'Sua sessão expirou!');
            redirect('login');
        }
    }

    public function vendas() {

        $data = array(
            'titulo' => 'Relatórios de Vendas',
        );

        $data_inicial = $this->input->post('data_inicial');
        $data_final = $this->input->post('data_final');

//        echo'<pre>';
//        print_r($this->input->post());
//        exit();

        if ($data_inicial) {

            $this->load->model('vendas_model');

            if ($this->vendas_model->gerar_relatorio_vendas($data_inicial, $data_final)) {

                //montar pdf

                $empresa = $this->core_model->get_by_id('sistema', array('sistema_id' => 1));

//            $situacao = $this->core_model->get_by_id($situacao_id);

                $vendas = $this->vendas_model->gerar_relatorio_vendas($data_inicial, $data_final);


                $file_name = 'Relatório de Vendas ';

                $html = '<html>';

                $html .= '<head>';

                $html .= '<title>' . $empresa->sistema_nome_fantasia . ' | Relatório de Venda</title>';

                $html .= '</head>';

                $html .= '<body style="font-size: 14px">';

//dados da empresa
                $html .= '<h4 align="center">
                       ' . $empresa->sistema_razao_social . '  | CNPJ:' . $empresa->sistema_cnpj . ' <br>
                       ' . $empresa->sistema_endereco . ', ' . $empresa->sistema_numero . ' | ' . $empresa->sistema_cidade . ' <br>
                       ' . $empresa->sistema_telefone_movel . '  |  ' . $empresa->sistema_telefone_fixo . ' <br>
                     </h4>';

                $html .= '<hr>';
                $html .= '<span style="font-size: 15px; text-align: center;">Relatório de vendas realizadas no período de: </span>';

                if ($data_inicial && $data_final) {

                    $html .= '<span align="center" style="font-size: 15px">' . formata_data_banco_sem_hora($data_inicial) . ' a ' . formata_data_banco_sem_hora($data_final) . '</span>';
                } else {
                    $html .= '<span align="center" style="font-size: 15px">' . formata_data_banco_sem_hora($data_inicial) . '</span>';
                }


//                $html .= '<p>'
//                        . '<strong>Cliente: </strong>' . $venda->cliente_nome_completo . '<>'
//                        . '<strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;CPF: </strong>' . $venda->cliente_cpf_cnpj . '<>'
//                        . '<strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Celular: </strong>' . $venda->cliente_celular . '<>' . '<br>'
//                        . '<strong>Forma de Pagamento: </strong>' . $venda->forma_pagamento . '<>'
//                        . '</p>';
                $html .= '<br>';
                $html .= '<hr>';
//            //dados da OS
//
//
                $html .= '<table width="100%" border: solid #ddd 1px>';


                $html .= '<tr>';
                $html .= '<th>Código da Venda</th>';
                $html .= '<th>Data</th>';
                $html .= '<th>Cliente</th>';
                $html .= '<th>Forma de Pagamento</th>';
                $html .= '<th>ValorTotal</th>';
                $html .= '</tr>';
//
//                $vendas_venda = $this->vendas_model->get_all_produtos($venda_id);
                $valor_final_vendas = $this->vendas_model->get_valor_final_relatorio($data_inicial, $data_final);
                foreach ($vendas as $venda):
//
                    $html .= '<tr>';
                    $html .= '<td align="center">' . $venda->venda_id . '</td>';
                    $html .= '<td>' . formata_data_banco_com_hora($venda->venda_data_emissao) . '</td>';
                    $html .= '<td align="left">' . $venda->cliente_nome_completo . '</td>';
                    $html .= '<td align="rigth">' . $venda->forma_pagamento . '</td>';
                    $html .= '<td>' . 'R$ ' . $venda->venda_valor_total . '</td>';
                    $html .= '</tr>';
//
                endforeach;
//
                $html .= '<th colspan="3">';
//
                $html .= '<td style="border-top: solid #ddd 2px"><stron>Valor Final</strong></td>';
                $html .= '<td style="border-top: solid #ddd 2px">' . 'R$ ' . $valor_final_vendas->venda_valor_total . '</td>';
//
                $html .= '</th>';
//
                $html .= '</table>';

                $html .= '<hr>';


                $html .= '<p align="center" style="font-size: 12px"> Buscai ao Senhor enquanto se pode achar, invocai-o enquanto está perto. Isaías 55:6</p><br>';

                $html .= '</body>';


                $html .= '</html>';

                //false abre PDF direto no navegador
                //true faz download
                $this->pdf->createPDF($html, $file_name, false);
            } else {
                if (!empty($data_inicial) && !empty($data_final)) {

                    $this->session->set_flashdata('info', 'Não foram encontradas vendas entre as datas ' . formata_data_banco_sem_hora($data_inicial) . ' e ' . formata_data_banco_sem_hora($data_final));
                } else {
                    $this->session->set_flashdata('info', 'Não foram encontradas vendas a partir de ' . formata_data_banco_sem_hora($data_inicial));
                }
                redirect('relatorios/vendas');
            }
        }

        $this->load->view('layout/header', $data);
        $this->load->view('relatorios/vendas');
        $this->load->view('layout/footer');
    }

    public function os() {

        $data = array(
            'titulo' => 'Relatórios de Ordens de Serviços',
        );

        $data_inicial = $this->input->post('data_inicial');
        $data_final = $this->input->post('data_final');

//        echo'<pre>';
//        print_r($this->input->post());
//        exit();

        if ($data_inicial) {

            $this->load->model('ordem_servicos_model');

            if ($this->ordem_servicos_model->gerar_relatorio_os($data_inicial, $data_final)) {

                //montar pdf

                $empresa = $this->core_model->get_by_id('sistema', array('sistema_id' => 1));

//            $situacao = $this->ordem_servicos_model->get_by_id($situacao_id);

                $ordens_servicos = $this->ordem_servicos_model->gerar_relatorio_os($data_inicial, $data_final);


                $file_name = 'Relatório de Ordens de Serviços ';

                $html = '<html>';

                $html .= '<head>';

                $html .= '<title>' . $empresa->sistema_nome_fantasia . ' | Relatório de Ordens de Serviços</title>';

                $html .= '</head>';

                $html .= '<body style="font-size: 14px">';

//dados da empresa
                $html .= '<h4 align="center">
                       ' . $empresa->sistema_razao_social . '  | CNPJ:' . $empresa->sistema_cnpj . ' <br>
                       ' . $empresa->sistema_endereco . ', ' . $empresa->sistema_numero . ' | ' . $empresa->sistema_cidade . ' <br>
                       ' . $empresa->sistema_telefone_movel . '  |  ' . $empresa->sistema_telefone_fixo . ' <br>
                     </h4>';

                $html .= '<hr>';


                if ($data_inicial && $data_final) {
                    $html .= '<span align="center" style="font-size: 15px">Relatório de Ordem de Serviços no período de: </span>';
                    $html .= '<span align="center" style="font-size: 15px">' . formata_data_banco_sem_hora($data_inicial) . ' a ' . formata_data_banco_sem_hora($data_final) . '</span>';
                } else {
                    $html .= '<span align="center" style="font-size: 15px;">Relatório de Ordem de Serviços a partir de: </span>';
                    $html .= '<span align="center" style="font-size: 15px">' . formata_data_banco_sem_hora($data_inicial) . '</span>';
                }

                $html .= '<br>';
                $html .= '<hr>';
//            //dados da OS
//
//
                $html .= '<table width="100%" border: solid #ddd 1px>';


                $html .= '<tr>';
                $html .= '<th>Número da O.S</th>';
                $html .= '<th>Data</th>';
                $html .= '<th>Cliente</th>';
                $html .= '<th>Forma de Pagamento</th>';
                $html .= '<th>Valor Total</th>';
                $html .= '</tr>';
//
//                $vendas_venda = $this->vendas_model->get_all_produtos($venda_id);
                $valor_final_os = $this->ordem_servicos_model->get_valor_final_relatorio_os($data_inicial, $data_final);

                foreach ($ordens_servicos as $os):
//
                    $html .= '<tr>';
                    $html .= '<td align="center">' . $os->ordem_servico_id . '</td>';
                    $html .= '<td>' . formata_data_banco_com_hora($os->ordem_servico_data_emissao) . '</td>';
                    $html .= '<td align="left">' . $os->cliente_nome_completo . '</td>';
                    $html .= '<td align="rigth">' . $os->forma_pagamento . '</td>';
                    $html .= '<td>' . 'R$ ' . $os->ordem_servico_valor_total . '</td>';
                    $html .= '</tr>';
//
                endforeach;
//
                $html .= '<th colspan="3">';
//
                $html .= '<td style="border-top: solid #ddd 2px"><stron>Valor Final</strong></td>';
                $html .= '<td style="border-top: solid #ddd 2px">' . 'R$ ' . $valor_final_os->ordem_servico_valor_total . '</td>';
//
                $html .= '</th>';
//
                $html .= '</table>';

                $html .= '<hr>';


                $html .= '<p align="center" style="font-size: 12px"> Buscai ao Senhor enquanto se pode achar, invocai-o enquanto está perto. Isaías 55:6</p><br>';

                $html .= '</body>';


                $html .= '</html>';

                //false abre PDF direto no navegador
                //true faz download
                $this->pdf->createPDF($html, $file_name, false);
            } else {
                if (!empty($data_inicial) && !empty($data_final)) {

                    $this->session->set_flashdata('info', 'Não foram encontradas Ordens de serviços entre as datas ' . formata_data_banco_sem_hora($data_inicial) . ' e ' . formata_data_banco_sem_hora($data_final));
                } else {
                    $this->session->set_flashdata('info', 'Não foram encontradas Ordens de serviços a partir de ' . formata_data_banco_sem_hora($data_inicial));
                }
                redirect('relatorios/os');
            }
        }

        $this->load->view('layout/header', $data);
        $this->load->view('relatorios/os');
        $this->load->view('layout/footer');
    }

    public function receber() {

        $data = array(
            'titulo' => 'Relatório de Contas a Receber',
        );

        $contas = $this->input->post('contas');

//        echo'<pre>';
//        print_r($contas);
//        exit();

        if ($contas == 'vencidas' || $contas == 'pagas' || $contas == 'receber') {

            $this->load->model('financeiro_model');

            if ($contas == 'vencidas') {

//                echo'<pre>';
//                print_r('$contas');
//                exit();

                $conta_receber_status = 0;

                $data_vencimento = TRUE;
                
                if($contas = $this->financeiro_model->get_contas_receber_relatorio($conta_receber_status, $data_vencimento)){
                    
                    //montar pdf

                $empresa = $this->core_model->get_by_id('sistema', array('sistema_id' => 1));


//            $situacao = $this->ordem_servicos_model->get_by_id($situacao_id);

                $contas = $this->financeiro_model->get_contas_receber_relatorio($conta_receber_status, $data_vencimento);

                $file_name = 'Relatório de Contas Vencidas';

                $html = '<html>';

                $html .= '<head>';

                $html .= '<title>' . $empresa->sistema_nome_fantasia . ' | Relatório de Contas Vencidas</title>';

                $html .= '</head>';

                $html .= '<body style="font-size: 14px">';

//dados da empresa
                $html .= '<h4 align="center">
                       ' . $empresa->sistema_razao_social . '  | CNPJ:' . $empresa->sistema_cnpj . ' <br>
                       ' . $empresa->sistema_endereco . ', ' . $empresa->sistema_numero . ' | ' . $empresa->sistema_cidade . ' <br>
                       ' . $empresa->sistema_telefone_movel . '  |  ' . $empresa->sistema_telefone_fixo . ' <br>
                     </h4>';

                $html .= '<hr>';

//            //dados da OS
//
//
                $html .= '<table width="100%" border: solid #ddd 1px>';


                $html .= '<tr>';
                $html .= '<th>ID da Conta</th>';
                $html .= '<th>Data de Vencimento</th>';
                $html .= '<th>Cliente</th>';
                $html .= '<th>Situação</th>';
                $html .= '<th>Valor Total</th>';
                $html .= '</tr>';
//
//                $vendas_venda = $this->vendas_model->get_all_produtos($venda_id);


                foreach ($contas as $conta):
//
                    $html .= '<tr>';
                    $html .= '<td align="center">' . $conta->conta_receber_id . '</td>';
                    $html .= '<td align="center">' . formata_data_banco_sem_hora($conta->conta_receber_data_vencimento) . '</td>';
                    $html .= '<td align="left">' . $conta->cliente_nome_completo . '</td>';
                    $html .= '<td align="rigth">Vencida</td>';
                    $html .= '<td>' . 'R$ ' . $conta->conta_receber_valor . '</td>';
                    $html .= '</tr>';
//
                endforeach;

//                echo'<pre>';
//                print_r($conta);
//                exit();


                $valor_final_contas = $this->financeiro_model->get_sum_contas_receber_relatorio($conta_receber_status, $data_vencimento);
//
                $html .= '<th colspan="3">';
//
                $html .= '<td style="border-top: solid #ddd 2px"><strong>Valor Final</strong></td>';
                $html .= '<td style="border-top: solid #ddd 2px">' . 'R$ ' . $valor_final_contas->conta_receber_valor_total . '</td>';
//
                $html .= '</th>';
//
                $html .= '</table>';

                $html .= '<hr>';

                $html .= '<p align="center" style="font-size: 12px"> Buscai ao Senhor enquanto se pode achar, invocai-o enquanto está perto. Isaías 55:6</p><br>';

                $html .= '</body>';
                $html .= '</html>';

                //false abre PDF direto no navegador
                //true faz download
                $this->pdf->createPDF($html, $file_name, false);
                    
                } else {
                    
                    $this->session->set_flashdata('info', 'Nenhuma conta vencida foi encontrada!');
                    
                }

                
            }
            
            if ($contas == 'pagas') {

//                echo'<pre>';
//                print_r('$contas');
//                exit();

                $conta_receber_status = 1;
                
                if($contas = $this->financeiro_model->get_contas_receber_relatorio($conta_receber_status)){
                    
                    //montar pdf

                $empresa = $this->core_model->get_by_id('sistema', array('sistema_id' => 1));


//            $situacao = $this->ordem_servicos_model->get_by_id($situacao_id);

                $contas = $this->financeiro_model->get_contas_receber_relatorio($conta_receber_status);

                $file_name = 'Relatório de Contas Pagas';

                $html = '<html>';

                $html .= '<head>';

                $html .= '<title>' . $empresa->sistema_nome_fantasia . ' | Relatório de Contas Pagas</title>';

                $html .= '</head>';

                $html .= '<body style="font-size: 14px">';

//dados da empresa
                $html .= '<h4 align="center">
                       ' . $empresa->sistema_razao_social . '  | CNPJ:' . $empresa->sistema_cnpj . ' <br>
                       ' . $empresa->sistema_endereco . ', ' . $empresa->sistema_numero . ' | ' . $empresa->sistema_cidade . ' <br>
                       ' . $empresa->sistema_telefone_movel . '  |  ' . $empresa->sistema_telefone_fixo . ' <br>
                     </h4>';

                $html .= '<hr>';

//            //dados da OS
//
//
                $html .= '<table width="100%" border: solid #ddd 1px>';


                $html .= '<tr>';
                $html .= '<th>ID da Conta</th>';
                $html .= '<th>Data de Pagamento</th>';
                $html .= '<th>Cliente</th>';
                $html .= '<th>Situação</th>';
                $html .= '<th>Valor Total</th>';
                $html .= '</tr>';
//
//                $vendas_venda = $this->vendas_model->get_all_produtos($venda_id);


                foreach ($contas as $conta):
//
                    $html .= '<tr>';
                    $html .= '<td align="center">' . $conta->conta_receber_id . '</td>';
                    $html .= '<td align="center">' . formata_data_banco_sem_hora($conta->conta_receber_data_pagamento) . '</td>';
                    $html .= '<td align="left">' . $conta->cliente_nome_completo . '</td>';
                    $html .= '<td align="rigth">Paga</td>';
                    $html .= '<td>' . 'R$ ' . $conta->conta_receber_valor . '</td>';
                    $html .= '</tr>';
//
                endforeach;

//                echo'<pre>';
//                print_r($conta);
//                exit();


                $valor_final_contas = $this->financeiro_model->get_sum_contas_receber_relatorio($conta_receber_status);
//
                $html .= '<th colspan="3">';
//
                $html .= '<td style="border-top: solid #ddd 2px"><strong>Valor Final</strong></td>';
                $html .= '<td style="border-top: solid #ddd 2px">' . 'R$ ' . $valor_final_contas->conta_receber_valor_total . '</td>';
//
                $html .= '</th>';
//
                $html .= '</table>';

                $html .= '<hr>';

                $html .= '<p align="center" style="font-size: 12px"> Buscai ao Senhor enquanto se pode achar, invocai-o enquanto está perto. Isaías 55:6</p><br>';

                $html .= '</body>';
                $html .= '</html>';

                //false abre PDF direto no navegador
                //true faz download
                $this->pdf->createPDF($html, $file_name, false);
                    
                } else {
                    
                    $this->session->set_flashdata('info', 'Nenhuma conta paga foi encontrada!');
                    
                }

                
            }
            
            if ($contas == 'receber') {

//                echo'<pre>';
//                print_r('$contas');
//                exit();

                $conta_receber_status = 0;
                
                if($contas = $this->financeiro_model->get_contas_receber_relatorio($conta_receber_status)){
                    
                    //montar pdf

                $empresa = $this->core_model->get_by_id('sistema', array('sistema_id' => 1));


//            $situacao = $this->ordem_servicos_model->get_by_id($situacao_id);

                $contas = $this->financeiro_model->get_contas_receber_relatorio($conta_receber_status);

                $file_name = 'Relatório de Contas a Receber';

                $html = '<html>';

                $html .= '<head>';

                $html .= '<title>' . $empresa->sistema_nome_fantasia . ' | Relatório de Contas a Receber</title>';

                $html .= '</head>';

                $html .= '<body style="font-size: 14px">';

//dados da empresa
                $html .= '<h4 align="center">
                       ' . $empresa->sistema_razao_social . '  | CNPJ:' . $empresa->sistema_cnpj . ' <br>
                       ' . $empresa->sistema_endereco . ', ' . $empresa->sistema_numero . ' | ' . $empresa->sistema_cidade . ' <br>
                       ' . $empresa->sistema_telefone_movel . '  |  ' . $empresa->sistema_telefone_fixo . ' <br>
                     </h4>';

                $html .= '<hr>';

//            //dados da OS
//
//
                $html .= '<table width="100%" border: solid #ddd 1px>';


                $html .= '<tr>';
                $html .= '<th>ID da Conta</th>';
                $html .= '<th>Data de Vencimento</th>';
                $html .= '<th>Cliente</th>';
                $html .= '<th>Situação</th>';
                $html .= '<th>Valor Total</th>';
                $html .= '</tr>';
//
//                $vendas_venda = $this->vendas_model->get_all_produtos($venda_id);


                foreach ($contas as $conta):
//
                    $html .= '<tr>';
                    $html .= '<td align="center">' . $conta->conta_receber_id . '</td>';
                    $html .= '<td align="center">' . formata_data_banco_sem_hora($conta->conta_receber_data_vencimento) . '</td>';
                    $html .= '<td align="left">' . $conta->cliente_nome_completo . '</td>';
                    $html .= '<td align="rigth">Paga</td>';
                    $html .= '<td>' . 'R$ ' . $conta->conta_receber_valor . '</td>';
                    $html .= '</tr>';
//
                endforeach;

//                echo'<pre>';
//                print_r($conta);
//                exit();


                $valor_final_contas = $this->financeiro_model->get_sum_contas_receber_relatorio($conta_receber_status);
//
                $html .= '<th colspan="3">';
//
                $html .= '<td style="border-top: solid #ddd 2px"><stron>Valor Final</strong></td>';
                $html .= '<td style="border-top: solid #ddd 2px">' . 'R$ ' . $valor_final_contas->conta_receber_valor_total . '</td>';
//
                $html .= '</th>';
//
                $html .= '</table>';

                $html .= '<hr>';

                $html .= '<p align="center" style="font-size: 12px"> Buscai ao Senhor enquanto se pode achar, invocai-o enquanto está perto. Isaías 55:6</p><br>';

                $html .= '</body>';
                $html .= '</html>';

                //false abre PDF direto no navegador
                //true faz download
                $this->pdf->createPDF($html, $file_name, false);
                    
                } else {
                    
                    $this->session->set_flashdata('info', 'Nenhuma conta a receber foi encontrada!');
                    
                }

                
            }
            
        }
        
        

        //fazer verificações

        $this->load->view('layout/header', $data);
        $this->load->view('relatorios/receber');
        $this->load->view('layout/footer');
    }
    
    public function pagar() {

        $data = array(
            'titulo' => 'Relatório de Contas a Pagar',
        );

        $contas = $this->input->post('contas');

//        echo'<pre>';
//        print_r($contas);
//        exit();

        if ($contas == 'pagar' || $contas == 'vencidas' || $contas == 'a_pagar') {

            $this->load->model('financeiro_model');

            if ($contas == 'vencidas') {

//                echo'<pre>';
//                print_r('$contas');
//                exit();

                $conta_pagar_status = 0;

                $data_vencimento = TRUE;
                
                if($contas = $this->financeiro_model->get_contas_pagar_relatorio($conta_pagar_status, $data_vencimento)){
                    
                    //montar pdf

                $empresa = $this->core_model->get_by_id('sistema', array('sistema_id' => 1));


//            $situacao = $this->ordem_servicos_model->get_by_id($situacao_id);

                $contas = $this->financeiro_model->get_contas_pagar_relatorio($conta_pagar_status, $data_vencimento);

                $file_name = 'Relatório de Contas Vencidas';

                $html = '<html>';

                $html .= '<head>';

                $html .= '<title>' . $empresa->sistema_nome_fantasia . ' | Relatório de Contas Vencidas</title>';

                $html .= '</head>';

                $html .= '<body style="font-size: 14px">';

//dados da empresa
                $html .= '<h4 align="center">
                       ' . $empresa->sistema_razao_social . '  | CNPJ:' . $empresa->sistema_cnpj . ' <br>
                       ' . $empresa->sistema_endereco . ', ' . $empresa->sistema_numero . ' | ' . $empresa->sistema_cidade . ' <br>
                       ' . $empresa->sistema_telefone_movel . '  |  ' . $empresa->sistema_telefone_fixo . ' <br>
                     </h4>';

                $html .= '<hr>';

//            //dados da OS
//
//
                $html .= '<table width="100%" border: solid #ddd 1px>';


                $html .= '<tr>';
                $html .= '<th>ID da Conta</th>';
                $html .= '<th>Data de Vencimento</th>';
                $html .= '<th>Fornecedor</th>';
                $html .= '<th>CNPJ</th>';
                $html .= '<th>Situação</th>';
                $html .= '<th>Valor Total</th>';
                $html .= '</tr>';
//
//                $vendas_venda = $this->vendas_model->get_all_produtos($venda_id);


                foreach ($contas as $conta):
//
                    $html .= '<tr>';
                    $html .= '<td align="center">' . $conta->conta_pagar_id . '</td>';
                    $html .= '<td align="center">' . formata_data_banco_sem_hora($conta->conta_pagar_data_vencimento) . '</td>';
                    $html .= '<td align="left">' . $conta->fornecedor_nome_fantasia . '</td>';
                    $html .= '<td align="left">' . $conta->fornecedor_cnpj . '</td>';
                    $html .= '<td align="rigth">Vencida</td>';
                    $html .= '<td>' . 'R$ ' . $conta->conta_pagar_valor . '</td>';
                    $html .= '</tr>';
//
                endforeach;

//                echo'<pre>';
//                print_r($conta);
//                exit();


                $valor_final_contas = $this->financeiro_model->get_sum_contas_pagar_relatorio($conta_pagar_status, $data_vencimento);
//
                $html .= '<th colspan="4">';
//
                $html .= '<td style="border-top: solid #ddd 2px"><strong>Valor Final</strong></td>';
                $html .= '<td style="border-top: solid #ddd 2px">' . 'R$ ' . $valor_final_contas->conta_pagar_valor_total . '</td>';
//
                $html .= '</th>';
//
                $html .= '</table>';

                $html .= '<hr>';

                $html .= '<p align="center" style="font-size: 12px"> Buscai ao Senhor enquanto se pode achar, invocai-o enquanto está perto. Isaías 55:6</p><br>';

                $html .= '</body>';
                $html .= '</html>';

                //false abre PDF direto no navegador
                //true faz download
                $this->pdf->createPDF($html, $file_name, false);
                    
                } else {
                    
                    $this->session->set_flashdata('info', 'Nenhuma conta vencida foi encontrada!');
                    
                }

                
            }
            
            if ($contas == 'pagar') {

//                echo'<pre>';
//                print_r('$contas');
//                exit();

                $conta_pagar_status = 1;

                $data_vencimento = FALSE;
                
                if($contas = $this->financeiro_model->get_contas_pagar_relatorio($conta_pagar_status, $data_vencimento)){
                    
                    //montar pdf

                $empresa = $this->core_model->get_by_id('sistema', array('sistema_id' => 1));


//            $situacao = $this->ordem_servicos_model->get_by_id($situacao_id);

                $contas = $this->financeiro_model->get_contas_pagar_relatorio($conta_pagar_status, $data_vencimento);

                $file_name = 'Relatório de Contas Pagas';

                $html = '<html>';

                $html .= '<head>';

                $html .= '<title>' . $empresa->sistema_nome_fantasia . ' | Relatório de Contas Pagas</title>';

                $html .= '</head>';

                $html .= '<body style="font-size: 14px">';

//dados da empresa
                $html .= '<h4 align="center">
                       ' . $empresa->sistema_razao_social . '  | CNPJ:' . $empresa->sistema_cnpj . ' <br>
                       ' . $empresa->sistema_endereco . ', ' . $empresa->sistema_numero . ' | ' . $empresa->sistema_cidade . ' <br>
                       ' . $empresa->sistema_telefone_movel . '  |  ' . $empresa->sistema_telefone_fixo . ' <br>
                     </h4>';

                $html .= '<hr>';

//            //dados da OS
//
//
                $html .= '<table width="100%" border: solid #ddd 1px>';


                $html .= '<tr>';
                $html .= '<th>ID da Conta</th>';
                $html .= '<th>Data de Pagamento</th>';
                $html .= '<th>Fornecedor</th>';
                $html .= '<th>CNPJ</th>';
                $html .= '<th>Situação</th>';
                $html .= '<th>Valor Total</th>';
                $html .= '</tr>';
//
//                $vendas_venda = $this->vendas_model->get_all_produtos($venda_id);


                foreach ($contas as $conta):
//
                    $html .= '<tr>';
                    $html .= '<td align="center">' . $conta->conta_pagar_id . '</td>';
                    $html .= '<td align="center">' . formata_data_banco_com_hora($conta->conta_pagar_data_pagamento) . '</td>';
                    $html .= '<td align="left">' . $conta->fornecedor_nome_fantasia . '</td>';
                    $html .= '<td align="left">' . $conta->fornecedor_cnpj . '</td>';
                    $html .= '<td align="rigth">Paga</td>';
                    $html .= '<td>' . 'R$ ' . $conta->conta_pagar_valor . '</td>';
                    $html .= '</tr>';
//
                endforeach;

//                echo'<pre>';
//                print_r($conta);
//                exit();


                $valor_final_contas = $this->financeiro_model->get_sum_contas_pagar_relatorio($conta_pagar_status, $data_vencimento);
//
                $html .= '<th colspan="4">';
//
                $html .= '<td style="border-top: solid #ddd 2px"><strong>Valor Final</strong></td>';
                $html .= '<td style="border-top: solid #ddd 2px">' . 'R$ ' . $valor_final_contas->conta_pagar_valor_total . '</td>';
//
                $html .= '</th>';
//
                $html .= '</table>';

                $html .= '<hr>';

                $html .= '<p align="center" style="font-size: 12px"> Buscai ao Senhor enquanto se pode achar, invocai-o enquanto está perto. Isaías 55:6</p><br>';

                $html .= '</body>';
                $html .= '</html>';

                //false abre PDF direto no navegador
                //true faz download
                $this->pdf->createPDF($html, $file_name, false);
                    
                } else {
                    
                    $this->session->set_flashdata('info', 'Nenhuma conta paga foi encontrada!');
                    
                }

                
            }
            
            if ($contas == 'a_pagar') {

//                echo'<pre>';
//                print_r('$contas');
//                exit();

                $conta_pagar_status = 0;

                $data_vencimento = FALSE;
                
                if($contas = $this->financeiro_model->get_contas_pagar_relatorio($conta_pagar_status, $data_vencimento)){
                    
                    //montar pdf

                $empresa = $this->core_model->get_by_id('sistema', array('sistema_id' => 1));


//            $situacao = $this->ordem_servicos_model->get_by_id($situacao_id);

                $contas = $this->financeiro_model->get_contas_pagar_relatorio($conta_pagar_status, $data_vencimento);

                $file_name = 'Relatório de Contas a pagar';

                $html = '<html>';

                $html .= '<head>';

                $html .= '<title>' . $empresa->sistema_nome_fantasia . ' | Relatório de Contas a pagar</title>';

                $html .= '</head>';

                $html .= '<body style="font-size: 14px">';

//dados da empresa
                $html .= '<h4 align="center">
                       ' . $empresa->sistema_razao_social . '  | CNPJ:' . $empresa->sistema_cnpj . ' <br>
                       ' . $empresa->sistema_endereco . ', ' . $empresa->sistema_numero . ' | ' . $empresa->sistema_cidade . ' <br>
                       ' . $empresa->sistema_telefone_movel . '  |  ' . $empresa->sistema_telefone_fixo . ' <br>
                     </h4>';

                $html .= '<hr>';

//            //dados da OS
//
//
                $html .= '<table width="100%" border: solid #ddd 1px>';


                $html .= '<tr>';
                $html .= '<th>Conta</th>';
                $html .= '<th style="width:150px" align="center">Descrição</th>';
                $html .= '<th>Vencimento</th>';
                $html .= '<th>Fornecedor</th>';
                $html .= '<th>CNPJ</th>';
                $html .= '<th>Situação</th>';
                $html .= '<th>Valor</th>';
                $html .= '</tr>';
//
//                $vendas_venda = $this->vendas_model->get_all_produtos($venda_id);


                foreach ($contas as $conta):
//
                    $html .= '<tr>';
                    $html .= '<td align="left">' . $conta->conta_pagar_id . '</td>';
                    $html .= '<td align="center" style="width:100px">' . $conta->conta_pagar_descricao . '</td>';
                    $html .= '<td align="center">' . formata_data_banco_sem_hora($conta->conta_pagar_data_vencimento) . '</td>';
                    $html .= '<td align="left">' . $conta->fornecedor_nome_fantasia . '</td>';
                    $html .= '<td align="left">' . $conta->fornecedor_cnpj . '</td>';
                    $html .= '<td align="rigth">A Pagar</td>';
                    $html .= '<td>' . 'R$ ' . $conta->conta_pagar_valor . '</td>';
                    $html .= '</tr>';
//
                endforeach;

//                echo'<pre>';
//                print_r($conta);
//                exit();


                $valor_final_contas = $this->financeiro_model->get_sum_contas_pagar_relatorio($conta_pagar_status, $data_vencimento);
//
                $html .= '<th colspan="5">';
//
                $html .= '<td style="border-top: solid #ddd 2px"><strong>Valor Final</strong></td>';
                $html .= '<td style="border-top: solid #ddd 2px">' . 'R$ ' . $valor_final_contas->conta_pagar_valor_total . '</td>';
//
                $html .= '</th>';
//
                $html .= '</table>';

                $html .= '<hr>';

                $html .= '<p align="center" style="font-size: 12px"> Buscai ao Senhor enquanto se pode achar, invocai-o enquanto está perto. Isaías 55:6</p><br>';

                $html .= '</body>';
                $html .= '</html>';

                //false abre PDF direto no navegador
                //true faz download
                $this->pdf->createPDF($html, $file_name, false);
                    
                } else {
                    
                    $this->session->set_flashdata('info', 'Nenhuma conta a pagar foi encontrada!');
                    
                }

                
            }
            
        }
        

        $this->load->view('layout/header', $data);
        $this->load->view('relatorios/pagar');
        $this->load->view('layout/footer');
    }

}

//fim da classe


