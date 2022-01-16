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
  
$Imagens = new Imagem();
$Albuns = new Album();

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
<title>Imagens</title>
</head>
<body>

<?php 

include("admin_menu.php");/*inclusao do menu do site*/

//Verifica se o album a ser mostrado foi escolhindo
if(isset($_GET['Ads433DFShUIwW34BmjLSD67Er4GDFD56GDSHJ6575GY4GFD6KU353sfsDr6RrfSDSGhhtdtFD3F55dgDs58s85hd'])){

	$id_album = $_GET['Ads433DFShUIwW34BmjLSD67Er4GDFD56GDSHJ6575GY4GFD6KU353sfsDr6RrfSDSGhhtdtFD3F55dgDs58s85hd'];
	
	if($id_album == 72){
		
		$pesquisa = 0;
		
	}
	else
	{
		
		$pesquisa = 2;
		
	}
	
		//realiza a busca das informações
    $info_album = $Albuns->find($id_album, $pesquisa);
	
    if(!($info_album)){

    	echo '<script language="javascript">';
    	echo  'window.location.href = "admin_album.php";';
    	echo '</script>';

    }
	
}
else{

	echo '<script language="javascript">';
    echo  'window.location.href = "admin_album.php";';
    echo '</script>';

}

		//Verifica se pode ser realizado o cadastro/ativacao de imagen
$permissao = 'S';
		
	//Verifica se é um album de programa relacionado
$album_verificacao = $Albuns->find($id_album, 3);
if($album_verificacao){
	
		//Verifica se o limite de imagens foi atingido
	$qtd_imagens = $Imagens->CountImagens($info_album->a_id, 'S');
	
	if($qtd_imagens->Quantidade == 7){
		
		$permissao = 'N';
		
	}
	
}

	//Cadastra uma imagem
