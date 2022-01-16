<?php

include("session.php");
   
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
<title>Cadastro de Funcionário</title>

</head>
<body>



<?php 

include("admin_menu.php");/*inclusao do menu do site*/

?>

<main class="etec-admin-pag-padrao">
 <div class="etec-admin-pad-barlateral">
   <div class="etec-admin-pad-bar-info"><h1>Cadastro de Funcionário da Biblioteca</h1></div>
   <div class="etec-admin-pad-bar-info"><i>Informativo:</i>  Nesta página é possivel realizar o cadastro de um novo funcionário da biblioteca. Logo abaixo desta mensagem há a seguinte opção:
   
    <p><strong>"Voltar"</strong> Botão que irá redireciona-lo de volta à página biblioteca; </p>
   </div>
   <div class="etec-admin-pad-bar-info"><i>Resumo dos campos</i>Logo abaixo poderá ser visto um resumo de cada campo do formulário.
    <p><strong>Nome</strong> Aceita até 200 caracteres</p>
    <p><strong>Cargo</strong>  Aceita até 200 caracteres</p>
   </div>
    
    
   <a href="admin_biblioteca.php" ><div class="etec-admin-pad-bar-iten etec-admin-pad-bar-iten-btn " >
       Voltar
   </div></a>
 </div>
 <div class="etec-admin-pad-conteudo">
 
<fieldset>        	  	  
 <form action="admin_biblioteca.php" method="post" >
  <div class="etec-admin-pad-forms">
  
  <div class="etec-admin-pad-forms-element">
  <input name="nome" type="text" class="input" maxlength="200" id="funcionario_nome" placeholder="Nome do funcionário."/>
  </div>
  
   <div class="etec-admin-pad-forms-element">
   <input name="funcao" type="text" class="input" maxlength="200" id="funcionario_funcao" placeholder="Cargo do funcionário."/>
  </div>
  
  

<div class="button etec-admin-pad-forms-enviar"><input name="cadastrar" type="button" value="Finalizar" /></div>
</div>
</form>
</fieldset>
  
 
  </div>
 </div>
</main>
   

<script src="js/admin_biblioteca.js"></script>
</body>
</html>