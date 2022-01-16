<?php

function MyAutoload($className) {    
    $extension =  spl_autoload_extensions();
    require_once (__DIR__ . '/classes/' . $className . $extension);
}

spl_autoload_extensions('.php');
spl_autoload_register('MyAutoload');
  
$Eventos = new Eventos();
$DataEvento = new EventoData();
$ProgramasRelacionados = new ProgramasRelacionados();
$Cursos = new Cursos();
$Data = new CalendarioData();
$Avisos = new Avisos();
$Imagens = new Imagem();

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
<meta name="description" content="A vários anos a ETEC: ELETRÔ - João Baptista De Lima Figueiredo vem proporcionado ensino de qualidade a custo zero, contando com um grande aparato como: quadra esportiva , auditório , refeitório , laboratórios 100% equipados e internet disponível para todos os alunos. além de possuir grande taxa de aprovação nos principais vestibulares">
<meta name="keywords" content="Escola Tecnica , escola tecnica , ensino medio integrado ao tecnico , ensino medio , Ensino medio , Mococa , mococa , Mococa/sp , Etec , ETEC , Ete , Etec mococa, Eletro mococa, Eletro , ELETRO , letro , vestibulinho, vestibular , Profissionalização, Profissionalizacao ,cps"/>
                                    
                                   <!--- Icone da pagina-->
<link rel="icon" type="imagem/png" href="Imagens/Imagens estaticas/Icones/icone-etec.png">

                                         <!--- Css da pagina-->
<link rel="stylesheet" href="Css/Reset.css">
<link rel="stylesheet" href="Css/etec-style-navigation.css">
<link rel="stylesheet" href="Css/etec-style-navigation-responsible.css">
<link rel="stylesheet" href="Css/etec-style-index.css">
<link rel="stylesheet" href="Css/etec-style-index-responsible.css">
<!-- titulo da pagina-->


<title>ELETRÔ - João Baptista De Lima Figueiredo</title>


</head>

<body>

<?php 

include("menu.php");/*inclusao do menu do site*/

?>

<div class="main-conteiner"><!--Abertura da class aonde ficara todo o conteudo do site -->


<div class="etec-title-princip etec-event-content-main ">
 
    <div class="etec-event-index-rep"><h1>Últimos eventos</h1></div> 

 <div class="etec-event-content-list">
   <h1>Últimos eventos</h1>
 <?php 
	  

