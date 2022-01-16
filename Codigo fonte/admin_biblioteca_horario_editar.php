<?php

include("session.php");

function MyAutoload($className) {    
    $extension =  spl_autoload_extensions();
    require_once (__DIR__ . '/classes/' . $className . $extension);
}

spl_autoload_extensions('.php');
spl_autoload_register('MyAutoload');

$BibliotecaHorario = new BibliotecaHorario();
   
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
<title>Editar Horário</title>

</head>
<body>



<?php 
include("admin_menu.php");/*inclusao do menu do site*/

	//verifica se os valores foram recebidos 
if((isset($_GET['asAre342CsahGdBg34CF653VGJH745gdFGBcSt63gfGdDFGjyJGet45345BDfHfteCVt345HFefy7FFG654fdGFASDCVXtryjBVtyrtm234']))){
		//pega os valores dos campos 
   	$id = (int)$_GET['asAre342CsahGdBg34CF653VGJH745gdFGBcSt63gfGdDFGjyJGet45345BDfHfteCVt345HFefy7FFG654fdGFASDCVXtryjBVtyrtm234'];
   
   	    //realiza a busca das informações
    $resultado = $BibliotecaHorario->find($id);
	
    if(!($resultado)){

    	die("Falha na consulta");

	}

}
else{

	die("Falha na consulta");

}

?>

<main class="etec-admin-pag-padrao">
 <div class="etec-admin-pad-barlateral">
   <div class="etec-admin-pad-bar-info"><h1>Edição de Horário</h1></div>
   <div class="etec-admin-pad-bar-info"><i>Informativo:</i> Nesta página é possivel editar um determinado horario de um funcionário da biblioteca.</div>
   
   <a href="admin_biblioteca.php" ><div class="etec-admin-pad-bar-iten etec-admin-pad-bar-iten-btn " >
       Voltar
   </div></a>
 </div>
 <div class="etec-admin-pad-conteudo">
 
<fieldset>        	  	  
 <form action="admin_biblioteca.php" method="post" >
  <div class="etec-admin-pad-forms">
 
   <div class="etec-admin-pad-forms-info">
    <p>Horário Inicial </p>
    <input name="horario_i" type="time" class="input"  id="horario_i" value="<?php echo $resultado->bh_horario_i; ?>"/>
  </div>
  
  
  <div class="etec-admin-pad-forms-info">
    <p>Horário Final </p>
    <input name="horario_f" type="time" class="input"  id="horario_f" value="<?php echo $resultado->bh_horario_f; ?>"/>
  </div>
  
  
<input name="id" type="hidden" value="<?php echo $resultado->bh_id; ?>" />
<div class="button etec-admin-pad-forms-enviar"><input name="editar_horario" type="button" value="Finalizar" /></div>
</div>
</form>
</fieldset>
  
  
<script src="js/admin_biblioteca_horario.js"></script> 
  </div>
 </div>
</main





></body>
</html>