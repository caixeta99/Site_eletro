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
<title>Editar imagem</title>

</head>
<body>



<?php 

include("admin_menu.php");/*inclusao do menu do site*/

	//verifica se o id foi recebido
if(isset($_POST['id'])){

		//pega o id
    $id = $_POST['id'];

    	//realiza a busca das informações
    $resultado = $Imagens->find($id);
	
    if(!($resultado)){

    	die("Falha na consulta");

    }
	
	if($resultado->i_album == 72){
		
		$pesquisa = 0;
		
	}
	else
	{
		
		$pesquisa = 2;
		
	}

			//realiza a busca das informações
    $info_album = $Albuns->find($resultado->i_album, $pesquisa);
	
    if(!($info_album)){

    	echo '<script language="javascript">';
    	echo  'window.location.href = "admin_album.php";';
    	echo '</script>';

    }
    
}
else{
	  
	echo '<script language="javascript">';
  	echo  'window.location.href = "admin_album.php";';
	echo '</script>';
	  
}
?>
<main class="etec-admin-pag-padrao">
 <div class="etec-admin-pad-barlateral">
   <div class="etec-admin-pad-bar-info"><h1>Edição de imagen</h1></div>
   <div class="etec-admin-pad-bar-info"><i>Informativo:</i> Nesta página é possivel realizar a edição de uma determinada imagem. </div>

   <a href="admin_imagens.php?Ads433DFShUIwW34BmjLSD67Er4GDFD56GDSHJ6575GY4GFD6KU353sfsDr6RrfSDSGhhtdtFD3F55dgDs58s85hd=<?php echo $resultado->i_album; ?>" ><div class="etec-admin-pad-bar-iten etec-admin-pad-bar-iten-btn " >
   Voltar
   </div></a>

 </div>
 <div class="etec-admin-pad-conteudo">
 
<fieldset>        	  	  
 <form action="admin_imagens.php?Ads433DFShUIwW34BmjLSD67Er4GDFD56GDSHJ6575GY4GFD6KU353sfsDr6RrfSDSGhhtdtFD3F55dgDs58s85hd=<?php echo $resultado->i_album; ?>" method="post" enctype="multipart/form-data">
  <div class="etec-admin-pad-forms">
   
  
  
  <div class="etec-admin-pad-forms-info">
  <p>Título </p>
   <input name="titulo" type="text"  maxlength="50" id="imagem_titulo" placeholder="Título da imagem." value="<?php echo $resultado->i_titulo; ?>"/>
  </div>
  
  
  <div class="etec-admin-pad-forms-info">
  <p>Alt </p>
   <input name="alt" type="text" class="input" maxlength="100" id="imagem_alt" placeholder="Texto caso a imagem não seja encontrada." value="<?php echo $resultado->i_alt; ?>" />
  </div>  
 
  
  
  
  <div  class="etec-admin-pad-forms-enviar-img-btn">

   <label for='selecao-arquivo'>Selecionar uma imagem</label>
<input  name="imagem" type="file" id="selecao-arquivo" accept="image/png, image/jpeg"/> 
   </div> 

  
    <input name="id" type="hidden" value="<?php echo $id; ?>" />

<div class="button etec-admin-pad-forms-enviar"><input name="editar" type="submit" value="Finalizar" /></div>


  </div>
</form>
</fieldset>

 </div>
 
  </div>

</main>


</body>
</html>