$mes_nome = array('Jan', 'Fev', 'Mar', 'Abr', 'Maio', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez');

$evento = $Eventos->findAll('S', 'S');

if($evento){

	$i = 1;
	foreach($evento as $key => $value):
			 
			//verifica se há imagem  principal no album
	  	$resultado = $Imagens->findPrincipal($value->e_album);
		 
		if(!$resultado){
		  
				//se não foi encontrada, e chamada uma imagem pré definida
			$imagem = 'Imagens/Imagens estaticas/Outras imagens/Imagem_evento.jpg';
		  
		}
		else{
		 
			  	//se foi encontrada, a imagem sendo cadastrada não recebe prioridade
			$imagem = $resultado->i_caminho;
		  
		}
		    
		$data = explode('-',$value->data);	 
		?>  
        
   <div class="etec-eventos_index" id_ev="<?php echo $value->e_id; ?>" imagem="<?php echo $imagem; ?>" id="ev_<?php echo $i; ?>">     
   <div class="etec-event-content-list-unit "  >
    <div class="etec-event-content-list-unit-dia">
     <div class="etec-event-content-list-unit-dia-dia"><?php echo $data[2]; ?></div>
     <div class="etec-event-content-list-unit-dia-mes"><?php echo $mes_nome[($data[1]-1)]; ?></div>
    </div>
    <div class="etec-event-content-list-unit-info"><?php echo $value->e_titulo; ?></div>
   </div>

   </div>

<?php
	   
		$i++;

	endforeach; 

?>
   
   
   <div class="etec-event-content-list-ver ">
    <a href="Eventos">
     <div class="etec-event-content-list-link">
      <div class="etec-event-content-mais"><div class="etec-event-boli">+</div></div>
      <div class="etec-event-content-name">Lista completa</div>
     </div>
    </a>
   </div>
   
 </div><!--fechamento da class"event-content-list"-->
 <a href="" class="link_evento etec-event-inde-link">
 <div class="etec-event-content-img">
   <img src=""/>
   <div class="etec-event-title"></div>
 </div><!--fechamento da class"event-content-img"-->
</a>
<div class="etec-event-content-list-pont">
<?php 

	for($j=1;$j<=($i-1);$j++){ 

?>
 <div class="etec-event-content-list-pont-unit" evento="ev_<?php echo $j; ?>"></div>
<?php 

	} 

?>
</div>
<?php 

}

?>


</div><!-- fechamento da class"event-content-main"  ,essa classe vai amazenar todos-->


<?php 

    //Verifica quantos programas ativos existem
$resultado = $ProgramasRelacionados->findCount();

if(!($resultado)){

	die("Falha na consulta");

}

if($resultado->qtd > 0){
	
?>

<div class="<?php if($resultado->qtd == 1){ echo 'etec-main-conteiner-program-1';} if($resultado->qtd == 2){ echo 'etec-main-conteiner-program-2';} if($resultado->qtd >= 3){ echo 'etec-main-conteiner-program-3';} ?>">
<!--- "Nota do programador " o id "program-unit-prim" foi criado para dar um espaçamento maior nos dispositivos moveis --> 
<?php 	     
  
	foreach($ProgramasRelacionados->findAll('S') as $key => $value):
		
			//verifica se há imagem  principal no album
		$imagem_info = $Imagens->findPrincipal($value->p_album);
		   
		if(!$imagem_info){
		
				//se não foi encontrada, e chamada uma imagem pré definida
			$imagem = array('','Imagem não encontrada','Imagens/Imagens estaticas/Outras imagens/Imagem_evento.jpg'); 
		
		}
		else{
		
				//se foi encontrada, a imagem sendo cadastrada não recebe prioridade
			$imagem = array($imagem_info->i_titulo,$imagem_info->i_alt,$imagem_info->i_caminho); 
		
		}

?>
 <div class="<?php if($resultado->qtd == 1){ echo 'etec-container-program-1';} if($resultado->qtd == 2){ echo 'etec-container-program-2';} if($resultado->qtd >= 3){ echo 'etec-container-program-3';} ?>">
  <div class="<?php if($resultado->qtd == 1){ echo 'etec-program-unit-1';} if($resultado->qtd == 2){ echo 'etec-program-unit-2';} if($resultado->qtd >= 3){ echo 'etec-program-unit-3';} ?> cont-a-black" id="program-unit-prim" ><a href="Programas_Relacionados?A2xZ6MUf35C2M11XZAr45EtUc23DcTZZa89Vsut3Vz24CApfd33DfgHjilA24S34Xc543Cvgd123Cdasfhj5yYteF57=<?php echo $value->p_id; ?> ">
     <img src="<?php echo $imagem[2]; ?>" class="programa_relacionado"  alt="<?php echo $imagem[1]; ?>" title="<?php echo $imagem[0]; ?>"/> 
  </div> <!-- fechamento da class"program-unit"-->
  </a>
 </div><!--Fechamento da class"container-program"-->
<?php 

	endforeach;
 
?>



</div><!-- fechamento da class"main-container-program"--><!-- codigo reponsavel por mostrar os programas vinculados com a escola -->
<?php 

}

?> 


  <div class="etec-content-cursos etec-title-princip"><!--abertura da class que vai armazenar todos os cursos da instituiçao-->
  <h1>Cursos</h1>
  <div class="etec-cursos" >
                                         
    <div class="nav-cursos prev-cursos">&laquo;</div><!-- botao de voltar -->
     <div class="etec-cursos_img">
      <ul>
<?php    
  
foreach($Cursos->findAll('S', '') as $key => $value):
	
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
       <li class="etec-cursos_item cont-a-none"><!-- cursos -->
      
         
         <a href="<?php if($value->c_periodo == 'Matutino'){ echo 'Ensino_Medio?sinopse';}else{ echo 'Cursos?A2xZ6MUf35C2M11XZAr45EtUc23DcTZZa89Vsut3Vz24CApfd33DfgHjilA24S34Def53SDSe4g465DvbAZZ45f='.$value->c_id.'&sinopse';} ?>">
          <img src="<?php echo $imagem[2]; ?>"  alt="<?php echo $value->c_titulo; ?>" title="<?php echo $value->c_titulo; ?>"/> 
          
         </a>
       </li>
<?php 

endforeach;

?>
     
   </ul>
   
    
     </div><!--Fechamento da div "cursos_img"-->
     <div class="nav-cursos next-cursos">&raquo;</div><!-- botao de avancar -->
     
 </div><!-- Fechamento da class "cursos"-->
</div> <!-- fechamento da class "content-cursos" --> <!--Codigo responsavel por armazenar  os cursos -->




 <div class="etec-container-calendar-warnings">
<?php

date_default_timezone_set('America/Sao_Paulo');
$data = date('Y-m-d');

?>
 <div class="etec-container-calendar">
   <div class="etec-calendar-title etec-title-princip">
    <h1>Calendario <?php echo date('Y'); ?> </h1>
   </div><!--fechamento da class "calendar-title"-->
   <div class="etec-calendar-content">
   
<?php 

$datas = $Data->findAll($data, '', 'S', 'S', 'ASC');

$datas = array_reverse($datas);

foreach($datas as $key => $value):

?> 
                       <!-- primeiro iten do calendario -->        
   <div class="etec-calendar-iten">
     
      <div class="etec-item-nun ">
       <div class="etec-iten-aling"><h1>
	   <?php 
	   $data = explode('-',$value->d_data);
	   echo $data[2].'/'.$data[1]; 
	    ?></h1></div>
      </div><!--Fechamento da class "item-nun"-->
      <div class="etec-item-descricao">
        <p><?php echo $value->d_descricao; ?></p>
      </div>
     
    </div><!-- Calendar-iten"-->
    
  <div class="etec-conatiner-linha"></div><!-- container resposavel por adicionar uma linha preta-->
<?php

endforeach;

?>     
     <div class="etec-container-ver-mais ">
       
       <a href="Calendario">
       <div class="etec-ver-mais-tes" >
        <div class="etec-ver-mais-simb-mais" >+</div><div class="etec-ver-mais-lis">Lista completa</div>
       </div><!-- fechamento da class "ver-mais-test"-->
       </a>
       
       
       
       
     
     </div><!-- fechamento da class "container-ver-mais"-->
     
   </div> <!-- fechamento da class "calendar-content-->
 </div><!-- fechamento da class"container-calendar"-->
 

 
 
    
 <div class="etec-container-warning">
  <div class="etec-warning-title etec-title-princip">
   <h1>Mural de Avisos</h1>
  </div><!--fechamento da class"warning-title"-->
   
                                                         <!-- item numero 1 -->
<?php  
   
    //Salva os campos 
if(!($Avisos->setDestinatario('alunos'))){
	
	die('Falha ao tentar realizar o cadastro, opção inválida.');

} 

$avisos = $Avisos->findAll('S','S');

if($avisos){ 

?>     
  <div class="etec-warning-content">                            
   <div class="etec-warning-iten">  
    <div class="etec-warning-sub-title">
      <p>Aviso para estudantes da eletrô</p>
    </div> 
                
    <div class="etec-warning-unit">
     
<?php   

	foreach($avisos as $key => $value):

?>  
     <div class="etec-warning-iten-list ">
      <img src="Imagens/Imagens estaticas/Icones/ponto.png"> <?php echo $value->av_descricao; ?>
     </div>
<?php 

	endforeach;

?>
    </div><!-- fechamento da class"warning-unit"-->
  </div><!-- fechamento da class"warning-item"-->
<?php 

}
   
    //Salva os campos 
if(!($Avisos->setDestinatario('ex-alunos'))){
	
	die('Falha ao tentar realizar o cadastro, opção inválida.');

} 

$avisos = $Avisos->findAll('S','S');

if($avisos){ 

?>         
  <div class="etec-warning-iten">  
    <div class="etec-warning-sub-title">
      <p>Aviso para Ex alunos</p>
    </div>             
    <div class="etec-warning-unit">
     
<?php   

	foreach($avisos as $key => $value):

?>  
     <div class="etec-warning-iten-list ">
      <img src="Imagens/Imagens estaticas/Icones/ponto.png"> <?php echo $value->av_descricao; ?>
     </div>
<?php 

	endforeach;

?>

     
    </div><!-- fechamento da class"warning-unit"-->
  </div><!-- fechamento da class"warning-item"-->
<?php 

}
   
    //Salva os campos 
if(!($Avisos->setDestinatario('secretaria'))){
	
	die('Falha ao tentar realizar o cadastro, opção inválida.');

} 

$avisos = $Avisos->findAll('S','S');

if($avisos){ 

?>                                                          
  <div class="etec-warning-iten">  
    <div class="etec-warning-sub-title">
      <p>Avisos Da Secretaria Academica</p>
    </div>             
    <div class="etec-warning-unit">
<?php   

	foreach($avisos as $key => $value):

?>  
     <div class="etec-warning-iten-list ">
      <img src="Imagens/Imagens estaticas/Icones/ponto.png"> <?php echo $value->av_descricao; ?>
     </div>
<?php 

	endforeach;

?>

    </div><!-- fechamento da class"warning-unit"-->
  </div><!-- fechamento da class"warning-item"-->
<?php 

}
   
    //Salva os campos 
if(!($Avisos->setDestinatario('coordenacao'))){
	
	die('Falha ao tentar realizar o cadastro, opção inválida.');

} 

$avisos = $Avisos->findAll('S','S');

if($avisos){ 

?>   
  <div class="etec-warning-iten">  
    <div class="etec-warning-sub-title">
      <p>Avisos Da Coordenaçao Pedagogica</p>
    </div>             
    <div class="etec-warning-unit">
<?php   

	foreach($avisos as $key => $value):

?>  
     <div class="etec-warning-iten-list">
      <img src="Imagens/Imagens estaticas/Icones/ponto.png"> <?php echo $value->av_descricao; ?>
     </div>
<?php 

	endforeach;

?>    
    </div><!-- fechamento da class"warning-unit"-->
  </div><!-- fechamento da class"warning-item"-->
<?php 

}

?> 
 <div class="etec-container-ver-mais">
       
       <a href="Mural_Avisos">
          <div class="etec-ver-mais-tes" >
        <div class="etec-ver-mais-simb-mais" >+</div><div class="etec-ver-mais-lis">Lista completa</div>
       </div><!-- fechamento da class "ver-mais-test"-->
       </a>
       
<!-- "Nota do programador" a programaçao do  elemento "lisa completa " do calendario 2019 foi introduzio igualmente na parte de mural de avisos-->
       
       
  </div><!--fechamento da class"warning-content-->
 
  
 
 </div><!-- fechamento da class"container-warning"-->
 
</div><!-- fechamento da class "container-calendar-warnings"--><!--Codigo responsavel por armazenar o calendario e o quadro de avisos-->


</div><!-- fechamento da class"main-container" -->

<?php 
include("rodape.php");/*inclusao do rodape do site*/
?>
<script src="js/menu.js"></script>
<script src="js/Eventos.js"></script>
<script src="js/Cursos.js"></script>
</body>
</html>