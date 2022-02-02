/** * Fun��o para criar um objeto XMLHTTPRequest */
function CriaRequest(){
	try{ 
		request = new XMLHttpRequest(); 
	}
	catch (IEAtual){
		try{
			request = new ActiveXObject("Msxml2.XMLHTTP");
		}
		catch(IEAntigo){
			try{
				request = new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch(falha){
				request = false;
			}
		}
	}
	if (!request)
		alert("Seu navegador não suporta Ajax!");
	else return request;
}

//BUSCAR SERVIDORES
function getRequisitante(){
	var mat = document.getElementById("mat").value;
	var result = document.getElementById("RetornoRequisitante");
	var xmlreq = CriaRequest();
	
	// Exibi a imagem de progresso
	result.innerHTML = '<img src="../img/progressbar14.gif"/>';
	// Iniciar uma requisi��o
	xmlreq.open("GET", "../js/servidor.php?mat="+mat, true);
	
	xmlreq.onreadystatechange = function(){
		if (xmlreq.readyState == 4){ //alert(xmlreq.status);
			if (xmlreq.status == 200){ // 200 - o servidor retornou a p�gina com sucesso.
				result.innerHTML = xmlreq.responseText;				
			}
			else{
				result.innerHTML = "Erro: "+xmlreq.statusText;
			}
		}
	};
	xmlreq.send(null);
}

//BUSCAR EQUIPAMENTOS
function getEquipamento(){
	var prefixo = document.getElementById("prefixo").value;
	var result = document.getElementById("RetornoEquipamento");
	var xmlreq = CriaRequest();
	
	// Exibi a imagem de progresso
	result.innerHTML = '<img src="../img/progressbar14.gif"/>';
	// Iniciar uma requisição
	xmlreq.open("GET", "../js/equipamento.php?prefixo="+prefixo, true);
	
	xmlreq.onreadystatechange = function(){
		if (xmlreq.readyState == 4){ //alert(xmlreq.status);
			if (xmlreq.status == 200){ // 200 - o servidor retornou a p�gina com sucesso.
				result.innerHTML = xmlreq.responseText;				
			}
			else{
				result.innerHTML = "Erro: "+xmlreq.statusText;
			}
		}
	};
	xmlreq.send(null);
}

//BUSCAR SERVIDOR
function getServidor(){
	var mat = document.getElementById("mat").value;
	var result = document.getElementById("RetornoServidor");
	var xmlreq = CriaRequest();
	
	// Exibi a imagem de progresso
	result.innerHTML = '<img src="../img/progressbar14.gif"/>';
	// Iniciar uma requisição
	xmlreq.open("GET", "../js/servidor.php?mat="+mat, true);
	
	xmlreq.onreadystatechange = function(){
		if (xmlreq.readyState == 4){ //alert(xmlreq.status);
			if (xmlreq.status == 200){ // 200 - o servidor retornou a p�gina com sucesso.
				result.innerHTML = xmlreq.responseText;				
			}
			else{
				result.innerHTML = "Erro: "+xmlreq.statusText;
			}
		}
	};
	xmlreq.send(null);
}

//BUSCAR RESPONSAVEL
function getResponsavel(){
	var mat = document.getElementById("mat").value;
	var result = document.getElementById("RetornoResponsavel");
	var xmlreq = CriaRequest();
	
	// Exibi a imagem de progresso
	result.innerHTML = '<img src="../img/progressbar14.gif"/>';
	// Iniciar uma requisição
	xmlreq.open("GET", "../js/servidor.php?mat="+mat, true);
	
	xmlreq.onreadystatechange = function(){
		if (xmlreq.readyState == 4){ //alert(xmlreq.status);
			if (xmlreq.status == 200){ // 200 - o servidor retornou a p�gina com sucesso.
				result.innerHTML = xmlreq.responseText;				
			}
			else{
				result.innerHTML = "Erro: "+xmlreq.statusText;
			}
		}
	};
	xmlreq.send(null);
}
