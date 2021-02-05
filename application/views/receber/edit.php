

<?php $this->load->view('layout/sidebar'); ?>



<!-- Main Content -->
<div id="content">

    <?php $this->load->view('layout/navbar'); ?>

    <!-- Begin Page Content -->
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url('/'); ?>">Início</a></li>
                <li class="breadcrumb-item"><a href="<?php echo base_url('receber'); ?>">Contas a Receber</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo $titulo; ?></li>
            </ol>
        </nav>

        <!-- DataTales Example -->
        <div class="card shadow ">
            <div class="card-header py-3 pb-0 mb-0 form-control form-control-user-date">
                <p><strong><i class="fas fa-clock" style="color: blue;"></i>&nbsp;Última Edição:  </strong><?php echo formata_data_banco_com_hora($conta_receber->conta_receber_data_alteracao); ?></p>
            </div>

            <div class="card-body pt-0 mt-0">
                <form method="POST" name="form_edit">

                    <!-- Dados pessoais -->
                    <fieldset class="m-2 mt-0 border pl-2 pr-2 pb-1 pt-1">
                        <legend class="font-small"><i class="fas fa-comment-dollar" style="color: ForestGreen;"></i>&nbsp;Dados da conta</legend>

                        <div class="form-group row">
                            <div class="col-md-5">
                                <label>Cliente</label>
                                <select class="custom-select contas_receber" name="conta_receber_cliente_id">
                                    <?php foreach ($clientes as $cliente): ?>
                                        <option value="<?php echo $cliente->cliente_id ?>" <?php echo ($cliente->cliente_id == $conta_receber->conta_receber_cliente_id ? 'selected' : '') ?>><?php echo $cliente->cliente_nome ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?php echo form_error('conta_receber_cliente_id', '<small class="form-text text-danger">', '</small>'); ?>
                            </div>
                            
                            <div class="col-md-4">
                                <label>Data de vencimento</label>
                                <input type="date" class="form-control form-control-user-date" name="conta_receber_data_vencimento" value="<?php echo $conta_receber->conta_receber_data_vencimento ?>">
                                <?php echo form_error('conta_receber_data_vencimento', '<small class="form-text text-danger">', '</small>'); ?>
                            </div>
                            
                            <div class="col-md-3">
                                <label for="formGroupExampleInput">Valor da conta</label>
                                <input type="text" class="form-control form-control-user-date money2" name="conta_receber_valor" placeholder="Valor da Conta" value="<?php echo $conta_receber->conta_receber_valor ?>">
                                <?php echo form_error('conta_receber_valor', '<small class="form-text text-danger">', '</small>'); ?>
                            </div>

                        </div>
                        
                        <div class="form-group row">

                            <div class="col-md-3">
                                <label for="formGroupExampleInput">Situação</label>
                                <select class="custom-select" name="conta_receber_status">

                                    <option value="1" <?php echo ($conta_receber->conta_receber_status == 1 ? 'selected' : '') ?>>Pagamento Efetuado</option>
                                    <option value="0" <?php echo ($conta_receber->conta_receber_status == 0 ? 'selected' : '') ?>>Pagamento não Efetuado</option>

                                </select>

                            </div>

                            <div class="col-md-9">
                                <label>Observações</label>
                                <textarea class="form-control h-50" name="conta_receber_obs"><?php echo $conta_receber->conta_receber_obs ?></textarea>
                                <?php echo form_error('conta_receber_obs', '<small class="form-text text-danger">', '</small>'); ?>
                            </div>       

                        </div>

                    </fieldset>

                        

                    <!-- campos ocultos -->
                    <div class="form-group row">

                        <input type="hidden" name="conta_receber_id" value="<?php echo $conta_receber->conta_receber_id ?>"  />

                    </div>

                    <div class="form-group row float-right mt-2 mb-0">
                        <div class="col-md-12 float-right">
                            <a title="Voltar para a lista de produtos" href="<?php echo base_url('receber'); ?>" class="btn btn-success btn-sm mr-2"><i class="fas fa-arrow-left"></i>&nbsp; Voltar</i></a>
                            <button type="submit" class="btn btn-primary btn-sm float-right"<?php echo ($conta_receber->conta_receber_status == 1 ? 'disabled': '') ?> ><?php echo ($conta_receber->conta_receber_status == 1 ? 'Conta Paga': 'Salvar') ?></button>
                            
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

