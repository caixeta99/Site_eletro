<?php

function MyAutoload($className) {    
	$extension =  spl_autoload_extensions();
	require_once (__DIR__ . '/classes/' . $className . $extension);
}

spl_autoload_extensions('.php');
spl_autoload_register('MyAutoload');

$Gremios = new Gremio();
$Membros = new ComposicaoGremio();
$Plano_trabalho = new PlanoTrabalhoGremio();
$Imagens = new Imagem();

    //realiza a busca das informações
$gremio = $Gremios->findLast();
	
if(!($gremio)){

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
<link rel="stylesheet" href="Css/etec-style-usuario-informacoes.css">
<link rel="stylesheet" href="Css/etec-style-usuario-informacoes-responsible.css">
<link rel="stylesheet" href="Css/etec-style-elementos_especificos.css">

            <!-- titulo da pagina -->
<title>Grêmio Estudantil <?php echo $gremio->g_ano; ?> | Eletrô</title>
<!-- css referente a pagina -->

</head>
<body>

<?php 
include("menu.php");/*inclusao do menu do site*/
?>



<div class="main-conteiner"><!--Abertura da class aonde ficara todo o conteudo da pagina -->

 <header class="etec-container-indicator">
  
   <div class="etec-container-indicator-item"> Grêmio Estudantil <?php echo $gremio->g_ano; ?>  | <a href="index.php">Eletrô</a> </div>
  
 </header><!-- fechamento da class"container-indicator-->

 <!--O titulo "Gremio estudantil " no modo responsivo fica muito grande e acaba estourando o limite da pagina por isso for adicionado essa class "cont-text-font-1"que diminui a fonte do texto"-->
 
<div class="etec-composit-menbre-gremio">
 <h1>Composição do Grêmio Estudantil</h1>

 
 
<?php

//Verifica se o gremio deseja ou não exibir imagens de seus membros
if($gremio->g_imagens == 'N'){

?>
 <div class="etec-table-reduces etec-table-elemento ">

<table border="1" cellpadding="1" >
	<tr class="etec-table-title etec-table-reduces">
        <td>Cargo</td>
        <td>Nome</td>
        <td>Modalidade cursada</td>  
	</tr>

<?php 

}
else{

	$i = 1;	
	
}

foreach($Membros->findAll($gremio->g_id) as $key => $value):

		//Verifica se o gremio deseja ou não exibir imagens de seus membros
	if($gremio->g_imagens == 'S'){
	
			//verifica se há imagem  principal no album
		$resultado = $Imagens->find($value->cg_imagens);
	
		if(!$resultado){
		
				//se não foi encontrada, e chamada uma imagem pré definida
			$imagem = array('','Imagem não encontrada','Imagens/Imagens estaticas/Outras imagens/icone_de_rosto.jpg'); 
	
		}
		else{
	
				//se foi encontrada, a imagem sendo cadastrada não recebe prioridade
			$imagem = array($resultado->i_titulo,$resultado->i_alt,$resultado->i_caminho); 
	
		}
	
		if($i%2 == 1){

?>  

<div class="etec-composit-gremir  ">
<?php 

		} 

?>
  <div class="etec-composit-gremir-unit   ">
    <div class="etec-composit-gremir-funcao etec-gremio-title-funcao"><?php echo $value->cg_funcao; ?></div>
    <div><img src="<?php echo $imagem[2]; ?>" alt="<?php echo $imagem[1]; ?>" title="<?php echo $imagem[0]; ?>" /></div>
    <div class="etec-composit-gremir-inf"><?php echo $value->cg_nome; ?></div>
    <div class="etec-composit-gremir-inf ">Modalidade cursada: <?php echo $value->cg_modalidade; ?></div>
  </div><!--fechamento da classe"composit-gremir-unit"-->  
<?php

		if($i%2 == 0){
	
?>
</div><!--fechamento da classe"etec-composit-gremir-unit"-->
<?php

		}

 		$i++; 
 	
	}
	else{

?>

	<tr class="etec-table-reduces">
    	<td><?php echo $value->cg_funcao; ?></td>
    	<td><?php echo $value->cg_nome; ?></td>
        <td><?php echo $value->cg_modalidade; ?></td>
	</tr>
<?php

	}
	
endforeach;

		//Verifica se o gremio deseja ou não exibir imagens de seus membros
if($gremio->g_imagens == 'S'){

	if($i%2 == 0){
	
?>  
</div>
<?php

	}
		
}
else{

?>  

</table>
</div>
<?php

}

?>
</div><!--fechamento da class"etec-composit-menbre-gremio"-->

 


<div class="etec-composit-gremir-clear etec-gremio-plano-trabalho">
 <h1>Plano de trabalho proposto pelo  Grêmio Estudantil</h1>
<?php 

    //realiza a busca das informações
$resultado = $Plano_trabalho->findAll($gremio->g_id, 'S', 'Cultura');
	
if($resultado){
  
?>
<div class="composit-gremir-plano-topico"> 
   <h2 class="">Cultura</h2>
   <ul class="cont-ul-li-cicle cont-marg-resp-left5">
<?php 
	
	foreach($resultado as $key => $value):
		  	  
?>  
    <li><?php echo $value->pt_descricao; ?></li>
<?php 

	endforeach;

?>
  </ul>
 </div><!--fechamento da classe"composit-gremir-unit"-->
</div><!--fechamento da classe"composit-gremir"-->
<?php 

}

?>

<?php 

    //realiza a busca das informações
$resultado = $Plano_trabalho->findAll($gremio->g_id, 'S', 'Esporte');
	
if($resultado){
  
?>
<div class="composit-gremir-plano-topico">
   <h2 class="">Esporte</h2>
   <ul class="cont-ul-li-cicle cont-marg-resp-left5">
<?php 
	
	foreach($resultado as $key => $value):
		  	  
?>  
    <li><?php echo $value->pt_descricao; ?></li>
<?php 

	endforeach;

?>
 </ul>
 </div><!--fechamento da classe"composit-gremir-unit"-->
</div><!--fechamento da classe"composit-gremir"-->
<?php 
	
} 

?>

<?php 

    //realiza a busca das informações
$resultado = $Plano_trabalho->findAll($gremio->g_id, 'S', 'Política');
	
if($resultado){
  
?>
<div class="composit-gremir-plano-topico">
   <h2 class="">Política</h2>
   <ul class="cont-ul-li-cicle cont-marg-resp-left5">
<?php 
	
	foreach($resultado as $key => $value):
		  	  
?>  
    <li><?php echo $value->pt_descricao; ?></li>
<?php 

	endforeach;

?>
  </ul>
 </div><!--fechamento da classe"composit-gremir-unit"-->
</div><!--fechamento da classe"composit-gremir"-->
<?php 

}

?>

<?php 

    //realiza a busca das informações
$resultado = $Plano_trabalho->findAll($gremio->g_id, 'S', 'Social');
	
if($resultado){
  
?>
<div class="composit-gremir-plano-topico ">
   <h2 class="">Social</h2>
   <ul class="cont-ul-li-cicle cont-marg-resp-left5">
<?php 
	
	foreach($resultado as $key => $value):
		  	  
?>  
    <li><?php echo $value->pt_descricao; ?></li>
<?php 

	endforeach;

?>
  </ul>
 </div><!--fechamento da classe"composit-gremir-unit"-->
</div><!--fechamento da classe"composit-gremir"-->
<?php 

}

?>

<?php 

    //realiza a busca das informações
$resultado = $Plano_trabalho->findAll($gremio->g_id, 'S', 'Comunicação');
	
if($resultado){
  
?>
<div class="composit-gremir-plano-topico ">
   <h2 class="">Comunicação</h2>
   <ul class="cont-ul-li-cicle cont-marg-resp-left5">
<?php 
	
	foreach($resultado as $key => $value):
		  	  
?>  
    <li><?php echo $value->pt_descricao; ?></li>
<?php 

	endforeach;

?>
  </ul>
 </div><!--fechamento da classe"composit-gremir-unit"-->
</div><!--fechamento da classe"composit-gremir"-->
<?php 

}

?>
 
</div>

 <div class="etec-gremio-time-full">
   <h1>Foto da Diretoria do Grêmio Estudantil</h1>
<?php

	//verifica se há imagem  principal no album
$resultado = $Imagens->findPrincipal($gremio->g_album);
   
if(!$resultado){

		//se não foi encontrada, e chamada uma imagem pré definida
	$imagem = array('','Imagem não encontrada','Imagens/Imagens estaticas/Outras imagens/gremio_estudantil.jpg'); 

}
else{

		//se foi encontrada, a imagem sendo cadastrada não recebe prioridade
	$imagem = array($resultado->i_titulo,$resultado->i_alt,$resultado->i_caminho); 

}

?>   

   <div class="etec-gremio-time-img"><img src="<?php echo $imagem[2]; ?>" alt="<?php echo $imagem[1]; ?>" title="<?php echo $imagem[0]; ?>"></div>
   <!--<div class="etec-gremio-time-rede"><div class="cont-title-left">Redes Socias</div>
    <div class="etec-gremio-time-rede-icon cont-a-none"><a href=""><img src="Imagens/Imagens estaticas/Icones/faceboo preto 48px.png"></a></div>
    <div class="etec-gremio-time-rede-icon cont-a-none"><a href=""><img src="Imagens/Imagens estaticas/Icones/instagram-48.png"></a></div>-->
    
   </div>
 </div>
</div><!-- Fechamento da class "main-conteiner"-->


<?php 
include("rodape.php");/*inclusao do rodape do site*/
?>


</body>
</html>