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
$(function(){	
    //Executa a requisição quando o campo username perder o foco
    $('#cpf').blur(function()
    {
        var cpf = $('#cpf').val().replace(/[^0-9]/g, '').toString();
		 if( cpf.length != 11 ||
				cpf == "12345678910" ||
				cpf == "00000000000" || 
				cpf == "11111111111" || 
				cpf == "22222222222" || 
				cpf == "33333333333" || 
				cpf == "44444444444" || 
				cpf == "55555555555" || 
				cpf == "66666666666" || 
				cpf == "77777777777" || 
				cpf == "88888888888" || 
				cpf == "99999999999")
				{
				alert('CPF invalido: ' + cpf);

                $('#cpf').val('');
                $('#cpf').focus();
				}
        if( cpf.length == 11 )
        {
            var v = [];

            //Calcula o primeiro dígito de verificação.
            v[0] = 1 * cpf[0] + 2 * cpf[1] + 3 * cpf[2];
            v[0] += 4 * cpf[3] + 5 * cpf[4] + 6 * cpf[5];
            v[0] += 7 * cpf[6] + 8 * cpf[7] + 9 * cpf[8];
            v[0] = v[0] % 11;
            v[0] = v[0] % 10;

            //Calcula o segundo dígito de verificação.
            v[1] = 1 * cpf[1] + 2 * cpf[2] + 3 * cpf[3];
            v[1] += 4 * cpf[4] + 5 * cpf[5] + 6 * cpf[6];
            v[1] += 7 * cpf[7] + 8 * cpf[8] + 9 * v[0];
            v[1] = v[1] % 11;
            v[1] = v[1] % 10;

            //Retorna Verdadeiro se os dígitos de verificação são os esperados.
            if ( (v[0] != cpf[9]) || (v[1] != cpf[10]) )
            {
			
			alert('CPF inválido: ' + cpf);
                $('#cpf').val('');
                $('#cpf').focus();
            }
        }
        else
        {
            alert('CPF invalido:' + cpf);

            $('#cpf').val('');
            $('#cpf').focus();
        }
    });
});

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

//FUNCOES CEP INICIO 
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
//FUNCOES CEP FIM
</script>

<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<hr/>
<form action='' id='cliente' method='' enctype='multipart/form-data'>
	<div class='container'>
		<div class='row'>
			<div class='col-md-12'>
				<h2><?php echo $langCadastrodeCliente; ?></h2>
			</div>
			<div id="feedback" class='col-md-12'></div>
			<div class='col-md-12'>
				<label><?php echo $langNome; ?></label>
				<input type='text' name='firstname' id='firstname' class='form-control' placeholder='Digite seu Nome' required="required"/><br>
			</div>
			<div class='col-md-12'>
				<label><?php echo $langSobrenome; ?></label>
				<input type='text' name='lastname' id='lastname' class='form-control' placeholder='Digite seu Sobrenome' required="required"/><br>
			</div>
			<div class='col-md-12'>
				<label><?php echo $langCPF; ?></label>
				<input type='text' name='cpf' id='cpf'  maxlength='14' onKeyDown='formatar("###.###.###-##", this)'  OnKeyPress='return SomenteNumero(this, event)' class='form-control' placeholder='Digite seu CPF' required="required"/><br>
			</div>
			<div class='col-md-12'>
				<label><?php echo $langEmail; ?></label>
				<input type='email' id='email' name='email' class='form-control' placeholder='Digite seu E-mail' required='required'/><br>
			</div>
			<div class='col-md-12'>
				<label><?php echo $langTelefone; ?></label>
				<input type='text' name='telefone' id='telefone' onKeyDown='formatar("## ####-####", this)' maxlength='12' OnKeyPress='return SomenteNumero(this, event)' class='form-control' placeholder='Digite seu Telefone' required="required"/><br>
			</div>
			<div class='col-md-12'>
				<label><?php echo $langCelular; ?></label>
				<input type='text' name='celular' id='celular' maxlength='13' onKeyDown='formatar("## #####-####", this)'  OnKeyPress='return SomenteNumero(this, event)' class='form-control' placeholder='Digite seu Celular' required="required"/><br>
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
			<div class='col-md-6'>
				<label><?php echo $langCelular; ?></label>
				<input type='password' name='password' id='password' class='form-control' placeholder='Digite sua Senha' required="required"/><br>
			</div>
			<div class='col-md-6'>
				<label><?php echo $langConfirmarSenha; ?></label>
				<input type='password' name='confpass' id='confpass' class='form-control' placeholder='Confirme sua Senha' required="required"/><br>
			</div>
			<div class='col-md-12'>
				<div class="g-recaptcha" data-sitekey="Le2FzIUAAAAAHHOBzmLeIr-PgsJJi89mT5nNqf7"></div><br>
			</div>
			<div class='col-md-12'>
				<input type='submit' class='btn btn-default' value='Cadastrar'/>
				<a href='register'><?php echo $langVoltar; ?></a>
			</div>
		</div>
	</div>
</form>
<hr/>