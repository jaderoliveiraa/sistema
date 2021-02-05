

<?php $this->load->view('layout/sidebar'); ?>



<!-- Main Content -->
<div id="content">

    <?php $this->load->view('layout/navbar'); ?>

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

        <?php if ($this->ion_auth->is_admin()): ?>
        
        <!-- Page Heading -->

        <div class="form-group row">
            <!-- (vendas) -->
            <div class="row col">
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

                <!-- (ordem de serviços)  -->
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

                <!--  (Contas a Pagar)  -->
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

                <!-- (Contas a Receber) -->
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
            
            <?php endif; ?>

            <!-- inicio da segunda row -->

            <div class="row col-12">
                <div class="col-lg-6 mb-4 ">

                    <!-- Hanking de Vendas -->
                    <div class="card shadow mb-4 ">
                        <div class="card-header py-3">
                            <h6 class=" font-weight-bold text-success mb-0" align="center">TOP 3 Produtos mais vendidos</h6>
                        </div>
                        <div class="card-body">
                            <div class="text-center">
                                <img class="img-fluid px-3 px-sm-4 mb-1 " style="width: 12rem;" src="<?php echo base_url('public/img/produtos_vendidos.svg'); ?>" alt="">
                            </div>

                            <div class="table-responsive">

                                <table class="table table-striped table-borderless">

                                    <thead>
                                        <tr>
                                            <th>Produto</th>
                                            <th class="text-center">Quantidade</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        <?php foreach ($produtos_mais_vendidos as $produto): ?>

                                        <tr>
                                            <td ><?php echo $produto->produto_descricao ?></td>
                                            <td align="center"><?php echo $produto->quantidade_vendidos ?></td>
                                        </tr>

                                        <?php endforeach; ?>

                                    </tbody>


                                </table>                                

                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-lg-6 mb-4">

                    <!-- hanking ordem de serviços -->
                    <div class="card shadow mb-0 ">
                        <div class="card-header py-3">
                            <h6 class=" font-weight-bold text-primary mb-0" align="center">TOP 3 Serviços mais realizados</h6>
                        </div>
                        <div class="card-body">
                            <div class="text-center">
                                <img class="img-fluid px-3 px-sm-4 mb-2" style="width: 12rem;" src="<?php echo base_url('public/img/servicos_vendidos.svg'); ?>" alt="">
                            </div>
                            
                            <div class="table-responsive">

                                <table class="table table-striped table-borderless">

                                    <thead>
                                        <tr>
                                            <th>Serviço</th>
                                            <th class="text-center">Quantidade</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        <?php foreach ($servicos_mais_vendidos as $servico): ?>

                                        <tr>
                                            <td ><?php echo $servico->servico_nome ?></td>
                                            <td align="center"><?php echo $servico->quantidade_vendidos ?></td>
                                        </tr>

                                        <?php endforeach; ?>

                                    </tbody>


                                </table>                                

                            </div>
                            
                        </div>
                    </div>

                </div>
            </div>

        </div>
        <!-- fim da segunda row -->        
        
        
    </div>
</div>

