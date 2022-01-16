<?php

include("session.php");

	//Se chamada a funcao editar o cache será limpado
if(isset($_POST['editar'])){

	header("Cache-Control: no-cache, must-revalidate");

}

function MyAutoload($className) {    
    $extension =  spl_autoload_extensions();
    require_once (__DIR__ . '/classes/' . $className . $extension);
}

spl_autoload_extensions('.php');
spl_autoload_register('MyAutoload');
  
$Gremios = new Gremio();
$Membros = new ComposicaoGremio();
$Albuns = new Album();
$Imagens = new Imagem();

	//busca o ano atual
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

                                 <!-- titulo da pagina -->
<title>Grêmio</title>

</head>
<body>

<?php 

include("admin_menu.php");/*inclusao do menu do site*/

//edicao de data do calendario no mysql 
if(isset($_POST['editar'])){
	
	    //verifica se é permitido a edição do gremio
	$gremio_atual = $Gremios->find($date);
	
	if($gremio_atual){
		
			//verifica se os valores foram recebidos
		if((isset($_POST['nome']))and(isset($_POST['imagens']))and(isset($_FILES['imagem']))and(isset($_POST['facebook']))and(isset($_POST['instagram']))){
	   
				//pega os valores dos campos
			$nome = $_POST['nome'];
			$imagens = $_POST['imagens'];
			$facebook = $_POST['facebook'];
			$instagram = $_POST['instagram'];		
			
				//verifica se a imagem foi mudada
			if ($_FILES["imagem"]["name"]!=""){
				
							//pega as informações atuais da imagem 
				$resultado = $Imagens->findPrincipal($gremio_atual->g_album);
		
				if(!($resultado)){
					
						//cria o caminho da imagem
					$resultado = $Imagens->CountImagens($gremio_atual->g_album, 'S');
					$nome_imagem = $resultado->Quantidade;
					$caminho = 'Imagens/Albuns/'.$gremio_atual->g_album.'/'.$nome_imagem.'.jpg';
					
						//Cadastra a imagem
					$Imagens->setTitulo('');
					$Imagens->setAlt('');
					$Imagens->setCaminho($caminho);
					$Imagens->setAlbum($gremio_atual->g_album);
					$Imagens->setPrincipal('S');
					
					if(!($Imagens->insert())){
					
						die('Falha ao realizar o cadastro.');
					
					}
	
				}
				else{
					
						//Se já existe a imagem pega-se o caminho dela
					$caminho = $resultado->i_caminho; 
					
				}
				
					//muda para a nova imagem   
				$nome_temporario=$_FILES["imagem"]["tmp_name"];
				copy($nome_temporario,$caminho);
				
			}
			
				//Salva os campos 
		    if(!($Gremios->setNome($nome))){
			
				die('Falha ao tentar realizar a edição, limite de caracteres ultrapassado.');
		
			}
			if(!($Gremios->setImagens($imagens))){
			
				die('Falha ao tentar realizar a edição, opção inválida.');
		
			}
		    if(!($Gremios->setFacebook($facebook))){
			
				die('Falha ao tentar realizar a edição, limite de caracteres ultrapassado.');
		
			}
		    if(!($Gremios->setInstagram($instagram))){
			
				die('Falha ao tentar realizar a edição, limite de caracteres ultrapassado.');
		
			}
		   
		   		//Realiza a edição
			if($Gremios->update($gremio_atual->g_id)){
			
				echo '<script language="javascript">';
				echo "alert('Edição bem sucedida!');";
				echo '</script>';
			
			}
			else{
				
				echo '<script language="javascript">';
				echo "alert('Falha na edição do grêmio!');";
				echo '</script>';
				
			}
	
		}   
		
	}
	else{
	
		echo '<script language="javascript">';
		echo "alert('Falha na edição do grêmio!');";
		echo '</script>';
		
	}

}

