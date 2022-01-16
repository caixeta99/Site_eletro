<?php

function MyAutoload($className) {    
    $extension =  spl_autoload_extensions();
    require_once (__DIR__ . '/classes/' . $className . $extension);
}

spl_autoload_extensions('.php');
spl_autoload_register('MyAutoload');
  
$Horario = new HorarioAulas();

$i = 0;
   
foreach($Horario->findAll() as $key => $value):

	$horario[$i] = $value->ha_documento;
	$descricao[$i] = $value->ha_descricao;
	$i++;
	
endforeach;

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
                                    <!--- Css da pagina-->
<link rel="stylesheet" href="Css/Reset.css">
<link rel="stylesheet" href="Css/etec-style-navigation.css">
<link rel="stylesheet" href="Css/etec-style-navigation-responsible.css">
<link rel="stylesheet" href="Css/etec-style-usuario-informacoes.css">
<link rel="stylesheet" href="Css/etec-style-usuario-informacoes-responsible.css">

 <!--icone da pagina-->
<link rel="icon" href="Imagens/Imagens estaticas/Icones/icone-etec.png" />                                

                                             <!-- titulo da pagina-->
<title>Horário das Aulas | Eletrô</title>
                                      
</head>
<body>

<?php 
include("menu.php");/*inclusao do menu do site*/
?>

<div class="main-conteiner"><!--Abertura da class aonde ficara todo o conteudo da pagina -->

 <header class="etec-container-indicator">
  
   <div class="etec-container-indicator-item"> Horário das Aulas  | <a href="index.php">Eletrô</a> </div>
  
 </header><!-- fechamento da class"container-indicator-->
 
 <!--O titulo "Horario das aulas" no modo responsivo fica muito grande e acaba estourando o limite da pagina por isso for adicionado essa class "cont-text-font-1"que diminui a fonte do texto"-->
 
 
 

  
  <div class="etec-horario-aulas-unit">
   <h1>Ensino Médio</h1>
   <div class="etec-horario-aulas-content ">
    <div class="etec-horario-aulas-img"><img src="Imagens/Imagens estaticas/horarios das aulas/Horario das aulas.jpg" alt="Horario das aulas Ensino Médio" title="Horario das aulas Ensino Médio"></div>
    <div class="etec-horario-aulas-text"><?php echo $descricao[0]; ?></div>
   </div><!--fechamento da class"etec-horario-aulas-content"-->
   <div class="etec-horario-aulas-download"><a href="<?php echo $horario[0]; ?>" target="_blank"><div class="etec-horario-aulas-download-a" >Download</div></a></div>
  </div><!--fechamento da div"horario-aulas-unit"-->
  
  <div class="etec-horario-aulas-unit">
   <h1>Ensino Integrado</h1>
   <div class="etec-horario-aulas-content">
    <div class="etec-horario-aulas-img"><img src="Imagens/Imagens estaticas/horarios das aulas/Horario das aulas.jpg" alt="Horario das aulas Ensino Integrado" title="Horario das aulas Ensino Integrado"></div>
    <div class="etec-horario-aulas-text"><?php echo $descricao[1]; ?></div>
   </div>
   <div class="etec-horario-aulas-download "><a href="<?php echo $horario[1]; ?>" target="_blank"><div class="etec-horario-aulas-download-a">Download</div></a></div>
  </div><!--fechamento da div"horario-aulas-unit"-->
  
  <div class="etec-horario-aulas-unit">
   <h1>Ensino Integrado - Novotec</h1>
   <div class="etec-horario-aulas-content">
    <div class="etec-horario-aulas-img"><img src="Imagens/Imagens estaticas/horarios das aulas/Horario das aulas.jpg" alt="Horario das aulas Ensino Integrado - Novotec" title="Horario das aulas Ensino Integrado - Novotec"></div>
    <div class="etec-horario-aulas-text"><?php echo $descricao[2]; ?></div>
   </div>
   <div class="etec-horario-aulas-download "><a href="<?php echo $horario[2]; ?>" target="_blank"><div class="etec-horario-aulas-download-a">Download</div></a></div>
  </div><!--fechamento da div"horario-aulas-unit"-->
  
  <div class="etec-horario-aulas-unit">
   <h1>Ensino Técnico</h1>
   <div class="etec-horario-aulas-content">
    <div class="etec-horario-aulas-img"><img src="Imagens/Imagens estaticas/horarios das aulas/Horario das aulas.jpg" alt="Horario das aulas Ensino Técnico" title="Horario das aulas Ensino Técnico">></div>
    <div class="etec-horario-aulas-text"><?php echo $descricao[3]; ?></div>
   </div>
   <div class="etec-horario-aulas-download "><a href="<?php echo $horario[3]; ?>" target="_blank"><div class="etec-horario-aulas-download-a" >Download</div></a></div>
  </div><!--fechamento da div"horario-aulas-unit"-->
  
  

</div><!-- Fechamento da class "main-conteiner"-->


<?php 
include("rodape.php");/*inclusao do rodape do site*/
?>

</body>

</html>