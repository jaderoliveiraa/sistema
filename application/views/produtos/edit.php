

<?php $this->load->view('layout/sidebar'); ?>



<!-- Main Content -->
<div id="content">

    <?php $this->load->view('layout/navbar'); ?>

    <!-- Begin Page Content -->
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url('/'); ?>">Início</a></li>
                <li class="breadcrumb-item"><a href="<?php echo base_url('produtos'); ?>">Produtos</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo $titulo; ?></li>
            </ol>
        </nav>

        <!-- DataTales Example -->
        <div class="card shadow ">
            <div class="card-header py-3 pb-0 mb-0 form-control form-control-user-date">
                <p><strong><i class="fas fa-clock" style="color: blue;"></i>&nbsp;Última Edição:  </strong><?php echo formata_data_banco_com_hora($produto->produto_data_alteracao); ?></p>
            </div>

            <div class="card-body pt-0 mt-0">
                <form method="POST" name="form_edit">

                    <!-- Dados pessoais -->
                    <fieldset class="m-2 mt-0 border pl-2 pr-2 pb-1 pt-1">
                        <legend class="font-small"><i class="fas fa-tags" style="color: Chocolate;"></i>&nbsp;Dados Principais</legend>
                        <div class="form-group row">

                            <div class="col-md-2">
                                <label for="formGroupExampleInput">Código do Produto</label>
                                <input type="text" class="form-control form-control-user-date" name="produto_codigo" readonly="" value="<?php echo $produto->produto_codigo; ?>">
                            </div>

                            <div class="col-md-10">
                                <label>Descrição do Produto</label>
                                <input type="text" class="form-control form-control-user-date  h-50" name="produto_descricao" placeholder="Descrição do Produto" value="<?php echo $produto->produto_descricao; ?>">
                                <?php echo form_error('produto_descricao', '<small class="form-text text-danger">', '</small>'); ?>
                            </div>

                        </div>

                        <div class="form-group row">

                            <div class="col-md-3">
                                <label for="formGroupExampleInput">Marca</label>
                                <select class="custom-select" name="produto_marca_id">
                                    <?php foreach ($marcas as $marca): ?>
                                        <option value="<?php echo $marca->marca_id ?>" <?php echo ($marca->marca_id == $produto->produto_marca_id ? 'selected' : '') ?>><?php echo $marca->marca_nome ?></option>
                                    <?php endforeach; ?>
                                </select>

                            </div>

                            <div class="col-md-3">
                                <label for="formGroupExampleInput">Categoria</label>
                                <select class="custom-select" name="produto_categoria_id">
                                    <?php foreach ($categorias as $categoria): ?>
                                        <option value="<?php echo $categoria->categoria_id ?>" <?php echo ($categoria->categoria_id == $produto->produto_categoria_id ? 'selected' : '') ?>><?php echo $categoria->categoria_nome ?></option>
                                    <?php endforeach; ?>
                                </select>

                            </div>

                            <div class="col-md-3">
                                <label for="formGroupExampleInput">Fornecedor</label>
                                <select class="custom-select" name="produto_fornecedor_id">
                                    <?php foreach ($fornecedores as $fornecedor): ?>
                                        <option value="<?php echo $fornecedor->fornecedor_id ?>" <?php echo ($fornecedor->fornecedor_id == $produto->produto_fornecedor_id ? 'selected' : '') ?>><?php echo $fornecedor->fornecedor_nome_fantasia ?></option>
                                    <?php endforeach; ?>
                                </select>

                            </div>  

                            <div class="col-md-3">
                                <label for="formGroupExampleInput">Unidade</label>
                                <input type="text" name="produto_unidade" class="form-control form-control-user-date" value="<?php echo $produto->produto_unidade; ?>">
                                <?php echo form_error('produto_unidade', '<small class="form-text text-danger">', '</small>'); ?>
                            </div>           

                        </div>



                    </fieldset>

                    <fieldset class="m-2 mt-0 border pl-2 pr-2 pb-1 pt-1">
                        <legend class="font-small"><i class="fas fa-funnel-dollar"  style="color: darkmagenta;"></i></i>&nbsp;Precificação e Estoque</legend>
                        <div class="form-group row">

                            <div class="col-md-3">
                                <label for="formGroupExampleInput">Preço de Custo R$</label>
                                <input type="text" class="form-control form-control-user-date money h-50" name="produto_preco_custo" placeholder="Preço de Custo" value="<?php echo $produto->produto_preco_custo ?>">
                                <?php echo form_error('produto_preco_custo', '<small class="form-text text-danger">', '</small>'); ?>
                            </div>

                            <div class="col-md-3">
                                <label for="formGroupExampleInput">Preço de Venda R$</label>
                                <input type="text" class="form-control form-control-user-date money h-50" name="produto_preco_venda" placeholder="Preço de Venda" value="<?php echo $produto->produto_preco_venda ?>">
                                <?php echo form_error('produto_preco_venda', '<small class="form-text text-danger">', '</small>'); ?>
                            </div>

                            <div class="col-md-3">
                                <label for="formGroupExampleInput">Estoque Mínimo</label>
                                <input type="number" class="form-control form-control-user-date h-50" name="produto_estoque_minimo" placeholder="Estoque Mínimo" value="<?php echo $produto->produto_estoque_minimo ?>">
                                <?php echo form_error('produto_estoque_minimo', '<small class="form-text text-danger">', '</small>'); ?>
                            </div>

                            <div class="col-md-3">
                                <label for="formGroupExampleInput">Quantidade em Estoque</label>
                                <input type="number" class="form-control form-control-user-date h-50" name="produto_qtde_estoque" placeholder="Quantidade em Estoque" value="<?php echo $produto->produto_qtde_estoque ?>">
                                <?php echo form_error('produto_qtde_estoque', '<small class="form-text text-danger">', '</small>'); ?>
                            </div>

                        </div>

                        <div class="form-group row">

                            <div class="col-md-3">
                                <label for="formGroupExampleInput">Situação</label>
                                <select class="custom-select" name="produto_ativo">

                                    <option value="1" <?php echo ($produto->produto_ativo == 1 ? 'selected' : '') ?>>Ativo</option>
                                    <option value="0" <?php echo ($produto->produto_ativo == 0 ? 'selected' : '') ?>>Inativo</option>

                                </select>

                            </div>

                            <div class="col-md-9">
                                <label>Observações</label>
                                <textarea class="form-control h-50" name="produto_obs"><?php echo $produto->produto_obs ?></textarea>

                            </div>       

                        </div>



                    </fieldset>

                    <!-- campos ocultos -->
                    <div class="form-group row">

                        <input type="hidden" name="produto_id" value="<?php echo $produto->produto_id ?>"  />

                    </div>

                    <div class="form-group row float-right mt-2 mb-0">
                        <div class="col-md-12 float-right">
                            <a title="Voltar para a lista de produtos" href="<?php echo base_url('produtos'); ?>" class="btn btn-success btn-sm mr-2"><i class="fas fa-arrow-left"></i>&nbsp; Voltar</i></a>
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

