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
  
$Cursos = new Cursos();
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
<title>Cursos</title>

</head>
<body>

<?php 

include("admin_menu.php");/*inclusao do menu do site*/

	//Cadastra um curso
if(isset($_POST['cadastrar'])){
        //verifica se os campos foram recebidos
    if((isset($_POST['titulo']))and(isset($_POST['periodo']))and(isset($_POST['duracao']))and(isset($_POST['Unidade_de_medida']))and(isset($_POST['sinopse']))and(isset($_POST['descricao']))and(isset($_FILES['imagem']))){
			
			//pega os valores dos campos
	    $titulo = $_POST['titulo'];
	    $sinopse = $_POST['sinopse'];
	    $descricao = $_POST['descricao'];
		$periodo = $_POST['periodo'];
	    $duracao = $_POST['duracao'];
	    $Unidade_de_medida = $_POST['Unidade_de_medida'];
		
			//Verifica se a variavelde Unidade de medida foi recebida corretamente
		if(($Unidade_de_medida != 'Anos')and($Unidade_de_medida != 'Semestres')){
		
			die('Falha ao tentar realizar o cadastro, opção de medida inválida.');
			
		}
		
			//Une as variaveis de duracao e Unidade de medida
		$duracao2 = $duracao.' '.$Unidade_de_medida;
		
		
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
		
			//verifica se foi escolhida uma imagem
		if ($_FILES["imagem"]["name"] != ""){
			
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

		}
			
            //Salva os campos 
		if(!($Cursos->setTitulo($titulo))){
			
			die('Falha ao tentar realizar o cadastro, limite de caracteres ultrapassado.');
		
		}
		if(!($Cursos->setSinopse($sinopse))){
			
			die('Falha ao tentar realizar o cadastro, limite de caracteres ultrapassado.');
		
		}
		if(!($Cursos->setDescricao($descricao))){
			
			die('Falha ao tentar realizar o cadastro, limite de caracteres ultrapassado.');
		
		}
		if(!($Cursos->setPeriodo($periodo))){
			
			die('Falha ao tentar realizar o cadastro, opção de período inválida.');
		
		}
		if(!($Cursos->setDuracao($duracao2))){
			
			die('Falha ao tentar realizar o cadastro, limite de caracteres ultrapassado.');
		
		}
		$Cursos->setAlbum($id->id);

            //Insert
        if($Cursos->insert()){
			
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

//edicao de um curso no mysql 
if(isset($_POST['editar'])){

        //verifica se os valores foram recebidos
	if((isset($_POST['id']))and(isset($_POST['sinopse']))and(isset($_POST['descricao']))and(isset($_FILES['imagem']))){
   
        	//pega os valores dos campos
		$id = $_POST['id'];
	    $sinopse = $_POST['sinopse'];
	    $descricao = $_POST['descricao'];
		
		    //Verifica se o curso existe
		$resultado = $Cursos->find($id);
		
		if(!($resultado)){
	
			die("Falha na consulta");
	
		}
		
			//Verifica se o curso que stá sendo alterado é o ensino medio
		$periodo = $resultado->c_periodo;
		if($periodo == 'Matutino'){
		
				//se sim apaga o id para alterar automaticamente
			$id = '';
			
		}
		else{
				
				//se não pega as demais informacoes
			if((isset($_POST['titulo']))AND(isset($_POST['periodo']))and(isset($_POST['duracao']))and(isset($_POST['Unidade_de_medida']))){
					
					//salva os valores	
				$titulo = $_POST['titulo'];
				$periodo = $_POST['periodo'];
				$duracao = $_POST['duracao'];
				$Unidade_de_medida = $_POST['Unidade_de_medida'];
				
					//Verifica se a variavel de Unidade de medida foi recebida corretamente
				if(($Unidade_de_medida != 'Anos')and($Unidade_de_medida != 'Semestres')){
				
					die('Falha ao tentar realizar o cadastro, opção de medida inválida.');
					
				}
			
					//Une as variaveis de duracao e Unidade de medida
				$duracao2 = $duracao.' '.$Unidade_de_medida;
				
					//Edita o album
				if(!($Albuns->setTitulo($titulo))){
			  
					die('Falha ao tentar realizar o cadastro, limite de caracteres ultrapassado.');
			
				}
			
				if(!($Albuns->update($resultado->c_album))){
			
					die('Falha ao realizar o cadastro.');
			
				}
				
		
			}
			else{
			
				die('Falha na edição do item selecionado');
					
			}
			
		}
		
			//Verifica se a imagem foi alterada
		if($_FILES['imagem']["name"] != ""){
			
				//faz upload da imagem
			$caminho = "Imagens/Albuns/".$resultado->c_album."/0.jpg";
			$nome_temporario=$_FILES["imagem"]["tmp_name"];
			copy($nome_temporario,$caminho);
			
				//Verifica se há imagem  principal no album
			$imagem_principal = $Imagens->findPrincipal($resultado->c_album);
		   
			if(!$imagem_principal){
			
					//Cadastra a imagem
				$Imagens->setTitulo('');
				$Imagens->setAlt('');
				$Imagens->setCaminho($caminho);
				$Imagens->setAlbum($resultado->c_album);
				$Imagens->setPrincipal('S');
				
				if(!($Imagens->insert())){
				
					die('Falha ao realizar o cadastro.');
				
				}
			
			}
		
		}
		
		if(!($Cursos->setSinopse($sinopse))){
			
			die('Falha ao tentar realizar o cadastro, limite de caracteres ultrapassado.');
		
		}
		if(!($Cursos->setDescricao($descricao))){
			
			die('Falha ao tentar realizar o cadastro, limite de caracteres ultrapassado.');
		
		}
		if($periodo != 'Matutino'){
			
				//Salva os campos 
			if(!($Cursos->setTitulo($titulo))){
				
				die('Falha ao tentar realizar o cadastro, limite de caracteres ultrapassado.');
			
			}
			
			if(!($Cursos->setPeriodo($periodo))){
				
				die('Falha ao tentar realizar o cadastro, opção de período inválida.');
			
			}
			if(!($Cursos->setDuracao($duracao2))){
				
				die('Falha ao tentar realizar o cadastro, limite de caracteres ultrapassado.');
			
			}
			
		}
		   
		if($Cursos->update($id)){
		
			echo '<script language="javascript">';
			echo "alert('Edição bem sucedida!');";
			echo '</script>';
		
		}
		else{
			
			echo '<script language="javascript">';
			echo "alert('Falha na edição do aviso selecionado!');";
			echo '</script>';
			
		}

    }   

}

	//desativacao de um curso no mysql 
if(isset($_POST['desativar'])){

        //verifica se o id foi recebido
    if(isset($_POST['id'])){

            //pega o valor do id
        $id = (int)$_POST['id'];

            //realiza a busca das informações
        $resultado = $Cursos->find($id);
    
        if(!($resultado)){

            die("Falha na desativacão");

        }
    
        $ativo = $resultado->c_ativo;
		$periodo = $resultado->c_periodo;

		if($periodo != 'Matutino'){
        
			if($ativo == 'S'){ 
			
					//Classe de matrizes curriculares e Documentos
				$DocumentosAno = new DocumentosAno();
				$DocumentosMatrizesCurriculares = new DocumentosMatrizesCurriculares();
				$DocumentosPlanoTrabalho = new DocumentosPlanoTrabalho();
				
									//Pega o ano atual
				date_default_timezone_set('America/Sao_Paulo');
				$date = date('Y'); 
				
					//desativa o documeto do ultimo ano referentes a este curso
				$documentosAno = $DocumentosAno->find('');
				
				if(($documentosAno)and($documentosAno->doc_ano == $date)){
				
					if(!($DocumentosMatrizesCurriculares->delete($documentosAno->doc_id, $id, 'N'))){

						die('Falha ao realizar a desativação.');
				
					}
					if(!($DocumentosPlanoTrabalho->delete($documentosAno->doc_id, $id, 'N'))){

						die('Falha ao realizar a desativação.');
				
					}
					
				}
			   
            	$Cursos->setAtivo('N');
            	$mensagem = "Desativação"; 
        	}
        	else{
            	$Cursos->setAtivo('S');
            	$mensagem = "Ativação"; 
        	}

        	if($Cursos->delete($id)){
			
            	echo '<script language="javascript">';
            	echo "alert('".$mensagem." bem sucedida!');";
            	echo '</script>';
			
			}
			else{
				
				echo '<script language="javascript">';
				echo "alert('Falha na Desativação/Ativação do curso selecionado!');";
				echo '</script>';
				
			}
		
		}
		else{
				
			echo '<script language="javascript">';
			echo "alert('Falha na Desativação, impossivel desativar ensino médio!');";
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
    <form action="admin_curso_editar.php" method="post" class="eve-admin-form" >
     <label for='Editar'  >Editar</label>
     <input type="submit" name="editar" value="Editar"  class="" id="Editar"/> <input  id="editar" name="id" type="hidden" value="" />
     
    </form>
     <form action="admin_curso.php" method="post" >
     <label for='Desativar' desativar >Desativar</label>
     <input type="submit" name="desativar" value="Desativar"  class="" id="Desativar" /><input id="desativar" name="id" type="hidden" value="" />
    </form>
   </div> <!--fechamento da classe "etec-pop-p-tela-informacoes-two-op"-->   
  
</div><!---fechamento da class"etec-pop-p-tela-informacoes-two-op"-->

</div><!---fechamento da class"etec-pop-up-tela-informacoes-fundo"-->

<main class="etec-admin-pag-padrao">

 


 <div class="etec-admin-pad-barlateral">
   <div class="etec-admin-pad-bar-info"><h1>Cursos</h1></div>
   <div class="etec-admin-pad-bar-info"><i>Informativo:</i> Nesta página contém informações referente aos cursos oferecidos pela escola. Logo abaixo desta mensagem há a seguinte opção: 
      
    <p><strong>"Cadastrar"</strong> Botão que irá redireciona-lo à página de cadastro;</p>  
  
    </div>
  
  
 
   <a href="admin_curso_cadastro.php"><div class="etec-admin-pad-bar-iten etec-admin-pad-bar-iten-btn " >
   Cadastrar
   </div></a>
  
<?php  

include("admin_barra_lateral_legendcores.php");

?> 
    
   
 </div><!--fechamento da class"etec-admin-pad-barlateral"-->
 <div class="etec-admin-pad-conteudo">
 
<?php 	     
  
foreach($Cursos->findAll('N', '') as $key => $value):
	
		//verifica se há imagem  principal no album
	$resultado = $Imagens->findPrincipal($value->c_album);
	   
	if(!$resultado){
	
			//se não foi encontrada, e chamada uma imagem pré definida
		$imagem = array('','Imagem não encontrada','Imagens/Imagens estaticas/Outras imagens/Imagem_curso.png'); 
	
	}
	else{
	
			//se foi encontrada, a imagem sendo cadastrada não recebe prioridade
		$imagem = array($resultado->i_titulo,$resultado->i_alt,$resultado->i_caminho); 
	
	}

?>
        
 <div class="etec-admin-pad-conteudo-unit-reduces   <?php if($value->c_ativo == 'N'){
	  echo 'admin-pad-unit-desativ-color';
	  }else{
      echo'admin-pad-unit-ativar-color';
	  } ?>"
      item_id="<?php echo $value->c_id; ?>" ativo="<?php echo $value->c_ativo; ?>">
      
  
   <div class="etec-admin-pad-cont-unit-title"><!--- o "conteudo " virou "cont" --->
     Título
   </div>
   <div class="etec-admin-pad-cont-unit-info" curso_titulo <?php if($value->c_titulo == ""){echo 'align="center"';}?>>
     <?php if($value->c_titulo == ""){echo '--';}else{echo $value->c_titulo;}  ?>
   </div>
   
      <div class="etec-admin-pad-cont-unit-title "><!--- o "conteudo " virou "cont" --->
     Sinopse
   </div>
   <div class="etec-admin-pad-cont-unit-info-reduces etec-admin-pad-cont-unit-info " <?php if($value->c_sinopse == ""){echo 'align="center"';}?>>
     <?php if($value->c_sinopse == ""){echo '--';}else{echo $value->c_sinopse;}  ?>
   </div>

   <div class="etec-admin-pad-cont-unit-title"><!--- o "conteudo " virou "cont" --->
     Foto
   </div>
   <div class="etec-admin-pad-cont-unit-info-img etec-admin-pad-cont-unit-info ">
     <img src="<?php echo $imagem[2]; ?>" alt="<?php echo $imagem[1]; ?>" title="<?php echo $imagem[0]; ?>" />   
   </div>
   
      <div class="etec-admin-pad-cont-unit-dis">
     <div class="etec-admin-pad-cont-unit-dis-one">
        <div class="etec-admin-pad-cont-unit-title"><!--- o "conteudo " virou "cont" --->
         Período
        </div>
        <div class="etec_admin-pad-cont-unit-info-aling etec-admin-pad-cont-unit-info" curso_periodo>
         <?php echo $value->c_periodo; ?>  
        </div>
     </div><!--fechamento da class"etec-admin-pad-cont-unit-dis-one"-->
     <div class="etec-admin-pad-cont-unit-dis-two">
       <div class="etec-admin-pad-cont-unit-title"><!--- o "conteudo " virou "cont" --->
         Duração
       </div>
       <div class="etec_admin-pad-cont-unit-info-aling etec-admin-pad-cont-unit-info " <?php if($value->c_duracao == ""){echo 'align="center"';}?>>
          <?php if($value->c_duracao == ""){echo '--';}else{echo $value->c_duracao;}  ?>
       </div>
     </div><!--fechamento da class"etec-admin-pad-cont-unit-dis-two"-->
    
   </div><!--fechamento da class"etec-admin-cont-unit-dis"-->
   
     
  </div><!--fechamento da class"etec-admin-pad-conteudo-unit"-->

<?php

endforeach;

?>
 </div><!--fechamento da class"etec-admin-pad-conteudo-->
</main>

<script src="js/admin_cursos.js"></script>
</body>
</html>