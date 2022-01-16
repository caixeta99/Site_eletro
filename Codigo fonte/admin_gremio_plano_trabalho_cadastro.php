<?php

include("session.php");

function MyAutoload($className) {    
    $extension =  spl_autoload_extensions();
    require_once (__DIR__ . '/classes/' . $className . $extension);
}

spl_autoload_extensions('.php');
spl_autoload_register('MyAutoload');
  
$Gremios = new Gremio();

date_default_timezone_set('America/Sao_Paulo');
$date = date('Y');        

	//realiza a busca do ultimo gremio estudantil
$gremio_atual = $Gremios->find($date);
	
if(!($gremio_atual)){
		
	die(header('location:admin_gremio.php')); 
	
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
<title>Cadastro do plano de trabalho do grêmio</title>

</head>
<body>



<?php 
include("admin_menu.php");/*inclusao do menu do site*/
?>

<main class="etec-admin-pag-padrao">
 <div class="etec-admin-pad-barlateral">
   <div class="etec-admin-pad-bar-info"><h1>Cadastro do plano de trabalho do gremio</h1></div>
   <div class="etec-admin-pad-bar-info"><i>Informativo:</i>  Nesta página é possivel realizar o cadastro de um novo item do plano de trabalho. Logo abaixo desta mensagem há a seguinte opção:
   
    <p><strong>"Voltar"</strong> Botão que irá redireciona-lo de volta à página de plano de trabalho; </p>
   </div>
    <div class="etec-admin-pad-bar-info"><i>Resumo dos campos</i>
     Logo abaixo poderá ser visto um resumo de cada campo do formulário.
    <p><strong>Categoria</strong> Aceita os valores "Cultura", "Esporte", "Política", "Social" e "Comunicação"</p>
    <p><strong>Descrição do item</strong> Aceita até 150 caracteres</p>
    
   
   
    </div>
   
   
   <a href="admin_gremio_plano_trabalho.php" ><div class="etec-admin-pad-bar-iten etec-admin-pad-bar-iten-btn " >
     Voltar
   </div></a>
 </div>
 <div class="etec-admin-pad-conteudo">
 
<fieldset>        	  	  
 <form action="admin_gremio_plano_trabalho.php" method="post" >
  <div class="etec-admin-pad-forms">
   <div class="etec-admin-pad-forms-info">
    <p>Categoria </p>
      <select name="categoria" class="" >
      <option>Cultura</option>
      <option>Esporte</option>
      <option>Política</option>
      <option>Social</option>
      <option>Comunicação</option>
    </select>
  </div>
  <div class="etec-admin-pad-forms-element">
   <textarea name="descricao" class="text-area Forme-elemente"  placeholder="Descrição do item." maxlength="150" ></textarea>
  </div>
  

<div class="button etec-admin-pad-forms-enviar"><input name="cadastrar" type="submit" value="Finalizar" /></div>
</div>
</form>
</fieldset>
  
  

  </div>
 </div>
</main>

</body>
</html>