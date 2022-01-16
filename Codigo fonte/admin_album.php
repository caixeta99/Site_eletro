<?php

include("session.php");

function MyAutoload($className) {    
    $extension =  spl_autoload_extensions();
    require_once (__DIR__ . '/classes/' . $className . $extension);
}

spl_autoload_extensions('.php');
spl_autoload_register('MyAutoload');
  
$Imagens = new Imagem();
$Albuns = new Album();

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
<title>Albuns</title>

</head>
<body>

<?php 
include("admin_menu.php");/*inclusao do menu do site*/
?>


<main class="etec-admin-pag-padrao">

   



 <div class="etec-admin-pad-barlateral">
   <div class="etec-admin-pad-bar-info"><h1>Albuns </h1></div>
   <div class="etec-admin-pad-bar-info"><i>Informativo:</i> Nesta página contém informações referente aos albuns. Click sobre um album para ver as imagens contidas nele.   
   
   <a href="admin_imagens.php?Ads433DFShUIwW34BmjLSD67Er4GDFD56GDSHJ6575GY4GFD6KU353sfsDr6RrfSDSGhhtdtFD3F55dgDs58s85hd=72"><div class="etec-admin-pad-bar-iten-alment etec-admin-pad-bar-iten " >
     Imagens da instituição
</div></a>
   </div>
   
  <?php  
   include("admin_barra_lateral_legendcores.php");
 ?> 
   
 </div><!--fechamento da class"etec-admin-pad-barlateral"-->
 <div class="etec-admin-pad-conteudo">
 
<?php 	     
      
foreach($Albuns->findAll(1) as $key => $value):
	    
	//verifica se há imagem  principal no album
$resultado = $Imagens->findPrincipal($value->a_id);

if(!$resultado){
		//se não foi encontrada, e chamada uma imagem pré definida
	$imagem = array('','Imagem não encontrada','Imagens/Imagens estaticas/Outras imagens/Imagem_album.jpg'); 
}
else{
		//se foi encontrada, a imagem sendo cadastrada não recebe prioridade
	$imagem = array($resultado->i_titulo,$resultado->i_alt,$resultado->i_caminho); 
}
			
?>
        
<a href="admin_imagens.php?Ads433DFShUIwW34BmjLSD67Er4GDFD56GDSHJ6575GY4GFD6KU353sfsDr6RrfSDSGhhtdtFD3F55dgDs58s85hd=<?php echo $value->a_id; ?>">        
 <div class="etec-admin-pad-conteudo-unit admin-pad-unit-ativar-color">
      
  
   <div class="etec-admin-pad-cont-unit-title" ><!--- o "conteudo " virou "cont" --->
     Título
   </div>
   <div class="etec-admin-pad-cont-unit-info" <?php if($value->a_titulo == ""){echo 'align="center"';}?>>
     <?php if($value->a_titulo == ""){echo '--';}else{echo $value->a_titulo;}  ?>
   </div>
   <div class="etec-admin-pad-cont-unit-title "><!--- o "conteudo " virou "cont" --->
     foto
   </div>
   <div class="etec-admin-pad-cont-unit-info-img etec-admin-pad-cont-unit-info ">
     <img src="<?php echo $imagem[2]; ?>" alt="<?php echo $imagem[1]; ?>" title="<?php echo $imagem[0]; ?>" />    
   </div>

      
   
     
  </div><!--fechamento da class"etec-admin-pad-conteudo-unit"-->
</a>
<?php 

	endforeach;

?>
 </div><!--fechamento da class"etec-admin-pad-conteudo-->
</main>


</body>
</html>