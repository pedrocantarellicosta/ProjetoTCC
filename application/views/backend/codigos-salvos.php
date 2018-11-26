<section class="probootstrap-section" style='margin-top:3%; min-height:700px;'>
    <div class='container'>
        <div class='row'>
            <div class="list-group">
                <?php 
                $codigos = $this->session->userdata('codigo');
                if(count($codigos)==0){
                    ?>
                    <div class="list-group-item list-group-item-action flex-column align-items-start ">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-10 ">
                                    <h4>Não possuem Códigos Salvos</h4>
                                </div>
                            </div>

                        </div>
                    </div>
                    <?php
                }
                $linha = 1;
                foreach($codigos as $cod)
                {?>
                    <div class="list-group-item list-group-item-action flex-column align-items-start ">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-10 ">
                            
                                    <div class="d-flex   justify-content-between">
                                    <h5 class="mb-1">Código <?=$linha?></h5>

                                    </div>
                                    <p class="mb-1"><?=$cod->descricao?></p>
                                    <input type='hidden' id='codigo' name='codigo' value='<?=$cod->codigo?>'>
                                    <small>Feito no dia <?=date('d/m/Y', strtotime($cod->data))?></small>
                                </div>
                                <div class="col-md-2 ">
                                    <a class="btn  btn-success "  href="<?php echo base_url('noxus/'.$linha)?>" style="width:90%; margin-right:2%;margin-bottom:2%;">Carregar</a><br>
                                    <a class="btn  btn-danger " href="<?php echo base_url('admin/codigos-salvos/excluicodigo/'.$cod->id_codigos.'/'.$cod->id_usuario)?>" style="width:90%; margin-right: 2%; margin-top:2%;">Excluir</a>
                                </div>
                            </div>

                        </div>
                    </div>
                <?php 
                    $linha++;
                } 
                ?>
            </div>
        
        </div>
    </div>
</section>
</div
