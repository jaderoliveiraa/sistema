

<?php $this->load->view('layout/sidebar'); ?>



<!-- Main Content -->
<div id="content">

    <?php $this->load->view('layout/navbar'); ?>

    <!-- Begin Page Content -->
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url('/'); ?>">Início</a></li>
                <li class="breadcrumb-item"><a href="<?php echo base_url('fornecedores'); ?>">Fornecedores</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo $titulo; ?></li>
            </ol>
        </nav>

        <!-- DataTales Example -->
        <div class="card shadow ">
            <div class="card-header py-3 pb-0 mb-0 form-control form-control-user-date">

            </div>

            <div class="card-body pt-0 mt-0">
                <form method="POST" name="form_add">

                    <!-- Dados Principais -->
                    <fieldset class="m-2 mt-0 border pl-2 pr-2 pb-1 pt-1">
                        <legend class="font-small"><i class="fas fa-user-tag" style="color: mediumseagreen;"></i>&nbsp;Dados Principais</legend>
                        <div class="form-group row">

                            <div class="col-md-6">
                                <label for="formGroupExampleInput">Razão Social</label>
                                <input type="text" class="form-control form-control-user-date  h-50" name="fornecedor_razao" placeholder="Digite a Razão Social">
                                <?php echo form_error('fornecedor_razao', '<small class="form-text text-danger">', '</small>'); ?>
                            </div>

                            <div class="col-md-6">
                                <label for="formGroupExampleInput">Nome Fantasia</label>
                                <input type="text" class="form-control form-control-user-date h-50" name="fornecedor_nome_fantasia" placeholder="Digite o nome fantasia">
                                <?php echo form_error('fornecedor_nome_fantasia', '<small class="form-text text-danger">', '</small>'); ?>
                            </div>

                      </div>
                        
                        <div class="form-group row">
                            <!-- Dados de Contato -->

                            <div class="col-md-4">
                                <label for="formGroupExampleInput">CNPJ</label>
                                <input type="text" class="form-control form-control-user-date cnpj" name="fornecedor_cnpj" placeholder="Digite o CNPJ">
                                <?php echo form_error('fornecedor_cnpj', '<small class="form-text text-danger">', '</small>'); ?>
                            </div>

                            <div class="col-md-4">
                                <label for="formGroupExampleInput">Inscrição Estadual</label>
                                <input type="text" class="form-control form-control-user-date h-50" name="fornecedor_ie" placeholder="Digite o inscrição Estadual">
                                <?php echo form_error('fornecedor_ie', '<small class="form-text text-danger">', '</small>'); ?>
                            </div>

                            <div class="col-md-4">
                                <label for="formGroupExampleInput">Contato</label>
                                <input type="text" class="form-control form-control-user-date" name="fornecedor_contato" placeholder="Digite o Nome do Contato">
                                <?php echo form_error('fornecedor_contato', '<small class="form-text text-danger">', '</small>'); ?>
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
                                <input type="email" class="form-control form-control-user-date h-50" name="fornecedor_email" placeholder="Digite o E-mail">
                                <?php echo form_error('fornecedor_email', '<small class="form-text text-danger">', '</small>'); ?>
                            </div>

                            <div class="col-md-4">
                                <label for="formGroupExampleInput">Telefone Fixo</label>
                                <input type="text" class="form-control form-control-user-date phone_with_ddd h-50" name="fornecedor_telefone" placeholder="Digite o Telefone Fixo">
                                <?php echo form_error('fornecedor_telefone', '<small class="form-text text-danger">', '</small>'); ?>
                            </div>

                            <div class="col-md-4">
                                <label for="formGroupExampleInput">Celular</label>
                                <input type="text" class="form-control form-control-user-date sp_celphones h-50" name="fornecedor_celular" placeholder="Digite o Celular">
                                <?php echo form_error('fornecedor_celular', '<small class="form-text text-danger">', '</small>'); ?>
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
                                <input type="text" class="form-control form-control-user-date h-50" name="fornecedor_endereco" placeholder="Digite o Endereço">
                                <?php echo form_error('fornecedor_endereco', '<small class="form-text text-danger">', '</small>'); ?>
                            </div>

                            <div class="col-md-1">
                                <label for="formGroupExampleInput">Número</label>
                                <input type="text" class="form-control form-control-user-date h-50" name="fornecedor_numero_endereco" placeholder="Núm.">
                                <?php echo form_error('fornecedor_numero_endereco', '<small class="form-text text-danger">', '</small>'); ?>
                            </div>

                            <div class="col-md-2">
                                <label for="formGroupExampleInput">Complemento</label>
                                <input type="text" class="form-control form-control-user-date h-50" name="fornecedor_complemento" placeholder=" Ex: Lj, Ap...">
                                <?php echo form_error('fornecedor_complemento', '<small class="form-text text-danger">', '</small>'); ?>
                            </div>

                            <div class="col-md-2">
                                <label for="formGroupExampleInput">Bairro</label>
                                <input type="text" class="form-control form-control-user-date h-50" name="fornecedor_bairro" placeholder="Digite o bairro">
                                <?php echo form_error('fornecedor_bairro', '<small class="form-text text-danger">', '</small>'); ?>
                            </div>

                            <div class="col-md-2">
                                <label for="formGroupExampleInput">Cidade</label>
                                <input type="text" class="form-control form-control-user-date h-50" name="fornecedor_cidade" placeholder="Cidade">
                                <?php echo form_error('fornecedor_cidade', '<small class="form-text text-danger">', '</small>'); ?>
                            </div>

                            <div class="col-md-1">
                                <label for="formGroupExampleInput">Estado</label>
                                <input type="text" class="form-control form-control-user-date uf h-50" name="fornecedor_estado" placeholder=" UF">
                                <?php echo form_error('fornecedor_estado', '<small class="form-text text-danger">', '</small>'); ?>
                            </div>

                            <div class="col-md-2">
                                <label for="formGroupExampleInput">Cep</label>
                                <input type="text" class="form-control form-control-user-date cep h-50" name="fornecedor_cep" placeholder="Cep">
                                <?php echo form_error('fornecedor_cep', '<small class="form-text text-danger">', '</small>'); ?>
                            </div>

                        </div>
                    </fieldset>

                    <!-- Configurações -->
                    <fieldset class="m-2 mt-1 border pl-2 pr-2 pb-2 pt-1">
                        <legend class="font-small"><i class="fas fa-tools" style="color: red;"></i></i>&nbsp;Configurações</legend>
                        <div class="form-group row">
                        <div class="col-md-4">
                            <label for="formGroupExampleInput">Situação</label>
                            <select class="form-control form-control-user-date h-50" name="fornecedor_ativo">

                                <option class="h-50" value="1">Ativo</option>
                                <option class="h-50" value="0">Inativo</option>

                            </select>
                        </div>

                        <div class="col-md-8">
                            <label for="formGroupExampleInput">Observações</label>
                            <textarea class="form-control form-control-user-date h-50 mb-1" name="fornecedor_obs" placeholder="Digite aqui as observações sobre a empresa"></textarea>
                            <?php echo form_error('fornecedor_obs', '<small class="form-text text-danger">', '</small>'); ?>
                        </div>
                        </div>
                    </fieldset>

                    

                    <!-- campos ocultos -->
                    <div class="form-group row">


                    </div>
                    <div class="form-group row float-right mt-2 mb-0">
                        <div class="col-md-12 float-right">
                            <a title="Voltar para a lista de Fornecedores" href="<?php echo base_url('fornecedores'); ?>" class="btn btn-success btn-sm mr-2"><i class="fas fa-arrow-left"></i>&nbsp; Voltar</i></a>
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

