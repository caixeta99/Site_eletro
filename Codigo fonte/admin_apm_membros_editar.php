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
$apm_ano_membro = new ApmMembro();

$apm =$apm_ano->findLast();

if( (isset($_POST['editar'])) and (isset($_POST['id'])) )
{
	
	$dados_membro = $apm_ano_membro->find($_POST['id']); 

	if( !( ($apm) and ($dados_membro) and ($apm->aa_ano == $date) and ($apm->aa_id == $dados_membro->am_ano) ) ){
		
		die(header('location:admin_apm.php'));
		
	}
	
}
else
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
<title>APM - Edição de Membro</title>


</head>
<body>



<?php 
include("admin_menu.php");/*inclusao do menu do site*/
?>


<main class="etec-admin-pag-padrao">
 <div class="etec-admin-pad-barlateral">
   <div class="etec-admin-pad-bar-info"><h1>Edição de membro</h1></div>
   <div class="etec-admin-pad-bar-info"><i>Informativo:</i> Nesta página é possivel realizar a edição de um membro da APM. Logo abaixo desta mensagem há a seguinte opção:
   
    <p><strong>"Voltar"</strong> Botão que irá redireciona-lo de volta à página de membros da APM; </p>
   </div>
   <div class="etec-admin-pad-bar-info"><i>Resumo dos campos</i> Logo abaixo poderá ser visto um resumo de cada campo do formulário.
    <p><strong>Nome</strong> Aceita até 100 caracteres;</p>
    <p><strong>Cargo</strong> Aceita até 100 caracteres;</p>
    <p><strong>RG</strong> Aceita até 30 caracteres;</p>
    
   
   
    </div>
    
<form action="admin_apm_membros.php" method="post" class="eve-admin-form" >
   <input type="submit" name="voltar" class="btn" id="ApmVoltar"/>
   <input type="hidden" name="idApm" value="<?php echo $dados_membro->am_ano; ?>" />
   <div class="etec-admin-pad-bar-iten etec-admin-pad-bar-iten-btn " >
   <label for='ApmVoltar'>Voltar</label>
   </div>
</form>

 </div>
 <div class="etec-admin-pad-conteudo">
 
<fieldset>        	  	  
	<form action="admin_apm_membros.php" method="post" >
  
  
		<div class="etec-admin-pad-forms">
   	
   			<div class="etec-admin-pad-forms-element">
   				<input name="nome" type="text" class="input" maxlength="100" id="membro_nome" placeholder="Nome do membro da APM." value="<?php echo $dados_membro->am_nome; ?>"/>
  			</div>
			
            <div class="etec-admin-pad-forms-element">
   				<input name="cargo" type="text" class="input" maxlength="100" id="membro_cargo" placeholder="Cargo do membro da APM." value="<?php echo $dados_membro->am_cargo; ?>"/>
  			</div>
            
            <div class="etec-admin-pad-forms-element">
   				<input name="rg" type="text" class="input" maxlength="30" id="membro_rg" placeholder="RG do membro da APM." value="<?php echo $dados_membro->am_rg; ?>"/>
  			</div>

			<div class="button etec-admin-pad-forms-enviar">
            	<input name="editar" type="button" value="Finalizar" />
            </div>
			
            <input name="idApm" type="hidden" value="<?php echo $dados_membro->am_ano; ?>" />
            <input name="id" type="hidden" value="<?php echo $dados_membro->am_id; ?>" />
     
        </div>
	
    </form>
</fieldset>
  
 
  </div>
 </div>
</main>

<script src="js/admin_apm_membro.js"></script>
</body>
</html>