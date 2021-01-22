

<?php $this->load->view('layout/sidebar'); ?>



<!-- Main Content -->
<div id="content">

    <?php $this->load->view('layout/navbar'); ?>

    <!-- Begin Page Content -->
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url('/'); ?>">Início</a></li>
                <li class="breadcrumb-item"><a href="<?php echo base_url('usuarios'); ?>">Usuários</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo $titulo; ?></li>
            </ol>
        </nav>



        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <label>Cadastro de Usuários</label>
                <a title="Voltar para a lista de usuários" href="<?php echo base_url('usuarios'); ?>" class="btn btn-success btn-sm float-right"><i class="fas fa-arrow-left"></i>&nbsp; Voltar</i></a>
            </div>
            <div class="card-body">
                <form method="POST" name="form_add">
                    <div class="form-group row">
                        
                        <div class="col-md-5">
                            <label for="formGroupExampleInput">Nome</label>
                            <input type="text" class="form-control" name="first_name" placeholder="Digite seu primeiro nome" value="<?php echo set_value('first_name');?>">
                            <?php echo form_error('first_name', '<small class="form-text text-danger">','</small>'); ?>
                        </div>
                        
                        <div class="col-md-7">
                            <label for="formGroupExampleInput">Sobrenome</label>
                            <input type="text" class="form-control" name="last_name" placeholder="Digite seu sobrenome" value="<?php echo set_value('last_name');?>">
                            <?php echo form_error('last_name', '<small class="form-text text-danger">','</small>'); ?>
                        </div>
                        
                    </div>
                    
                    <div class="form-group row">
                        
                        <div class="col-md-3">
                            <label for="formGroupExampleInput">E-mail</label>
                            <input type="email" class="form-control" name="email" placeholder="Digite seu E-mai" value="<?php echo set_value('email');?>">
                            <?php echo form_error('email', '<small class="form-text text-danger">','</small>'); ?>
                        </div>
                        
                        <div class="col-md-3">
                            <label for="formGroupExampleInput">Usuário</label>
                            <input type="text" class="form-control" name="username" placeholder="Digite seu Usuário" value="<?php echo set_value('username');?>">
                            <?php echo form_error('username', '<small class="form-text text-danger">','</small>'); ?>
                        </div>
                        
                        <!-- Select sutiação de usuario -->
                        <div class="col-md-3">
                            <label for="formGroupExampleInput">Situação</label>
                            <select class="form-control" name="active">
                                
                                <option value="1">Ativo</option>
                                <option value="0">Inativo</option>

                            </select>
                        </div>
                        
                        <!-- Perfis de usuario -->
                        <div class="col-md-3">

                            <label>Perfil de acesso</label>
                            
                            <!-- Select perfil de usuario -->
                            <select class="form-control" name="perfil_usuario" >

                                <option value="2">Vendedor</option>
                                <option value="1">Administrador</option>
                                <option value="3">Técnico</option>

                            </select>

                        </div>
                    </div>
                    
                    <div class="form-group row">
                        
                        <div class="col-md-6">
                            <label>Senha</label>
                            <input type="password" class="form-control" name="password" placeholder="Digite sua Senha">
                            <?php echo form_error('password', '<small class="form-text text-danger">','</small>'); ?>
                            
                        </div>
                        
                        <div class="col-md-6">
                            <label>Confirme</label>
                            <input type="password" class="form-control" name="confirm_password" placeholder="Confirme sua Senha">
                            <?php echo form_error('confirm_password', '<small class="form-text text-danger">','</small>'); ?>
                        </div>
                        
                    </div>

                    </br><button title="Salvar" type="submit" class="btn btn-primary btn-small float-right col-md-2">Salvar</i></button>
                </form>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

