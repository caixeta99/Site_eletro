<?php

function MyAutoload($className) {    
    $extension =  spl_autoload_extensions();
    require_once (__DIR__ . '/classes/' . $className . $extension);
}

spl_autoload_extensions('.php');
spl_autoload_register('MyAutoload');
  
$Data = new CalendarioData();
$Calendario = new CalendarioEscolar();

   	//pega o ano atual
date_default_timezone_set('America/Sao_Paulo');
$ano = date('Y');

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
<link rel="stylesheet" href="Css/etec-style-usuario-informacoes.css">
<link rel="stylesheet" href="Css/etec-style-usuario-informacoes-responsible.css">

                         <!-- titulo d apagia -->
<title>Calendário Escolar | Eletrô</title>
<!-- css referente a pagina -->

</head>
<body>

<?php 

include("menu.php");/*inclusao do menu do site*/

?>

<div class="main-conteiner"><!--Abertura da class aonde ficara todo o conteudo da pagina -->

 <header class="etec-container-indicator">
  
   <div class="etec-container-indicator-item"> Calendário Escolar  | <a href="index.php">Eletrô</a> </div>
  
 </header><!-- fechamento da class"container-indicator-->

 <!--O titulo "Calendario escolar " no modo responsivo fica muito grande e acaba estourando o limite da pagina por isso for adicionado essa class "cont-text-font-1"que diminui a fonte do texto"-->
 
<?php

$mes = array('Janeiro', 'Fevereiro', 'Marco', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro');

for($i = 1;$i <= 12;$i++){

?>
 <div class="calenda-mes <?php if($i == 12){ echo 'cont-marg-bot4'; }else{echo 'cont-marg-bot1';} ?>">
  <div class="calendar-unit">
   <div class="calendar-unit-text">
<?php 
	
	echo $mes[($i-1)];
	 
?>
   </div>
   <div class="calendar-unti-img cal-fix"><img width="10px" height="10px" src="Imagens/Imagens estaticas/Icones/ponteiro-baixo.png"></div>
  </div>
  <div class="cal-sub">
<?php 	  
	
		//pega a data inicial e final do mes  
   	if($i != 12){
	   
	   	if($i < 10){
		   
		   	$data_i = $ano.'-0'.$i.'-01';
		   	if($i != 9){
				
				$data_f = $ano.'-0'.($i+1).'-01';
				
			}
			else{
			
				$data_f = $ano.'-'.($i+1).'-01';
				
			}
		   
	   	}
	   	else{
		   
		   	$data_i = $ano.'-'.$i.'-01';
			$data_f = $ano.'-'.($i+1).'-01';
		   
	   	}
	     
   	}
	else{
	
		$data_i = $ano.'-12-01';
		$data_f = ($ano+1).'-01-01';
		
	}
  
	foreach($Data->findAll($data_i, $data_f, 'S', 'N', 'ASC') as $key => $value):

?> 
  <div class=" cal-sub-iten20">
   <div class="cal-sub-data ">
   <?php 
	   $data = explode('-',$value->d_data);
	   echo $data[2].'/'.$data[1]; 
   ?>
   </div>
   <div class="<?php
    $descricao_qtd = strlen($value->d_descricao);
	if($descricao_qtd <= 20){
		echo 'cal-sub-text20';
	}
	if(($descricao_qtd <= 50)and($descricao_qtd > 20)){
		echo 'cal-sub-text50';
	}
	if(($descricao_qtd <= 90)and($descricao_qtd > 50)){
		echo 'cal-sub-text90';
	}
	if(($descricao_qtd <= 110)and($descricao_qtd > 90)){
		echo 'cal-sub-text110';
	}
	if(($descricao_qtd <= 150)and($descricao_qtd > 110)){
		echo 'cal-sub-text150';
	}
	?>"><?php echo $value->d_descricao; ?></div>
  </div> 
<?php 

	endforeach;

?>   
  </div><!--fechamneto da class"cal-sub"-->
 </div><!--fechamneto da class"calenda-mes"-->
<?php 

} 

?>   
 <!--  -->
<?php 
  
$documentos = $Calendario->findAll();

if($documentos){

  
?> 
 <div class="etec-title-princip etec-title-calendar-escolar">Calendário Escolar</div>
 
<?php

	$i = 1;
  
	foreach($documentos as $key => $value):
	  
		if($i%2 == 1){
		
?>  
 <div class="calenda-escolar-c cont-a-hover-red cont-a-black ">
<?php

		}
	
?> 
  <div class=" calendar-escolar">
   <img src="Imagens/Imagens estaticas/Calendario_escolar/calendario_escolar.jpg" alt="calendario_escolar <?php echo $value->ca_ano; ?>" title="calendario_escolar <?php echo $value->ca_ano; ?>">
   <div class="calendario_img_ano"><?php echo $value->ca_ano; ?></div>
    <a target="_blank" href="<?php echo $value->ca_documento; ?>"><div class="cont-btn-download cont-marg-bot12">Download </div></a>
  </div>
<?php

		if($i%2 == 0){
	
?>
 </div> 
<?php

		}
	
		$i++; 

	endforeach;
  		
?>
</div> 
<?php

}

?> 
</div><!-- Fechamento da class "main-conteiner"-->


<?php 
include("rodape.php");/*inclusao do rodape do site*/
?>
<script src="js/calendario.js"></script>

</body>
</html>