

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
            
            <?php if($this->ion_auth->is_admin()): ?>
            <div class="card-header py-3">
                <a title="Voltar para a lista de usuários" href="<?php echo base_url('usuarios'); ?>" class="btn btn-success btn-sm float-right"><i class="fas fa-arrow-left"></i>&nbsp; Voltar</i></a>
            </div>
            <?php endif; ?>
            <div class="card-body">
                <form method="POST" name="form_edit">
                    <div class="form-group row">

                        <div class="col-md-6">
                            <label for="formGroupExampleInput">Nome</label>
                            <input type="text" class="form-control" name="first_name" placeholder="Digite seu primeiro nome" value="<?php echo $usuario->first_name ?>">
                            <?php echo form_error('first_name', '<small class="form-text text-danger">', '</small>'); ?>
                        </div>

                        <div class="col-md-6">
                            <label for="formGroupExampleInput">Sobrenome</label>
                            <input type="text" class="form-control" name="last_name" placeholder="Digite seu sobrenome" value="<?php echo $usuario->last_name ?>">
                            <?php echo form_error('last_name', '<small class="form-text text-danger">', '</small>'); ?>
                        </div>

                    </div>

                    <div class="form-group row">
                        
                        <div class="col-md-3">
                            <label for="formGroupExampleInput">E-mail</label>
                            <input type="email" class="form-control" name="email" placeholder="Digite seu E-mai" value="<?php echo $usuario->email ?>">
                            <?php echo form_error('email', '<small class="form-text text-danger">', '</small>'); ?>
                        </div>

                        <div class="col-md-3">
                            <label for="formGroupExampleInput">Usuário</label>
                            <input type="text" class="form-control" name="username" placeholder="Digite seu Usuário" value="<?php echo $usuario->username ?>">
                            <?php echo form_error('username', '<small class="form-text text-danger">', '</small>'); ?>
                        </div>
                        
                        <div class="col-md-3">
                            <label for="formGroupExampleInput">Situação</label>
                            <select class="form-control" name="active" <?php echo (!$this->ion_auth->is_admin() ? 'disabled' : '');?>>

                                <option value="0" <?php echo($usuario->active == 0) ? 'selected' : '' ?>>Inativo</option>
                                <option value="1" <?php echo($usuario->active == 1) ? 'selected' : '' ?>>Ativo</option>

                            </select>
                        </div>
                        

                        <!-- Perfis de usuario -->
                        <div class="col-md-3">

                            <label>Perfil de acesso</label>

                            <select class="form-control" name="perfil_usuario" <?php echo (!$this->ion_auth->is_admin() ? 'disabled' : '');?>>

                                <option value="2" <?php echo ($perfil_usuario->id == 2) ? 'selected' : '' ?>>Vendedor</option>
                                <option value="1" <?php echo ($perfil_usuario->id == 1) ? 'selected' : '' ?>>Administrador</option>

                            </select>

                        </div>
                        
                    </div>

                    <div class="form-group row">

                        <div class="col-md-6">
                            <label>Senha</label>
                            <input type="password" class="form-control" name="password" placeholder="Digite sua Senha">
                            <?php echo form_error('password', '<small class="form-text text-danger">', '</small>'); ?>

                        </div>

                        <div class="col-md-6">
                            <label>Confirme</label>
                            <input type="password" class="form-control" name="confirm_password" placeholder="Confirme sua Senha">
                            <?php echo form_error('confirm_password', '<small class="form-text text-danger">', '</small>'); ?>
                        </div>

                        <input type="hidden" name="usuario_id" value="<?php echo $usuario->id ?> "/>

                    </div>

                    </br><button type="submit" class="btn btn-primary btn-sm float-right">Salvar</button>
                </form>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

