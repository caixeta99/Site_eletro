<?php

include("session.php");

function MyAutoload($className) {    
    $extension =  spl_autoload_extensions();
    require_once (__DIR__ . '/classes/' . $className . $extension);
}

spl_autoload_extensions('.php');
spl_autoload_register('MyAutoload');
  
$DocumentosAno = new DocumentosAno();

	//Pega o ano atual
date_default_timezone_set('America/Sao_Paulo');
$date = date('Y'); 

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


<title>Coordenação</title>
</head>
<body>

<?php 

include("admin_menu.php");/*inclusao do menu do site*/

if(isset($_POST['cadastrar'])){
	
		//Verifica se é necessario o cadastro da coordenação
	$resultado = $DocumentosAno->find('');

	if((!$resultado)or($resultado->doc_ano < $date)){
	
			//Salva os campos 
		$DocumentosAno->setAno($date); 
	
			//Insert
		if($DocumentosAno->insert()){
			
				//Cria as pastas
			mkdir(__DIR__."/Documentacao/Coordenacao/".$date, 0777);
			mkdir(__DIR__."/Documentacao/Coordenacao/".$date."/Planos_de_Trabalho", 0777);
			mkdir(__DIR__."/Documentacao/Coordenacao/".$date."/Matrizes_Curriculares", 0777);
			mkdir(__DIR__."/Documentacao/Coordenacao/".$date."/Modelos_de_Planos", 0777);
			mkdir(__DIR__."/Documentacao/Coordenacao/".$date."/Planos_de_Cursos", 0777);
			mkdir(__DIR__."/Documentacao/Coordenacao/".$date."/Padroes", 0777);
			
				//Chama as classes
			$Cursos = new Cursos();
			$DocumentosCoordenacao = new DocumentosCoordenacao();
			$DocumentosModeloPlanos = new DocumentosModeloPlanos();
			$DocumentosPlanoTrabalho = new DocumentosPlanoTrabalho();
			$DocumentosMatrizesCurriculares = new DocumentosMatrizesCurriculares();
			
				//busca o id da coordenaçao
			$id = $DocumentosAno->find('');
			
				//Salva o id da coordenaçao
			$DocumentosPlanoTrabalho->setAno($id->doc_id);
			$DocumentosMatrizesCurriculares->setAno($id->doc_id);
			$DocumentosCoordenacao->setAno($id->doc_id);
			$DocumentosModeloPlanos->setAno($id->doc_id);
			
				//Cadastra os documentos do plano de trabalho e matrizes curriculares
			foreach($Cursos->findAll('S', '') as $key => $value):
					
					//Verifica o periododo curso e determina o ciclo do documento
				if($value->c_periodo == 'Noturno'){
					
					$ciclo = '1 Semestre';
					$cadastrar = 2;
				
				}
				else{
					
					$ciclo = 'Completo';
					$cadastrar = 1;
				
				}
				
				for($i = 0; $i < $cadastrar; $i++){
					
											//Cadastro do plano de trabalho
						//Salva os campos 
					if(!($DocumentosPlanoTrabalho->setCiclo($ciclo))){
						
						die('Falha ao tentar realizar o cadastro, opção inválida.');
					
					}
					$DocumentosPlanoTrabalho->setCurso($value->c_id);
					
					if(!($DocumentosPlanoTrabalho->insert())){
			
						die('Falha ao realizar o cadastro.');
					
					}
						
											//Cadastro da matriz curricular		
						//Salva os campos 
					if(!($DocumentosMatrizesCurriculares->setCiclo($ciclo))){
						
						die('Falha ao tentar realizar o cadastro, opção inválida.');
					
					}
					$DocumentosMatrizesCurriculares->setCurso($value->c_id);
					
					if(!($DocumentosMatrizesCurriculares->insert())){
			
						die('Falha ao realizar o cadastro.');
					
					}
					
						//Muda o valor do ciclo caso o periodo seja noturno
					if($cadastrar == 2){
						
						$ciclo = '2 Semestre';
						
					}
					
				}
			
			endforeach;
			
				//Realiza o cadastro
			if(!($DocumentosCoordenacao->insert())){
	
				die('Falha ao realizar o cadastro.');
			
			}		
			
			echo "<script language=\"javascript\">";
			echo "alert('Cadastro bem sucedido!');";
			echo "</script>";
			
		}
		else{
			
			echo '<script language="javascript">';
			echo "alert('Falha ao tentar realizar o cadastro!');";
			echo '</script>';
			
		}
		
	}

}

