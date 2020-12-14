
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
                <label><h4>Fornecedores</h4></label>
                <a title="Cadastrar novo Fornecedor" href="<?php echo base_url('fornecedores/add') ?>" class="btn btn-success btn-sm float-right"><i class="fas fa-user-tag">&nbsp;Novo</i></i></a>
            </div>
            <div class="card-body pt-0">
                <div class="table-responsive">
                    <table class="table table-bordered dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center pr-2">Código</th>
                                <th class="text-center">Nome Fantasia</th>
                                <th class="text-center">CNPJ</th>
                                <th class="text-center">Telefone</th>
                                <th class="text-center">E-mail</th>
                                <th class="text-center pr-2">Situação</th>
                                <th class="text-center no-sort">ações</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach ($fornecedores as $fornecedor): ?>
                                <tr>
                                    <td class="text-center"><?php echo $fornecedor->fornecedor_id ?></td>
                                    <td><?php echo $fornecedor->fornecedor_nome_fantasia ?></td>
                                    <td><?php echo $fornecedor->fornecedor_cnpj ?></td>
                                    <td><?php echo $fornecedor->fornecedor_telefone ?></td>
                                    <td><?php echo $fornecedor->fornecedor_email ?></td>
                                    <td class="text-center">
                                        <?php echo ($fornecedor->fornecedor_ativo == 1 ? '<span class="badge badge-info btn-sm">Ativo</span>' : '<span class="badge badge-primary btn-sm">Inativo</span>'); ?></td>
                                    <td class="text-center">
                                        <a title="Editar" href="<?php echo base_url('fornecedores/edit/' . $fornecedor->fornecedor_id); ?>" class="btn btn-sm btn-primary"><i class="fas fa-user-edit"></i></a>
                                        <a title="Excluir" href="javascript(void)" data-toggle="modal" data-target="#fornecedor-<?php echo $fornecedor->fornecedor_id; ?>" class="btn btn-sm btn-danger"><i class="fas fa-user-times"></i></a>
                                    </td>
                                </tr>

                                 <!-- Delete Modal-->
                            <div class="modal fade" id="fornecedor-<?php echo $fornecedor->fornecedor_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Deseja realmente Excluir esse registro?</h5>
                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">Selecione <strong class="text-success text-uppercase">"Sim"</strong> para Deletar o Fornecedor ou <strong class="text-danger text-uppercase">"Não"</strong> para cancelar!</div>
                                        <div class="modal-footer">
                                            <button class="btn btn-danger" type="button" data-dismiss="modal">Não</button>
                                            <a class="btn btn-success" href="<?php echo base_url('fornecedores/del/' . $fornecedor->fornecedor_id); ?>">Sim</a>
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

