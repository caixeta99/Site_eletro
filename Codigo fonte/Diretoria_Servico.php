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
                                    <!-- meta tages da pagina -->
<meta charset="utf-8">
<meta http-equiv="Content-Language" content="pt-br">
<meta name="viewport" content="width=device-width,initial-scale=1"/>
<meta name="keywords" content="Escola Tecnica , escola tecnica , ensino medio integrado ao tecnico , ensino medio , Ensino medio , Mococa , mococa , Mococa/sp , Etec , ETEC , Ete , Etec mococa, Eletro mococa, Eletro , ELETRO , letro , vestibulinho, vestibular , Profissionalização, Profissionalizacao ,cps"/>
<meta name="description" content="A vários anos a ETEC: ELETRÔ - João Baptista De Lima Figueiredo vem proporcionado ensino de qualidade a custo zero, contando com um grande aparato como: quadra esportiva , auditório , refeitório , laboratórios 100% equipados e internet disponível para todos os alunos. além de possuir grande taxa de aprovação nos principais vestibulares">                                    
                                   <!--- Icone da pagina-->
<link rel="icon" type="imagem/png" href="Imagens/Imagens estaticas/Icones/icone-etec.png">

                                    <!--- Css da pagina-->


 <!--- Css da pagina-->
<link rel="stylesheet" href="Css/Reset.css">
<link rel="stylesheet" href="Css/etec-style-navigation.css">
<link rel="stylesheet" href="Css/etec-style-navigation-responsible.css">

<link rel="stylesheet" href="Css/etec-style-elementos_especificos.css">
<link rel="stylesheet" href="Css/etec-style-usuario-escola.css">
<link rel="stylesheet" href="Css/etec-style-usuario-escola-responsible.css">

                                               <!-- titulo da pagina-->
<title>Diretoria de Serviços <?php echo date('Y');?> | Eletrô</title>



</head>
<body>

<?php 

include("menu.php");/*inclusao do menu do site*/

?>


<div class="main-conteiner"><!--Abertura da class aonde ficara todo o conteudo da pagina -->
 <header class="etec-container-indicator">
  
   <div class="etec-container-indicator-item">Diretoria de Serviços <?php echo date('Y');?>  | <a href="index.php">Eletrô</a> </div>
  
 </header><!-- fechamento da class"container-indicator-->

<!--O titulo "Direçao de Serviço " no modo responsivo fica muito grande e acaba estourando o limite da pagina por isso for adicionado essa class "cont-text-font-1"que diminui a fonte do texto"-->

 
 
 <div class="etec-diret-serve etec-title-princip">
   <h1>Departamento Pessoal</h1> 
   <h2>Documentação referente a atribuição de aulas:</h2>
  
  <div class="etec-donwload-unit"><a href="Documentacao/Diretoria de servicos/Departamento de pessoal/Documentacao referente a atribuicao de aulas/Portaria CETEC 1263_2017-07-26 REP.pdf.doc"  target="_blank"><img src="Imagens/Imagens estaticas/Botoes de Download/Portaria ceeteps.jpg" alt="Portaria ceeteps" title="Portaria ceeteps"></a></div>
  <div class="etec-donwload-unit"><a href="Documentacao/Diretoria de servicos/Departamento de pessoal/Documentacao referente a atribuicao de aulas/Deliberacao CEETEPS 23 2015  Comentada.pdf"  target="_blank"><img src="Imagens/Imagens estaticas/Botoes de Download/Deliberacao ceeteps atribuicao.jpg" alt="Deliberacao ceeteps atribuicao" title="Deliberacao ceeteps atribuicao"></a></div>
  
  </div><!--fechamento da class"cont-links"-->

<div class="etec-diret-serve etec-title-princip etec_regulamento">
  <h2>Regulamento Disciplinar</h2>
  <div class="etec-donwload-unit-title"><a href="Documentacao/Diretoria de servicos/Departamento de pessoal/Regulamento Disciplinar/diretoria_de_servicos.pdf"  target="_blank"><img src="Imagens/Imagens estaticas/Botoes de Download/Regulamento.jpg" alt="Regulamento" title="Regulamento"></a></div>
</div><!--fechamento da class"cont-links"-->


<div class="etec-diret-serve etec-title-princip">
  <h2>Plano de Carreira</h2>
  <div class="etec-donwload-unit-title"><a href="https://www.al.sp.gov.br/norma/?id=77392"  target="_blank"><img src="Imagens/Imagens estaticas/Botoes de Download/Plano de carreira.jpg" title="Plano de carreira" alt="Plano de carreira"></a></div>
  
</div><!--fechamento da class"cont-links"-->





<?php 	     

$direcao_servicos = $PrestacaoContas->findAll('Direção de Serviço');

if($direcao_servicos){

?> 
 <div class="etec-dire-serv-presta etec-title-princip">
  <h2>Departamento de Material e Patrimonio</h2>  
 <h3>Prestação de Contas da Verba de Despesas Miudas e de Pronto Pagamento</h3>

<?php 	     

	foreach($direcao_servicos as $key => $value):

?>
 <div class="etec-table-elemento">
 
 <table width="200" border="1" cellpadding="1">
 <caption> 
    <?php echo $value->pc_ano; ?>
  </caption>  
  <tr class="etec-table-title">
    <td  >Mês</td>
    <td >Arquivo</td>
    
  </tr>
<?php 	     
    
			foreach($PrestacaoContasItens->findAll($value->pc_id) as $key_item => $value_item):

?> 
  <tr>
    <td><?php echo $value_item->pci_mes; ?></td>
    <td class="cont-td-doc"><?php if($value_item->pci_caminho == ''){echo '-';}else{?><a target="_blank" href="<?php echo $value_item->pci_caminho; ?>">Download</a><?php } ?></td>   
  </tr>
<?php

			endforeach;

?>
</table>

 
 </div><!--fechamento da class"cont-table"-->
<?php 

	endforeach; 

?>
 
 
 
 </div><!--fehchamento da div geraldas prestacoes de contas-->
<?php 

}

?>

</div><!-- Fechamento da class "main-conteiner"-->


<?php 
include("rodape.php");/*inclusao do rodape do site*/
?>

</body>
</html>