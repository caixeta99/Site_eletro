<?php
   
function MyAutoload($className) {    
    $extension =  spl_autoload_extensions();
    require_once (__DIR__ . '/classes/' . $className . $extension);
}

spl_autoload_extensions('.php');
spl_autoload_register('MyAutoload');

$Vestibulinho = new Vestibulinho();
$CursosVestibulinho = new CursosVestibulinho();
$LigacaoCursosVestibulinho = new LigacaoCursosVestibulinho();
$ProcessoSeletivo = new ProcessoSeletivoVestibulinho();
$Recomendacoes = new RecomendacoesVestibulinho();

	
	//pega as informações do ultimo vestibular
$vestibulinho = $Vestibulinho->findLast();

if(!$vestibulinho){
	
	die(header('location:erro 404.php'));
	
}
	
?><!doctype html>
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
<link rel="stylesheet" href="Css/etec-style-elementos_especificos.css">


                                        <!-- titulo da pagina -->
<title>Vestibulinho | Eletrô</title>

</head>
<body>

<?php 

include("menu.php");/*inclusao do menu do site*/

?>

<div class="main-conteiner"><!--Abertura da class aonde ficara todo o conteudo da pagina -->

 <header class="etec-container-indicator">
  
   <div class="etec-container-indicator-item"><?php echo $vestibulinho->v_nome; ?>  | <a href="index.php">Eletrô</a> </div>
  
 </header><!-- fechamento da class"container-indicator-->
 

 
<div class="etec-vesti-unit-info">
  
  <ul>
   <li><?php echo $vestibulinho->v_ano." ".$vestibulinho->v_semestre; ?></li>
   <li>Ensino médio, técnico e integrado gratuito e de qualidade </li>
   <li><mark>Inscrições no site:</mark> <a href="https://www.vestibulinhoetec.com.br/unidades-cursos/escola.asp?c=47">https://www.vestibulinhoetec.com.br/unidades-cursos/escola.asp?c=47</a></li>
   <li><mark>Período de Inscrição:</mark> <?php echo $vestibulinho->v_periodo_inscricao; ?></li>
   <li><mark>Data do exame:</mark> <?php echo date('d/m/Y', strtotime($vestibulinho->v_data_exame)); ?></li>
   <li><mark>Horário  do exame:</mark> <?php echo $vestibulinho->v_hora_exame; ?></li>
  </ul>
</div> 


<?php

	//Busca os cursos 
$cursos = $CursosVestibulinho->findAll($vestibulinho->v_id, 'Matutino');
	
	//Verifica se foi encontrado
if($cursos){

?>
<div class="etec-vesti-table-curso">
    <h1>Modalidades oferecidas pela ETEC</h1>
  <table  border="1" cellpadding="1">
  <tr id="cont-table-title">
    <td width="68%">Ensino médio</td>
    <td width="16%">Período</td>
    <td width="16%">QTD de vagas</td>
  </tr>
  
<?php
  
	foreach($cursos as $key => $value):

?>
   <tr>
    <td><?php echo $value->vc_nome; ?></td>
    <td><?php echo $value->vc_periodo; ?></td>
    <td><?php echo $value->vc_qtd_vagas." vagas"; ?></td>
  </tr>
<?php 

	endforeach;

?>
</table>
</div><!--Fechamento da tabela do medio"-->
<?php 

}

	//Busca os cursos 
$cursos = $CursosVestibulinho->findAll($vestibulinho->v_id, 'Diurno');
	
	//Verifica se foi encontrado
if($cursos){
	
?>
<div class="etec-vesti-table-curso">
  <table  border="1" cellpadding="1">
  <tr id="cont-table-title">
    <td width="68%">Ensino técnico integrado ao médio</td>
    <td width="16%">Período</td>
    <td width="16%">QTD de vagas</td>
  </tr>
<?php
  
	foreach($cursos as $key => $value):

?>
   <tr>
    <td><?php echo $value->vc_nome; ?></td>
    <td><?php echo $value->vc_periodo; ?></td>
    <td><?php echo $value->vc_qtd_vagas." vagas"; ?></td>
  </tr>
<?php 

	endforeach;

?>
</table>
</div><!--Fechamento da tabela de cursos integrado as medio"-->
<?php 

}

	//Busca os cursos 
$cursos = $CursosVestibulinho->findAll($vestibulinho->v_id, 'Noturno');
	
	//Verifica se foi encontrado
