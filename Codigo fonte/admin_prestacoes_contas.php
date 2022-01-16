<?php

include("session.php");

function MyAutoload($className) {    
    $extension =  spl_autoload_extensions();
    require_once (__DIR__ . '/classes/' . $className . $extension);
}

spl_autoload_extensions('.php');
spl_autoload_register('MyAutoload');
  
$PrestacaoContas = new PrestacaoContas();
$PrestacaoContasItens = new PrestacaoContasItens();

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
<title>Prestações de contas</title>
</head>
<body>

<?php
 
include("admin_menu.php");/*inclusao do menu do site*/


if(isset($_POST['cadastrar'])){
        //verifica se os campos foram recebidos
    if((isset($_POST['ano']))and(isset($_POST['identificacao_pag']))){
          	//pega os valores dos campos
    	$ano = $_POST['ano'];
   		$identificacao_pag = $_POST['identificacao_pag'];

            //Salva os campos 
        $PrestacaoContas->setAno($ano); 
		if(!($PrestacaoContas->setPagina($identificacao_pag))){
			
			die('Falha ao tentar realizar o cadastro, opção inválida.');
		
		}

            //Insert
        if($PrestacaoContas->insert()){
			
			    //Busca as informações da prestação de contas
			$resultado = $PrestacaoContas->find('');
			
			if(!($resultado)){
		
				die("Falha ao cadastrar.");
		
			}
			
			mkdir(__DIR__."/Documentacao/Prestacao_Contas/".$resultado->pc_id, 0777);
					
					//Cadastra os itens
			$mes = array('Janeiro', 'Fevereiro', 'Marco', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro');
			
				//Salva o id da prestação de contas
			$PrestacaoContasItens->setPrestacaoContas($resultado->pc_id);
			
			for($i = 0; $i < 12; $i++){
			
					//Salva o mes do item da prestação de contas
				if(!($PrestacaoContasItens->setMes($mes[$i]))){
					
					die('Falha ao tentar realizar o cadastro, opção inválida.');
				
				}
					
					//Cadastra o item
				if(!($PrestacaoContasItens->insert())){
			
					die("Falha ao cadastrar.");
			
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

//edicao de uma prestação de contas
if(isset($_POST['editar'])){
	
		//verifica se os valores foram recebidos
	if((isset($_POST['ano']))and(isset($_POST['identificacao_pag']))and(isset($_POST['id']))){
          	//pega os valores dos campos
		$id = $_POST['id'];
    	$ano = $_POST['ano'];
   		$identificacao_pag = $_POST['identificacao_pag'];

            //Salva os campos 
        $PrestacaoContas->setAno($ano); 
		if(!($PrestacaoContas->setPagina($identificacao_pag))){
			
			die('Falha ao tentar realizar o cadastro, opção inválida.');
		
		}
       
        if($PrestacaoContas->update($id)){
        
            echo '<script language="javascript">';
            echo "alert('Edição bem sucedida!');";
            echo '</script>';
        
        }
		else{
			
			echo '<script language="javascript">';
            echo "alert('Falha na edição da data selecionado!');";
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
    <form action="admin_prestacoes_contas_editar.php" method="post" class="eve-admin-form" >
      <label for='Editar' >Editar</label>
     <input type="submit" name="editar" value="Editar" editar  class="btn" id="Editar"/> <input  id="editar" name="id" type="hidden" value=""  />
    </form>
    <form action="admin_prestacoes_contas_itens.php" method="post">
     <label for='itens_btn'>Itens</label>
     <input type="submit" name="itens"  class="btn" id="itens_btn" /><input id="itens" name="id" type="hidden" value=""  />
    </form>
   </div> <!--fechamento da classe "etec-pop-p-tela-informacoes-two-op"-->   
  
</div><!---fechamento da class"etec-pop-p-tela-informacoes-two-op"-->
</div><!---fechamento da class"etec-pop-up-tela-informacoes-fundo"-->

<main class="etec-admin-pag-padrao">







<div class="etec-admin-pad-barlateral">
   <div class="etec-admin-pad-bar-info"><h1>Prestações de Contas</h1></div>
   <div class="etec-admin-pad-bar-info"><i>Informativo:</i> Nesta página contém informações referente ás prestações de contas da escola. Logo abaixo desta mensagem há a seguinte opção: 
      
    <p><strong>"Cadastrar"</strong> Botão que irá redireciona-lo à página de cadastro;</p>  
  
    </div>
   
  
  
 
   <a href="admin_prestacoes_contas_cadastrar.php"><div class="etec-admin-pad-bar-iten etec-admin-pad-bar-iten-btn " >
   Cadastrar
   </div></a>
  
   <?php  
   include("admin_barra_lateral_legendcores.php");
 ?>  
    
   
 </div><!--fechamento da class"etec-admin-pad-barlateral"-->
 <div class="etec-admin-pad-conteudo">
 
<?php 	     

$prestacoes = $PrestacaoContas->findAll('');

if($prestacoes){

	foreach($prestacoes as $key => $value):

?>
        
 <div class="etec-admin-pad-conteudo-unit-reduces admin-pad-unit-ativar-color" item_id="<?php echo $value->pc_id; ?>">
      
  
   <div class="etec-admin-pad-cont-unit-title "><!--- o "conteudo " virou "cont" --->
    Ano
   </div>
   <div class="etec-admin-pad-cont-unit-info" prestacao_contas_ano >
     <?php echo $value->pc_ano; ?>
   </div>
   
      <div class="etec-admin-pad-cont-unit-title"><!--- o "conteudo " virou "cont" --->
     Identificação da Página
   </div>
   <div class="etec-admin-pad-cont-unit-info-reduces etec-admin-pad-cont-unit-info " prestacao_contas_pagina >
      <?php echo $value->pc_pagina; ?>
   </div>

    
     
  </div><!--fechamento da class"etec-admin-pad-conteudo-unit"-->
<?php 

	endforeach;

}

?>
 </div><!--fechamento da class"etec-admin-pad-conteudo-->
</main>






<script src="js/admin_prestacao_contas.js"></script>
</body>
</html>