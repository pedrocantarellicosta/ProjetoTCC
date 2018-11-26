 

<?php if ($this->session->flashdata('success') == TRUE): ?>
<div><?= $this->session->flashdata('success'); ?></div>
<?php endif; ?>
<?php if ($this->session->flashdata('error') == TRUE): ?>
<div><?= $this->session->flashdata('error'); ?></div>
<?php endif; ?> 

<section class="probootstrap-section" style='margin-top:3%'>
<div class='container'>
    <div class='row'>
        <div class='col-md-12'>
        <?php if ($this->session->flashdata('success') == TRUE): ?>
            <div class="alert alert-success" role="alert"><?= $this->session->flashdata('success'); ?></div>
            <?php endif; ?>
            <?php if ($this->session->flashdata('error') == TRUE): ?>
            <div class="alert alert-warning" role="alert"><?= $this->session->flashdata('error'); ?></div>
            <?php endif; ?> 
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" style="float:left;">
                <ul class="nav navbar-nav">

                    <li class="dropdown" style='margin: 0px 2px 10px 0px;;'>
                      <a href="#" class="btn btn-primary btn-lg" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Variaveis <span class="caret"></span></a>
                      <ul class="dropdown-menu">
                        <li><a onclick="adicionaVariavel(1)">Número</a></li>
                        <li><a onclick="adicionaVariavel(2)">Caractere</a></li>
                        <li><a onclick="adicionaVariavel(3)">Palavra</a></li>
                      </ul>
                    </li>

                    <li class="dropdown" style='margin: 0px 0px 10px 2px;'>
                      <a href="#" class="btn btn-primary btn-lg" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Funções <span class="caret"></span></a>
                      <ul class="dropdown-menu">
                        <li><a onclick="adicionaPara()">Para</a></li>
                        <li><a onclick="adicionaEnquanto()">Enquanto</a></li>
                        <li><a onclick="adicionaSe()">Se</a></li>
                        <li class="dropdown"><a onclick="adicionaImprime(1)">Imprime</a>
                      </ul>
                    </li>

                </ul>
                
            </div>
            <div style='float:right; margin-top:5px;'>
                <button type="button" class="btn btn-warning btn-lg" data-toggle="modal" data-target="#uploadModal">Upload</button>

                <div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="UploadModal" aria-hidden="true">
                <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="UploadModalTittle">Carregue um Código a partir de um arquivo texto</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                    
                                    <input type="file" class="btn btn-warning" id="inputFile" onchange='pegaTxt(this)' >


                                </div>
                            </div>    
                </div>
            </div>
                <?php if($this->session->userdata('logado')==TRUE){?>
                        <button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#salvarCodigo" onclick='salvarCodigo()'>Salvar</button>

                            <div class="modal fade" id="salvarCodigo" tabindex="-1" role="dialog" aria-labelledby="SalvarCodigo" aria-hidden="true">
                            <?php
                                    echo form_open('admin/codigos/salvarcodigo');
                            ?>
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Novo Código</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                    
                                        <div class="form-group">
                                            <label for="recipient-name" class="col-form-label">Descrição:</label>
                                            <textarea class="form-control" id="descricao" name='descricao' style="resize:none;height:100px;"></textarea>
                                            <input type='hidden' id='txt-codigo' name='txt-codigo' value=''>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-info" data-dismiss="modal">Close</button>
                                        <button  class="btn btn-success">Salvar</button>
                                    
                                    </div>

                                </div>
                            </div>
                            <?php echo form_close();?>

                            </div>                        
                    <?php } ?>
                </div>
        </div>
        
    </div>
    <div class='row'>
        <div class='col-md-8 ' style='height:650px'>
        <div id="editor"></div>
            <div id="range" style="display:none" >
                <input type="range" id="desliza"  onchange="changeRange(this.value)" min="0" max="20" >
            </div>
        </div>

        <div class='col-md-4 ' >
            <div class='row' style=' height:324px'>
                <div id="variaveis">
                    <div class="titulo"><h3>Variaveis</h3></div>
                    <div id="campovariaveis"></div>
                </div>
            </div>
            <div class='row' style=' height:324px'>
                <div id="resultado">
                    <div class="titulo"><h3>Resultado</h3></div>
                    <div id="camporesultado"></div>
                </div>
            </div>
            <div class='row'style='margin-top:15px; margin-left:3px;'>

                    <button class="btn btn-lg btn-success btn-block" onclick='play()'>Executar</button>

            </div>
            <div id="range" style="display:none" >
                <input type="range" id="desliza"  onchange="changeRange(this.value)" min="0" max="20" >
            </div>

    </div>
        </div>
        
    </div>
</div>
</section>

<p id="atributos"></p>

<section class="probootstrap-section" style='margin-top:1%'>
<div class='container'>
    <div class='row'>
        <div class='col-md-12'>
            <hr>
            <h1> Exemplos</h1>
                    