if($cursos){
	
?>
<div class="etec-vesti-table-curso ">
  <table  border="1" cellpadding="1">
  <tr id="cont-table-title">
    <td width="68%">Cursos modulares</td>
    <td width="16%">Período</td>
    <td width="16%">QTD de vagas</td>
  </tr>
<?php
  
	foreach($cursos as $key => $value):

?>
   <tr>
    <td><?php echo $value->vc_nome; ?></td>
    <td><?php echo $value->vc_periodo; ?></td>
    <td><?php echo $value->vc_qtd_vagas." vagas"; ?></td>
  </tr>
<?php 

	endforeach;

?>
</table>
</div><!--Fechamento da tabela de cursos "-->
<?php 

}

?> 
 


<?php

$topicos = $ProcessoSeletivo->findAll($vestibulinho->v_id, 'S');

if($topicos){

?>

<div class="etec-vesti-infor-main">
 <div class="etec-vesti-inform">
  <div class="etec-vest-inform-processe">
   <h1>Programação para o processo seletivo <?php //echo $vestibulinho[5]; ?></h1>
   <input type="checkbox" id="ler-regulamento">
   <ul>
<?php	
    
	$i=1; 
	
	foreach($topicos as $key => $value):
		
		if($i == 4){

?>
  </ul>
  <ul class='regulamento'> 
<?php  	} ?>  
  <li><?php 
  if($value->vt_data_final != ''){
	  //separa a hora e a data
      $data_hora_i = explode(" ",$value->vt_data_inicial);
	  $data_hora_f = explode(" ",$value->vt_data_final);
	  
	  $descricao = "De ".date('d/m/Y',strtotime($data_hora_i[0]));
	  if($data_hora_i[1] != '00:00:00'){
		  $descricao = $descricao." ".date('H:i',strtotime($data_hora_i[1]));
	  }
	  $descricao = $descricao." até ".date('d/m/Y',strtotime($data_hora_f[0]));
	  if($data_hora_f[1] != '00:00:00'){
		  $descricao = $descricao." ".date('H:i',strtotime($data_hora_f[1]));
	  }
	  $descricao = $descricao." - ".$value->vt_descricao;
  }else{
	  //separa a hora e a data
      $data_hora_i = explode(" ",$value->vt_data_inicial);
	  
	  $descricao = "Apartir de ".date('d/m/Y',strtotime($data_hora_i[0]));
	  if($data_hora_i[1] != '00:00:00'){
		  $descricao = $descricao." ".date('H:i',strtotime($data_hora_i[1]));
	  }
	  $descricao = $descricao." - ".$value->vt_descricao;
  }
  echo $descricao;

?>
</li>
<?php  
		$i++;
 	
	endforeach
 
?> 
  </ul>
<?php 
	
	if($i >= 5){ 
		
?>

<?php 
	
	} 
	
}
	
?>


 </div><!--fechamento da classe"etec-vest-inform-processe"-->
 <label class="ler ler-mais   " for="ler-regulamento">Ler mais</label><!-- btn ler mais --> 
<label class="ler ler-menos " for="ler-regulamento">Ler menos</label><!-- btn ler menos -->

 <div class="etec-vesti-taxa-incri">
  <h1>Valor da Taxa de Inscrição</h1>
 <p class=""><?php echo $vestibulinho->v_preco_inscricao; ?></p>
 </div>
 
 
<?php 	     

$recomendacoes = $Recomendacoes->findAll($vestibulinho->v_id, 'S');

if($recomendacoes){

?>     
 <div class="etec-vesti-taxa-incri">
   
   <h1>Recomendações para o dia do exame</h1>
    <ul>
<?php	    		

	foreach($recomendacoes as $key => $value):

?>
  <li ><?php echo $value->vr_descricao; ?></li>
<?php 

	endforeach;

?>
 </ul>
 </div>
<?php 
 
}

?>
 
</div><!--fechamento da class"etec-vest-inform-"-->
 <div class="etec-vesti-video">
  
 <h1>Tutorial de como realizar sua inscrição nesta ETEC</h1>
 <div  class="etec-vesti-video-vi ">
  <video controls class="etec-vesti-video-video" >
   <source src="Videos/Tutorial inscricao.mp4" type="video/mp4" title="Tutorial inscricao para o vestibulinho da Etec">
   Desculpe, seu browser não possui suporte para esse vídeo!!
  </video>
 </div><!-- fechamento da class"vesti-video-vi" -->
</div><!---fechamento da class"vesti-video"-->

 
</div>


<!--- ola -->





</div><!-- Fechamento da class "main-conteiner"-->
 

<?php 
include("rodape.php");/*inclusao do rodape do site*/
?>


</body>
</html>