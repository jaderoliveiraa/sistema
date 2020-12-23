

<?php $this->load->view('layout/sidebar'); ?>



<!-- Main Content -->
<div id="content">

    <?php $this->load->view('layout/navbar'); ?>

    <!-- Begin Page Content -->
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url('/'); ?>">Início</a></li>
                <li class="breadcrumb-item"><a href="<?php echo base_url('servicos'); ?>">Serviços</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo $titulo; ?></li>
            </ol>
        </nav>

        <!-- DataTales Example -->
        <div class="card shadow ">
            <div class="card-header py-3 pb-0 mb-0 form-control form-control-user-date">
                <p><strong><i class="fas fa-clock" style="color: blue;"></i>&nbsp;Última Edição:  </strong><?php echo formata_data_banco_com_hora($servico->servico_data_alteracao); ?></p>
            </div>

            <div class="card-body pt-0 mt-0">
                <form method="POST" name="form_edit">

                    <!-- Dados pessoais -->
                    <fieldset class="m-2 mt-0 border pl-2 pr-2 pb-1 pt-1">
                        <legend class="font-small"><i class="fas fa-wrench" style="color: orange;"></i>&nbsp;Serviço</legend>
                        <div class="form-group row">

                            <div class="col-md-3">
                                <label for="formGroupExampleInput">Serviço</label>
                                <input type="text" class="form-control form-control-user-date  h-50" name="servico_nome" placeholder="Digite o nome do servico" value="<?php echo $servico->servico_nome ?>">
                                <?php echo form_error('servico_nome', '<small class="form-text text-danger">', '</small>'); ?>
                            </div>
                            
                            <div class="col-md-3">
                                <label for="formGroupExampleInput">Descrição</label>
                                <input type="text" class="form-control form-control-user-date  h-50" name="servico_descricao" placeholder="Descrição do Serviço" value="<?php echo $servico->servico_descricao ?>">
                                <?php echo form_error('servico_descricao', '<small class="form-text text-danger">', '</small>'); ?>
                            </div>

                            <div class = "col-md-3">
                                <label for = "formGroupExampleInput">Valor R$</label>
                                <input type = "text" class = "form-control form-control-user-date h-50 money" name = "servico_preco" placeholder = "Valor R$" value="<?php echo $servico->servico_preco ?>">
                                <?php echo form_error('servico_preco', '<small class="form-text text-danger">', '</small>');
                                ?>
                            </div>
                            
                            <div class="col-md-3">
                                <label for="formGroupExampleInput">Situação</label>
                                <select class="form-control form-control-user-date h-50" name="servico_ativo">

                                    <option class="h-50" value="1" <?php echo($servico->servico_ativo == 1) ? 'selected' : '' ?>>Ativo</option>
                                    <option class="h-50" value="0" <?php echo($servico->servico_ativo == 0) ? 'selected' : '' ?>>Inativo</option>

                                </select>
                            </div>

                        </div>

                    </fieldset>


                    <!-- campos ocultos -->
                    <!-- 
                    
                    <div class="form-group row">

                        <input type="hidden" name="servico_id" value="<?php echo $servico->servico_id ?>"  />

                    </div>
                    
                    -->
                    <div class="form-group row float-right mt-2 mb-0">
                        <div class="col-md-12 float-right">
                            <a title="Voltar para a lista de servicoes" href="<?php echo base_url('servicos'); ?>" class="btn btn-success btn-sm mr-2"><i class="fas fa-arrow-left"></i>&nbsp; Voltar</i></a>
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

