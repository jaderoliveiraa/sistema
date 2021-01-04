<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo base_url('home'); ?>">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-cubes"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SysControl</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Home -->
    <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url('home'); ?>">
            <i class="fas fa-home"></i>
            <span>Início</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Módulos
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUm" aria-expanded="true" aria-controls="collapseOne">
            <i class="fas fa-shopping-cart text-900"></i>
            <span>Vendas</span>
        </a>
        <div id="collapseUm" class="collapse" aria-labelledby="headingUm" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a title="Gerenciar Vendas" class="collapse-item" href="<?php echo base_url('vendas'); ?>"><i class="fas fa-shopping-cart text-900" style="color: mediumseagreen;"></i>&nbsp;&nbsp;Vendas</a>
                <a title="Gerenciar Ordem de Serviços" class="collapse-item" href="<?php echo base_url('os'); ?>"><i class="fas fa-shopping-basket text-900" style="color: blue;"></i>&nbsp;&nbsp;Ordem de Serviços</a>

            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseDois" aria-expanded="true" aria-controls="collapseOne">
            <i class="fas fa-database"></i>
            <span>Cadastros</span>
        </a>
        <div id="collapseDois" class="collapse" aria-labelledby="headingDois" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a title="Gerenciar Clientes" class="collapse-item" href="<?php echo base_url('clientes'); ?>"><i class="fas fa-user-tie text-green-900" style="color: mediumseagreen;"></i>&nbsp;&nbsp;Clientes</a>
                <a title="Gerenciar Fornecedores" class="collapse-item" href="<?php echo base_url('fornecedores'); ?>"><i class="fas fa-user-tag text-blue-900" style="color: blue;"></i></i>&nbsp;&nbsp;Fornecedores</a>
                <a title="Gerenciar Vendedores" class="collapse-item" href="<?php echo base_url('vendedores'); ?>"><i class="fas fa-user-secret text-900 " style="color: tomato;"></i>&nbsp;&nbsp;Vendedores</a>
                <a title="Gerenciar Serviços" class="collapse-item" href="<?php echo base_url('servicos'); ?>"><i class="fas fa-wrench text-900" style="color: orange;"></i>&nbsp;&nbsp;Serviços</a>

            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTres" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-box-open"></i>
            <span>Estoque</span>
        </a>
        <div id="collapseTres" class="collapse" aria-labelledby="headingTres" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a title="Gerenciar Marcas" class="collapse-item" href="<?php echo base_url('marcas'); ?>"><i class="fab fa-codepen" style="color: GreenYellow;"></i>&nbsp;&nbsp;Marcas</a>
                <a title="Gerenciar Produtos" class="collapse-item" href="<?php echo base_url('produtos'); ?>"><i class="fas fa-tags" style="color: Chocolate;"></i></i>&nbsp;&nbsp;Produtos</a>
                <a title="Gerenciar Categorias" class="collapse-item" href="<?php echo base_url('categorias'); ?>"><i class="fas fa-vector-square" style="color: MediumBlue;"></i>&nbsp;&nbsp;Categorias</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseQuatro" aria-expanded="true" aria-controls="collapseTres">
            <i class="fas fa-donate"></i>
            <span>Financeiro</span>
        </a>
        <div id="collapseQuatro" class="collapse" aria-labelledby="headingQuatro" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a title="Gerenciar Contas a Pagar" class="collapse-item" href="<?php echo base_url('pagar'); ?>"><i class="fas fa-comment-dollar" style="color: ForestGreen;"></i>&nbsp;&nbsp;Contas a Pagar</a>
                <a title="Gerenciar Contas a Receber" class="collapse-item" href="<?php echo base_url('receber'); ?>"><i class="fas fa-hand-holding-usd" style="color: DarkRed;"></i>&nbsp;&nbsp;Contas a Receber</a>
                <a title="Gerenciar Formas de Pagamentos" class="collapse-item" href="<?php echo base_url('pagamentos'); ?>"><i class="far fa-credit-card" style="color: #009926"></i>&nbsp;&nbsp;Formas de Pagamento</a>
                <a title="Gerenciar Fluxo de Caixa" class="collapse-item" href="<?php echo base_url('pagamentos'); ?>"><i class="far fa-credit-card" style="color: #009926"></i>&nbsp;&nbsp;Fluxo de Caixa</a>
            </div>
        </div>
    </li>


    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Configurar
    </div>

    <!-- Nav Item - Usuários -->
    <li class="nav-item">
        <a title="Gerenciar Usuários" class="nav-link" href="<?php echo base_url('usuarios'); ?>">
            <i class="fas fa-user-friends"></i>
            <span>Usuários</span></a>
    </li>


    <!-- Nav Item - Sistema -->
    <li class="nav-item">
        <a title="Gerenciar Dados do sistema" class="nav-link" href="<?php echo base_url('sistema'); ?>">
            <i class="fas fa-cogs"></i>
            <span>Sistema</span></a>
    </li>
    
    <li class="nav-item">
        <a title="Fazer Backup do sistema" class="nav-link" href="<?php echo base_url('backup/backup_syscontrol'); ?>">
            <i class="far fa-save"></i>
            <span>Backup</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

