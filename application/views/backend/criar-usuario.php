

<section class="probootstrap-section" style='margin:200px 100px 100px 100px;'>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Criar Usuario</h3>
                    </div>
                    <div class="panel-body">
                        <?php
                            echo form_open('admin/usuarios/criarusuario');
                        ?>
                        <?php if ($this->session->flashdata('success') == TRUE): ?>
                        <div><?= $this->session->flashdata('success'); ?></div>
                        <?php endif; ?>
                        <?php if ($this->session->flashdata('error') == TRUE): ?>
                        <div class="alert alert-warning" role="alert"><?= $this->session->flashdata('error'); ?></div>
                        <?php endif; ?>
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Usuário" name="txt-user" type="text" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Senha" name="txt-senha" type="password" value="">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Nome Completo" name="txt-nome" type="text" value="">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Email" name="txt-email" type="email" value="">
                                </div>
                            </fieldset>
                        <?php   echo validation_errors('<div class="alert alert-danger">','</div>');
                        ?>
                                 <button class="btn btn-lg btn-success btn-block">Criar Usuario</button>
                        <?php echo form_close();?>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</section>