if(isset($_POST['cadastrar'])){

		//Verifica se tem permissação para cadastrar a imagem
	if($permissao == 'S'){
		
			//verifica se os campos foram recebidos
		if((isset($_POST['titulo']))and(isset($_POST['alt']))and(isset($_POST['album']))and(isset($_FILES["imagem"]))){
				//pega os valores dos campos
			$titulo = $_POST['titulo'];
			$alt = $_POST['alt'];
			$album = $_POST['album'];
	
				//verificase o album esta disponivel para alterações
			$resultado = $Albuns->find($album, $pesquisa);
		
			if(!($resultado)){
	
				die("Falha na consulta");
	
			}		
			
				//realiza a busca da quantidade de imagens no album pararenomear a imagem
			$resultado = $Imagens->CountImagens($album, 'N');
			$nome_imagem = $resultado->Quantidade;
			
				//faz upload da imagem
			$nome_temporario=$_FILES["imagem"]["tmp_name"];
			$caminho = 'Imagens/Albuns/'.$album.'/'.$nome_imagem.'.jpg';
			copy($nome_temporario,$caminho);
			
				//verifica se há imagem  principal no album
			$resultado = $Imagens->findPrincipal($album);	
			if(!$resultado){
					//se não foi encontrada, a imagem sendo cadastrada recebe prioridade
				$principal = 'S';
			}
			else{
					//se foi encontrada, a imagem sendo cadastrada não recebe prioridade
				$principal = 'N';
			}
	
				//Salva os campos 
			if(!($Imagens->setTitulo($titulo))){
				
				die('Falha ao tentar realizar o cadastro, limite de caracteres ultrapassado.');
			
			}
			if(!($Imagens->setAlt($alt))){
				
				die('Falha ao tentar realizar o cadastro, limite de caracteres ultrapassado.');
			
			}
			$Imagens->setCaminho($caminho);
			$Imagens->setAlbum($album);
			$Imagens->setPrincipal($principal);
	
				//Insert
			if($Imagens->insert()){
				
					//Verifica o limite de imagens
				if($album_verificacao){
					
					if(($qtd_imagens->Quantidade + 1) == 7){
						
						$permissao = 'N';
						
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
	else{
	
		echo '<script language="javascript">';
		echo "alert('Limite de imagens atingido, desative alguma imagem para prosseguir.');";
		echo '</script>';	
		
	}
		
}



//edicao de data do calendario no mysql 
if(isset($_POST['editar'])){

        //verifica se os valores foram recebidos
    if((isset($_POST['titulo']))and(isset($_POST['alt']))and(isset($_FILES["imagem"]))and(isset($_POST['id']))){
   
            //pega os valores dos campos
        $id = $_POST['id'];
        $titulo = $_POST['titulo'];
   		$alt = $_POST['alt'];
		
			//verifica se a imagem foi mudada
   		if ($_FILES["imagem"]["name"] != ""){
			
			   			//pega as informações atuais da imagem 
      		$resultado = $Imagens->find($id);
	
    		if(!($resultado)){

    			die("Falha na consulta");

    		}
			
	  			//muda para a nova imagem   
			$caminho = $resultado->i_caminho; 
      		$nome_temporario=$_FILES["imagem"]["tmp_name"];
      		copy($nome_temporario,$caminho);
			
   		}
		
            //Salva os campos 
		if(!($Imagens->setTitulo($titulo))){
			
			die('Falha ao tentar realizar a edição, limite de caracteres ultrapassado.');
		
		}
		if(!($Imagens->setAlt($alt))){
			
			die('Falha ao tentar realizar a edição, limite de caracteres ultrapassado.');
		
		}
       
        if($Imagens->update($id)){
        
            echo '<script language="javascript">';
            echo "alert('Edição bem sucedida!');";
            echo '</script>';
        
        }
		else{
			
			echo '<script language="javascript">';
            echo "alert('Falha na edição da imagem selecionada!');";
            echo '</script>';
			
		}

    }   

}

//desativacao de uma data do calendario no mysql 
if(isset($_POST['desativar'])){

        //verifica se o id foi recebido
    if(isset($_POST['id'])){

            //pega o valor do id
        $id = (int)$_POST['id'];

            //realiza a busca das informações
        $resultado = $Imagens->find($id);
    
        if(!($resultado)){

            die("Falha na desativacão");

        }
    
        $ativo = $resultado->i_ativo;
		$principal = $resultado->i_principal;
		$album = $resultado->i_album;

        if($ativo == 'S'){  
			
			//Verifica a imagem pertence a um programa relacionado
			if(($album_verificacao)and($qtd_imagens->Quantidade == 1)){
				
				$Imagens->setAtivo('S');
				$Imagens->setAtivo('S');
				$mensagem = "Impossivel realizar a desativação, os programas relacionados devem possuir pelo menos uma imagem!"; 
				
			}
			else{
							
				if($principal == 'S'){
					
						//busca uma imagem para priorizar
					$resultado = $Imagens->findRandom($album);
		
					if($resultado){
						
							//prioriza a outra imagem
						$Imagens->setPrincipal('S');
						
						if(!$Imagens->priorizar($resultado->i_id)){
						
							die('Falha na desativacão');	
				
						}
						
					}
					
						//desprioriza a imagem
					$Imagens->setPrincipal('N');	
						
					if(!$Imagens->priorizar($id)){
						
						die('Falha na desativacão');	
				
					}	
								
				}
			
				
				$Imagens->setAtivo('N');
				$mensagem = "Desativação  bem sucedida!"; 
				$permissao = 'S';

			}
			
		}
        else{
				//Verifica se é permitido a ativação
			if($permissao == 'S'){
				
					//verifica se há imagem  principal no album
				$resultado = $Imagens->findPrincipal($album);	
				if(!$resultado){
						//se não foi encontrada, a imagem sendo ativada recebe prioridade
					$Imagens->setPrincipal('S');	
						
					if(!$Imagens->priorizar($id)){
						
						die('Falha na desativacão');	
				
					}
				}
				
				$Imagens->setAtivo('S');
				$mensagem = "Ativação bem sucedida!"; 
				if($album_verificacao){
					
					if(($qtd_imagens->Quantidade + 1) == 7){
						
						$permissao = 'N';
						
					}
					
				}
				
			}
			else{
				
				$Imagens->setAtivo('N');
				
				echo '<script language="javascript">';
				echo "alert('Limite de imagens atingido, desative alguma imagem para prosseguir.');";
				echo '</script>';	
				
			}	
        
		}
		
        if($Imagens->delete($id)){
			
            echo '<script language="javascript">';
            echo "alert('".$mensagem."');";
            echo '</script>';
			
        }
		else{
			
			echo '<script language="javascript">';
            echo "alert('Falha na Desativação/Ativação da imagem selecionada!');";
            echo '</script>';
			
		}
  
    }
 
}

//desativacao de uma data do calendario no mysql 
if(isset($_POST['Priorizar'])){

        //verifica se o id foi recebido
    if(isset($_POST['id'])){

            //pega o valor do id
        $id = (int)$_POST['id'];

            //realiza a busca das informações
        $resultado = $Imagens->find($id);
    
        if(!($resultado)){

            die("Falha ao tentar realizar a ação solicitada.");

        }
    
        $ativo = $resultado->i_ativo;
		$principal = $resultado->i_principal;
		$album = $resultado->i_album;
		
		if($ativo == 'S'){
			
			if($principal == 'S'){
				
				    //busca uma imagem para priorizar
        		$resultado = $Imagens->findRandom($album);
    
        		if($resultado){
					
						//prioriza a outra imagem
					$Imagens->setPrincipal('S');
					
					if(!$Imagens->priorizar($resultado->i_id)){
					
						die('Falha na despriorização.');	
			
        			}
				
					$Imagens->setPrincipal('N');
					$mensagem = 'Despriorização bem sucedida.';
				
				}
				else{
					
					$Imagens->setPrincipal('S');
					$mensagem = 'Falha na despriorização, impossível remover prioridade.';
				
				}
				
			}
			else{
				
					//verifica se há imagem  principal no album
				$resultado = $Imagens->findPrincipal($album);	
				if($resultado){
	
						//desprioriza a imagem
					$Imagens->setPrincipal('N');
					
					if(!$Imagens->priorizar($resultado->i_id)){
					
						die('Falha na priorização.');	
			
        			}
					
				}
				
				$Imagens->setPrincipal('S');
				$mensagem = 'Priorização bem sucedida';
				
			}
		
        	if($Imagens->priorizar($id)){
			
            	echo '<script language="javascript">';
            	echo "alert('".$mensagem."');";
            	echo '</script>';
			
       		}
			else{
			
				echo '<script language="javascript">';
            	echo "alert('Falha na Despriorização/Priorização da imagem selecionada!');";
            	echo '</script>';
			
			}
		
		}
		else{
		
			echo '<script language="javascript">';
            echo "alert('Falha na Despriorização/Priorização da imagem selecionada!');";
            echo '</script>';
			
		}
  
    }
 
}
?>
   
 <div class="etec-pop-up-tela-informacoes-fundo">
   
 <div class="etec-pop-up-tela-informacoes-three-op">
  <div class="etec-img-fechar"><p><img src="Imagens/Imagens estaticas/Icones/x.png" /></p></div>
   
  <div class="etec-pop-up-conteud">
  </div> 
 
   <div class="etec-pop-up-opcoes-three">
   <form action="admin_imagens_editar.php" method="post"  class="eve-admin-form">
     <label for='Editar' >Editar</label>
     <input type="submit" name="editar" value="Editar" editar  class="btn" id="Editar" />
     <input name="id" id="editar" type="hidden" value="" />
    </form>
    <form action="admin_imagens.php?Ads433DFShUIwW34BmjLSD67Er4GDFD56GDSHJ6575GY4GFD6KU353sfsDr6RrfSDSGhhtdtFD3F55dgDs58s85hd=<?php echo $id_album; ?>" method="post">
     <label for='Desativar' imagem_desativar>Desativar</label>
     <input type="submit"  name="desativar" value="Desativar" desativar class="btn" id="Desativar"/>
     <input name="id" id="desativar" type="hidden" value="" />
    </form>
    <form action="admin_imagens.php?Ads433DFShUIwW34BmjLSD67Er4GDFD56GDSHJ6575GY4GFD6KU353sfsDr6RrfSDSGhhtdtFD3F55dgDs58s85hd=<?php echo $id_album; ?>" method="post">
     <label for='Priorizar' imagem_priorizar>Priorizar</label>
     <input type="submit"  name="Priorizar" value="Priorizar" id="Priorizar" class="btn"/>
     <input name="id" id="priorizar" type="hidden" value="" />
    </form> 
   </div> <!--fechamento da classe "etec-pop-up-opcoes-three"-->   
  
</div><!---fechamento da class"etec-pop-p-tela-informacoes-three-op"-->

</div><!---fechamento da class"etec-pop-up-tela-informacoes-fundo"-->

  



<main class="etec-admin-pag-padrao">
 <div class="etec-admin-pad-barlateral">
   <div class="etec-admin-pad-bar-info"><h1><?php echo $info_album->a_titulo; ?></h1></div>
   <div class="etec-admin-pad-bar-info"><i>Informativo:</i> Nesta página contém informações referente as imagens do album selecionado. Logo abaixo desta mensagem há a seguinte opção: 
      
    <p><strong>"Voltar"</strong> Botão que irá redireciona-lo de volta à página de albuns;</p>  
    <p><strong>"Cadastrar"</strong> Botão que irá redireciona-lo à página de cadastro;</p>  
   </div>

<?php

if($permissao == 'S'){

?>

   <form action="admin_imagens_cadastro.php" method="post">
   <label for="cadastro"><div class="etec-admin-pad-bar-iten etec-admin-pad-bar-iten-btn " >
     Cadastrar
   </div></label>
   <input type="hidden" name="id_album" value="<?php echo $id_album ?>" />
   <input type="submit" name="enviar" id="cadastro" />
   </form>
   
<?php

}
 
?>
<a href="admin_album.php"><div class="etec-admin-pad-bar-iten etec-admin-pad-bar-iten-btn " >
     Voltar
</div></a>
<?php

include("admin_barra_lateral_legendcores.php");

?> 
 
 </div>
 <div class="etec-admin-pad-conteudo">
 
  
  
  

<?php 

foreach($Imagens->findAll($id_album, 'N', 'S', 'N') as $key => $value):

?>
        
 <div class="etec-admin-pad-conteudo-unit <?php if($value->i_ativo=='N'){echo 'admin-pad-unit-desativ-color';}else{echo'admin-pad-unit-ativar-color';}?>"
  item_id="<?php echo $value->i_id; ?>" ativo="<?php echo $value->i_ativo;?>" principal="<?php echo $value->i_principal;?>">
   <div class="etec-admin-pad-cont-unit-title "><!--- o "conteudo " virou "cont" --->
     Imagem
   </div>
   <div class="etec-admin-pad-cont-unit-info-img etec-admin-pad-cont-unit-info ">
    <img src="<?php echo $value->i_caminho; ?>" alt="<?php echo $value->i_alt; ?>" title="<?php echo $value->i_titulo; ?>" />      
   </div>

   <div class="etec-admin-pad-cont-unit-title "><!--- o "conteudo " virou "cont" --->
     Principal
   </div>
   <div class="etec-admin-pad-cont-unit-info">
     <?php echo $value->i_principal; ?>
   </div>

 </div>
<?php 

endforeach; 

?>




</main>

<script src="js/admin-imagems.js"></script>
</body>
</html>