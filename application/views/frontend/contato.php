 
<section class="probootstrap-cover">
<div class="container">
<div class="row probootstrap-vh-100">
    <div class="col-sm">
        <div class="probootstrap-text">
            <h1  style="color:white; margin-top:100px; margin-bottom:40px; font-size:50px">Fale Conosco</h1>
        </div>
    </div>
</div>
</div>
</section>


    <div class="container " >
    <div class="col-md-3">
    </div>    
    <div class="col-md-6">
            <div class="form-area"> 
                <?php if ($this->session->flashdata('success') == TRUE): ?>
                <div class="alert alert-success" role="alert"><?= $this->session->flashdata('success'); ?></div>
                <?php endif; ?>
                <?php if ($this->session->flashdata('error') == TRUE): ?>
                <div class="alert alert-warning" role="alert"><?= $this->session->flashdata('error'); ?></div>
                <?php endif; ?> 
                <?php   
                    echo form_open('contato/enviasugestao');
                ?>

                    <br style="clear:both">
                    <div class="form-group">
                        <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" required
                        <?php 
                        if($this->session->userdata('logado')==TRUE){?>
                            value='<?=$this->session->userdata('user')->nome?>'
                        <?php } ?>
                        >
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="email" name="email" placeholder="E-mail" required
                        <?php 
                        if($this->session->userdata('logado')==TRUE){?>
                            value='<?=$this->session->userdata('user')->email?>'
                        <?php } ?>
                        >
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="telefone" name="telefone" placeholder="Numero de Telefone   ">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="assunto" name="assunto" placeholder="Assunto" required>
                    </div>
                    <div class="form-group">
                    <textarea class="form-control" type="text" id="mensagem" name='mensagem' placeholder="Mensagem" maxlength="140" rows="7"></textarea>
                    </div>
                        
                        <button class="btn btn-lg btn-success btn-block">Enviar Sugestão</button>
                
                    <?php   echo validation_errors('<br><div class="alert alert-danger">','</div>');
                    ?>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
