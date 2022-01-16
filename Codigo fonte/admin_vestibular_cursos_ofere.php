<?php

include("session.php"); 
   
function MyAutoload($className) {    
    $extension =  spl_autoload_extensions();
    require_once (__DIR__ . '/classes/' . $className . $extension);
}

spl_autoload_extensions('.php');
spl_autoload_register('MyAutoload');
  
$Vestibulinho = new Vestibulinho();
$CursosVestibulinho = new CursosVestibulinho();
$LigacaoCursosVestibulinho = new LigacaoCursosVestibulinho();

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
<title>Vestibulinho Cursos</title>

</head>
<body>

<?php 

include("admin_menu.php");/*inclusao do menu do site*/

	//Cadastra um curso
if(isset($_POST['cadastrar'])){
        //verifica se os campos foram recebidos
	if((isset($_POST['nome']))and(isset($_POST['periodo']))and(isset($_POST['qtd_vags']))){
   			//pega os valores dos campos
   		$nome = $_POST['nome'];
   		$periodo = $_POST['periodo'];
   		$qtd_vags = $_POST['qtd_vags'];

            //Salva os campos 
        if(!($CursosVestibulinho->setNome($nome))){
			
			die('Falha ao tentar realizar o cadastro, limite de caracteres ultrapassado.');
		
		}
		if(!($CursosVestibulinho->setPeriodo($periodo))){
			
			die('Falha ao tentar realizar o cadastro, opção inválida.');
		
		}
		if(!($CursosVestibulinho->setQuantidadeVagas($qtd_vags))){
			
			die('Falha ao tentar realizar o cadastro, deve haver pelo menos uma vaga.');
		
		}

            //Insert
        if($CursosVestibulinho->insert()){
			
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

//edicao de um curso
if(isset($_POST['editar'])){

        //verifica se os valores foram recebidos
    if((isset($_POST['nome']))and(isset($_POST['periodo']))and(isset($_POST['qtd_vags']))and(isset($_POST['id']))){
   
        	//pega os valores dos campos
   		$id = $_POST['id'];
		$nome = $_POST['nome'];
   		$periodo = $_POST['periodo'];
   		$qtd_vags = $_POST['qtd_vags'];

            //Salva os campos 
        if(!($CursosVestibulinho->setNome($nome))){
			
			die('Falha ao tentar realizar o cadastro, limite de caracteres ultrapassado.');
		
		}
		if(!($CursosVestibulinho->setPeriodo($periodo))){
			
			die('Falha ao tentar realizar o cadastro, opção inválida.');
		
		}
		if(!($CursosVestibulinho->setQuantidadeVagas($qtd_vags))){
			
			die('Falha ao tentar realizar o cadastro, deve haver pelo menos uma vaga.');
		
		}
       
        if($CursosVestibulinho->update($id)){
        
            echo '<script language="javascript">';
            echo "alert('Edição bem sucedida!');";
            echo '</script>';
        
        }
		else{
			
			echo '<script language="javascript">';
            echo "alert('Falha na edição do curso selecionado!');";
            echo '</script>';
			
		}

    }   

}

//altera os curso relacionados ao ultimo vestibulinho
if(isset($_POST['ligacoes'])){
	
		//Deleta todas as ligacoes deste vestibulinho
	if(!$LigacaoCursosVestibulinho->delete($vestibulinho->v_id)){
	
		die('Falha na edição');
			
	}
	
		//salva o id do vestibulinho
	$LigacaoCursosVestibulinho->setVestibulinho($vestibulinho->v_id);
	
		//verifica se foi recebido algum curso  
   	if(isset($_POST['curso_vestibular'])){  
   			
			//Cadastra as novas ligacoes
		foreach($_POST['curso_vestibular'] as $key => $curso):
		
			$LigacaoCursosVestibulinho->setCurso($curso);
			
			    //Insert
			if(!$LigacaoCursosVestibulinho->insert()){
				
				die('Falha na edição');
				
			}
		
		endforeach;
		
   	}
	
	echo '<script language="javascript">';
    echo "alert('Edição bem sucedida!');";
    echo '</script>';
	
}

?>

<div class="etec-pop-up-tela-informacoes-fundo">
<div class="etec-pop-p-tela-informacoes-two-op">
  <div class="etec-img-fechar"><p><img src="Imagens/Imagens estaticas/Icones/x.png" /></p></div>
   
  <div class="etec-pop-up-conteud">

  </div> 
 <div class="etec-pop-up-opcoes-two">
 <form action="admin_vestibular_cursos_ofere_editar.php" method="post" class="eve-admin-form" >
      <label for='Editar' >Editar</label>
     <input type="submit" name="editar" value="Editar" editar  class="btn" id="Editar"/> <input  id="editar" name="id" type="hidden" value=""  />
    </form>
   </div> <!--fechamento da classe "etec-pop-p-tela-informacoes-two-op"-->   
    
</div><!---fechamento da class"etec-pop-p-tela-informacoes-two-op"-->

</div><!---fechamento da class"etec-pop-up-tela-informacoes-fundo"-->



<main class="etec-admin-pag-padrao">
 <div class="etec-admin-pad-barlateral">
   <div class="etec-admin-pad-bar-info"><h1>Cursos oferecidos </h1></div>
   <div class="etec-admin-pad-bar-info"><i>Informativo:</i> Nesta página contém informações referente aos cursos oferecidos disponiveis para o vestibulinho. Logo abaixo desta mensagem há as seguintes opções: 
      
    <p><strong>"Cadastrar"</strong> Botão que irá redireciona-lo à página de cadastro;</p>  
     <p><strong>"Salvar Alterações"</strong> Botão que irá realizar as ligações entre os cursos selecionados e o vestibulinho;</p>
     <p><strong>"Voltar"</strong> Botão que irá redireciona-lo de volta à página de vestibulinho.</p>
   </div>
   
   
   <a href="admin_vestibular_cursos_ofere_cadastrar .php" ><div class="etec-admin-pad-bar-iten etec-admin-pad-bar-iten-btn " >
     Cadastrar
   </div></a>
  
  <a href="admin_vestibular.php" ><div class="etec-admin-pad-bar-iten etec-admin-pad-bar-iten-btn " >
     Voltar
   </div></a>
  
  <div class="etec-admin-pad-bar-iten-alment etec-admin-pad-bar-iten etec-admin-pad-bar-iten-btn " >
     <label for="ligacao">Salvar Alterações</label>
   </div>
 </div>
 <div class="etec-admin-pad-conteudo">
 
  
  
  
<form action="#" method="post">
     <input name="ligacoes" type="submit" id="ligacao" class="input_typ_subm_none" />  
<?php 

$i = 0;

$cursos = $CursosVestibulinho->findAll('', '');

if($cursos){
	  
	foreach($cursos as $key => $value):

?>         
 <div class="etec-admin-pad-conteudo-unit admin-pad-unit-ativar-color" item_id="<?php echo $value->vc_id; ?>">
   <div class="etec-admin-pad-cont-unit-title etec-admin-pad-cont-unit-click"><!--- o "conteudo " virou "cont" --->
     Nome
   </div>
   <div class="etec-admin-pad-cont-unit-info etec-admin-pad-cont-unit-click"  <?php if($value->vc_nome == ""){echo 'align="center"';}?> curso_titulo>
    <?php if($value->vc_nome == ""){echo '--';}else{echo $value->vc_nome;} ?>
   </div>
   <div class="etec-admin-pad-cont-unit-title etec-admin-pad-cont-unit-click "><!--- o "conteudo " virou "cont" --->
      Período
   </div>
   <div class="etec-admin-pad-cont-unit-info etec-admin-pad-cont-unit-click">
      <?php echo $value->vc_periodo; ?>
   </div>
   
   
   <div class="etec-admin-pad-cont-unit-dis">
     <div class="etec-admin-pad-cont-unit-dis-one">
        <div class="etec-admin-pad-cont-unit-title etec-admin-pad-cont-unit-click"><!--- o "conteudo " virou "cont" --->
         QTD VAGAS
        </div>
        <div class="etec_admin-pad-cont-unit-info-aling etec-admin-pad-cont-unit-info etec-admin-pad-cont-unit-click" >
           <?php echo $value->vc_qtd_vagas; ?>
        </div>
     </div><!--fechamento da class"etec-admin-pad-cont-unit-dis-one"-->
     <div class="etec-admin-pad-cont-unit-dis-two">
       <div class="etec-admin-pad-cont-unit-title"><!--- o "conteudo " virou "cont" --->
         Selecionar
       </div>
       <div class="etec_admin-pad-cont-unit-info-aling etec-admin-pad-cont-unit-info">
        <input name="curso_vestibular[<?php echo $i; ?>]" type="checkbox" value="<?php echo $value->vc_id; ?>"
           	<?php
		    
			    //Verificase há ligacao como curso
			$ligacao = $LigacaoCursosVestibulinho->find($value->vc_id, $vestibulinho->v_id);
			
			if($ligacao){
			
				echo 'checked="checked"';
			
			}
			
		   	?>  />
       </div>
     </div><!--fechamento da class"etec-admin-pad-cont-unit-dis-two"-->
    
   </div><!--fechamento da class"etec-admin-cont-unit-dis"-->
 
 </div>

<?php 

		$i++;

	endforeach;

}

?>
 </form>


</main>


<script src="js/admin_cursos_vestibular.js"></script>
</body>
</html>