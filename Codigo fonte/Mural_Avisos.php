<?php

function MyAutoload($className) {    
    $extension =  spl_autoload_extensions();
    require_once (__DIR__ . '/classes/' . $className . $extension);
}

spl_autoload_extensions('.php');
spl_autoload_register('MyAutoload');
  
$Avisos = new Avisos();

?>
<!doctype html>
<html>
<head>

<?php

include("gogle_anlistc.php");

?>        
                            <!-- meta tages da pagina -->
<meta charset="utf-8">
<meta http-equiv="Content-Language" content="pt-br">
<meta name="viewport" content="width=device-width,initial-scale=1"/>
<meta name="keywords" content="Escola Tecnica , escola tecnica , ensino medio integrado ao tecnico , ensino medio , Ensino medio , Mococa , mococa , Mococa/sp , Etec , ETEC , Ete , Etec mococa, Eletro mococa, Eletro , ELETRO , letro , vestibulinho, vestibular , Profissionalização, Profissionalizacao ,cps"/>
<meta name="description" content="A vários anos a ETEC: ELETRÔ - João Baptista De Lima Figueiredo vem proporcionado ensino de qualidade a custo zero, contando com um grande aparato como: quadra esportiva , auditório , refeitório , laboratórios 100% equipados e internet disponível para todos os alunos. além de possuir grande taxa de aprovação nos principais vestibulares">                                  
                                   <!--- Icone da pagina-->
<link rel="icon" type="imagem/png" href="Imagens/Imagens estaticas/Icones/icone-etec.png">

                                    <!--- Css da pagina-->
<link rel="stylesheet" href="Css/Reset.css">
<link rel="stylesheet" href="Css/etec-style-navigation.css">
<link rel="stylesheet" href="Css/etec-style-navigation-responsible.css">
<link rel="stylesheet" href="Css/etec-style-usuario-escola.css">
<link rel="stylesheet" href="Css/etec-style-usuario-escola-responsible.css">
 

                                       <!-- titulo da pagina -->
<title>Mural de Avisos | Eletrô</title>

</head>
<body>

<?php 

include("menu.php");/*inclusao do menu do site*/

?>

<div class="main-conteiner"><!--Abertura da class aonde ficara todo o conteudo da pagina -->

 <header class="etec-container-indicator">
  
   <div class="etec-container-indicator-item"> Mural de Avisos  | <a href="index.php">Eletrô</a> </div>
  
 </header><!-- fechamento da class"container-indicator-->
 
<?php   
  
    //Salva os campos 
if(!($Avisos->setDestinatario('alunos'))){
	
	die('Falha ao tentar realizar o cadastro, opção inválida.');

} 

$avisos = $Avisos->findAll('S','N');

if($avisos){
	
	$i = 1;
	
?>
  <div class="etec-avi-estudante-etc etec-title-princip">
  <h1>Aviso para estudantes da eletrô</h1>
  <div class="etec-mural-avi">
<?php	
   
   	foreach($avisos as $key => $value):
	    
   		if($i <= 2){ 
   
?>
   <div >
    <div class="etec-mural-avi-fix"><p>&diams; <?php echo $value->av_descricao; ?></p></div>
   </div>
<?php 
		
		}
		else{
			
?>
   <div class="etec-avi-sub">
    <div class="etec-avi-sub-ocu"><p>&diams; <?php echo $value->av_descricao;; ?></p></div>
   </div>
<?php 
    	}
    
		$i++;
   	
	endforeach;
   	
	if($i > 3){ 

?>
   <div class="etec-btn-ver">
    <label class="etec-avi-fix">Lista Completa</label><!-- btn ler mais --> 
   </div>
<?php 

	}

?>
  </div><!--fechamento da classe"mural-avi"-->
 </div><!--fechamneto da class"avi-estudante-etc"-->
<?php   

}

    //Salva os campos 
if(!($Avisos->setDestinatario('ex-alunos'))){
	
	die('Falha ao tentar realizar o cadastro, opção inválida.');

} 

