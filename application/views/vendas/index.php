
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

        <?php endif; ?>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            
            <div class="card-header py-3">
                <label><h4>Vendas</h4></label>
                <a title="Cadastrar Nova Venda" href="<?php echo base_url('vendas/add') ?>" class="btn btn-success btn-sm float-right"><i class="fas fa-cart-plus"></i>&nbsp;&nbsp;Nova</i></i></a>
            </div>
            <div class="card-body pt-0">
                <div class="table-responsive">
                    <table class="table table-bordered dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center no-sort">ID</th>
                                <th class="text-center">Data de Emissão</th>
                                <th class="text-center">Cliente</th>
                                <th class="text-center">Valor Total</th>
                                <th class="text-center">Forma de pagamento</th>
                                <th class="text-center no-sort">ações</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach ($vendas as $vendas): ?>
                                <tr>
                                    <td class="text-center"><?php echo $vendas->venda_id?></td>
                                    <td class="text-center"><?php echo formata_data_banco_com_hora($vendas->venda_data_emissao) ?></td>
                                    <td class="text-center"><?php echo $vendas->cliente_nome . '&nbsp' . $vendas->cliente_sobrenome?></td>
                                    <td class="text-right"><?php echo 'R$&nbsp;' . $vendas->venda_valor_total ?></td>
                                    <td class="text-center"><?php echo $vendas->forma_pagamento; ?></td>
                                    
                                    
                                    <td class="text-center">
                                        <a title="Imprimir OS" href="<?php echo base_url('vendas/pdf/' . $vendas->venda_id); ?>" class="btn btn-sm btn-dark"><i class="fas fa-print"></i></a>
                                        <a title="Editar" href="<?php echo base_url('vendas/edit/' . $vendas->venda_id); ?>" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
                                        <a title="Excluir" href="javascript(void)" data-toggle="modal" data-target="#venda-<?php echo $vendas->venda_id; ?>" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></a>
                                    </td>
                                </tr>

                                 <!-- Delete Modal-->
                            <div class="modal fade" id="venda-<?php echo $vendas->venda_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Deseja realmente Excluir esse registro?</h5>
                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">Selecione <strong class="text-success text-uppercase">"Sim"</strong> para Deletar o Usuário ou <strong class="text-danger text-uppercase">"Não"</strong> para cancelar!</div>
                                        <div class="modal-footer">
                                            <button class="btn btn-danger" type="button" data-dismiss="modal">Não</button>
                                            <a class="btn btn-success" href="<?php echo base_url('vendas/del/' . $vendas->venda_id); ?>">Sim</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                
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

