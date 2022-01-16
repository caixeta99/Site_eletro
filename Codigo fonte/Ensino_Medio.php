<?php 

function MyAutoload($className) {    
    $extension =  spl_autoload_extensions();
    require_once (__DIR__ . '/classes/' . $className . $extension);
}

spl_autoload_extensions('.php');
spl_autoload_register('MyAutoload');
  
$Cursos = new Cursos();
$Imagens = new Imagem();
 
$ensino_medio = $Cursos->findAll('S', 'Matutino'); 

	//verifica se há imagem  principal no album
$resultado = $Imagens->findPrincipal($ensino_medio[0]->c_album);
   
if(!$resultado){

		//se não foi encontrada, e chamada uma imagem pré definida
	$imagem = array('','Imagem não encontrada','Imagens/Imagens estaticas/Outras imagens/Imagem_curso.png'); 

}
else{

		//se foi encontrada, a imagem sendo cadastrada não recebe prioridade
	$imagem = array($resultado->i_titulo,$resultado->i_alt,$resultado->i_caminho); 

} 

$texto = explode(' ', $ensino_medio[0]->c_descricao);

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
<link rel="stylesheet" href="Css/etec-style-usuario-rest.css">
<link rel="stylesheet" href="Css/etec-style-usuario-rest-responsible.css">

                                    <!-- titulo da pagina -->
<title><?php echo $ensino_medio[0]->c_titulo; ?> | Eletrô</title>
<!-- css referente a pagina -->

</head>

<body>

<?php 

include("menu.php");/*inclusao do menu do site*/

?>

<div class="main-conteiner"><!--Abertura da class aonde ficara todo o conteudo da pagina -->

 <header class="etec-container-indicator">
  
   <div class="etec-container-indicator-item "><?php echo $ensino_medio[0]->c_titulo; ?>  | <a href="index.php">Eletrô</a> </div>
  
 </header><!-- fechamento da class"container-indicator-->

 <div class="etec-curso-main">
  
  <div class="etec-curso-img "><img src="<?php echo $imagem[2]; ?>" alt="<?php echo $ensino_medio[0]->c_titulo; ?>" title="<?php echo $ensino_medio[0]->c_titulo; ?>" />   </div>
  <div class="etec-curso-text">
  <h2>Informaçoes:</h1>
  <p>
  	<?php 
  	
	if(!(isset($_GET['sinopse']))){
	
  		echo $ensino_medio[0]->c_descricao;
	
	}else{
	
		echo $ensino_medio[0]->c_sinopse;
		
	}
	
	?>
  </p>
  <h2>Duração do curso:</h1>
  <p><?php echo $ensino_medio[0]->c_duracao; ?></p>
  <h2>Período:</h1>
  <p><?php echo $ensino_medio[0]->c_periodo; ?></p>
  </div>
 
 </div><!--fechamneto da pagina "cont-divisor-img-text"-->
 
 
</div><!-- Fechamento da class "main-conteiner"-->


<?php 
include("rodape.php");/*inclusao do rodape do site*/
?>

</body>
</html>