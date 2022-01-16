<?php

include("session.php"); 
   
function MyAutoload($className) {    
    $extension =  spl_autoload_extensions();
    require_once (__DIR__ . '/classes/' . $className . $extension);
}

spl_autoload_extensions('.php');
spl_autoload_register('MyAutoload');
  
$Vestibulinho = new Vestibulinho();
$Recomendacoes = new RecomendacoesVestibulinho();

    //pega as informações do ultimo vestibular
$vestibulinho = $Vestibulinho->findLast();

if(!$vestibulinho){

    die(header('location:admin_vestibular.php'));

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

                                        <!--titulo da pagina -->
<title>Recomendações</title>

</head>
<body>

<?php 

include("admin_menu.php");/*inclusao do menu do site*/

    //Cadastro de uma nova recomendacao
if(isset($_POST['cadastrar'])){
        //verifica se os campos foram recebidos
    if(isset($_POST['descricao'])){
            //pega os valores dos campos 
        $descricao = $_POST['descricao'];

            //Salva os campos 
        if(!($Recomendacoes->setDescricao($descricao))){
            
            die('Falha ao tentar realizar o cadastro, limite de caracteres ultrapassado.');
        
        }
        $Recomendacoes->setVestibulinho($vestibulinho->v_id);

            //Insert
        if($Recomendacoes->insert()){
            
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

    //edicao de uma recomendacao
if(isset($_POST['editar'])){

        //verifica se os campos foram recebidos
    if((isset($_POST['descricao']))and(isset($_POST['id']))){
        
            //Pega o id
        $id = $_POST['id'];

            //realiza a busca das informações
        $resultado = $Recomendacoes->find($id);
      
        if(!($resultado)){

            die(header('location:admin_vestibular.php'));

        }

        if($resultado->vr_vestibular == $vestibulinho->v_id){
        
                //pega os valores dos campos 
            $descricao = $_POST['descricao'];

                //Salva os campos 
            if(!($Recomendacoes->setDescricao($descricao))){
                
                die('Falha ao tentar realizar o cadastro, limite de caracteres ultrapassado.');
            
            }
           
            if($Recomendacoes->update($id)){
            
                echo '<script language="javascript">';
                echo "alert('Edição bem sucedida!');";
                echo '</script>';
            
            }
            else{
                
                echo '<script language="javascript">';
                echo "alert('Falha na edição da recomendação selecionada!');";
                echo '</script>';
                
            }

        }

    }   

}

    //desativacao de uma recomendacao
if(isset($_POST['desativar'])){

        //verifica se o id foi recebido
    if(isset($_POST['id'])){

            //pega o valor do id
        $id = (int)$_POST['id'];

            //realiza a busca das informações
        $resultado = $Recomendacoes->find($id);
      
        if(!($resultado)){

            die(header('location:admin_vestibular.php'));

        }

        if($resultado->vr_vestibular == $vestibulinho->v_id){
    
            $ativo = $resultado->vr_ativo;

            if($ativo == 'S'){    
            
                $Recomendacoes->setAtivo('N');
                $mensagem = "Desativação"; 
            
            }
            else{
            
                $Recomendacoes->setAtivo('S');
                $mensagem = "Ativação"; 
            
            }

            if($Recomendacoes->delete($id)){
                
                echo '<script language="javascript">';
                echo "alert('".$mensagem." bem sucedida!');";
                echo '</script>';
                
            }
            else{
                
                echo '<script language="javascript">';
                echo "alert('Falha na Desativação/Ativação da recomendação selecionada!');";
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
   <form action="admin_vestibular_recomendacoes_edicao.php" method="post"  class="eve-admin-form">
     <label for='Editar' >Editar</label>
     <input type="submit" name="editar" value="Editar" editar  class="btn" id="Editar"/> <input  id="editar" name="id" type="hidden" value="" />
    </form>
    <form action="#" method="post">
    <label for='Desativar' desativar>Desativar</label>
     <input type="submit" name="desativar" value="Desativar"  class="btn" id="Desativar" /><input id="desativar" name="id" type="hidden" value="" />
    </form>
   </div> <!--fechamento da classe "etec-pop-p-tela-informacoes-two-op"-->   
    
</div><!---fechamento da class"etec-pop-p-tela-informacoes-two-op"-->

</div><!---fechamento da class"etec-pop-up-tela-informacoes-fundo"-->

<main class="etec-admin-pag-padrao">
 <div class="etec-admin-pad-barlateral">
   <div class="etec-admin-pad-bar-info"><h1>Recomendações</h1></div>
   <div class="etec-admin-pad-bar-info"><i>Informativo:</i>  Nesta página contém informações referente às recomendações para o vestibulinho. Logo abaixo desta mensagem há as seguintes opções: 
      
    <p><strong>"Cadastrar"</strong> Botão que irá redireciona-lo à página de cadastro;</p> 
     <p><strong>"Voltar"</strong> Botão que irá redireciona-lo de volta à página de vestibulinho;</p>
 </div>
   
   <a href="admin_vestibular_recomendacoes_cadastro.php" ><div class="etec-admin-pad-bar-iten etec-admin-pad-bar-iten-btn " >
     Cadastrar
   </div></a>
  
   <a href="admin_vestibular.php" ><div class="etec-admin-pad-bar-iten etec-admin-pad-bar-iten-btn " >
     Voltar
   </div></a>
   <?php  
   include("admin_barra_lateral_legendcores.php");
 ?> 
 </div>
 <div class="etec-admin-pad-conteudo">
 
  
  
  

<?php 	     

$recomendacoes = $Recomendacoes->findAll($vestibulinho->v_id, 'N');

if($recomendacoes){
	
	foreach($recomendacoes as $key => $value):

?>     
 <div class="etec-admin-pad-conteudo-unit <?php if($value->vr_ativo == 'N'){echo 'admin-pad-unit-desativ-color';}else{echo'admin-pad-unit-ativar-color';}?>" item_id="<?php echo $value->vr_id; ?>" ativo="<?php echo $value->vr_ativo; ?>">
   <div class="etec-admin-pad-cont-unit-title "><!--- o "conteudo " virou "cont" --->
     Descrição
   </div>
   <div class="etec-admin-pad-cont-unit-info-reduces" <?php if($value->vr_descricao == ""){echo 'align="center"';}?>>
     <?php if($value->vr_descricao == ""){echo '--';}else{echo $value->vr_descricao;} ?>
   </div>
   
 </div>
<?php 

	endforeach;

}

?>

</main>



<script src="js/admin_recomendacoes.js"></script>
</body>
</html>