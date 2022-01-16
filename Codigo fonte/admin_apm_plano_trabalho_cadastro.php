<?php

include("session.php");

function MyAutoload($className) {    
    $extension =  spl_autoload_extensions();
    require_once (__DIR__ . '/classes/' . $className . $extension);
}

spl_autoload_extensions('.php');
spl_autoload_register('MyAutoload');

	//Pega o ano atual
date_default_timezone_set('America/Sao_Paulo');
$date = date('Y'); 

$apm_ano = new ApmAno();

$apm =$apm_ano->findLast();

if( ($apm) and ($apm->aa_ano != $date) )
{
	
	die(header('location:admin_apm.php'));
	
}

   
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

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
<title>APM - Cadastro de plano de trabalho</title>


</head>
<body>



<?php 
include("admin_menu.php");/*inclusao do menu do site*/
?>


<main class="etec-admin-pag-padrao">
 <div class="etec-admin-pad-barlateral">
   <div class="etec-admin-pad-bar-info"><h1>Cadastro de plano de trabalho</h1></div>
   <div class="etec-admin-pad-bar-info"><i>Informativo:</i> Nesta página é possivel realizar o cadastro de um novo plano de trabalho da APM. Logo abaixo desta mensagem há a seguinte opção:
   
    <p><strong>"Voltar"</strong> Botão que irá redireciona-lo de volta à página de plano de trabalho da APM; </p>
   </div>
   <div class="etec-admin-pad-bar-info"><i>Resumo dos campos</i> Logo abaixo poderá ser visto um resumo de cada campo do formulário.
    <p><strong>Descrição</strong> Aceita até 200 caracteres;</p>
   
    </div>
    
<form action="admin_apm_plano_trabalho.php" method="post" class="eve-admin-form" >
   <input type="submit" name="voltar" class="btn" id="ApmVoltar"/>
   <input type="hidden" name="idApm" value="<?php echo $apm->aa_id; ?>" />
   <div class="etec-admin-pad-bar-iten etec-admin-pad-bar-iten-btn " >
   <label for='ApmVoltar'>Voltar</label>
   </div>
</form>

 </div>
 <div class="etec-admin-pad-conteudo">
 
<fieldset>        	  	  
	<form action="admin_apm_plano_trabalho.php" method="post" >
  
  
		<div class="etec-admin-pad-forms">
   	
            <div class="etec-admin-pad-forms-element">
       			<textarea name="descricao"  placeholder="Descrição do Plano de Trabalho." maxlength="200" id="apm_plano_trabalho" ></textarea>
  			</div>

			<div class="button etec-admin-pad-forms-enviar">
            	<input name="cadastrar" type="button" value="Finalizar" />
            </div>
			
            <input name="idApm" type="hidden" value="<?php echo $apm->aa_id; ?>" />
            
        </div>
	
    </form>
</fieldset>
  
 
  </div>
 </div>
</main>

<script src="js/admin_apm_plano_trabalho.js"></script>
</body>
</html>