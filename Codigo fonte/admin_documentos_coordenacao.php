<?php

include("session.php");

function MyAutoload($className) {    
    $extension =  spl_autoload_extensions();
    require_once (__DIR__ . '/classes/' . $className . $extension);
}

spl_autoload_extensions('.php');
spl_autoload_register('MyAutoload');
 
$DocumentosAno = new DocumentosAno(); 
$DocumentosCoordenacao = new DocumentosCoordenacao();

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

//edicao de documento 
if(isset($_POST['editar'])){

        //verifica se os valores foram recebidos
	if(($_POST['id'])and(isset($_FILES["documento"]))){
			
			//pega os valores dos campos
	   	$nome_temporario=$_FILES["documento"]["tmp_name"];	  
       	$id = $_POST['id'];
		
		if($nome_temporario != ''){
			
				//realiza a busca das informações
			$documento = $DocumentosCoordenacao->find($id);

			if(!($documento)){

				die("Falha na consulta");

			}
			
			if($documento->dc_caminho != ''){
				
				unlink($documento->dc_caminho);    
			
			}
			
				//Salva as letras com e sem acento para removeros acentos do caminho do documento
			$comAcentos = array('à', 'á', 'â', 'ã', 'ä', 'å', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ù', 'ü', 'ú', 'ÿ', 'À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'O', 'Ù', 'Ü', 'Ú','/');

			$semAcentos = array('a', 'a', 'a', 'a', 'a', 'a', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'y', 'A', 'A', 'A', 'A', 'A', 'A', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'N', 'O', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U',' ');

				//muda para a nova imagem
			$pathinfo = pathinfo($_FILES["documento"]["name"]);
			$caminho = "Documentacao/Coordenacao/".$resultado->doc_ano ."/Padroes/".str_replace($comAcentos, $semAcentos, $documento->dc_documento).".".$pathinfo['extension'];
			copy($nome_temporario, $caminho);
			
			if(!($DocumentosCoordenacao->setCaminho($caminho))){
						
				die('Falha ao tentar realizar o cadastro, limite de caracteres ultrapassado.');
					
			}
		   
			if($DocumentosCoordenacao->update($id)){
			
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

?>



<main class="etec-admin-pag-padrao">


<div class="etec-admin-pad-barlateral">
   <div class="etec-admin-pad-bar-info"><h1>Documentos Coordenação</h1></div>
   <div class="etec-admin-pad-bar-info"><i>Informativo:</i>  Nesta página contém informações referente aos documentos da coordenação.</div>
	
    <a href="admin_coordenacao.php" ><div class="etec-admin-pad-bar-iten etec-admin-pad-bar-iten-btn " >
   	Voltar
   	</div></a>
  
<?php  

include("admin_barra_lateral_legendcores.php");

?> 
    
   
 </div><!--fechamento da class"etec-admin-pad-barlateral"-->
 <div class="etec-admin-pad-conteudo">
 
<?php 

foreach($DocumentosCoordenacao->findAll($resultado->doc_id) as $key => $value):

?>
<a href="admin_documentos_coordenacao_editar.php?A44dsddERTjsJfdJLsSrEUd566457IfdKddItfAfnNB57hyDVSa56JgSaKPd3U4SFfa4434fdsdsttv5fd3DdfDdDS45S45SDF3=<?php echo $value->dc_id; ?>" >       
 <div class="etec-admin-pad-conteudo-unit admin-pad-unit-ativar-color">
   
   <div class="etec-admin-pad-cont-unit-title "><!--- o "conteudo " virou "cont" --->
     Documento
   </div>
   <div class="etec-admin-pad-cont-unit-info">
     <?php  echo $value->dc_documento; ?>
   </div>

     
   <div class="etec-admin-pad-cont-unit-title "><!--- o "conteudo " virou "cont" --->
     Caminho 
   </div>
   <div class="etec-admin-pad-cont-unit-info-reduces etec-admin-pad-cont-unit-info " <?php if($value->dc_caminho==""){echo 'align="center"';}?>>
      <?php 
	  
	  	if($value->dc_caminho==""){
		  
		  	echo '--';
		  
		}
		else{
			
			echo $value->dc_caminho;
			
		}
		
		?>
   </div>
   
   
     
  </div><!--fechamento da class"etec-admin-pad-conteudo-unit"-->
  </a><!--fechamento do link que envolve todo o container -->
<?php 

endforeach;

?>
 </div><!--fechamento da class"etec-admin-pad-conteudo-->
</main>

</body>
</html>