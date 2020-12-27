
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
        <div class="card shadow mb-4">

            <div class="card-header py-3">
                <label><h4>Formas de Pagamento</h4></label>
                <a title="Cadastrar Formas de Pagamento" href="<?php echo base_url('pagamentos/add') ?>" class="btn btn-success btn-sm float-right"><i class="fas fa-tags"></i>&nbsp;&nbsp;Nova</i></i></a>
            </div>
            <div class="card-body pt-0">
                <div class="table-responsive">
                    <table class="table table-bordered dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center no-sort">ID</th>
                                <th class="text-center">Descrição</th>
                                <th class="text-center">Aceita Parcelamento</th>
                                <th class="text-center pr-2">Situação</th>
                                <th class="text-center no-sort">ações</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach ($formas_pagamentos as $pagamentos): ?>
                                <tr>
                                    <td class="text-center"><?php echo $pagamentos->forma_pagamento_id?></td>
                                    <td class="text-center"><?php echo $pagamentos->forma_pagamento_nome ?></td>
                                    <td class="text-center">
                                        <?php echo ($pagamentos->forma_pagamento_aceita_parc == 1 ? '<span class="badge badge-success btn-sm">Sim</span>' : '<span class="badge badge-secondary btn-sm">Não</span>'); ?>
                                    </td>
                                    <td class="text-center">
                                        <?php echo ($pagamentos->forma_pagamento_ativa == 1 ? '<span class="badge badge-info btn-sm">Ativa</span>' : '<span class="badge badge-primary btn-sm">Inativa</span>'); ?>
                                    </td>
                                    <td class="text-center">
                                        <a title="Editar" href="<?php echo base_url('pagamentos/edit/' . $pagamentos->forma_pagamento_id); ?>" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></i></a>
                                        <a title="Excluir" href="javascript(void)" data-toggle="modal" data-target="#pagamento-<?php echo $pagamentos->forma_pagamento_id; ?>" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></i></a>
                                    </td>
                                </tr>

                                <!-- Delete Modal-->
                            <div class="modal fade" id="pagamento-<?php echo $pagamentos->forma_pagamento_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Deseja realmente Excluir esse registro?</h5>
                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body"><i class="fas fa-exclamation-circle fa-3x align-middle" style="color: yellow"></i>&nbsp;&nbsp;Selecione <strong class="text-success text-uppercase">"Sim"</strong> para Deletar ou <strong class="text-danger text-uppercase">"Não"</strong> para cancelar!</div>
                                        <div class="modal-footer">
                                            <button class="btn btn-danger" type="button" data-dismiss="modal">Não</button>
                                            <a class="btn btn-success" href="<?php echo base_url('pagamentos/del/' . $pagamentos->forma_pagamento_id); ?>">Sim</a>
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

