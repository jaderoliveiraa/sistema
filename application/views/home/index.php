

<?php $this->load->view('layout/sidebar'); ?>



<!-- Main Content -->
<div id="content">

    <?php $this->load->view('layout/navbar'); ?>

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Begin Page Content -->
        <div class="container-fluid">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url('/'); ?>">Início</a></li>
                </ol>
            </nav>

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

            <?php endif; ?>

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

            <!-- Page Heading -->

            <div class="form-group row">
                <!-- Earnings (Monthly) Card Example -->
                <div class="row">
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-uppercase mb-1" style="color: mediumseagreen;">Total de Vendas</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo 'R$ ' . $soma_vendas->venda_valor_total ?></div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-shopping-cart fa-3x text-900" style="color: mediumseagreen;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Earnings (Monthly) Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-uppercase mb-1" style="color: blue;">Ordem de Serviços</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo 'R$ ' . $soma_servicos->ordem_servico_valor_total ?></div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-shopping-basket fa-3x text-900" style="color: blue;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Earnings (Monthly) Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-dark shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-uppercase mb-1" style="color: ForestGreen;">Total a Pagar</div>
                                        <div class="row no-gutters align-items-center">
                                            <div class="col-auto">
                                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo 'R$ ' . $soma_pagar->conta_pagar_valor ?></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-3x fa-comment-dollar" style="color: ForestGreen;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pending Requests Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-danger shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-uppercase mb-1" style="color: DarkRed;">Total a receber</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo 'R$ ' . ($soma_receber->conta_receber_valor == NULL ? '0,00' : $soma_receber->conta_receber_valor); ?></div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-3x fa-hand-holding-usd" style="color: DarkRed;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- fim da primeira row -->

                <!-- inicio da segunda row -->
                <div class="row">
                    <div class="col-lg-6 mb-4">

                        <!-- Illustrations -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Illustrations</h6>
                            </div>
                            <div class="card-body">
                                <div class="text-center">
                                    <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;" src="img/undraw_posting_photo.svg" alt="">
                                </div>
                                <p>Add some quality, svg illustrations to your project courtesy of <a target="_blank" rel="nofollow" href="https://undraw.co/">unDraw</a>, a constantly updated collection of beautiful svg images that you can use completely free and without attribution!</p>
                                <a target="_blank" rel="nofollow" href="https://undraw.co/">Browse Illustrations on unDraw &rarr;</a>
                            </div>
                        </div>

                        <!-- Approach -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Development Approach</h6>
                            </div>
                            <div class="card-body">
                                <p>SB Admin 2 makes extensive use of Bootstrap 4 utility classes in order to reduce CSS bloat and poor page performance. Custom CSS classes are used to create custom components and custom utility classes.</p>
                                <p class="mb-0">Before working with this theme, you should become familiar with the Bootstrap framework, especially the utility classes.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- fim da segunda row -->
            </div>
        </div>
    </div>
</div>

