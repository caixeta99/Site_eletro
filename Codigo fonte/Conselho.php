<?php

function MyAutoload($className) {    
    $extension =  spl_autoload_extensions();
    require_once (__DIR__ . '/classes/' . $className . $extension);
}

spl_autoload_extensions('.php');
spl_autoload_register('MyAutoload');
  
$Conselho_Ano = new ConselhoAno();
$MembrosConselho = new Conselho();

	//Pega as informações do conselho
$conselho = $Conselho_Ano->find('');

if(!$conselho){

	die(header('location:index.php'));
	
}
   
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
<link rel="stylesheet" href="Css/etec-style-elementos_especificos.css">

<title>Conselho <?php echo $conselho->coa_ano; ?> | Eletrô</title>



</head>
<body>

<?php 
include("menu.php");/*inclusao do menu do site*/
?>

<div class="main-conteiner"><!--Abertura da class aonde ficara todo o conteudo da pagina -->

 <header class="etec-container-indicator">
  
   <div class="etec-container-indicator-item"> Conselho de Escola <?php echo $conselho->coa_ano; ?> | <a href="index.php">Eletrô</a> </div>
 
 </header><!-- fechamento da class"container-indicator-->
 
 
 
 <div class="etec-conselho etec-title-princip"> 
  <h1>Definição</h1>
  <p>O Conselho de Escola trata-se de um órgão deliberativo integrado por representantes da comunidade escolar e da comunidade extraescolar, cuja composição será:</p>
    <ul>
     <li>pela comunidade escolar:
      <ul>
       <li>Diretor, presidente nato;</li>
       <li>um representante das diretorias de serviços e relações institucionais</li>
       <li>um representante dos professores;</li>
       <li>um representante dos servidores técnico e administrativos;</li>
       <li>um representante dos pais de alunos;</li>
       <li>um representante dos alunos;</li>
       <li>um representante das instituições auxiliares.</li>
      </ul>
     </li>
     <li>pela comunidade extraescolar
      <ul>
       <li>representante de órgão de classe;</li>
       <li>representante dos empresários, vinculado a um dos cursos;</li>
       <li>aluno egresso atuante em sua área de formação técnica;</li>
       <li>representante do poder público municipal;</li>
       <li>representante de instituição de ensino, vinculada a um dos cursos;</li>
       <li>representantes de demais segmentos de interesse da escola.</li>
      </ul>
     </li>
    </ul>
    
    <p>A composição da comunidade extraescolar será de, no mínimo, quatro membros e, no máximo, de sete membros, e os representantes mencionados no inciso I, alíneas de “b” a “g”, serão escolhidos pelos seus pares, e os mencionados no inciso II serão convidados pela Direção da Escola, sendo que todos os representantes cumprirão mandato de um ano, porém, são permitidas reconduções.</p>
   </div><!-- fechamento da class"etec-conselho"-->
  
  
<?php
		
$membros = $MembrosConselho->findAll($conselho->coa_id, 'S');
  
if($membros){  
  
?>

  <div class="etec-composit-consel etec-title-princip etec-table-elemento">
   <h2>Composição do Conselho de Escola eleito para o ano de <?php echo $conselho->coa_ano; ?></h2>
   <table >
<?php 

	foreach($membros as $key => $value):

?>  
  <tr>
    <td><?php echo $value->co_nome; ?></td>
    <td><?php echo $value->co_cargo; ?></td>
  </tr>
<?php 

	endforeach;
	
?>
<tr>
    <td>ATRIBUIÇÕES DO CONSELHO DE ESCOLA</td>
    <td>Todas aquelas previstas no Artigo 11 do Capítulo II do Título II, do Regimento Comum das ETEC´s Do Ceeteps. </td>
</tr>
</table>
</div><!-- fechamento da class"cont-table"-->

</div><!-- fechamento da class"container-text-pad"-->
<?php 

}

?>

<div class="etec-conselho etec-title-princip">
   <h2>Atribuições do Conselho de Escola</h2>
    <ul>
     <li>deliberar sobre: 
      <ul>
       <li>o projeto político-pedagógico da escola; </li>
       <li>as alternativas de solução para os problemas acadêmicos e pedagógicos; </li>
       <li>as prioridades para aplicação de recursos.</li>
      </ul>
     </li>
     <li>estabelecer diretrizes e propor ações de integração da Etec com a comunidade;</li>
     <li>propor a implantação ou extinção de cursos oferecidos pela Etec, de acordo com as demandas locais e regionais e outros indicadores;</li>
     <li>aprovar o Plano Plurianual de Gestão e o Plano Escolar;</li>
     <li>apreciar os relatórios anuais da escola, analisando seu desempenho diante das diretrizes e metas estabelecidas.</li>
    </ul>
   </div>
   <div class="etec-conselho-nur">
     <ul>
       <li>1ºO Conselho de Escola poderá ser convocado pela Direção para manifestar-se sobre outros temas de interesse da comunidade escolar.</li>
       <li>2º - O Conselho de Escola reunir-se-á, ordinariamente, no mínimo, duas vezes a cada semestre e, extraordinariamente, quando convocado pelo seu presidente ou pela maioria de seus membros.</li>
       <li>3º - As reuniões do Conselho de Escola deverão contar com a presença mínima da maioria simples de seus membros.</li>
       <li>4º - Nas decisões a serem tomadas por maioria simples, todos os membros terão direito a voto, cabendo ao diretor o voto de desempate.</li>
      </ul>
     </div>
        
        
   
</div><!--Fechamento da class"container-text-pad"-->  
 
 


  

</div><!-- Fechamento da class "main-conteiner"-->


<?php 
include("rodape.php");/*inclusao do rodape do site*/
?>

</body>
</html>