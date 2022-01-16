<?php

include("session.php"); 
   
function MyAutoload($className) {    
    $extension =  spl_autoload_extensions();
    require_once (__DIR__ . '/classes/' . $className . $extension);
}

spl_autoload_extensions('.php');
spl_autoload_register('MyAutoload');
  
$Vestibulinho = new Vestibulinho();

    //pega as informações do ultimo vestibular
$vestibulinho = $Vestibulinho->findLast();

if(!$vestibulinho){

    die(header('location:admin_vestibular.php'));

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

                                       <!-- titulo da pagina -->
<title>Cadastro de tópico </title>

</head>
<body>



<?php 

include("admin_menu.php");/*inclusao do menu do site*/

?>
<main class="etec-admin-pag-padrao">
 <div class="etec-admin-pad-barlateral">
   <div class="etec-admin-pad-bar-info"><h1>Cadastro de topico</h1></div>
   <div class="etec-admin-pad-bar-info"><i>Informativo:</i>  Nesta página é possivel realizar o cadastro de um novo tópico do processo seletivo. Logo abaixo desta mensagem há a seguinte opção:
   
    <p><strong>"Voltar"</strong> Botão que irá redireciona-lo de volta à página de processo seletivo; </p>
   </div>
    <a href="admin_vestibular_processo_seletivo.php" ><div class="etec-admin-pad-bar-iten etec-admin-pad-bar-iten-btn " >
   Voltar
   </div></a>
 </div>
 <div class="etec-admin-pad-conteudo">
 
<fieldset>        	  	  
 <form action="admin_vestibular_processo_seletivo.php" method="post" >
  <div class="etec-admin-pad-forms">
  
  
   <div class="etec-admin-pad-forms-element">
 <input name="descricao" type="text" class="input" maxlength="200" id="vps_nome" placeholder="Descrição." value=""/>
  </div>
  
  
   
  
  <div class="etec-admin-pad-forms-info-pared">
  <p>Inicio </p>
   <input name="data_i" type="date" class="" id="vps_data_i" placeholder="Data do tópico." value=""/>
      <input name="hora_i" type="time" class="" placeholder="Data e hora de término" value=""/>
   
  </div>
  
  <div class="etec-admin-pad-forms-info-pared">
  <p>Fim </p>
     <input name="data_f" type="date" class="" id="" placeholder="Data e hora de término" value=""/>
     <input name="hora_f" type="time" class="" id="" placeholder="Data e hora de término" value=""/>
  
  </div>
  
 
  
 
  
  
 <div class="button etec-admin-pad-forms-enviar"><input name="cadastrar" type="button" value="Finalizar" /></div>
</div>
</form>
</fieldset>
  
 
  </div>
 </div>
</main>

<script src="js/admin_processo_seletivo.js"></script>
</body>
</html>