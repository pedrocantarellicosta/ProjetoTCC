
    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Navegação</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!-- <a class="navbar-brand" href="#">Noxus</a> -->
                <a href="<?php echo base_url('home')?>"><img src="<?php echo base_url('assets/imagens/logoN.png')?>" style="width:50px;margin-top:2px;"/></a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" style="float:right;">
                <ul class="nav navbar-nav">
                    <li>
                            <a href="<?php echo base_url('home')?>">Home</a>
                        </li>    
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Sistema <span class="caret"></span></a>
                      <ul class="dropdown-menu">
                        <li><a href="<?php echo base_url('noxus')?>">Utilizar</a></li>
                        <li><a href="/sistemanoxus/download/Noxus.zip" download>Fazer Download</a></li>
                      </ul>
                    </li>
                    <li>
                        <a href="<?php echo base_url('sobrenos')?>">Sobre</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('contato')?>">Contato</a>
                    </li>
                    <li>
                        <?php if($this->session->userdata('logado')==TRUE){?>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style='color: #28CC9E;'>Logado como <?=$this->session->userdata('user')->nome?><span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="<?php echo base_url('admin/administrar-conta')?>">Administrar Conta</a></li>
                                    <li><a href="<?php echo base_url('admin/codigos-salvos')?>">Códigos Salvos</a></li>

                                    <li><a href="<?php echo base_url('admin/logout')?>" style='color:#FF0000'>Logout</a></li>
                                </ul>
                            </li>
                        <?php }else{?>    
                            <li>
                                <a href="<?php echo base_url('admin/login')?>">Login</a>
                            </li>
                        <?php }?>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
