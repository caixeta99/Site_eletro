<?php

function MyAutoload($className) {    
    $extension =  spl_autoload_extensions();
    require_once (__DIR__ . '/classes/' . $className . $extension);
}

spl_autoload_extensions('.php');
spl_autoload_register('MyAutoload');
 
$DocumentosAno = new DocumentosAno(); 

  	//Verica qual foi o ultimo coordenacao
$documentos_ano = $DocumentosAno->find('');

if($documentos_ano){
	
	$Cursos = new Cursos();
	$DocumentosCoordenacao = new DocumentosCoordenacao();
	$DocumentosPlanoTrabalho = new DocumentosPlanoTrabalho();
	$DocumentosMatrizesCurriculares = new DocumentosMatrizesCurriculares();
	$DocumentosPlanoCursos = new DocumentosPlanoCursos();
	$DocumentosModeloPlanos = new DocumentosModeloPlanos();

	$i = 0;
	foreach($DocumentosCoordenacao->findAll($documentos_ano->doc_id) as $key => $value):
	
		$documentos_coordenacao[$i] = $value->dc_caminho;
		$i++;
	
	endforeach; 

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
<link rel="stylesheet" href="Css/etec-style-usuario-servicos.css">
<link rel="stylesheet" href="Css/etec-style-usuario-servicos-responsible.css">
<link rel="stylesheet" href="Css/etec-style-elementos_especificos.css">

                                                 <!-- titulo da pagina -->
<title>Coordenação Pedagógica | Eletrô</title>

</head>
<body>

<?php 
include("menu.php");/*inclusao do menu do site*/
?>


<div class="main-conteiner"><!--Abertura da class aonde ficara todo o conteudo da pagina -->

  <header class="etec-container-indicator">
  
   <div class="etec-container-indicator-item">Coordenação Pedagógica  | <a href="index.php">Eletrô</a> </div>
  
 </header><!-- fechamento da class"container-indicator-->

<?php 

if(($documentos_ano)and(($documentos_coordenacao[0] != '')or($documentos_coordenacao[1] != '')or($documentos_coordenacao[4] != '')or($documentos_coordenacao[5] != ''))){

?>
 <div class="etec-coore-ori-curi  etec-title-princip">
   
   <h3>Professor Rodrigo Martins Perre.</h2>
   <h3>Orientações para Cumprimento dos Currículos do Ensino Médio e Técnico:</h3>
	<div class="etec-donwload-units">
<?php 

	if($documentos_coordenacao[0] != ''){

?>
   <div class="etec-donwload-unit cont-a-none"><a href="<?php echo $documentos_coordenacao[0]; ?>" target="_blank"><img src="Imagens/Imagens estaticas/Botoes de Download/instrucao conjunta cetec.jpg" alt="instrucao conjunta cetec" title="instrucao conjunta cetec"></a></div>
<?php

	}
	
	if($documentos_coordenacao[1] != ''){
	
?>
   <div class="etec-donwload-unit cont-a-none"><a href="<?php echo $documentos_coordenacao[1]; ?>" target="_blank"><img src="Imagens/Imagens estaticas/Botoes de Download/diretrizes gerais.jpg" alt="diretrizes gerais" title="diretrizes gerais"></a></div>
<?php

	}
	
	if($documentos_coordenacao[4] != ''){
	
?>
   <div class="etec-donwload-unit cont-a-none"><a href="<?php echo $documentos_coordenacao[4]; ?>" target="_blank"><img src="Imagens/Imagens estaticas/Botoes de Download/Deliberacao CEE N 155 2017.jpg" alt="Deliberacao CEE N 155 2017" title="Deliberacao CEE N 155 2017"></a></div>
<?php

	}
  if($documentos_coordenacao[5] != ''){
	
?>
   <div class="etec-donwload-unit cont-a-none"><a href="<?php echo $documentos_coordenacao[5]; ?>" target="_blank"><img src="Imagens/Imagens estaticas/Botoes de Download/Deliberacao CEE N 161 2018.jpg" alt="Deliberacao CEE N 161 2018" title="Deliberacao CEE N 161 2018"></a></div>
<?php

	}	
?>

  
	</div>
 </div><!--fechamento da class"etec-coore-ori-curi"-->
<?php

}

?>
<?php 

if($documentos_ano){

?>


<div class="etec--cordenacao-ptd">
<?php 
 
$plano_trabalho_documentos = $DocumentosPlanoTrabalho->findAllCiclo($documentos_ano->doc_id, 'Completo', 'S');
 
if($plano_trabalho_documentos){ 
 
?>
 <div class="etec-cordenacao-ptd-emt"> 
 
  <div class="etec-cordenacao-ptd-emt-cont etec-title-princip">
   <h1>Planos de Trabalho Docente - Ensino Médio e Integrado <?php echo $documentos_ano->doc_ano; ?></h1>
   <ul >
                                      
	<?php 
    
    foreach($plano_trabalho_documentos as $key => $value):
    
    ?>
    
     <li><?php echo $value->c_titulo; ?>
    <?php 
    
        if($value->dpt_caminho != ''){
    
    ?>
    <a href="<?php echo $value->dpt_caminho; ?>" target="_blank" > 
    
    (Baixar)
    
    </a>
    <?php
    
        }
    
    ?>
     
     </li>
    
    <?php 
    
    endforeach;
    
    ?>
   
  </ul>
  
   
  </div><!--fechamento da class"etec-cordenacao-ptd-emt-cont-->
 </div><!--fechamento da class"etec-cordenacao-ptd-emt"-->
<?php

}
 
$plano_trabalho_documentos_1_semestre = $DocumentosPlanoTrabalho->findAllCiclo($documentos_ano->doc_id, '1 Semestre', 'S');
$plano_trabalho_documentos_2_semestre = $DocumentosPlanoTrabalho->findAllCiclo($documentos_ano->doc_id, '2 Semestre', 'S'); 

if(($plano_trabalho_documentos_1_semestre)or($plano_trabalho_documentos_2_semestre)){ 
 
?>
 
 <div class="etec-cordenacao-ptd-et etec-title-princip">
  <h1>Planos de Trabalho Docente - Ensino Técnico <?php echo $documentos_ano->doc_ano; ?></h2>
    
<?php
  
	if($plano_trabalho_documentos_1_semestre){ 

?>                                             
  <div class="etec-cordenacao-ptd-et-s1 ">
   <h2>1º Semestre</h2>
     <ul>
    <?php 
    
    foreach($plano_trabalho_documentos_1_semestre as $key => $value):
    
    ?>
    
     <li><?php echo $value->c_titulo; ?>
    <?php 
    
        if($value->dpt_caminho != ''){
    
    ?>
    <a href="<?php echo $value->dpt_caminho; ?>" target="_blank" > 
    
    (Baixar)
    
    </a>
    <?php
    
        }
    
    ?>
     
     </li>
    
    <?php 
    
    endforeach;
    
    ?>
    </ul>
  </div><!--fechamento da class"cont-cordenacao-ptd-et-s1"-->
  
<?php
	
	}
  
	if($plano_trabalho_documentos_2_semestre){ 

?>     
  <div class="etec-cordenacao-ptd-et-s2 etec-title-princip">
  
   <h2>2º Semestre</h2>
   
   <ul>
    <?php 
    
    foreach($plano_trabalho_documentos_2_semestre as $key => $value):
    
    ?>
    
     <li><?php echo $value->c_titulo; ?>
    <?php 
    
        if($value->dpt_caminho != ''){
    
    ?>
    <a href="<?php echo $value->dpt_caminho; ?>" target="_blank" > 
    
    (Baixar)
    
    </a>
    <?php
    
        }
    
    ?>
     
     </li>
    
    <?php 
    
    endforeach;
    
    ?>
    </ul>
     
  </div><!--fechamento da class"cont-cordenacao-ptd-et-s2"-->
  
 </div><!--fechamento da class"cont-cordenacao-ptd-et"-->
<?php

	}

?>
 
</div><!--fechamento da class"cont-cordenacao-ptd"-->
<?php 

}

?>




<div class="etec-cordenacao-mc etec-title-princip">
 <h1>Matrizes Curriculares</h1>
<?php

for($ano = $documentos_ano->doc_ano; $ano > ($documentos_ano->doc_ano - 3); $ano--){

	$ano_documentos = $DocumentosAno->find('', $ano);

	if($ano_documentos){

?>
 <div class="etec-mobil-conrdenacao">
 <h1><?php echo $ano; ?></h1>
<?php 

		foreach($Cursos->findAll('S', '') as $key => $value):
		
			$matrizescurriculares = $DocumentosMatrizesCurriculares->findAll($ano_documentos->doc_id, $value->c_id, 'S');
			
			if($matrizescurriculares){

?> 
  <div class="etec-mobil-modalit"><?php  echo $value->c_titulo; ?></div><!--fechamento da clasee"etec-mobil-modalit"-->
  <div class="etec-mobil-semes">
<?php
	
				foreach($matrizescurriculares as $key_documento => $value_documento):
					
					$ciclo = $value_documento->dmc_ciclo;
					
					if($ciclo != "Completo"){
					
						echo "<div class=\"etec-mobil-item-semes\">";
						
					}
					else{
						
						echo "<div class=\"etec-mobil-item-completo\">";
						$ciclo = "Anual";
						
					}
				
					if($value_documento->dmc_caminho != ''){
				
		?>
		<a href="<?php  echo $value_documento->dmc_caminho; ?>" target="_blank"><?php  echo $ciclo; ?></a></div>
		<?php
			
					}
					else{
				
						echo $ciclo."</div>";		
						
					}
			
				endforeach;
	
?>
  </div>
<?php
	
			}
		
		endforeach;

?>  
</div>
<?php

	}

}

for($ano = $documentos_ano->doc_ano; $ano > ($documentos_ano->doc_ano - 3); $ano--){

	$ano_documentos = $DocumentosAno->find('', $ano);

	if($ano_documentos){

?>
</div><!--fechamento da clasee"etec-mobil-conrdenação"-->
  <div class="etec-table-elemento-reduces etec-table-elemento etec-table-mobile">
   <table width="200" border="1" cellpadding="1" class="cont-table-ajust ">
  <caption>
    <?php echo $ano; ?>
  </caption>
 
   
  <tr class="etec-table-title">
    <td>Modalidades</td>
    <td class="etec-tabel-lin-none">Matrizes</td>
  </tr>
  
<?php 

		foreach($Cursos->findAll('S', '') as $key => $value):
		
			$matrizescurriculares = $DocumentosMatrizesCurriculares->findAll($ano_documentos->doc_id, $value->c_id, 'S');

			if($matrizescurriculares){

?>  
  <tr>
    <td >
    	<?php  echo $value->c_titulo; ?>
    </td>
    <td >
	<?php  
			
				$i = 0;
				
				foreach($matrizescurriculares as $key_documento => $value_documento):
				
					if($i == 1){
						
						echo ' / ';
						
					}
				
					if($value_documento->dmc_caminho != ''){
					
	?>
    <a href="<?php  echo $value_documento->dmc_caminho; ?>" target="_blank">
    <?php
					
						if($value_documento->dmc_ciclo != "Completo"){
						
							echo $value_documento->dmc_ciclo;
							
						}
						else{
						
							echo "Anual";
						
						}
		
	?>
    	</a>
    <?php
			
					}
					else{
						  
				
						if($value_documento->dmc_ciclo != "Completo"){
						
							echo $value_documento->dmc_ciclo;
							
						}
						else{
							
							echo "Anual";
							
						}
						
					}
				
					$i++;
				endforeach;

	?>
    </td>
    
  </tr>
<?php
		
			}
			
		endforeach;

?>  
</table>

<?php

	}

}

?>
 </div><!--fechamento da class"cont-table"-->



<div class="etec-cordenacao-mp-pc etec-title-princip">
<?php
	
	$modeloplanos = $DocumentosModeloPlanos->findAll($documentos_ano->doc_id, 'S');
	$planocursos = $DocumentosPlanoCursos->findAll($documentos_ano->doc_id, 'S');
	
	if($modeloplanos){

?>
   <div class="etec-cordenacao-mp <?php if( ($modeloplanos == false) or ($planocursos == false) ){ echo 'etec-cordenacao-mp-pc-one'; } ?>">
      <div class="etec-cordenacao-mp-cont">
       <h2>Modelos de Planos</h2>
         
         <ul>
         
        <?php 

			foreach($modeloplanos as $key => $value):
		
		?>

         <li><?php echo $value->dmp_documento; ?>
		<?php 
        
        		if($value->dmp_caminho != ''){
        
        ?>
        <a href="<?php echo $value->dmp_caminho; ?>" target="_blank"> 
        
        (Baixar)
        
        </a>
        <?php
        
        		}
        
        ?>
         
         </li>
    
    	<?php 
	
			endforeach;

		?>
         
         </ul>
         
      </div><!-- fechamento da class"cont-cordenacao-mp-cont"-->
   </div><!--cont-cordenacao-mp-->
<?php

	}
	
	if($planocursos){	
	
?>
   <div class="etec-cordenacao-pc <?php if( ($modeloplanos == false) or ($planocursos == false) ){ echo 'etec-cordenacao-mp-pc-one'; } ?>">
    <div class="etec-cordenacao-pc-cont">
     <h2>Planos de Cursos</h2>
      <ul>
		<?php 

			foreach($planocursos as $key => $value):
		
		?>

         <li><?php echo $value->dpc_curso; ?>
		<?php 
        
        		if($value->dpc_caminho != ''){
        
        ?>
        <a href="<?php echo $value->dpc_caminho; ?>" target="_blank"> 
        
        (Baixar)
        
        </a>
        <?php
        
        		}
        
        ?>
         
         </li>
    
    	<?php 
	
			endforeach;

		?>
      </ul>
     
    </div> <!--fechamento da class"cont-cordenacao-pc-cont"-->  
   </div><!--fechamento da class"cont-cordenacao-pc"-->
<?php

	}

?>  
 </div> <!-- fechamento da class"cont-cordenacao-mp-pc"-->

<?php

}

?>

<div class="etec-cordenacao-mc etec-title-princip">
 <h1>Coordenadores de Habilitações Técnicas</h1>
 <div class="etec-table-elemento">
   
   <table width="200" border="1" cellpadding="1">
  <tr class="etec-table-title">
    <td>Coordenadores</td>
    <td>Cursos</td>
  </tr>
  <tr>
    <td>Professores Carlos Ricardo Greghi Nogueira e Paulo Henrique Gonçalves</td>
    <td>Eletrônica e Eletrônica Integrado ao Médio</td>
  </tr>
  <tr>
    <td>Prof. Marco Antonio Ricanello</td>
    <td>Automação Industrial e Automação Industrial Integrado ao Médio</td>
  </tr>
  <tr>
    <td>Prof. Cleber Cosme Bueno</td>
    <td>Mecatrônica e Mecatronica Integrado ao Médio</td>
  </tr>
  <tr>
    <td>Prof. Renato Pedrosa Campos</td>
    <td>Eletrotécnica e Eletrotécnica Integrado ao Médio</td>
  </tr>
  <tr>
    <td>Prof. Rodrigo Manhas Piantino</td>
    <td>Desenvolvimento de Sistemas e Informatica Integrado ao Médio e Manutenção e Suporte para Informática</td>
  </tr>
</table>

   
 </div><!--fechamento da class"cont-table"-->
</div><!-- fechamento da class"cont-cordenacao-mc"-->

<div class="cont-cordenacao-bc etec-title-princip">
 
 
 <div class="etec-cordenacao-bnc">
    <h2>Coordenador da Base Nacional Comum</h2>
    <h3>Professor: Rafael Silva e Borges.</h3>
 </div>
 
 <div class="etec-cordenacao-od">
    <h2>Orientadora Educacional</h2>
  <h3>Professora Melina de Souza Sernáglia Piantino.</h3>
 </div>
 
</div><!--fechamento da classe""-->
<?php 

if(($documentos_ano)and(($documentos_coordenacao[2] != '')or($documentos_coordenacao[3] != ''))){

?>
<div class="etec-cordenacao-download etec-title-princip">
<h2>Downloads de Documentos </h2>
<?php
	
	if($documentos_coordenacao[2] != ''){
	
?> 
 <div >
  <h3>Ficha de Autorização Para Participar Em Curso De Capacitação /Visita Técnica:</h3>
  <div class="etec-donwload-unit-title"> <a href="<?php echo $documentos_coordenacao[2]; ?>" target="_blank"><img src="Imagens/Imagens estaticas/Botoes de Download/Fazer Donwload.jpg" alt="Realizar Donwload" title="Realizar Donwload" ></a></div>

 </div><!--fechamento da class"cont-links"-->
<?php

	}
	
	if($documentos_coordenacao[3] != ''){
	
?>
<div >
  <h3>Ficha de Atividades Extras:</h3>
  <div class="etec-donwload-unit-title"><a href="<?php echo $documentos_coordenacao[3]; ?>" target="_blank"><img src="Imagens/Imagens estaticas/Botoes de Download/Fazer Donwload.jpg" alt="Realizar Donwload" title="Realizar Donwload" ></a></div>
 </div><!--fechamento da class"cont-links"-->

<?php

	}
	
?> 

</div><!--Fechamento da div "cont-cordenacao-download"-->  

<?php

}//Fechadodo if que verifica se existe a coordenção do ultimo ano

?>

</div><!--fechamento da classe "container-main"-->
<?php 
include("rodape.php");/*inclusao do rodape do site*/
?>

</body>
</html>