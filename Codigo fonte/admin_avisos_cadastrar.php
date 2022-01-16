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
<title>Cadastro de avisos</title>

</head>
<body>

<?php 

include("admin_menu.php");/*inclusao do menu do site*/

?>

<main class="etec-admin-pag-padrao">
 <div class="etec-admin-pad-barlateral">
   <div class="etec-admin-pad-bar-info"><h1>Cadastro de um novo Aviso</h1></div>
   <div class="etec-admin-pad-bar-info"><i>Informativo:</i> Nesta página é possivel realizar o cadastro de um novo aviso. Logo abaixo desta mensagem há a seguinte opção:
   
    <p><strong>"Voltar"</strong> Botão que irá redireciona-lo de volta à página de datas; </p>
   </div>
   <div class="etec-admin-pad-bar-info"><i>Resumo dos campos</i> Logo abaixo poderá ser visto um resumo de cada campo do formulário.
    <p><strong>Destinatário</strong> Aceita os valores "Alunos ", "EX-Alunos" ,"Secretaria Acadêmica" ,"Cordenação Pedagógica";</p>
    <p><strong>Descrição  do Evento</strong> Aceita até 150 caracteres</p>
    
   
   
    </div>
    
   
   <a href="admin_avisos.php" ><div class="etec-admin-pad-bar-iten etec-admin-pad-bar-iten-btn " >
       Voltar
   </div></a>
 </div>
 
 <div class="etec-admin-pad-conteudo">
 
<fieldset>        	  	  
 <form action="admin_avisos.php" method="post" >
  <div class="etec-admin-pad-forms">
   <div class="etec-admin-pad-forms-info">
    <p>Destinatário</p>
     <select name="destinatario" class="input">
      <option value="alunos">Alunos</option>
      <option value="ex-alunos">EX-Alunos</option>
      <option value="secretaria">Secretaria Acadêmica</option>
      <option value="coordenacao">Coordenação Pedagógica</option>
     </select>
  </div>
  <div class="etec-admin-pad-forms-element">
   <textarea name="descricao" class="" id="aviso_descricao" placeholder="Descrição do aviso." maxlength="250" ></textarea>
  </div>

<div class="button etec-admin-pad-forms-enviar"><input name="cadastrar" type="button" value="Finalizar" /></div>
</div>
</form>
</fieldset>
  
  
 <script src="js/admin-avisos.js"></script>  
  </div>
 </div>
</main>




</body>
</html>