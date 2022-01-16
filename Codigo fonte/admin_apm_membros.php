<?php

include("session.php");

function MyAutoload($className) {    
    $extension =  spl_autoload_extensions();
    require_once (__DIR__ . '/classes/' . $className . $extension);
}

spl_autoload_extensions('.php');
spl_autoload_register('MyAutoload');
  
$apm_ano = new ApmAno();
$apm_ano_membro = new ApmMembro();

	//Pega o ano atual
date_default_timezone_set('America/Sao_Paulo');
$date = date('Y'); 

$apm =$apm_ano->findLast();

if(isset($_POST['idApm']))
{
	
	$apm_escolhida = $apm_ano->find($_POST['idApm']);
	
	if(!$apm_escolhida){
	
		die(header('location:admin_apm.php'));
		
	}
	
}
else
{
	
	die(header('location:admin_apm.php'));
	
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
<title>APM -Membros</title>

</head>
<body>

<?php 

include("admin_menu.php");/*inclusao do menu do site*/

if( ($apm) and ($apm->aa_ano == $date) and ($apm->aa_id == $apm_escolhida->aa_id) ){
	
	//edicao de um membro da apm no mysql 
	if(isset($_POST['editar'])){
	
			//verifica se os valores foram recebidos
		if( (isset($_POST['nome'])) and (isset($_POST['cargo'])) and (isset($_POST['rg'])) and (isset($_POST['id'])) ){
			  //pega os valores dos campos
			$nome = $_POST['nome'];
			$cargo = $_POST['cargo'];
			$rg = $_POST['rg'];
			$id = $_POST['id'];
	
				//Salva os campos 
			if(!($apm_ano_membro->setNome($nome))){
				
				die('Falha ao tentar realizar o cadastro, limite de caracteres ultrapassado.');
			
			}
			if(!($apm_ano_membro->setCargo($cargo))){
				
				die('Falha ao tentar realizar o cadastro, limite de caracteres ultrapassado.');
			
			}
			if(!($apm_ano_membro->setRg($rg))){
				
				die('Falha ao tentar realizar o cadastro, limite de caracteres ultrapassado.');
			
			}
		   
			if($apm_ano_membro->update($id)){
			
				echo '<script language="javascript">';
				echo "alert('Edição bem sucedida!');";
				echo '</script>';
			
			}
			else{
				
				echo '<script language="javascript">';
				echo "alert('Falha na edição do membro da APM selecionado!');";
				echo '</script>';
				
			}
	
		}   
	
	}
	
	//Cadastro de um novo membro
	if(isset($_POST['cadastrar'])){
			//verifica se os campos foram recebidos
		if((isset($_POST['nome']))and(isset($_POST['cargo']))and(isset($_POST['rg']))){
			  //pega os valores dos campos
			$nome = $_POST['nome'];
			$cargo = $_POST['cargo'];
			$rg = $_POST['rg'];
	
				//Salva os campos 
			$apm_ano_membro->setAno($apm->aa_id);
			if(!($apm_ano_membro->setNome($nome))){
				
				die('Falha ao tentar realizar o cadastro, limite de caracteres ultrapassado.');
			
			}
			if(!($apm_ano_membro->setCargo($cargo))){
				
				die('Falha ao tentar realizar o cadastro, limite de caracteres ultrapassado.');
			
			}
			if(!($apm_ano_membro->setRg($rg))){
				
				die('Falha ao tentar realizar o cadastro, limite de caracteres ultrapassado.');
			
			}
	
				//Insert
			if($apm_ano_membro->insert()){
				
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
	
	//desativacao de um membro da apm no mysql 
	if(isset($_POST['desativar'])){
	
			//verifica se o id foi recebido
		if(isset($_POST['id'])){
	
				//pega o valor do id
			$id = (int)$_POST['id'];
	
				//realiza a busca das informações
			$resultado = $apm_ano_membro->find($id);
		
			if(!($resultado)){
	
				die("Falha na desativacão");
	
			}
		
			$ativo = $resultado->am_ativo;
	
			if($ativo == 'S'){    
				$apm_ano_membro->setAtivo('N');
				$mensagem = "Desativação"; 
			}
			else{
				$apm_ano_membro->setAtivo('S');
				$mensagem = "Ativação"; 
			}
	
			if($apm_ano_membro->delete($id)){
				
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
   	<form action="admin_apm_membros_editar.php" method="post" class="eve-admin-form" >
      	<label for='Editar' >Editar</label>
     	<input type="submit" name="editar" value="Editar" editar  class="btn" id="Editar"/>
        <input  id="editar" name="id" type="hidden" value=""  />
    </form>
    <form action="#" method="post">
     	<label for='Desativar' desativar>Desativar</label>
     	<input type="submit" name="desativar" value="Desativar"  class="btn" id="Desativar" />
        <input id="desativar" name="id" type="hidden" value=""  />
        <input name="idApm" type="hidden" value="<?php echo $apm->aa_id; ?>"  />
    </form>
   </div> <!--fechamento da classe "etec-pop-p-tela-informacoes-two-op"-->   
  
</div><!---fechamento da class"etec-pop-p-tela-informacoes-two-op"-->
</div><!---fechamento da class"etec-pop-up-tela-informacoes-fundo"-->

<?php

}

?>

<main class="etec-admin-pag-padrao">


<div class="etec-admin-pad-barlateral">
   <div class="etec-admin-pad-bar-info"><h1>APM <?php echo $apm_escolhida->aa_ano; ?> - Membros</h1></div>
   <div class="etec-admin-pad-bar-info"><i>Informativo:</i>  Nesta página contém informações referente ao membros da Associação de Pais e Mestres(APM).
<?php
	
if( ($apm) and ($apm->aa_ano == $date) and ($apm->aa_id == $apm_escolhida->aa_id) ){

?>
 Logo abaixo desta mensagem há a seguinte opção: 
      
    <p><strong>"Cadastrar"</strong> Botão que irá redireciona-lo à página de cadastro;</p>  
  
    </div>
 
   <a href="admin_apm_membros_cadastro.php"><div class="etec-admin-pad-bar-iten etec-admin-pad-bar-iten-btn " >
   Cadastrar
   </div></a>
   <a href="admin_apm.php"><div class="etec-admin-pad-bar-iten etec-admin-pad-bar-iten-btn " >
   Voltar
   </div></a>
<?php

}
else
{

?>

	<a href="admin_apm.php"><div class="etec-admin-pad-bar-iten etec-admin-pad-bar-iten-btn " >
   Voltar
   </div></a>
	</div>
    
<?php

}

?>    

 </div><!--fechamento da class"etec-admin-pad-barlateral"-->
 <div class="etec-admin-pad-conteudo">
 
<?php 

$apm_ano_membro->setAno($apm_escolhida->aa_id);

$membros = $apm_ano_membro->findAll();

if($membros){

	foreach($membros as $key => $value):

?>
        
 <div class="etec-admin-pad-conteudo-unit <?php if($value->am_ativo == 'N'){
	  echo 'admin-pad-unit-desativ-color';
	  }else{
      echo'admin-pad-unit-ativar-color';
	  } ?>"
      item_id="<?php echo $value->am_id; ?>" ativo="<?php echo $value->am_ativo; ?>">
   
   <div class="etec-admin-pad-cont-unit-title "><!--- o "conteudo " virou "cont" --->
     Nome
   </div>
   <div class="etec-admin-pad-cont-unit-info" apm_membro_nome>
     <?php echo $value->am_nome; ?>
   </div>
   <div class="etec-admin-pad-cont-unit-title "><!--- o "conteudo " virou "cont" --->
     Cargo
   </div>
   <div class="etec-admin-pad-cont-unit-info" >
     <?php echo $value->am_cargo; ?>
   </div>
   <div class="etec-admin-pad-cont-unit-title "><!--- o "conteudo " virou "cont" --->
     RG
   </div>
   <div class="etec-admin-pad-cont-unit-info" >
     <?php echo $value->am_rg; ?>
   </div>

     
  </div><!--fechamento da class"etec-admin-pad-conteudo-unit"-->
<?php 

	endforeach;

}

?>
 </div><!--fechamento da class"etec-admin-pad-conteudo-->
</main>
<?php 
	
if( ($apm) and ($apm->aa_ano == $date) and ($apm->aa_id == $apm_escolhida->aa_id) ){

?>
<script src="js/admin_apm_membro.js"></script>
<?php

}

?>
</body>
</html>