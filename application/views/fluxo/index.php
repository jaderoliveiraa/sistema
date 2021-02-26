
<?php
$this->load->view('layout/sidebar');
$soma_pagar = 0;
$soma_receber = 0;
$soma_vendas = 0;
$soma_os = 0;
?>



<!-- Main Content -->
<div id="content">

    <?php $this->load->view('layout/navbar'); ?>

    <!-- Begin Page Content -->
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url('/'); ?>">Início</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo $titulo; ?></li>
            </ol>
        </nav>

        <!-- Para erro -->
        <?php if ($message = $this->session->flashdata('error')): ?>

            <div class="row">

                <div class="col-md-12">

                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong><i class="fas fa-exclamation-triangle"></i>&nbsp; <?php echo $message ?></strong> 
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                </div>

            </div>

        <?php endif; ?>

        <!-- para sucesso -->
        <?php if ($message = $this->session->flashdata('sucesso')): ?>

            <div class="row">

                <div class="col-md-12">

                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong><i class="far fa-smile-wink"></i>&nbsp; <?php echo $message ?></strong> 
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                </div>

            </div>
            <!-- Para Info -->
            <?php if ($message = $this->session->flashdata('info')): ?>

                <div class="row">

                    <div class="col-md-12">

                        <div class="alert alert-warning alert-dismissible fade show text-gray-900" role="alert">
                            <strong><i class="fas fa-exclamation-triangle"></i>&nbsp;&nbsp; <?php echo $message ?></strong> 
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                    </div>

                </div>

            <?php endif; ?>

        <?php endif; ?>



        <!-- DataTales Example -->

        <div class="card shadow mb-4 col-12 pt-2">
            <div class="card-header pt-3 pb-1">
                <label><h4>Fluxo de Caixa <?php echo formata_data_banco_sem_hora(date('Y-m-d')) ?></h4></label>
            </div>

            <div class="row col-12">
                <div class="col-lg-6 mb-4 ">

                    <!-- Contas Pagas -->
                    <div class="card shadow mb-4 ">
                        <div class="card-header py-3">
                            <h6 class=" font-weight-bold text-danger mb-0" align="center">Contas Pagas</h6>
                        </div>
                        <div class="card-body">

                            <div class="table col-auto">
                                <table class="table table-bordered" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Descricão</th>
                                            <th class="text-center">Valor</th>
                                            <th class="text-center">Data de Pagamento</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php foreach ($pagar as $pagar): ?>
                                            <?php $pagar->conta_pagar_valor = str_replace(',', '', $pagar->conta_pagar_valor) ?>
                                            <tr>
                                                <td class="text-center"><?php echo $pagar->conta_pagar_descricao ?></td>
                                                <td class="text-center"><?php echo 'R$&nbsp;' . $pagar->conta_pagar_valor ?></td>
                                                <td class="text-center"><?php echo formata_data_banco_sem_hora($pagar->conta_pagar_data_pagamento) ?></td>

                                            </tr>

                                            <?php
                                            $soma_pagar += floatval($pagar->conta_pagar_valor);
                                            ?>

                                        <?php endforeach; ?>

                                    </tbody>

                                </table>
                                <div class="text-right">
                                    <span >Total de contas Pagas Hoje: <b class="text-danger"><?php echo 'R$ ' . number_format($soma_pagar, 2); ?></b></span>
                                </div>


                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-lg-6 mb-4">

                    <!-- (Contas recebidas) -->
                    <div class="card shadow mb-0 ">
                        <div class="card-header py-3">
                            <h6 class=" font-weight-bold text-success mb-0" align="center">Contas Recebidas</h6>
                        </div>
                        <div class="card-body">


                            <div class="table col-auto">
                                <table class="table table-bordered" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Descricão</th>
                                            <th class="text-center">Valor</th>
                                            <th class="text-center">Data de Recebimento</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php foreach ($receber as $receber): ?>
                                            <?php $receber->conta_receber_valor = str_replace(',', '', $receber->conta_receber_valor) ?>
                                            <tr>
                                                <td class="text-center"><?php echo $receber->conta_receber_id ?></td>
                                                <td class="text-center"><?php echo 'R$&nbsp;' . $receber->conta_receber_valor ?></td>
                                                <td class="text-center"><?php echo ($receber->conta_receber_status == 1 ? formata_data_banco_com_hora($receber->conta_receber_data_pagamento) : 'Aguardando pagamento') ?></td>
                                            </tr>
                                            <?php
                                            $soma_receber += floatval($receber->conta_receber_valor);
                                            ?>

                                        <?php endforeach; ?>

                                    </tbody>
                                </table>
                                <div class="text-right">
                                    <span>Total de Vendas de Hoje: <b class="text-success"><?php echo 'R$ ' . number_format(($soma_receber), 2, '.', ''); ?></b></span>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

            <!--( Segunda Linha )-->

            <div class="row col-12">
                <div class="col-lg-6 mb-4 ">

                    <!-- ( Vendas ) -->
                    <div class="card shadow mb-4 ">
                        <div class="card-header py-3">
                            <h6 class=" font-weight-bold text-success mb-0" align="center">Vendas</h6>
                        </div>
                        <div class="card-body">

                            <div class="table col-auto">
                                <table class="table table-bordered" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Cliente</th>
                                            <th class="text-center">Vendedor</th>
                                            <th class="text-center">Valor</th>
                                            <th class="text-center">Data da Venda</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php foreach ($vendas as $vendas): ?>
                                            <?php $vendas->venda_valor_total = str_replace(',', '', $vendas->venda_valor_total) ?>
                                            <tr>
                                                <td class="text-center"><?php echo $vendas->cliente_nome_completo ?></td>
                                                <td class="text-center"><?php echo $vendas->vendedor_nome_completo ?></td>
                                                <td class="text-right"><?php echo 'R$&nbsp;' . $vendas->venda_valor_total ?></td>
                                                <td class="text-center"><?php echo formata_data_banco_sem_hora($vendas->venda_data_emissao) ?></td>
                                            </tr>

                                            <?php
                                            $soma_vendas += floatval($vendas->venda_valor_total);
                                            ?>

                                        <?php endforeach; ?>

                                    </tbody>

                                </table>
                                <div class="text-right">
                                    <span>Total de Vendas de Hoje: <b class="text-success"><?php echo 'R$ ' . number_format($soma_vendas, 2); ?></b></span>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-lg-6 mb-4">

                    <!-- (Ordem de Serviços) -->
                    <div class="card shadow mb-0 ">
                        <div class="card-header py-3">
                            <h6 class=" font-weight-bold text-success mb-0" align="center">Ordens de Serviços</h6>
                        </div>
                        <div class="card-body">


                            <div class="table col-auto">
                                <table class="table table-bordered" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Cliente</th>
                                            <th class="text-center">Equipamento</th>
                                            <th class="text-center">Valor</th>
                                            <th class="text-center">Data Finalização</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php foreach ($os as $os): ?>
                                            <tr>
                                                <td class="text-center"><?php echo $os->cliente_nome ?></td>
                                                <td class="text-center"><?php echo $os->ordem_servico_equipamento ?></td>
                                                <td><?php echo 'R$&nbsp;' . str_replace('.', ',', $os->ordem_servico_valor_total) ?></td>
                                                <td class="text-center"><?php echo formata_data_banco_com_hora($os->ordem_servico_data_conclusao) ?></td>
                                            </tr>

                                            <?php
                                            $soma_os += floatval($os->ordem_servico_valor_total);
                                            ?>

                                        <?php endforeach; ?>


                                    </tbody>
                                </table>
                                <div class="text-right">
                                    <span>Total de Ordens de Serviços de Hoje: <b class="text-success"><?php echo 'R$ ' . number_format($soma_os, 2); ?></b></span>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
            <div class="text-right p-3">
                <span class="text-gray-900"><h3>Total de Receitas = <b class="text-success"><?php echo 'R$ ' . number_format($soma_os + $soma_receber + $soma_vendas, 2) ?></b></h3></span>
                <span class="text-gray-900"><h3>Total de Despesas = <b class="text-danger"><?php echo 'R$ ' . number_format($soma_pagar, 2); ?></b></h3></span>
                <?php $soma_total = $soma_os + $soma_receber + $soma_vendas - $soma_pagar ?>
                <span class="text-gray-900"><h3><b>TOTAL</b> = <b class="<?php echo ($soma_total > 0 ? 'text-success' : 'text-danger') ?>"><?php echo 'R$ ' . number_format($soma_total, 2) ?></b></h3></span>
            </div>
            <!--( Fim da Segunda Linha )-->

        </div>


        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

