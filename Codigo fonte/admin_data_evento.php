<?php

include("session.php");

function MyAutoload($className) {    
    $extension =  spl_autoload_extensions();
    require_once (__DIR__ . '/classes/' . $className . $extension);
}

spl_autoload_extensions('.php');
spl_autoload_register('MyAutoload');
  
$EventoData = new EventoData();
$Eventos = new Eventos();

if(isset($_POST['id'])){

    $id_evento = $_POST['id'];

}
else{
        
    if(isset($_GET['AdeASdEeH6E67WfgdfS4s4tSsE33U577SshjHgQdFDbcvFY3q3886DGFgSllHJJu4308Hrt5bFDdgHyYgNBdf'])){
            
        $id_evento = $_GET['AdeASdEeH6E67WfgdfS4s4tSsE33U577SshjHgQdFDbcvFY3q3886DGFgSllHJJu4308Hrt5bFDdgHyYgNBdf'];
        
    }
    else{
        
        header('location:admin_evento.php');
        
    }
    
}

    //realiza a busca das informações
$evento = $Eventos->find($id_evento);

if(!($evento)){

    die("Falha na consulta");

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
<title>Datas Dos Eventos</title>

</head>
<body>

<?php 

include("admin_menu.php");/*inclusao do menu do site*/

//edicao de data do calendario no mysql 
if(isset($_POST['editar'])){

        //verifica se os valores foram recebidos
    if((isset($_POST['data']))and(isset($_POST['id_data']))){
   
            //pega os valores dos campos
        $id = $_POST['id_data'];
        $data = $_POST['data'];

        $EventoData->setData($data);
       
        if($EventoData->update($id)){
        
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
    if(isset($_POST['data'])){
          //pega os valores dos campos
        $data = $_POST['data'];

            //Salva os campos 
        $EventoData->setData($data); 
        $EventoData->setEvento($id_evento);

            //Insert
        if($EventoData->insert()){
            
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
    if(isset($_POST['id_data'])){

            //pega o valor do id
        $id_data = (int)$_POST['id_data'];

            //realiza a busca das informações
        $resultado = $EventoData->find($id_data);
    
        if(!($resultado)){

            die("Falha na desativacão");

        }
    
        $ativo = $resultado->de_ativo;

        if($ativo == 'N'){

            $EventoData->setAtivo('S');

            if($EventoData->delete($id_data)){
            
                echo '<script language="javascript">';
                echo "alert('Ativação bem sucedida!');";
                echo '</script>';
                
            }
            else{
                
                echo '<script language="javascript">';
                echo "alert('Falha na ativação da data selecionado!');";
                echo '</script>';
                
            }

        }
        else{

            $qtd_datas = $EventoData->findCount($id_evento);

            if($qtd_datas->qtd > 1){

                $EventoData->setAtivo('N');

                if($EventoData->delete($id_data)){
                
                    echo '<script language="javascript">';
                    echo "alert('Destivação bem sucedida!');";
                    echo '</script>';
                    
                }
                else{
                    
                    echo '<script language="javascript">';
                    echo "alert('Falha na desativação da data selecionado!');";
                    echo '</script>';
                    
                }

            }
            else{

                echo '<script language="javascript">';
                echo "alert('Falha na desativação: deve haver pelo menos uma data ativa por evento!');";
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
     <form action="admin_data_evento_editar.php" method="post"  class="eve-admin-form">
     <label for='Editar' >Editar</label>
     <input type="submit" name="editar" value="Editar" editar  class="btn" id="Editar"/> <input  id="editar" name="id" type="hidden" value="" />
    </form>
    <form action="admin_data_evento.php" method="post">
    <label for='Desativar' desativar>Desativar</label>
     <input type="submit" name="desativar" value="Desativar"  class="btn" id="Desativar" />
     <input id="desativar" name="id_data" type="hidden" value="" />
     <input name="id" type="hidden" value="<?php echo $id_evento; ?>" />
    </form>
   </div> <!--fechamento da classe "etec-pop-p-tela-informacoes-two-op"-->   
  
</div><!---fechamento da class"etec-pop-p-tela-informacoes-two-op"-->

</div><!---fechamento da class"etec-pop-up-tela-informacoes-fundo"-->

<main class="etec-admin-pag-padrao">




<div class="etec-admin-pad-barlateral">
   <div class="etec-admin-pad-bar-info"><h1>Datas Dos Eventos</h1></div>
   <div class="etec-admin-pad-bar-info"><i>Informativo:</i> Nesta página contém informações referente às datas de evento selecionado, logo abaixo desta mensagem há as seguintes  opções:
     <p><strong>"Cadastrar"</strong> Botão que irá redireciona-lo à página de cadastro; </p>
     <p><strong>"Voltar"</strong> Botão que irá redireciona-lo de volta à página de eventos; </p>
   
   </div>
  
  
 
   <a href="admin_data_evento_cadastro.php?Ade34F5fgdfS4s4t4Fg577SshjHgQdFDbcvFY3q3886DGFgSllHJJu4308Hrt5bFDdgHyYgNBdf=<?php echo $id_evento ?>"><div class="etec-admin-pad-bar-iten etec-admin-pad-bar-iten-btn " >
     Cadastrar
   </div></a>
   
  <a href="admin_evento.php"> <div class="etec-admin-pad-bar-iten etec-admin-pad-bar-iten-btn " >
   Voltar
   </div>  </a>
   
  
<?php  

include("admin_barra_lateral_legendcores.php");

?>   
   
 </div><!--fechamento da class"etec-admin-pad-barlateral"-->
 <div class="etec-admin-pad-conteudo">
 
<?php 

foreach($EventoData->findAll($id_evento, 'N') as $key => $value):

?>
        
 <div class="etec-admin-pad-conteudo-unit-reduces  <?php if($value->de_ativo == 'N'){
      echo 'admin-pad-unit-desativ-color';
      }else{
      echo'admin-pad-unit-ativar-color';
      } ?>"
      item_id="<?php echo $value->de_id; ?>" ativo="<?php echo $value->de_ativo; ?>">
      
  
   <div class="etec-admin-pad-cont-unit-title"><!--- o "conteudo " virou "cont" --->
     Evento
   </div>
   <div class="etec-admin-pad-cont-unit-info" data_evento>
    <?php echo $evento->e_titulo; ?>
   </div>
   
      <div class="etec-admin-pad-cont-unit-title "><!--- o "conteudo " virou "cont" --->
     Data
   </div>
   <div class="etec-admin-pad-cont-unit-info-reduces etec-admin-pad-cont-unit-info ">
       <?php echo date('d/m/Y',strtotime($value->de_data)); ?>
   </div>

     
   
     
  </div><!--fechamento da class"etec-admin-pad-conteudo-unit"-->
<?php 

endforeach;

?>
 </div><!--fechamento da class"etec-admin-pad-conteudo-->
</main>






<script src="js/admin_data_eventos.js"></script>
</body>
</html>