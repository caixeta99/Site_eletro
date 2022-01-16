<?php 

function MyAutoload($className) {    
    $extension =  spl_autoload_extensions();
    require_once (__DIR__ . '/classes/' . $className . $extension);
}

spl_autoload_extensions('.php');
spl_autoload_register('MyAutoload');
  
$Cursos = new Cursos();
$Imagens = new Imagem();


if(isset($_GET['A2xZ6MUf35C2M11XZAr45EtUc23DcTZZa89Vsut3Vz24CApfd33DfgHjilA24S34Def53SDSe4g465DvbAZZ45f'])){
  	
	$id = $_GET['A2xZ6MUf35C2M11XZAr45EtUc23DcTZZa89Vsut3Vz24CApfd33DfgHjilA24S34Def53SDSe4g465DvbAZZ45f'];
  
  	   //realiza a busca das informações
    $curso = $Cursos->find($id);
	
    if(!($curso)){

    	die(header('location:index.php')); 

    }
	 
	if($curso->c_periodo == 'Matutino'){
		
		die(header('location:index.php')); 
		
	}	
		
		//verifica se há imagem  principal no album
	$resultado = $Imagens->findPrincipal($curso->c_album);
	   
	if(!$resultado){
	
			//se não foi encontrada, e chamada uma imagem pré definida
		$imagem = array('','Imagem não encontrada','Imagens/Imagens estaticas/Outras imagens/Imagem_curso.png'); 
	
	}
	else{
	
			//se foi encontrada, a imagem sendo cadastrada não recebe prioridade
		$imagem = array($resultado->i_titulo,$resultado->i_alt,$resultado->i_caminho); 
	
	}
  
}
else{
	
	die(header('location:index.php')); 

}  

$texto = explode(' ', $curso->c_descricao);

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
<html><head>
 
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

<title><?php echo $curso->c_titulo; ?> | Eletrô</title>

</head>

<body>

<?php 
include("menu.php");/*inclusao do menu do site*/
?>

<div class="main-conteiner"><!--Abertura da class aonde ficara todo o conteudo da pagina -->

 <header class="etec-container-indicator">
  
   <div class="etec-container-indicator-item"><?php echo $curso->c_titulo; ?> | <a href="index.php">Eletrô</a> </div>
  
 </header><!-- fechamento da class"container-indicator-->
 <!--O titulo "Curso iten" no modo responsivo fica muito grande e acaba estourando o limite da pagina por isso for adicionado essa class "cont-text-font-1"que diminui a fonte do texto"-->
 
 
  <div class="etec-curso-main">
  
  <div class="etec-curso-img "><img src="<?php echo $imagem[2]; ?>"  alt="<?php echo $curso->c_titulo; ?>" title="<?php echo $curso->c_titulo; ?>"/></div>
  <div class="etec-curso-text">
  <h2>Informaçoes:</h1>
  <p>
	<?php 
    
    if(!(isset($_GET['sinopse']))){
    
        echo $curso->c_descricao; 
    
    }else{
      
      	echo $curso->c_sinopse;
      
    }
    
    ?>
  </p>
  <h2>Duração do curso:</h1>
  <p><?php echo $curso->c_duracao; ?></p>
  <h2>Período:</h1>
  <p><?php echo $curso->c_periodo; ?></p>
  </div>
 
 </div><!--fechamneto da pagina "cont-divisor-img-text"-->
 
 
 
 
</div><!-- Fechamento da class "main-conteiner"-->


<?php 
include("rodape.php");/*inclusao do rodape do site*/
?>

</body>
</html>