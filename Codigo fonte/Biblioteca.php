<?php 

function MyAutoload($className) {    
    $extension =  spl_autoload_extensions();
    require_once (__DIR__ . '/classes/' . $className . $extension);
}

spl_autoload_extensions('.php');
spl_autoload_register('MyAutoload');

$Bibliotecario = new Bibliotecario();
$BibliotecaHorario = new BibliotecaHorario();

?>
<!doctype html>
<html><head>

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
<link rel="stylesheet" href="Css/etec-style-usuario-servicos.css">
<link rel="stylesheet" href="Css/etec-style-usuario-servicos-responsible.css">
<link rel="stylesheet" href="Css/etec-style-elementos_especificos.css">

                                           <!-- titulo da pagina -->
<title>Biblioteca | Eletrô</title>

</head>

<body>

<?php 

include("menu.php");/*inclusao do menu do site*/

?>

<div class="main-conteiner"><!--Abertura da class aonde ficara todo o conteudo da pagina -->

 <header class="etec-container-indicator">
  
   <div class="etec-container-indicator-item">Biblioteca | <a href="index.php">Eletrô</a> </div>
  
 </header><!-- fechamento da class"container-indicator-->
 
 
 

  
  
  
  
  
  <div class="etec-biblioteca-text">
   <p>A Biblioteca da Eletrô vem a muitos anos contribuindo para a educação de jovens para um mundo de oportunidades nesses tempos competitivos.</p>
   <p>O acervo é formado por livros, obras de referência (dicionários, enciclopédias, Atlas, etc.), livros técnicos (Eletrônica, Eletrotécnica, Informática, Mecatrônica, etc) revistas, jornais, vídeos VHS e DVDs e mapas geográficos..</p>
   <P>Além de grande acervo, a biblioteca oferece acesso à internet através de computadores disponíveis para uso dos alunos,onde esses podem realizar pesquisas e trabalhos escolares..</P>
   <p>A biblioteca está sempre adquirindo livros novos e especialmente lançamentos.</p>
   
  </div>
  
   <div class="etec-biblioteca etec-title-princip">
  
   <h2>Normas para utilização dos computadores</h2>
   <div class="etec-biblioteca-pc">
    <h3>Prezado(a) Aluno(a), para uso dos computadores da biblioteca devem ser respeitadas as seguintes regras:</h3>
    <ul>
     <li>a utilização será permitida somente após a realização de cadastro junto ao Responsável pela Biblioteca;</li>
     <li>uso permitido exclusivamente para fins escolares, tais como realização de trabalhos, pesquisas entre outros;</li>
     <li>não são permitidos acessos a salas de bate-papo (MSN, Orkut, Twitter, Facebook, etc)</li>
     <li>não é permitida a utilização de qualquer tipo de jogo;</li>
     <li>o desrespeito a estas regras sujeita os infratores às penalidades estabelecidas no Regimento Comum das ETEC’s do Ceeteps. </li>
   </ul>
 
  <p>Mococa, outubro de 2015</p>
  <p>A Direção</p>
  
  </div>
  
  </div><!--fechamento da class"cont-biblioteca"-->
<?php

$bibliotecarios = $Bibliotecario->findAll('S');

if($bibliotecarios){

?>  
<div class="etec-biblioteca-horarios etec-title-princip">

<h2>Horario de funcionamento da biblioteca</h2>

<?php	  
		//busca os funcionarios
	foreach($bibliotecarios as $key => $value):
 
?>



<div class="etec-table-elemento">
<table  border="1" cellpadding="1">
  <caption>
   Nome: <?php echo $value->b_nome." - ".$value->b_cargo; ?>
  </caption>
  <tr class="etec-table-title">
    <td>Dia / período</td>
    <td>Manhã</td>
    <td>Tarde</td>
    <td>Noite</td>
    
  </tr>
<?php

		$dia = array('Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta');
	
		for($i = 0; $i < 5; $i++){
?>  
  <tr>
      <td ><?php echo ($i+2); ?>º</td>
<?php 

			foreach($BibliotecaHorario->findAllDia($value->b_id, $dia[$i]) as $key_h => $horario):

?>
  <td class="doc-reps cont-td-doc"><?php if(($horario->bh_horario_i != '')and($horario->bh_horario_f != '')){ echo date("H:i",strtotime($horario->bh_horario_i)); ?> as <?php echo date("H:i",strtotime($horario->bh_horario_f));}else{ echo '-';} ?></td>
<?php 
		
			endforeach;
		
?>
  </tr>
<?php 

		} 

?> 
  
</table>
</div><!-- fechamento da class"cont-table"-->
<?php 

	endforeach;
 
?>
</div>  

<?php 

} 

?> 

<div class="etec-title-princip etec-biblioteca-info">
  <h2>Click para realizar o download dos documentos referentes a esta página</h2>
  <div class="etec-donwload-unit-title"><a href="Documentacao/Biblioteca/Biblioteca.docx" ><img src="Imagens/Imagens estaticas/Botoes de Download/Normas da Biblioteca.jpg" alt="Normas da Biblioteca " title="Normas da Biblioteca"></a></div>
  <div class="etec-donwload-unit-title"><a href="Documentacao/Biblioteca/Regulamento de Funcionamento da Biblioteca.pdf" target="_blank" ><img src="Imagens/Imagens estaticas/Botoes de Download/Regulamento da biblioteca.jpg" alt="Regulamento da biblioteca" title="Regulamento da biblioteca"></a></div>
</div><!--fechamento da class"cont-links"-->


  
  
</div><!-- Fechamento da class "main-conteiner"-->


<?php 
include("rodape.php");/*inclusao do rodape do site*/
?>

</body>
</html>