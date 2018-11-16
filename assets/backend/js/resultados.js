//ACABAR A PARTE DAS VARIAVEIS... MUDANÇA DE VALOR.

function limpaVariaveis(variaveis){
	variaveis.innerHTML="";
}
function limpaResultado(resultado){
	resultado.innerHTML="";
}
function liberaRange(range){
	range.style.display="block";
}
function bloqueiaRange(range){
	range.style.display="none";
}
function alteraValoresRange(range, sequencia){
	range.setAttribute("min", 1);
	range.setAttribute("max", +sequencia.linhas.length);
}



function mostraVariaveiseResultadosFinal(variaveis, resultados, erros, sequencia){
	range = document.getElementById("range");
	bloqueiaRange(range);
	//DESLIZA = INPUT RANGE
	//RANGE = DIV QUE CONTEM O INPUT E O TEXTO COM O FLUXO
	if(erros.linha.length == 0){

		mostraVariaveis(variaveis, sequencia.linhas.length);
		mostraResultado(resultados, sequencia.linhas.length);
		
		
		//colocar o rage no ultimo step !
		desliza = document.getElementById("desliza");
		alteraValoresRange(desliza, sequencia);
		liberaRange(range);
		desliza.value = sequencia.linhas.length;
		editor.gotoLine(sequencia.linhas[sequencia.linhas.length-1] +1);
		//document.getElementById("valordesliza").innerHTML = sequencia.linhas[sequencia.linhas.length-1]+1;
	}else{
		document.getElementById("campovariaveis").innerHTML= "";
		//MOSTRA ERRO
		bloqueiaRange(range);
		mostraErro(erros);
		// console.log("Linha " + erros.linha[0] + ": " + erros.msg[0]);
	}
}

function mostraVariaveiseResultadosSelecionado(variaveis,resultados, fluxo){
	mostraVariaveis(variaveis, fluxo);
	mostraResultado(resultados, fluxo);

	editor.gotoLine(sequencia.linhas[fluxo-1]+1);

}



function mostraVariaveis(variaveis, fluxo){
	//FLUXO é a posição do numero selecionado no array linhas de sequencia.
	campoVariaveis = document.getElementById("campovariaveis");
	limpaVariaveis(campoVariaveis);
	var valor=false
	for(x in variaveis){
		for(var y = 0; variaveis[x].fluxo[y] <= fluxo;y++){
			valor = variaveis[x].valores[y];
		}
		if(valor!== false) campoVariaveis.innerHTML += "<p>"+variaveis[x].nome+" = "+valor+"</p>"; 
		valor=false;
	}
}

function mostraResultado(resultados, fluxo){
	campoResultados = document.getElementById("camporesultado");
	limpaResultado(campoResultados);
	for(var x = 0;resultados.fluxo[x] <= fluxo;x++){
		campoResultados.innerHTML += "<p>"+resultados.textos[x]+"</p>"; 
	}
}

function mostraErro(erro){
	campoResultados = document.getElementById("camporesultado");
	limpaResultado(campoResultados);
	marcador = editor.session.addMarker(new Range((erro.linha[0]-1), 0, (erro.linha[0]-1), 1), "linhaerro", "fullLine");
	campoResultados.innerHTML += "<p>ERRO!! <br>LINHA "+ erro.linha[0] +": " + erro.msg[0] +"</p>"; 
	
}