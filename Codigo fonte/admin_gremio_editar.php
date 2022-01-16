<?php

include("session.php");

function MyAutoload($className) {    
    $extension =  spl_autoload_extensions();
    require_once (__DIR__ . '/classes/' . $className . $extension);
}

spl_autoload_extensions('.php');
spl_autoload_register('MyAutoload');
  
$Gremios = new Gremio();

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
                     
<title>Editar Grêmio</title>
</head>
<body>



<?php 
include("admin_menu.php");/*inclusao do menu do site*/
?>
<?php

	//busca os gremio do ano atual 
date_default_timezone_set('America/Sao_Paulo');
$date = date('Y');   
   
    //realiza a busca do ultimo gremio estudantil
$gremio_atual = $Gremios->find($date);
	
if(!($gremio_atual)){
	
    die("Falha na consulta");
	 
}

?> 

<main class="etec-admin-pag-padrao">
 <div class="etec-admin-pad-barlateral">
   <div class="etec-admin-pad-bar-info"><h1>Edição do Grêmio| <?php echo $gremio_atual->g_ano; ?></h1></div>
   <div class="etec-admin-pad-bar-info"><i>Informativo:</i> Nesta página é possivel realizar a edição do Grêmio| <?php echo $gremio_atual->g_ano; ?>.</div>
    
    <div class="etec-admin-pad-bar-info"><i>Resumo dos campos</i> logo abaixo poderá ser visto um resumo de cada campo do formulário.
    <p><strong>Título do Grêmio</strong> Aceita até 100 caracteres;</p>
    <p><strong>Imagem</strong> Aceita imagens no formato "jpg e png";</p>
    <p><strong>Ano </strong> Campo informativo(não pode ser alterado), indica o ano do grêmio.</p>
    
    
   
   
    </div>
    
   <a href="admin_gremio.php" ><div class="etec-admin-pad-bar-iten etec-admin-pad-bar-iten-btn " >
       Voltar
   </div></a>
 </div>
 <div class="etec-admin-pad-conteudo">
 
<fieldset>        	  	  
 <form action="admin_gremio.php" method="post" enctype="multipart/form-data" >
  <div class="etec-admin-pad-forms">
 
 
  <div class="etec-admin-pad-forms-element">
    <input name="nome" type="text" class="input" maxlength="100" id="" placeholder="Título do Gremio." value="<?php echo $gremio_atual->g_nome;?>"/>
  </div>
  
  
  <div  class="etec-admin-pad-forms-enviar-img-btn  ">

   <label for='selecao-arquivo'>Selecionar uma imagem</label>
   <input  name="imagem" type="file" id="selecao-arquivo" accept="image/png, image/jpeg"/> 
   </div>
   
  <div class="etec-admin-pad-forms-element">
   <input name="data" type="text" class="input" disabled id=""  value="<?php echo $gremio_atual->g_ano;?>"/>
  </div>
     <div class="etec-admin-pad-forms-info">
    <p>Imagens dos membros </p>
      <select name="imagens" class="" >
      <option value="S" <?php if($gremio_atual->g_imagens == 'S'){ echo 'selected="selected"'; } ?>>Exibir</option>
      <option value="N" <?php if($gremio_atual->g_imagens == 'N'){ echo 'selected="selected"'; } ?>>Não Exibir</option>
    </select>
  </div>
  
  <div class="etec-admin-pad-forms-element">
    <input name="facebook" type="text" class="input" maxlength="100" id="" placeholder="Facebook do Gremio(Opcional)." value="<?php echo $gremio_atual->g_facebook;?>"/>
  </div>
  
  <div class="etec-admin-pad-forms-element">
    <input name="instagram" type="text" class="input" maxlength="100" id="" placeholder="Instagram do Gremio(Opcional)." value="<?php echo $gremio_atual->g_instagram;?>"/>
  </div>
  
 
<div class="button etec-admin-pad-forms-enviar"><input name="editar" type="submit" value="Finalizar" /></div>
</div>
</form>
</fieldset>
  
  
 
  </div>
 </div>
</main>



<script src="js/gremio_admin.js"></script>
</body>
</html>