<?php

include("session.php"); 

function MyAutoload($className) {    
    $extension =  spl_autoload_extensions();
    require_once (__DIR__ . '/classes/' . $className . $extension);
}

spl_autoload_extensions('.php');
spl_autoload_register('MyAutoload');
  
$ProgramasRelacionados = new ProgramasRelacionados();

   //realiza a busca das informações
$resultado = $ProgramasRelacionados->findCount();

if(!($resultado)){

	die("Falha na consulta");

}

if($resultado->qtd >= 3){

	die(header('location:admin_programas_relacionados.php'));
		
}
   
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
                                  
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
<title>Cadatro de Programa relacionado</title>

</head>
<body>



<?php 

include("admin_menu.php");/*inclusao do menu do site*/

?>  

<main class="etec-admin-pag-padrao">
 <div class="etec-admin-pad-barlateral">
   <div class="etec-admin-pad-bar-info"><h1>Cadastro de um Programa relacionado</h1></div>
   <div class="etec-admin-pad-bar-info"><i>Informativo:</i> Nesta página é possivel realizar o cadastro de um novo curso. Logo abaixo desta mensagem há a seguinte opção:
   
    <p><strong>"Voltar"</strong> Botão que irá redireciona-lo de volta à página de programas relacionados; </p>
   </div>
   
    <div class="etec-admin-pad-bar-info"><i>Resumo dos campos</i> Logo abaixo poderá ser visto um resumo de cada campo do formulário.
    <p><strong>Título do Programa</strong> Aceita até 100 caracteres</p>
    <p><strong>link do Programa</strong> Aceita até 200 caracteres</p>
    <p><strong>Descrição  do Programa</strong> Aceita até 500 caracteres</p>
    
   
   
    </div>
    
   <a href="admin_programas_relacionados.php" ><div class="etec-admin-pad-bar-iten etec-admin-pad-bar-iten-btn " >
     Voltar
   </div></a>
 </div>
 <div class="etec-admin-pad-conteudo">
 
<fieldset>        	  	  
 <form action="admin_programas_relacionados.php" method="post"  enctype="multipart/form-data">
  <div class="etec-admin-pad-forms">
  <div class="etec-admin-pad-forms-element">  
   <input name="titulo" type="text" class="input" maxlength="100" id="programa_titulo" placeholder="Título do programa."/>
  </div><!--fechmaneto da class"etec-admin-pad-forms-element"--> 
  <div class="etec-admin-pad-forms-element">  
  <input name="link" type="text" class="input" maxlength="200" id="programa_link" placeholder="link do programa."/>
  </div><!--fechmaneto da class"etec-admin-pad-forms-element"--> 
  <div class="etec-admin-pad-forms-element">  
   <textarea name="descricao" class="text-area" id="programa_descricao" placeholder="Descrição do programa." maxlength="500" ></textarea>
  </div><!--fechmaneto da class"etec-admin-pad-forms-element"-->  
   <div  class="etec-admin-pad-forms-enviar-img-btn">

   <label for='selecao-arquivo'>Selecionar uma imagem</label>
   <input  name="imagem" type="file" id="selecao-arquivo" accept="image/png, image/jpeg"/> 
   </div> 
 

<div class="button etec-admin-pad-forms-enviar" id="cadastrar"><input name="cadastrar" type="button" value="Finalizar" /></div>
</div>
</form>
</fieldset>
  
  
<script src="js/admin_programas_relacionados.js"></script>
  </div>
 </div>
</main>







 