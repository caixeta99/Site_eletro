<?php

include("session.php");

function MyAutoload($className) {    
    $extension =  spl_autoload_extensions();
    require_once (__DIR__ . '/classes/' . $className . $extension);
}

spl_autoload_extensions('.php');
spl_autoload_register('MyAutoload');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
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


<title>Horário das aulas</title>
</head>
<body>

<?php 

include("admin_menu.php");/*inclusao do menu do site*/

//edicao de data do calendario no mysql 
if(isset($_POST['editar'])){

        //verifica se os valores foram recebidos
    if((isset($_FILES["documento"]))and(isset($_POST["horario"]))and(isset($_POST["descricao"]))){
		
			//pega os valores dos campos
	   	$nome_temporario=$_FILES["documento"]["tmp_name"];	
	   	$horario = $_POST['horario'];
		$descricao = $_POST["descricao"];
		
		if(($horario == 'Ensino Médio')or($horario == 'Ensino Integrado')or($horario == 'Ensino Integrado - Novotec')or($horario == 'Ensino Técnico')){
		
			$Horarios = new HorarioAulas();
			
			    //realiza a busca das informações
			$resultado = $Horarios->find($horario);
			
			if(!($resultado)){
		
				die("Falha na consulta");
		
			}
			
			if($nome_temporario != ''){
         		
		 		if($resultado->ha_documento != ''){
					
	       			unlink($resultado->ha_documento);   
					 
		 		}
		    		
					//muda para o novo documento
	    		$pathinfo = pathinfo($_FILES["documento"]["name"]);
				if($horario == 'Ensino Médio'){
					$caminho = "Documentacao/Horario_aulas/ensino_medio.".$pathinfo['extension']; 
				}
				if($horario == 'Ensino Integrado'){
					$caminho = "Documentacao/Horario_aulas/ensino_integrado.".$pathinfo['extension']; 
				}
				if($horario == 'Ensino Integrado - Novotec'){
					$caminho = "Documentacao/Horario_aulas/ensino_integrado_novotec.".$pathinfo['extension']; 
				}
				if($horario == 'Ensino Técnico'){
					$caminho = "Documentacao/Horario_aulas/ensino_tecnico.".$pathinfo['extension']; 
				}	
				
				copy($nome_temporario,$caminho);		
		
	   		}
			else
			{
			
				$caminho = $resultado->ha_documento;
				
			}
			
			$Horarios->setDocumento($caminho);
       				
			if(!($Horarios->setDescricao($descricao))){
	
				die('Falha ao tentar realizar a edição, limite de caracteres ultrapassado ou não atingido.');
		
			}
			
			if($Horarios->update($horario)){
		
				echo '<script language="javascript">';
				echo "alert('Edição bem sucedida!');";
				echo '</script>';
		
			}
			else{
				
				echo '<script language="javascript">';
				echo "alert('Falha na edição do horario selecionado!');";
				echo '</script>';
				
			}
		
		}
		else{
			
			echo '<script language="javascript">';
			echo "alert('Falha na edição do horario selecionado!');";
			echo '</script>';
				
		}

    }   

}

?>


<main class="etec-admin-pag-padrao">
 <div class="etec-admin-pad-barlateral">
   <div class="etec-admin-pad-bar-info"><h1>Horário das aulas </h1></div>
   <div class="etec-admin-pad-bar-info"><i>Informativo:</i> Nesta página contém informações referente aos horários da escola.</div>
  
   
   
   <?php  
   include("admin_barra_lateral_legendcores.php");
 ?> 
 
 </div>
 <div class="etec-admin-pad-conteudo">
 
  

  
 <a href="admin_horario_aulas_editar.php?horario=Ensino Médio"> <div class="etec-admin-pad-conteudo-unit">
   <img src="Imagens/Imagens estaticas/horarios das aulas/Ensino medio.jpeg" />
 </div></a>
 
 <a href="admin_horario_aulas_editar.php?horario=Ensino Integrado - Novotec"> <div class="etec-admin-pad-conteudo-unit">
   <img src="Imagens/Imagens estaticas/horarios das aulas/Ensino Integrado Novotec.jpeg" />
 </div></a>
 
 <a href="admin_horario_aulas_editar.php?horario=Ensino Integrado"><div class="etec-admin-pad-conteudo-unit">
   <img src="Imagens/Imagens estaticas/horarios das aulas/Ensino Integrado.jpeg" />
 </div></a>
 
 
 <a href="admin_horario_aulas_editar.php?horario=Ensino Técnico"><div class="etec-admin-pad-conteudo-unit">
   <img src="Imagens/Imagens estaticas/horarios das aulas/Ensino Tecnico.jpeg" />
 </div></a>
 

  
  

  
 
  </div>
 </div>
</main>

</body>
</html>