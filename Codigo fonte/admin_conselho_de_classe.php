<?php

include("session.php");

function MyAutoload($className) {    
    $extension =  spl_autoload_extensions();
    require_once (__DIR__ . '/classes/' . $className . $extension);
}

spl_autoload_extensions('.php');
spl_autoload_register('MyAutoload');

	//Pega o ano atual
date_default_timezone_set('America/Sao_Paulo');
$ano = date('Y'); 
$mes = date('n');

if($mes >= 7)
{
	
	$semestre = '1º Semestre';
	
}
else
{

	$semestre = '2º Semestre';
	$ano -= 1;
	
}

$conselhoclassesemestre = new ConselhoClasseSemestre();
$conselhoclasse = new ConselhoClasse();

$conselho = $conselhoclassesemestre->findLast();

if(isset($_GET['ASf2fd5Gj3ASDt4223FfsdS1A78Vr23FG65BbshG6HDFHGJ3fsdFS56TDge453GD652sdfgsd53dghCgfBVCer45t46FG1239hg65jhkGH']) or isset($_POST['idCC']))
{
	
	if(isset($_GET['ASf2fd5Gj3ASDt4223FfsdS1A78Vr23FG65BbshG6HDFHGJ3fsdFS56TDge453GD652sdfgsd53dghCgfBVCer45t46FG1239hg65jhkGH']))
	{
		
		$id_conselho_classe = $_GET['ASf2fd5Gj3ASDt4223FfsdS1A78Vr23FG65BbshG6HDFHGJ3fsdFS56TDge453GD652sdfgsd53dghCgfBVCer45t46FG1239hg65jhkGH'];
	
	}
	else
	{
	
		$id_conselho_classe = $_POST['idCC'];
		
	}
	
	$conselho_escolhido = $conselhoclassesemestre->find($id_conselho_classe);
	
	if(!$conselho_escolhido){
		echo $conselho_escolhido;
		die(header('location:admin_conselho_de_classe_semestre.php'));
		
	}
	
}
else
{
	
	die(header('location:admin_conselho_de_classe_semestre.php'));
	
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
<title>Conselho de Classes - <?php echo $conselho_escolhido->ccs_ano.'/'.$conselho_escolhido->ccs_semestre; ?></title>

</head>
<body>

<?php 

include("admin_menu.php");/*inclusao do menu do site*/

if( ($conselho != false) and ($conselho->ccs_ano == $ano) and ($conselho->ccs_semestre == $semestre) and ($conselho->ccs_id == $conselho_escolhido->ccs_id) ){
	
	//edicao de um arquivo do conselho no mysql 
	if(isset($_POST['editar'])){
	
			//verifica se os valores foram recebidos
		if( (isset($_POST['periodo'])) and (isset($_POST['turma'])) and (isset($_FILES['documento'])) and (isset($_POST['id'])) ){
			  //pega os valores dos campos
			$periodo = $_POST['periodo'];
			$turma = $_POST['turma'];
			$nome_temporario=$_FILES["documento"]["tmp_name"]; 
			$id = $_POST['id'];
			
			$documento = $conselhoclasse->find($id);
			
			
			if( ($documento) and ($documento->cc_conselho == $conselho->ccs_id) )
			{ 			
				
								//Salva os campos 
				if(!($conselhoclasse->setPeriodo($periodo))){
					
					die('Falha ao tentar realizar o cadastro, opção inválida.');
				
				}
				if(!($conselhoclasse->setTurma($turma))){
					
					die('Falha ao tentar realizar o cadastro, limite de caracteres ultrapassado.');
				
				}
				
					//Verifica se o arquivo já existe
				$conselhoclasse->setConselho($conselho->ccs_id);
				$verificacao = $conselhoclasse->find(0);
				if( (!$verificacao) or  ($verificacao->cc_id == $documento->cc_id) )
				{
				
					
					if( $nome_temporario == '' )
					{
					
						$nome_temporario = $documento->cc_documento;
						$pathinfo = pathinfo($nome_temporario);
						$apagar = True;
						
					}
					else
					{

						$pathinfo = pathinfo($_FILES["documento"]["name"]);
						$apagar = False;
						if($documento->cc_documento != ''){
							
							unlink($documento->cc_documento);    
						
						}
					
					}
					
					
									//Salva as letras com e sem acento para removeros acentos do caminho do documento
					$comAcentos = array('à', 'á', 'â', 'ã', 'ä', 'å', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ù', 'ü', 'ú', 'ÿ', 'À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'O', 'Ù', 'Ü', 'Ú','/','º','\\');
		
					$semAcentos = array('a', 'a', 'a', 'a', 'a', 'a', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'y', 'A', 'A', 'A', 'A', 'A', 'A', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'N', 'O', 'O', 'O', 'O', 'O', '0', 'U', 'U', 'U','','','');
		
						//muda para a nova imagem
					
					$caminho = "Documentacao/Secretaria academica/Conselho de Classe/".str_replace($comAcentos, $semAcentos, $conselho->ccs_ano.' - '.$conselho->ccs_semestre)."/".str_replace($comAcentos, $semAcentos, $periodo).'/'.str_replace($comAcentos, $semAcentos, $turma).".".$pathinfo['extension'];
					copy($nome_temporario, $caminho);
			
						//Salva o caminho
					if(!($conselhoclasse->setDocumento($caminho))){
						
						die('Falha ao tentar realizar o cadastro, limite de caracteres ultrapassado.');
					
					}
					
					if( $apagar )
					{
					
						if($documento->cc_documento != ''){
							
							unlink($documento->cc_documento);    
						
						}
					
					}
						
					if($conselhoclasse->update($id)){
					
						echo '<script language="javascript">';
						echo "alert('Edição bem sucedida!');";
						echo '</script>';
					
					}
					else{
						
						echo '<script language="javascript">';
						echo "alert('Falha na edição do arquivo selecionado!');";
						echo '</script>';
						
					}
				
				}
				else
				{
					
					echo '<script language="javascript">';
					echo "alert('Falha ao tentar realizar a edição, o arquivo com periodo \'".$periodo."\' e turma \'".$turma."\' já existe!');";
					echo '</script>';
					
				}
				
			}
			else{
				
				echo '<script language="javascript">';
				echo "alert('Falha na edição do arquivo selecionado!');";
				echo '</script>';
				
			}
	
		}   
	
	}
	
	//Cadastro de um novo arquivo do conselho
	if(isset($_POST['cadastrar'])){
			//verifica se os campos foram recebidos
		if( (isset($_POST['periodo'])) and (isset($_POST['turma'])) and (isset($_FILES['documento'])) ){
			  //pega os valores dos campos
			$periodo = $_POST['periodo'];
			$turma = $_POST['turma'];
			$nome_temporario=$_FILES["documento"]["tmp_name"]; 
	
							//Salva os campos 
			$conselhoclasse->setConselho($conselho->ccs_id);
			if(!($conselhoclasse->setPeriodo($periodo))){
				
				die('Falha ao tentar realizar o cadastro, opção inválida.');
			
			}
			if(!($conselhoclasse->setTurma($turma))){
				
				die('Falha ao tentar realizar o cadastro, limite de caracteres ultrapassado.');
			
			}
			
			//Verifica se o arquivo já existe
			$verificacao = $conselhoclasse->find(0);
			if(!$verificacao)
			{
				
								//Salva as letras com e sem acento para removeros acentos do caminho do documento
				$comAcentos = array('à', 'á', 'â', 'ã', 'ä', 'å', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ù', 'ü', 'ú', 'ÿ', 'À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'O', 'Ù', 'Ü', 'Ú','/','º','\\');
	
				$semAcentos = array('a', 'a', 'a', 'a', 'a', 'a', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'y', 'A', 'A', 'A', 'A', 'A', 'A', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'N', 'O', 'O', 'O', 'O', 'O', '0', 'U', 'U', 'U','','','');
	
					//muda para a nova imagem
				$pathinfo = pathinfo($_FILES["documento"]["name"]);
				$caminho = "Documentacao/Secretaria academica/Conselho de Classe/".str_replace($comAcentos, $semAcentos, $conselho->ccs_ano.' - '.$conselho->ccs_semestre)."/".str_replace($comAcentos, $semAcentos, $periodo).'/'.str_replace($comAcentos, $semAcentos, $turma).".".$pathinfo['extension'];
				copy($nome_temporario, $caminho);
		
					//Salva o caminho
				if(!($conselhoclasse->setDocumento($caminho))){
					
					die('Falha ao tentar realizar o cadastro, limite de caracteres ultrapassado.');
				
				}
				
						//Insert
				if($conselhoclasse->insert()){
					
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
			else
			{
				
				echo '<script language="javascript">';
				echo "alert('Falha ao tentar realizar o cadastro, o arquivo com periodo \'".$periodo."\' e turma \'".$turma."\' já existe!');";
				echo '</script>';
				
			}
			
		}
	}
	
	//desativacao de um arquivo do conselho no mysql 
	if(isset($_POST['desativar'])){
	
			//verifica se o id foi recebido
		if(isset($_POST['id'])){
	
				//pega o valor do id
			$id = (int)$_POST['id'];
	
				//realiza a busca das informações
			$resultado = $conselhoclasse->find($id);
		
			if(!($resultado)){
	
				die("Falha na desativacão");
	
			}
		
			$ativo = $resultado->cc_ativo;
	
			if($ativo == 'S'){    
				$conselhoclasse->setAtivo('N');
				$mensagem = "Desativação"; 
			}
			else{
				$conselhoclasse->setAtivo('S');
				$mensagem = "Ativação"; 
			}
	
			if($conselhoclasse->delete($id)){
				
				echo '<script language="javascript">';
				echo "alert('".$mensagem." bem sucedida!');";
				echo '</script>';
				
			}
			else{
				
				echo '<script language="javascript">';
				echo "alert('Falha na Desativação/Ativação da data selecionado!');";
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
   	<form action="admin_conselho_de_classe_editar.php" method="post" class="eve-admin-form" >
      	<label for='Editar' >Editar</label>
     	<input type="submit" name="editar" value="Editar" editar  class="btn" id="Editar"/>
        <input  id="editar" name="id" type="hidden" value=""  />
    </form>
    <form action="#" method="post">
     	<label for='Desativar' desativar>Desativar</label>
     	<input type="submit" name="desativar" value="Desativar"  class="btn" id="Desativar" />
        <input id="desativar" name="id" type="hidden" value=""  />
        <input name="idCC" type="hidden" value="<?php echo $conselho->ccs_id; ?>"  />
    </form>
   </div> <!--fechamento da classe "etec-pop-p-tela-informacoes-two-op"-->   
  
</div><!---fechamento da class"etec-pop-p-tela-informacoes-two-op"-->
</div><!---fechamento da class"etec-pop-up-tela-informacoes-fundo"-->

<?php

}

?>

<main class="etec-admin-pag-padrao">


<div class="etec-admin-pad-barlateral">
   <div class="etec-admin-pad-bar-info"><h1>Conselho de classe <?php echo $conselho_escolhido->ccs_ano.' - '.$conselho_escolhido->ccs_semestre; ?> - Membros</h1></div>
   <div class="etec-admin-pad-bar-info"><i>Informativo:</i>  Nesta página contém informações referente ao arquivos do conselho de classe.
<?php
	
if( ($conselho->ccs_id == $conselho_escolhido->ccs_id) or ($conselho == false) or ($conselho->ccs_ano != $ano) or ($conselho->ccs_semestre != $semestre) ){

?>
 Logo abaixo desta mensagem há a seguinte opção: 
      
    <p><strong>"Cadastrar"</strong> Botão que irá redireciona-lo à página de cadastro;</p>  
  
    </div>
 
   <a href="admin_conselho_de_classe_cadastro.php"><div class="etec-admin-pad-bar-iten etec-admin-pad-bar-iten-btn " >
   Cadastrar
   </div></a>
   <a href="admin_conselho_de_classe_semestre.php"><div class="etec-admin-pad-bar-iten etec-admin-pad-bar-iten-btn " >
   Voltar
   </div></a>
<?php

}
else
{

?>

	<a href="admin_conselho_de_classe_semestre.php"><div class="etec-admin-pad-bar-iten etec-admin-pad-bar-iten-btn " >
   Voltar
   </div></a>
	</div>
    
<?php

}

?>    

 </div><!--fechamento da class"etec-admin-pad-barlateral"-->
 <div class="etec-admin-pad-conteudo">
 
<?php 

$conselhoclasse->setConselho($conselho_escolhido->ccs_id);

$arquivo = $conselhoclasse->findAll();

if($arquivo){

	foreach($arquivo as $key => $value):

		if( (($conselho->ccs_id != $conselho_escolhido->ccs_id) or !( ($conselho->ccs_ano == $ano) and ($conselho->ccs_semestre == $semestre) ) ) and ($value->cc_documento != '') ){

?>
        
   <a href="<?php echo $value->cc_documento; ?>" target="_blank">
        
<?php

		}

?>
 <div class="etec-admin-pad-conteudo-unit <?php if($value->cc_ativo == 'N'){
	  echo 'admin-pad-unit-desativ-color';
	  }else{
      echo'admin-pad-unit-ativar-color';
	  } ?>"
      item_id="<?php echo $value->cc_id; ?>" ativo="<?php echo $value->cc_ativo; ?>">
   
   <div class="etec-admin-pad-cont-unit-title "><!--- o "conteudo " virou "cont" --->
     Período
   </div>
   <div class="etec-admin-pad-cont-unit-info" >
     <?php echo $value->cc_periodo; ?>
   </div>
   <div class="etec-admin-pad-cont-unit-title "><!--- o "conteudo " virou "cont" --->
     Turma
   </div>
   <div class="etec-admin-pad-cont-unit-info" conselho_classe_turma>
     <?php echo $value->cc_turma; ?>
   </div>
     
  </div><!--fechamento da class"etec-admin-pad-conteudo-unit"-->
<?php 
		
		if( (($conselho->ccs_id != $conselho_escolhido->ccs_id) or ( ($conselho->ccs_ano == $ano) and ($conselho->ccs_semestre == $semestre) ) ) and ($value->cc_documento != '') ){
?>
        
	</a>
        
<?php

		}

	endforeach;

}

?>
 </div><!--fechamento da class"etec-admin-pad-conteudo-->
</main>
<?php 
	
if( ($conselho != false) and ($conselho->ccs_ano == $ano) and ($conselho->ccs_semestre == $semestre) and ($conselho->ccs_id == $conselho_escolhido->ccs_id) ){

?>
<script src="js/admin_conselho_classe.js"></script>
<?php

}

?>
</body>
</html>>>