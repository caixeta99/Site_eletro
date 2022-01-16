<?php

include("session.php");

function MyAutoload($className) {    
    $extension =  spl_autoload_extensions();
    require_once (__DIR__ . '/classes/' . $className . $extension);
}

spl_autoload_extensions('.php');
spl_autoload_register('MyAutoload');
 
$DocumentosAno = new DocumentosAno(); 
$DocumentosPlanoCursos = new DocumentosPlanoCursos();

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
<title>Documentos da Coordenação</title>

</head>
<body>

<?php 

include("admin_menu.php");/*inclusao do menu do site*/

	//Cadastra um documento
if(isset($_POST['cadastrar'])){
        //verifica se os campos foram recebidos
    if((isset($_POST['curso']))and(isset($_FILES['documento']))){
          //pega os valores dos campos
        $curso = $_POST['curso'];
		$nome_temporario=$_FILES["documento"]["tmp_name"];	  

			//realiza a busca das informações everifica se o curso já existe
		$verificacao = $DocumentosPlanoCursos->find('', $curso, $resultado->doc_id);
		if(($verificacao)or($nome_temporario == '')){
	
			echo '<script language="javascript">';
			echo "alert('Falha ao tentar realizar o cadastro, curso já existente!');";
			echo '</script>';
	
		}
		else{
			
				//Salva as letras com e sem acento para removeros acentos do caminho do documento
			$comAcentos = array('à', 'á', 'â', 'ã', 'ä', 'å', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ù', 'ü', 'ú', 'ÿ', 'À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'O', 'Ù', 'Ü', 'Ú');

			$semAcentos = array('a', 'a', 'a', 'a', 'a', 'a', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'y', 'A', 'A', 'A', 'A', 'A', 'A', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'N', 'O', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U');

				//muda para a nova imagem
			$pathinfo = pathinfo($_FILES["documento"]["name"]);
			$caminho = str_replace($comAcentos, $semAcentos, "Documentacao/Coordenacao/".$resultado->doc_ano."/Planos_de_Cursos/".$curso.".".$pathinfo['extension']);
			copy($nome_temporario, $caminho);
			
				//Salva os campos 
			$DocumentosPlanoCursos->setAno($resultado->doc_id); 
			if(!($DocumentosPlanoCursos->setCurso($curso))){
				
				die('Falha ao tentar realizar o cadastro, limite de caracteres ultrapassado.');
			
			}
			if(!($DocumentosPlanoCursos->setCaminho($caminho))){
				
				die('Falha ao tentar realizar o cadastro, limite de caracteres ultrapassado.');
			
			}
	
				//Insert
			if($DocumentosPlanoCursos->insert()){
				
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
}

//edicao de documento 
if(isset($_POST['editar'])){
	
        //verifica se os valores foram recebidos
	if(($_POST['id'])and(isset($_POST['curso']))and(isset($_FILES["documento"]))){
			
			//pega os valores dos campos
	   	$nome_temporario=$_FILES["documento"]["tmp_name"];	 
		$curso = $_POST['curso']; 
       	$id = $_POST['id'];
		
			//realiza a busca das informações 
		$documento = $DocumentosPlanoCursos->find($id, '', $resultado->doc_id);
		if(($documento)){
			
				//verifica se o curso já existe
			$verificacao = $DocumentosPlanoCursos->find('', $curso, $resultado->doc_id);
			if(($documento->dpc_curso != $curso)and($verificacao)){
				
				echo '<script language="javascript">';
				echo "alert('Falha ao tentar realizar o cadastro, curso já existente!');";
				echo '</script>';
				
			}
			else{
				
				//Salva as letras com e sem acento para removeros acentos do caminho do documento
				$comAcentos = array('à', 'á', 'â', 'ã', 'ä', 'å', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ù', 'ü', 'ú', 'ÿ', 'À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'O', 'Ù', 'Ü', 'Ú');
	
				$semAcentos = array('a', 'a', 'a', 'a', 'a', 'a', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'y', 'A', 'A', 'A', 'A', 'A', 'A', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'N', 'O', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U');
			
				if($nome_temporario != ''){
					
					if($documento->dpc_caminho != ''){
						
						unlink($documento->dpc_caminho);    
					
					}					
		
						//muda para a nova imagem
					$pathinfo = pathinfo($_FILES["documento"]["name"]);
					$caminho = str_replace($comAcentos, $semAcentos, "Documentacao/Coordenacao/".$resultado->doc_ano ."/Planos_de_Cursos/".$curso.".".$pathinfo['extension']);
					copy($nome_temporario, $caminho);
				
				}
				else{
					
					$extensao = explode('.',$documento->dpc_caminho);
					$caminho = str_replace($comAcentos, $semAcentos, "Documentacao/Coordenacao/".$resultado->doc_ano ."/Planos_de_Cursos/".$curso.".".$extensao[(count($extensao)-1)]);
					rename($documento->dpc_caminho, $caminho);
					
				}
				
				if(!($DocumentosPlanoCursos->setCurso($curso))){
			
					die('Falha ao tentar realizar o cadastro, limite de caracteres ultrapassado.');
		
				}
				if(!($DocumentosPlanoCursos->setCaminho($caminho))){
							
					die('Falha ao tentar realizar o cadastro, limite de caracteres ultrapassado.');
						
				}
			   
				if($DocumentosPlanoCursos->update($id)){
				
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

}

//desativacao de um documento
if(isset($_POST['desativar'])){

        //verifica se o id foi recebido
    if(isset($_POST['id'])){

            //pega o valor do id
        $id = (int)$_POST['id'];

            //realiza a busca das informações
        $documento = $DocumentosPlanoCursos->find($id, '', $resultado->doc_id);
    
        if(!($documento)){

            die("Falha na desativacão");

        }
    
        $ativo = $documento->dpc_ativo;

        if($ativo == 'S'){    
            $DocumentosPlanoCursos->setAtivo('N');
            $mensagem = "Desativação"; 
        }
        else{
            $DocumentosPlanoCursos->setAtivo('S');
            $mensagem = "Ativação"; 
        }

        if($DocumentosPlanoCursos->delete($id)){
			
            echo '<script language="javascript">';
            echo "alert('".$mensagem." bem sucedida!');";
            echo '</script>';
			
        }
		else{
			
			echo '<script language="javascript">';
            echo "alert('Falha na Desativação/Ativação do documento selecionado!');";
            echo '</script>';
			
		}
  
    }
 
}

?>


<div class="etec-pop-up-tela-informacoes-fundo">

<div class="etec-pop-p-tela-informacoes-two-op">
  <div class="etec-img-fechar"><p><img src="Imagens/Imagens estaticas/Icones/x.png" /></p></div>
   
  <div class="etec-pop-up-conteud">

  </div> 
 
   <div class="etec-pop-up-opcoes-two">
    <form action="admin_documentos_plano_cursos_editar.php" method="post" class="eve-admin-form" >
      <label for='Editar' >Editar</label>
     <input type="submit" name="editar" value="Editar" editar  class="btn" id="Editar"/> <input  id="editar" name="id" type="hidden" value=""  />
    </form>
    <form action="#" method="post">
     <label for='Desativar' desativar>Desativar</label>
     <input type="submit" name="desativar" value="Desativar"  class="btn" id="Desativar" /><input id="desativar" name="id" type="hidden" value=""  />
    </form>
   </div> <!--fechamento da classe "etec-pop-p-tela-informacoes-two-op"-->   
  
</div><!---fechamento da class"etec-pop-p-tela-informacoes-two-op"-->
</div><!---fechamento da class"etec-pop-up-tela-informacoes-fundo"-->

<main class="etec-admin-pag-padrao">


<div class="etec-admin-pad-barlateral">
   <div class="etec-admin-pad-bar-info"><h1>Plano dos crsos</h1></div>
   <div class="etec-admin-pad-bar-info"><i>Informativo:</i>  Nesta página contém informações referente aos documentos de plano dos cursos. Logo abaixo desta mensagem há a seguinte opção: 
      
    <p><strong>"Cadastrar"</strong> Botão que irá redireciona-lo à página de cadastro;</p>  
  
    </div>
  
  
 
   <a href="admin_documentos_plano_cursos_cadastro.php"><div class="etec-admin-pad-bar-iten etec-admin-pad-bar-iten-btn " >
   Cadastrar
   </div></a>
    <a href="admin_coordenacao.php" ><div class="etec-admin-pad-bar-iten etec-admin-pad-bar-iten-btn " >
   	Voltar
   	</div></a>

  
<?php  

include("admin_barra_lateral_legendcores.php");

?> 
    
   
 </div><!--fechamento da class"etec-admin-pad-barlateral"-->
<?php

$planocursos = $DocumentosPlanoCursos->findAll($resultado->doc_id, 'N');

if($planocursos){

?>
 <div class="etec-admin-pad-conteudo">
 
<?php 

	foreach($planocursos as $key => $value):

?>
 <div class="etec-admin-pad-conteudo-unit <?php if($value->dpc_ativo=='N'){
	  echo 'admin-pad-unit-desativ-color';
	  }else{
      echo'admin-pad-unit-ativar-color';
	  } ?>"
      item_id="<?php echo $value->dpc_id; ?>" ativo="<?php echo $value->dpc_ativo; ?>">
   
   <div class="etec-admin-pad-cont-unit-title ">
     Curso
   </div>
   <div class="etec-admin-pad-cont-unit-info" plano_curso >
     <?php  echo $value->dpc_curso; ?>
   </div>

     
   <div class="etec-admin-pad-cont-unit-title ">
     Caminho 
   </div>
   <div class="etec-admin-pad-cont-unit-info-reduces etec-admin-pad-cont-unit-info ">
      	<?php 
			
			echo $value->dpc_caminho;
		
		?>
   </div>
   
   
     
  </div><!--fechamento da class"etec-admin-pad-conteudo-unit"-->
<?php 

	endforeach;

?>
 </div><!--fechamento da class"etec-admin-pad-conteudo-->
<?php 

}

?>
</main>

<script src="js/admin_plano_cursos.js"></script>
</body>
</html>