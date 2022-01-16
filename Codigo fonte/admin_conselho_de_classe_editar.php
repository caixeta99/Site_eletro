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
$ano = date('Y'); 
$mes = date('n');

if($mes >= 7)
{
	
	$semestre = '1º Semestre';
	
}
else
{

	$semestre = '2º Semestre';
	$ano -= 1;
	
}
  
$conselhoclassesemestre = new ConselhoClasseSemestre();
$conselhoclasse = new ConselhoClasse();

if( (isset($_POST['editar'])) and (isset($_POST['id'])) )
{
	
	$conselho = $conselhoclassesemestre->findLast();
	$conselho_escolhido = $conselhoclasse->find($_POST['id']) ;
	
	if( ($conselho == false) or ($conselho->ccs_id != $conselho_escolhido->cc_conselho) or ($conselho->ccs_ano != $ano) or ($conselho->ccs_semestre != $semestre) )
	{
	
		die(header('location:admin_conselho_de_classe_semestre.php'));
		
	}
	
}
else
{
	
	die(header('location:admin_conselho_de_classe_semestre.php'));
	
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
<title>Conselho de Classe - Edição de arquivo</title>


</head>
<body>



<?php 
include("admin_menu.php");/*inclusao do menu do site*/
?>


<main class="etec-admin-pag-padrao">
 <div class="etec-admin-pad-barlateral">
   <div class="etec-admin-pad-bar-info"><h1>Edição de arquivo</h1></div>
   <div class="etec-admin-pad-bar-info"><i>Informativo:</i> Nesta página é possivel realizar a edição de um arquivo do conselho de classe. Logo abaixo desta mensagem há a seguinte opção:
   
    <p><strong>"Voltar"</strong> Botão que irá redireciona-lo de volta à página de membros da APM; </p>
   </div>
   <div class="etec-admin-pad-bar-info"><i>Resumo dos campos</i> Logo abaixo poderá ser visto um resumo de cada campo do formulário.
    <p><strong>Periodo</strong> Indica o grupo ao qual pertence o arquivo;</p>
    <p><strong>Turma</strong> Aceita até 50 caracteres;</p>
    <p><strong>Documento</strong> Campo paraselecionar o arquivo;</p>
   
    </div>
    
    
<form action="admin_conselho_de_classe.php" method="post" class="eve-admin-form" >
   <input type="submit" name="voltar" class="btn" id="ApmVoltar"/>
   <input type="hidden" name="idCC" value="<?php echo $conselho->ccs_id; ?>" />
   <div class="etec-admin-pad-bar-iten etec-admin-pad-bar-iten-btn " >
   <label for='ApmVoltar'>Voltar</label>
   </div>
</form>

 </div>
 <div class="etec-admin-pad-conteudo">
 
<fieldset>        	  	  
	<form action="admin_conselho_de_classe.php" method="post" enctype="multipart/form-data">
  
  
		<div class="etec-admin-pad-forms">
   	
   			<div class="etec-admin-pad-forms-element">
   				<p>Périodo </p>
                <select name="periodo" class="" id="conselho_classe_periodo">
                    <option value="Ensino médio" <?php if($conselho_escolhido->cc_periodo == 'Ensino médio'){ echo 'selected="selected"'; } ?>>Ensino médio</option>
                    <option value="Ensino integrado" <?php if($conselho_escolhido->cc_periodo == 'Ensino integrado'){ echo 'selected="selected"'; } ?>>Ensino integrado</option>
                    <option value="Ensino integrado - Novotec" <?php if($conselho_escolhido->cc_periodo == 'Ensino integrado - Novotec'){ echo 'selected="selected"'; } ?>>Ensino integrado - Novotec</option>
                    <option value="Ensino técnico" <?php if($conselho_escolhido->cc_periodo == 'Ensino técnico'){ echo 'selected="selected"'; } ?>>Ensino técnico</option>
                </select>
  			</div>
			
            <div class="etec-admin-pad-forms-element">
   				<input name="turma" type="text" class="input" maxlength="50" id="conselho_classe_turma" placeholder="Turma." value="<?php echo $conselho_escolhido->cc_turma; ?>"/>
  			</div>

            <div  class="etec-admin-pad-forms-enviar-img-btn">
            
            	<label for='selecao-arquivo'>Selecionar um Arquivo</label>
            	<input  name="documento" type="file" accept="application/pdf application/msword application/msexcel" id="selecao-arquivo"  />
            
            </div>  
            
            <div class="button etec-admin-pad-forms-enviar">
            	<input name="editar" type="button" value="Finalizar" />
            </div>
			
            <input name="idCC" type="hidden" value="<?php echo $conselho_escolhido->cc_conselho; ?>"/>
            <input name="id" type="hidden" value="<?php echo $conselho_escolhido->cc_id; ?>" />
            
        </div>
			
    </form>
</fieldset>
  
 
  </div>
 </div>
</main>

<script src="js/admin_conselho_classe.js"></script>
</body>
</html>