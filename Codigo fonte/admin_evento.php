<?php

include("session.php");

function MyAutoload($className) {    
    $extension =  spl_autoload_extensions();
    require_once (__DIR__ . '/classes/' . $className . $extension);
}

spl_autoload_extensions('.php');
spl_autoload_register('MyAutoload');
  
$Eventos = new Eventos();
$DataEvento = new EventoData();
$Albuns = new Album();
$Imagens = new Imagem();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

                                    <!-- meta tages da pagina -->
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
<title>Eventos</title>

</head>
<body>

<?php 

include("admin_menu.php");/*inclusao do menu do site*/

  //Cadastra um curso
if(isset($_POST['cadastrar'])){
        //verifica se os campos foram recebidos
    if((isset($_POST['titulo']))and(isset($_POST['sinopse']))and(isset($_POST['descricao']))and(isset($_POST['data']))){
      
            //pega os valores dos campos
        $titulo = $_POST['titulo'];
        $sinopse = $_POST['sinopse'];
        $descricao = $_POST['descricao'];
        $data = $_POST['data'];
    
            //Cadastra o album
        if(!($Albuns->setTitulo($titulo))){
      
            die('Falha ao tentar realizar o cadastro, limite de caracteres ultrapassado.');
    
        }
    
        if(!($Albuns->insert())){
    
            die('Falha ao realizar o cadastro.');
    
        }
    
            //busca o id do album
        $id = $Albuns->findLast();
        
            //Cria a pasta do album
        mkdir(__DIR__."/Imagens/Albuns/".$id->id, 0777);
          
                //Salva os campos 
        if(!($Eventos->setTitulo($titulo))){
          
          die('Falha ao tentar realizar o cadastro, limite de caracteres ultrapassado.');
        
        }
        if(!($Eventos->setSinopse($sinopse))){
          
          die('Falha ao tentar realizar o cadastro, limite de caracteres ultrapassado.');
        
        }
        if(!($Eventos->setDescricao($descricao))){
          
          die('Falha ao tentar realizar o cadastro, limite de caracteres ultrapassado.');
        
        }
        $Eventos->setAlbum($id->id);

            //Insert
        if($Eventos->insert()){

                //busca o id do album
            $id_evento = $Eventos->findLast();

                //Salva os campos 
            $DataEvento->setEvento($id_evento->id);
            $DataEvento->setData($data);                    

                //Inseri a data do evento
            if($DataEvento->insert()){
          
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
  if((isset($_POST['id']))and(isset($_POST['titulo']))and(isset($_POST['sinopse']))and(isset($_POST['descricao']))){
   
            //pega os valores dos campos
        $id = $_POST['id'];
        $titulo = $_POST['titulo'];
        $sinopse = $_POST['sinopse'];
        $descricao = $_POST['descricao'];
    
            //Verifica se o curso existe
        $resultado = $Eventos->find($id);
        
        if(!($resultado)){
      
          die("Falha na consulta");
      
        }

            //Edita o album
        if(!($Albuns->setTitulo($titulo))){
      
            die('Falha ao tentar realizar o cadastro, limite de caracteres ultrapassado.');
    
        }
    
        if(!($Albuns->update($resultado->e_album))){
    
            die('Falha ao realizar o cadastro.');
    
        }

            //Salva os campos 
        if(!($Eventos->setTitulo($titulo))){
          
          die('Falha ao tentar realizar o cadastro, limite de caracteres ultrapassado.');
        
        }
        if(!($Eventos->setSinopse($sinopse))){
          
          die('Falha ao tentar realizar o cadastro, limite de caracteres ultrapassado.');
        
        }
        if(!($Eventos->setDescricao($descricao))){
          
          die('Falha ao tentar realizar o cadastro, limite de caracteres ultrapassado.');
        
        }
           
        if($Eventos->update($id)){
        
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

  //desativacao de uma data do calendario no mysql 
if(isset($_POST['desativar'])){

        //verifica se o id foi recebido
    if(isset($_POST['id'])){

            //pega o valor do id
        $id = (int)$_POST['id'];

            //realiza a busca das informações
        $resultado = $Eventos->find($id);
    
        if(!($resultado)){

            die("Falha na desativacão");

        }
    
        $ativo = $resultado->e_ativo;

        if($ativo == 'S'){    
            $Eventos->setAtivo('N');
            $mensagem = "Desativação"; 
        }
        else{
            $Eventos->setAtivo('S');
            $mensagem = "Ativação"; 
        }

        if($Eventos->delete($id)){
      
            echo '<script language="javascript">';
            echo "alert('".$mensagem." bem sucedida!');";
            echo '</script>';
      
        }
        else{
      
            echo '<script language="javascript">';
            echo "alert('Falha na Desativação/Ativação do curso selecionado!');";
            echo '</script>';
      
        }
        
    }
 
}

?>

<!---are reservada ao pop up da pagina-->

<div class="etec-pop-up-tela-informacoes-fundo">

<div class="etec-pop-up-tela-informacoes-three-op">
  <div class="etec-img-fechar"><p><img src="Imagens/Imagens estaticas/Icones/x.png" /></p></div>
   
  <div class="etec-pop-up-conteud">
  
  </div> 
 
   <div class="etec-pop-up-opcoes-three">
    <form action="admin_evento_editar.php" method="post" class="eve-admin-form" >
     <label for='Editar' >Editar</label>
     <input type="submit" name="editar" value="Editar"  class="" id="Editar"/> <input  id="editar" name="id" type="hidden" value="" />
     
    </form>
    <form action="#" method="post">
     <label for='Desativar' desativar>Desativar</label>
     <input type="submit" name="desativar" value="Desativar"  class="" id="Desativar" /><input id="desativar" name="id" type="hidden" value="" />
    </form>
    <form action="admin_data_evento.php" method="post">
     <label for='Datas'>Datas</label>
     <input type="submit" name="datas" value=""  class="" id="Datas" /><input id="datas" name="id" type="hidden" value="" />
    </form>
   </div> <!--fechamento da classe "etec-pop-p-tela-informacoes-two-op"-->   
  
</div><!---fechamento da class""-->

</div><!---fechamento da class"etec-pop-up-tela-informacoes-fundo"-->


<main class="etec-admin-pag-padrao">

   



 <div class="etec-admin-pad-barlateral">
   <div class="etec-admin-pad-bar-info"><h1>Eventos </h1></div>
   <div class="etec-admin-pad-bar-info"><i>Informativo:</i> Nesta página contém informações referente aos eventos promovidos pela escola. Logo abaixo desta mensagem há a seguinte opção: 
      
    <p><strong>"Cadastrar"</strong> Botão que irá redireciona-lo à página de cadastro;</p>  
   
   </div>
  
  
 
    <a href="admin_evento_cadastro.php"><div class="etec-admin-pad-bar-iten etec-admin-pad-bar-iten-btn " >
     Cadastrar
   </div></a>
  
   
<?php  

include("admin_barra_lateral_legendcores.php");

?> 
   
 </div><!--fechamento da class"etec-admin-pad-barlateral"-->
 <div class="etec-admin-pad-conteudo">
 
<?php       

$evento = $Eventos->findAll('N', 'N');

if($evento){ 
  
	foreach($evento as $key => $value):
	
		//verifica se há imagem  principal no album
	  $resultado = $Imagens->findPrincipal($value->e_album);
		 
	  if(!$resultado){
	  
		  //se não foi encontrada, e chamada uma imagem pré definida
		$imagem = array('','Imagem não encontrada','Imagens/Imagens estaticas/Outras imagens/Imagem_evento.jpg');
	  
	  }
	  else{
	  
		  //se foi encontrada, a imagem sendo cadastrada não recebe prioridade
		$imagem = array($resultado->i_titulo,$resultado->i_alt,$resultado->i_caminho);
	  
	  }

?>
        
        
 <div class="etec-admin-pad-conteudo-unit  <?php if($value->e_ativo == 'N'){
	  echo 'admin-pad-unit-desativ-color';
	  }else{
      echo'admin-pad-unit-ativar-color';
	  } ?>"
      item_id="<?php echo $value->e_id; ?>" ativo="<?php echo $value->e_ativo; ?>">
      
  
   <div class="etec-admin-pad-cont-unit-title" ><!--- o "conteudo " virou "cont" --->
     Título
   </div>
   <div class="etec-admin-pad-cont-unit-info" evento_titulo <?php if($value->e_titulo == ""){echo 'align="center"';}?>>
     <?php if($value->e_titulo == ""){echo '--';}else{echo $value->e_titulo;}  ?>
   </div>
   
      <div class="etec-admin-pad-cont-unit-title"><!--- o "conteudo " virou "cont" --->
     Sinopse
   </div>
   <div class="etec-admin-pad-cont-unit-info-reduces etec-admin-pad-cont-unit-info " <?php if($value->e_sinopse == ""){echo 'align="center"';}?>>
     <?php if($value->e_sinopse == ""){echo '--';}else{echo $value->e_sinopse;}  ?>
     
   </div>

   <div class="etec-admin-pad-cont-unit-title"><!--- o "conteudo " virou "cont" --->
     Foto
   </div>
   <div class="etec-admin-pad-cont-unit-info-img etec-admin-pad-cont-unit-info ">
     <img src="<?php echo $imagem[2]; ?>" alt="<?php echo $imagem[1]; ?>" title="<?php echo $imagem[0]; ?>" />   
   </div>
   

      
   
     
  </div><!--fechamento da class"etec-admin-pad-conteudo-unit"-->
 
<?php

	endforeach;

}

?>
 </div><!--fechamento da class"etec-admin-pad-conteudo-->
</main>







<script src="js/admin_eventos.js"></script>
</body>
</html>