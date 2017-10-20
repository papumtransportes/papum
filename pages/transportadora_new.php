<?php
	require_once("../classes/lang_pt.php");

?>	

<!--Importacoes-->
<script type="text/javascript" src="../css/style.css"></script>
<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="../css/font-awesome.css">
<link rel='stylesheet' id='camera-css'  href='../css/camera.css' type='text/css' media='all'>
<link rel="stylesheet" type="text/css" href="../css/slicknav.css">
<link rel="stylesheet" href="../css/prettyPhoto.css" type="text/css" media="screen" title="prettyPhoto main stylesheet" charset="utf-8" />
<link rel="stylesheet" type="text/css" href="../css/style.css">		
		
<script type="text/javascript" src="../js/jquery.min.js"></script>
<link href='http://fonts.googleapis.com/css?family=Roboto:400,300,700|Open+Sans:700' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="../js/jquery.mobile.customized.min.js"></script>
<script type="text/javascript" src="../js/jquery.easing.1.3.js"></script> 
<script type="text/javascript" src="../js/camera.min.js"></script>
<script type="text/javascript" src="../js/myscript.js"></script>
<script src="../js/sorting.js" type="text/javascript"></script>
<script src="../js/jquery.isotope.js" type="text/javascript"></script>

<script type="text/javascript" src="../js/jquery-1.6.1.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<script type='text/javascript' src='cep.js'></script>
<!--Fim Importacoes-->

<script type="text/javascript">
function FormataCnpj(campo, teclapres)
			{
				var tecla = teclapres.keyCode;
				var vr = new String(campo.value);	
				vr = vr.replace(".", "");
				vr = vr.replace("/", "");
				vr = vr.replace("-", "");
				tam = vr.length + 1;
				if (tecla != 14)
				{
					if (tam == 3)
						campo.value = vr.substr(0, 2) + '.';
					if (tam == 6)
						campo.value = vr.substr(0, 2) + '.' + vr.substr(2, 5) + '.';
					if (tam == 10)
						campo.value = vr.substr(0, 2) + '.' + vr.substr(2, 3) + '.' + vr.substr(6, 3) + '/';
					if (tam == 15)
						campo.value = vr.substr(0, 2) + '.' + vr.substr(2, 3) + '.' + vr.substr(6, 3) + '/' + vr.substr(9, 4) + '-' + vr.substr(13, 2);
				}
			}



function validarCNPJ(cnpj) {
 
    cnpj = cnpj.replace(/[^\d]+/g,'');
 
    if(cnpj == '') return false;
     
    if (cnpj.length != 14)
        return false;
 
    // Elimina CNPJs invalidos conhecidos
    if (cnpj == "00000000000000" || 
        cnpj == "11111111111111" || 
        cnpj == "22222222222222" || 
        cnpj == "33333333333333" || 
        cnpj == "44444444444444" || 
        cnpj == "55555555555555" || 
        cnpj == "66666666666666" || 
        cnpj == "77777777777777" || 
        cnpj == "88888888888888" || 
        cnpj == "99999999999999")
        
		{
				alert('CNPJ invalido: ' + cnpj);

                $('#cnpj').val('');
                $('#cnpj').focus();
				}
		//return false;
         
    // Valida DVs
    tamanho = cnpj.length - 2
    numeros = cnpj.substring(0,tamanho);
    digitos = cnpj.substring(tamanho);
    soma = 0;
    pos = tamanho - 7;
    for (i = tamanho; i >= 1; i--) {
      soma += numeros.charAt(tamanho - i) * pos--;
      if (pos < 2)
            pos = 9;
    }
    resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
    if (resultado != digitos.charAt(0))
        //return false;
		{
				alert('CNPJ invalido: ' + cnpj);

                $('#cnpj').val('');
                $('#cnpj').focus();
				}
         
    tamanho = tamanho + 1;
    numeros = cnpj.substring(0,tamanho);
    soma = 0;
    pos = tamanho - 7;
    for (i = tamanho; i >= 1; i--) {
      soma += numeros.charAt(tamanho - i) * pos--;
      if (pos < 2)
            pos = 9;
    }
    resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
    if (resultado != digitos.charAt(1))
        //  return false;
	
	{
				alert('CNPJ invalido: ' + cnpj);

                $('#cnpj').val('');
                $('#cnpj').focus();
				}
           
    return true;
    
}

function SomenteNumero(e){
	    var tecla=(window.event)?event.keyCode:e.which;   
	    if((tecla>47 && tecla<58)) return true;
	    else{
    		if (tecla==8 || tecla==0) return true;
		else  return false;
    		}
	}

	function formatar(mascara, documento){
		 var i = documento.value.length;
		 var saida = mascara.substring(0,1);
		 var texto = mascara.substring(i)
		  
		  if (texto.substring(0,1) != saida){
					documento.value += texto.substring(0,1);
		  }
	}

//FUNCAO CEP INICIO 
$(document).ready( function() {
   /* Executa a requisição quando o campo CEP perder o foco */
   $('#cep').blur(function(){
           /* Configura a requisição AJAX */
           $.ajax({
                url : '../js/consultar_cep.php', /* URL que será chamada */ 
                type : 'POST', /* Tipo da requisição */ 
                data: 'cep=' + $('#cep').val(), /* dado que será enviado via POST */
                dataType: 'json', /* Tipo de transmissão */
                success: function(data){
                    if(data.sucesso == 1){
                        $('#rua').val(data.rua);
                        $('#bairro').val(data.bairro);
                        $('#cidade').val(data.cidade);
                        $('#estado').val(data.estado);
 
                        $('#numero').focus();
                    }
                }
           });   
   return false;    
   })
});
//FUNCAO CEP FIM

</script>



