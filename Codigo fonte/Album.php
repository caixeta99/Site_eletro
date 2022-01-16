<?php

function MyAutoload($className) {    
    $extension =  spl_autoload_extensions();
    require_once (__DIR__ . '/classes/' . $className . $extension);
}

spl_autoload_extensions('.php');
spl_autoload_register('MyAutoload');
  
$Imagens = new Imagem();
$Albuns = new Album();


  
   
	//realiza a busca das informações
$album = $Albuns->find(72, 0);

if(!($album)){

	header('location:erro 404.php'); 

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
<link rel="stylesheet" href="Css/etec-style-usuario-rest.css">
<link rel="stylesheet" href="Css/etec-style-usuario-rest-responsible.css">
<link rel="stylesheet" href="Css/etec-style-usuario-escola.css">
<link rel="stylesheet" href="Css/etec-style-usuario-escola-responsible.css">
                                 <!-- titulo da pagina --->

<title><?php echo $album->a_titulo; ?> | Eletrô</title>

</head>

<body>

<?php 
include("menu.php");/*inclusao do menu do site*/
?>


<div class="main-conteiner"><!--Abertura da class aonde ficara todo o conteudo da pagina -->

 <div class="pop_up">
   <div class="fechar-album "><img src="Imagens/Imagens estaticas/Icones/x.png" /></div>
   <img id="imagem" src="img/1.jpg" >
</div>
<div class="pop_up_fundo">
</div>

 <header class="etec-container-indicator">
  
   <div class="etec-container-indicator-item "><?php echo $album->a_titulo; ?> | <a href="index.php">Eletrô</a> </div>
  
 </header><!-- fechamento da class"container-indicator-->
 

 <div class="etec-event-imgs-main">
  <div class="etec-event-imgs-container etec-title-princip">
   <h1><?php echo $album->a_titulo; ?></h1>
 

<?php

$resultado = $Imagens->findAll($album->a_id, 'S', 'S', 'N');

if(!($resultado)){

	echo '<div class="albun_title_nul_img">Nenhuma imagem Disponivel.</div>';

}
else
{

	$i = 1;
	foreach($resultado as $key => $value):

		if($i == 41){
			
?>
 
	</div>
 	<div class="eve-imgs-unit-mais">
  
<?php 

	}
	   
?>
   <div class="etec-event-imgs-unit "><img src="<?php echo $value->i_caminho; ?>" title="<?php echo $value->i_titulo; ?>" alt="<?php echo $value->i_alt; ?>"></div>
<?php
	
		$i++;
	
	endforeach;

?>
</div>
<?php

	if($i >= 41){
	
?>
   
  <div class="etec-btn-img">
   <div class="etec-event-imgs-btn">Ver mais</div>
  </div> 
  
<?php 

	} 
	
}

?>  
</div><!--fechamento da class"eve-imgs-main"-->
 
 
</div><!-- Fechamento da class "main-conteiner"-->


<?php 
include("rodape.php");/*inclusao do rodape do site*/

?>

<script src="js/eventos_items.js"></script>
</body>
</html>
