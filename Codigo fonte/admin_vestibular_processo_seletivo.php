<?php

include("session.php"); 
   
function MyAutoload($className) {    
    $extension =  spl_autoload_extensions();
    require_once (__DIR__ . '/classes/' . $className . $extension);
}

spl_autoload_extensions('.php');
spl_autoload_register('MyAutoload');
  
$Vestibulinho = new Vestibulinho();
$ProcessoSeletivo = new ProcessoSeletivoVestibulinho();

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
                                                     <!--tiulo da pagina -->
<title>Processo seletivo</title>

</head>
<body>

<?php 

include("admin_menu.php");/*inclusao do menu do site*/

    //Cadastro de um novo topico
if(isset($_POST['cadastrar'])){
        //verifica se os campos foram recebidos
    if((isset($_POST['descricao']))||(isset($_POST['data_i']))||(isset($_POST['data_f']))||(isset($_POST['hora_i']))||(isset($_POST['hora_f']))){
            //pega os valores dos campos 
        $descricao = $_POST['descricao'];
        $data_i = $_POST['data_i'];
        $data_f = $_POST['data_f'];
        $hora_i = $_POST['hora_i'];
        $hora_f = $_POST['hora_f'];

            //Salva os campos 
        if(!($ProcessoSeletivo->setDescricao($descricao))){
            
            die('Falha ao tentar realizar o cadastro, limite de caracteres ultrapassado.');
        
        }

        $ProcessoSeletivo->setDataInicial($data_i." ".$hora_i);
        if($data_f != ""){
            
            $ProcessoSeletivo->setDataFinal($data_f." ".$hora_f);
        
        }
        else{

            $ProcessoSeletivo->setDataFinal(null);

        }
        $ProcessoSeletivo->setVestibulinho($vestibulinho->v_id);

            //Insert
        if($ProcessoSeletivo->insert()){
            
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

    //edicao de um topico
if(isset($_POST['editar'])){

        //verifica se os campos foram recebidos
    if((isset($_POST['descricao']))||(isset($_POST['data_i']))||(isset($_POST['data_f']))||(isset($_POST['hora_i']))||(isset($_POST['hora_f']))and(isset($_POST['id']))){

            //Pega o id
        $id = $_POST['id'];

            //realiza a busca das informações
        $resultado = $ProcessoSeletivo->find($id);
      
        if(!($resultado)){

            die(header('location:admin_vestibular.php'));

        }

        if($resultado->vt_vestibular == $vestibulinho->v_id){
  
                //pega os valores dos campos 
            $descricao = $_POST['descricao'];
            $data_i = $_POST['data_i'];
            $data_f = $_POST['data_f'];
            $hora_i = $_POST['hora_i'];
            $hora_f = $_POST['hora_f'];

                //Salva os campos
            if(!($ProcessoSeletivo->setDescricao($descricao))){
                
                die('Falha ao tentar realizar o cadastro, limite de caracteres ultrapassado.');
            
            }

            $ProcessoSeletivo->setDataInicial($data_i." ".$hora_i);
            if($data_f != ""){
                
                $ProcessoSeletivo->setDataFinal($data_f." ".$hora_f);
            
            }
            else{

                $ProcessoSeletivo->setDataFinal(null);

            }
           
            if($ProcessoSeletivo->update($id)){
            
                echo '<script language="javascript">';
                echo "alert('Edição bem sucedida!');";
                echo '</script>';
            
            }
            else{
                
                echo '<script language="javascript">';
                echo "alert('Falha na edição do tópico selecionado!');";
                echo '</script>';
                
            }

        }

    }   

}

    //desativacao de um topico
if(isset($_POST['desativar'])){

        //verifica se o id foi recebido
    if(isset($_POST['id'])){

            //pega o valor do id
        $id = (int)$_POST['id'];

            //realiza a busca das informações
        $resultado = $ProcessoSeletivo->find($id);
      
        if(!($resultado)){

            die(header('location:admin_vestibular.php'));

        }

        if($resultado->vt_vestibular == $vestibulinho->v_id){
    
            $ativo = $resultado->vt_ativo;

            if($ativo == 'S'){    
            
                $ProcessoSeletivo->setAtivo('N');
                $mensagem = "Desativação"; 
            
            }
            else{
            
                $ProcessoSeletivo->setAtivo('S');
                $mensagem = "Ativação"; 
            
            }

            if($ProcessoSeletivo->delete($id)){
                
                echo '<script language="javascript">';
                echo "alert('".$mensagem." bem sucedida!');";
                echo '</script>';
                
            }
            else{
                
                echo '<script language="javascript">';
                echo "alert('Falha na Desativação/Ativação do tópico selecionado!');";
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
 <form action="admin_vestibular_processo_seletivo_editar.php" method="post" class="eve-admin-form" >
     <label for='Editar' >Editar</label>
     <input type="submit" name="editar" value="Editar"  class="" id="Editar"/> <input  id="editar" name="id" type="hidden" value="" />
     
    </form>
    <form action="#" method="post">
     <label for='Desativar' desativar>Desativar</label>
     <input type="submit" name="desativar" value="Desativar"  class="" id="Desativar" /><input id="desativar" name="id" type="hidden" value="" />
    </form>
   </div> <!--fechamento da classe "etec-pop-p-tela-informacoes-two-op"-->   
    
</div><!---fechamento da class"etec-pop-p-tela-informacoes-two-op"-->

</div><!---fechamento da class"etec-pop-up-tela-informacoes-fundo"-->

<main class="etec-admin-pag-padrao">
 <div class="etec-admin-pad-barlateral">
   <div class="etec-admin-pad-bar-info"><h1>Processo seletivo</h1></div>
   <div class="etec-admin-pad-bar-info"><i>Informativo:</i> Nesta página contém informações referente aos tópicos do processo seletivo. Logo abaixo desta mensagem há as seguintes opções: 
      
    <p><strong>"Cadastrar"</strong> Botão que irá redireciona-lo à página de cadastro;</p> 
     <p><strong>"Voltar"</strong> Botão que irá redireciona-lo de volta à página de vestibulinho;</p>
   </div>
   
    <a href="admin_vestibular_processo_seletivo_cadastrar.php" ><div class="etec-admin-pad-bar-iten etec-admin-pad-bar-iten-btn " >
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

$topicos = $ProcessoSeletivo->findAll($vestibulinho->v_id, 'N');

if($topicos){
	
	foreach($topicos as $key => $value):

?>           
 <div class="etec-admin-pad-conteudo-unit 
    <?php 
    
		if($value->vt_ativo == 'N'){
	
			echo 'admin-pad-unit-desativ-color';
	
		}
		else{
	
			echo'admin-pad-unit-ativar-color';
		}

    ?>" id="" item_id="<?php echo $value->vt_id; ?>" ativo="<?php echo $value->vt_ativo; ?>">
   <div class="etec-admin-pad-cont-unit-title "><!--- o "conteudo " virou "cont" --->
     Descrição
   </div>
   <div class="etec-admin-pad-cont-unit-info" processo_seletivo_descricao <?php if($value->vt_descricao == ""){ echo 'align="center"'; } ?> >
        <?php 

			if($value->vt_descricao == ""){
	
				echo '--';
	
			}
			else{
	
				echo $value->vt_descricao;
	
			} 

        ?>
   </div>
   <div class="etec-admin-pad-cont-unit-dis">
     <div class="etec-admin-pad-cont-unit-dis-one">
        <div class="etec-admin-pad-cont-unit-title"><!--- o "conteudo " virou "cont" --->
         Data inicial
        </div>
        <div class="etec_admin-pad-cont-unit-info-aling etec-admin-pad-cont-unit-info" >
        
        <?php 
			 
            $data_aux = explode(" ",$value->vt_data_inicial);
			echo date('d/m/Y',strtotime($data_aux[0]))." ".$data_aux[1];
		  
        ?>
        </div>
     </div><!--fechamento da class"etec-admin-pad-cont-unit-dis-one"-->
     <div class="etec-admin-pad-cont-unit-dis-two">
       <div class="etec-admin-pad-cont-unit-title" ><!--- o "conteudo " virou "cont" --->
         Data final
       </div>
       <div class="etec_admin-pad-cont-unit-info-aling etec-admin-pad-cont-unit-info " <?php if($value->vt_data_final == ""){ echo 'align="center"'; } ?>>
        <?php 

            if($value->vt_data_final == ""){

                echo '--'; 

            }
            else{
			     
                $data_aux = explode(" ",$value->vt_data_final);
			    echo date('d/m/Y',strtotime($data_aux[0]))." ".$data_aux[1];
			 
            } 

        ?>
       </div>
     </div><!--fechamento da class"etec-admin-pad-cont-unit-dis-two"-->
    
   </div><!--fechamento da class"etec-admin-cont-unit-dis"-->

</div>

<?php 

	endforeach;

}

?>



</main>






<script src="js/admin_processo_seletivo.js"></script>
</body>

</html>