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

<title>Cadastro de um novo membro do corpo docente</title>
</head>
<body>



<?php 
include("admin_menu.php");/*inclusao do menu do site*/
?>
<?php
//verifica se os campos foram recebidos
 if((isset($_POST['nome']))and(isset($_POST['email']))){
	 //pega os valores dos campos
   $nome = $_POST['nome'];
   $email = $_POST['email'];
   
   //verificacao contra mysql inject
   $nome = stripcslashes($nome);
   $nome = mysqli_real_escape_string($conexao,$nome);
   $email = stripcslashes($email);
   $email = mysqli_real_escape_string($conexao,$email);
   
   if((mb_strlen($nome)>100)or(mb_strlen($email)>100)){
      die('Falha ao realizar o cadastro: tamanho dos valores digitados inválidos');
   }
   
   //realiza o cadastro do calendario
   $sql = "insert into corpo_docente(cd_nome,cd_email) values('".$nome."','".$email."')";
   
   $resultado = mysqli_query($conexao,$sql);
   if (!$resultado){ die("Falha no cadastro: ".mysqli_error($conexao) ); 
   }else{
	   // mensagem de cadastro bem sucedido
     echo "<script language=\"javascript\">";
	 echo "alert('Cadastro bem sucedido!');";
	 echo  'window.location.href = "admin_corpo_docente.php";';
	 echo "</script>";
   }
   
 }
?>

<main class="etec-admin-pag-padrao">
 <div class="etec-admin-pad-barlateral">
   <div class="etec-admin-pad-bar-info"><h1>Cadastro Corpo Docente</h1></div>
   <div class="etec-admin-pad-bar-info"><i>Informativo:</i> Nesta página é possivel realizar o cadastro de um novo membro do corpo docente. Logo abaixo desta mensagem há a seguinte opção:
   
    <p><strong>"Voltar"</strong> Botão que irá redireciona-lo de volta à página do corpo docente; </p>
   </div>
     <div class="etec-admin-pad-bar-info"><i>Resumo dos campos</i> Logo abaixo poderá ser visto um resumo de cada campo do formulário.
    <p><strong>Nome </strong> Aceita até 100 caracteres</p>
    <p><strong>E-mail </strong> Aceita até 100 caracteres, sendo obrigatório o uso do formado de e-mail(email@provedor) </p>
    
   
   
    </div>
    
     <a href="admin_corpo_docente.php" ><div class="etec-admin-pad-bar-iten etec-admin-pad-bar-iten-btn " >
       Voltar
   </div></a>
 </div>
 <div class="etec-admin-pad-conteudo">
 
<fieldset>        	  	  
 <form action="admin_corpo_docente.php" method="post" >
  <div class="etec-admin-pad-forms">
   
    <div class="etec-admin-pad-forms-element">
     <input name="nome" type="text" class="input" id="corpo_docente_nome" placeholder="Nome do membro do corpo docente" maxlength="100"/>
   </div>
   
   <div class="etec-admin-pad-forms-element">
    
    <input name="email" type="email" class="input" id="corpo_docente_email" placeholder="E-mail do membro do corpo docente" maxlength="100"/>
   </div>
   
 
 



<div class="button etec-admin-pad-forms-enviar"><input name="cadastrar" type="button" value="Finalizar" /></div>
</div>
</form>
</fieldset>
  
  

  
 </div>
</main>



 
 
<script src="js/admin_corpo_docente.js"></script>
</body>
</html>