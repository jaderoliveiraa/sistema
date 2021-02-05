

<?php $this->load->view('layout/sidebar'); ?>



<!-- Main Content -->
<div id="content">

    <?php $this->load->view('layout/navbar'); ?>

    <!-- Begin Page Content -->
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url('/'); ?>">Início</a></li>
                <li class="breadcrumb-item"><a href="<?php echo base_url('situacoes'); ?>">Situações</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo $titulo; ?></li>
            </ol>
        </nav>

        <!-- DataTales Example -->
        <div class="card shadow ">
            <div class="card-header py-3 pb-0 mb-0 form-control form-control-user-date">
                <p><strong><i class="fas fa-clock" style="color: blue;"></i>&nbsp;Última Edição:  </strong><?php echo formata_data_banco_com_hora($situacoes->situacao_data_alteracao); ?></p>
            </div>

            <div class="card-body pt-0 mt-0">
                <form method="POST" name="form_edit">

                    <!-- Dados pessoais -->
                    <fieldset class="m-2 mt-0 border pl-2 pr-2 pb-1 pt-1">
                        <legend class="font-small"><i class="fas fa-screwdriver" style="color: orange;"></i>&nbsp;Situações</legend>
                        <div class="form-group row">

                            <div class="col-md-6">
                                <label for="formGroupExampleInput">Situação</label>
                                <input type="text" class="form-control form-control-user-date  h-50" name="situacao_nome" placeholder="Digite a situação" value="<?php echo $situacoes->situacao_nome ?>">
                                <?php echo form_error('situacao_nome', '<small class="form-text text-danger">', '</small>'); ?>
                            </div>

                            <div class="col-md-6">
                                <label for="formGroupExampleInput">Situação</label>
                                <select class="form-control form-control-user-date h-50" name="situacao_ativa">

                                    <option class="h-50" value="1" <?php echo($situacoes->situacao_ativa == 1) ? 'selected' : '' ?>>Ativa</option>
                                    <option class="h-50" value="0" <?php echo($situacoes->situacao_ativa == 0) ? 'selected' : '' ?>>Inativa</option>

                                </select>
                            </div>

                        </div>

                    </fieldset>


                    <!-- campos ocultos -->

                    <div class="form-group row">

                        <input type="hidden" name="situacao_id" value="<?php echo $situacoes->situacao_id ?>"  />

                    </div>

                    <div class="form-group row float-right mt-2 mb-0">
                        <div class="col-md-12 float-right">
                            <a title="Voltar para a lista de Situações" href="<?php echo base_url('situacoes'); ?>" class="btn btn-success btn-sm mr-2"><i class="fas fa-arrow-left"></i>&nbsp; Voltar</i></a>
                            <button type="submit" class="btn btn-primary btn-sm float-right">Salvar</button>
                        </div>

                    </div>
                </form>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
</div>
<!-- comment -->

<!-- End of Main Content -->

