<?php

include("session.php");

function MyAutoload($className) {    
    $extension =  spl_autoload_extensions();
    require_once (__DIR__ . '/classes/' . $className . $extension);
}

spl_autoload_extensions('.php');
spl_autoload_register('MyAutoload');

$Bibliotecario = new Bibliotecario();
$BibliotecaHorario = new BibliotecaHorario();

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
<link rel="stylesheet" href="Css/etec-style-elementos_especificos.css" />

    <!--icone da pagina-->
<link rel="icon" href="Imagens/Imagens estaticas/Icones/icone-etec.png" />

                                      <!-- titulo da pagina -->
<title>Biblioteca</title>

</head>
<body>

<?php 

include("admin_menu.php");/*inclusao do menu do site*/

	//Cadastra um novo bibliotecario
if(isset($_POST['cadastrar'])){
        //verifica se os campos foram recebidos
    if((isset($_POST['nome']))and(isset($_POST['funcao']))){
          //pega os valores dos campos
        $nome = $_POST['nome'];
        $funcao = $_POST['funcao'];

            //Salva os campos 
        if(!($Bibliotecario->setNome($nome))){
			
			die('Falha ao tentar realizar o cadastro, limite de caracteres ultrapassado.');
		
		}
		if(!($Bibliotecario->setCargo($funcao))){
			
			die('Falha ao tentar realizar o cadastro, limite de caracteres ultrapassado.');
		
		}

            //Insert
        if($Bibliotecario->insert()){
			
			    //Busca o id e as informacoes do bibliotecario
			$bibliotecario_info = $Bibliotecario->find('');
			
			if(!($bibliotecario_info)){
		
				die("Falha ao realizar o cadastro.");
		
			}
			
			$periodo = array('Manhã', 'Tarde', 'Noite');
			$dia = array('Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta');
			
				//Salva o id do funcionario
			$BibliotecaHorario->setFuncionario($bibliotecario_info->b_id); 
			
			for($i = 0; $i < 5; $i++){
				
				for($j = 0; $j < 3; $j++){
					
						//Salva o dia e o periodo do funcionario
					if(!($BibliotecaHorario->setDia($dia[$i]))){
						
						die('Falha ao tentar realizar o cadastro, opção inválida.');
					
					}
					if(!($BibliotecaHorario->setPeriodo($periodo[$j]))){
		
						die('Falha ao tentar realizar o cadastro, opção inválida.');
					
					}
				
					if(!($BibliotecaHorario->insert())){
					
						die("Falha ao realizar o cadastro.");
						
					}
					
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

//edicao de um bibliotecario
if(isset($_POST['editar'])){

        //verifica se os valores foram recebidos
    if((isset($_POST['nome']))and(isset($_POST['funcao']))and(isset($_POST['id']))){
   
            //pega os valores dos campos
        $id = $_POST['id'];
          //pega os valores dos campos
        $nome = $_POST['nome'];
        $funcao = $_POST['funcao'];

            //Salva os campos 
        if(!($Bibliotecario->setNome($nome))){
			
			die('Falha ao tentar realizar o cadastro, limite de caracteres ultrapassado.');
		
		}
		if(!($Bibliotecario->setCargo($funcao))){
			
			die('Falha ao tentar realizar o cadastro, limite de caracteres ultrapassado.');
		
		}
       
        if($Bibliotecario->update($id)){
        
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

//desativacao de uma data do calendario no mysql 
if(isset($_POST['desativar'])){

        //verifica se o id foi recebido
    if(isset($_POST['id'])){

            //pega o valor do id
        $id = (int)$_POST['id'];

            //realiza a busca das informações
        $resultado = $Bibliotecario->find($id);
    
        if(!($resultado)){

            die("Falha na desativacão");

        }
    
        $ativo = $resultado->b_ativo;

        if($ativo == 'S'){    
            $Bibliotecario->setAtivo('N');
            $mensagem = "Desativação"; 
        }
        else{
            $Bibliotecario->setAtivo('S');
            $mensagem = "Ativação"; 
        }

        if($Bibliotecario->delete($id)){
			
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

//edicao de um horario
if(isset($_POST['editar_horario'])){

        //verifica se os valores foram recebidos
    if((isset($_POST['horario_i']))and(isset($_POST['horario_f']))and(isset($_POST['id']))){
   
            //pega os valores dos campos
        $id = $_POST['id'];
        $horario_i = $_POST['horario_i'];
        $horario_f = $_POST['horario_f'];
		
		if(($horario_i != '')and($horario_f != '')){
			
			$BibliotecaHorario->setInicio($horario_i);
			$BibliotecaHorario->setFim($horario_f);
			
		}
		else{
			
			$BibliotecaHorario->setInicio(null);
			$BibliotecaHorario->setFim(null);
				
		}
		
        
       
        if($BibliotecaHorario->update($id)){
        
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
<main class="etec-admin-pag-padrao">
 <div class="etec-admin-pad-barlateral">
   <div class="etec-admin-pad-bar-info"><h1>Biblioteca</h1></div>
   <div class="etec-admin-pad-bar-info"><i>Informativo:</i> Nesta página contém informações referente aos bibliotecarios da escola. Logo abaixo desta mensagem há a seguinte opção: 
      
    <p><strong>"Cadastrar"</strong> Botão que irá redireciona-lo à página de cadastro;</p>  
  
    </div>
   
   <a href="admin_biblioteca_cadastro.php" ><div class="etec-admin-pad-bar-iten etec-admin-pad-bar-iten-btn " >
     Cadastrar
   </div></a>
  
<?php  

include("admin_barra_lateral_legendcores.php");

?> 
  
  
 </div>
 <div class="etec-admin-pad-conteudo">
 
  
  
  

<?php 

$bibliotecarios = $Bibliotecario->findAll('N');

if($bibliotecarios){
	
		//busca os funcionarios
	foreach($bibliotecarios as $key => $value):
 
?>
        
 <div class="cont-table-bibli" >
<table  border="1" cellpadding="1" class=" <?php if($value->b_ativo == 'N'){echo 'admin-pad-unit-desativ-color';}else{echo'admin-pad-unit-ativar-color';}?> ">
  <caption item_id="<?php echo $value->b_id; ?>" ativo="<?php echo $value->b_ativo; ?>" >
   <?php echo $value->b_nome; ?>
  </caption>
  <tr id="cont-table-title">
    <td>Dia/período</td>
    <td>2º</td>
    <td>3º</td>
    <td>4º</td>
    <td>5º</td>
    <td>6º</td>
  </tr>
<?php 

		$periodo = array('Manhã', 'Tarde', 'Noite');

		for($i = 0; $i < 3; $i++){
	
?>
  <tr>
    <td ><?php echo $periodo[$i]; ?></td>
<?php 

			foreach($BibliotecaHorario->findAll($value->b_id, $periodo[$i]) as $key_h => $horario):

?>
<td class="doc-reps cont-td-doc cont-a-black">
    <a href="admin_biblioteca_horario_editar.php?asAre342CsahGdBg34CF653VGJH745gdFGBcSt63gfGdDFGjyJGet45345BDfHfteCVt345HFefy7FFG654fdGFASDCVXtryjBVtyrtm234=<?php echo $horario->bh_id; ?>">
        <div class="biblioteca-link"><?php if(($horario->bh_horario_i != '')and($horario->bh_horario_f != '')){ echo date("H:i",strtotime($horario->bh_horario_i)); ?> as <?php echo date("H:i",strtotime($horario->bh_horario_f));}else{ echo '-';} ?></div>
    </a>
</td>
<?php 

			endforeach; 

?>
  </tr>
<?php 

		} 

?>  
</table>
</div> <!-- fechamento cont table -->
<?php 

	endforeach;

}

?>




</main>

<div class="etec-pop-up-tela-informacoes-fundo">

<div class="etec-pop-p-tela-informacoes-two-op">
  <div class="etec-img-fechar"><p><img src="Imagens/Imagens estaticas/Icones/x.png" /></p></div>
   
  <div class="etec-pop-up-conteud">

  </div> 
 
   <div class="etec-pop-up-opcoes-two">
   <form action="admin_biblioteca_editar.php" method="post" class="eve-admin-form" >
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



<script src="js/admin_biblioteca.js"></script>
</body>
</html>