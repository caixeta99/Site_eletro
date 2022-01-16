<?php

include("session.php");

function MyAutoload($className) {    
    $extension =  spl_autoload_extensions();
    require_once (__DIR__ . '/classes/' . $className . $extension);
}

spl_autoload_extensions('.php');
spl_autoload_register('MyAutoload');
  
$Data = new CalendarioData();

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
<title>Calendário</title>

</head>
<body>

<?php 

include("admin_menu.php");/*inclusao do menu do site*/

//edicao de data do calendario no mysql 
if(isset($_POST['editar'])){

        //verifica se os valores foram recebidos
    if((isset($_POST['data']))and(isset($_POST['descricao']))and(isset($_POST['id']))){
   
            //pega os valores dos campos
        $id = $_POST['id'];
        $data_c = $_POST['data'];
        $descricao = $_POST['descricao'];

        $Data->setData($data_c);
        if(!($Data->setDescricao($descricao))){
			
			die('Falha ao tentar realizar a edição, limite de caracteres ultrapassado.');
		
		}
       
        if($Data->update($id)){
        
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

if(isset($_POST['cadastrar'])){
        //verifica se os campos foram recebidos
    if((isset($_POST['data']))and(isset($_POST['descricao']))){
          //pega os valores dos campos
        $data_caledario = $_POST['data'];
        $descricao = $_POST['descricao'];

            //Salva os campos 
        $Data->setData($data_caledario); 
		if(!($Data->setDescricao($descricao))){
			
			die('Falha ao tentar realizar o cadastro, limite de caracteres ultrapassado.');
		
		}

            //Insert
        if($Data->insert()){
			
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
        $resultado = $Data->find($id);
    
        if(!($resultado)){

            die("Falha na desativacão");

        }
    
        $ativo = $resultado->d_ativo;

        if($ativo == 'S'){    
            $Data->setAtivo('N');
            $mensagem = "Desativação"; 
        }
        else{
            $Data->setAtivo('S');
            $mensagem = "Ativação"; 
        }

        if($Data->delete($id)){
			
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
    <form action="admin_calendario_editar.php" method="post" class="eve-admin-form" >
      <label for='Editar' >Editar</label>
     <input type="submit" name="editar" value="Editar" editar  class="btn" id="Editar"/> <input  id="editar" name="id" type="hidden" value=""  />
    </form>
    <form action="#" method="post">
     <label for='Desativar' desativar>Desativar</label>
     <input type="submit" name="desativar" value="Desativar"  class="btn" id="Desativar" /><input id="desativar" name="id" type="hidden" value=""  />
    </form>
   </div> <!--fechamento da classe "etec-pop-p-tela-informacoes-two-op"-->   
  
</div><!---fechamento da class"etec-pop-p-tela-informacoes-two-op"-->
</div><!---fechamento da class"etec-pop-up-tela-informacoes-fundo"-->


<main class="etec-admin-pag-padrao">


<div class="etec-admin-pad-barlateral">
   <div class="etec-admin-pad-bar-info"><h1>Calendário</h1></div>
   <div class="etec-admin-pad-bar-info"><i>Informativo:</i>  Nesta página contém informações referente às datas do calendário escolar. Logo abaixo desta mensagem há a seguinte opção: 
      
    <p><strong>"Cadastrar"</strong> Botão que irá redireciona-lo à página de cadastro;</p>  
  
    </div>
  
  
 
   <a href="admin_calendario_cadastro.php"><div class="etec-admin-pad-bar-iten etec-admin-pad-bar-iten-btn " >
   Cadastrar
   </div></a>
  
<?php  

include("admin_barra_lateral_legendcores.php");

?> 
    
   
 </div><!--fechamento da class"etec-admin-pad-barlateral"-->
 <div class="etec-admin-pad-conteudo">
 
<?php 

foreach($Data->findAll('', '', 'N','N', 'DESC') as $key => $value):

?>
        
 <div class="etec-admin-pad-conteudo-unit <?php if($value->d_ativo=='N'){
	  echo 'admin-pad-unit-desativ-color';
	  }else{
      echo'admin-pad-unit-ativar-color';
	  } ?>"
      item_id="<?php echo $value->d_id; ?>" ativo="<?php echo $value->d_ativo; ?>">
   
   <div class="etec-admin-pad-cont-unit-title "><!--- o "conteudo " virou "cont" --->
     Data
   </div>
   <div class="etec-admin-pad-cont-unit-info" calendario_data <?php if($value->d_data==""){echo 'align="center"';}?>>
     <?php  if($value->d_data==""){echo '--';}else{echo date('d/m/Y',strtotime($value->d_data));}   ?>
   </div>

     
   <div class="etec-admin-pad-cont-unit-title "><!--- o "conteudo " virou "cont" --->
     Descrição 
   </div>
   <div class="etec-admin-pad-cont-unit-info-reduces etec-admin-pad-cont-unit-info " <?php if($value->d_descricao==""){echo 'align="center"';}?>>
      <?php if($value->d_descricao==""){echo '--';}else{echo $value->d_descricao;} ?>
   </div>
   
   
     
  </div><!--fechamento da class"etec-admin-pad-conteudo-unit"-->
  </a><!--fechamento do link que envolve todo o container -->
<?php 

endforeach;

?>
 </div><!--fechamento da class"etec-admin-pad-conteudo-->
</main>



<script src="js/admin_calendarios.js"></script>
</body>
</html>