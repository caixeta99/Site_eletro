<?php

include("session.php");

function MyAutoload($className) {    
    $extension =  spl_autoload_extensions();
    require_once (__DIR__ . '/classes/' . $className . $extension);
}

spl_autoload_extensions('.php');
spl_autoload_register('MyAutoload');
  
$Avisos = new Avisos();

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

<title>Mural de Avisos</title>

</head>
<body>

<?php 

include("admin_menu.php");/*inclusao do menu do site*/ 

	//Cadastra um aviso
if(isset($_POST['cadastrar'])){
        //verifica se os campos foram recebidos
    if((isset($_POST['destinatario']))and(isset($_POST['descricao']))){
          //pega os valores dos campos
        $destinatario = $_POST['destinatario'];
        $descricao = $_POST['descricao'];
		
            //Salva os campos 
        if(!($Avisos->setDestinatario($destinatario))){
			
			die('Falha ao tentar realizar o cadastro, opção inválida.');
		
		}
		if(!($Avisos->setDescricao($descricao))){
			
			die('Falha ao tentar realizar o cadastro, limite de caracteres ultrapassado.');
		
		}
		
			//verifica se há avisos principais e quantos sao
		$resultado = $Avisos->CountAvisos();
		if($resultado->Quantidade < 2){
				//se não foi encontrada, a imagem sendo cadastrada recebe prioridade
			$destaque = 'S';
		}
		else{
				//se foi encontrada, a imagem sendo cadastrada não recebe prioridade
			$destaque = 'N';
		}
		
			//Salva o valor do campo destaque
		$Avisos->setDestaque($destaque);

            //Insert
        if($Avisos->insert()){
			
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

//edicao de um aviso
if(isset($_POST['editar'])){

        //verifica se os campos foram recebidos
    if((isset($_POST['destinatario']))and(isset($_POST['descricao']))and(isset($_POST['id']))){
          //pega os valores dos campos
		$id = $_POST['id'];
        $destinatario = $_POST['destinatario'];
        $descricao = $_POST['descricao'];
		
		     //verifica se o aviso existe e realiza a busca das informações
		$resultado = $Avisos->find($id);
		
		if(!($resultado)){
		
			die("Falha na consulta");
		
		}
		
		    //Salva os campos 
        if(!($Avisos->setDestinatario($destinatario))){
			
			die('Falha ao tentar realizar o cadastro, opção inválida.');
		
		}
		if(!($Avisos->setDescricao($descricao))){
			
			die('Falha ao tentar realizar o cadastro, limite de caracteres ultrapassado.');
		
		}
		
			//Descobre se o destinatario foi alterado
		if($destinatario != $resultado->av_destinatario){
			
			if($resultado->av_ativo == 'S'){
				
					//Caso foi alterado: verifica se há avisos principais e quantos sao no novo destinatario
				$quantidade = $Avisos->CountAvisos();
				if($quantidade->Quantidade < 2){
						//se não foi encontrada, a imagem sendo cadastrada recebe prioridade
					$destaque = 'S';
				}
				else{
						//se foi encontrada, a imagem sendo cadastrada não recebe prioridade
					$destaque = 'N';
				}
				
			}
			else{
				
				$destaque = 'N';
				
			}
			
		}
		else{
			
				//Se nao foi, mantem o valor do destaque
			$destaque = $resultado->av_destaque;
			
		}
			//Salva o destaque
		$Avisos->setDestaque($destaque);
       
        if($Avisos->update($id)){
        
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

//desativacao de um aviso
if(isset($_POST['desativar'])){

        //verifica se o id foi recebido
    if(isset($_POST['id'])){

            //pega o valor do id
        $id = (int)$_POST['id'];

            //realiza a busca das informações
        $resultado = $Avisos->find($id);
    
        if(!($resultado)){

            die("Falha na desativacão");

        }
    		
			//Salva os campos
        $ativo = $resultado->av_ativo;
		$destaque = $resultado->av_destaque;
		$Avisos->setDestinatario($resultado->av_destinatario);
			
        if($ativo == 'S'){  
		  
		  	if($destaque == 'S'){ 
				
				   //busca um aviso para priorizar
        		$aviso_aleatorio = $Avisos->findRandom();
				
        		if($aviso_aleatorio){
	
						//prioriza a outra imagem
					$Avisos->setDestaque('S');
					
					if(!$Avisos->priorizar($aviso_aleatorio->av_id)){
					
						die('Falha na desativacão');	
			
        			}
				
				}	
				
					//Salva o destaque
				$Avisos->setDestaque('N');
				
					//Desprioriza o aviso
				if(!$Avisos->priorizar($id)){
					
					echo '<script language="javascript">';
            		echo "alert('Falha na Desativação/Ativação do aviso selecionado!');";
            		echo '</script>';
					
				}
				
			}
			
            $Avisos->setAtivo('N');
            $mensagem = "Desativação"; 
		
		}
        else{
				
				//verifica se há avisos principais e quantos sao
			$quantidade = $Avisos->CountAvisos();
			if($quantidade->Quantidade < 2){
				
					//Salva o destaque
				$Avisos->setDestaque('S');
				
				if(!$Avisos->priorizar($id)){
					
					echo '<script language="javascript">';
            		echo "alert('Falha na Desativação/Ativação do aviso selecionado!');";
            		echo '</script>';
					
				}
				
			}
			
            $Avisos->setAtivo('S');
            $mensagem = "Ativação"; 
        
		}

        if($Avisos->delete($id)){
			
            echo '<script language="javascript">';
            echo "alert('".$mensagem." bem sucedida!');";
            echo '</script>';
			
        }
		else{
			
			echo '<script language="javascript">';
            echo "alert('Falha na Desativação/Ativação do aviso selecionado!');";
            echo '</script>';
			
		}
  
    }
 
}

//priorização de um aviso 
if(isset($_POST['priorizar'])){

        //verifica se o id foi recebido
    if(isset($_POST['id'])){

            //pega o valor do id
        $id = (int)$_POST['id'];

            //realiza a busca das informações
        $resultado = $Avisos->find($id);
    
        if(!($resultado)){

            die("Falha na desativacão");

        }
    		
			//Salva os campos
		$ativo = $resultado->av_ativo;
		$destaque = $resultado->av_destaque;
		$Avisos->setDestinatario($resultado->av_destinatario);
			
        if($ativo == 'S'){  
		  
		  	if($destaque == 'S'){     
				
				   //busca um aviso para priorizar
        		$aviso_aleatorio = $Avisos->findRandom();
				
        		if($aviso_aleatorio){
	
						//prioriza a outra imagem
					$Avisos->setDestaque('S');
					
					if(!$Avisos->priorizar($aviso_aleatorio->av_id)){
					
						die('Falha na desativacão');	
			
        			}
				
				}	
				
					//Salva o destaque
				$Avisos->setDestaque('N');
				
					//Desprioriza o aviso
				if($Avisos->priorizar($id)){
					
					echo '<script language="javascript">';
            		echo "alert('Despriorização bem sucedida!');";
            		echo '</script>';
			
				}
				else{
					
					echo '<script language="javascript">';
					echo "alert('Falha na despriorização do aviso selecionado!');";
					echo '</script>';
					
				}
        	
			}
        	else{
            	
					//verifica se há avisos principais e quantos são
				$quantidade = $Avisos->CountAvisos();
				if($quantidade->Quantidade < 2){
					
						//Salva o destaque
					$Avisos->setDestaque('S');
					
					if(!$Avisos->priorizar($id)){
						
						echo '<script language="javascript">';
						echo "alert('Falha na Desativação/Ativação do aviso selecionado!');";
						echo '</script>';
						
					}
					
				}
				else{
					
						//Busca os avisosem destaque
					$avisos = $Avisos->findAll('S','S');
			  
					$avisos1 = array($avisos[0]->av_id,$avisos[0]->av_descricao);
					$avisos2 = array($avisos[1]->av_id,$avisos[1]->av_descricao);
		   
		   				//Faz o tratamento dos avisos,removendo caracteres especiais e paragrafos
					$aviso1 = str_replace("&nbsp;"," ",$avisos1[1]);
					$aviso1 = str_replace("\n", "", $aviso1);
					$aviso1 = str_replace("\r", "", $aviso1);
					$aviso1 = preg_replace('/\s/',' ',$aviso1);
		   
					$aviso2 = str_replace("&nbsp;"," ",$avisos2[1]);
					$aviso2 = str_replace("\n", "", $aviso2);
					$aviso2 = str_replace("\r", "", $aviso2);
					$aviso2 = preg_replace('/\s/',' ',$aviso2);
		   				
						//Mostra a mensagem na tela
					$pergunta = nl2br('Escolha um aviso para substituir: \n 1-').$aviso1.nl2br(' \n 2-').$aviso2;
					echo '<script language="javascript">';
					echo 'var resposta = 0;';
					echo 'while((resposta != 1)&(resposta != 2)&(resposta != null)){';
					echo "resposta = prompt('".$pergunta."','');";
					echo '}';
							
						//dependendo do valorda mensagem realiza a ação
					echo 'var sub;';
					echo 'if(resposta != null){';
					echo 'if(resposta == 1){';
					echo 'sub = '.$avisos1[0].';';
					echo '}else{';
					echo 'sub = '.$avisos2[0].';';
					echo '}';
					echo  'window.location.href = "admin_avisos.php?priorizar='.$id.'&sub="+sub;';
					echo '}';
					echo '</script>';
					
				}
        	
			}
		
		}
  
    }
 
}

  //priorização de um aviso 2º parte
if((isset($_GET['priorizar']))and(isset($_GET['sub']))){

		//pega as informacoes
    $id = $_GET['priorizar'];
	$sub = $_GET['sub'];
	
	    //realiza a busca das informações
	$resultado = $Avisos->find($id);

	if(!($resultado)){

		die("Falha na desativacão");

	}
	
	if($resultado->av_ativo == 'S'){
		
			
			//Salva o destaque
		$Avisos->setDestaque('N');
		
			//Desprioriza o aviso a ser substituido
		if(!$Avisos->priorizar($sub)){
			
			echo '<script language="javascript">';
			echo "alert('Falha na priorização do aviso selecionado!');";
			echo '</script>';
	
		}
		
			//Salva o destaque
		$Avisos->setDestaque('S');
		
			//Prioriza o aviso
		if($Avisos->priorizar($id)){
			
			echo '<script language="javascript">';
			echo "alert('Priorização bem sucedida!');";
			echo '</script>';
	
		}
		else{
			
			echo '<script language="javascript">';
			echo "alert('Falha na priorização do aviso selecionado!');";
			echo '</script>';
			
		}	
						
	}
	
	die(header('location:admin_avisos.php'));
	
}

?>

<div class="etec-pop-up-tela-informacoes-fundo">

<div class="etec-pop-up-tela-informacoes-three-op">
  <div class="etec-img-fechar"><p><img src="Imagens/Imagens estaticas/Icones/x.png" /></p></div>
   
  <div class="etec-pop-up-conteud">

  </div> 
 
   <div class="etec-pop-up-opcoes-three">
   <form action="admin_avisos_editar.php" method="post" class="eve-admin-form">
      <label for='Editar' >Editar</label>
      <input type="submit" name="editar_avisos" value="Editar"  class="btn" id="Editar"/> 
      <input name="id" id="editar" type="hidden" value="" />
    </form> 
    <form action="#" method="post">
      <label for='Desativar' aviso_desativar>Desativar</label>
     <input type="submit"  name="desativar" value="Desativar" class="btn" id="Desativar"/>
     <input name="id" id="desativar" type="hidden" value="" />
    </form> 
    <form action="#" method="post">
     <label for='Priorizar' aviso_priorizar>Priorizar</label>
     <input type="submit" aviso_priorizar name="priorizar" value="Priorizar" class="btn" onclick="" id="Priorizar"/> 
     <input name="id" id="priorizar" type="hidden" value="" />
    </form> 
   </div> <!--fechamento da classe "etec-pop-up-opcoes-three"-->   
  
</div><!---fechamento da class"etec-pop-p-tela-informacoes-three-op"-->

</div><!---fechamento da class"etec-pop-up-tela-informacoes-fundo"-->



<main class="etec-admin-pag-padrao">
 <div class="etec-admin-pad-barlateral">
   <div class="etec-admin-pad-bar-info"><h1>Mural de Avisos</h1></div>
   <div class="etec-admin-pad-bar-info"><i>Informativo:</i> Nesta página contém informações referente aos avisos da escola. Logo abaixo desta mensagem há a seguinte opção: 
      
    <p><strong>"Cadastrar"</strong> Botão que irá redireciona-lo à página de cadastro;</p>  
  
    </div>
   
   <a href="admin_avisos_cadastrar.php"><div class="etec-admin-pad-bar-iten etec-admin-pad-bar-iten-btn " >
     Cadastrar
   </div></a>
  
<?php  

include("admin_barra_lateral_legendcores.php");

?> 
  
 </div>
 <div class="etec-admin-pad-conteudo">
 
<?php 

$avisos = $Avisos->findAll('N','N');

if($avisos){

	foreach($avisos as $key => $value):

?>
        
 <div class="etec-admin-pad-conteudo-unit <?php if($value->av_ativo == 'N'){echo 'admin-pad-unit-desativ-color';}else{echo'admin-pad-unit-ativar-color';}?>" id="" item_id="<?php echo $value->av_id; ?>" ativo="<?php echo $value->av_ativo; ?>" prioridade="<?php echo $value->av_destaque; ?>">
   <div class="etec-admin-pad-cont-unit-title "><!--- o "conteudo " virou "cont" --->
     Descrição
   </div>
   <div class="etec-admin-pad-cont-unit-info" <?php if($value->av_descricao == ""){echo 'align="center"';}?>>
     <?php if($value->av_descricao == ""){echo '--';}else{echo $value->av_descricao;} ?>
   </div>
   <div class="etec-admin-pad-cont-unit-dis">
     <div class="etec-admin-pad-cont-unit-dis-one">
        <div class="etec-admin-pad-cont-unit-title"><!--- o "conteudo " virou "cont" --->
         Destinatário
        </div>
        <div class="etec_admin-pad-cont-unit-info-aling etec-admin-pad-cont-unit-info" aviso_destinatario > 
          <?php 
			   if($value->av_destinatario == 'alunos'){
	            echo 'Alunos';
               }
			   if($value->av_destinatario == 'ex-alunos'){
	            echo 'EX-Alunos';
               }
			   if($value->av_destinatario == 'secretaria'){
	            echo 'Secretaria Académica';
               }
			   if($value->av_destinatario == 'coordenacao'){
	            echo 'Coordenação Pedagogica';
               }
		 ?>
        </div>
     </div><!--fechamento da class"etec-admin-pad-cont-unit-dis-one"-->
     <div class="etec-admin-pad-cont-unit-dis-two">
       <div class="etec-admin-pad-cont-unit-title" ><!--- o "conteudo " virou "cont" --->
         Prioridade
       </div>
       <div class="etec_admin-pad-cont-unit-info-aling etec-admin-pad-cont-unit-info " <?php if($value->av_destaque == ""){echo 'align="center"';}?>>
         <?php if($value->av_destaque == ""){echo '--';}else{echo $value->av_destaque;} ?>
       </div>
     </div><!--fechamento da class"etec-admin-pad-cont-unit-dis-two"-->
    
   </div><!--fechamento da class"etec-admin-cont-unit-dis"-->
 
 </div>
<?php

	endforeach;

}

?>

</main>

<script src="js/admin-avisos.js"></script>
</body>
</html>