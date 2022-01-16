<?php

include("session.php");

function MyAutoload($className) {    
    $extension =  spl_autoload_extensions();
    require_once (__DIR__ . '/classes/' . $className . $extension);
}

spl_autoload_extensions('.php');
spl_autoload_register('MyAutoload');
  
$Conselho_Ano = new ConselhoAno();
$MembrosConselho = new Conselho();

	//Pega o ano atual
date_default_timezone_set('America/Sao_Paulo');
$date = date('Y'); 

	//Pega as informações do conselho
$conselho = $Conselho_Ano->find('');

if((!$conselho)or($conselho->coa_ano < $date)){

	die(header('location:admin_conselho_ano.php'));
	
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

<title>Editar um membro do conselho </title>
</head>
<body>



<?php 

include("admin_menu.php");/*inclusao do menu do site*/

    //verifica se o id foi recebido
if((isset($_POST['id']))){
    	//pega o valor do id
    $id = (int)$_POST['id'];

        //realiza a busca das informações
    $resultado = $MembrosConselho->find($id);
	
    if((!($resultado))and($resultado->co_ano == $conselho->coa_id)){

    	die("Falha na consulta");

    }

}
else{

	die("Falha na consulta");

}
 
?> 

<main class="etec-admin-pag-padrao">
 <div class="etec-admin-pad-barlateral">
   <div class="etec-admin-pad-bar-info"><h1>Edição de um membro do conselho</h1></div>
   <div class="etec-admin-pad-bar-info"><i>Informativo:</i> Nessa pagina é possivel realizar o cadastro de um novo membro do conselho.</div>
   
   <a href="admin_conselho.php" ><div class="etec-admin-pad-bar-iten etec-admin-pad-bar-iten-btn " >
       Voltar
   </div></a>
 </div>
 <div class="etec-admin-pad-conteudo">
 
<fieldset>        	  	  
 <form action="admin_conselho.php?ASdfd546GHD3hj5657RGHRweerRujyY54gerU7565FGerT556DFGDwIuy6YUjmgGhjUT54<?php echo $conselho->coa_id; ?>" method="post" >
  <div class="etec-admin-pad-forms">
  
  <div class="etec-admin-pad-forms-info">
    <p>Nome </p>
     <input name="nome" type="text" class="input" id="conselho_nome" placeholder="Nome do membro do conselho" maxlength="150" value="<?php echo $resultado->co_nome; ?>"/>
  </div>
  
  <div class="etec-admin-pad-forms-info">
    <p>Cargo </p>
    <input name="cargo" type="text" class="input" id="conselho_cargo" placeholder="Cargo do membro do conselho" maxlength="150" value="<?php echo $resultado->co_cargo; ?>"/>
  </div>
  
  
  
  <input name="id" type="hidden" value="<?php echo $resultado->co_id; ?>" />
<div class="button etec-admin-pad-forms-enviar"><input name="editar" type="button" value="Finalizar" /></div>
</div>
</form>
</fieldset>
  
   
  </div>
 </div>
</main>


<script src="js/admin_conselho.js"></script>
</body>
</html>