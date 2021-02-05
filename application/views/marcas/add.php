

<?php $this->load->view('layout/sidebar'); ?>



<!-- Main Content -->
<div id="content">

    <?php $this->load->view('layout/navbar'); ?>

    <!-- Begin Page Content -->
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url('/'); ?>">Início</a></li>
                <li class="breadcrumb-item"><a href="<?php echo base_url('marcas'); ?>">Marcas</a></li>
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
                        <legend class="font-small"><i class="fas fa-screwdriver" style="color: orange;"></i>&nbsp;Marcas</legend>
                        <div class="form-group row">

                            <div class="col-md-6">
                                <label for="formGroupExampleInput">Marca</label>
                                <input type="text" class="form-control form-control-user-date  h-50" name="marca_nome" placeholder="Digite a marca">
                                <?php echo form_error('marca_nome', '<small class="form-text text-danger">', '</small>'); ?>
                            </div>
                            
                            <div class="col-md-6">
                                <label for="formGroupExampleInput">Situação</label>
                                <select class="form-control form-control-user-date h-50" name="marca_ativa">

                                    <option class="h-50" value="1">Ativa</option>
                                    <option class="h-50" value="0">Inativa</option>

                                </select>
                            </div>

                        </div>

                    </fieldset>


                    <div class="form-group row float-right mt-2 mb-0">
                        <div class="col-md-12 float-right">
                            <a title="Voltar para a lista de Vendedores" href="<?php echo base_url('marcas'); ?>" class="btn btn-success btn-sm mr-2"><i class="fas fa-arrow-left"></i>&nbsp; Voltar</i></a>
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