<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script type="text/javascript" src="../css/style.css"></script>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="../css/font-awesome.css">
		<link rel='stylesheet' id='camera-css'  href='../css/camera.css' type='text/css' media='all'>
		<link rel="stylesheet" type="text/css" href="../css/slicknav.css">
		<link rel="stylesheet" href="../css/prettyPhoto.css" type="text/css" media="screen" title="prettyPhoto main stylesheet" charset="utf-8" />
		<link rel="stylesheet" type="text/css" href="../css/style.css">		
		
		<script type="text/javascript" src="../js/jquery.min.js"></script>

		<link href='http://fonts.googleapis.com/css?family=Roboto:400,300,700|Open+Sans:700' rel='stylesheet' type='text/css'>
		<script type="text/javascript" src="../js/jquery.mobile.customized.min.js"></script>
		<script type="text/javascript" src="../js/jquery.easing.1.3.js"></script> 
		<script type="text/javascript" src="../js/camera.min.js"></script>
		<script type="text/javascript" src="../js/myscript.js"></script>
		<script src="../js/sorting.js" type="text/javascript"></script>
		<script src="../js/jquery.isotope.js" type="text/javascript"></script>

		<script type="text/javascript" src="../js/jquery-1.6.1.js"></script>
<hr/>
<form action='' id='transportadora' method='get' enctype='multipart/form-data'>
	<div class='container'>
		<div class='row'>
			<div class='col-md-12'>
				<h2><?php echo $langCadastroTransportadora; ?></h2>
			</div>
			<div class='col-md-12'>
				<label><?php echo $langNome; ?></label>
				<input type='text' id='firstname' name='firstname' class='form-control' placeholder='Digite seu Nome' required='required'/><br>
			</div>
			<div class='col-md-12'>
				<label><?php echo $langSobrenome; ?></label>
				<input type='text' id='lastname' name='lastname' class='form-control' placeholder='Digite seu Sobrenome' required='required'/><br>
			</div>
			<div class='col-md-12'>
				<label><?php echo $langCNPJ; ?></label>
				<input type='text' name='cnpj' id='cnpj'  maxlength='18' OnKeyPress='return SomenteNumero(this, event)' Onkeyup="FormataCnpj(this,event)" Onblur="validarCNPJ(this.value)" class='form-control' placeholder='Digite seu CNPJ' required="required"/><br>
			</div>
			<div class='col-md-12'>
				<label><?php echo $langEmail; ?></label>
				<input type='email' id='email' name='email' class='form-control' placeholder='Digite seu E-mail' required='required'/><br>
			</div>
			<div class='col-md-12'>
				<label><?php echo $langTelefone; ?></label>
				<input type='text' id='telefone' name='telefone' onKeyDown='formatar("## ####-####", this)' maxlength='12' OnKeyPress='return SomenteNumero(this, event)'  class='form-control' placeholder='Digite seu Telefone' required='required'/><br>
			</div>
			<div class='col-md-12'>
				<label><?php echo $langCelular; ?></label>
				<input type='text' name='celular' id='celular' onKeyDown='formatar("## #####-####", this)' maxlength='13' OnKeyPress='return SomenteNumero(this, event)' class='form-control' placeholder='Digite seu Celular' required="required"/><br>
			</div>
			
			<!--NOVO BUSCA O ENDERECO PELO NUMERO DO CEP -->
			<div class='col-md-12'>
				<label><?php echo $langCEP; ?></label>
				<input type='text' name='cep' id='cep' class='form-control' placeholder='<?php echo $langErrorCEP; ?>' required="required"/><br>
				<?php echo $langNaoSabeCEP; ?>? <a href="http://www.buscacep.correios.com.br/sistemas/buscacep/buscaCepEndereco.cfm"><?php echo $langCliqueAqui; ?></a>
			</div>
			
			<div class='col-md-12'>
				<label><?php echo $langRua; ?></label>
				<input type='text' name='rua' id='rua' class='form-control'  required="required"/><br>
			</div>
			
 
            <div class='col-md-12'>
				<label><?php echo $langNumero; ?></label>
				<input type='text' name='numero' id='numero' class='form-control' placeholder='<?php echo $langErrorNum; ?>'  required="required"/><br>
				
			</div>
             
			 <div class='col-md-12'>
				<label><?php echo $langBairro; ?></label>
				<input type='text' name='bairro' id='bairro' class='form-control' required="required"/><br>
			</div>       
			
			<div class='col-md-12'>
				<label><?php echo $langCidade; ?></label>
				<input type='text' name='cidade' id='cidade' class='form-control' required="required"/><br>
			</div>  
          
			<div class='col-md-12'>
				<label><?php echo $langEstado; ?></label>
				<input type='text' name='estado' id='estado' class='form-control' required="required"/><br>
			</div> 

			<div class='col-md-12'>
				<label><?php echo $langSenha; ?></label>
				<input type='password' name='password' id='password' class='form-control' placeholder='Digite sua Senha' required="required"/><br>
			</div>
			<div class='col-md-12'>
				<label><?php echo $langConfirmarSenha; ?></label>
				<input type='password' name='confpass' id='confpass' class='form-control' placeholder='Confirme sua Senha' required="required"/><br>
			</div>
			<!--FIM DA BUSCA POR CEP-->         


			<div class='col-md-12'>
				<div class="g-recaptcha" data-sitekey="Le2FzIUAAAAAHHOBzmLeIr-PgsJJi89mT5nNqf7"></div>
			</div>
			<div class='col-md-12'>
				<input type='submit' class='btn btn-default' value='Cadastrar'/>
				<a href='register'><?php echo $langVoltar; ?></a>
			</div>
		</div>
	</div>	
</form>
<hr/>