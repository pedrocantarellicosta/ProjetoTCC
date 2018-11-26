function Variavel(nome,tipo, valor, fluxo){
	this.nome = nome;
	this.tipo = tipo;
	this.fluxo= [fluxo];
  this.valores = [valor];
	//this.linhas[numerolinha] = valor da variavel na linha

  this.setValor=function (valor, fluxo){
    this.fluxo.push(fluxo);
    this.valores.push(valor);
  }
}

function Resultado(){
  this.textos = [];
  this.fluxo = [];

  this.setResultado = function(texto, fluxo){
    this.fluxo.push(fluxo);
    this.textos.push(texto);
  }
}

function Fluxo(){
  this.linhas = [];

  this.setFluxo=function (linha){
    this.linhas.push(linha);
  }
}

function Erro(){
  this.linha = [];
  this.msg = [];

  this.setErro = function(linha, msg){
    this.linha.push(linha);
    this.msg.push(msg);
  }
}

function verificaExistenciaVariavel(variaveis, nomevariavel){
  for(var x = 0;x < variaveis.length; x++){
    if(variaveis[x].nome == nomevariavel){
     return x;
    }
  }
  return false;
}

function ehNumero(str) {
  var er = /^[0-9]+$/;
  return (er.test(str));
}

function verificaVariavel(textolinha, variaveis, linha, sequencia, erros){
  regexNumero = /^numero ([a-z]+)(?:=| = | =|= )([0-9]+)$/;
  regexPalavra = /^palavra ([a-z]+)(?:=| = | =|= )([a-zA-Z]+)$/;
  regexCaractere = /^caractere ([a-z]+)(?:=| = | =|= )([a-zA-Z])$/;  
  
  regexInicioNumero = /^numero/;
  regexInicioPalavra = /^palavra/;
  regexInicioCaractere = /^caractere/;
  
  var falha = true;
  var ehvariavel = false
  //ANTES DO PUSH VERIFICAR SE A VARIAVEL JA EXISTE.SE SIM, ERRO!

  if(regexInicioNumero.test(textolinha) == true ||regexInicioPalavra.test(textolinha) == true || 
    regexInicioCaractere.test(textolinha) == true){
    
    if(regexNumero.test(textolinha)){
      falha = false;  
      ehvariavel = true;
      nomevariavel = textolinha.replace(regexNumero, "$1"); 
      valorvariavel = textolinha.replace(regexNumero, "$2"); 
      tipo = "int";
    }
    if(regexPalavra.test(textolinha)){
      falha = false;  
      ehvariavel = true;
      nomevariavel = textolinha.replace(regexPalavra, "$1"); 
      valorvariavel = textolinha.replace(regexPalavra, "$2"); 
      tipo = "str";
    }
    if(regexCaractere.test(textolinha)){  
      falha = false;
      ehvariavel = true;
      nomevariavel = textolinha.replace(regexCaractere, "$1"); 
      valorvariavel = textolinha.replace(regexCaractere, "$2"); 
      tipo = "char";
        
    }
    console.log(ehvariavel);
    if(falha == true){
      erros.setErro((linha+1), "VALOR ATRIBUIDO A VARIÁVEL NAO CORRESPONDE AO TIPO");
      return;
    }else{
      if(ehvariavel){
        if(verificaExistenciaVariavel(variaveis, nomevariavel) !== false){
          erros.setErro((linha+1), "ERRO DUPLICIDADE VARIAVEL");
          return;
        }else{
          sequencia.setFluxo(linha);
          variaveis.push(new Variavel(nomevariavel,tipo, valorvariavel,sequencia.linhas.length)); 
        }
      }
    }
  } 
}

