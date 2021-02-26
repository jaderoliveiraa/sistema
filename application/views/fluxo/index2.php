
<?php
$this->load->view('layout/sidebar');

?>



<!-- Main Content -->
<div id="content">

    <?php $this->load->view('layout/navbar'); ?>

    <!-- Begin Page Content -->
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url('/'); ?>">Início</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo $titulo; ?></li>
            </ol>
        </nav>

        <!-- Para erro -->
        <?php if ($message = $this->session->flashdata('error')): ?>

            <div class="row">

                <div class="col-md-12">

                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong><i class="fas fa-exclamation-triangle"></i>&nbsp; <?php echo $message ?></strong> 
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                </div>

            </div>

        <?php endif; ?>

        <!-- para sucesso -->
        <?php if ($message = $this->session->flashdata('sucesso')): ?>

            <div class="row">

                <div class="col-md-12">

                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong><i class="far fa-smile-wink"></i>&nbsp; <?php echo $message ?></strong> 
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                </div>

            </div>
            <!-- Para Info -->
            <?php if ($message = $this->session->flashdata('info')): ?>

                <div class="row">

                    <div class="col-md-12">

                        <div class="alert alert-warning alert-dismissible fade show text-gray-900" role="alert">
                            <strong><i class="fas fa-exclamation-triangle"></i>&nbsp;&nbsp; <?php echo $message ?></strong> 
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                    </div>

                </div>

            <?php endif; ?>

        <?php endif; ?>



        <!-- DataTales Example -->

        <div class="card shadow mb-4 col-12 pt-2">
            <div class="card-header pt-3 pb-1">
                <label><h4>Fluxo de Caixa</h4></label>
            </div>

            <div class="row col-12">
                <form action="" class="user" name="form_fluxo" enctype="multipart/form-data" method="post" accept-charset="utf-8">

                    <fieldset class="mt-4 border p-2">

                        <legend class="font-small"><i class="fas fa-calendar-alt"></i></i>&nbsp;&nbsp;Escolha a Data</legend>

                        <div class="form-group row">

                            <div class="col-sm mb-1 mb-sm-0">
                                <label class="small my-0">Data</label>
                                <input type="date" class="form-control form-control-user-date" name="data" required="">
                            </div>

                        </div>

                    </fieldset>

                    <div class="mt-3 float-right">
                        <button class="btn btn-primary btn-sm mr-2">Gerar Fluxo</button>
                    </div>

                </form>
                
            </div>

        </div>


        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

