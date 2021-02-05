

<?php $this->load->view('layout/sidebar'); ?>



<!-- Main Content -->
<div id="content">

    <?php $this->load->view('layout/navbar'); ?>

    <!-- Begin Page Content -->
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url('/'); ?>">Início</a></li>
                <li class="breadcrumb-item"><a href="<?php echo base_url('clientes'); ?>">Clientes</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo $titulo; ?></li>
            </ol>
        </nav>

        <!-- DataTales Example -->
        <div class="card shadow ">
            <div class="card-header py-3 pb-0 mb-0 form-control form-control-user-date">

            </div>

            <div class="card-body pt-0 mt-0">
                <form method="POST" name="form_add">

                    <div class="custom-control custom-radio custom-control-inline mt-1 mb-1">
                        <input type="radio" id="pessoa_fisica" name="cliente_tipo" class="custom-control-input" value="1" <?php echo set_checkbox('cliente_tipo', '1') ?> checked="">
                        <label class="custom-control-label pt-1" for="pessoa_fisica">Pessoa física</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="pessoa_juridica" name="cliente_tipo" class="custom-control-input" value="2" <?php echo set_checkbox('cliente_tipo', '2') ?> >
                        <label class="custom-control-label pt-1" for="pessoa_juridica">Pessoa jurídica</label>
                    </div>

                    <!-- Dados pessoais -->
                    <fieldset class="m-2 mt-0 border pl-2 pr-2 pb-1 pt-1">
                        <legend class="font-small"><i class="fas fa-user-tie" style="color: mediumseagreen;"></i>&nbsp;Dados Pessoais</legend>
                        <div class="form-group row">

                            <div class="col-md-2">
                                <label for="formGroupExampleInput">Nome</label>
                                <input type="text" class="form-control form-control-user-date  h-50" name="cliente_nome" placeholder="Digite o nome do cliente" value="<?php echo set_value('cliente_nome'); ?>">
                                <?php echo form_error('cliente_nome', '<small class="form-text text-danger">', '</small>'); ?>
                            </div>

                            <div class="col-md-2">
                                <label for="formGroupExampleInput">Sobrenome</label>
                                <input type="text" class="form-control form-control-user-date h-50" name="cliente_sobrenome" placeholder="Digite o sobrenome do cliente" value="<?php echo set_value('cliente_sobrenome'); ?>">
                                <?php echo form_error('cliente_sobrenome', '<small class="form-text text-danger">', '</small>'); ?>
                            </div>

                            <div class = "col-md-2">
                                <!-- Campo CPF -->
                                <div class="pessoa_fisica">
                                    <label for = "formGroupExampleInput">CPF</label>
                                    <input type = "text" class = "form-control form-control-user-date h-50 cpf" name = "cliente_cpf" placeholder = "CPF do Cliente" value = "<?php echo set_value('cliente_cpf'); ?>">
                                    <?php echo form_error('cliente_cpf', '<small class="form-text text-danger">', '</small>'); ?>
                                </div>
                                <div class="pessoa_juridica">
                                    <label for = "formGroupExampleInput">CNPJ</label>
                                    <input type = "text" class = "form-control form-control-user-date h-50 cnpj" name = "cliente_cnpj" placeholder = "CNPJ da Empresa" value = "<?php echo set_value('cliente_cnpj') ?>">
                                    <?php echo form_error('cliente_cnpj', '<small class="form-text text-danger">', '</small>'); ?>                                    
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="formGroupExampleInput">Data de Nascimento</label>
                                <input type="date" class="form-control form-control-user-date h-50" name="cliente_data_nascimento" placeholder="Digite a data de nascimento" value="<?php echo set_value('cliente_data_nascimento'); ?>">
                                <?php echo form_error('cliente_data_nascimento', '<small class="form-text text-danger">', '</small>'); ?>
                            </div>

                            <div class="col-md-3">

                                <label class="pessoa_fisica">RG</label>
                                <label class="pessoa_juridica">Inscrição Estadual</label>
                                <input type = "text" class = "form-control form-control-user-date h-50" name = "cliente_rg_ie" value = "<?php echo set_value('cliente_rg_ie') ?>">
                                <?php echo form_error('cliente_rg_ie', '<small class="form-text text-danger">', '</small>');
                                ?>
                            </div>

                        </div>

                    </fieldset>

                    <!-- Dados de Contato -->
                    <fieldset class="m-2 mt-1 border pl-2 pr-2 pb-1 pt-1">
                        <legend class="font-small"><i class="far fa-address-card " style="color: Dodgerblue;"></i></i>&nbsp;Dados de Contato</legend>
                        <div class="form-group row">
                            <!-- Dados de Contato -->

                            <div class="col-md-4">
                                <label for="formGroupExampleInput">E-mail</label>
                                <input type="email" class="form-control form-control-user-date h-50" name="cliente_email" placeholder="Digite o E-mail" value="<?php echo set_value('cliente_email') ?>">
                                <?php echo form_error('cliente_email', '<small class="form-text text-danger">', '</small>'); ?>
                            </div>

                            <div class="col-md-4">
                                <label for="formGroupExampleInput">Telefone Fixo</label>
                                <input type="text" class="form-control form-control-user-date phone_with_ddd h-50" name="cliente_telefone" placeholder="Digite o Telefone Fixo" value="<?php echo set_value('cliente_telefone') ?>">
                                <?php echo form_error('cliente_telefone', '<small class="form-text text-danger">', '</small>'); ?>
                            </div>

                            <div class="col-md-4">
                                <label for="formGroupExampleInput">Celular</label>
                                <input type="text" class="form-control form-control-user-date sp_celphones h-50" name="cliente_celular" placeholder="Digite o Celular" value="<?php echo set_value('cliente_celular') ?>">
                                <?php echo form_error('cliente_celular', '<small class="form-text text-danger">', '</small>'); ?>
                            </div>
                        </div>

                    </fieldset>

                    <!-- Endereço -->
                    <fieldset class="m-2 mt-1 border pl-2 pr-2 pb-1 pt-1">
                        <legend class="font-small"><i class="fas fa-map-marker-alt" style="color: orange;"></i></i>&nbsp;Endereço</legend>
                        <div class="form-group row">
                            <!-- Documentação -->
                            <div class="col-md-2">
                                <label for="formGroupExampleInput">Endereço</label>
                                <input type="text" class="form-control form-control-user-date h-50" name="cliente_endereco" placeholder="Digite o Endereço" value="<?php echo set_value('cliente_endereco') ?>">
                                <?php echo form_error('cliente_endereco', '<small class="form-text text-danger">', '</small>'); ?>
                            </div>

                            <div class="col-md-1">
                                <label for="formGroupExampleInput">Número</label>
                                <input type="text" class="form-control form-control-user-date h-50" name="cliente_numero_endereco" placeholder="Digite Número" value="<?php echo set_value('cliente_numero_endereco') ?>">
                                <?php echo form_error('cliente_numero_endereco', '<small class="form-text text-danger">', '</small>'); ?>
                            </div>

                            <div class="col-md-2">
                                <label for="formGroupExampleInput">Complemento</label>
                                <input type="text" class="form-control form-control-user-date h-50" name="cliente_complemento" placeholder=" Ex: Lj, Ap..." value="<?php echo set_value('cliente_complemento') ?>">
                                <?php echo form_error('cliente_complemento', '<small class="form-text text-danger">', '</small>'); ?>
                            </div>

                            <div class="col-md-2">
                                <label for="formGroupExampleInput">Bairro</label>
                                <input type="text" class="form-control form-control-user-date h-50" name="cliente_bairro" placeholder="Digite o bairro" value="<?php echo set_value('cliente_bairro') ?>">
                                <?php echo form_error('cliente_bairro', '<small class="form-text text-danger">', '</small>'); ?>
                            </div>

                            <div class="col-md-2">
                                <label for="formGroupExampleInput">Cidade</label>
                                <input type="text" class="form-control form-control-user-date h-50" name="cliente_cidade" placeholder="Cidade" value="<?php echo set_value('cliente_cidade') ?>">
                                <?php echo form_error('cliente_cidade', '<small class="form-text text-danger">', '</small>'); ?>
                            </div>

                            <div class="col-md-1">
                                <label for="formGroupExampleInput">Estado</label>
                                <input type="text" class="form-control form-control-user-date uf h-50" name="cliente_estado" placeholder=" UF" value="<?php echo set_value('cliente_estado') ?>">
                                <?php echo form_error('cliente_estado', '<small class="form-text text-danger">', '</small>'); ?>
                            </div>

                            <div class="col-md-2">
                                <label for="formGroupExampleInput">Cep</label>
                                <input type="text" class="form-control form-control-user-date cep h-50" name="cliente_cep" placeholder="Cep" value="<?php echo set_value('cliente_cep') ?>">
                                <?php echo form_error('cliente_cep', '<small class="form-text text-danger">', '</small>'); ?>
                            </div>

                        </div>
                    </fieldset>

                    <!-- Configurações -->
                    <fieldset class="m-2 mt-1 border pl-2 pr-2 pb-2 pt-1">
                        <legend class="font-small"><i class="fas fa-tools" style="color: red;"></i></i>&nbsp;Configurações</legend>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label for="formGroupExampleInput">Situação</label>
                                <select class="form-control form-control-user-date h-50" name="cliente_ativo">

                                    <option class="h-50" value="1">Ativo</option>
                                    <option class="h-50" value="0">Inativo</option>

                                </select>
                            </div>

                            <div class="col-md-8">
                                <label for="formGroupExampleInput">Observações sobre o cliente</label>
                                <textarea class="form-control form-control-user-date h-50 mb-1" name="cliente_obs" placeholder="Digite aqui as observações sobre o cliente"><?php set_value('cliente_obs') ?></textarea>
                                <?php echo form_error('cliente_obs', '<small class="form-text text-danger">', '</small>'); ?>
                            </div>
                        </div>
                    </fieldset>

                    <div class="form-group row float-right mt-2 mb-0">
                        <div class="col-md-12 float-right">
                            <a title="Voltar para a lista de cliente" href="<?php echo base_url('clientes'); ?>" class="btn btn-success btn-sm mr-2"><i class="fas fa-arrow-left"></i>&nbsp; Voltar</i></a>
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

