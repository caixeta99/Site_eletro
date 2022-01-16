<?php

function MyAutoload($className) {    
    $extension =  spl_autoload_extensions();
    require_once (__DIR__ . '/classes/' . $className . $extension);
}

spl_autoload_extensions('.php');
spl_autoload_register('MyAutoload');
  
$Eventos = new Eventos();
$DataEvento = new EventoData();
$Imagens = new Imagem();

if(isset($_GET['A2xZ6MUf35C2M11XZAr45EtUc23DcTZZa89Vsut3Vz24CApfd33DfgHjilA24S34Def53SDSe4g465ZZa32Xs45DDAWM'])){
  	
	$id = $_GET['A2xZ6MUf35C2M11XZAr45EtUc23DcTZZa89Vsut3Vz24CApfd33DfgHjilA24S34Def53SDSe4g465ZZa32Xs45DDAWM'];
	
	    //realiza a busca das informações
    $evento = $Eventos->find($id);
  
    if(!($evento)){

    	die(header('location:eventos.php')); 

    }
	
		//verifica se há imagem  principal no album
	$resultado = $Imagens->findPrincipal($evento->e_album);
		 
	if(!$resultado){
	  
			//se não foi encontrada, e chamada uma imagem pré definida
		$imagem = array('','Imagem não encontrada','Imagens/Imagens estaticas/Outras imagens/Imagem_evento.jpg');
	  
	}
	else{
		  
		  	//se foi encontrada, a imagem sendo cadastrada não recebe prioridade
		$imagem = array($resultado->i_titulo,$resultado->i_alt,$resultado->i_caminho);
	  
	}

}
else{
  	
	die(header('location:eventos.php')); 

}

$texto = explode(' ', $evento->e_descricao);

$metaTag = '';

for($i = 0; $i < count($texto); $i++){

	if( (mb_strlen($metaTag) + mb_strlen($texto[$i]) + 1) <= 157 ){
		
		$metaTag .= ' '.$texto[$i];
		
	}
	else
	{
	
		break;
		
	}
	
}

$metaTag .= '...';
  
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
<meta name="description" content="<?php echo $metaTag; ?>">                                    
                                   <!--- Icone da pagina-->
<link rel="icon" type="imagem/png" href="Imagens/Imagens estaticas/Icones/icone-etec.png">

                                    <!--- Css da pagina-->
<link rel="stylesheet" href="Css/Reset.css">
<link rel="stylesheet" href="Css/etec-style-navigation.css">
<link rel="stylesheet" href="Css/etec-style-navigation-responsible.css">
<link rel="stylesheet" href="Css/etec-style-usuario-escola.css">
<link rel="stylesheet" href="Css/etec-style-usuario-escola-responsible.css">
<link rel="stylesheet" href="Css/etec-style-usuario-rest.css">
<link rel="stylesheet" href="Css/etec-style-usuario-rest-responsible.css">
                                                 <!-- titulo da pagina -->
<title><?php echo $evento->e_titulo; ?> | Eletrô</title>

</head>

<body>

<?php 
include("menu.php");/*inclusao do menu do site*/
?>

<div class="main-conteiner"><!--Abertura da class aonde ficara todo o conteudo da pagina -->


 
<div class="pop_up">
	<div class="fechar-album ">
    	<img src="Imagens/Imagens estaticas/Icones/x.png" />
    </div>
   	<img id="imagem" src="img/1.jpg" >
</div>
<div class="pop_up_fundo">
</div>

 <header class="etec-container-indicator">
  
   <div class="etec-container-indicator-item"><?php echo $evento->e_titulo; ?>  | <a href="index.php">Eletrô</a> </div>
  
  </header><!-- fechamento da class"container-indicator-->

<!--O titulo "Evento iten " no modo responsivo fica muito grande e acaba estourando o limite da pagina por isso for adicionado essa class "cont-text-font-2"que diminui a fonte do texto"-->


  <div class="etec-event-iten etec-title-princip">
     <div class="etec-event-iten-img"><img src="<?php echo $imagem[2]; ?>"  alt="<?php echo $imagem[1]; ?>" title="<?php echo $imagem[0]; ?>"/></div>
     <div class="etec-event-iten-text ">
      <h1>Descrição do evento</h1>
      <p><?php echo $evento->e_descricao; ?></p>
     </div>
   </div><!--fechamento da class"eve-iten"--->

<?php

	$imagens_evento = $Imagens->findAll($evento->e_album, 'S', 'N', 'N');

	if(count($imagens_evento) != 0){

?>
<div class="etec-event-imgs-main">
  <div class="etec-event-imgs-container etec-title-princip ">
   <h1>Imagens</h1>

<?php
  	
		$i = 1;
		foreach($imagens_evento as $key => $value):
				
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

?>   
  
</div><!--fechamento da class"eve-imgs-main"-->
 
<?php

	}

?>

</div><!-- Fechamento da class "main-conteiner"-->


<?php 
include("rodape.php");/*inclusao do rodape do site*/
?>

<script src="js/eventos_items.js"></script>
</body>
</html>