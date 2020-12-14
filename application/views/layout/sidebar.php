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
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
            <i class="fas fa-database"></i>
            <span>Cadastros</span>
        </a>
        <div id="collapseOne" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a title="Gerenciar Clientes" class="collapse-item" href="<?php echo base_url('clientes'); ?>"><i class="fas fa-user-tie text-green-900" style="color: mediumseagreen;"></i>&nbsp;&nbsp;Clientes</a>
                <a title="Gerenciar Fornecedores" class="collapse-item" href="<?php echo base_url('fornecedores'); ?>"><i class="fas fa-user-tag text-blue-900" style="color: blue;"></i></i>&nbsp;&nbsp;Fornecedores</a>
                <a title="Gerenciar Vendedores" class="collapse-item" href="<?php echo base_url('vendedores'); ?>"><i class="fas fa-user-secret text-900 " style="color: tomato;"></i>&nbsp;&nbsp;Vendedores</a>
                <a title="Gerenciar Serviços" class="collapse-item" href="<?php echo base_url('servicos'); ?>"><i class="fas fa-screwdriver" style="color: orange;"></i>&nbsp;&nbsp;Serviços</a>
                
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-box-open"></i>
            <span>Estoque</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a title="Gerenciar Marcas" class="collapse-item" href="<?php echo base_url('marcas'); ?>"><i class="fab fa-codepen" style="color: GreenYellow;"></i>&nbsp;&nbsp;Marcas</a>
                <a title="Gerenciar Categorias" class="collapse-item" href="<?php echo base_url('categorias'); ?>"><i class="fas fa-vector-square" style="color: MediumBlue;"></i>&nbsp;&nbsp;Categorias</a>
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

