<?php

include("session.php");

function MyAutoload($className) {    
    $extension =  spl_autoload_extensions();
    require_once (__DIR__ . '/classes/' . $className . $extension);
}

spl_autoload_extensions('.php');
spl_autoload_register('MyAutoload');
  
$Calendario = new CalendarioEscolar();


   	//pega a data atual
date_default_timezone_set('America/Sao_Paulo');
$date = date('Y');
   
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

 
<title>Calendário</title>
</head>
<body>

<?php 

include("admin_menu.php");/*inclusao do menu do site*/

	//Cadastra um calendario escolar
if(isset($_POST['cadastrar'])){
     
			 //realiza a busca das informações
	$resultado = $Calendario->findLast();
		
	if(!($resultado)){
	
		die("Falha na consulta");
	
	}
	
	if($resultado->ano < $date){ 
	
			//Salva os campos 
		$Calendario->setAno($date);

			//Insert
		if($Calendario->insert()){
			
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

//edicao de um calendario no mysql 
if(isset($_POST['editar'])){

    
			 //realiza a busca das informações
	$resultado = $Calendario->findLast();
		
	if(!($resultado)){
	
		die("Falha na consulta");
	
	}
	
	if($resultado->ano == $date){ 
	
		if(isset($_FILES["documento"])){
			
			//pega os valores dos campos
	   	$nome_temporario=$_FILES["documento"]["tmp_name"];	  
       	
		
			if($nome_temporario != ''){
	   			
				    //realiza a busca das informações
    			$resultado = $Calendario->find($date);
	
    			if(!($resultado)){

    				die("Falha na consulta");

    			}
				
				if($resultado->ca_documento != ''){
	       			
					unlink($resultado->ca_documento);    
		 		
				}
				
					//muda para a nova imagem
				$pathinfo = pathinfo($_FILES["documento"]["name"]);
				$caminho = "Documentacao/Calendario/".$date.".".$pathinfo['extension']; 
				copy($nome_temporario,$caminho);
				
				$Calendario->setDocumento($caminho);
			   
				if($Calendario->update($date)){
				
					echo '<script language="javascript">';
					echo "alert('Edição bem sucedida!');";
					echo '</script>';
				
				}
				else{
					
					echo '<script language="javascript">';
					echo "alert('Falha na edição do calendério escolar!');";
					echo '</script>';
					
				}
			
			}
			
		}   

	}
	else{
			
		echo '<script language="javascript">';
		echo "alert('Falha na edição do calendério escolar!');";
		echo '</script>';
		
	}

}

?>
<main class="etec-admin-pag-padrao">
 <div class="etec-admin-pad-barlateral">
   <div class="etec-admin-pad-bar-info"><h1>Calendário escolar<h1></div>
   <div class="etec-admin-pad-bar-info"><i>Informativo:</i>  Nesta página contém informações referente aos calendários da escola. Logo abaixo desta mensagem há as seguintes opções: 
      
    <p><strong>"Cadastrar"</strong> Botão que irá cadastrar um novo calendário(esta opção somente aparecerá caso não houver o calendário do ano atual);</p> 
    <p><strong>"Alterar"</strong> Botão que irá redireciona-lo para a página de edição;</p>  
  
    </div>
 
<?php 

    //realiza a busca das informações
$resultado = $Calendario->findLast();

if((!$resultado)or($resultado->ano < $date)){ 

?>  
<form action="#" method="post">
   <label for="btn_cadastrar"><div class="etec-admin-pad-bar-iten etec-admin-pad-bar-iten-btn " >
     Cadastrar
   </div></label>
   <input name="cadastrar" id="btn_cadastrar" type="submit" />
</form>   
<?php 
 
}
else{ 

?>
    <a href="admin_calendario_escolar_editar.php" ><div class="etec-admin-pad-bar-iten etec-admin-pad-bar-iten-btn " >
     Alterar   </div></a>     

<?php  

}

include("admin_barra_lateral_legendcores.php");

?> 
</div>
 <div class="etec-admin-pad-conteudo">
 
  
  
  

<?php 

$calendarios = $Calendario->findAll();

if($calendarios){

	foreach($calendarios as $key => $value):

?>
        
 <div class="etec-admin-pad-conteudo-unit <?php if($date != $value->ca_ano){echo 'admin-pad-unit-inative-color';}else{echo'admin-pad-unit-ativar-color';}?>" >
   <div class="etec-admin-pad-cont-unit-title"><!--- o "conteudo " virou "cont" --->
     Ano
   </div>
   <div class="etec-admin-pad-cont-unit-info">
   <?php  
   
       echo $value->ca_ano;
   
   ?>
   </div>
   
    <div class="etec-admin-pad-cont-unit-title "><!--- o "conteudo " virou "cont" --->
     Arquivo
   </div>
   <div class="etec-admin-pad-cont-unit-info" <?php if($value->ca_documento==""){echo 'align="center"';}?>>
    <?php if($value->ca_documento==""){echo '--';}else{echo $value->ca_documento;} ?>
   </div>  
 
 </div>
<?php

	endforeach;

}

?>




</main>

</body>
</html>