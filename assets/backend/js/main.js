//document.write(unescape("%3Cscript src='assets/backend/js/noxus.js' type='text/javascript'%3E%3C/script%3E"));
//document.write(unescape("%3Cscript src='assets/backend/js/resultados.js' type='text/javascript'%3E%3C/script%3E"));



var qtdlinha;
var linha;
var sequencia;
var erros;
var marcador;

function salvarCodigo(){
  document.getElementById('txt-codigo').value = editor.getValue();
}

function play(){
  variaveis = [];
  sequencia = new Fluxo();
  resultados = new Resultado();
  linha=0;
  //CRIA VARIAVEL QUE CONTEM O PRIMEIRO ERRO
  erros = new Erro();
  //LIMPA OS MARCADORES DE ERRO DO CODIGO
  editor.session.removeMarker(marcador);

  qtdlinha = editor.getLastVisibleRow();

  var texto = editor.getValue();
  var textolinhas = texto.split("\n");


  while(linha<=qtdlinha && erros.linha.length == 0){    
    //console.log("entro");
    linha = executaLogica(textolinhas, variaveis, linha, sequencia, erros);

  }
  mostraVariaveiseResultadosFinal(variaveis, resultados, erros, sequencia);
}


function executaLogica(textolinhas, variaveis, linha, sequencia, erros){

  if(textolinhas[linha].trim()!=""){
    linhaantiga = linha;
    textolinhas[linha].toLowerCase();

    if(linhaantiga == linha)linha = funcaoPara(textolinhas,variaveis, linha, sequencia, erros);
    if(linhaantiga == linha)linha = funcaoEnquanto(textolinhas,variaveis, linha, sequencia, erros);
    if(linhaantiga == linha)linha = funcaoSe(textolinhas,variaveis, linha, sequencia, erros);

    //SÓ EXECUTA SE NAO ENTROU EM NENHUMA FUNÇAO
    if(linhaantiga == linha){
      //verifico regex de variaveis, tipos pois tem q ser um ou outro
      //no final, apos estar funcionando transformar toda essa lógica em uma funçao para reutilizacao dentro das funcoes
      //para, enquanto e se.
      if(linha <= qtdlinha){
        // TESTE PARA SABER SE É UM INICIO DE CRIAÇAO DE VARIAVEL.
        regexInteiro = /^inteiro/;
        regexPalavra = /^palavra/;
        regexCaracter = /^caracter/;
        regexImprime = /^imprime\(/  

        nomeVariavel = textolinhas[linha].trim().split("=")[0].trim();
        ehVariavel = false;
        for(x = 0; x < variaveis.length && ehVariavel == false;x++){
          //console.log("numero: "+x);
          if(variaveis[x].nome == nomeVariavel){
            ehVariavel = true;
          }
        }

        if(regexInteiro.test(textolinhas[linha].trim()) == true ||
           regexPalavra.test(textolinhas[linha].trim()) == true || 
           regexCaracter.test(textolinhas[linha].trim()) == true||
           regexImprime.test(textolinhas[linha].trim()) == true||
           ehVariavel ){
            
          console.log(textolinhas[linha]);  

          variaveisEResultados(textolinhas[linha].trim(),variaveis,linha, sequencia, erros);
          OperacaoMatemarica(textolinhas[linha].trim(),variaveis,linha, sequencia, erros);

          linha++;
        }
        
        

      }
      if(linha == linhaantiga){

          erros.setErro((linha+1), "LINHA NAO CORRESPONDE A NENHUM COMANDO EXISTENTE!");
        
      }
    }
  }else linha++;

  return linha;
}

function variaveisEResultados(textolinha,variaveis,linha, sequencia, erros){
  verificaVariavel(textolinha,variaveis,linha, sequencia, erros);
  mudaValorVariavel(textolinha,variaveis, linha, sequencia, erros);
  verificaImprime(textolinha, resultados, variaveis, linha, sequencia, erros);
}

function funcaoPara(textolinhas, variaveis, linha, sequencia, erros){
  var teste = verificaPara(textolinhas[linha].trim());
  //SE RETORNA TRUE TEM INICIO DE UMA FUNÇÃO PARA MAS NAO ESTA CORRETO A SINTAXE.
  if(teste !=false){
    if(teste === true){
      erros.setErro((linha+1), "ERRO DE SINTAXE DA FUNÇÃO PARA");return;
    }else{
       var varfor = verificaExistenciaVariavel(variaveis, teste[0]);
      alert(linha+ " : "+ teste[0]);
      if(varfor !== false){
        var  qtd=0;

        sequencia.setFluxo(linha);
        variaveis[varfor].setValor(teste[1], sequencia.linhas.length);
        var x = variaveis[varfor].valores[variaveis[varfor].valores.length-1];
        x++;
        linha+=1;

        for(;x <= parseInt(teste[2]);x++){
          //console.log("X sendo: "+x);
          //console.log(textolinhas[linha]);
           var linhaant = linha;
          while(!verificaFimPara(textolinhas[linha].trim())){
            if(linha>qtdlinha){
              erros.setErro((linha+1), "ERRO! NÃO EXISTE FINAL DA FUNÇÃO PARA");
              return;
            }
           
            //variaveisEResultados(textolinhas[linha].trim(),variaveis,linha, sequencia, erros);
            //OperacaoMatemarica(textolinhas[linha].trim(),variaveis,linha, sequencia, erros);
            
            
            linha = executaLogica(textolinhas, variaveis, linha, sequencia, erros);
            sequencia.setFluxo(linha);
            variaveis[varfor].setValor(x, sequencia.linhas.length);
            //linha++;
            qtd = (linha - linhaant);
            // console.log("Quantidade: "+qtd+ " Linha: "+linha+" linhaant: "+linhaant);
          }
          sequencia.setFluxo(linha);
          //DEVE SER DIMINUIDO A QUANTIDADE DE LINHAS QUE O FOR PERCORREU DA VARIAVEL LINHA
          
          //VERIFICAR RETORNO DA VARIAVEL LINHA - ESTA RETORNANDO ERRADO.
          console.log(teste[0]+" : "+varfor+" : "+x);
          if(x != parseInt(teste[2])){
            console.log("Diminui!!  linha: "+linha+" qtd: "+qtd);
            linha -= qtd;
            qtd=0;
            sequencia.setFluxo(linha-1);
          }else{linha++;}
        }
      }
    }
  }
  //alert("Retorno linha : "+linha);
  return linha;
}

function funcaoEnquanto(textolinhas, variaveis, linha, sequencia, erros){
  var teste = verificaEnquanto(textolinhas[linha].trim());
  if(teste !=false){
    //TRUE PARA ERRO DE SINTAXE
    if(teste === true){
      erros.setErro((linha+1), "ERRO DE SINTAXE DA FUNÇÃO ENQUANTO");return;
    }else{
      var  qtd=0;
      sequencia.setFluxo(linha);
      linha+=1;
      var valor=0;
      //TESTAS SE VARIAVEIS EXISTEM
      varum = verificaExistenciaVariavel(variaveis, teste[0]);
      if(ehNumero(teste[2])){
        vardois = parseInt(teste[2]);
        valor = vardois;
      }else vardois = verificaExistenciaVariavel(variaveis, teste[2]);

      if(varum !== false && vardois !== false){      
        
        if(ehNumero(teste[2] === false))valor = variaveis[vardois].valores[variaveis[vardois].valores.length-1];
        
        while(eval(variaveis[varum].valores[variaveis[varum].valores.length-1]+" "+teste[1]+" "+valor)){
         // console.log("linha: "+linha);
          while(!verificaFimEnquanto(textolinhas[linha].trim())){
           // console.log("testteste");
            if(linha>qtdlinha){
              erros.setErro((linha+1),"ERRO! NÃO EXISTE FINAL DA FUNÇÃO ENQUANTO");return;
             return;
            }
            variaveisEResultados(textolinhas[linha].trim(),variaveis,linha, sequencia, erros);
            OperacaoMatemarica(textolinhas[linha].trim(),variaveis,linha, sequencia, erros);
            linha++;
            qtd++
          }
         // console.log(variaveis[varum].valor+" "+teste[1]+" "+ valor);
          if(eval(variaveis[varum].valores[variaveis[varum].valores.length-1]+" "+teste[1]+" "+ valor)){
            sequencia.setFluxo(linha);
            //console.log("entrouaqui"+linha);
            linha -= qtd;
            qtd=0;
            sequencia.setFluxo(linha-1);
          }
        }
      }
      //while para caso nao passe na condição e tenha que pular as linhas
      while(!verificaFimEnquanto(textolinhas[linha].trim()))linha++;
      sequencia.setFluxo(linha);
    }
  }
  return linha;
}

function funcaoSe(textolinhas, variaveis, linha, sequencia, erros){
  //console.log(textolinhas[linha].trim());
  var teste = verificaSe(textolinhas[linha].trim());
  if(teste !=false){
    if(teste === true){

    }else{
      sequencia.setFluxo(linha);
      linha+=1;
      var ehVariaveis = [false, false];

      if(ehNumero(teste[0])){
        varum = parseInt(teste[0]);
      }else{
        varum = verificaExistenciaVariavel(variaveis, teste[0]);
        ehVariaveis[0]=true;
      }
      if(ehNumero(teste[2])){
        vardois = parseInt(teste[2]);
      }else{
        vardois = verificaExistenciaVariavel(variaveis, teste[2]);
        ehVariaveis[1] = true;
      } 
      if(varum !== false && vardois !== false){
        if(ehVariaveis[0]==true) varum = variaveis[varum].valores[variaveis[varum].valores.length-1];
        if(ehVariaveis[1]==true) vardois = variaveis[vardois].valores[variaveis[vardois].valores.length-1];

        if(eval(varum+" "+teste[1]+" "+vardois)){
          while(!verificaFimSe(textolinhas[linha].trim())){
            if(linha>qtdlinha){
              erros.setErro((linha+1), "ERRO! NÃO EXISTE FINAL DA FUNÇÃO SE");return;
             return;
            }
            linha = executaLogica(textolinhas, variaveis, linha, sequencia, erros);

          }
          sequencia.setFluxo(linha);
          linha++;
 
        }else{
          while(!verificaFimSe(textolinhas[linha].trim())){
            linha++;
          }
          sequencia.setFluxo(linha);
          linha++;

        }
      } else{
        erros.setErro((linha+1), "erro na execução");return;
      } 
    }
  }
  return linha;
}

function OperacaoMatemarica(textolinha, variaveis, linha, sequencia, erros){
  var teste = verificaConta(textolinha);

  if(teste !=false){
    varum = verificaExistenciaVariavel(variaveis, teste[0]);
    if(ehNumero(teste[1])) vardois = parseInt(teste[1]);
    else vardois = verificaExistenciaVariavel(variaveis, teste[1]);
    if(ehNumero(teste[3])) vartres = parseInt(teste[3]);
    else vartres = verificaExistenciaVariavel(variaveis, teste[3]);



    if(varum !== false && vardois !== false && vartres !== false){
      if(variaveis[varum].tipo != "int"){
        erros.setErro((linha+1), "VARIAVEL NÃO É DO TIPO INTEIRO.");
        return;
      }
      if(ehNumero(teste[1]) === true && ehNumero(teste[3]) === true){
        console.log(vardois+" "+teste[2]+" "+vartres);
        console.log(eval(vardois+" "+teste[2]+" "+vartres));
        sequencia.setFluxo(linha);
        variaveis[varum].setValor(eval(vardois+" "+teste[2]+" "+vartres), sequencia.linhas.length);
      }   
      if(ehNumero(teste[1]) === true && ehNumero(teste[3]) === false){
        if(variaveis[vartres].tipo != "int"){
          erros.setErro((linha+1), "VARIAVEL NÃO É DO TIPO INTEIRO.");
         return;
        }else{
          sequencia.setFluxo(linha);
          variaveis[varum].setValor(eval(vardois+" "+teste[2]+" "+variaveis[vartres].valores[(variaveis[vartres].valores.length-1)]), sequencia.linhas.length);
        }
      }
      if(ehNumero(teste[1]) === false && ehNumero(teste[3]) === true){
        if(variaveis[vardois].tipo != "int"){
          erros.setErro((linha+1), "VARIAVEL NÃO É DO TIPO INTEIRO.");
         return;
        }else{
          sequencia.setFluxo(linha);
          variaveis[varum].setValor(eval(variaveis[vardois].valores[(variaveis[vardois].valores.length-1)]+" "+teste[2]+" "+vartres), sequencia.linhas.length);
        }
      }
      if(ehNumero(teste[1]) === false && ehNumero(teste[3]) === false){
        if(variaveis[vardois].tipo != "int" && variaveis[vartres].tipo != "int"){
          erros.setErro((linha+1), "VARIAVEL NÃO É DO TIPO INTEIRO.");
         return;
        }else{
          sequencia.setFluxo(linha);
          variaveis[varum].setValor(eval(variaveis[vardois].valores[(variaveis[vardois].valores.length-1)]+" "+teste[2]+" "+variaveis[vartres].valores[(variaveis[vartres].valores.length-1)]), sequencia.linhas.length);
        }
      }
    }else erros.setErro((linha+1), "VARIAVEL UTILIZADA NA OPERAÇÃO NAO EXISTE");
  }
}

 function slidetoggle() {
  var slider = document.getElementById("nav-slide");
  slider.style.height = window.innerHeight - 60 + "px";
  if(slider.style.left == "0px") {
    slider.style.left = "-250px";
  }
  else {
    slider.style.left = "0px";
  }
}

function changeRange(valor){
  console.log(valor);
}

function adicionaVariavel(tipo){
  switch(tipo){
    case 1:
      editor.insert("inteiro nomevariavel = 0\n");
      break;
    case 2:
      editor.insert("caracter nomevariavel = 0\n");
      break;
    case 3: 
      editor.insert("palavra nomevariavel = 0\n");
      break;
  }

  slidetoggle();
}

function adicionaPara(){
  editor.insert("inteiro x = 0\npara x de 0 ate 10 faca\n\nfimpara ");
  slidetoggle();
}

function adicionaEnquanto(){
  editor.insert("enquanto(variavel < 10) faca \n\nfimenquanto");
  slidetoggle();  
}

function adicionaSe(){
  editor.insert("se (variavel < 10) entao \n\nfimse");
  slidetoggle();  
}

function adicionaImprime(tipo){
  switch(tipo){
    case 1:
      editor.insert("imprime(\"Digite a frase aqui\")");
      break;
    case 2:
      editor.insert("imprime(nomedavariavel)");

      break;
    case 3: 
       editor.insert("imprime(\"Digite a frase aqui\", nomedavariavel)");
      break;
  }
  slidetoggle();  
}