function mudaValorVariavel(textolinha, variaveis, linha, sequencia, erros){
  regexMudaValorVariavel = /^([a-z]+)(?:[ ]*=[ ]*)([a-zA-Z]+|[0-9]+)$/; // \w+ tb funciona
  regexStrIntChar = /^([a-zA-Z]+)|([0-9]+)$/; 
  regexStr = /^([a-zA-Z]+)$/;
  regexInt = /^([0-9]+)$/;
  regexChar = /^([a-zA-Z])$/;
  
  if(regexMudaValorVariavel.test(textolinha)){  
    nomevariavel = textolinha.replace(regexMudaValorVariavel, "$1"); 
    valorvariavel = textolinha.replace(regexMudaValorVariavel, "$2"); 
    posicaovariavel = verificaExistenciaVariavel(variaveis, nomevariavel);
    if(posicaovariavel  !== false){
      if(variaveis[posicaovariavel].tipo == "str"){
        if(regexStr.test(valorvariavel)){
          sequencia.setFluxo(linha);
          variaveis[posicaovariavel].setValor(valorvariavel, sequencia.linhas.length);
        }else{
          erros.setErro((linha+1), "VALOR NAO CORRESPONDE AO TIPO");
        }
      }
      if(variaveis[posicaovariavel].tipo == "int"){
        if(regexInt.test(valorvariavel)){
          sequencia.setFluxo(linha);
          variaveis[posicaovariavel].setValor(valorvariavel, sequencia.linhas.length);;
        }else{
          erros.setErro((linha+1), "VALOR NAO CORRESPONDE AO TIPO");
        }
      }
      if(variaveis[posicaovariavel].tipo == "char"){
        if(regexChar.test(valorvariavel)){
          sequencia.setFluxo(linha);
          variaveis[posicaovariavel].setValor(valorvariavel, sequencia.linhas.length);
        }else{
          erros.setErro((linha+1), "VALOR NAO CORRESPONDE AO TIPO");
        }
      }
    }else{
      erros.setErro((linha+1), "VARIAVEL NÃO EXISTE");
    }
  }
}
	
function verificaPara(textolinha){
  regexPara = /^(?:para)(?:[ ]+)([A-Za-z]+)(?:[ ]+)(?:de)(?:[ ]+)([0-9]+)(?:[ ]+)(?:ate)(?:[ ]+)([0-9]+)(?:[ ]+)(?:faca)$/;
  regexInicioPara = /^(?:para)/;
  if(regexInicioPara.test(textolinha) && regexPara.test(textolinha)){
    variavel = textolinha.replace(regexPara,"$1");
    condicaoum = textolinha.replace(regexPara,"$2");
    condicaodois = textolinha.replace(regexPara,"$3");
    var condicoes = [variavel, condicaoum, condicaodois];
    return condicoes;
  }else if(regexInicioPara.test(textolinha)){
    return true;
  } 
  return false;
}

function verificaFimPara(textolinha){
  regexFimPara = /^(?:fimpara)$/;
  if(regexFimPara.test(textolinha)) return true;
  else return false;
}

function verificaEnquanto(textolinha){
  regexEnquanto = /^(?:enquanto)(?:|[ ]+)[(](?:|[ ]+)([a-z]+)(?:|[ ]+)(<|>|<=|==|>=|!=)(?:|[ ]+)([a-z]+|[0-9]+)(?:|[ ]+)[)](?:[ ]+)(?:faca)$/;
  regexInicioEnquanto = /^(?:enquanto)/;
  
  if(regexInicioEnquanto.test(textolinha) && regexEnquanto.test(textolinha)){
    variavelum = textolinha.replace(regexEnquanto,"$1");
    condicao = textolinha.replace(regexEnquanto,"$2");
    variaveldois = textolinha.replace(regexEnquanto,"$3");
    var condicoesenquanto = [variavelum, condicao, variaveldois];
    return condicoesenquanto;
  }else if(regexInicioEnquanto.test(textolinha)){
    return true;
  }
   return false;
}

function verificaFimEnquanto(textolinha){
  regexFimEnquanto = /^(?:fimenquanto)$/;
  if(regexFimEnquanto.test(textolinha)) return true;
  else return false;
}

