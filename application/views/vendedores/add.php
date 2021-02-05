

<?php $this->load->view('layout/sidebar'); ?>



<!-- Main Content -->
<div id="content">

    <?php $this->load->view('layout/navbar'); ?>

    <!-- Begin Page Content -->
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url('/'); ?>">Início</a></li>
                <li class="breadcrumb-item"><a href="<?php echo base_url('vendedores'); ?>">Vendedores</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo $titulo; ?></li>
            </ol>
        </nav>

        <!-- DataTales Example -->
        <div class="card shadow ">
            <div class="card-header py-3 pb-0 mb-0 form-control form-control-user-date">

            </div>

            <div class="card-body pt-0 mt-0">
                <form method="POST" name="form_add">

                             <!-- Dados pessoais -->
                    <fieldset class="m-2 mt-0 border pl-2 pr-2 pb-1 pt-1">
                        <legend class="font-small"><i class="fas fa-user-secret" style="color: mediumseagreen;"></i>&nbsp;Dados Pessoais - Vendedor</legend>
                        <div class="form-group row">

                            <div class="col-md-3">
                                <label for="formGroupExampleInput">Nome Completo</label>
                                <input type="text" class="form-control form-control-user-date  h-50" name="vendedor_nome_completo" placeholder="Digite o nome do vendedor" value="<?php echo set_value('vendedor_nome_completo');?>">
                                <?php echo form_error('vendedor_nome', '<small class="form-text text-danger">', '</small>'); ?>
                            </div>
                            
                            <div class="col-md-3">
                                <label for="formGroupExampleInput">Matrícula</label>
                                <input type="text" class="form-control form-control-user-date  h-50" name="vendedor_codigo" value="<?php echo $vendedor_codigo ?>" readonly="">
                            </div>

                            <div class = "col-md-3">
                                <label for = "formGroupExampleInput">CPF</label>
                                <input type = "text" class = "form-control form-control-user-date h-50 cpf" name = "vendedor_cpf" placeholder = "Cpf do Vendedor" value="<?php echo set_value('vendedor_cpf');?>">
                                <?php echo form_error('vendedor_cpf', '<small class="form-text text-danger">', '</small>');
                                ?>
                            </div>
                            
                            <div class="col-md-3">
                                <label for="formGroupExampleInput">RG</label>
                                <input type="text" class="form-control form-control-user-date rg h-50" name="vendedor_rg" placeholder="Rg do Vendedor" value="<?php echo set_value('vendedor_rg');?>" >
                                <?php echo form_error('vendedor_rg', '<small class="form-text text-danger">', '</small>'); ?>
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
                                <input type="email" class="form-control form-control-user-date h-50" name="vendedor_email" placeholder="Digite o E-mail" value="<?php echo set_value('vendedor_email');?>">
                                <?php echo form_error('vendedor_email', '<small class="form-text text-danger">', '</small>'); ?>
                            </div>

                            <div class="col-md-4">
                                <label for="formGroupExampleInput">Telefone Fixo</label>
                                <input type="text" class="form-control form-control-user-date phone_with_ddd h-50" name="vendedor_telefone" placeholder="Digite o Telefone Fixo" value="<?php echo set_value('vendedor_telefone');?>">
                                <?php echo form_error('vendedor_telefone', '<small class="form-text text-danger">', '</small>'); ?>
                            </div>

                            <div class="col-md-4">
                                <label for="formGroupExampleInput">Celular</label>
                                <input type="text" class="form-control form-control-user-date sp_celphones h-50" name="vendedor_celular" placeholder="Digite o Celular" value="<?php  echo set_value('vendedor_celular');?>">
                                <?php echo form_error('vendedor_celular', '<small class="form-text text-danger">', '</small>'); ?>
                            </div>
                        </div>

                    </fieldset>

                    <!-- Endereço -->
                    <fieldset class="m-2 mt-1 border pl-2 pr-2 pb-1 pt-1">
                        <legend class="font-small"><i class="fas fa-map-marker-alt" style="color: orange;"></i></i>&nbsp;Endereço</legend>
                        <div class="form-group row">
                            <!-- Documentação -->
                            <div class="col-md-5">
                                <label for="formGroupExampleInput">Endereço</label>
                                <input type="text" class="form-control form-control-user-date h-50" name="vendedor_endereco" placeholder="Digite o Endereço" value="<?php echo set_value('vendedor_endereco');?>">
                                <?php echo form_error('vendedor_endereco', '<small class="form-text text-danger">', '</small>'); ?>
                            </div>

                            <div class="col-md-2">
                                <label for="formGroupExampleInput">Número</label>
                                <input type="text" class="form-control form-control-user-date h-50" name="vendedor_numero_endereco" placeholder="Digite Número" value="<?php echo set_value('vendedor_numero_endereco');?>">
                                <?php echo form_error('vendedor_numero_endereco', '<small class="form-text text-danger">', '</small>'); ?>
                            </div>

                            <div class="col-md-5">
                                <label for="formGroupExampleInput">Complemento</label>
                                <input type="text" class="form-control form-control-user-date h-50" name="vendedor_complemento" placeholder=" Ex: Lj, Ap..." value="<?php echo set_value('vendedor_complemento');?>">
                                <?php echo form_error('vendedor_complemento', '<small class="form-text text-danger">', '</small>'); ?></br>
                            </div>

                            <div class="col-md-3">
                                <label for="formGroupExampleInput">Bairro</label>
                                <input type="text" class="form-control form-control-user-date h-50" name="vendedor_bairro" placeholder="Digite o bairro"  value="<?php echo set_value('vendedor_bairro');?>">
                                <?php echo form_error('vendedor_bairro', '<small class="form-text text-danger">', '</small>'); ?>
                            </div>

                            <div class="col-md-4">
                                <label for="formGroupExampleInput">Cidade</label>
                                <input type="text" class="form-control form-control-user-date h-50" name="vendedor_cidade" placeholder="Cidade" value="<?php echo set_value('vendedor_cidade');?>" >
                                <?php echo form_error('vendedor_cidade', '<small class="form-text text-danger">', '</small>'); ?>
                            </div>

                            <div class="col-md-1">
                                <label for="formGroupExampleInput">Estado</label>
                                <input type="text" class="form-control form-control-user-date uf h-50" name="vendedor_estado" placeholder=" UF" value="<?php echo set_value('vendedor_estado');?>">
                                <?php echo form_error('vendedor_estado', '<small class="form-text text-danger">', '</small>'); ?>
                            </div>

                            <div class="col-md-4">
                                <label for="formGroupExampleInput">Cep</label>
                                <input type="text" class="form-control form-control-user-date cep h-50" name="vendedor_cep" placeholder="Cep" value="<?php echo set_value('vendedor_cep');?>">
                                <?php echo form_error('vendedor_cep', '<small class="form-text text-danger">', '</small>'); ?>
                            </div>

                        </div>
                    </fieldset>

                    <!-- Configurações -->
                    <fieldset class="m-2 mt-1 border pl-2 pr-2 pb-2 pt-1">
                        <legend class="font-small"><i class="fas fa-tools" style="color: red;"></i></i>&nbsp;Configurações</legend>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label for="formGroupExampleInput">Situação</label>
                                <select class="form-control form-control-user-date h-50" name="vendedor_ativo">

                                    <option class="h-50" value="1">Ativo</option>
                                    <option class="h-50" value="0">Inativo</option>

                                </select>
                            </div>

                            <div class="col-md-8">
                                <label for="formGroupExampleInput">Observações sobre o vendedor</label>
                                <textarea class="form-control form-control-user-date h-50 mb-1" name="vendedor_obs" placeholder="Digite aqui as observações sobre o vendedor" value="<?php echo set_value('vendedor_obs');?>"></textarea>
                                <?php echo form_error('vendedor_obs', '<small class="form-text text-danger">', '</small>'); ?>
                            </div>
                        </div>
                    </fieldset>


                    <div class="form-group row float-right mt-2 mb-0">
                        <div class="col-md-12 float-right">
                            <a title="Voltar para a lista de Vendedores" href="<?php echo base_url('vendedores'); ?>" class="btn btn-success btn-sm mr-2"><i class="fas fa-arrow-left"></i>&nbsp; Voltar</i></a>
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

