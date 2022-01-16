<?php

include("session.php");

function MyAutoload($className) {    
    $extension =  spl_autoload_extensions();
    require_once (__DIR__ . '/classes/' . $className . $extension);
}

spl_autoload_extensions('.php');
spl_autoload_register('MyAutoload');

if(isset($_GET['horario'])){
	if(($_GET['horario'] != 'Ensino Médio')and($_GET['horario'] != 'Ensino Integrado')and($_GET['horario'] != 'Ensino Integrado - Novotec')and($_GET['horario'] != 'Ensino Técnico')){

	   	die(header('location:admin_horario_aulas.php')); 
		
    }
	
	$horario = $_GET['horario'];
	
	$Horarios = new HorarioAulas();
	
		    //realiza a busca das informações
	$resultado = $Horarios->find($horario);
	
	if(!($resultado)){

		die("Falha na consulta");

	}

}
else{

    die(header('location:admin_horario_aulas.php')); 

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
<title>Horário das aulas</title>
</head>
<body>

<?php 
include("admin_menu.php");/*inclusao do menu do site*/

?>


<main class="etec-admin-pag-padrao">
 <div class="etec-admin-pad-barlateral">
   <div class="etec-admin-pad-bar-info"><h1>Edição do horário das aulas</h1></div>
   <div class="etec-admin-pad-bar-info"><i>Informativo:</i> Nesta página é possivel realizar a edição do horário das aulas.</div>
   
   <a href="admin_horario_aulas.php" ><div class="etec-admin-pad-bar-iten etec-admin-pad-bar-iten-btn " >
       Voltar
   </div></a>
 </div>
 
 <div class="etec-admin-pad-conteudo">
 
 
<fieldset>        	  	  
 <form action="admin_horario_aulas.php" method="post"  enctype="multipart/form-data">
  <div class="etec-admin-pad-forms">
<div class="etec-admin-pad-forms-info">
  
  </div>
  
<div  class="etec-admin-pad-forms-enviar-img-btn  ">

   <label for='selecao-arquivo'>Selecionar um Arquivo</label>
   <input  name="documento" type="file" accept="application/pdf application/msword application/msexcel" id="selecao-arquivo"  />
   <div class="etec-admin-pad-forms-element">
   <textarea name="descricao" class="text-area" placeholder="Descrição do horário." minlength="1" maxlength="200" ><?php echo $resultado->ha_descricao; ?></textarea>
  </div>
  <div class="button etec-admin-pad-forms-enviar"><input name="editar" type="submit" value="Finalizar" /></div>
   </div> 
   
  

  <input  name="horario" type="hidden" value="<?php echo $_GET['horario'];  ?>" /> 
</div>
</form>
</fieldset>
  </div>
   </div>
 </div>
</main>

</body>
</html>