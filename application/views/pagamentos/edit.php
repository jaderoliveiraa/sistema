

<?php $this->load->view('layout/sidebar'); ?>



<!-- Main Content -->
<div id="content">

    <?php $this->load->view('layout/navbar'); ?>

    <!-- Begin Page Content -->
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url('/'); ?>">Início</a></li>
                <li class="breadcrumb-item"><a href="<?php echo base_url('pagamentos'); ?>">Formas de Pagamento</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo $titulo; ?></li>
            </ol>
        </nav>

        <!-- DataTales Example -->
        <div class="card shadow ">

            <div class="card-header py-3 pb-0 mb-0 form-control form-control-user-date">
                <p><strong><i class="fas fa-clock" style="color: blue;"></i>&nbsp;Última Edição:  </strong><?php echo formata_data_banco_com_hora($forma_pagamento->forma_pagamento_data_alteracao); ?></p>
            </div>

            <div class="card-body pt-0 mt-0">
                <form method="POST" name="form_edit">

                    <!-- Dados pessoais -->
                    <fieldset class="m-2 mt-0 border pl-2 pr-2 pb-1 pt-1">
                        <legend class="font-small"><i class="fas fa-comment-dollar" style="color: ForestGreen;"></i>&nbsp;Dados da conta</legend>

                        <div class="form-group row">

                            <div class="col-md-4">
                                <label for="formGroupExampleInput">Descrição</label>
                                <input type="text" class="form-control form-control-user-date" name="forma_pagamento_nome" placeholder="Descrição da Conta" value="<?php echo $forma_pagamento->forma_pagamento_nome ?>">
                                <?php echo form_error('forma_pagamento_nome', '<small class="form-text text-danger">', '</small>'); ?>
                            </div>

                            <div class="col-md-4">
                                <label for="formGroupExampleInput">Situação</label>
                                <select class="custom-select" name="forma_pagamento_ativa">
                                    <option value="1" <?php echo ($forma_pagamento->forma_pagamento_ativa == 1 ? 'selected' : '') ?>>Ativa</option>
                                    <option value="0" <?php echo ($forma_pagamento->forma_pagamento_ativa == 0 ? 'selected' : '') ?>>Inativa</option>
                                </select>

                            </div>

                            <div class="col-md-4">
                                <label for="formGroupExampleInput">Aceita Parcelameento</label>
                                <select class="custom-select" name="forma_pagamento_aceita_parc">
                                    <option value="1" <?php echo ($forma_pagamento->forma_pagamento_aceita_parc == 1 ? 'selected' : '') ?>>Sim</option>
                                    <option value="0" <?php echo ($forma_pagamento->forma_pagamento_aceita_parc == 0 ? 'selected' : '') ?>>Não</option>
                                </select>

                            </div>     

                        </div>

                    </fieldset>

                    <!-- campos ocultos -->
                    <div class="form-group row">
                        <input type="hidden" name="forma_pagamento_id" value="<?php echo $forma_pagamento->forma_pagamento_id ?>"/>
                    </div>

                    <div class="form-group row float-right mt-2 mb-0">
                        <div class="col-md-12 float-right">
                            <a title="Voltar para a lista de produtos" href="<?php echo base_url('pagamentos'); ?>" class="btn btn-success btn-sm mr-2"><i class="fas fa-arrow-left"></i>&nbsp; Voltar</i></a>
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

