<?php

include("session.php");

function MyAutoload($className) {    
    $extension =  spl_autoload_extensions();
    require_once (__DIR__ . '/classes/' . $className . $extension);
}

spl_autoload_extensions('.php');
spl_autoload_register('MyAutoload');
  
$Plano_trabalho = new PlanoTrabalhoGremio();
$Gremios = new Gremio();

date_default_timezone_set('America/Sao_Paulo');
$date = date('Y');        

	//realiza a busca do ultimo gremio estudantil
$gremio_atual = $Gremios->find($date);
	
if(!($gremio_atual)){
		
	die(header('location:admin_gremio.php')); 
	
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
<title>Grêmio plano de trabalho</title>

</head>
<body>

<?php 

include("admin_menu.php");/*inclusao do menu do site*/

//edicao de data do calendario no mysql 
if(isset($_POST['editar'])){

        //verifica se os valores foram recebidos
    if((isset($_POST['categoria']))and(isset($_POST['descricao']))and(isset($_POST['id']))){
   
            //pega os valores dos campos
        $id = $_POST['id'];
        $categoria = $_POST['categoria'];
        $descricao = $_POST['descricao'];
		
			//Salva os campos 
		if(!($Plano_trabalho->setCategoria($categoria))){
		
			die('Falha ao tentar realizar a edição, categoria invalida.');
	
		}
        if(!($Plano_trabalho->setDescricao($descricao))){
		
			die('Falha ao tentar realizar a edição, limite de caracteres ultrapassado.');
	
		}
		 
			//Realiza a edição     
        if($Plano_trabalho->update($id)){
        
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

if(isset($_POST['cadastrar'])){
        //verifica se os campos foram recebidos
    if((isset($_POST['categoria']))and(isset($_POST['descricao']))){
          //pega os valores dos campos
        $categoria = $_POST['categoria'];
        $descricao = $_POST['descricao'];

        	//Salva os campos 
		if(!($Plano_trabalho->setCategoria($categoria))){
		
			die('Falha ao tentar realizar o cadastro, categoria invalida.');
	
		}
        if(!($Plano_trabalho->setDescricao($descricao))){
		
			die('Falha ao tentar realizar o cadastro, limite de caracteres ultrapassado.');
	
		}
		$Plano_trabalho->setGremio($gremio_atual->g_id);

            //Insert
        if($Plano_trabalho->insert()){
			
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

//desativacao de uma data do calendario no mysql 
if(isset($_POST['desativar'])){

        //verifica se o id foi recebido
    if(isset($_POST['id'])){

            //pega o valor do id
        $id = (int)$_POST['id'];

            //realiza a busca das informações
        $resultado = $Plano_trabalho->find($id, $gremio_atual->g_id);
    
        if(!($resultado)){

            die("Falha na desativacão");

        }
    
        $ativo = $resultado->pt_ativo;

        if($ativo == 'S'){    
            $Plano_trabalho->setAtivo('N');
            $mensagem = "Desativação"; 
        }
        else{
            $Plano_trabalho->setAtivo('S');
            $mensagem = "Ativação"; 
        }

        if($Plano_trabalho->delete($id)){
			
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

?>
<div class="etec-pop-up-tela-informacoes-fundo">

<div class="etec-pop-p-tela-informacoes-two-op">
  <div class="etec-img-fechar"><p><img src="Imagens/Imagens estaticas/Icones/x.png" /></p></div>
   
  <div class="etec-pop-up-conteud">

  </div> 
 
   <div class="etec-pop-up-opcoes-two">
    <form action="admin_gremio_plano_trabalho_editar.php" method="post"  class="eve-admin-form">
     <label for='Editar' >Editar</label>
     <input type="submit" name="editar" value="Editar" editar  class="btn" id="Editar"/> <input  id="editar" name="id" type="hidden" value="" />
    </form>
    <form action="#" method="post">
     <label for='Desativar' desativar>Desativar</label>
     <input type="submit" name="desativar" value="Desativar" class="btn" id="Desativar" /><input id="desativar" name="id" type="hidden" value="" />
    </form>
   </div> <!--fechamento da classe "etec-pop-p-tela-informacoes-two-op"-->   
  
</div><!---fechamento da class"etec-pop-p-tela-informacoes-two-op"-->

</div><!---fechamento da class"etec-pop-up-tela-informacoes-fundo"-->


<main class="etec-admin-pag-padrao">
<div class="etec-admin-pad-barlateral">
   <div class="etec-admin-pad-bar-info"><h1>Plano de trabalho</h1></div>
   <div class="etec-admin-pad-bar-info"><i>Informativo:</i>  Nesta página contém informações referente aos plano de trabalho do grêmio estudantil. Logo abaixo desta mensagem há as seguintes opções: 
      
    <p><strong>"Cadastrar"</strong> Botão que irá redireciona-lo à página de cadastro;</p>  
     <p><strong>Voltar</strong> Botão que irá redireciona-lo de volta à página dos grêmios.</p>
      </div>
  
  



  <a href="admin_gremio_plano_trabalho_cadastro.php" ><div class="etec-admin-pad-bar-iten etec-admin-pad-bar-iten-btn " >
   Cadastrar
   </div></a>
 

   
  <a href="admin_gremio.php" ><div class="etec-admin-pad-bar-iten etec-admin-pad-bar-iten-btn " >
   Voltar
   </div></a>
  
<?php  
   
	include("admin_barra_lateral_legendcores.php");

?> 
 
 </div><!--fechamento da class"etec-admin-pad-barlateral"-->
 <div class="etec-admin-pad-conteudo">
 
<?php 

$planotrabalho = $Plano_trabalho->findAll($gremio_atual->g_id, 'N', '');

if($planotrabalho){

	foreach($planotrabalho as $key => $value):

?>     
        
 <div class="etec-admin-pad-conteudo-unit-reduces  <?php if($value->pt_ativo == 'N'){
	  echo 'admin-pad-unit-desativ-color';
	  }else{
      echo'admin-pad-unit-ativar-color';
	  } ?>"
      item_id="<?php echo $value->pt_id; ?>" ativo="<?php echo $value->pt_ativo; ?>">
      
  
   <div class="etec-admin-pad-cont-unit-title "><!--- o "conteudo " virou "cont" --->
     Catergoria
   </div>
   <div class="etec-admin-pad-cont-unit-info" plano_trabalho_categoria >
    <?php
	
	echo $value->pt_categoria;
	
	?>
   </div>
   
    
     
  <div class="etec-admin-pad-cont-unit-title "><!--- o "conteudo " virou "cont" --->
     Descrição
   </div>
   <div class="etec-admin-pad-cont-unit-info etec-admin-pad-cont-unit-info " <?php if($value->pt_descricao == ""){echo 'align="center"';}?>>
     <?php if($value->pt_descricao == ""){echo '--';}else{echo $value->pt_descricao;}  ?>   
   </div>
   

     
  </div><!--fechamento da class"etec-admin-pad-conteudo-unit"-->
  
<?php 

	endforeach;

}

?>
 </div><!--fechamento da class"etec-admin-pad-conteudo-->
</main>




 

<script src="js/admin_plano_trabalho.js"></script>
</body>
</html>