$avisos = $Avisos->findAll('S','N');

if($avisos){
	
	$i = 1;
		
?>
 <div class="etec-avi-estudante-etc etec-title-princip ">
  <h1>Aviso para EX Alunos</h1>
  <div class="etec-mural-avi">
<?php	
   
   	foreach($avisos as $key => $value):
	    
   		if($i <= 2){ 
   
?>
   <div >
    <div class="etec-mural-avi-fix"><p>&diams; <?php echo $value->av_descricao; ?></p></div>
   </div>
<?php 
		
		}
		else{
			
?>
   <div class="etec-avi-sub">
    <div class="etec-avi-sub-ocu"><p>&diams; <?php echo $value->av_descricao;; ?></p></div>
   </div>
<?php 
    	}
    
		$i++;
   	
	endforeach;
   	
	if($i > 3){ 

?>
   <div class="etec-btn-ver">
    <label class="etec-avi-fix">Lista Completa</label><!-- btn ler mais --> 
   </div>
<?php 

	}

?>
  </div><!--fechamento da classe"mural-avi"-->
 </div><!--fechamneto da class"avi-estudante-etc"-->
<?php   

}

    //Salva os campos 
if(!($Avisos->setDestinatario('secretaria'))){
	
	die('Falha ao tentar realizar o cadastro, opção inválida.');

} 

$avisos = $Avisos->findAll('S','N');

if($avisos){
	
	$i = 1;
		
?>
 <div class="etec-avi-estudante-etc etec-title-princip">
  <h1>Aviso para Secretaria Académica</h1>
  <div class="etec-mural-avi">
<?php	
   
   	foreach($avisos as $key => $value):
	    
   		if($i <= 2){ 
   
?>
   <div >
    <div class="etec-mural-avi-fix"><p>&diams; <?php echo $value->av_descricao; ?></p></div>
   </div>
<?php 
		
		}
		else{
			
?>
   <div class="etec-avi-sub">
    <div class="etec-avi-sub-ocu"><p>&diams; <?php echo $value->av_descricao;; ?></p></div>
   </div>
<?php 
    	}
    
		$i++;
   	
	endforeach;
   	
	if($i > 3){ 

?>
   <div class="etec-btn-ver">
    <label class="etec-avi-fix">Lista Completa</label><!-- btn ler mais --> 
   </div>
<?php 

	}

?>
  </div><!--fechamento da classe"mural-avi"-->
 </div><!--fechamneto da class"avi-estudante-etc"-->
<?php   

}

    //Salva os campos 
if(!($Avisos->setDestinatario('coordenacao'))){
	
	die('Falha ao tentar realizar o cadastro, opção inválida.');

} 

$avisos = $Avisos->findAll('S','N');

if($avisos){
	
	$i = 1;
		
?>
 <div class="etec-avi-estudante-etc etec-title-princip">
  <h1>Aviso para Coordenação Pedagógica</h1>
  <div class="etec-mural-avi">
<?php	
   
   	foreach($avisos as $key => $value):
	    
   		if($i <= 2){ 
   
?>
   <div >
    <div class="etec-mural-avi-fix"><p>&diams; <?php echo $value->av_descricao; ?></p></div>
   </div>
<?php 
		
		}
		else{
			
?>
   <div class="etec-avi-sub">
    <div class="etec-avi-sub-ocu"><p>&diams; <?php echo $value->av_descricao;; ?></p></div>
   </div>
<?php 
    	}
    
		$i++;
   	
	endforeach;
   	
	if($i > 3){ 

?>
   <div class="etec-btn-ver">
    <label class="etec-avi-fix">Lista Completa</label><!-- btn ler mais --> 
   </div>
<?php 

	}

?>
  </div><!--fechamento da classe"mural-avi"-->
 </div><!--fechamneto da class"avi-estudante-etc"-->
<?php  

}

?>


<?php 
include("rodape.php");/*inclusao do rodape do site*/
?>
<script src="js/mural.js"></script>

</body>
</html>