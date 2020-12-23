

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

            <div class="card-body pt-0 mt-0">
                <form method="POST" name="form_add">

                    <!-- Dados pessoais -->
                    <fieldset class="m-2 mt-0 border pl-2 pr-2 pb-1 pt-1">
                        <legend class="font-small"><i class="fas fa-comment-dollar" style="color: ForestGreen;"></i>&nbsp;Dados da conta</legend>

                        <div class="form-group row">
                            <div class="col-md-5">
                                <label>Cliente</label>
                                <select class="custom-select contas_receber" name="conta_receber_cliente_id">
                                    <?php foreach ($clientes as $cliente): ?>
                                        <option value="<?php echo $cliente->cliente_id ?>"><?php echo $cliente->cliente_nome ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?php echo form_error('conta_receber_cliente_id', '<small class="form-text text-danger">', '</small>'); ?>
                            </div>
                            
                            <div class="col-md-4">
                                <label>Data de vencimento</label>
                                <input type="date" class="form-control form-control-user-date" name="conta_receber_data_vencimento" value="<?php echo set_value('conta_receber_data_vencimento') ?>">
                                <?php echo form_error('conta_receber_data_vencimento', '<small class="form-text text-danger">', '</small>'); ?>
                            </div>
                            
                            <div class="col-md-3">
                                <label for="formGroupExampleInput">Valor da conta</label>
                                <input type="text" class="form-control form-control-user-date money2" name="conta_receber_valor" placeholder="Valor da Conta" value="<?php echo set_value('conta_receber_valor') ?>">
                                <?php echo form_error('conta_receber_valor', '<small class="form-text text-danger">', '</small>'); ?>
                            </div>

                        </div>
                        
                        <div class="form-group row">

                            <div class="col-md-3">
                                <label for="formGroupExampleInput">Situação</label>
                                <select class="custom-select" name="conta_receber_status">

                                    <option value="0">Pagamento não Efetuado</option>
                                    <option value="1">Pagamento Efetuado</option>
                                    
                                </select>

                            </div>

                            <div class="col-md-9">
                                <label>Observações</label>
                                <textarea class="form-control h-50" name="conta_receber_obs"><?php echo set_value('conta_receber_obs') ?></textarea>
                                <?php echo form_error('conta_receber_obs', '<small class="form-text text-danger">', '</small>'); ?>
                            </div>       

                        </div>

                    </fieldset>


                    <div class="form-group row float-right mt-2 mb-0">
                        <div class="col-md-12 float-right">
                            <a title="Voltar para a lista de produtos" href="<?php echo base_url('receber'); ?>" class="btn btn-success btn-sm mr-2"><i class="fas fa-arrow-left"></i>&nbsp; Voltar</i></a>
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


</div>
<!-- End of Main Content -->

