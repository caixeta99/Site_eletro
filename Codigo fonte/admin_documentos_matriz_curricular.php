<?php

include("session.php");

function MyAutoload($className) {    
    $extension =  spl_autoload_extensions();
    require_once (__DIR__ . '/classes/' . $className . $extension);
}

spl_autoload_extensions('.php');
spl_autoload_register('MyAutoload');
 
$DocumentosAno = new DocumentosAno(); 
$DocumentosMatrizesCurriculares = new DocumentosMatrizesCurriculares();
$Cursos = new Cursos();

	//Pega o ano atual
date_default_timezone_set('America/Sao_Paulo');
$date = date('Y'); 

  	//Verica qual foi o ultimo corpo docente
$resultado = $DocumentosAno->find('');

if((!$resultado)or($resultado->doc_ano != $date)){

	die(header('location:admin_coordenacao.php'));
	
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

                                     <meta charset="utf-8">
<meta http-equiv="Content-Language" content="pt-br">
<meta name="viewport" content="width=device-width,initial-scale=1"/>
<meta name="keywords" content="Escola Tecnica , escola tecnica , ensino medio integrado ao tecnico , ensino medio , Ensino medio , Mococa , mococa , Mococa/sp , Etec , ETEC , Ete , Etec mococa, Eletro mococa, Eletro , ELETRO , letro , vestibulinho, vestibular , Profissionalização, Profissionalizacao ,cps"/>
                                    
                                    <!--- Css padrao-->
<link rel="stylesheet" href="Css/Reset.css">
<link rel="stylesheet" href="Css/etec-style-adm.css">
<link rel="stylesheet" href="Css/etec-style-adm-responsible.css">
<link rel="stylesheet" href="Css/etec-style-fonts.css">
<link rel="stylesheet" href="Css/etec-style-navigation.css">
<link rel="stylesheet" href="Css/etec-style-navigation-responsible.css">
   
    <!--icone da pagina-->
<link rel="icon" href="Imagens/Imagens estaticas/Icones/icone-etec.png" />
                             
                              <!-- titulo da pagina -->
<title>Matrizes curriculares</title>

</head>
<body>

<?php 

include("admin_menu.php");/*inclusao do menu do site*/

//edicao de documento 
if(isset($_POST['editar'])){

        //verifica se os valores foram recebidos
	if(($_POST['id'])and(isset($_FILES["documento"]))){
			
			//pega os valores dos campos
	   	$nome_temporario=$_FILES["documento"]["tmp_name"];	  
       	$id = $_POST['id'];
		
		if($nome_temporario != ''){
			
				//Chama a classe cursos
			$Cursos = new Cursos();
			
				//realiza a busca das informações
			$documento = $DocumentosMatrizesCurriculares->find($id);

			if(!($documento)){

				die("Falha na consulta");

			}
			
			if($documento->dmc_caminho != ''){
				
				unlink($documento->dmc_caminho);    
			
			}
			
			    //realiza a busca das informações do curso
			$curso = $Cursos->find($documento->dmc_curso);
			
			if(!($curso)){
		
				die("Falha na consulta");
		
			}
			
				//Salva as letras com e sem acento para removeros acentos do caminho do documento
			$comAcentos = array('à', 'á', 'â', 'ã', 'ä', 'å', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ù', 'ü', 'ú', 'ÿ', 'À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'O', 'Ù', 'Ü', 'Ú');

			$semAcentos = array('a', 'a', 'a', 'a', 'a', 'a', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'y', 'A', 'A', 'A', 'A', 'A', 'A', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'N', 'O', 'O', 'O', 'O', 'O', '0', 'U', 'U', 'U');

				//muda para a nova imagem
			$pathinfo = pathinfo($_FILES["documento"]["name"]);
			$caminho = str_replace($comAcentos, $semAcentos, "Documentacao/Coordenacao/".$resultado->doc_ano ."/Matrizes_Curriculares/".$curso->c_titulo."_".$documento->dmc_ciclo.".".$pathinfo['extension']);
			copy($nome_temporario, $caminho);
			
			if(!($DocumentosMatrizesCurriculares->setCaminho($caminho))){
						
				die('Falha ao tentar realizar o cadastro, limite de caracteres ultrapassado.');
					
			}
		   
			if($DocumentosMatrizesCurriculares->update($id)){
			
				echo '<script language="javascript">';
				echo "alert('Edição bem sucedida!');";
				echo '</script>';
			
			}
			else{
				
				echo '<script language="javascript">';
				echo "alert('Falha na edição do documento selecionado!');";
				echo '</script>';
				
			}
		
		}  
	
	}

}

//desativa e ativa dados de documentos da matriz curricular
if(isset($_POST['cursos'])){
	
		//Deleta todas as ligacoes deste vestibulinho
	if(!$DocumentosMatrizesCurriculares->deleteAll($resultado->doc_id)){
	
		die('Falha na edição');
			
	}
	
		//verifica se foi recebido algum curso  
   	if(isset($_POST['curso_matriz_curricular'])){  
   			
			//Cadastra as novas ligacoes
		foreach($_POST['curso_matriz_curricular'] as $key => $curso):
			
			$documentos = $DocumentosMatrizesCurriculares->findAll($resultado->doc_id, $curso, 'N');

			if(!$documentos){
							
				$curso_dados = $Cursos->find($curso);
				
				cadastrar($curso_dados->c_id, $curso_dados->c_periodo, $resultado->doc_id);
				
			}
			else
			{
				
				if(!($DocumentosMatrizesCurriculares->delete($resultado->doc_id, $curso, 'S'))){

					die('Falha ao realizar a edição.');
				
				}
					
			}
		
		endforeach;
		
   	}
	
	echo '<script language="javascript">';
    echo "alert('Edição bem sucedida!');";
    echo '</script>';
	
}

function cadastrar($id, $periodo, $ano){

		//Verifica o periododo curso e determina o ciclo do documento
	if($periodo == 'Noturno'){
		
		$ciclo = '1 Semestre';
		$cadastrar = 2;
	
	}
	else{
		
		$ciclo = 'Completo';
		$cadastrar = 1;
	
	}
	
	for($i = 0; $i < $cadastrar; $i++){
		
		$DocumentosMatrizesCurriculares = new DocumentosMatrizesCurriculares();
					
								//Cadastro das matrizes
			//Salva os campos 
		if(!($DocumentosMatrizesCurriculares->setCiclo($ciclo))){
			
			die('Falha ao tentar realizar o cadastro, opção inválida.');
		
		}
		$DocumentosMatrizesCurriculares->setCurso($id);
		$DocumentosMatrizesCurriculares->setAno($ano);
			
		if(!($DocumentosMatrizesCurriculares->insert())){

			die('Falha ao realizar o cadastro.');
		
		}
		
			//Muda o valor do ciclo caso o periodo seja noturno
		if($cadastrar == 2){
			
			$ciclo = '2 Semestre';
			
		}
		

	}
	
}

?>



<main class="etec-admin-pag-padrao">


<div class="etec-admin-pad-barlateral">
   <div class="etec-admin-pad-bar-info"><h1>Matrizes curriculares</h1></div>
   <div class="etec-admin-pad-bar-info"><i>Informativo:</i> Nesta página contém informações referente às matrizes curriculares.</div>
    <a href="admin_coordenacao.php" ><div class="etec-admin-pad-bar-iten etec-admin-pad-bar-iten-btn " >
   	Voltar
   	</div></a>
    <a href="admin_documentos_matriz_curricular_cadastro.php" ><div class="etec-admin-pad-bar-iten etec-admin-pad-bar-iten-btn " >
   	Cursos
   	</div></a>
  
<?php  

include("admin_barra_lateral_legendcores.php");

?> 
    
   
 </div><!--fechamento da class"etec-admin-pad-barlateral"-->
 <div class="etec-admin-pad-conteudo">
 
<?php 

foreach($Cursos->findAll('N', '') as $key => $value):
	
	$documentos = $DocumentosMatrizesCurriculares->findAll($resultado->doc_id, $value->c_id, 'S');

	if($documentos){

		foreach($documentos as $key_documento => $value_documento):

?>
<a href="admin_documentos_matriz_curricular_editar.php?A44dsddERTjsJfdJLsSrEUd566457IfdKddItfAfnNB57hyDVSa56JgSaKPd3U4SFfa4434fdsdsttv5fd3DdfDdDS45S45SDF3=<?php echo $value_documento->dmc_id; ?>" >       
 <div class="etec-admin-pad-conteudo-unit admin-pad-unit-ativar-color">
   
   <div class="etec-admin-pad-cont-unit-title "><!--- o "conteudo " virou "cont" --->
     Curso
   </div>
   <div class="etec-admin-pad-cont-unit-info">
	<?php  
	
	echo $value->c_titulo; 
	
	?>
   </div>
   <div class="etec-admin-pad-cont-unit-title "><!--- o "conteudo " virou "cont" --->
     Período
   </div>
   <div class="etec-admin-pad-cont-unit-info">
     <?php  echo $value_documento->dmc_ciclo; ?>
   </div>
   
   <div class="etec-admin-pad-cont-unit-title "><!--- o "conteudo " virou "cont" --->
     Caminho 
   </div>
   <div class="etec-admin-pad-cont-unit-info-reduces etec-admin-pad-cont-unit-info " <?php if($value_documento->dmc_caminho==""){echo 'align="center"';}?>>
      <?php 
	  
	  	if($value_documento->dmc_caminho == ""){
		  
		  	echo '--';
		  
		}
		else{
			
			echo $value_documento->dmc_caminho;
			
		}
		
		?>
   </div>
   
   
     
  </div><!--fechamento da class"etec-admin-pad-conteudo-unit"-->
  </a><!--fechamento do link que envolve todo o container -->
<?php 

		endforeach;

	}

endforeach;

?>
 </div><!--fechamento da class"etec-admin-pad-conteudo-->
</main>

</body>
</html>