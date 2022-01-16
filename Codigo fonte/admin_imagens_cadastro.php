<?php

include("session.php");

function MyAutoload($className) {    
    $extension =  spl_autoload_extensions();
    require_once (__DIR__ . '/classes/' . $className . $extension);
}

spl_autoload_extensions('.php');
spl_autoload_register('MyAutoload');
  
$Albuns = new Album();

if(isset($_POST['id_album'])){
	
	$id_album = $_POST['id_album'];
	
	if($id_album == 72){
		
		$pesquisa = 0;
		
	}
	else
	{
		
		$pesquisa = 2;
		
	}
	
		//realiza a busca das informações
    $info_album = $Albuns->find($id_album, $pesquisa);
	
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
<title>Cadastro de Imagem</title>

</head>
<body>



<?php 
include("admin_menu.php");/*inclusao do menu do site*/
?>

<main class="etec-admin-pag-padrao">
 <div class="etec-admin-pad-barlateral">
   <div class="etec-admin-pad-bar-info"><h1>Cadastro de Imagem</h1></div>
   <div class="etec-admin-pad-bar-info"><i>Informativo:</i> Nesta página é possivel realizar o cadastro de uma nova imagem. Logo abaixo desta mensagem há a seguinte opção:
   
    <p><strong>"Voltar"</strong> Botão que irá redireciona-lo de volta à página de imagens; </p>
   </div>
    
   <div class="etec-admin-pad-bar-info"><i>Resumo dos campos</i> logo abaixo podera ser visto um resumo de cada campo do formulario , nesse sera mostrado os posivei valores que sao permitidos para cada campo
    <p><strong>Titulo da imagen</strong> Aceita caracteres e números</p>
    <p><strong>Texto caso a imagen nao seja encontrada</strong> Aceita caracteres e números</p>
    <p><strong>Selecione um Imagens </strong> Aceita imagens no formato "png","jpeg" </p>
    <p><strong>Album</strong> Selecione para qual album essa imagen pertence </p>
   
    
   
   
    </div>
    
   <a href="admin_imagens.php?Ads433DFShUIwW34BmjLSD67Er4GDFD56GDSHJ6575GY4GFD6KU353sfsDr6RrfSDSGhhtdtFD3F55dgDs58s85hd=<?php echo $id_album; ?>" ><div class="etec-admin-pad-bar-iten etec-admin-pad-bar-iten-btn " >
   Voltar
   </div></a>
 </div>
 <div class="etec-admin-pad-conteudo">
 
<fieldset>        	  	  
 <form action="admin_imagens.php?Ads433DFShUIwW34BmjLSD67Er4GDFD56GDSHJ6575GY4GFD6KU353sfsDr6RrfSDSGhhtdtFD3F55dgDs58s85hd=<?php echo $id_album; ?>" method="post" enctype="multipart/form-data">
  <div class="etec-admin-pad-forms">
 
   <div class="etec-admin-pad-forms-element">
   <input name="titulo" type="text" class="input" maxlength="50" id="imagem_titulo" placeholder="Título da imagem."/>
  </div>
  
  <div class="etec-admin-pad-forms-element">
   <input name="alt" type="text" class="input" maxlength="100" id="imagem_alt" placeholder="Texto caso a imagem não seja encontrada." />
  </div>
  
  <div  class="etec-admin-pad-forms-enviar-img-btn">

   <label for='selecao-arquivo'>Selecionar uma imagem</label>
   <input  name="imagem" type="file" id="selecao-arquivo" accept="image/png, image/jpeg"/> 
   </div> 
 
 <input name="album" type="hidden" value="<?php echo $id_album; ?>" />  

<div class="button etec-admin-pad-forms-enviar"><input name="cadastrar" type="button" value="Finalizar" /></div>
</div>
</form>
</fieldset>
  
 
  </div>
 </div>
</main>


<script src="js/admin-imagems.js"></script>
</body>
</html>