?>

<main class="etec-admin-pag-padrao">
 <div class="etec-admin-pad-barlateral">
   <div class="etec-admin-pad-bar-info"><h1>Coordenação</h1></div>
   <div class="etec-admin-pad-bar-info"><i>Informativo:</i> Nesta página contém informações referentes à coordenação da escola.
<?php 
  
  	//Verica quando foram os ultimos documentos cadastrados  e se é necessario o cadaastro de um novo
$resultado = $DocumentosAno->find('');

if((!$resultado)or($resultado->doc_ano < $date)){

?> 
	logo abaixo há varias opções:
 
    <p><strong>Cadastrar</strong> Botão que realiza o cadastro de um novo conjunto de documentos da coordenação</p>
<?php 

} 
else{
	
?> 
    <p><strong>Documentos</strong> Botão que irá redireciona-lo à página de documentos padrões;</p>
    <p><strong>Plano de Trabalho</strong> Botão que irá redireciona-lo à página de plano de trabalho;</p>
    <p><strong>Matrizes Curriculares</strong> Botão que irá redireciona-lo à página de matrizes curriculares;</p>
    <p><strong>Modelos de Planos</strong> Botão que irá redireciona-lo à página de modelos de planos;</p>
    <p><strong>Plano de Cursos</strong> Botão que irá redireciona-lo à página de plano de cursos;</p>
    
<?php 

} 

?> 
   </div>
  
<?php 
  
if((!$resultado)or($resultado->doc_ano < $date)){

?>  
<form method="post" action="#">
   <label for="btn_cadastrar"><div class="etec-admin-pad-bar-iten etec-admin-pad-bar-iten-btn " >
   Cadastrar
   </div></label>
   <input type="submit" name="cadastrar" id="btn_cadastrar" />
</form>
<?php 

}
else{
	
?>

	<a href="admin_documentos_coordenacao.php"><div class="etec-admin-pad-bar-iten etec-admin-pad-bar-iten-btn " >
   	Documentos
   	</div></a>
   	<a href="admin_documentos_plano_trabalho.php"><div class="etec-admin-pad-bar-iten-alment etec-admin-pad-bar-iten etec-admin-pad-bar-iten-btn " >
   	Plano de Trabalho
   	</div></a>
    <a href="admin_documentos_matriz_curricular.php"><div class="etec-admin-pad-bar-iten-alment etec-admin-pad-bar-iten etec-admin-pad-bar-iten-btn " >
    Matrizes Curriculares
    </div></a>
    <a href="admin_documentos_modelo_planos.php"><div class="etec-admin-pad-bar-iten-alment etec-admin-pad-bar-iten etec-admin-pad-bar-iten-btn " >
    Modelos de Planos
    </div></a>
    <a href="admin_documentos_plano_cursos.php"><div class="etec-admin-pad-bar-iten-alment etec-admin-pad-bar-iten etec-admin-pad-bar-iten-btn " >
    Plano de Cursos
    </div></a>

<?php 

}  

include("admin_barra_lateral_legendcores.php");

?> 
   
 </div><!--fechamento da class"etec-admin-pad-barlateral"-->
 <div class="etec-admin-pad-conteudo">
 
<?php 	     

foreach($DocumentosAno->findAll() as $key => $value):

?>
       
 <div class="etec-admin-pad-conteudo-unit-reduces  
<?php 

if($value->doc_ano != $date){
	
	echo 'admin-pad-unit-inative-color';

}
else{
    
	echo'admin-pad-unit-ativar-color';

}

?>" >
  
   <div class="etec-admin-pad-cont-unit-title"><!--- o "conteudo " virou "cont" --->
     Ano
   </div>
   <div class="etec-admin-pad-cont-unit-info">
     <?php  
	 
	 echo $value->doc_ano;
	 
	 ?>
   </div>
   
    
  
  </div><!--fechamento da class"etec-admin-pad-conteudo-unit"-->
<?php 

endforeach;

?>
 </div><!--fechamento da class"etec-admin-pad-conteudo-->
</main>









</body>
</html>
