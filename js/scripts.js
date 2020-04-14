function criar_request() {
    try{
        request = new XMLHttpRequest();        
    }catch (IEAtual){
         
        try{
            request = new ActiveXObject("Msxml2.XMLHTTP");       
        }catch(IEAntigo){
         
            try{
                request = new ActiveXObject("Microsoft.XMLHTTP");          
            }catch(falha){
                request = false;
            }
        }
    }
    if (!request){
        alert("Seu navegador não suporta Ajax!");
    }else{
        return request;
    }
}

$(document).ready(function () { 
    var cpf = $("#cpf")
    cpf.mask('000.000.000-00', {reverse: true})

    var celular = $("#celular")		        
    celular.mask('00 0 0000-0000',{reverse: true})

    var cpf = $("#cnpj")
    cpf.mask('00.000.000/0000-00', {reverse: true})

    var telefone = $("#telefone")		        
    telefone.mask('00 0000-0000',{reverse: true})

    var preco = $("#preco")
    preco.mask('000,00', {reverse: true})

    $(function(){
		$('#estado').change(function(){
			if( $(this).val() ) {
				$('.carregando').show();
				var result = document.getElementById("cidade");

				var xmlreq = criar_request();
				xmlreq.open("GET", "ajax_city.php?cod_estado=" + $(this).val(), true);
		        xmlreq.onreadystatechange = function(){
		            if (xmlreq.readyState == 4) {
		                if (xmlreq.status == 200) {
		                    result.innerHTML = xmlreq.responseText;
							$('.carregando').hide()
		                }else{
		                    result.innerHTML = "Erro: " + xmlreq.statusText;
		                }
		            }
		        };
		        xmlreq.send(null);
			}
		});
	});

});

function exibir_menu() {
    var x = document.getElementById("myTopnav");
    if (x.className === "topnav") {
        x.className += " responsive";
    }else{
        x.className = "topnav";
    }
}

var inputs = $('input').on('keyup', verificar_inputs);
function verificar_inputs() {
    const preenchidos = inputs.get().every(({value}) => value)
    $('button').prop('disabled', !preenchidos);
}

function validar_cpf() {
    var cpf   = document.getElementById("cpf").value;
    var result = document.getElementById("erro");
    var xmlreq = criar_request();
    
    if($("#cpf").val().length >= 10){
        xmlreq.open("GET", "validate_cpf.php?cpf=" + cpf, true);
        xmlreq.onreadystatechange = function(){
              
            if (xmlreq.readyState == 4) {
                if (xmlreq.status == 200) {
                    result.innerHTML = xmlreq.responseText;
                }else{
                    result.innerHTML = "Erro: " + xmlreq.statusText;
                }
            }
        };
        xmlreq.send(null);
    }
}

function validar_cnpj() {
    var cnpj   = document.getElementById("cnpj").value;
    var result = document.getElementById("erro");
    var xmlreq = criar_request();
    
    if($("#cnpj").val().length >= 10){
        xmlreq.open("GET", "validate_cnpj.php?cnpj=" + cnpj, true);
        xmlreq.onreadystatechange = function(){
              
            if (xmlreq.readyState == 4) {
                if (xmlreq.status == 200) {
                    result.innerHTML = xmlreq.responseText;
                }else{
                    result.innerHTML = "Erro: " + xmlreq.statusText;
                }
            }
        };
        xmlreq.send(null);
    }
}

function validar_senha(){
    var senha = $("#senha").val()
    var confirmar_senha = $("#confirmar_senha").val()
    var erro = $("#erro")
    
    if(confirmar_senha != senha){
        erro.html('<div style="color: #721c24; background-color: #f8d7da; border-color: #f5c6cb; border-radius: 5px; padding: 10px;">As senhas precisam ser iguais!</div><br />');
    }else{
        erro.html('');
    }
}