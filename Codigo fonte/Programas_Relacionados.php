<?php

function MyAutoload($className) {    
    $extension =  spl_autoload_extensions();
    require_once (__DIR__ . '/classes/' . $className . $extension);
}

spl_autoload_extensions('.php');
spl_autoload_register('MyAutoload');
  
$ProgramasRelacionados = new ProgramasRelacionados();
$Imagens = new Imagem();

if(isset($_GET['A2xZ6MUf35C2M11XZAr45EtUc23DcTZZa89Vsut3Vz24CApfd33DfgHjilA24S34Xc543Cvgd123Cdasfhj5yYteF57'])){
  	
	$id = $_GET['A2xZ6MUf35C2M11XZAr45EtUc23DcTZZa89Vsut3Vz24CApfd33DfgHjilA24S34Xc543Cvgd123Cdasfhj5yYteF57'];
	
        //realiza a busca das informações
    $programa = $ProgramasRelacionados->find($id);
	
    if(!($programa)){

    	die(header('location:index.php')); 

    }
	
		//verifica se há imagem  principal no album
	$resultado = $Imagens->findPrincipal($programa->p_album);
	
	if(!$resultado){
		  
			//se não foi encontrada, e chamada uma imagem pré definida
		$imagem = 'Imagens/Imagens estaticas/Outras imagens/Imagem_evento.jpg';
	  
	}
	else{
	
			//se foi encontrada, a imagem sendo cadastrada não recebe prioridade
		$imagem = array($resultado->i_titulo,$resultado->i_alt,$resultado->i_caminho); 
	
	}
	
}
else{
  
  	die(header('location:index.php')); 

}
  
?>
<!doctype html>
<html><head>

<?php

include("gogle_anlistc.php");

?>

<meta charset="utf-8">
<meta http-equiv="Content-Type" content="text/html; charset=utf8" />
<meta name="viewport" content="width=device-width,initial-scale=1"/>
<meta name="keywords" content="Escola Tecnica , escola tecnica , ensino medio integrado ao tecnico , ensino medio , Ensino medio , Mococa , mococa , Mococa/sp , Etec , ETEC , Ete , Etec mococa, Eletro mococa, Eletro , ELETRO , letro , vestibulinho, vestibular , Profissionalização, Profissionalizacao ,cps"/>
                                    
                                   <!--- Icone da pagina-->
<link rel="icon" type="imagem/png" href="Imagens/Imagens estaticas/Icones/icone-etec.png">
 <!--- Css da pagina-->
<link rel="stylesheet" href="Css/Reset.css">
<link rel="stylesheet" href="Css/etec-style-navigation.css">
<link rel="stylesheet" href="Css/etec-style-navigation-responsible.css">
<link rel="stylesheet" href="Css/etec-style-index.css">
<link rel="stylesheet" href="Css/etec-style-index-responsible.css">

                               <!-- titulo da pagina -->
<title><?php echo $programa->p_nome; ?> | Eletro</title>





</head>
<body>

<?php 
include("menu.php");/*inclusao do menu do site*/
?>

<div class="main-conteiner"><!--Abertura da class aonde ficara todo o conteudo da pagina -->

 <div class="etec-container-indicator">
  
   <div class="etec-container-indicator-item"><?php echo $programa->p_nome; ?> | <a href="index.php">Eletrô</a> </div>
  
 </div><!-- fechamento da class"etec-container-indicator-->
 
<div class="etec-program-main">
 <div class="etec-program-main-img" ><img src="<?php echo $imagem[2]; ?>" alt="<?php echo $programa->p_nome; ?>" title="<?php echo $imagem[0]; ?>" /></div><!---div que vai armazenar a imagem do progrma relacionado a aescola-->
 <div class="etec-program-main-text etec-title-princip">
  <h1><?php echo $programa->p_nome; ?></h1>
  <p><?php echo $programa->p_descricao; ?> <p>
 <div></div>
 
 <div class="etec-program-unit-link"><a href="<?php echo $programa->p_link; ?>"><div class="">Acessar <?php echo $programa->p_nome; ?></div></a></div><!--classe reposnavel por armazenar um link para o referido programa que possui vinculo com a escola  -->
</div><!--fechamento da classe "program-main-texte"-->
 
 </div><!--fechamento da classe "program-main"-->


<?php

$qtd_imagens = $Imagens->CountImagens($programa->p_album, 'S');
	
if($qtd_imagens->Quantidade > 0){

?> 
<div class="etec-program-main-imagens etec-title-princip">
 <h1>Imagens do <?php echo $programa->p_nome; ?></h1>


 <div class="etec-program-main-imagens-img">
<?php

	foreach($Imagens->findAll($programa->p_album, 'S', 'N', 'N') as $key => $value):

?>  
   <div class="etec-program-main-imagens-img-unit"><img src="<?php echo $value->i_caminho; ?>" title="<?php echo $value->i_titulo; ?>" alt="<?php echo $value->i_alt; ?>"></div>
<?php 

	endforeach;   
 
?> 
 </div><!--fechamento da classe "program-main-imagens-img"-->
</div><!--fechamneto da class"program-main-imagens-->
<?php 

}

?> 
 

</div><!-- Fechamento da class "main-conteiner"-->


<?php 
include("rodape.php");/*inclusao do rodape do site*/
?>


</body>
</html>