if(isset($_POST['cadastrar'])){
	
	    //verifica se é necessario o cadastro do grêmio
	$gremio_atual = $Gremios->find($date);
	
	if(!($gremio_atual)){
		
					//Cria o album onde seram salvas as imagens do gremio
			//Cadastra o album
		$titulo = "Gremio ".$date;
		$Albuns->setTitulo($titulo);
		
		if(!($Albuns->insert())){
		
			die('Falha ao realizar o cadastro.');
		
		}
		
			//busca o id do album
		$id = $Albuns->findLast();
		
		mkdir(__DIR__."/Imagens/Albuns/".$id->id, 0777);
			
		   //Salva os campos 
        $Gremios->setAno($date);
		$Gremios->setAlbum($id->id);
		
            //Insert
        if($Gremios->insert()){
			
			    //Pega as informações do gremio
			$gremio_atual = $Gremios->find($date);
			
						//Cria os demais membros do grêmio
			
			$cargos = array('Presidente','Vice-Presidente','Diretor Social','Diretor Cultural','Diretor de Imprensa','Diretor de Esportes','Orador','1º Secretário','2º Secretário','1º Tesoureiro','2º Tesoureiro','1º Suplente','2º Suplente');
			$Membros->setGremio($gremio_atual->g_id);
			
				//Cria as outras imagens
			for($i=1;$i<=13;$i++){
					
					//Cadastra o Membro do gremio
				$Membros->setFuncao($cargos[($i-1)]);
				if(!($Membros->insert())){
			
					die('Falha ao realizar o cadastro.');
			
				}
			
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
   <div class="etec-admin-pad-bar-info"><h1>Gremio estudantil</h1></div>
   <div class="etec-admin-pad-bar-info"><i>Informativo:</i>  Nesta página contém informações referente aos cursos oferecidos pela escola. Logo abaixo desta mensagem há as seguintes opções: 
      
    <p><strong>"Cadastrar"</strong> Botão que irá redireciona-lo à página de cadastro(Esse botão sómente estará disponivel caso o grêmio do ano atual ainda não ter sido cadastrado);</p>  
    <p><strong>Alterar</strong> Botão que irá redireciona-lo à página de edição;</p>
    <p><strong>Plano de trabalho</strong> Botão que irá redireciona-lo à página de plano de trabalho do grêmio estudantil atual.</p>  
   </div>
  
  
 <?php 
  
    //realiza a busca do ultimo gremio estudantil
$gremio_atual = $Gremios->find($date);
	
if(!($gremio_atual)){
	
?>
<form action="admin_gremio.php" method="post">
   <label for="btn_cadastrar" ><div class="etec-admin-pad-bar-iten etec-admin-pad-bar-iten-btn " >
   Cadastrar
   </div></label>
    <input type="submit" name="cadastrar" id="btn_cadastrar" />
</form>
 <?php }else{ ?> 
   <a href="admin_gremio_plano_trabalho.php" ><div class="etec-admin-pad-bar-iten-alment etec-admin-pad-bar-iten etec-admin-pad-bar-iten-btn " >
   Plano de trabalho
   </div></a>
   
   <a href="admin_gremio_editar.php" ><div class="etec-admin-pad-bar-iten etec-admin-pad-bar-iten-btn " >
   Alterar
   </div></a>
<?php 

} 
  
include("admin_barra_lateral_legendcores.php");

?> 
 
   
 </div><!--fechamento da class"etec-admin-pad-barlateral"-->

 <div class="etec-admin-pad-conteudo">
<form action="admin_gremio_estudantil_composicao.php" method="post" >
<input name="id" type="hidden" value="" class="gremio_composicao" />
<input name="btn" type="submit" class="input_typ_subm_none gremio_btn input_file"  /> 

<?php 

foreach($Gremios->findAll() as $key => $value):


		 
		//verifica se há imagem  principal no album
	$resultado = $Imagens->findPrincipal($value->g_album);
	   
	if(!$resultado){
	
			//se não foi encontrada, e chamada uma imagem pré definida
		$imagem = array('','Imagem não encontrada','Imagens/Imagens estaticas/Outras imagens/gremio_estudantil.jpg'); 
	
	}
	else{
	
			//se foi encontrada, a imagem sendo cadastrada não recebe prioridade
		$imagem = array($resultado->i_titulo,$resultado->i_alt,$resultado->i_caminho); 
	
	}

?>
        
 <div class="etec-admin-pad-conteudo-unit-reduces  <?php if($value->g_ano != $date){
	  echo 'admin-pad-unit-inative-color';
	  }else{
      echo'admin-pad-unit-ativar-color';
	  } ?>"
      item_id="<?php echo $value->g_id; ?>">
      
  
   <div class="etec-admin-pad-cont-unit-title "><!--- o "conteudo " virou "cont" --->
     Nome
   </div>
   <div class="etec-admin-pad-cont-unit-info" <?php if($value->g_nome == ""){echo 'align="center"';}?>>
     <?php if($value->g_nome==""){echo '--';}else{echo $value->g_nome;}  ?>
   </div>
   
    
    <div class="etec-admin-pad-cont-unit">
     
        <div class="etec-admin-pad-cont-unit-title "><!--- o "conteudo " virou "cont" --->
         Data
        </div>
        <div class="etec_admin-pad-cont-unit-info-aling etec-admin-pad-cont-unit-info" <?php if($value->g_ano==""){echo 'align="center"';}?>>
         <?php if($value->g_ano==""){echo '--';}else{echo $value->g_ano;}  ?>
        </div>
    
   </div><!--fechamento da class"etec-admin-cont-unit-dis"-->
   
   <div class="etec-admin-pad-cont-unit">
     
        <div class="etec-admin-pad-cont-unit-title "><!--- o "conteudo " virou "cont" --->
         Imagens dos membros
        </div>
        <div class="etec_admin-pad-cont-unit-info-aling etec-admin-pad-cont-unit-info">
        <?php 
		 
		if($value->g_imagens == 'S'){
			 
			echo 'Exibir'; 
			 
		}
		else{
			
			echo 'Não exibir'; 
			
		}
		
		?>
        </div>
    
   </div><!--fechamento da class"etec-admin-cont-unit-dis"-->

	<div class="etec-admin-pad-cont-unit">
     
        <div class="etec-admin-pad-cont-unit-title "><!--- o "conteudo " virou "cont" --->
         Facebook
        </div>
        <div class="etec_admin-pad-cont-unit-info-aling etec-admin-pad-cont-unit-info"  <?php if($value->g_ano==""){echo 'align="center"';}?>>
		<?php 
			if($value->g_facebook == "")
			{ 
				echo '--';
			}
			else
			{
				echo $value->g_facebook;
			}
		?>
        </div>
    
   </div><!--fechamento da class"etec-admin-cont-unit-dis"-->
   <div class="etec-admin-pad-cont-unit">
     
        <div class="etec-admin-pad-cont-unit-title "><!--- o "conteudo " virou "cont" --->
         Instagram
        </div>
        <div class="etec_admin-pad-cont-unit-info-aling etec-admin-pad-cont-unit-info" <?php if($value->g_ano==""){echo 'align="center"';}?>>
        <?php 
			if($value->g_instagram == "")
			{ 
				echo '--';
			}
			else
			{
				echo $value->g_instagram;
			}
		?>
        </div>
    
   </div><!--fechamento da class"etec-admin-cont-unit-dis"-->
  <div class="etec-admin-pad-cont-unit-title "><!--- o "conteudo " virou "cont" --->
     Foto
   </div>
   <div class="etec-admin-pad-cont-unit-info-img etec-admin-pad-cont-unit-info ">
     <img src="<?php echo $imagem[2]; ?>?var=<?php echo rand(); ?>" alt="<?php echo $imagem[1]; ?>" title="<?php echo $imagem[0]; ?>" />    
   </div>
   
   

     
  </div><!--fechamento da class"etec-admin-pad-conteudo-unit"-->

<?php  
	
	endforeach;
	
?>
  </form>    
 </div><!--fechamento da class"etec-admin-pad-conteudo-->
</main>




<script src="js/gremio_admin.js"></script>
</body>
</html>