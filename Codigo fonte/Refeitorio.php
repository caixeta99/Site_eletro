<?php

function MyAutoload($className) {    
    $extension =  spl_autoload_extensions();
    require_once (__DIR__ . '/classes/' . $className . $extension);
}

spl_autoload_extensions('.php');
spl_autoload_register('MyAutoload');
  
$PrestacaoContas = new PrestacaoContas();
$PrestacaoContasItens = new PrestacaoContasItens();

?>
<!doctype html>
<html>
<head>

 <?php

include("gogle_anlistc.php");

?>

<meta charset="utf-8">
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
<link rel="stylesheet" href="Css/etec-style-usuario-servicos.css">
<link rel="stylesheet" href="Css/etec-style-usuario-servicos-responsible.css">
<link rel="stylesheet" href="Css/etec-style-elementos_especificos.css">
<title>Refeitorio | Eletrô</title>
</head>
<body>

<?php 

include("menu.php");/*inclusao do menu do site*/

?>

<div class="main-conteiner"><!--Abertura da class aonde ficara todo o conteudo da pagina -->

 <header class="etec-container-indicator">
  
   <div class="etec-container-indicator-item"> Refeitório  | <a href="index.php">Eletrô</a> </div>
  
 </header><!-- fechamento da class"container-indicator-->
 

  
<div class="etec-refeitorio-horario-funci ">
 <h3>A Eletro oferece refeição gratuita para todos os seus alunos</h3>
 <h1>Horario de Funcionamento</h1>
 <ul>
  <li>Lanche da Manhã: 6:40 às 7:10 hs</li> 
  <li>Almoço: 12:30 às 13:30 hs</li>
  <li>Lanche da Tarde: 15:10 às 16:00 hs</li>
  <li>Jantar: 17:30 às 19:15 hs</li>
  <li>Lanche da Noite: 20:50 às 21:10 hs</li>
 </ul>
</div>
 
<div class="etec-refeitorio-content-img">
  <h1>Fotos das Instalações</h1>
 <div class="etec-refeitorio-img"><img src="Imagens/Imagens estaticas/Refeitorio/Refeitorio 1.JPG" alt="Instalações do Refeitorio" title="Instalações do Refeitorio"></div>
 
 <div class="etec-refeitorio-img"><img src="Imagens/Imagens estaticas/Refeitorio/Refeitorio 2.JPG" alt="Instalações do Refeitorio" title="Instalações do Refeitorio"></div>
 
 <div class="etec-refeitorio-img"><img src="Imagens/Imagens estaticas/Refeitorio/Refeitorio 3.JPG" alt="Instalações do Refeitorio" title="Instalações do Refeitorio"></div>

</div> 

<?php 	     

$refeitorio = $PrestacaoContas->findAll('Refeitório');

if($refeitorio){

?> 
 <div class="etec-refeitorio-prestacoes-conts">
 <h1>Prestação de Contas da Verba de Gêneros Alimentícios</h1>

<?php 	     

	foreach($refeitorio as $key => $value):

?>
 <div class="etec-table-elemento">
 
 <table width="200" border="1" cellpadding="1" class="">
 <caption> 
    <?php echo $value->pc_ano; ?>
  </caption>  
  <tr id="cont-table-title">
    <td  >Mês</td>
    <td >Arquivo</td>
    
  </tr>
<?php 	     
    
			foreach($PrestacaoContasItens->findAll($value->pc_id) as $key_item => $value_item):

?>   
  <tr>
    <td><?php echo $value_item->pci_mes; ?></td>
    <td class="cont-td-doc "><?php if($value_item->pci_caminho == ''){echo '-';}else{?><a href="<?php echo $value_item->pci_caminho; ?>">Download</a><?php } ?></td>   
  </tr>
<?php 

			endforeach; 

?>
</table>

 
 </div><!--fechamento da class"cont-table"-->
<?php 

	endforeach;

?>
 
 </div><!--fehchamento da class"refeitorio-prestacoes-cont"-->
<?php 

}

?>
 
 
 
 
 
 
</div><!-- Fechamento da class "main-conteiner"-->


<?php 
include("rodape.php");/*inclusao do rodape do site*/
?>


</body>
</html>