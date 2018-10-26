

<section class="probootstrap-section" style='margin:200px 100px 100px 100px;'>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Entrar no sistema</h3>
                    </div>
                    <div class="panel-body">
                        <?php   
                            
                            echo form_open('admin/usuarios/login');
                        ?>
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Usuário" name="txt-user" type="text" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Senha" name="txt-senha" type="password" value="">
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                            </fieldset>
                        <?php   echo validation_errors('<div class="alert alert-danger">','</div>');
                        ?>
                                 <button class="btn btn-lg btn-success btn-block">Entrar</button>
                                 <br>

                                 <div class="form-area">  
                        <?php echo form_close();?>
                        <a href="<?php echo base_url('admin/criar-usuario')?>" class="btn btn-lg btn-primary btn-block">Criar Usuario</a>

                    </div><br><br>
                    <?php if ($this->session->flashdata('success') == TRUE): ?>
                            <div><?= $this->session->flashdata('success'); ?></div>
                            <?php endif; ?>
                            <?php if ($this->session->flashdata('error') == TRUE): ?>
                            <div class="alert alert-danger" role="alert"><?= $this->session->flashdata('error'); ?></div>
                            <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>