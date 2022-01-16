<?php 

function MyAutoload($className) {    
    $extension =  spl_autoload_extensions();
    require_once (__DIR__ . '/classes/' . $className . $extension);
}

spl_autoload_extensions('.php');
spl_autoload_register('MyAutoload');
  
$Cursos = new Cursos();
$Imagens = new Imagem();

?>
<!doctype html>
<html>
<head>
      
      <?php

include("gogle_anlistc.php");

?>                             <!-- meta tages da pagina -->
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

                                <!-- titulo da pagina -->
<title>Cursos Integrados | Eletrô</title>

</head>

<body>

<?php 

include("menu.php");/*inclusao do menu do site*/

?>

<div class="main-conteiner"><!--Abertura da class aonde ficara todo o conteudo da pagina -->

 <header class="etec-container-indicator">
  
   <div class="etec-container-indicator-item">Cursos Integrados | <a href="index.php">Eletrô</a> </div>
  
 </header><!-- fechamento da class"container-indicator-->

<!--O titulo "Cursos inegrados " no modo responsivo fica muito grande e acaba estourando o limite da pagina por isso for adicionado essa class "cont-text-font-1"que diminui a fonte do texto"-->
<?php    

foreach($Cursos->findAll('S', 'Diurno') as $key => $value):
	
		//verifica se há imagem  principal no album
	$resultado = $Imagens->findPrincipal($value->c_album);
	   
	if(!$resultado){
	
			//se não foi encontrada, e chamada uma imagem pré definida
		$imagem = array('','Imagem não encontrada','Imagens/Imagens estaticas/Outras imagens/Imagem_curso.png'); 
	
	}
	else{
	
			//se foi encontrada, a imagem sendo cadastrada não recebe prioridade
		$imagem = array($resultado->i_titulo,$resultado->i_alt,$resultado->i_caminho); 
	
	}
		
?> 
<div class="etec-curso-integrados-main">
 <div class="etec-curso-integrado-contant">
  <div class="etec-cont-backgroud etec-curso-backgroud etec-curso-integrad-unit">
   <div class="">
    <h1 class="etec-curso-integrad-unit-title"><?php echo $value->c_titulo; ?></h1>
    <div class="etec-curso-integrad-unit-img"><img src="<?php echo $imagem[2]; ?>" alt="<?php echo $value->c_titulo; ?>" title="<?php echo $value->c_titulo; ?>" /></div>
    <div class="etec-curso-integrad-unit-text">
     <h1 class=""><?php echo $value->c_titulo; ?></h1>
     <p><?php echo $value->c_sinopse; ?></p>
     <div class="etec-curso-integrad-ler-mais"><a href="<?php  echo 'Cursos?A2xZ6MUf35C2M11XZAr45EtUc23DcTZZa89Vsut3Vz24CApfd33DfgHjilA24S34Def53SDSe4g465DvbAZZ45f='.$value->c_id; ?>">Ler Mais</a></div>
    </div><!--fechamento da class"curso-integrad-unit-text"-->
   </div><!--fechamento da class"curso-backgroud"-->
  </div><!--fechamento da class"curso-integrad-unit"-->
 </div><!--fechamento da class"curso-integrad-contante"-->
<?php

endforeach;

?>
  
 </div><!--fechamento da class"curso-integrad-main"-->
 
</div><!-- Fechamento da class "main-conteiner"-->


<?php 
include("rodape.php");/*inclusao do rodape do site*/
?>

</body>
</html>