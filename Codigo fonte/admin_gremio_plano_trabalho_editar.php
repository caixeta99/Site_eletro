<?php

include("session.php");

function MyAutoload($className) {    
    $extension =  spl_autoload_extensions();
    require_once (__DIR__ . '/classes/' . $className . $extension);
}

spl_autoload_extensions('.php');
spl_autoload_register('MyAutoload');

$Plano_trabalho = new PlanoTrabalhoGremio();
$Gremios = new Gremio();

date_default_timezone_set('America/Sao_Paulo');
$date = date('Y');        

	//realiza a busca do ultimo gremio estudantil
$gremio_atual = $Gremios->find($date);
	
if(!($gremio_atual)){
		
	die(header('location:admin_gremio.php'));
		
}      

    //verifica se o id foi recebido
if((isset($_POST['id']))){
		//pega o valor do id
	$id = $_POST['id'];  
   
       	//realiza a busca do ultimo gremio estudantil
	$plano_trabalho = $Plano_trabalho->find($id, $gremio_atual->g_id);
	
	if(!($plano_trabalho)){
		
		die(header('location:admin_gremio.php'));
				 
	}

}
else{
	 
	die(header('location:admin_gremio.php'));
	 
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
                                <!-- titulo da pagina-->
<title>Editar plano de trabalho do grêmio</title>

</head>
<body>



<?php 
include("admin_menu.php");/*inclusao do menu do site*/
?>

<main class="etec-admin-pag-padrao">
 <div class="etec-admin-pad-barlateral">
   <div class="etec-admin-pad-bar-info"><h1>Edição de um item  </h1></div>
   <div class="etec-admin-pad-bar-info"><i>Informativo:</i> Nesta página é possivel realizar a edição de um item do plano de trabalho do grêmio.
   </div>
   
  <a href="admin_gremio_plano_trabalho.php" ><div class="etec-admin-pad-bar-iten etec-admin-pad-bar-iten-btn " >
     Voltar
   </div></a>
 </div>
 <div class="etec-admin-pad-conteudo">
 
<fieldset>        	  	  
 <form action="admin_gremio_plano_trabalho.php" method="post" >
  <div class="etec-admin-pad-forms">
   <div class="etec-admin-pad-forms-info">
    <p>Categoria </p>
      <select name="categoria" class="" >
    <option <?php if($plano_trabalho->pt_categoria == 'Cultura'){echo 'selected="selected"';} ?> >Cultura</option>
       <option <?php if($plano_trabalho->pt_categoria == 'Esporte'){echo 'selected="selected"';} ?>>Esporte</option>
       <option <?php if($plano_trabalho->pt_categoria == 'Política'){echo 'selected="selected"';} ?>>Política</option>
       <option <?php if($plano_trabalho->pt_categoria == 'Social'){echo 'selected="selected"';} ?>>Social</option>
       <option <?php if($plano_trabalho->pt_categoria == 'Comunicação'){echo 'selected="selected"';} ?>>Comunicação</option>
    </select>
  </div>
 <div class="etec-admin-pad-forms-info-text-are">
    <p>Descrição </p>
<textarea name="descricao" class="text-area Forme-elemente" placeholder="Descrição do item." maxlength="150"  ><?php echo $plano_trabalho->pt_descricao; ?></textarea>
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