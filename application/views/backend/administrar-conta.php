

<section class="probootstrap-section" style='margin:200px 100px 100px 100px;'>

<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Alterar Dados</h3>
                </div>
                <div class="panel-body">
                    <?php
                        echo form_open('admin/usuarios/alterardadosusuario');
                    ?>
                    <?php if ($this->session->flashdata('success') == TRUE): ?>
                    <div class="alert alert-success" role="alert"><?= $this->session->flashdata('success'); ?></div>
                    <?php endif; ?>
                    <?php if ($this->session->flashdata('error') == TRUE): ?>
                    <div class="alert alert-warning" role="alert"><?= $this->session->flashdata('error'); ?></div>
                    <?php endif; ?>
                        <fieldset>
                            <div class="form-group">
                                <input type="text" class="form-control" id="nome" name="txt-nome" placeholder="Nome Completo" required value='<?=$this->session->userdata('user')->nome?>' >   
                            </div>

                            <div class="form-group">
                                <input class="form-control" placeholder="Email" name="txt-email" type="email" value="<?=$this->session->userdata('user')->email?>">
                            </div>

                            <div class="form-group">
                                <input class="form-control" placeholder="Senha Antiga" name="txt-senha-antiga" type="password" value="">
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Nova Senha" name="txt-senha-nova" type="password" value="">
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Redigite a Senha Nova" name="txt-redigita-senha-nova" type="password" value="">
                            </div>

                        </fieldset>
                    <?php   echo validation_errors('<div class="alert alert-danger">','</div>');
                    ?>
                             <button class="btn btn-lg btn-success btn-block">Alterar Dados</button>
                    <?php echo form_close();?>
                </div>
                
            </div>
        </div>
    </div>
</div>
</section>