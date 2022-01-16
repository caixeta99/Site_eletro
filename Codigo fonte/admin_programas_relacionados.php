<?php

include("session.php");

function MyAutoload($className) {    
    $extension =  spl_autoload_extensions();
    require_once (__DIR__ . '/classes/' . $className . $extension);
}

spl_autoload_extensions('.php');
spl_autoload_register('MyAutoload');
  
$ProgramasRelacionados = new ProgramasRelacionados();
$Albuns = new Album();
$Imagens = new Imagem();

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
<title>Programas Relacionados</title>

</head>
<body>

<?php 

include("admin_menu.php");/*inclusao do menu do site*/

	//Cadastra um programa
if(isset($_POST['cadastrar'])){
	    //realiza a busca das informações
	$resultado = $ProgramasRelacionados->findCount();
	
	if(!($resultado)){
	
		die("Falha na consulta");
	
	}
	
	if($resultado->qtd < 3){
	
			//verifica se os campos foram recebidos
		if((isset($_POST['titulo']))and(isset($_POST['link']))and(isset($_POST['descricao']))and(isset($_FILES["imagem"]))and($_FILES["imagem"]["name"] != "")){
				
				//pega os valores dos campos
			$titulo = $_POST['titulo'];
			$link = $_POST['link'];
			$descricao = $_POST['descricao'];		
			
					//Cadastra o album
			if(!($Albuns->setTitulo($titulo))){
				
				die('Falha ao tentar realizar o cadastro, limite de caracteres ultrapassado.');
			
			}
			
			if(!($Albuns->insert())){
			
				die('Falha ao realizar o cadastro.');
			
			}
			
				//busca o id do album
			$id = $Albuns->findLast();
			
			mkdir(__DIR__."/Imagens/Albuns/".$id->id, 0777);
			
				//faz upload da imagem
			$caminho = 'Imagens/Albuns/'.$id->id.'/0.jpg';
			$nome_temporario = $_FILES["imagem"]["tmp_name"];
			copy($nome_temporario,$caminho);
			
				//Cadastra a imagem
			$Imagens->setTitulo('');
			$Imagens->setAlt('');
			$Imagens->setCaminho($caminho);
			$Imagens->setAlbum($id->id);
			$Imagens->setPrincipal('S');
			
			if(!($Imagens->insert())){
			
				die('Falha ao realizar o cadastro.');
			
			}
				
				//Salva os campos 
			if(!($ProgramasRelacionados->setNome($titulo))){
				
				die('Falha ao tentar realizar o cadastro, limite de caracteres ultrapassado.');
			
			}
			if(!($ProgramasRelacionados->setLink($link))){
				
				die('Falha ao tentar realizar o cadastro, limite de caracteres ultrapassado.');
			
			}
			if(!($ProgramasRelacionados->setDescricao($descricao))){
				
				die('Falha ao tentar realizar o cadastro, limite de caracteres ultrapassado.');
			
			}
			$ProgramasRelacionados->setAlbum($id->id);
	
				//Insert
			if($ProgramasRelacionados->insert()){
				
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
			echo "alert('Limite de registros ativos atingido!');";
			echo '</script>';
			
	}
		
}

//edicao de um programa no mysql 
if(isset($_POST['editar'])){

        //verifica se os valores foram recebidos
    if((isset($_POST['titulo']))and(isset($_POST['link']))and(isset($_POST['descricao']))and(isset($_POST['id']))){
   
            //pega os valores dos campos
        $id = $_POST['id'];
        $titulo = $_POST['titulo'];
		$link = $_POST['link'];
		$descricao = $_POST['descricao'];	
		
		    //Verifica se o programa existe
		$resultado = $ProgramasRelacionados->find($id);
		
		if(!($resultado)){
	
			die("Falha na consulta");
	
		}
		 
		    //Edita o album
        if(!($Albuns->setTitulo($titulo))){
      
            die('Falha ao tentar realizar o cadastro, limite de caracteres ultrapassado.');
    
        }
    
        if(!($Albuns->update($resultado->p_album))){
    
            die('Falha ao realizar o cadastro.');
    
        }
		
        	//Salva os campos 
		if(!($ProgramasRelacionados->setNome($titulo))){
			
			die('Falha ao tentar realizar o cadastro, limite de caracteres ultrapassado.');
		
		}
		if(!($ProgramasRelacionados->setLink($link))){
			
			die('Falha ao tentar realizar o cadastro, limite de caracteres ultrapassado.');
		
		}
		if(!($ProgramasRelacionados->setDescricao($descricao))){
			
			die('Falha ao tentar realizar o cadastro, limite de caracteres ultrapassado.');
		
		}
       
        if($ProgramasRelacionados->update($id)){
        
            echo '<script language="javascript">';
            echo "alert('Edição bem sucedida!');";
            echo '</script>';
        
        }
		else{
			
			echo '<script language="javascript">';
            echo "alert('Falha na edição do programa selecionado!');";
            echo '</script>';
			
		}

    }   

}

	//desativacao de um programa no mysql 
if(isset($_POST['desativar'])){

        //verifica se o id foi recebido
    if(isset($_POST['id'])){

            //pega o valor do id
        $id = (int)$_POST['id'];

            //realiza a busca das informações
        $resultado = $ProgramasRelacionados->find($id);
    
        if(!($resultado)){

            die("Falha na desativacão");

        }
    
        $ativo = $resultado->p_ativo;

        if($ativo == 'S'){    
        
		    $ProgramasRelacionados->setAtivo('N');
			if($ProgramasRelacionados->delete($id)){
			
				echo '<script language="javascript">';
				echo "alert('Desativação bem sucedida!');";
				echo '</script>';
				
			}
			else{
				
				echo '<script language="javascript">';
				echo "alert('Falha na desativação do programa selecionado!');";
				echo '</script>';
				
			}
        
		}
        else{
			
			    //Verifica quantos programas ativos existem
			$resultado = $ProgramasRelacionados->findCount();
			
			if(!($resultado)){
			
				die("Falha na consulta");
			
			}
			
			if($resultado->qtd < 3){
				        
		    	$ProgramasRelacionados->setAtivo('S');
				if($ProgramasRelacionados->delete($id)){
				
					echo '<script language="javascript">';
					echo "alert('Ativação bem sucedida!');";
					echo '</script>';
					
				}
				else{
					
					echo '<script language="javascript">';
					echo "alert('Falha na Ativação do programa selecionado!');";
					echo '</script>';
					
				}
        	
			}
			else{
				
				echo '<script language="javascript">';
				echo "alert('Falha na Ativação do programa selecionado, limite de programas ativos atingido!');";
				echo '</script>';
				
			}
		
		
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
     <form action="admin_programas_relacionados_editar.php" method="post" class="eve-admin-form" >
     <label for='Editar' >Editar</label>
     <input type="submit" name="editar" value="Editar"  class="" id="Editar"/> <input  id="editar" name="id" type="hidden" value="" />
     
    </form>
    <form action="admin_programas_relacionados.php" method="post">
     <label for='Desativar' desativar>Desativar</label>
     <input type="submit" name="desativar" value="Desativar"  class="" id="Desativar" /><input id="desativar" name="id" type="hidden" value="" />
    </form>
   </div> <!--fechamento da classe "etec-pop-p-tela-informacoes-two-op"-->   
  
</div><!---fechamento da class"etec-pop-p-tela-informacoes-two-op"-->

</div><!---fechamento da class"etec-pop-up-tela-informacoes-fundo"-->




<main class="etec-admin-pag-padrao">
 <div class="etec-admin-pad-barlateral">
   <div class="etec-admin-pad-bar-info"><h1>Programas Relacionados</h1></div>
   <div class="etec-admin-pad-bar-info"><i>Informativo:</i> Nesta página contém informações referente aos programas ligados à escola. Logo abaixo desta mensagem há a seguinte opção: 
      
    <p><strong>"Cadastrar"</strong> Botão que irá redireciona-lo à página de cadastro;</p>  
  
    </div>
<?php 

    //Verifica quantos programas ativos existem
$resultado = $ProgramasRelacionados->findCount();

if(!($resultado)){

	die("Falha na consulta");

}

if($resultado->qtd < 3){

?>  
   <a href="admin_programas_relacionados_cadastro.php"><div class="etec-admin-pad-bar-iten etec-admin-pad-bar-iten-btn " >
    Cadastrar
   </div></a>
<?php 

}

?>
  
  
  <?php  
   include("admin_barra_lateral_legendcores.php");
 ?> 
 
 </div>
 <div class="etec-admin-pad-conteudo">
 
<?php 	     
  
foreach($ProgramasRelacionados->findAll('N') as $key => $value):
	
		//verifica se há imagem  principal no album
	$resultado = $Imagens->findPrincipal($value->p_album);
	   
	if(!$resultado){
	
			//se não foi encontrada, e chamada uma imagem pré definida
		$imagem = array('','Imagem não encontrada','Imagens/Imagens estaticas/Outras imagens/Imagem_evento.jpg'); 
	
	}
	else{
	
			//se foi encontrada, a imagem sendo cadastrada não recebe prioridade
		$imagem = array($resultado->i_titulo,$resultado->i_alt,$resultado->i_caminho); 
	
	}

?>

 <div class="etec-admin-pad-conteudo-unit <?php if($value->p_ativo == 'N'){echo 'admin-pad-unit-desativ-color';}else{echo'admin-pad-unit-ativar-color';}?>" item_id="<?php echo $value->p_id; ?>" ativo="<?php echo $value->p_ativo; ?>">
   <div class="etec-admin-pad-cont-unit-title "><!--- o "conteudo " virou "cont" --->
     Título
   </div>
   <div class="etec-admin-pad-cont-unit-info" programa_titulo <?php if($value->p_nome == ""){echo 'align="center"';}?>>
     <?php if($value->p_nome == ""){echo '--';}else{echo $value->p_nome;} ?>
   </div>
   
    <div class="etec-admin-pad-cont-unit-title"><!--- o "conteudo " virou "cont" --->
      Descrição
   </div>
   <div class="etec-admin-pad-cont-unit-info-reduces" <?php if($value->p_descricao == ""){echo 'align="center"';}?>>
     <?php if($value->p_descricao == ""){echo '--';}else{echo $value->p_descricao;} ?>
   </div>
    <div class="etec-admin-pad-cont-unit-title "><!--- o "conteudo " virou "cont" --->
     Foto
   </div>
   <div class="etec-admin-pad-cont-unit-info-img etec-admin-pad-cont-unit-info ">
     <img src="<?php echo $imagem[2]; ?>?>" alt="<?php echo $imagem[1]; ?>" title="<?php echo $imagem[0]; ?>" />     
   </div>
   
    <div class="etec-admin-pad-cont-unit-title "><!--- o "conteudo " virou "cont" --->
     Link
   </div>
   <div class="etec-admin-pad-cont-unit-info" <?php if($value->p_link == ""){echo 'align="center"';}?>>
     <?php if($value->p_link == ""){echo '--';}else{echo $value->p_link;} ?>
   </div>
    
   
 
 </div><!--fechamento da class"etec-admin-conteudo-unir -->
<?php 

endforeach;

?>

<script src="js/admin_programas_relacionados.js"></script>



</main>

</body>
</html>