function verificaConta(textolinha){
  regexConta = /^([A-Za-z]+)(?:|[ ]+)(?:=)(?:|[ ]+)([0-9]+|[A-Za-z]+)(?:|[ ]+)([+]|[-]|[*]|[/])(?:|[ ]+)([0-9]+|[A-Za-z]+)$/

  if(regexConta.test(textolinha)){  
    varum = textolinha.replace(regexConta,"$1");
    vardois = textolinha.replace(regexConta,"$2");
    operacao = textolinha.replace(regexConta,"$3");
    vartres = textolinha.replace(regexConta,"$4");
    var op = [varum, vardois, operacao, vartres];
    return op;
  }else return false;
}

function verificaSe(textolinha){
  regexSe = /^(?:se)(?:|[ ]+)[(](?:|[ ]+)([a-z]+|[0-9]+)(?:|[ ]+)(<|>|<>|<=|=|>=|!=)(?:|[ ]+)([a-z]+|[0-9]+)(?:|[ ]+)[)](?:|[ ]+)(?:entao)$/;
  //regexInicioSe = /^(?:se)/;
  if(regexSe.test(textolinha)){  
    varum = textolinha.replace(regexSe,"$1");
    operacao = textolinha.replace(regexSe,"$2");
    vardois = textolinha.replace(regexSe,"$3");
    var op = [varum, operacao, vardois];
    return op;
  }
  return false;
}

function verificaFimSe(textolinha){
  regexFimSe = /^(?:fimse)$/;
  if(regexFimSe.test(textolinha)) return true;
  else return false;
}
function verificaSenao(textolinha){
  regexFimSe = /^(?:senao)$/;
  if(regexFimSe.test(textolinha)) return true;
  else return false;
}

function verificaImprime(textolinha, resultados, variaveis, linha, sequencia, erros){
  regexImprimeTexto=/^(?:imprime)(?:[ ]*\([ ]*\")([a-zA-Zà-ù0-9-_\.\-\+\*\\\=\!\@\#\$\%\&\*\(\)\s]*)(?:\"[ ]*\))$/;
  regexImprimeVariavel=/^(?:imprime)(?:[ ]*\([ ]*)([a-z]+)(?:[ ]*\))$/;
  regexImprimeTextoeVariavel=/^(?:imprime)(?:[ ]*\([ ]*\")([a-zA-Zà-ù0-9-_ \+\*\:\\\=\!\@\#\$\%\&\*\(\)\s]*)(?:\"\,[\s]*)([a-z]+)(?:[ ]*\))$/;
  
  if(regexImprimeTexto.test(textolinha)){
    texto = textolinha.replace(regexImprimeTexto, "$1");
    sequencia.setFluxo(linha);  
    resultados.setResultado(texto, sequencia.linhas.length);
    return true;
  }
  if(regexImprimeVariavel.test(textolinha)){
    variavel = textolinha.replace(regexImprimeVariavel, "$1");
    pos=verificaExistenciaVariavel(variaveis, variavel);
    if(pos!== false){
      texto = ""+variaveis[pos].valores[variaveis[pos].valores.length-1];
      sequencia.setFluxo(linha);  
      resultados.setResultado(texto, sequencia.linhas.length);
      return true;
    }else erros.setErro((linha+1), "VARIAVEL NÃO EXISTE");
  }
  if(regexImprimeTextoeVariavel.test(textolinha)){
    texto = textolinha.replace(regexImprimeTextoeVariavel, "$1");
    variavel = textolinha.replace(regexImprimeTextoeVariavel, "$2");
    pos=verificaExistenciaVariavel(variaveis, variavel);
    
    if(pos !== false){
      texto += ""+variaveis[pos].valores[variaveis[pos].valores.length-1];
      sequencia.setFluxo(linha); 
      resultados.setResultado(texto, sequencia.linhas.length); 
      return true;
    }else erros.setErro((linha+1), "VARIAVEL NÃO EXISTE");
    
  }
  return false;
}