<div id="accordion">
  <div class="card">
    <div class="card-header" id="headingOne">
      <h5 class="mb-0">
        <button class="btn btn-primary" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" style="width:10%">
          Calculadora
        </button>
      </h5>
    </div>

    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
      <div class="card-body">
        Algoritmo que mostra a soma, subtração, multiplicação e divizão entre dois números.
        <br><br><a class="btn  btn-success " onclick = "exemploCalculadora()">Carregar</a><br>

      </div>

    </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingTwo">
      <h5 class="mb-0">
        <button class="btn btn-primary" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" style="width:10%">
            Comissão
        </button>
      </h5>
    </div>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
      <div class="card-body">
      Algoritmo que calcula a comissão de vendas efetuadas no mês a partir do valor de vendas sabendo que a comissão é de 15% do valor total das vendas.      </div>
      <br><a class="btn  btn-success " onclick = "exemploComissao()">Carregar</a><br>
              

  </div>
  <div class="card">
    <div class="card-header" id="headingThree">
      <h5 class="mb-0">
        <button class="btn btn-primary " data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree" >
            Maior Numero
        </button>
      </h5>
    </div>
    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
      <div class="card-body">
          Qual Maior entre dois numeros.
         <br> <br><a class="btn  btn-success " onclick = "exemploQualMaiorNumero()">Carregar</a><br>

    </div>
    </div>
  </div>
</div>

        </div>
    </div>
</div>
</section>







<script src="<?php echo base_url('assets/backend/js/ace/src-noconflict/ace.js')?>" type="text/javascript" charset="utf-8"></script>

<script>

editor = ace.edit("editor");
editor.setTheme("ace/theme/chaos");
editor.$blockScrolling = Infinity;
var Range = ace.require('ace/range').Range;

//Selecionar erro nas linhas. from = linha inicio | to = linha final
//editor.session.addMarker(new Range(from, 0, to, 1), "myMarker", "fullLine");

 var p = document.getElementById("desliza");
 //res = document.getElementById("valordesliza");

 p.addEventListener("input", function() {
     //res.innerHTML = sequencia.linhas[p.value-1]+1;
     mostraVariaveiseResultadosSelecionado(variaveis, resultados, p.value);
 }, false);
 
function exemploCalculadora(){
    texto = "numero numeroum = 3\r\nnumero numerodois = 4\r\n\r\nnumero soma = 0\r\nnumero subtracao = 0\r\nnumero multiplicacao = 0\r\nnumero divizao = 0\r\n\r\nsoma = numeroum + numerodois\r\nsubtracao = numeroum - numerodois\r\nmultiplicacao = numeroum * numerodois\r\ndivizao = numeroum / numerodois\r\n\r\nimprime(\"Resultado da soma eh \",soma)\r\nimprime(\"Resultado da subtracao eh \",subtracao)\r\nimprime(\"Resultado da multiplicacao eh \",soma)\r\nimprime(\"Resultado da divizao eh \",divizao)";

    editor.setValue("");
    editor.insert(texto, 0);
}

function exemploComissao(){
    texto = "palavra nome = Fulano\r\nnumero salario = 1500\r\nnumero valortotalvendas = 0\r\nnumero comissao = 0\r\nnumero salariofinal = 0\r\n\r\nvalortotalvendas = 10000\r\n\r\ncomissao = valortotalvendas * 15\r\ncomissao = comissao / 100\r\n\r\nsalariofinal = salario + comissao\r\n\r\nimprime(\"Resultado\")\r\nimprime(\"Vendedor eh \", nome)\r\nimprime(\"Salario eh R$\", salario)\r\nimprime(\"Valor Total de Vendas R$\", valortotalvendas)\r\nimprime(\"Comissao de R$\", comissao)\r\nimprime(\"Total a receber R$\", salariofinal)";

    editor.setValue("");
    editor.insert(texto, 0);
}

function exemploQualMaiorNumero(){
    texto = "numero i = 0\r\nnumero x = 0\r\n\r\nx = 10\r\ni = 20\r\n \r\nimprime(\"Maior Numero\")\r\n \r\nse (x > i) entao\r\n  imprime(x) \r\nfimse\r\n\r\nse (i > x) entao\r\n    imprime(i)\r\nfimse";

    editor.setValue("");
    editor.insert(texto, 0);
}

function uploadTexto(file){
    
}


var leitorDeTxt = new FileReader()
window.onload = function init() {
    leitorDeTxt.onload = leTxt;
}

function pegaTxt(inputFile) {
     var file = inputFile.files[0];
     leitorDeTxt.readAsText(file);
}
function leTxt(evt) {
    var textoArquivo = evt.target.result;

    editor.setValue("");
    editor.insert(textoArquivo, 0);
    

}
</script>

<?php
    if(isset($cod) && $cod != null){
?>
        <script>
            var teste = <?php echo json_encode($cod)?>;
            editor.setValue("");
            editor.insert(teste, 0);
        </script>

<?php
    }
?>

