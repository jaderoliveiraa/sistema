
<?php $this->load->view('layout/sidebar'); ?>



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
                <label><h4>Fluxo de Caixa</h4></label>
            </div>
            <div class="card-body pt-0">
                <!-- (Contas recebidas) -->
                <div class="table col-auto">
                    <div class="card-header py-0">
                        <label class="text-success"><h6>Contas Recebidas</h6></label>
                    </div>
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center">Descricão</th>
                                <th class="text-center">Tipo</th>
                                <th class="text-center">Valor</th>
                                <th class="text-center">Data</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach ($receber as $receber): ?>
                                <tr>
                                    <td class="text-center"><?php echo $receber->contas_receber_descricao ?></td>
                                    <td class="text-center"><?php echo 'R$&nbsp;' . $receber->conta_receber_valor ?></td>
                                    <td class="text-center"><?php echo formata_data_banco_sem_hora($receber->conta_receber_data_pagamento) ?></td>
                                    <td class="text-center"><?php echo ($receber->conta_receber_status == 1 ? formata_data_banco_com_hora($receber->conta_receber_data_pagamento) : 'Aguardando pagamento') ?></td>
                                </tr>

                            <?php endforeach; ?>

                        </tbody>
                    </table>
                </div>

            </div>
            <div class="card-body pt-0">
                <div class="table col-auto">
                    <div class="card-header py-0">
                        <label class="text-danger"><h6>Contas Pagas</h6></label>
                    </div>
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center">Descricão</th>
                                <th class="text-center">Tipo</th>
                                <th class="text-center">Valor</th>
                                <th class="text-center">Data</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach ($pagar as $pagar): ?>
                                <tr>
                                    <td class="text-center"><?php echo $pagar->conta_pagar_descricao ?></td>
                                    <td class="text-center"><?php echo 'R$&nbsp;' . $pagar->conta_pagar_valor ?></td>
                                    <td class="text-center"><?php echo formata_data_banco_sem_hora($pagar->conta_pagar_data_pagamento) ?></td>
                                    <td class="text-center"><?php echo $pagar->conta_pagar_status ?></td>
                                </tr>

                            <?php endforeach; ?>

                        </tbody>
                    </table>
                </div>
            </div>
            
            <div class="card-body pt-0">
                <!-- (Vendas) -->
                <div class="table col-auto">
                    <div class="card-header py-0">
                        <label class="text-success"><h6>Vendas</h6></label>
                    </div>
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center">Cliente</th>
                                <th class="text-center">Vendedor</th>
                                <th class="text-center">Valor</th>
                                <th class="text-center">Data</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach ($vendas as $vendas): ?>
                                <tr>
                                    <td class="text-center"><?php echo $vendas->cliente_nome_completo?></td>
                                    <td class="text-center"><?php echo $vendas->vendedor_nome_completo?></td>
                                    <td class="text-right"><?php echo 'R$&nbsp;' . $vendas->venda_valor_total ?></td>
                                    <td class="text-center"><?php echo formata_data_banco_com_hora($vendas->venda_data_emissao) ?></td>
                                </tr>

                            <?php endforeach; ?>

                        </tbody>
                    </table>
                </div>

            </div>
            
            <div class="card-body pt-0">
                <!-- (Ordem de Serviços) -->
                <div class="table col-auto">
                    <div class="card-header py-0">
                        <label class="text-success"><h6>Ordens de Serviços</h6></label>
                    </div>
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center">Cliente</th>
                                <th class="text-center">Equipamento</th>
                                <th class="text-center">Valor</th>
                                <th class="text-center">Data</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach ($os as $os): ?>
                                <tr>
                                    <td class="text-center"><?php echo $os->cliente_nome ?></td>
                                    <td class="text-center"><?php echo $os->ordem_servico_equipamento ?></td>
                                    <td><?php echo 'R$&nbsp;' . $os->ordem_servico_valor_total ?></td>
                                    <td class="text-center"><?php echo formata_data_banco_com_hora($vendas->venda_data_emissao) ?></td>
                                </tr>

                            <?php endforeach; ?>

                        </tbody>
                    </table>
                </div>

            </div>
        </div>        

    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

