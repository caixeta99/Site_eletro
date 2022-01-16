<?php

include("session.php");

function MyAutoload($className) {    
    $extension =  spl_autoload_extensions();
    require_once (__DIR__ . '/classes/' . $className . $extension);
}

spl_autoload_extensions('.php');
spl_autoload_register('MyAutoload');
 
$DocumentosAno = new DocumentosAno(); 
$DocumentosModeloPlanos = new DocumentosModeloPlanos();

	//Pega o ano atual
date_default_timezone_set('America/Sao_Paulo');
$date = date('Y'); 

  	//Verica qual foi o ultimo coordenacao
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
<title>Modelo de planos</title>

</head>
<body>

<?php 

include("admin_menu.php");/*inclusao do menu do site*/

	//Cadastra um documento
if(isset($_POST['cadastrar'])){
        //verifica se os valores foram recebidos
	if((isset($_POST['nome_documento']))and(isset($_FILES["documento"]))){
			
			//pega os valores dos campos
		$nome_documento = $_POST['nome_documento'];
	   	$nome_temporario=$_FILES["documento"]["tmp_name"];	  
		
			//verifica se o curso já existe
		$verificacao = $DocumentosModeloPlanos->find('', $nome_documento, $resultado->doc_id);
		if(($nome_temporario == '')or($verificacao)){
			
			echo '<script language="javascript">';
			echo "alert('Falha ao tentar realizar o cadastro, documento já existente!');";
			echo '</script>';
			
		}
		else{
			
				//Salva as letras com e sem acento para removeros acentos do caminho do documento
			$comAcentos = array('à', 'á', 'â', 'ã', 'ä', 'å', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ù', 'ü', 'ú', 'ÿ', 'À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'O', 'Ù', 'Ü', 'Ú');
	
			$semAcentos = array('a', 'a', 'a', 'a', 'a', 'a', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'y', 'A', 'A', 'A', 'A', 'A', 'A', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'N', 'O', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U');
	
				//muda para a nova imagem
			$pathinfo = pathinfo($_FILES["documento"]["name"]);
			$caminho = str_replace($comAcentos, $semAcentos, "Documentacao/Coordenacao/".$resultado->doc_ano."/Modelos_de_Planos/".$nome_documento.".".$pathinfo['extension']);
			copy($nome_temporario, $caminho);
			
				//Salva os campos 
			$DocumentosModeloPlanos->setAno($resultado->doc_id); 
			if(!($DocumentosModeloPlanos->setDocumento($nome_documento))){
				
				die('Falha ao tentar realizar o cadastro, limite de caracteres ultrapassado.');
			
			}
			if(!($DocumentosModeloPlanos->setCaminho($caminho))){
				
				die('Falha ao tentar realizar o cadastro, limite de caracteres ultrapassado.');
			
			}
	
				//Insert
			if($DocumentosModeloPlanos->insert()){
				
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
	if(($_POST['id'])and(isset($_POST['nome_documento']))and(isset($_FILES["documento"]))){
			
			//pega os valores dos campos
		$nome_documento = $_POST['nome_documento'];
	   	$nome_temporario=$_FILES["documento"]["tmp_name"];	  
       	$id = $_POST['id'];
		
		
		
				
			//realiza a busca das informações
		$documento = $DocumentosModeloPlanos->find($id, '', $resultado->doc_id);

		if(!($documento)){

			die("Falha na consulta");

		}
			
			//verifica se o curso já existe
		$verificacao = $DocumentosModeloPlanos->find('', $nome_documento, $resultado->doc_id);
		if(($documento->dmp_documento != $nome_documento)and($verificacao)){
			
			echo '<script language="javascript">';
			echo "alert('Falha ao tentar realizar o cadastro, documento já existente!');";
			echo '</script>';
			
		}
		else{
			
				//Salva as letras com e sem acento para removeros acentos do caminho do documento
			$comAcentos = array('à', 'á', 'â', 'ã', 'ä', 'å', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ù', 'ü', 'ú', 'ÿ', 'À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'O', 'Ù', 'Ü', 'Ú');
	
			$semAcentos = array('a', 'a', 'a', 'a', 'a', 'a', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'y', 'A', 'A', 'A', 'A', 'A', 'A', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'N', 'O', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U');
					
			$caminho = $documento->dmp_caminho;
			if($nome_temporario != ''){
					
				if($caminho != ''){
					
					unlink($caminho);    
				
				}
	
					//muda para a nova imagem
				$pathinfo = pathinfo($_FILES["documento"]["name"]);
				$caminho = str_replace($comAcentos, $semAcentos, "Documentacao/Coordenacao/".$resultado->doc_ano ."/Modelos_de_Planos/".$nome_documento.".".$pathinfo['extension']);
				copy($nome_temporario, $caminho);
				
			}
			else{
					
				$extensao = explode('.',$documento->dmp_caminho);
				$caminho = str_replace($comAcentos, $semAcentos, "Documentacao/Coordenacao/".$resultado->doc_ano ."/Modelos_de_Planos/".$nome_documento.".".$extensao[(count($extensao)-1)]);
				rename($documento->dmp_caminho, $caminho);
					
			}
			
			if(!($DocumentosModeloPlanos->setDocumento($nome_documento))){
						
				die('Falha ao tentar realizar o cadastro, limite de caracteres ultrapassado.');
					
			}
			if(!($DocumentosModeloPlanos->setCaminho($caminho))){
						
				die('Falha ao tentar realizar o cadastro, limite de caracteres ultrapassado.');
					
			}
		   
			if($DocumentosModeloPlanos->update($id)){
			
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

//desativacao de um documento
if(isset($_POST['desativar'])){

        //verifica se o id foi recebido
    if(isset($_POST['id'])){

            //pega o valor do id
        $id = (int)$_POST['id'];

            //realiza a busca das informações
        $documento = $DocumentosModeloPlanos->find($id, '', $resultado->doc_id);
    
        if(!($documento)){

            die("Falha na desativacão");

        }
    
        $ativo = $documento->dmp_ativo;

        if($ativo == 'S'){    
            $DocumentosModeloPlanos->setAtivo('N');
            $mensagem = "Desativação"; 
        }
        else{
            $DocumentosModeloPlanos->setAtivo('S');
            $mensagem = "Ativação"; 
        }

        if($DocumentosModeloPlanos->delete($id)){
			
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
    <form action="admin_documentos_modelo_planos_editar.php" method="post" class="eve-admin-form" >
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
   <div class="etec-admin-pad-bar-info"><h1>Modelo de planos</h1></div>
   <div class="etec-admin-pad-bar-info"><i>Informativo:</i>  Nesta página contém informações referente aos modelos de planos.</div>
   <a href="admin_documentos_modelo_planos_cadastro.php"><div class="etec-admin-pad-bar-iten etec-admin-pad-bar-iten-btn " >
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

$modeloplanos = $DocumentosModeloPlanos->findAll($resultado->doc_id, 'N');

if($modeloplanos){	

?>
<div class="etec-admin-pad-conteudo"> 
<?php 

	foreach($modeloplanos as $key => $value):

?>

 <div class="etec-admin-pad-conteudo-unit <?php if($value->dmp_ativo=='N'){
	  echo 'admin-pad-unit-desativ-color';
	  }else{
      echo'admin-pad-unit-ativar-color';
	  } ?>"
      item_id="<?php echo $value->dmp_id; ?>" ativo="<?php echo $value->dmp_ativo; ?>">
   
   <div class="etec-admin-pad-cont-unit-title "><!--- o "conteudo " virou "cont" --->
     Documento
   </div>
   <div class="etec-admin-pad-cont-unit-info" documento>
     <?php  echo $value->dmp_documento; ?>
   </div>

     
   <div class="etec-admin-pad-cont-unit-title "><!--- o "conteudo " virou "cont" --->
     Caminho 
   </div>
   <div class="etec-admin-pad-cont-unit-info-reduces etec-admin-pad-cont-unit-info " <?php if($value->dmp_caminho==""){echo 'align="center"';}?>>
      <?php 
	  
	  	if($value->dmp_caminho==""){
		  
		  	echo '--';
		  
		}
		else{
			
			echo $value->dmp_caminho;
			
		}
		
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
<script src="js/admin_modelo_planos.js"></script>
</body>
</html>