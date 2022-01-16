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
 
                                                  <!-- titulo da pagina  -->
<title>Eventos | Eletrô</title>

</head>
<body>

<?php 

include("menu.php");/*inclusao do menu do site*/

?>

<div class="main-conteiner"><!--Abertura da class aonde ficara todo o conteudo da pagina -->

 <header class="etec-container-indicator">
  
   <div class="etec-container-indicator-item ">Eventos  | <a href="index.php">Eletrô</a> </div>
  
 </header><!-- fechamento da class"container-indicator-->

<?php    

$mes_nome = array('Janeiro', 'Fevereiro', 'Marco', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro');

$evento = $Eventos->findAll('S', 'N');

if($evento){

	$ano = 0;   
	foreach($evento as $key => $value):
	  
			//pega o ano do evento
		$data_ev = explode('-',$value->data);
		$ano_aux = $data_ev[0];
			
			   //Salva o ano, caso foa primeira vez
		if($ano == 0){
			
			$ano = $ano_aux;

?> 
                                          <!-- ano-->
    <div class="etec-eve-ano etec-title-princip">
    	<h2><?php echo $ano; ?></h2>
    <div class="etec-eve-bloque"> 
<?php 
		
		} 
		
		 //verifica se há imagem  principal no album
		$resultado = $Imagens->findPrincipal($value->e_album);
		 
		if(!$resultado){
		
				//se não foi encontrada, e chamada uma imagem pré definida
			$imagem = array('','Imagem não encontrada','Imagens/Imagens estaticas/Outras imagens/Imagem_evento.jpg');
		
		}
		else{
		
				//se foi encontrada, a imagem sendo cadastrada não recebe prioridade
			$imagem = array($resultado->i_titulo,$resultado->i_alt,$resultado->i_caminho);
		
		}
			
		$mes = 0;
		$data_evento = '';
			//organiza as datas
		foreach($DataEvento->findAll($value->e_id, 'S') as $key_data => $value_data):
			
			$data = explode('-',$value_data->de_data);
			if(($mes != $data[1])and($mes != 0)){
				
				$data_evento .= " de ".$mes_nome[($mes-1)]." / ";	    
				$data_evento .= $data[2];
			
			}
			else{	   
				
				if($mes != 0){
				
					$data_evento .= ", ";
				
				}
				$data_evento .= $data[2];
				
			}
			
			$mes = $data[1];
				 
		endforeach;
		
		$data_evento .= " de ".$mes_nome[($mes-1)];
	
			//verifica o ano para posicionar o conteiner
		if($ano != $ano_aux){ 
			
			$ano = $ano_aux;
?> 
           </div><!--fechamento da div"eve-bloque"--> 
         </div><!-- div que ira armazenar toda a programaçao dos eventos de um determinado ano-->                                   
                       <!-- ano-->
         <div class="etec-eve-ano etec-title-princip">
          <h2><?php echo $ano; ?></h2>
          <div class="etec-eve-bloque"> 
<?php 

		}
	
?> 
    
   <div class="etec-eve-content-unit etec-even-backgroud">
    <div class="etec-eve-content-unit-img"><img src="<?php echo $imagem[2]; ?>"  alt="<?php echo $imagem[1]; ?>" title="<?php echo $imagem[0]; ?>"/>  </div>
    <div class="etec-eve-content-unit-texte">
    <h1><?php echo $value->e_titulo; ?></h1>
    <h2><?php echo $data_evento ?></h2>
    <p><?php echo $value->e_sinopse; ?></p>
    <div class="etec-eve-content-unit-ler "><a href="Evento_Item?A2xZ6MUf35C2M11XZAr45EtUc23DcTZZa89Vsut3Vz24CApfd33DfgHjilA24S34Def53SDSe4g465ZZa32Xs45DDAWM=<?php echo $value->e_id ?>"><div class="eve-content-unit-ler-mais cont-btn">Ler Mais</div></a></div>
    </div><!--fechamento da class"eve-content-unit-texte"-->
   </div><!--fechamento da class"eve-content-unit"-->
   
        
<?php 

	endforeach;

?> 
   </div><!--fechamento da div"eve-bloque"--> 
   </div><!-- div que ira armazenar toda a programaçao dos eventos de um determinado ano-->         
<?php 

} 

?>      


                                     
                                                                          
</div><!-- Fechamento da class "main-conteiner"-->


<?php 
include("rodape.php");/*inclusao do rodape do site*/
?>

</body>
</html>