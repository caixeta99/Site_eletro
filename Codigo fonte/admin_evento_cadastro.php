<?php

include("session.php"); 
   
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>

                                    <!-- meta tages da pagina -->
<meta charset="utf-8">
<meta http-equiv="Content-Language" content="pt-br">
<meta name="viewport" content="width=device-width,initial-scale=1"/>
<meta name="keywords" content="Escola Tecnica , escola tecnica , ensino medio integrado ao tecnico , ensino medio , Ensino medio , Mococa , mococa , Mococa/sp , Etec , ETEC , Ete , Etec mococa, Eletro mococa, Eletro , ELETRO , letro , vestibulinho, vestibular , Profissionalização, Profissionalizacao ,cps"/>
                                    
                                    <!--- Css padrao-->
<link rel="stylesheet" href="Css/Reset.css">
<link rel="stylesheet" href="Css/etec-style-adm.css">
<link rel="stylesheet" href="Css/etec-style-adm-responsible.css">
<link rel="stylesheet" href="Css/etec-style-fonts.css">
<link rel="stylesheet" href="Css/etec-style-navigation.css">
<link rel="stylesheet" href="Css/etec-style-navigation-responsible.css">
 
 <!--icone da pagina-->
<link rel="icon" href="Imagens/Imagens estaticas/Icones/icone-etec.png" />
                                   <!-- titulo da pagina -->
<title>Cadatro de Evento</title>

</head>
<body>



<?php 

include("admin_menu.php");/*inclusao do menu do site*/

?>  

<main class="etec-admin-pag-padrao">

	<div class="etec-admin-pad-barlateral">
  		<div class="etec-admin-pad-bar-info"><h1>Cadastro de Evento</h1></div>
   		<div class="etec-admin-pad-bar-info"><i>Informativo:</i> Nesta página é possivel realizar o cadastro de um novo evento. Logo abaixo desta mensagem há a seguinte opção:
   
    		<p><strong>"Voltar"</strong> Botão que irá redireciona-lo de volta à página de eventos; </p>
   		</div>
    
        <div class="etec-admin-pad-bar-info"><i>Resumo dos campos</i> logo abaixo poderá ser visto um resumo de cada campo do formulário:
            <p><strong>Título do Evento</strong> Aceita até 50 caracteres</p>
            <p><strong>Data</strong> Campo referente à primeira data que o evento será promovido</p>
            <p><strong>Sinopse do Evento</strong> Aceita até 500 caracteres</p>
            <p><strong>Descrição  do Evento</strong> Aceita até 1000 caracteres</p>
    	</div>
        
   		<div class="etec-admin-pad-bar-iten etec-admin-pad-bar-iten-btn " >
   			<a href="admin_evento.php" ><div class="">Voltar</div></a>
   		</div>
 	</div>
	
    <div class="etec-admin-pad-conteudo">
 
<fieldset>        	  	  
 <form action="admin_evento.php" method="post" >
  <div class="etec-admin-pad-forms">
  
   <div class="etec-admin-pad-forms-element">
   <input name="titulo" type="text" class="input" maxlength="50" id="evento_titulo" placeholder="Título do evento."/>
  </div>
  
  <div class="etec-admin-pad-forms-element">
   <input name="data" type="date" class="input"  id="evento_data" placeholder="Dia e mês do evento"/>
  </div>

  <div class="etec-admin-pad-forms-element">
   <textarea name="sinopse" class="text-area" id="evento_sinopse" placeholder="Sinopse do evento." maxlength="500" ></textarea>
  </div>
  
  
  <div class="etec-admin-pad-forms-element">
   <textarea name="descricao" class="text-area" id="evento_descricao" placeholder="Descrição do evento." maxlength="1000" ></textarea>
  </div>
  
  
  

<div class="button etec-admin-pad-forms-enviar"><input name="cadastrar" type="button" value="Finalizar" /></div>
</div>
</form>
</fieldset>
  
 
  </div>
 </div>
</main>

<script src="js/admin_eventos.js"></script>
</body>
</html>