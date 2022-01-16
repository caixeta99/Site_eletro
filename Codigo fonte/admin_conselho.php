<?php

include("session.php");

function MyAutoload($className) {    
    $extension =  spl_autoload_extensions();
    require_once (__DIR__ . '/classes/' . $className . $extension);
}

spl_autoload_extensions('.php');
spl_autoload_register('MyAutoload');
  
$Conselho_Ano = new ConselhoAno();
$MembrosConselho = new Conselho();

	//Pega o ano atual
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


<title>Membros do Conselho</title>
</head>
<body>

<?php 

include("admin_menu.php");/*inclusao do menu do site*/

if(isset($_GET['ASdfd546GHD3hj5657RGHRweerRujyY54gerU7565FGerT556DFGDwIuy6YUjmgGhjUT54'])){
	
	$id_conselho = $_GET['ASdfd546GHD3hj5657RGHRweerRujyY54gerU7565FGerT556DFGDwIuy6YUjmgGhjUT54'];

}
else{
		
    $id_conselho = '';
 
}
	
	//Pega as informações do conselho
$conselho = $Conselho_Ano->find($id_conselho);

if(!$conselho){

	die(header('location:admin_conselho_ano.php'));
	
}

if($conselho->coa_ano == $date){ 

	if(isset($_POST['cadastrar'])){
			//verifica se os campos foram recebidos
		if((isset($_POST['nome']))and(isset($_POST['cargo']))){
			  //pega os valores dos campos
			$nome = $_POST['nome'];
			$cargo = $_POST['cargo'];
	
				//Salva os campos 
			if(!($MembrosConselho->setNome($nome))){
				
				die('Falha ao tentar realizar o cadastro, limite de caracteres ultrapassado.');
			
			}
			if(!($MembrosConselho->setCargo($cargo))){
				
				die('Falha ao tentar realizar o cadastro, limite de caracteres ultrapassado.');
			
			}
			$MembrosConselho->setConselho($conselho->coa_id); 
	
				//Insert
			if($MembrosConselho->insert()){
				
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
	
		//edicao de data do calendario no mysql 
	if(isset($_POST['editar'])){
	
			//verifica se os valores foram recebidos
		if((isset($_POST['id']))and(isset($_POST['nome']))and(isset($_POST['cargo']))){
			  //pega os valores dos campos
			$id = $_POST['id'];
			$nome = $_POST['nome'];
			$cargo = $_POST['cargo'];
			
			    //realiza a busca do registro
			$resultado = $MembrosConselho->find($id);
			
			if((!($resultado))and($resultado->co_ano == $conselho->coa_id)){
		
				echo '<script language="javascript">';
				echo "alert('Falha na edição do membro selecionado!');";
				echo '</script>';
		
			}
			else{
			
					//Salva os campos 
				if(!($MembrosConselho->setNome($nome))){
					
					die('Falha ao tentar realizar o cadastro, limite de caracteres ultrapassado.');
				
				}
				if(!($MembrosConselho->setCargo($cargo))){
					
					die('Falha ao tentar realizar o cadastro, limite de caracteres ultrapassado.');
				
				}
		   
				if($MembrosConselho->update($id)){
				
					echo '<script language="javascript">';
					echo "alert('Edição bem sucedida!');";
					echo '</script>';
				
				}
				else{
					
					echo '<script language="javascript">';
					echo "alert('Falha na edição do membro selecionado!');";
					echo '</script>';
					
				}
			
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
			$resultado = $MembrosConselho->find($id);
		
			if((!($resultado))and($resultado->co_ano == $conselho->coa_id)){
		
				echo '<script language="javascript">';
				echo "alert('Falha na edição do membro selecionado!');";
				echo '</script>';
		
			}
			else{
			
				$ativo = $resultado->co_ativo;
		
				if($ativo == 'S'){    
					$MembrosConselho->setAtivo('N');
					$mensagem = "Desativação"; 
				}
				else{
					$MembrosConselho->setAtivo('S');
					$mensagem = "Ativação"; 
				}
		
				if($MembrosConselho->delete($id)){
					
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
	 
	}

}

?>
<div class="etec-pop-up-tela-informacoes-fundo">

 <div class="etec-pop-p-tela-informacoes-two-op">
  <div class="etec-img-fechar"><p><img src="Imagens/Imagens estaticas/Icones/x.png" /></p></div>
   
  <div class="etec-pop-up-conteud">

  </div> 
 
<?php 
 
if($conselho->coa_ano == $date){ 

?>    <div class="etec-pop-up-opcoes-two">
    <form action="admin_conselho_editar.php" method="post" class="eve-admin-form" >
      <label for='Editar' >Editar</label>
     <input type="submit" name="editar" value="Editar" editar  class="btn" id="Editar"/> <input  id="editar" name="id" type="hidden" value=""  />
    </form>
    <form action="#" method="post">
     <label for='Desativar' desativar>Desativar</label>
     <input type="submit" name="desativar" value="Desativar"  class="btn" id="Desativar" /><input id="desativar" name="id" type="hidden" value=""  />
    </form>
   </div> <!--fechamento da classe "etec-pop-p-tela-informacoes-two-op"-->   
<?php 

}

?>     
</div><!---fechamento da class"etec-pop-p-tela-informacoes-two-op"-->

</div><!---fechamento da class"etec-pop-up-tela-informacoes-fundo"-->



<main class="etec-admin-pag-padrao">
 <div class="etec-admin-pad-barlateral">
   <div class="etec-admin-pad-bar-info"><h1>Menbros do Conselho</h1></div>
   <div class="etec-admin-pad-bar-info"><i>Informativo:</i> Nesta página contém informações referente aos membros do conselho da escola. Logo abaixo desta mensagem há as seguintes opções: 
      
<?php 

if($conselho->coa_ano == $date){ 

?> 
   <p><strong>"Cadastrar"</strong> Botão que irá redireciona-lo à página de cadastro;</p>  

<?php 

}

?> 
     <p><strong>"Voltar"</strong> Botão que irá redireciona-lo  de volta à página de conselhos; </p>
    
    </div>
  
<?php 

if($conselho->coa_ano == $date){ 

?> 

   <a href="admin_conselho_cadastro.php"> <div class="etec-admin-pad-bar-iten etec-admin-pad-bar-iten-btn " >
        Cadastrar
   </div></a>
<?php 

}

?>
    <a href="admin_conselho_ano.php" ><div class="etec-admin-pad-bar-iten etec-admin-pad-bar-iten-btn " >
      Voltar
   </div></a>
    
<?php  

include("admin_barra_lateral_legendcores.php");

?> 
   
 </div><!--fechamento da class"etec-admin-pad-barlateral"-->
 <div class="etec-admin-pad-conteudo">
 
<?php 	     

$membros = $MembrosConselho->findAll($conselho->coa_id, 'N');
  
if($membros){  
  
	foreach($membros as $key => $value):
  
?>
        
 <div class="etec-admin-pad-conteudo-unit 
<?php 

if($value->co_ativo == 'N'){
	
	echo 'admin-pad-unit-desativ-color';
	
}
else{
	
	echo'admin-pad-unit-ativar-color';
	
}

?>" item_id="<?php echo $value->co_id; ?>" ativo="<?php echo $value->co_ativo; ?>">
 
   <div class="etec-admin-pad-cont-unit-title "><!--- o "conteudo " virou "cont" --->
     Nome
   </div>
   <div class="etec-admin-pad-cont-unit-info" nome_membro <?php if($value->co_nome == ""){echo 'align="center"';}?>>
     <?php  if($value->co_nome == ""){echo '--';}else{echo $value->co_nome;}   ?>
   </div>
   
    <div class="etec-admin-pad-cont-unit-title "><!--- o "conteudo " virou "cont" --->
      Cargo
   </div>
   <div class="etec-admin-pad-cont-unit-info" <?php if($value->co_cargo == ""){echo 'align="center"';}?>>
     <?php if($value->co_cargo == ""){echo '--';}else{echo $value->co_cargo;} ?>
   </div>
  
  </div><!--fechamento da class"etec-admin-pad-conteudo-unit"-->
<?php 

	endforeach;

}

?>
 </div><!--fechamento da class"etec-admin-pad-conteudo-->
</main>

<script src="js/admin_conselho.js"></script>
</body>
</html>