<?php

include("session.php");

function MyAutoload($className) {    
	$extension =  spl_autoload_extensions();
	require_once (__DIR__ . '/classes/' . $className . $extension);
}

spl_autoload_extensions('.php');
spl_autoload_register('MyAutoload');

$DocumentosAno = new DocumentosAno(); 
$DocumentosCoordenacao = new DocumentosCoordenacao();

	//Pega o ano atual
date_default_timezone_set('America/Sao_Paulo');
$date = date('Y'); 

  	//Verica qual foi o ultimo coordenacao
$coordenacao = $DocumentosAno->find('');

if((!$coordenacao)or($coordenacao->doc_ano != $date)){

	die(header('location:admin_coordenacao.php'));
	
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
                    
<title>Cadastrar documento</title>

</head>
<body>



<?php 

include("admin_menu.php");/*inclusao do menu do site*/

?> 

<main class="etec-admin-pag-padrao">
 <div class="etec-admin-pad-barlateral">
   <div class="etec-admin-pad-bar-info"><h1>Cadastro de um documento</h1></div>
   <div class="etec-admin-pad-bar-info"><i>Informativo:</i> Nesta página é possivel realizar o cadastro de um determinado.</div>
  
   <a href="admin_documentos_plano_cursos.php" ><div class="etec-admin-pad-bar-iten etec-admin-pad-bar-iten-btn " >
   Voltar
   </div></a>
 </div>
 <div class="etec-admin-pad-conteudo">
 
<fieldset>        	  	  
 <form action="admin_documentos_plano_cursos.php" method="post" enctype="multipart/form-data">
  <div class="etec-admin-pad-forms">
  
    <div class="etec-admin-pad-forms-info ">
  <p>Curso: </p>
  
       <input name="curso" type="text" class="input" id="plano_curso"/>
  </div>
  
   <div  class="etec-admin-pad-forms-enviar-img-btn">

     <label for='selecao-arquivo'>Selecionar um Arquivo</label>
     <input  name="documento" type="file" accept="application/pdf application/msword application/msexcel" id="selecao-arquivo"  />

   </div>  

<div class="button etec-admin-pad-forms-enviar"><input name="cadastrar" type="button" value="Finalizar" /></div>
</div>
</form>
</fieldset>
  
 
  </div>
 </div>
</main>

<script src="js/admin_plano_cursos.js"></script>
</body>
</html>